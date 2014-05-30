<?

$flash = $_GET["flash"];
$cookies = ($_COOKIE["test"])? true: false;


if($flash=="ok" && $cookies==true){
	if(!isset($_COOKIE["currency"])){
		?>
		<html>
		<head>
		<script>
			location.replace('index_map.php?returnurl=index_home.php');
		</script>
		</head>
		</html>
		<?
//			header("location:index_map.php?returnurl=index_home.php");
	}else{
		?>
		<html>
		<head>
		<script>
			location.replace('index_home.php');
		</script>
		</head>
		</html>
		<?
//		header("location:index_home.php");
	}
	exit;
}else{
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<TITLE>identiKid - Test results</TITLE>
<META NAME="keywords" CONTENT="identikid,label,labels,vinyl,iron,on,mini,shoe,pencil,diy,pack,packs,starter,mixed,birthday,kidcards,card,bag,tag,gift,box,school,kindergarden
lost,property,clothing">
<META NAME="description" CONTENT="Personalised name labels that really work. Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more. Design your own labels online, with your choice of fun fonts and pictures. All products are high quality, attractive and easy to use.">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/identikid.css" rel="stylesheet" type="text/css">

<script language="javascript">
function openIt(){
	win = window.open('http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash', 'macpop');
	
}
</script>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif">
	<table width="711" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td colspan="3"><img src="images/browser_test_title.gif" width="718" height="133" border="0"></td>
	  </tr>
	  <tr>
	  	<td width="174" valign="top" bgcolor="FFFFFF"><img src="images/images_left.gif" alt="identi Kid" width="172" height="458"></td>
		<td bgcolor="FFFFFF" width="10"><img src="images/spacer_trans.gif" width="10" height="1" border="0"></td>
		<td bgcolor="FFFFFF" width="545" valign="top">
			<table cellpadding="0" cellspacing="0" border="0">
			  <tr>
				<td><img src="images/spacer_trans.gif" width="100" height="15" border="0"></td>
				<td><img src="images/spacer_trans.gif" width="10" height="1" border="0"></td>
				<td><img src="images/spacer_trans.gif" width="100" height="15" border="0"></td>
			  </tr>
			  <tr>
			  	<td colspan="3" class="headings">Browser test results:</td>
			  </tr>
			  <tr>
				<td><img src="images/spacer_trans.gif" width="1" height="50" border="0"></td>
			  </tr>
			  <tr class="maintext">
			  	<td>Flash plugin installed?</td>
				<td><img src="images/spacer_trans.gif" width="1" height="1" border="0"></td>
				<td><strong><? echo ($flash=="ok") ? "<font color=\"#009900\">Yes</font>":"<font color=\"#CC0000\">No</font>";?></strong></td>
			  </tr>
			  <tr>
				<td><img src="images/spacer_trans.gif" width="1" height="10" border="0"></td>
			  </tr>
			  <tr class="maintext">
			  	<td>Cookies enabled?</td>
				<td><img src="images/spacer_trans.gif" width="1" height="1" border="0"></td>
				<td><strong><? echo ($cookies==true) ? "<font color=\"#009900\">Yes</font>":"<font color=\"#CC0000\">No</font>";?></strong></td>
			  </tr>
			  <tr>
				<td><img src="images/spacer_trans.gif" width="1" height="50" border="0"></td>
			  </tr>
			  <tr>
			  	<td class="maintext" colspan="3">You will need to have the flash plugin installed and <br>cookies enabled to use this site. To do this please<br>follow these instructions:</td>
			  </tr>
			  <tr>
				<td><img src="images/spacer_trans.gif" width="1" height="50" border="0"></td>
			  </tr>
			  <tr>
			  	<td class="maintext" colspan="3">You can download the flash plugin here: <a href="javascript: openIt();">Macromedia</a><br />
						<br />
						If you don't want to install flash, you can view our printable order form here: <a href="pdf/Identikid%20A4%20%20page%20order%20f.pdf">Printable Order Form</a></td>
			  </tr>
			  <tr>
				<td><img src="images/spacer_trans.gif" width="1" height="10" border="0"></td>
			  </tr>
			  <tr>
			  	<td class="maintext" colspan="3">To enable cookies, if you're using Internet Explorer, go to<br>Tools &gt; Internet Options, then click the Security tab,<br>and move the slider to Medium-Low or Low.</td>
			  </tr>
			</table>
		</td>
	  </tr>
  <tr> 
    <td height="30" colspan="3"> 
      <?php include "footer.php" ?>
    </td>
  </tr>
  	</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
 </body>
 </html>
	<?
}
?>
