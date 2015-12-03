<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');
@session_start();
require_once("../debug_log.php");
require_once "../_common/_constants.php";
require_once "../useractions.php";
linkme();
include 'payment.php';
require_once 'secure_functions.php';

$payment = new payment();

$paymentStatus = $payment->updateResponse();

if(payment::PAYMENT_SUCCESSFULL ==$paymentStatus){
    $approved = 1;
    $mr = 'M12';
} else {
    $approved = 0;
    $mr = '';
}

/* * *
 * returned params from gateway
 */
$Message = $payment->getValue($_REQUEST, 'vpc_Message');
$OrderInfo = $payment->getValue($_REQUEST, 'vpc_OrderInfo');
$Amount = $payment->getValue($_REQUEST, 'vpc_Amount');
$ReceiptNo = $payment->getValue($_REQUEST, 'vpc_ReceiptNo');
$TransactionNo = $payment->getValue($_REQUEST, 'vpc_TransactionNo');

$ResponseCode = $payment->getValue($_REQUEST,'vpc_TxnResponseCode');
$VerSecurityLeve = $payment->getValue($_REQUEST,'vpc_VerSecurityLeve');
$VerStatus = $payment->getValue($_REQUEST,'vpc_VerStatus');
$VerType = $payment->getValue($_REQUEST,'vpc_VerType');
$Card = $payment->getValue($_REQUEST,'vpc_Card');
$AcqResponseCode = $payment->getValue($_REQUEST,'vpc_AcqResponseCode');


$summary = serialize($_REQUEST);

//insert id from secure.index

$insert_id = $payment->getValue($_SESSION, 'cc_transactions_id', null);
$invoiceNumber = $payment->getValue($_SESSION, 'invoiceNumber');

$clientIp = $_SERVER['REMOTE_ADDR'];

if (empty($insert_id)) {
    exit('transactions id not found');
}



// case 2
// came back from payment gateway
$string = "update cc_transactions set CR='AUD', SC='{$ResponseCode}', TI='{$TransactionNo}', MR = '{$mr}',MT='{$Message}',RT='{$clientIp}', AM='{$Amount}',summary = '{$summary}' where id='{$insert_id}'";
$result = mysql_query($string);

// case 3
// approved(0|1) or not
// 
// update customer table.
$string = "update customers set approved='{$approved}' where id='{$_SESSION['custid']}'";
$result = mysql_query($string);


// submit their order via email.			
$query = "SELECT ordertype FROM orders WHERE id=" . ($_SESSION["InvoiceNumber"] - 1000);
$result = mysql_query($query);
list($ordertype) = mysql_fetch_row($result);


// send customers details
if ($approved) {
    $query = "SELECT firstname, surname, emailadd FROM customers WHERE id=" . $_SESSION['custid'];
    $result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line {__LINE__} " . mysql_error(), $header = true);
    list($firstname, $surname, $emailadd) = mysql_fetch_row($result);
    if ($ordertype == "Phone/fax" || $_SESSION['fromAdmin'] == 1) {
        $fromadmin = true;
    }
    sendNewOrder(($_SESSION["invoiceNumber"] - 1000), "{$firstname} {$surname}", $emailadd, "Credit Card - ePay", true);
}



// redirect...
Header("Location: secure_receipt.php?order={$_SESSION['invoiceNumber']}&id={$insert_id}");    
