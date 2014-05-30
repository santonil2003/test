<?php 
session_start();
require_once("debug_log.php");
include_once("useractions.php");
include("vieworderlist.php");
$SITE_URL	= "http://www.identikid.com.au/temp/";
if($_POST["orderid"]){
	$id = $_POST["orderid"];
}else if($_GET["orderid"]){
	$id = $_GET["orderid"];
}else{
	$id = checkOrderId(false);
}

linkme();

$id = checkOrderId(false);
$order_id = $id+1000;
debug_log_add("order_payment_paypal.php", "Order ID: " . $order_id);



$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);
/*
if ($_COOKIE['currency']!=1) //Australia
{
	$postage = $cur['postage'];
}
*/
 
$postage_option = $_SESSION["post_option"];		
$postage = $_SESSION["postageamount"];

if($id==false){
	header("location:products_home.php");
	exit;
}

getCustomerDetails($id);

//$identitags_in_order = false;
$identibands_in_order = false;
$_SESSION['baby_pack_in_order'] =false;
$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
if(mysql_num_rows($result)>0){
	while($qdata = mysql_fetch_array($result)){
		$totalprice += $qdata["price"];
		//if($qdata['type']==14)
		if($qdata['type']==30 || $qdata['type']==31)
		{
			//$identitags_in_order = true;
			$identibands_in_order = true;
		}
		if($qdata['type']==16){
			$_SESSION['baby_pack_in_order'] = true;
		}
	}
}

$totalprice_withoutpostage = $totalprice;
// with postage;
$totalprice += $postage;


//print "TEST: $totalprice, {$_SESSION['vouchercode']}<BR>";



$tempVoucherDetails = getVoucherDetails($totalprice, $_SESSION['vouchercode']);
$voucher_usage_raw = $tempVoucherDetails[4];

// gets voucher usage in the ORDERS currency
list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice, $voucher_error, $voucher_currency) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);

if($_COOKIE["currency"]==1 ){
	// au dollars
	$_AUTotal = $totalprice;
}
else if($_COOKIE["currency"]==2 || $_COOKIE['currency']==3 || $_COOKIE['currency']== 5 ){
	// us & eu dollars
	$_CurrencyTotal = $totalprice;
	//$_AUTotal = convertCurrency($totalprice, $_CURRENCIES[$_COOKIE['currency']]['code']."toAUD");
	$_AUTotal = convertCurrencyNew($totalprice, $_COOKIE['currency']);
}




//print_r($_SESSION);
?>
															<table width="890" border="0" cellspacing="0" cellpadding="0"> 
																<form name="confform" method="post" action="submitorder_ps.php"> 
																	<input type="hidden" name="postageamount" value="<? echo $postage;?>"> 
																	<input type="hidden" name="postageoption" value="<? echo $postage_option;?>">  
																	<input type="hidden" name="submittype" value="confirmed"> 
																	<input type="hidden" name="orderid" value="<? echo $id;?>">  
																	<input type="hidden" name="firstname" value="<? echo stripslashes($firstname);?>"> 
																	<input type="hidden" name="surname" value="<? echo stripslashes($surname);?>"> 
																	<input type="hidden" name="del_name" value="<? echo stripslashes($del_name);?>"> 
																	<input type="hidden" name="address" value="<? echo stripslashes($address);?>"> 
																	<input type="hidden" name="suburb" value="<? echo stripslashes($suburb);?>"> 
																	<input type="hidden" name="postcode" value="<? echo $postcode;?>"> 
																	<input type="hidden" name="state" value="<? echo $state;?>"> 
																	<input type="hidden" name="country" value="<? echo $country;?>"> 
																	<input type="hidden" name="address_cust" value="<? echo stripslashes($address_cust);?>"> 
																	<input type="hidden" name="suburb_cust" value="<? echo stripslashes($suburb_cust);?>"> 
																	<input type="hidden" name="postcode_cust" value="<? echo $postcode_cust;?>"> 
																	<input type="hidden" name="state_cust" value="<? echo $state_cust;?>"> 
																	<input type="hidden" name="country_cust" value="<? echo $country_cust;?>"> 
																	<input type="hidden" name="emailadd" value="<? echo $emailadd;?>"> 
																	<input type="hidden" name="homephone" value="<? echo $homephone;?>"> 
																	<input type="hidden" name="workphone" value="<? echo $workphone;?>"> 
																	<input type="hidden" name="mobilephone" value="<? echo $mobilephone;?>"> 
																	<input type="hidden" name="referral" value="<? echo $referral;?>"> 
																	<input type="hidden" name="referralcode" value="<? echo $referralcode;?>">
																	<input type="hidden" name="hear_about" value="<? echo stripslashes($hear_about);?>"> 
																	<input type="hidden" name="specialreqs" value="<? echo stripslashes($specialreqs);?>"> 
																	<input type="hidden" name="paymentmeth" value="<? echo $paymentmeth;?>"> 
																	<input type="hidden" name="payment" value="<? echo $payment;?>">
																	<input type="hidden" name="vouchercode" value="<?=$_SESSION['vouchercode']?>">
																	<input type="hidden" name="voucher_amount" value="<?=$voucher_usage_raw?>">
																</form> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$AllPageTitle;?></title>
<script language='javascript'>
function frmnew()
{ 
	document._xclick.submit();
}
</script>
</head>

<body onLoad="frmnew();">
<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">	
<!--<form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr" method="post">		-->					
<input type="hidden" name="cmd" value="_xclick">
<!--<input type="hidden" name="business" value="admin@identibiz.com">-->
<input type="hidden" name="business" value="paymentgwtest@rediffmail.com">
<input type="hidden" name="return" value="<?=$SITE_URL;?>order_confirmed.php">
<input type="hidden" name="cancel_return" value="<?=$SITE_URL;?>order_cancel.php">
<input type="hidden" name="currency_code" value="AUD" />
<input type="hidden" name="item_name" value="IdentiKid Products">
<input type="hidden" name="amount" value="<?=$_AUTotal;?>">
<!--<input type="hidden" name="amount" value="0.01">-->
<input type="hidden" name="custom" value="<? echo $id;?>" >

<input type='hidden' 	name='no_note' 					value='1'>
<input type='hidden'	name='rm'						value='2' />
</form>
</body>
</html>
