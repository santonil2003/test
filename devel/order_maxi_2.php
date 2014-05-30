<?
session_start();
header("Cache-control: private");

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

// store the user data in sessions for the wizard steps
$_SESSION['maxi_pack1']['symbol'] = $_POST['symbol'];
$_SESSION['maxi_pack1']['phoneVal'] = $_POST['phoneVal'];
$_SESSION['maxi_pack1']['picVal'] = $_POST['picVal'];
$_SESSION['maxi_pack1']['kidsName'] = $_POST['kidsName'];
$_SESSION['maxi_pack1']['kidsPhone'] = $_POST['kidsPhone'];
$_SESSION['maxi_pack1']['split'] = $_POST['split'];
$_SESSION['maxi_pack1']['chosenPic'] = $_POST['chosenPic'];
$_SESSION['maxi_pack1']['background_colour'] = $_POST['background_colour'];
$_SESSION['maxi_pack1']['font_colour'] = $_POST['font_colour'];
$_SESSION['maxi_pack1']['quantdesc'] = $_POST['quantdesc'];
$_SESSION['maxi_pack1']['type'] = $_POST['type'];

//print_r($_POST);
//print_r($_SESSION);

linkme();

$result = product_details(34, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - <?= $product['productName']; ?></title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#5D7EBC">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="6FFF6F">
<table width="418" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_our_products.gif" alt="Our Products" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="4"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4">
                      <table width="100%" border=0 bgcolor="#FFFFFF">
                      	<tr>
                      		<td bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      		<td valign="top" bgcolor="#FFFFFF"><h1 class="headings"><?= $product['productName']; ?></h1></td>
                      		<td align="right" bgcolor="#FFFFFF" class="maintext"><strong><?= $price_formatted; ?></strong></td>
                      		<td bgcolor="#FFFFFF" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      	</tr>
                      	
                          
                          <tr valign="top"> 
                          	<td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td bgcolor="#FFFFFF"><?
if($result == true)
{
	?><!--<script type="text/javascript" src="javascript/order_maxi_shoe.js"></script>-->
		<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
		codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="350" HEIGHT="907"  id="prod" ALIGN="">
		<PARAM NAME=movie VALUE="images/order_maxi_shoe.swf?kidsName=<?=$_SESSION['maxi_pack1']['kidsName']?>&kidsPhone=<?=$_SESSION['maxi_pack1']['kidsPhone']?>&chosenPic=<?=$_SESSION['maxi_pack1']['pic']?>">
		<PARAM NAME=quality VALUE=high>
		<PARAM NAME=bgcolor VALUE=#FFFFFF>
		<EMBED src="images/order_maxi_shoe.swf?kidsName=<?=$_SESSION['maxi_pack1']['kidsName']?>&kidsPhone=<?=$_SESSION['maxi_pack1']['kidsPhone']?>&chosenPic=<?=$_SESSION['maxi_pack1']['pic']?>" quality=high bgcolor=#FFFFFF  WIDTH="350" HEIGHT="907"  NAME="prod" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
		</OBJECT>
	<?
}
else 
{
	display_error('There was an error loading the prices for this product', true);
}

?></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="30" height="30"></td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="5" valign="top">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE600">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top" bgcolor="#FFE600">
					  
					  <?php include "navigation.php"; ?></td>
                    </tr>
                    <tr> 
                      <td bgcolor="#FFE600"> 
                        <?php include "orders.php" ?>                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top" bgcolor="#5D7EBC"> 
            <?php include "footer.php" ?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
