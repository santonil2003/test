<?

session_start();

require_once("./constants.php");
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
<script language="JavaScript" type="text/JavaScript">

<!--

function MM_popupMsg(msg) { //v1.0

  alert(msg);

}



function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}



function disp_alert()

{

alert("ZipTags cannot be ordered online just yet. please call IdentiKid direct to order these. Thank you for your patience")

}



function disp_alert2()

{

alert("Address Labels cannot be ordered online just yet. please call IdentiKid direct to order these. Thank you for your patience")

}

//-->

</script>
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_add_order_mo.gif','images/button_more_info_mo.gif','images/button_back_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
          <td width="418" valign="top" bgcolor="6FFF6F"> <table width="418" border="0" cellspacing="0" cellpadding="0">
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
                    <?



$result = product_details(1, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . " bright labels for " . $product['symbol'].$product['price'];

                    

                    ?>
                    <tr valign="top"> 
                      <td colspan="6"> <table width="100%">
                          <tr> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td bgcolor="#FFFFFF"><span class="headings">
                              <?= $product['productName']; ?>
                              </span></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td nowrap bgcolor="#FFFFFF" class="maintext"> <div align="right"><strong>
                                <?= $price_formatted; ?>
                                <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                            <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                          </tr>
                        </table></td>
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
                                    <td valign="top"><img src="images/image_colours_girls_boys_products.gif" alt="Colours Available" width="162" height="79"></td>
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
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <?



$result = product_details(2, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="5" class="smalltext"> <img src="images/spacer_trans.gif" width="10" height="10">(15mm 
                              x 55mm)</td>
                            <td colspan="1">&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                            <td colspan="4" class="maintext">One step application 
                              with a dry iron. It&#8217;s that easy!<br> <br>
                              Guaranteed for up to 12 months, <br>
                              perfect for re-selling or handing <br>
                              down clothes. The choice of a picture also enables 
                              little ones to recognise their own belongings before 
                              they can read. Irons onto all ironable fabrics. 
                              <br> <br>
                              Not recommended with some fabric softeners.<br></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="7"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="2">&nbsp;</td>
                            <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_iron_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info1','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info1" width="94" height="22" border="0" id="more_info1"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_iron_labels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order1','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order1" width="94" height="22" border="0" id="add_order1"></a></td>
                                </tr>
                              </table></td>
                            <td >&nbsp;</td>
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
                          <?



$result = product_details(3, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="5" class="smalltext"> <img src="images/spacer_trans.gif" width="10" height="10">(15mm 
                              x 55mm)</td>
                            <td colspan="1">&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                                  <td valign="top"><div align="center"><img src="images/image_colours_girls_boys_products.gif" alt="Colours Available" width="162" height="79"></div></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                            <td class="maintext">Same quality as large vinyls 
                              only <br>
                              smaller for those little &#8220;hard to label&#8221; 
                              items. <br> <br>
                              Popular for little kids&#8217; pencil labels too. 
                              <br> <br>
                              Includes pic but no phone numbers.<br></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                          <?



$result = product_details(4, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(15mm 
                              x 55mm)</td>
                            <td>&nbsp;</td>
                            <td width="10" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                            <td class="maintext">Innovative product with a special 
                              adhesive for those hard to stick surfaces , sized 
                              to fit even the tiniest tots&#8217; shoes. <br> 
                              <br>
                              Comes with a clear protective label cover to ensure 
                              the print will never rub off.<br></td>
                            <td width="10" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                          <?



$result = product_details(5, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(9.5mm 
                              x 50mm)</td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                                  <td valign="top"><div align="center"><img src="images/image_colours_girls_boys_products.gif" alt="Colours Available" width="162" height="79"></div></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                            <td class="maintext">The easy way to stop fights over 
                              pencil ownership! <br> <br>
                              These are pre-cut and ready to use. <br> <br>
                              Name only, no picture, font style 4 only.<br></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                          <?



$result = product_details(19, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(12.5-15 
                              mm X 50-55mm )</td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><img src="images/products_coloured_ironons_s.gif" alt="Coloured Iron Ons" width="162" height="202" border="0"></td>
                            <td class="maintext"><UL>
                                <LI>12.5-15 mm X 50-55mm (custom sized) 
                                <LI>Choose one background colour and black or 
                                  white text 
                                <LI>Rounded corners with white backing for light 
                                  clothing 
                                <LI>Soft and smooth for sensitive skin 
                                <LI>Revolutionary material actually becomes part<BR>
                                  of the fabric its ironed onto!</LI>
                                <li><SPAN class=453471508-18082005>Permanent transfers</SPAN></li>
                                <li><SPAN class=453471508-18082005>Can be used 
                                  in industrial washers and dryers. </SPAN></li>
                                <li><SPAN class=453471508-18082005>Good for nursing 
                                  homes.</SPAN><BR>
                                </li>
                              </UL>
                              <br></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_coloured_ironons.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info213','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info213" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_coloured_ironons.php"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
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
                          <?



$result = product_details(20, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(Approx 
                              3cm diameter)</td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><img src="images/PAGE_PRODUCT_SHOE_DOTS_sm.gif" alt="Shoe Dots" width="162" height="218"></td>
                            <td class="maintext"><P>Our shoe labels are an innovative 
                                product with special adhesive for those hard to 
                                stick surfaces , sized to fit even the tiniest 
                                tots&rsquo; shoes.</P>
                              <DIV> 
                                <UL>
                                  <LI>Approx 3cm diameter 
                                  <LI>No more lost shoes. 
                                  <LI>These cute and fun round labels help you 
                                    kids identify their shoes easily! 
                                  <LI>Fits down to the tiny tots. 
                                  <LI>Clear covers to ensure no print fade with 
                                    heavy wear. 
                                  <LI>Choose one background colour and black or 
                                    white text</LI>
                                </UL>
                              </DIV>
                              <br></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_shoe_dots.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info214','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info214" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_shoe_dots.php"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
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
                          <?





db_get_field("SELECT productName FROM product WHERE id=14", &$product_name);



// identitags

$prices = array();

$sql = "SELECT * FROM prices_identitags JOIN currencies ON (prices_identitags.currencyInt=currencies.id) WHERE prices_identitags.currencyInt=" . (int)$currency . " ORDER BY multiplier";

$result = db_query($sql);

if($result == true)

{

	while($record = db_fetch_array($result))

	{

		$prices[$record['multiplier']] = $record['symbol'].$record['price'];

	}

}



                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product_name; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $prices[1]; ?>
                                      each, 2 for 
                                      <?= $prices[2]; ?>
                                      <br />
                                      3 for 
                                      <?= $prices[3]; ?>
                                      or 4 for 
                                      <?= $prices[4]; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext">&nbsp;</td>
                            <td width="211" valign="top" class="maintext">&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="180"><div align="left"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><img src="images/product_IDENTITAGS_1.gif" alt="IdentiTAGS"></div></td>
                            <td class="maintext"><p>Make schoolbags easy to find! 
                              </p>
                              <p>Fantastic big bold full colour<br>
                                bagtags just thread through zip ring and go. </p>
                              <p>Ideal for labelling or writing on. </p>
                              <p>Made from ultra tough PVC for hard wear and tear.<br>
                                <br>
                                <img src="images/identitag_bag.gif" alt="IdentiTAGS"> 
                              </p></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                    <?

		// Zip Tags

	$result = product_details(22, $_COOKIE['currency'], $product);

	$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	$result2 = product_details(23, $_COOKIE['currency'], $product);

	$price_formatted2 = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="176" class="headings"><span class="headings">Zip 
                              Tags </span></td>
                            <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="211" valign="top" class="maintext"> <div align="left"> 
                                <p align="right"><strong>
                                  <?= $price_formatted; ?>
                                  <!--3 for AU$8 -->
                                  &nbsp;or 
                                  <!--5 for 

                                  AU$12-->
                                  <?= $price_formatted2; ?>
                                  </strong><img src="images/spacer_trans.gif" width="10" height="10"><br>
                                </p>
                              </div></td>
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td class="smalltext">(50x30mm)</td>
                            <td width="211" valign="top" class="maintext">&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td><div align="left"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><img src="images/ziptag_1.jpg" alt="Zip Tags"></div></td>
                            <td class="maintext"><p>Attach these cute PVC tags 
                                to your zippers.</p>
                              <p>Great for clothing, pencil cases, keys and bags. 
                              </p>
                              <p>Can be permantly printed on back $1 each tag 
                                (same name per pack).</p>
                              <p><img src="images/ziptag_new.gif" alt=""></p>
                              <p><br>
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
                                  <td width="44%"><a href="products_ziptags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info211','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info211" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order211" width="94" height="22" border="0" id="add_order2" onclick="disp_alert()"></a></td>
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
                    <?

	// ADDRESS LABELS

	$result = product_details(24, $_COOKIE['currency'], $product);

	$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	$result2 = product_details(25, $_COOKIE['currency'], $product);

	$price_formatted2 = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	$result3 = product_details(26, $_COOKIE['currency'], $product);

	$price_formatted3 = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

	

	?>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="176" class="headings"><span class="headings">Address 
                              Labels </span><br> <span class="smalltext">(20x55mm)</span></td>
                            <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="211" valign="top" class="maintext"> <div align="left"> 
                                <p align="right"><STRONG>
                                  <?= $price_formatted; ?>
                                  <BR>
                                  <?= $price_formatted2; ?>
                                  <BR>
                                  <?= $price_formatted3; ?>
                                  </STRONG><BR>
                                  <br>
                                </p>
                              </div></td>
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td class="smalltext"></td>
                            <td width="211" valign="top" class="maintext"></td>
                          </tr>
                          <tr valign="top"> 
                            <td><div align="left"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong><img src="images/address_labels.gif" alt="Zip Tags"></div></td>
                            <td class="maintext"><p>Available in 8 colours printed 
                                on clear. </p>
                              <p>Pic of choice and 4 lines of print.</p>
                              <p><img src="images/ziptag_new.gif" alt=""></p>
                              <p><br>
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
                                  <td width="44%"><a href="products_addresslabels.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info211','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info211" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order211" width="94" height="22" border="0" id="add_order2" onclick="disp_alert2()"></a></td>
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
                          <?



$result = product_details(7, $_COOKIE['currency'], $product);

$price_formatted = "Pack of 12 for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
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
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="maintext"><p>Big , bright and eye-catching, 
                                these gift tags top off a gift perfectly. Ideal 
                                for all ages, they look particularly stunning 
                                when teamed with plain coloured or brown paper. 
                                <br>
                                <br>
                                Available in packs of 12 for boys or girls and 
                                packed in our cute gift/ storage box so you&#8217;ll 
                                always have them on hand when the next birthday 
                                comes up. <br>
                                <br>
                                Also a great idea as a gift itself. Perfect for 
                                posting !<br>
                                <br>
                                These are also sold individually rrp $1.95 and 
                                in packs through selected retail outlets. </p>
                              <p><a href="#" class="type1">Click here to find 
                                your closest stockist.</a></p></td>
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
                          <?



$result = product_details(8, $_COOKIE['currency'], $product);

$price_formatted_small = "Small (38 x 4O mm) " . (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];



$result = product_details(9, $_COOKIE['currency'], $product);

$price_formatted_large =  "Large (38 x 60 mm) " . $product['symbol'].$product['price'];



                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">DIY 
                                    Labels</span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted_small; ?>
                                      </strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="3">&nbsp;</td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted_large; ?>
                                      </strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><div align="center"> 
                                <p class="smalltext">&nbsp;</p>
                              </div></td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                                  <td valign="top"><div align="center"><img src="images/image_colours_products.gif" alt="Colours Available" width="162" height="42"></div></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                            <td class="maintext">These two maxi labels give you 
                              the opportunity to let loose and design your own 
                              labels. <br> <br>
                              Designed to be noticed. Great for addresses. Large 
                              vinyl labels for multipurpose use. Have 2-5 lines 
                              of text and a picture. <br> <br>
                              Two sizes and seven colours available. Pick two 
                              colours of your choice. <strong><br>
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
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <?



$result = product_details(21, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                    <tr valign="top"> 
                      <td colspan="7"> <table width="100%">
                          <tr> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td bgcolor="#FFFFFF"><span class="headings">
                              <?= $product['productName']; ?>
                              </span></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td nowrap bgcolor="#FFFFFF" class="maintext"> <div align="right"><strong>
                                <?= $price_formatted; ?>
                                <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                            <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(Very 
                        Popular!!!)</td>
                      <td>&nbsp;</td>
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td valign="top"><div align="center"><img src="images/products_colourmyworld_packs_small.gif" alt="Starter Packs" width="162" height="137"></div></td>
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
                      <td class="maintext"><p>40 vinyls <br>
                          40 coloured iron-ons (Permanent)<br>
                          10 shoe dots<br>
                          1 identiTag <br>
                          30 mini labels or pencil pack</p>
                        <p><strong>Conditions <br>
                          </strong>Same name, font, picture and detail throughout 
                          pack of labels. Rainbow set A or B.</p>
                        <p> A great value labelling pack to get you started. Perfect 
                          for all ages and uses.<br>
                        </p></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="44%"><a href="products_colourmyworld_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2123','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2123" width="94" height="22" border="0" id="more_info2"></a></td>
                            <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="52%"><a href="order_colour_my_world_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2123','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2123" width="94" height="22" border="0" id="add_order2"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="6FFF6F"> 
                      <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr valign="top" bgcolor="6FFF6F"> 
                      <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <?



$result = product_details(10, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(Very 
                              Popular!!!)</td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><div align="center"><img src="images/image_starter_pack_products_new.gif" alt="Starter Packs" width="162" height="137"></div></td>
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
                              1 identiTag<br>
                              30 mini labels or pencil labels<br> <br> <strong> 
                              Conditions</strong><br>
                              Same name, font and picture <br>
                              throughout pack.<br>
                              Font 1, 3 or 4 only.<br>
                              Choose 1 identiTag design.<br> <br>
                              A great value pack to get you started. Perfect for 
                              all ages and uses.<br></td>
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
                    <tr valign="top" bgcolor="6FFF6F"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <?



$result = product_details(16, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><div align="center"><img src="images/products_new_baby_packs_sm.gif" alt="New Baby Packs" width="162" height="125"></div></td>
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
                            <td class="maintext">40 mini labels<br>
                              20 iron-ons<br>
                              1 identiTag<br>
                              1 presentation / storage envelope<br>
                              1 Kidcard<br> <br>
                              Dont double up on more teddies and baby clothes. 
                              Give something unique that any new mum will really 
                              find useful!<br></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_new_baby_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2122','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2122" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_new_baby_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2122','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2122" width="94" height="22" border="0" id="add_order2"></a></td>
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
                          <?



$result = product_details(17, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><div align="center"><img src="images/products_shared_packs_small.gif" alt="Shared Packs" width="162" height="205"></div></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                              </table></td>
                            <td class="maintext"><p>Share 60 labels for 2 children 
                                - 30 each</p>
                              <p>identiKid is so flexible, you can now split our 
                                mini's, vinyl's and iron on's between 2 kids and 
                                in any combination !</p>
                              <p> Choose 2 products from the examples, 1 for each 
                                child , and each will receive recieve 30 labels 
                                in your choice of colour combination. ( 60 labels 
                                total )<br>
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
                                  <td width="44%"><a href="products_shared_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info21222','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info21222" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_shared_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order21222','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order21222" width="94" height="22" border="0" id="add_order2"></a></td>
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
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <?



$result = product_details(11, $_COOKIE['currency'], $product);

$price_formatted = $product['symbol'].$product['price'] . " per child";

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(For 
                              Families!!!)</td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                      <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <?



$result = product_details(18, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext">&nbsp; </td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="180"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"><div align="center"><img src="images/products_AllergyAllerts_small.gif" alt="Allergy Allert" width="137" height="203"></div></td>
                                </tr>
                              </table></td>
                            <td class="maintext"><p>Choose from 60 Vinyl Labels 
                                or 60 Mini Vinyls</p>
                              <p>Great for alerting others of dietary/allergy 
                                allert for children and adults that may find it 
                                difficult to communicate there needs. </p></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_allergy_alert.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info2121','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info2121" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_allergy_alert.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order2121','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order2121" width="94" height="22" border="0" id="add_order2"></a></td>
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
                          <?



$result = product_details(12, $_COOKIE['currency'], $product);

$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].$product['price'];

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>(The 
                              perfect gift!)</td>
                            <td>&nbsp;</td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                              1 presentation / storage envelope<br>
                              1 Kidcard<br> <p>The perfect no fuss personalised 
                                present! Tie on the card and go.</p>
                              <p>Same name, font and picture per pack.<br>
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
                          <?



$result = product_details(13, $_COOKIE['currency'], $product);

$price_formatted = $product['symbol'].$product['price'] . " each";

                    

                    ?>
                          <tr valign="top"> 
                            <td colspan="7"> <table width="100%">
                                <tr> 
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td bgcolor="#FFFFFF"><span class="headings">
                                    <?= $product['productName']; ?>
                                    </span></td>
                                  <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td nowrap bgcolor="#FFFFFF" class="maintext"> 
                                    <div align="right"><strong>
                                      <?= $price_formatted; ?>
                                      <img src="images/spacer_trans.gif" width="10" height="19"></strong></div></td>
                                  <td width="20"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="2" rowspan="3"> <p> <span class="maintext"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong>15cm 
                                x 20cm </span></p>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><div align="center"><img src="images/image_gift_box_white_bg.jpg" alt="Presentation / Storage Envelope" width="137" height="134"></div></td>
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
                              </table>
                              <img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="198" valign="top" class="maintext"> </td>
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td class="maintext">Made exclusively for identi Kid, 
                              these gorgeous boxes are great for storing your 
                              labels or packaging our labels as a gift. Also perfect 
                              for posting. 
                              <p>&nbsp;</p>
                              <br></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="76">&nbsp;</td>
                            <td width="124">&nbsp;</td>
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
                      <td colspan="5"><img src="images/spacer_trans.gif" width="25" height="25"></td>
                    </tr>
                    <tr valign="top" bgcolor="6FFF6F"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr valign="top"> 
                            <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="176" class="headings"><img src="images/spacer_trans.gif" width="10" height="10"><span class="headings">Gift 
                              Vouchers</span></td>
                            <td width="10" rowspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="211" valign="top" class="maintext"> <div align="left"> 
                                <p align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19">$Variable</strong><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></p>
                              </div></td>
                            <td width="10" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td class="smalltext"> <strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top"><div align="center"><img src="images/image_gift_vouchers_small.gif" alt="Gift Vouchers" width="162" height="137"></div></td>
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
                            <td class="maintext"><p><strong>Fun</strong> - Bright, 
                                cute designs and gorgeous pratical products<br>
                                <strong>Personal</strong> - What could be more 
                                personal than ID products!<br>
                                <strong>Quick </strong>- Posted to you within 
                                24hrs of receiving payment<br>
                                <strong>Easy</strong> - A gift voucher and gift 
                                card in one!<br>
                                <strong>Flexible</strong> - You decide on the 
                                $, the recipient decides on the product.... perfect 
                                for everyone!<br>
                                <strong>Convenient</strong> - Postable with a 
                                45c stamp</p></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="44%"><a href="products_gift_voucher.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('more_info21221','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="more_info21221" width="94" height="22" border="0" id="more_info2"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="products_gift_voucher.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order21221','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order21221" width="94" height="22" border="0" id="add_order2"></a></td>
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
</tr> </table> 
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
