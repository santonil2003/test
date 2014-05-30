<?
// set explicit form variables
//print_r($_REQUEST);
$to 			= $_REQUEST['to'];
$id 			= $_REQUEST['id'];
$order_ids 		= $_REQUEST['orders'];
$order_array 	= explode(",", $order_ids);
$showperpage 	= $_REQUEST['showperpage'];
$startrecord 	= $_REQUEST['startrecord'];
$showunfinished = $_REQUEST['showunfinished'];
$fromviewer 	= $_REQUEST['fromviewer'];

include("../common_db.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

if (isset($_REQUEST['id']) && $id!='') {
  if($to=="posted"){
	  $query = "UPDATE orders SET status='".$to."', dateposted='".date("Y-m-d 00:00:00")."' WHERE id=".$id;
  }else{
	  $query = "UPDATE orders SET status='".$to."', dateposted='0000-00-00 00:00:00' WHERE id=".$id;
  }
  $result = mysql_query($query);
  if(!$result) error_message(sql_error());
} else if(isset($_REQUEST['orders'])) {
  $dateposted = mktime(0,0,0,$_GET["monthposted"], $_GET["dayposted"], $_GET["yearposted"]);
  foreach($order_array as $id) {
    if($to=="posted"){
	  $query = "UPDATE orders SET status='".$to."', dateposted='".date("Y-m-d 00:00:00", $dateposted)."' WHERE id=".$id;
    }else{
	  $query = "UPDATE orders SET status='".$to."', dateposted='0000-00-00 00:00:00' WHERE id=".$id;
    }
	$result = mysql_query($query);
    if(!$result) error_message(sql_error());
  }
}

if($fromviewer==true){
	header('location:viewitem.php?showperpage='.$showperpage.'&startrecord='.$startrecord.'&id='.$id);
}else{
	header('location:orders_admin.php?showperpage='.$showperpage.'&startrecord='.$startrecord);
}
exit;
?>