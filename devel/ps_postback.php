<?
include("useractions.php");
linkme();
$query = "SELECT customer FROM orders WHERE id=".($_POST["InvoiceNumber"]-1000);
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata=mysql_fetch_array($result)){
	$customer = $qdata["customer"];
	$ordertype = $qdata["ordertype"];
}

$query = "UPDATE customers SET approved=".$_POST["rApproved"]." WHERE id=".$customer;
$result = mysql_query($query);
if(!$result) error_message(sql_error());

//mail("mark@boo-lah.com", "test email", "rApproved: ".$_POST["rApproved"]."\nrApprovedText:".$_POST["nrApprovedText"]);

if($_POST["rApproved"]==1 || $_POST["rApproved"]=="1"){
	$query = "SELECT firstname, surname, emailadd FROM customers WHERE id=".$customer;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata=mysql_fetch_array($result)){
		if($ordertype=="Phone/fax"){
			$fromadmin=true;
		}
		sendNewOrder(($_POST["InvoiceNumber"]-1000), $qdata["firstname"]." ".$qdata["surname"], $qdata["emailadd"], "Credit Card - Paystream");
	}
}
?>