<?
session_start();

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=1 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Products - Vinyl Labels</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="fundraising ideas, fundraiser, school fundraisers, raise funds ">
<meta name="description" content="Creative school fundraising ideas using fantastic products that children and parents love. Very easy to signup and start raising funds for your school.">
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
                      <td width="15"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="135" bgcolor="#FFFFFF"><h1><span class="headings">Vinyl Labels</span></h1></td>
                      <td width="15"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="253" bgcolor="#FFFFFF" class="maintext"> 
                        <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div>
                      </td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="11" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="210" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="11" class="smalltext"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                  <td width="199" class="smalltext"><div align="left">(19mm 
                                      x 80-90mm custom sized)</div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="143" valign="top" class="smalltext">&nbsp;</td>
                            <td width="10" rowspan="11" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td bgcolor="#FFFFFF"><div align="left"> 
                                <table width="120" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="11"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                    <td width="109" class="headings"><img src="images/products_vinyl_labels.gif" alt="Vinyl Labels" width="190" height="223"></td>
                                  </tr>
                                </table>
                              </div></td>
                            <td>&nbsp;</td>
                            <td valign="middle" bgcolor="#FFFFFF" class="maintext"><div align="left"><img src="images/products_colours_girls_boys.gif" alt="Girls and Boys Colours" width="90" height="76"></div></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td> <table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="headings"> <div align="left"> 
                                      <table width="175" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="48"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                          <td width="127"class="headings">Actual Size</td>
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
                            <td colspan="3"><table width="120" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="11"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                  <td width="109" class="headings"><img src="images/products_vinyl_labels_actual.gif" alt="Vinyl Labels - Actual Size" width="313" height="91"></td>
                                </tr>
                              </table>
                              <div align="left"></div></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td class="maintext"><p><br>
                                    These vinyl labels are popular, fun and attractive with an assortment of five rainbow colours for boys and girls in every pack. Made from an industrial grade highly conformable vinyl which moulds to the shape of the surface it is applied to. </p>
                                    <p>Our vinyl labels are a customised length so they will always look right. They are also microwave and dishwasher safe and UV protected.</p>
                                    <p><strong> Perfect vinyl labels for all uses ! </strong><br>
                                      <br>
                                    <strong>Where can you use our vinyls ??</strong></p>
                                    <p><strong><font color="#6666CC">Beach Gear&#8230;</font></strong> 
                                      balls, buckets, spades, umberellas, floaties, 
                                      flippers&#8230;.</p>
                                    <p><strong><font color="#66CC33">Sporting 
                                      Gear&#8230;.</font></strong> Bats, Balls, 
                                      Tennis Raquets, Hockey sticks, Knee and 
                                      elbow pads&#8230;.</p>
                                    <p><strong><font color="#FF0066">Toys&#8230;&#8230;..</font></strong>things 
                                      getting dragged to school for news / show 
                                      and tell, toys going to friends houses, 
                                      the park etc</p>
                                    <p> <strong><font color="#FF9900">Bikes</font></strong><font color="#FF9900">,</font> 
                                      scooters skateboards&#8230;&#8230;.</p>
                                    <p><strong><font color="#FF0000">School / 
                                      Daycare / Kindy&#8230;..</font></strong> 
                                      lunch bottles, drinkbottles ,toothbrush, cutlery, 
                                      pencils, rulers &#8230;&#8230;</p>
                                    <p><strong><font color="#6666CC">Picnic Gear/ 
                                      Camping Gear&#8230;&#8230;</font></strong>Family 
                                      labels&#8230;.</p>
                                    <p><strong><font color="#66CC33">Books, CDs</font></strong><font color="#66CC33">&#8230;&#8230;&#8230;&#8230;&#8230;</font>use 
                                      your imagination !</p>
                                    <p>  Use our fun vinyl labels on anything you cant afford to replace! </p>
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
                                  <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to the previous page" name="back" width="94" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_vinyl_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
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
                            <td colspan="5" valign="top"><p>&nbsp;</p></td>
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
