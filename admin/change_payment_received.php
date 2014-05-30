<?
//include("../common_db.php");
include("required.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

$query = "UPDATE orders SET payment_received='{$_GET['checked']}' WHERE id='{$_GET['id']}'";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

if($_GET['checked'] == "1" ) $active = '1';
else $active = '0';

$sql="SELECT * FROM basket_items WHERE type = '44' AND ordernumber = '{$_GET['id']}'";
$result = mysql_query($sql);
if(mysql_num_rows($result) > 0){
  while($row = mysql_fetch_array($result)){
    $sql2 ="UPDATE voucher SET active = '$active' WHERE recipient_id = ".$row['id']." LIMIT 1 ";
    mysql_query($sql2);
  }
}

if($fromviewer==true){
	header('location:viewitem.php?showperpage='.$showperpage.'&startrecord='.$startrecord.'&id='.$id);
}else{
	header('location:orders_admin.php?showperpage='.$showperpage.'&startrecord='.$startrecord);
}
exit;
?>