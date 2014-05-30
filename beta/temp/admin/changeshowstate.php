<?
setcookie($_GET["which"], $_GET["to"], time()+640000);
if($_GET["which"]=="fundraisershow"){
?>
<body onLoad="location.href='fundraisers.php'"></body><?
}elseif($_GET["which"]=="intl_range"){
?>
 <body onLoad="location.href='orders_intl_admin.php?<? echo 'showperpage='.$showperpage.'&startrecord='.$startrecord.'&range='.$_GET["which"];?>'"></body>	
<? }else{
?>
<body onLoad="location.href='orders_admin.php?<? echo 'showperpage='.$showperpage.'&startrecord='.$startrecord.'&range='.$_GET["which"];?>'"></body>
<? }
