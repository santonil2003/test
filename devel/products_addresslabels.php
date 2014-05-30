<?

session_start();



if(!isset($_COOKIE["currency"])){

	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);

	exit;

}



include("useractions.php");



linkme();



/*

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];

$result = mysql_query($query);

if(!$result) error_message(sql_error());



$cur = mysql_fetch_assoc($result);





$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";

$result = mysql_query($query);

if(!$result) error_message(sql_error());



$k=0;

while($qdata = mysql_fetch_array($result)){

	$k++;

	$prices[$k] = $cur['symbol'].$qdata['price'];

}*/

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=22 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";

$result = mysql_query($query);

if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);



$query2 = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=23 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";

$result2 = mysql_query($query2);

if(!$result2) error_message(sql_error());

$price2 = mysql_fetch_assoc($result2);





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>identi Kid - Products -Address Labels</title>

<script Language="JavaScript" src="/ezytrack.js"></script> 

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<meta name="keywords" content="identiTAGS, childrens zipper tags">



<meta name="description" content="These great range of  tags will look great on your childrens school bags. Plenty of bright colours and fun pictures for the kids to choose.">



<script language="javascript" src="javascript.js"></script>

<script language="JavaScript" type="text/JavaScript">



function disp_alert()

{

alert("ZipTags cannot be ordered online just yet. please call IdentiKid direct to order these. Thank you for your patience")

}



function disp_alert2()

{

alert("Address Labels cannot be ordered online just yet. please call IdentiKid direct to order these. Thank you for your patience")

}

</script>



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

                      <td width="13"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                      <td width="138" bgcolor="#FFFFFF"><h1><span class="headings">Address Labels</span></h1></td>

                      <td width="12"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                      <td width="255" bgcolor="#FFFFFF" class="maintext"> 

					  <?

	// ADDRESS LABELS

	$result = product_details(24, $_COOKIE['currency'], $product);

	$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	$result2 = product_details(25, $_COOKIE['currency'], $product);

	$price_formatted2 = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	$result3 = product_details(26, $_COOKIE['currency'], $product);

	$price_formatted3 = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	?>

                        <div align="right"><strong>

                          <?= $price_formatted; ?>

                          <!--3 for AU$8-->

                        </strong><img src="images/spacer_trans.gif" alt="spacer" width="10" height="10"><strong><BR>

                        </strong><STRONG>

                        <?= $price_formatted2; ?>

                        </STRONG><img src="images/spacer_trans.gif" alt="spacer" width="10" height="10"><strong><BR>

                        </strong><STRONG>

                        <?= $price_formatted3; ?>

                        </STRONG><img src="images/spacer_trans.gif" alt="spacer" width="10" height="10"></div>

                      </td>

                    </tr>

                    <tr valign="top"> 

                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">

                          <tr bgcolor="#FFFFFF"> 

                            <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                            <td colspan="3" valign="top" class="smalltext">

<div align="center">

<p><img src="images/address_labels2.gif" alt="Zip Tags">                                </p>

</div>

                              <div align="center"></div></td>

                            <td rowspan="5" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                          </tr>

                          <tr valign="top"> 

                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>

                          </tr>

                          <tr valign="top"> 

                            <td colspan="3"> <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                                  <td valign="top" class="maintext"><p>Available in 8 colours printed on clear. </p>

                                  <p>Pic of choice and 4 lines of print.</p></td>

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

                                  <td width="52%"><a href="order_addresslabels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>

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

