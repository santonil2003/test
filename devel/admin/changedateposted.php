<?
include("../common_db.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

$dateposted = mktime(0,0,0,$_POST["monthposted"], $_POST["dayposted"], $_POST["yearposted"]);

echo "STOP";

$query = "UPDATE orders SET dateposted='".date("Y-m-d 00:00:00", $dateposted)."', postal_tracking_number='" . $_POST['postal_tracking_number'] ."' WHERE id=".$id;

$result = mysql_query($query);
if(!$result) error_message(sql_error());

header('location:orders_admin.php?showperpage='.$showperpage.'&startrecord='.$startrecord.'&showprinted='.$showprinted.'&showpayment='.$showpayment.'&showprocess='.$showprocess.'&showposted='.$showposted);
exit;

?>