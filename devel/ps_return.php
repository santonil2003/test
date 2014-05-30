<?
include("useractions.php");
linkme();
$query = "SELECT customer, ordertype FROM orders WHERE id=".($_POST["InvoiceNumber"]-1000);

$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata=mysql_fetch_array($result)){
	$customer = $qdata["customer"];
	$ordertype = $qdata["ordertype"];
}

$query = "SELECT approved FROM customers WHERE id=".$customer;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata=mysql_fetch_array($result)){
	$approved = $qdata["approved"];
}

if($ordertype=="Phone/fax"){
	deleteOrderId(($_POST["InvoiceNumber"]-1000));
	header("location:admin/viewitem.php?id=".($_POST["InvoiceNumber"]-1000));
}else{
	if($approved==1){
		header("location:order_confirmed_ps.php?orderid=".($_POST["InvoiceNumber"]-1000));
	}else{
		header("location:order_confirmation_ps.php?orderid=".($_POST["InvoiceNumber"]-1000))."&approved=".$qdata["approved"];
	}
}
?>