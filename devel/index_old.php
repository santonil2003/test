<?php
setcookie("test", "ok", time()+3600);
session_start();
unset($_SESSION['vouchercode']);
if(($_GET['fundraiser']) && ($_GET['fundraiser'] != '') && ($_GET['referrer']) && ($_GET['referrer'] != '')){
	$_SESSION['fundraiser'] = '';
	unset($_SESSION['fundraiser']);
	$_SESSION['fundraiser'] = $_GET['fundraiser'];
	$_SESSION['referrer'] = '';
	unset($_SESSION['referrer']);
	$_SESSION['referrer'] = $_GET['referrer'];
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Labels, name tags, fund raising – identi Kid online</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content="Labels & name tags for everything supplied by Identi Kid. Hassle-free fund raising with personalised labels from Identi Kid.  Quality name tags in clothing can help reduce the loss of personal property. Put labels onto anything leaving the house.">
<meta name="keyword" content="Labels, name tags, fund raising, label, clothing tag, personal labels, iron-on tags, school bag,  easy fundraising, pencil, labels, vinyl label, allergy, gift cards, identikid">
<meta name="robots" content="index, follow">
</head>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<body bgcolor="d4d0c8" background="images/bg_pattern.gif">

<span class="maintext">Testing your plugins and cookies ...</span>


<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,0,0" width="80" height="80">
<param name="movie" value="images/flash_detection.swf?flashContentURL=index_testresults.php?flash=ok&altContentURL=index_testresults.php?flash=no&contentVersion=5&contentMajorRevision=0&contentMinorRevision=0&allowFlashAutoInstall=false">
<param name="quality" value="low">
<embed src="images/flash_detection.swf?flashContentURL=index_testresults.php?flash=ok&altContentURL=index_testresults.php?flash=no&contentVersion=5&contentMajorRevision=0&contentMinorRevision=0&allowFlashAutoInstall=false" quality="low" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="80" height="80">
</embed>
</object>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>

</body>
</html>
