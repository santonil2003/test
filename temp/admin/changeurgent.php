<?
include("../common_db.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);


$query = "UPDATE orders SET urgent='{$_GET['checked']}' WHERE id='{$_GET['id']}'";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

if($fromviewer==true){
	header('location:viewitem.php?showperpage='.$showperpage.'&startrecord='.$startrecord.'&id='.$id);
}else{
	header('location:orders_admin.php?showperpage='.$showperpage.'&startrecord='.$startrecord);
}
exit;
?>