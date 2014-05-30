<?
$includeabove=true;
include("../useractions.php");
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

$id = checkOrderId(false);

// lose current order if made so far
if($id!=false){
	deleteOrderId($id);
}


linkme();
if(isset($_POST["currency"])){
	$query = "SELECT * FROM currencies WHERE id=".$_POST["currency"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	if(mysql_num_rows($result)>0){
		$curr = $_POST["currency"];
	}
}
if(!isset($curr)){
	// default to Australia
	$curr = 1;
}

setcookie("currency", $curr);

if(isset($_GET["returnurl"])){
	$url = $_GET["returnurl"];
}else{
	$url = "index_home.php";
}


// redirect in javascript so cookie sticks

?>

<html>
<head></head>
<body onload="location.href='addphoneorder.php'"></body>
</html>
