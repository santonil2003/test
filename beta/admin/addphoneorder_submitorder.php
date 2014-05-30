<?
if(!isset($useractions)){
	$includeabove = true;
	include("../useractions.php");
}

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);
$id = checkOrderId(false);

if(!$id){
	header("location:addphoneorder.php");
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

if($_POST["shopCode"]!=""){
	$refcode = $_POST["shopCode"];
}else if($_POST["centreCode"]!=""){
	$refcode = $_POST["centreCode"];
}

$query = "UPDATE customers SET oseas=".$_POST["oseas"].", firstname='".$_POST["firstname"]."', surname='".$_POST["surname"]."', address='".$_POST["address"]."', suburb='".$_POST["suburb"]
	."', postcode='".$_POST["postcode"]."', state='".$_POST["state"]."', country='".$_POST["country"]."', emailadd='".$_POST["emailadd"]."', homephone='".$_POST["homephone"]."', workphone='".$_POST["workphone"]
	."', mobilephone='".$_POST["mobilephone"]."', referral='".$_POST["referral"]."', referralcode='".$_POST["referralcode"]."', hear_about='".$_POST["hear_about"]
	."', specialreqs='".stripslashes($_POST["specialreqs"])."', paymentmeth=".$_POST["paymentmeth"].", confirmed='".$submittype."' WHERE id=".$customer;

$result = mysql_query($query);
if(!$result) error_message(sql_error());

if($_POST["paymentmeth"]!="1"){
	if($_POST["emailadd"]!=""){
		$fromadmin=true;
		sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);
	}
}else{
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	if(mysql_num_rows($result)>0){
		while($qdata = mysql_fetch_array($result)){
			$totalprice += $qdata["price"];
		}
	}
}

deleteOrderId($id);
header("location:viewitem.php?id=".$id);
exit;
?>