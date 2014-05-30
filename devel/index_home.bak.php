<?
include("useractions.php");
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}

linkme();
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);

$query = "SELECT * FROM prices WHERE productId=10 AND currencyInt=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$starter = mysql_fetch_assoc($result);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
<title>Labels, name tags, fund raising – identi Kid online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content="Labels & name tags for everything supplied by Identi Kid. Hassle-free fund raising with personalised labels from Identi Kid.  Quality name tags in clothing can help reduce the loss of personal property. Put labels onto anything leaving the house.">
<meta name="keyword" content="Labels, name tags, fund raising, label, clothing tag, personal labels, iron-on tags, school bag,  easy fundraising, pencil, labels, vinyl label, allergy, gift cards, identikid">
<meta name=“robots" content=“index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/identikid.css" rel="stylesheet" type="text/css"> 
<script Language="JavaScript" src="/ezytrack.js"></script> 
<script language="javascript" src="javascript.js"></script>
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_add_order_mo.gif','images/button_more_info_mo.gif');">
<table width="711" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top"> 
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="718" height="371" id="home_top" align="middle">
	<param name="movie" value="images/home_top.swf?mydynamic=ascascascac" />
	<param name="quality" value="high" />
	<param name="bgcolor" value="#5b7ab3" />
	<embed src="images/home_top.swf?mydynamic=ascascascac" quality="high" bgcolor="#5b7ab3" width="718" height="371" name="home_top" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
	</td>
  </tr>
  <tr> 
	<td width="174" rowspan="2" valign="top" background="images/bg_left_column_home.gif" bgcolor="FFEB33">&nbsp;</td>
	<td width="209" valign="top" bgcolor="FFEB33"> 
      <table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="1" bgcolor="FFEB33">&nbsp;</td>
          <td width="147">&nbsp;</td>
          <td width="10">&nbsp;</td>
        </tr>
        <tr valign="middle"> 
          <td colspan=3 align="center"><p><img src="images/images_front_new_identitags.gif" alt="New! identiTAGS"><br>
            <br />
                <a href="products_identitags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image29','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="Image29" width="94" height="22" border="0"></a>
                <a href="order_identitags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image30','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="Image30" width="94" height="22" border="0"></a>
</p>
          <p>&nbsp;          </p></td>

        </tr>
        <tr> 
          <td width="1" bgcolor="FFEB33">&nbsp;</td>
          <td width="147">&nbsp;</td>
          <td width="10">&nbsp;</td>
        </tr>
		        <tr> 
          <td width="1" bgcolor="FFEB33">&nbsp;</td>
          <td width="147" bgcolor="#FF9900" class="whitetext"><div align="left">
              <table width="175" border="0" cellspacing="0" cellpadding="7">
<tr>
                  <td width="175"><span class="whitetext"><font size="4">Important!</font><br>
                    <font size="2">This website requires:</font> </span> 
<table width="161" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="47"> <div align="center"><img src="images/flash_icon.gif" width="18" height="19"></div></td>
                        <td width="114" class="whitetext"> Flash player</td>
                      </tr>
                      <tr> 
                        <td><div align="center"><img src="images/cookies_icon.gif" width="18" height="18"></div></td>
                        <td class="whitetext">Cookies enabled</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="whitetext"><a href="more_info.php" class="type2"><font size="2"><strong>more 
                          info</strong></font></a></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div></td>
          <td width="10">&nbsp;</td>
        </tr>
		<tr> 
          <td width="1" bgcolor="FFEB33">&nbsp;</td>
          <td width="147">&nbsp;</td>
          <td width="10">&nbsp;</td>
        </tr>
        <tr> 
          <td width="1"><img src="images/spacer_trans.gif" width="21" height="10"></td>
          <td> 
		  <? if($_COOKIE["currency"]==1 && false){
		  	?><a href="competition.php"><img src="images/competition.gif" alt="Win a Laptop" width="175" height="250" border="0"></a><?
		  }elseif(false){
			  ?>
		  <table border="0" align="left" cellpadding="0" cellspacing="0">
				  <tr> 
					<td width="86"><img src="images/logo_text.gif" alt="identi Kid" width="86" height="37"></td>
					<td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
				  </tr>
			</table>
				<p class="maintext"> <br>
				  now into its third year, was designed around a product that is practical, 
				  high quality, innovative and above all something that will save 
				  you time and money. <br>
              <br>
              <strong><a href="about_us.php" class="type1"><font size="2" face="Comic Sans MS">Read 
              More...</font></a></strong><font size="2" face="Comic Sans MS"><a href="#"><strong> 
              </strong></a></font> 
              <?
		  }
		  ?>
            </p>
		  </td>
          <td width="10">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td class="maintext">&nbsp; </td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="5d7eb9" width="335"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top" bgcolor="f0027f">
		  <table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="10" rowspan="7" valign="top"><img src="images/spacer_trans.gif" width="15" height="10"></td>
                <td colspan="2" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                <td width="19" rowspan="7" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
              </tr>
              <tr> 
                <td colspan="2" valign="top" class="whitetext"><div align="center"><img src="images/text_easywayout1.gif" alt="The Easy Way Out" width="290" height="50"></div></td>
							</tr>

							<tr>
								<td colspan="2" align="center" class="whitetext"><strong>$64 Value for $55.Buy and Save.</strong></td>
              </tr>
              <tr> 
                <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="10"></td>
             </tr>

              <tr> 
                <td width="147" valign="top"><img src="images/image_starterpack_home.gif" alt="Start Pack" width="147"></td>
                <td width="171" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="8"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="152" class="whitetext">The perfect <strong>QUICK</strong> 
                        option</td>
                    </tr>
                    <tr> 
                      <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td valign="top" class="whitetext"> <table width="100%" border="0" cellpadding="0" cellspacing="0" class="whitetext">
                          <tr> 
                            <td valign="top"><img src="images/point_white_circle_pink_bg.gif" width="16" height="16"></td>
                            <td valign="top">Great value - <? echo $cur['symbol'].$starter['price'];?></td>
                          </tr>
                          <tr> 
                            <td valign="top"><img src="images/point_white_circle_pink_bg.gif" width="16" height="16"></td>
                            <td valign="top">Perfect for all ages.</td>
                          </tr>
                          <tr> 
                            <td valign="top"><img src="images/point_white_circle_pink_bg.gif" width="16" height="16"></td>
                            <td valign="top">Will label everything you need.<br>
                              <br>
                            </td>
                          </tr>
                        </table> </td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td valign="top"><div align="center"><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/button_add_order_mo.gif',1)"><strong></strong></a><strong><a href="products_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image24','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="Image24" width="94" height="22" border="0"></a></strong> 
                  </div>
<div align="right"><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/button_add_order_mo.gif',1)"><strong></strong> 
                    </a><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/button_add_order_mo.gif',1)"> 
                    </a></div></td>
                <td valign="top"><div align="center"><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image25','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="Image25" width="94" height="22" border="0"></a></div></td>
              </tr>
              <tr> 
                <td colspan="2" valign="top"><img src="images/spacer_trans.gif" width="10" height="20"></td>
              </tr>
            </table></td>
        </tr>
		<tr> 
			<td height="202" valign="top" bgcolor="5D7EB9">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="11" rowspan="4" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="11" rowspan="4" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                      <td height="35" valign="top"> 
                        <div align="right"><img src="images/iron_on_advert.gif" alt="New Baby Gift Voucher Giveaway" width="301" height="174"></div></td>
                    </tr>
                    <tr> 
                      <td valign="top" bgcolor="#5D7EB9"> <p align="right">                            <a href="products_coloured_ironons.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image291','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="Image291" width="94" height="22" border="0" id="Image291"> </a></p>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
				</tr>
			  </table></td>
	    </tr>
      </table>
      </td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FF9900"><table width="100%" border="0" cellspacing="0" cellpadding="17">
      <tr>
        <td><p> <span class="whitetext"><img src="images/home_pirate.jpg" alt="Pirate - Bag Tag" width="87" height="104" hspace="5" vspace="5" align="left"><b>identi Kid</b> offers a range of labels that are practical, high quality and innovative. Our labels are also fabulous for fund raising opportunities and will save you time and money. </span></p>
          <p class="whitetext"><b>identi Kid</b> offer an ever growing range of labels which can be safely purchased online. If you need labels for your children&rsquo;s clothing &amp; property then take a look through our fantastic selection. </p>
          <p class="whitetext">Our name tags are 100% guaranteed and we pride ourselves on a successful business in terms of quality, service and pricing. <b>identi Kid</b> have proven to be a perfect fund raising idea. </p>
          <p class="whitetext">Design your own labels online, with a choice of fonts and pictures. All <b>identi Kid</b> name tags are high quality, attractive and very easy to use. Fund raising is very easy with <b>identi Kid</b> labels because we deliver the labels directly to your customers and there is no extra work. </p>
          <p class="whitetext"><img src="images/home_surferGirl.jpg" alt="Surfer Girl - Bag Tag" width="90" height="100" hspace="5" vspace="5" align="right"><b>identi Kid&rsquo;s</b> vinyl labels are very popular for fund raising, and come in an attractive assortment of rainbow coloured labels for boys and girls. Identify your kid&rsquo;s belonging&rsquo;s with name tags for school, daycare or kindergarten. </p>
          <p class="whitetext">Use our fun vinyl labels on anything you do not wish to lose! Use name tags to identify toys, lunchboxes, musical instruments or sports equipment. It is also the easiest way to do any kind of fund raising. </p>
          <p class="whitetext">Vinyl labels can be used everywhere - beach gear, sporting gear, toys &amp; books even CD&rsquo;s. They are also microwave and dishwasher safe and UV protected. </p>
          <p class="whitetext">Our vinyl labels can be a hassle free way of fund raising. With personalised name tags on everything that goes to school, your child can easily locate their belongings. Children lose less school stationery if you put name tags on their pens and pencils. You can use vinyl labels for any items your kids take to school. </p>
          <p class="whitetext">Fund raising could not be easier. Order online and the product is delivered directly to the customer &ndash; no extra work. </p>
          <p class="whitetext">By using a picture on your iron-on name tags the kids are able to recognise their own belongings before they can read. </p>
          <p class="whitetext"><img src="images/home_frog.jpg" alt="Frog - Bag Tag" width="98" height="99" hspace="5" vspace="5" align="left">Our shoe labels are an innovative product with special adhesive for hard to stick surfaces. </p>
          <p class="whitetext"><b>identi Kid&rsquo;s</b> colourful range of name tags &amp; labels are perfect for everyone. </p>
          </td>
      </tr>
    </table></td>
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
