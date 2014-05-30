<?
include("useractions.php");

$submittype = $_POST["submittype"];

linkme();
session_start();
$id = $_POST["orderid"];

if(!$id){
	header("location:view_order.php");
	exit;
}

$query = "SELECT * FROM orders WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata = mysql_fetch_array($result)){
	$customer = $qdata["customer"];
}


if($_POST["paymentmeth"]=="1"){
	$cc = $_POST["cc1"]."-".$_POST["cc2"]."-".$_POST["cc3"]."-".$_POST["cc4"];
	$nameoncard = $_POST["nameoncard"];
	$payment = $_POST["payment"];
	$expiry = $_POST["expirymonth"]."/".$_POST["expiryyear"];
	$seccode = $_POST["seccode"];
}else{
	$cc = "";
	$nameoncard = "";
	$payment = "";
	$expiry = "";
	$seccode = "";
}

$query = "UPDATE customers SET oseas=".$_POST["oseas"].", firstname='".$_POST["firstname"]."', surname='".$_POST["surname"]."', address='".$_POST["address"]."', suburb='".$_POST["suburb"]
."', postcode='".$_POST["postcode"]."', state='".$_POST["state"]."', country='".$_POST["country"]."', emailadd='".$_POST["emailadd"]."', homephone='".$_POST["homephone"]."', workphone='".$_POST["workphone"]
."', mobilephone='".$_POST["mobilephone"]."', referral='".$_POST["referral"]."', referralcode='".$_POST["referralcode"]."', hear_about='".$_POST["hear_about"]."', specialreqs='".stripslashes($_POST["specialreqs"])."', paymentmeth=".$_POST["paymentmeth"].", payment='".$payment."', nameoncard='".$nameoncard
."', ccxx='".$cc."', expdate='".$expiry."', seccode='".$seccode."', confirmed='".$submittype."' WHERE id=".$customer;


$result = mysql_query($query);
if(!$result) error_message(sql_error());

if($submittype=="unconfirmed"){
	header("location:order_confirmation.php?orderid=".$id);
}else{
	sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);
	header("location:order_confirmed.php?orderid=".$id);
}
exit;
?>