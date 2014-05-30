<?
include("_common/_connection.php");
include("_common/_database.php");
if($_POST["id"]){
	linkme();
	$query = "DELETE FROM basket_items WHERE id=".$_POST["id"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}

header("location:my_order.php");
exit;

?>
