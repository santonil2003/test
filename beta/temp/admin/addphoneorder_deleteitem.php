<?

include("../common_db.php");

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

if($_GET["itemid"]){

	$query = "DELETE FROM basket_items WHERE id=".$_GET["itemid"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}

header("location:addphoneorder.php");
exit;

?>