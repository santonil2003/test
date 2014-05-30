<?
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$query = "SELECT * FROM prices a, currencies b, product c WHERE (a.productId=8 OR a.productId=9) AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id ORDER BY a.productId";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$k=0;
$prices=array();
while ($price = mysql_fetch_assoc($result)) {
	$prices[$k] =  $price['unitQuant']." for ".$price['symbol'].$price['price'];
	$k++;
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Products - DIY Labels</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="do it yourself labels, DIY label, diy labelling">
<meta name="description" content="Two sizes of DIY labels for all types of application. Lots of colours to choose from with pictures & 5 lines of text.">
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
                      <td bgcolor="6FFF6F"><div align="right"><strong><img src="images/heading_our_products.gif" alt="Our Products" width="167" height="45"></strong></div></td>
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
                      <td width="16"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="108" bgcolor="#FFFFFF"><h1><span class="headings">DIY Labels</span></h1></td>
                      <td width="74"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="219" bgcolor="#FFFFFF"> 
                        <div align="left"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
                              <td class="maintext"><div align="right"><strong> 
                                  Small (38 x 40mm)<br><? echo $prices[0];?><img src="images/spacer_trans.gif" width="4" height="10"></strong></div></td>
                            </tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
                            <tr> 
                              <td class="maintext"><div align="right"><strong>Large 
                                  (38 x 60mm)<br>
                                  <? echo $prices[1];?><img src="images/spacer_trans.gif" width="4" height="10"></strong></div></td>
                            </tr>
                          </table>
                        </div></td>
                      <td width="1">&nbsp;</td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="15" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="10" rowspan="15" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="70%"><div align="center"><img src="images/products_diy_labels.gif" alt="DIY Labels" width="365" height="191"></div></td>
                                </tr>
                              </table>
                              <div align="center"></div></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><table width="200" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><img src="images/products_diy_colours.gif" alt="Colour Choices" width="173" height="48"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" class="headings"><table width="260" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="13"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="247"><h1><span class="headings">Large (Actual Size)</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="61%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td> <div align="left"></div>
                                          <div align="left"> 
                                            <table width="120" border="0" cellspacing="0" cellpadding="0">
                                              <tr> 
                                                <td width="11"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                                <td width="109" class="headings"><img src="images/products_diy_labels_large_actual.gif" alt="DIY Labels - Large - Actual Size" width="246" height="154"></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                  <td width="2%" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="37%"><table width="110" border="0" align="right" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td><a href="order_diy_large.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add Large DIY Label to order" name="add_order" width="94" height="22" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" class="headings"><table width="260" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="250"><h1><span class="headings">Small (Actual Size)</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="61%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td><div align="left"> 
                                            <table width="120" border="0" cellspacing="0" cellpadding="0">
                                              <tr> 
                                                <td width="11"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                                <td width="109" class="headings"><img src="images/products_diy_labels_small_actual.gif" alt="DIY Labels - Small- Actual Size" width="182" height="156"></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                  <td width="2%" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="37%"><table width="110" border="0" align="right" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td><a href="order_diy_small.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order1','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add Small DIY Label to order" name="add_order1" width="94" height="22" border="0" id="add_order1"></a></td>
                                      </tr>
                                    </table></td>
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
                                  <td class="maintext"><br>
                                    <p> These two DIY labels give you the opportunity to create your own co-it-yourself labels.</p>
                                    <p> These colourful labels are designed to be noticed and are great for addresses. Use the large vinyl labels for multi purposes. Have 2-5 lines of text and a picture.</p>
                                    <p> Two sizes and seven colours available. Pick two colours of your choice for your own DIY labels.<br> 
                                      <br> 
                                      <strong>Colour 
                                    Choice</strong><br>
                                    Tomato Red, Sky Blue, Sunny Yellow, Zesty 
                                    Orange, Kiwi Lime, Lavender, Hot Pink</p>
                                    </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="110" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="64%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back to previous page" name="back" width="94" height="22" border="0"></a></td>
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
