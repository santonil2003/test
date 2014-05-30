<?
setcookie("orders_search", $_GET["orders_search"], time()+640000);
setcookie("name_search", $_GET["name_search"], time()+640000);
setcookie("label_search", $_GET["label_search"], time()+640000);
$phone_number = $_GET["phone_search"];
$phone = ereg_replace("[^0-9]", "", $phone_number);
setcookie("phone_search", $phone, time()+640000);
?>
<body onLoad="location.href='orders_admin.php?<? echo 'showperpage='.$showperpage.'&startrecord='.$startrecord;?>'"></body>

