<?
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=12 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Products - All</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.
">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_add_order_mo.gif','images/button_more_info_mo.gif','images/button_back_mo.gif')">
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
                      <td colspan="4" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top">
                      <td width="2%" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="33%" bgcolor="6FFF6F"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a></td>
                      <td width="42%" bgcolor="6FFF6F"><div align="right"><img src="images/heading_our_products.gif" alt="Our Products" width="167" height="45"></div></td>
                      <td width="23%" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="10" bgcolor="#FFFFFF" class="headings"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="161" bgcolor="#FFFFFF"><h1><span class="headings">Vinyl Labels</span></h1></td>
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="207" bgcolor="#FFFFFF" class="maintext"> <div align="right"><strong><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?><img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                      <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10">(19mm 
                              x 80-90mm custom sized)</td>
                            <td class="smalltext">&nbsp;</td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td width="180"><img src="images/spacer_trans.gif" width="10" height="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td bgcolor="#FFFFFF"> <div align="center"> </div>
                              <div align="center"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td valign="top"><div align="center"><img src="images/image_vinyl_lables_products.gif" alt="Vinyl Labels" width="162" height="137"></div></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="images/image_colours_girls_boys_products.gif" width="162" height="79"></td>
                                  </tr>
                                </table>
                              </div></td>
                            <td width="6">&nbsp;</td>
                            <td width="211" bgcolor="#FFFFFF" class="maintext"> 
                              <div align="left"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td valign="top" class="maintext">These labels 
                                      are popular, fun and attractive with an 
                                      assortment of five rainbow colours for boys 
                                      and <br>
                                      girls in every pack. Made from an industrial 
                                      grade highly conformable vinyl which moulds 
                                      to the shape of the surface it is applied 
                                      to . <br> <br>
                                      Our labels are a customised length so they 
                                      will always look right. They are also microwave 
                                      and dishwasher safe and UV protected. <br> 
                                      <br>
                                      The perfect label !</td>
                                  </tr>
                                </table>
                              </div></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                            <td bgcolor="#FFFFFF">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_vinyl_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info" width="94" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_vinyl_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
                                </tr>
                              </table></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="7"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="10" class="headings"><img src="images/spacer_trans.gif" width="10" height="10"> 
                                  </td>
                                  <td width="152"><h1><span class="headings">Iron on Labels</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="215" valign="top" class="maintext"> 
                                    <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong></div></td>
                                  <td width="10" valign="top" class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="11" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="2" class="smalltext"> <img src="images/spacer_trans.gif" width="10" height="10">(15mm 
                                    x 55mm)</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_iron_labels_products.gif" alt="Iron on Labels" width="162" height="196"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top">&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td colspan="2" class="maintext">One step application 
                                    with a dry iron. It&#8217;s that easy!<br> 
                                    <br>
                                    Guaranteed for up to 12 months, <br>
                                    perfect for re-selling or handing <br>
                                    down clothes. The choice of a picture also 
                                    enables little ones to recognise their own 
                                    belongings before they can read. Irons onto 
                                    all ironable fabrics. <br> <br>
                                    Not recommended with some fabric softeners.<br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="2">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_iron_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info1','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info1" width="94" height="22" border="0" id="more_info1"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_iron_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order1','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order1" width="94" height="22" border="0" id="add_order1"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="7"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"><img src="images/spacer_trans.gif" width="10" height="10"><h1><span class="headings">Mini Vinyls</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <img src="images/spacer_trans.gif" width="10" height="10">(19mm 
                                    x 50mm)</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_mini_vinyls_products.gif" alt="Mini Vinyls" width="162" height="124"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_colours_girls_boys_products.gif" width="162" height="79"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">Same quality as large vinyls 
                                    only <br>
                                    smaller for those little &#8220;hard to label&#8221; 
                                    items. <br> <br>
                                    Popular for little kids&#8217; pencil labels 
                                    too. <br> <br>
                                    Includes pic but no phone numbers.<br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_mini_vinyls.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_mini_vinyls.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">Shoe Labels</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(15mm 
                                    x 55mm)</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_shoe_lables_products.gif" alt="Shoe Labels" width="162" height="208"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top">&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">Innovative product with 
                                    a special adhesive for those hard to stick 
                                    surfaces , sized to fit even the tiniest tots&#8217; 
                                    shoes. <br> <br>
                                    Comes with a clear protective label cover 
                                    to ensure the print will never rub off.<br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_shoe_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info11','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info11" width="94" height="22" border="0" id="more_info1"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_shoe_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order11','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order11" width="94" height="22" border="0" id="add_order1"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">Pencil Labels</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(9.5mm 
                                    x 50mm)</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_pencil_labels_products.gif" alt="Pencil Labels" width="162" height="134"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_colours_girls_boys_products.gif" width="162" height="79"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">The easy way to stop fights 
                                    over pencil ownership! <br> <br>
                                    These are pre-cut and ready to use. <br> <br>
                                    Name only, no picture, font style 4 only.<br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_pencil_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info21','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info21" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_pencil_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order21','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order21" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">IdentiTAGS</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $prices[1];?> 
                                        each, 2 for <? echo $prices[2];?><img src="images/spacer_trans.gif" width="10" height="10"><br>
                                        3 for <? echo $prices[3];?> or 4 for <? echo $prices[4];?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext">&nbsp;</td>
                                  <td width="211" valign="top" class="maintext">&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><div align="left"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><img src="images/product_IDENTITAGS_skinny.gif" width="108" height="324"></div></td>
                                  <td class="maintext"><p>Make schoolbags easy 
                                      to find! </p>
                                    <p>Fantastic big bold full colour<br>
                                      bagtags just thread through zip ring and 
                                      go. </p>
                                    <p>Ideal for labelling or writing on. </p>
                                    <p>Made from ultra tough PVC for hard wear 
                                      and tear.<br>
                                    </p></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_identitags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info211','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info211" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_identitags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order211','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order211" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">KIDCARDS</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td><div align="center"> 
                                      <p class="smalltext">&nbsp;</p>
                                    </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_kidcards_products.gif" alt="Kidcards" width="162" height="174"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_kidcards_boys_girls_products.gif" alt="Various Packs" width="162" height="190" border="0"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext"><p>Big , bright and eye-catching, 
                                      these gift tags top off a gift perfectly. 
                                      Ideal for all ages, they look particularly 
                                      stunning when teamed with plain coloured 
                                      or brown paper. <br>
                                      <br>
                                      Available in packs of 12 for boys or girls 
                                      and packed in our cute gift/ storage box 
                                      so you&#8217;ll always have them on hand 
                                      when the next birthday comes up. <br>
                                      <br>
                                      Also a great idea as a gift itself. Perfect 
                                      for posting !<br>
                                      <br>
                                      These are also sold individually rrp $1.95 
                                      and in packs through selected retail outlets. 
                                    </p>
                                    <p><a href="#" class="type1">Click here to 
                                      find your closest stockist.</a></p></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_kidcards.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2111','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2111" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_kidcards.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2111','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2111" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176"><h1><span class="headings">DIY Labels</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19">Small 
                                        (38 x 4O mm) <? echo $prices[0];?><img src="images/spacer_trans.gif" width="10" height="10"><br>
                                        Large (38 x 60 mm) <? echo $prices[1];?><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td><div align="center"> 
                                      <p class="smalltext">&nbsp;</p>
                                    </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_diy_labels_large_products.gif" alt="DIY Labels - Large" width="162" height="163"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_diy_labels_small_products.gif" alt="DIY Labels - Small" width="162" height="151"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_colours_products.gif" width="162" height="42"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">These two maxi labels give 
                                    you the opportunity to let loose and design 
                                    your own labels. <br> <br>
                                    Designed to be noticed. Great for addresses. 
                                    Large vinyl labels for multipurpose use. Have 
                                    2-5 lines of text and a picture. <br> <br>
                                    Two sizes and seven colours available. Pick 
                                    two colours of your choice. <strong><br>
                                    <br>
                                    Colour Choice</strong><br>
                                    Tomato Red<br>
                                    Sky Blue<br>
                                    Sunny Yellow<br>
                                    Zesty Orange<br>
                                    Kiwi Lime<br>
                                    Lavender<br>
                                    Hot Pink<br> </td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_diy_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2112','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2112" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="products_diy_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2112','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2112" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">Starter Packs</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(Very 
                                    Popular!!!)</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_starter_pack_products_new.gif" alt="Starter Packs" width="162" height="142"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">40 vinyls<br>
                                    40 iron-ons<br>
                                    20 shoe labels<br>
                                    2 identiTags<br>
                                    30 mini labels or pencil labels<br> <br> <strong> 
                                    Conditions</strong><br>
                                    Same name, font and picture <br>
                                    throughout pack. Font 1, 3 or 4 only.<br>
                                    Choose 1 identiTag design and you will receive 
                                    2 identiTags of that design<br> 
                                    <br>
                                    A great value pack to get you started. Perfect 
                                    for all ages and uses.<br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info212','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info212" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order212','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order212" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">Mixed Packs</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(For 
                                    Families!!!)</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_mixed_packs_products.gif" alt="Mixed Packs" width="162" height="229"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">30 vinyls and 30 iron-ons<br> 
                                    <br>
                                    Same name, font and picture per pack.<br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_mixed_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2121','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2121" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_mixed_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2121','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2121" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">Birthday Packs</span></h1></td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(The 
                                    perfect gift!)</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_birthday_packs_products.gif" alt="Birthday Packs" width="162" height="340"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">30 vinyls<br>
                                    30 iron-ons<br>
                                    Giftbox<br>
                                    Gift card<br>
                                    Matching ribbon 
                                    <p>The perfect no fuss personalised present! 
                                      Tie on the card and go.</p>
                                    <p>Same name, font and picture per <br>
                                      pack.</p>
                                    <br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_birthday_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info21211','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info21211" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_birthday_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order21211','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order21211" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F">
                            <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="176" class="headings"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><h1><span class="headings">Gift 
                                    Box</td>
                                  <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="211" valign="top" class="maintext"> 
                                    <div align="left"> 
                                      <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><? echo $price['unitQuant']." for ".$price['symbol'].$price['price']?></strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                                    </div></td>
                                  <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>15cm 
                                    x 20cm</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr valign="top"> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"><img src="images/image_gift_box_white_bg.jpg" alt="Gift Box" width="137" height="134"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><div align="center"></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                      </tr>
                                    </table></td>
                                  <td class="maintext">Made exclusively for identi 
                                    Kid, these gorgeous boxes are great for storing 
                                    your labels or packaging our labels as a gift. 
                                    Also perfect for posting. 
                                    <p>&nbsp;</p>
                                    <br></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr valign="top"> 
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="44%"><a href="products_gift_box.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info212111','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info212111" width="94" height="22" border="0" id="more_info2"></a></td>
                                        <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="52%"><a href="order_gift_box.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order212111','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order212111" width="94" height="22" border="0" id="add_order2"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top"> 
                                  <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top" bgcolor="6FFF6F">
                            <td colspan="5">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
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
