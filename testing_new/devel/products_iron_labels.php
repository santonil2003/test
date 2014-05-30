<?
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");
define('PRODUCT_ID',2);

linkme();

//$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=2 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$query = "	SELECT * 
			FROM prices a, currencies b, product c 
			WHERE a.productId = c.id 
			AND a.productId=".PRODUCT_ID." 
			AND a.currencyInt=".$_COOKIE["currency"]." 
			AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);
$title = $price['productName'];

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Products - <?=$title?></title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Iron-on label, iron on labels ">
<meta name="description" content="Colourful, wash safe iron on labels for clothes. Childrens iron on labels come printed with fun pictures that you choose.">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_add_order_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="index.php"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
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
                    <tr valign="top"> 
                      <td width="15"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="193" bgcolor="#FFFFFF"><h1><span class="headings"><?=$title?></span></h1></td>
                      <td width="16"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="161" bgcolor="#FFFFFF" class="maintext"> 
                        <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong></div></td>
                      <td width="33"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="11" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="244" valign="top"> <table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left">(15mm x 55mm) </div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="141" valign="top" class="smalltext">&nbsp;</td>
                            <td width="12" rowspan="11" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td><img src="images/spacer_trans.gif" width="10" height="10"> 
                                    <div align="center"><img src="images/products_iron_Labels.gif" alt="Iron on Labels" width="168" height="201"></div></td>
                                </tr>
                              </table>
                              <div align="center"></div></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td> <table width="200" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="186" class="headings"><div align="left"> 
                                      <table width="191" border="0" cellspacing="0" cellpadding="0">
<tr> 
                                          <td width="12"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                          <td width="179"><h1><span class="headings">Actual  Size</span></h1></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                </tr>
                              </table></td>
                            <td class="headings">&nbsp;</td>
                            <td class="headings">&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="3%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="97%"><div align="center"><img src="images/products_iron_labels_actual.gif" alt="Iron on Labels - Actual Size" width="234" height="82"></div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td class="maintext">                                    <p> Our iron on labels are applied in one step with a dry iron. It&rsquo;s that easy! </p>
                                    <p> Guaranteed for up to 12 months, perfect for re-selling or handing down clothes. The choice of a picture on your iron-on label also enables little ones to recognise their own belongings before they can read. Our labels iron onto all ironable fabrics.</p>
                                    <p> Our <!--colourful -->range of iron on clothing labels are perfect for people of all ages.</p>
                                    <p> Please note that the iron on labels are not recommended with some fabric softeners.                                  </p>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_iron_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
                                </tr>
                              </table>
							                                <br>                                   
                              <br>
                              <hr width="100%" size=1>
								
                                    <h1><span class="headings">Other identiKid products </span></h1>
                                    <?PHP
									require_once("./products_include.php");
									?></p></td>
                          </tr>
                          <tr> 
                            <td colspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="5" valign="top">&nbsp;</td>
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
                      <td valign="top">
					  <?php include "navigation.php"; ?>
					  </td>
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
