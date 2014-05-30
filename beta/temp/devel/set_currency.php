<?
include("useractions.php");
session_start();

$id = checkOrderId(false);

// lose current order if made so far
if($id!=false){
	deleteOrderId($id);
}


linkme();
if(isset($_GET["countryId"])){
	// 2005.09.16 previous programmer error.
	
	// for some reason, the flash file is set to NZ as currency 4 but in the DB NZ's id is 5??? therefore NZ customers were being treated as AUS customers and getting no postage.
	// if the countryId comes through as 4, convert to 5 incase in the website there is code somewhere references countryId 5.
	
	if((int)$_GET['countryId'] == 4)
	{
		$countryID = (int)5;
	}
	else 
	{
		$countryID = (int)$_GET['countryId'];
	}
	
	$query = "SELECT * FROM currencies WHERE id=".(int)$countryID;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	if(mysql_num_rows($result)>0){
		$curr = $countryID;
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
<body onload="location.replace('<?  echo $url;?>'); "></body>
</html>