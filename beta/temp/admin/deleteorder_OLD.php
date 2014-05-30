<?
include("../common_db.php");

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);


if($_GET["archive"]!="false"){
	$query = "UPDATE orders SET archived=1 WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}else{
	$query = "DELETE FROM basket_items WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	$query = "SELECT * FROM orders WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$customer = $qdata["customer"];
	}
	
	$query = "DELETE FROM orders WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	$query = "DELETE FROM customers WHERE id=".$customer;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}
header("location:orders_admin.php");
?>