<?
// set explicit form variables
$id 			= $_REQUEST['order_id'];
$order_status	= $_REQUEST['orderstatus'];
$showperpage 	= $_REQUEST['showperpage'];
$startrecord 	= $_REQUEST['startrecord'];


include("../common_db.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);
if (isset($_REQUEST['updatestatus']) && $id!='') {
  $query = "UPDATE orders SET status='".$order_status."' WHERE id=".$id;
  $result = mysql_query($query);
  if(!$result) error_message(sql_error());
} 


$returnurl = $_SERVER['HTTP_REFERER']."&startrecord=$startrecord&showperpage=$showperpage";

header("location:$returnurl");
exit(0);
?>