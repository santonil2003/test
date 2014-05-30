<?
include("../common_db.php");

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

$query = "UPDATE orders SET archived=0 WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());

header("location:orders_admin.php");
?>