<?PHP

require_once("../debug_log.php");

/* * ************
 *
 * 	SECURE FORM
 *
 * ************ */

require_once "../_common/_constants.php";
$includeabove = true;
require_once "../useractions.php";
require_once 'payment.php';
require_once 'secure_functions.php';

session_start();
header("Cache-control: private");

// initiate DB connection
linkme();


if (!empty($_POST['paymentAmount']))
    $_SESSION['paymentAmount'] = $_POST['paymentAmount'];

if (!empty($_POST['invoiceNumber']))
    $_SESSION['invoiceNumber'] = $_POST['invoiceNumber'];

if (!empty($_POST['currency']))
    $_SESSION['currency'] = $_POST['currency'];

if (!empty($_POST['custid']))
    $_SESSION['custid'] = $_POST['custid'];

if (!empty($_POST['fromAdmin']))
    $_SESSION['fromAdmin'] = $_POST['fromAdmin'];

if (!empty($_POST['baby_pack_in_order']))
    $_SESSION['baby_pack_in_order'] = $_POST['baby_pack_in_order'];


$order_id = checkOrderId(false) + 1000;
debug_log_add("secure/index.php", $_REQUEST['section'] . " - " . $order_id);



// insert order data into cc_transaction database.
$clientIp = $_SERVER['REMOTE_ADDR'];
$string = "insert into cc_transactions (OI, IP) values ('{$_SESSION['invoiceNumber']}','$clientIp')";
$result = mysql_query($string) or secureErrorMsg("SQL ERROR:  Line {__LINE__} " . mysql_error(), $header = true);

if(!$result){
    exit("transactions record could not be created");
}

$_SESSION['cc_transactions_id'] =  mysql_insert_id();


/**
 * before redirecting to payment gateway
 */
$payment = new payment();

$userId = $payment->getValue($_POST, 'custid', uniqid());
$amount = floor($payment->getValue($_POST, 'paymentAmount', 0) * 100);

$payment->makePayment($amount, $order_id, $userId);
