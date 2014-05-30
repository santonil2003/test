<?
session_start();

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$result = product_details(28, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

$result2 = product_details(29, $_COOKIE['currency'], $product);
$price_formatted2 = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$price2 = ((int)form_param('chosenQuant') + 1) * $product['price'];

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Products - ZipDeDo Dots</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="childrens shoe labels, sneaker label, running shoes">

<meta name="description" content="Our special range of glossy, adhesive shoe labels for school children. Sticks to all surfaces and the name never rubs off.">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                      <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr>
                    <td colspan="4">
                      <table width="100%" border=0>
                      	<tr>
                      		<td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      		<td valign="top"><h1 class="headings">ZipDeDo Dots</h1></td>
                      		<td align="right" class="maintext"><strong><?= $price_formatted; ?><br><?= $price_formatted2; ?></strong></td>
                      		<td ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      	</tr>
                      </table>
                      </td>
                     </tr>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr valign="top" bgcolor="#FFFFFF">
                            <td width="10" rowspan="7" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="10" rowspan="7" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="70%"><div align="center"></div></td>
                                </tr>
                              </table>
                              <div align="center"></div></td>
                          </tr>
                          <tr valign="top"> 
                            <td><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td><img src="images/spacer_trans.gif" width="30" height="20"></td>
                          </tr>
                          <tr valign="top"> 
                            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="maintext"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                  <td class="maintext"><p> Perfect for sticking 
                                      on your ZipTags!<br>
                                      <img src="images/products_zipdedo.gif" width="373" height="154"><br>
                                      Our Zipdedo Dots are perfectly designed 
                                      to compliment our ziptags</p>
                                    <p>White vinyls dots with a black print that 
                                      fits perfectly on your ziptags.<br>
                                      Ziptags are great for pencil cases toiletries,laces,keys 
                                      and virtually anything you can attatch them 
                                      to!!!</p>
                                    <p>ZipDeDo Dots come in packs of 10 and 20. 
                                    </p>
<DIV></DIV></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td><img src="images/spacer_trans.gif" width="30" height="15"></td>
                          </tr>
                          <tr valign="top"> 
                            <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_zipdedo_dots.php"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
                                </tr>
                              </table>
                              <br> <br> <hr width="100%" size=1> <h1><span class="headings">Other 
                                identiKid products </span></h1>
                              <?PHP
									require_once("./products_include.php");
									?></p>
                            </td>
                          </tr>
                          <tr> 
                            <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="3" valign="top">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top"><?php include "navigation.php"; ?></td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php" ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
