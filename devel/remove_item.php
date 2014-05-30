<?
include("common_db.php");
if($_POST["id"]){
	linkme();
	$query = "DELETE FROM basket_items WHERE id=".$_POST["id"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}

header("location:view_order.php");
exit;

?>
