<? 
//print_r($_POST);
//include("../_common/_common_db.php");
require_once('../_common/_constants.php');

//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
//end db setup

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

if ($_POST['archived']=='true'){
$query = "UPDATE customers_archive SET specialreqs='".mysql_real_escape_string($_POST['requirements'])."' WHERE id='".$_POST['id']."'";
} else {
$query = "UPDATE customers SET specialreqs='".mysql_real_escape_string($_POST['requirements'])."' WHERE id='".$_POST['id']."'";
}

$result = mysql_query($query);
if(!$result) error_message(sql_error());

header('location:orders_admin.php?showperpage='.$showperpage.'&startrecord='.$startrecord.'&showprinted='.$showprinted.'&showpayment='.$showpayment.'&showprocess='.$showprocess.'&showposted='.$showposted);
exit;
?>