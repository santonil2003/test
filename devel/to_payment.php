<?
include("useractions.php");

linkme();
session_start();
$id = checkOrderId(false);

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

if($_POST["shopCode"]!=""){
	$refcode = $_POST["shopCode"];
}else if($_POST["centreCode"]!=""){
	$refcode = $_POST["centreCode"];
}

$query = "UPDATE customers SET oseas=".$_POST["oseas"].", firstname='".$_POST["firstname"]."', surname='".$_POST["surname"]."', address='".$_POST["address"]."', suburb='".$_POST["suburb"]
."', postcode='".$_POST["postcode"]."', state='".$_POST["state"]."', emailadd='".$_POST["emailadd"]."', homephone='".$_POST["homephone"]."', workphone='".$_POST["workphone"]
."', mobilephone='".$_POST["mobilephone"]."', referral='".$_POST["referral"]."', referralcode='".$refcode."', hear_about='".$_POST["hear_about"]."', specialreqs='".stripslashes($_POST["specialreqs"])."'"
.", paymentmeth=".$_POST["paymentmeth"]." WHERE id=".$customer;

$result = mysql_query($query);
if(!$result) error_message(sql_error());

if($_POST["paymentmeth"]==1){
?>
<body onLoad="document.forms[0].submit();">
	<form action="https://securepayments.paystream.com.au/283/index.cfm" method="post">
		<input type="hidden" name="ContactName" value="<? echo $_POST["firstname"]." ".$_POST["surname"]; ?>">
		<input type="hidden" name="ContactEmail" value="<? echo $_POST["emailadd"];?>">
		<input type="hidden" name="InvoiceNumber" value="<? echo 1000+$id; ?>">
		<input type="hidden" name="PaymentAmount" value="1.00">
	</form>
</body>
<?
}else{
	//sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);
	header("location:order_confirmed.php?orderid=".$id);
	exit;
}
?>






