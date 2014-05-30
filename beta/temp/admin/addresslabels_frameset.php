<?
include("required.php");
linkme();
session_start();
$user_section_id = 5;
require_once("./security.php");
check_access($user_section_id);


$items = split(";",$_GET["id"]);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Address Printer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<frameset frameborder="0" rows="100,*">
	<frame name="controller" src="addresslabels_control.php?type=<? echo $_GET["type"];?>&id=<? echo $_GET["id"];?>&startTS=<? echo $_GET["startTS"]?>&endTS=<? echo $_GET["endTS"];?>&order_ids=<? echo $_GET["order_ids"];?>">
	<frame name="viewer" src="addresslabels_labels.php?page=1&id=<? echo $_GET["id"];?>&type=<? echo $_GET["type"];?>">
</frameset>
<noframes></noframes>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
</body>
</html>
