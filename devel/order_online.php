<?

session_start();

if(!isset($_COOKIE["currency"])){

	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);

	exit;

}



include("useractions.php");

linkme();

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];

$result = mysql_query($query);

if(!$result) error_message(sql_error());



$cur = mysql_fetch_assoc($result);





?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>identi Kid - Order Online</title>

<script Language="JavaScript" src="/ezytrack.js"></script> 

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">

<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.

">

<script language="javascript" src="javascript.js"></script>

<link href="css/identikid.css" rel="stylesheet" type="text/css">

</head>



<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif','images/image_help_mo.gif')">

<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="740" valign="top"> 

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

          <td width="418" valign="top" bgcolor="#6FFF6F"> 

            <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">

              <tr valign="top"> 

                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>

                <td width="304"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>

                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>

              </tr>

              <tr valign="top"> 

                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr valign="top"> 

                      <td colspan="3" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                    </tr>

                    <tr valign="top">

                      <td width="34%" valign="middle" bgcolor="6FFF6F">

<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

                          <tr>

                            <td><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back" name="back" width="94" height="22" border="0"></a></td>

                          </tr>

                        </table></td>

                      <td width="44%" bgcolor="6FFF6F"><div align="right"><img src="images/how_to_order.gif" alt="Order Online" width="167" height="45"></div></td>

                      <td width="22%" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>

                    </tr>

                    <tr valign="top"> 

                      <td colspan="3" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                    </tr>

                  </table></td>

              </tr>

              <tr valign="top" bgcolor="#66FF66"> 

                <td colspan="3" bgcolor="#6FFF6F"> 

                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">

                    <tr> 

                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="20" height="10"></td>

                      <td width="397" valign="top" bgcolor="#FFFFFF">&nbsp;</td>

                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                    </tr>

                    <tr valign="top" bgcolor="#FFFFFF"> 

                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr> 

                            <td colspan="2"><img src="images/text_ordering_online.gif" width="137" height="23"></td>

                          </tr>

                          <tr> 

                            <td width="40%" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td><img src="images/secure_mbase.jpg" alt="Secure Orders" width="97" height="120"></td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td><img src="images/secure_credit_cards.jpg" alt="Credit Cards Accepted" width="98" height="282"></td>

                                </tr>

                              </table></td>

                            <td width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td class="maintext"><table width="70" border="0" align="right" cellpadding="0" cellspacing="0">

                                      <tr>

                                        <td><div align="right"><a href="order_online_help.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image44','','images/image_help_mo.gif',1)"><img src="images/image_help.gif" alt="Help!" name="Image44" width="58" height="37" border="0"></a></div></td>

                                      </tr>

                                    </table>

                                    <p>IdentiKid have an ever growing range of 

                                      products, all of which can be purchased 

                                      online.<br>

                                      <br>

                                      <strong>How to Order</strong><br>

                                      We have tried to make our ordering system 

                                      as easy as possible. <a href="order_online_help.php" class="type1"><br>

                                      Click here</a> for a walkthrough of how 

                                      to use our ordering system.<br>

                                      <br>

                                      <strong>Method of Payment</strong><br>

                                      Payment can be made by:<br>

                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

                                      Credit Card (online)<br>

                                      <?

																			if($_COOKIE['currency']==1){

																				?>

	                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

	                                      Deposit into IdentiKid's Account<br>

	                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

	                                      Credit Card (over the phone)<br>

	                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

	                                      Money Order (via mail)<br>

	                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

	                                      Cheque (via mail) <br>

	                                      <br>

																				<?

																			}

																			?>

                                      All online orders are taken through our 

                                      secure server, so you can be sure your details 

                                      will be safe.<br>

                                      <br>

																			Credit Cards will be debited in Australian Dollars.<br />

																			<br />

																			Conversions to your currency may differ slightly on your Credit 

																			Card statement as payments to foreign cards are processed by the banks at 

																			night and the Exchange Rate may have changed from when your order was submitted.<br />

																			<br />

																			Refunds will be made in Australian Dollars only.<br />

																			<br />

                                      <strong>NB</strong>: Any order not paid 

                                      within 10 days will be destroyed. </p>

                                    <? if($_COOKIE['currency']==1){?>

                                    <p><strong>Bank Details:</strong> Payments 

                                      can be made to <FONT face=Arial>identi Biz Pty Ltd</FONT>:<br>

                                      BSB 032-769 Acc Number 277865<br>

                                      <br>

                                      <strong>Postage &amp; Handling</strong><br>

                                      No charge for orders within Australia.<br>

                                      <br>

									  <? }else{?>

									  <strong>Postage &amp; Handling</strong><br>

									  Orders cost <? echo $cur['symbol'].$cur['postage'];?> for postage &amp; 

                                      handling and are sent via airmail. Orders 

                                      should arrive between 7-10 Days.<br><br>

									  <? }?>



<!--

                                      <strong>Free Gift for Online Orders!</strong><br>

                                      Orders <? echo $cur['symbol'].$cur['freeGift']; ?> or more receive a free gift 

                                      box!<br>

                                      This offer only applies to online orders.<br>

                                      <br>

                                      Click continue to view our products and 

                                      purchase them through the website...</p>

// -->

                                  </td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td><a href="products_home.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('continue','','images/button_continue_mo.gif',1)"><img src="images/button_continue.gif" alt="Continue" name="continue" width="94" height="22" border="0"></a></td>

                                </tr>

                              </table></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="20"></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><div align="center"><img src="images/seperator_grey_line.gif" width="95%" height="1"></div></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="20"></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/text_mail_order.gif" width="207" height="23"></td>

                          </tr>

                          <tr> 

                            <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td><a href="pdf/order form.pdf" target="_blank"><img src="images/link_download_order_form.gif" alt="Download the Order Form" width="116" height="49" border="0"></a></td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td><a href="pdf/order form.pdf" target="_blank"><img src="images/image_order_form.gif" alt="Download the Order Form" width="135" height="102" border="0"></a></td>

                                </tr>

                                <tr> 

                                  <td class="maintext"><p><a href="pdf/bworderform.pdf" target="_blank" class="type1">Black &amp; White Order 

                                      Form<br>

                                      </a>(365kB)</p>

                                  </td>

                                </tr>

                                <tr> 

                                  <td><p>&nbsp;</p>
                                  <p class="maintext"><a href="pdf/colourbrochure.pdf" class="type1">Full colour product brochure</a> (4.6MB) </p></td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td class="maintext">&nbsp;</td>

                                </tr>

                              </table></td>

                            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td class="maintext"><p>If you dont want to 

                                      order online, you can print out an order 

                                      form and mail/fax it to us.</p>

                                    <p><strong>Method of Payment</strong><br>

                                      Payment can be made by:<br>

                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

                                      Credit Card<br>

                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

                                      Cheque<br>

                                      <img src="images/spacer_trans.gif" width="8" height="10"><img src="images/black_dot.gif" width="3" height="6"> 

                                      Money Order</p>

                                    <p> <a href="pdf/order form.pdf" target="_blank" class="type1">Click 

                                      here</a> to download the printable order 

                                      form. This page is in PDF format and requires 

                                      Adobe Acrobat Reader to view. <br>

                                      <br>

                                    </p>

                                    <table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

                                      <tr> 

                                        <td width="113"><table width="89" border="0" align="right" cellpadding="0" cellspacing="0">

                                            <tr> 

                                              <td width="89"><a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank"><img src="images/logo_adobe_reader.gif" alt="Get Adobe Reader" width="89" height="32" border="0"></a></td>

                                            </tr>

                                          </table></td>

                                      </tr>

                                    </table>

                                    If you don't have Acrobat Reader installed 

                                    on your machine, you can <a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank" class="type1">download 

                                    it here</a>.</td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                              </table></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="20"></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><div align="center"><img src="images/seperator_grey_line.gif" width="95%" height="1"></div></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="20"></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/text_phone_order.gif" alt="Phone Order" width="116" height="23"></td>

                          </tr>

                          <tr> 

                            <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td><img src="images/image_phone_large.gif" alt="Phone Order" width="125" height="86"></td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                              </table></td>

                            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr> 

                                  <td>&nbsp;</td>

                                </tr>

                                <tr> 

                                  <td class="maintext">Call us and place your 

                                    order over the phone! Call<? if($_COOKIE["currency"]==1){ ?>1300 133 949<? }else{?> +61 2 6971 0969<? }?><br><br>

                                    We can be contacted 9am - 5.30pm AEST.<br> 

                                    <br>

                                    Have your credit card details handy. </td>

                                </tr>

                              </table></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="20"></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><div align="center"><img src="images/seperator_grey_line.gif" width="95%" height="1"></div></td>

                          </tr>

                          <tr> 

                            <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="20"></td>

                          </tr>

                          <tr>

                            <td colspan="2">&nbsp;</td>

                          </tr>

                        </table>

                      </td>

                    </tr>

                    <tr valign="top"> 

                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">

                          <tr> 

                            <td width="44%">&nbsp;</td>

                            <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                            <td width="52%"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image38','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back" name="Image38" width="94" height="22" border="0"></a></td>

                          </tr>

                        </table></td>

                    </tr>

                    <tr> 

                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>

                    </tr>

                    <tr bgcolor="#6FFF6F"> 

                      <td colspan="3" valign="top"><br> </td>

                    </tr>

                  </table>

                </td>

              </tr>

            </table></td>

          <td valign="top" bgcolor="FF9900"> 

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

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

