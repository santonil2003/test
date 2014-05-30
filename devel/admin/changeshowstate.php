<?
setcookie($_GET["which"], $_GET["to"], time()+640000);
if($_GET["which"]=="fundraisershow"){
?>
<body onLoad="location.href='fundraisers.php'"></body><?
}else{
?>
<body onLoad="location.href='orders_admin.php?<? echo 'showperpage='.$showperpage.'&startrecord='.$startrecord;?>'"></body>
<? }?>
