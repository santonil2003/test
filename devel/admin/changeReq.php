<? 
//print_r($_POST);
include("../common_db.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

if ($_POST['archived']=='true'){
$query = "UPDATE customers_archive SET specialreqs='".$_POST['requirements']."' WHERE id='".$_POST['id']."'";
} else {
$query = "UPDATE customers SET specialreqs='".$_POST['requirements']."' WHERE id='".$_POST['id']."'";
}

$result = mysql_query($query);
if(!$result) error_message(sql_error());

header('location:orders_admin.php?showperpage='.$showperpage.'&startrecord='.$startrecord.'&showprinted='.$showprinted.'&showpayment='.$showpayment.'&showprocess='.$showprocess.'&showposted='.$showposted);
exit;
?>