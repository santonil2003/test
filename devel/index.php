<?php
	session_start();
	setcookie("test", "ok", time()+3600);
	unset($_SESSION['vouchercode']);
	if(($_GET['fundraiser']) && ($_GET['fundraiser'] != '') && ($_GET['referrer']) && ($_GET['referrer'] != '')){
		$_SESSION['fundraiser'] = '';
		unset($_SESSION['fundraiser']);
		$_SESSION['fundraiser'] = $_GET['fundraiser'];
		$_SESSION['referrer'] = '';
		unset($_SESSION['referrer']);
		$_SESSION['referrer'] = $_GET['referrer'];
	}
	
	$cookies = ($_COOKIE["test"])? true: false;
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
<?PHP // cookie check - disabled for now
	/*if($cookies!=true){?>
		<script>
			location.replace('nocookies.php');
		</script>
	<? } */?>

<title>Labels, name tags, fund raising - identi Kid online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content="Labels & name tags for everything supplied by Identi Kid<small>&#8482;</small>. Hassle-free fund raising with personalised labels from Identi Kid<small>&#8482;</small>.  Quality name tags in clothing can help reduce the loss of personal property. Put labels onto anything leaving the house.">
<meta name="keyword" content="Labels, name tags, fund raising, label, clothing tag, personal labels, iron-on tags, school bag,  easy fundraising, pencil, labels, vinyl label, allergy, gift cards, identikid">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/identikid.css" rel="stylesheet" type="text/css">

<!-- FLASH DETECTION SCRIPT -->
 <script type="text/javascript" src="Dispatcher.js"></script>
 <script language="VBScript" src="Dispatcher.vbs"></script>
 <script language="JavaScript" type="text/javascript">

 <!--
 var doflash = false;

 var player = new MM_FlashInfo();
 if (player.installed) {
   if (player.version && player.version >= 5) { // NEEDS FLASH VERSION 5 OR GREATER
     doflash = true;
   }
 }
 //-->
</script>


<script Language="JavaScript" src="/ezytrack.js"></script>
<script language="javascript" src="javascript.js"></script>
<link href="css/identi%20kid.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">

<!--

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

//-->

</script>
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_add_order_mo.gif','images/button_more_info_mo.gif')">
<table width="711" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="3" valign="top">
	 <script type="text/javascript" src="javascript/index.js"></script>
		 <noscript>
      <img src='images/noflash.gif' width='718' height='145' border='0' alt='no javascript alt tag'> 
      </noscript>
  </td>
  </tr>
  <tr> 
    <td width="174" rowspan="2" valign="top" background="images/bg_left_column_home.gif" bgcolor="FFEB33">&nbsp;</td>
    <td width="209" valign="top" bgcolor="#FFFFFF"> <table width="98%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td>&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr> 
          <td width="1" bgcolor="#FFFFFF">&nbsp;</td>
          <td width="147">&nbsp;</td>
          <td width="10" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr valign="middle"> 
          <td colspan=3 align="center"><p class="maintext" ><img src="images/Bracelet-website-graphic.gif" alt="New! Thingamejig"><br>
              The perfect and unique gift -<br>
              a name bracelet. Adjustable<br>
				  name,charm and length. Perfect for that next special occasion.<br><br>
              <a href="products_thingamejig.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image29','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="Image29" width="94" height="22" border="0"></a> 
              <a href="order_thingamejig.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image30','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="Image30" width="94" height="22" border="0"></a> 
            </p></td>
        </tr>
         <tr> 
          <td width="1" bgcolor="#FFFFFF">&nbsp;</td>
          <td width="147">&nbsp;</td>
          <td width="10">&nbsp;</td>
        </tr>
         <tr> 
          <td width="1" bgcolor="#FFFFFF">&nbsp;</td>
          <td width="147">&nbsp;</td>
          <td width="10">&nbsp;</td>
        </tr>
         </tr>
          <tr> 
          <td colspan=3 align="center" ><a href="order_magpie_eyes.php"><img src="images/magpie_eye_link.gif" alt="New! Magpie Eyes" border="0"></a></td>
        </tr>
      
        <tr> 
          <td colspan=3 align="center" class="whitetext">
            <div style="background-color:#FF9900;width:175px;align:center"> 
              <table width="175" border="0" cellspacing="0" cellpadding="7">
                <tr> 
                  <td width="175"><span class="whitetext"><font size="4">Important!</font><br>
                    <font size="2">This website requires:</font> </span> <table width="161" border="0" cellspacing="0" cellpadding="0">
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
                    </table>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        
        
        <tr> 
          <td width="1" height="37"><img src="images/spacer_trans.gif" width="21" height="10"></td>
          <td>&nbsp;</td>
          <td width="10">&nbsp;</td>
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
                <td colspan="2"><img src="images/spacer_trans.gif" width="10" height="10"></td>
              </tr>
              <tr bgcolor="#EF008C"> 
                <td colspan="2"><div align="left"><a href="products_colourmyworld_packs.php"><img src="images/colour%20my%20world%20web%20title.gif" width="293" height="186" border="0"></a></div></td>
              </tr>
              <tr bgcolor="#EF008C"> 
                <td colspan="2" class="whitetext"> <div align="center"><br>
                    A great value labelling pack to get you started. Perfect for 
                    all ages and uses. <br>
                    <br>
                  </div></td>
              </tr>
              <tr bgcolor="#EF008C"> 
                <td colspan="2" valign="top"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr bgcolor="#EF008C"> 
                      <td class="whitetext">Includes:</td>
                    </tr>
                    <tr> 
                      <td class="whitetext">40 vinyls <br>
                        40 coloured iron-ons (Permanent)<br>
                        10 shoe dots<br>
                        1 identiTag <br>
                        30 mini labels or pencil pack<br> <br> </td>
                    </tr>
                  </table></td>
              </tr>
              <tr bgcolor="#EF008C"> 
                <td width="147" valign="top"><div align="center"><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/button_add_order_mo.gif',1)"><strong></strong></a><strong><a href="products_colourmyworld_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image24','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="Image24" width="94" height="22" border="0"></a></strong> 
                  </div>
                  <div align="right"><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/button_add_order_mo.gif',1)"><strong></strong> 
                    </a><a href="order_starter_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/button_add_order_mo.gif',1)"> 
                    </a></div></td>
                <td width="171" valign="top"><div align="center"><a href="order_colour_my_world_packs.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image25','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="Image25" width="94" height="22" border="0"></a></div></td>
              </tr>
              <tr bgcolor="#EF008C"> 
                <td height="20" colspan="2" valign="top"><img src="images/spacer_trans.gif" width="10" height="20"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="218" valign="top" bgcolor="5D7EB9"><div align="center">
            <br/>
            <p><img src="../images/xmashols.gif" width="300" height="200" align="middle"></p>
          </div></td>
        </tr>
        <tr> 
          <td  align="center" ><img src="images/Worldwide-Delivery-Webtile.gif" alt="New! Thingamejig"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2" valign="top" bgcolor="#FF9900"><table width="100%" border="0" cellpadding="17" cellspacing="0" bgcolor="#FF9900">
        <tr> 
          <td><p> <span class="whitetext"><img src="images/home_pirate.jpg" alt="Pirate - Bag Tag" width="87" height="104" hspace="5" vspace="5" align="left"><b>Identi 
              Kid<small>&#8482;</small></b> offers a range of labels that are practical, high quality 
              and innovative. Our labels are also fabulous for fund raising opportunities 
              and will save you time and money. </span></p>
            <p class="whitetext"><b>Identi Kid<small>&#8482;</small></b> offer an ever growing range 
              of labels which can be safely purchased online. If you need labels 
              for your children&rsquo;s clothing &amp; property then take a look 
              through our fantastic selection. </p>
            <p class="whitetext">Our name tags are 100% guaranteed and we pride 
              ourselves on a successful business in terms of quality, service 
              and pricing. <b>Identi Kid<small>&#8482;</small></b> have proven to be a perfect fund 
              raising idea. </p>
            <p class="whitetext">Design your own labels online, with a choice 
              of fonts and pictures. All <b>Identi Kid<small>&#8482;</small></b> name tags are high 
              quality, attractive and very easy to use. Fund raising is very easy 
              with <b>Identi Kid<small>&#8482;</small></b> labels because we deliver the labels directly 
              to your customers and there is no extra work. </p>
            <p class="whitetext"><img src="images/home_surferGirl.jpg" alt="Surfer Girl - Bag Tag" width="90" height="100" hspace="5" vspace="5" align="right"><b>Identi 
              Kid&rsquo;s<small>&#8482;</small></b> vinyl labels are very popular for fund raising, 
              and come in an attractive assortment of rainbow coloured labels 
              for boys and girls. Identify your kid&rsquo;s belonging&rsquo;s 
              with name tags for school, daycare or kindergarten. </p>
            <p class="whitetext">Use our fun vinyl labels on anything you do not 
              wish to lose! Use name tags to identify toys, lunchboxes, musical 
              instruments or sports equipment. It is also the easiest way to do 
              any kind of fund raising. </p>
            <p class="whitetext">Vinyl labels can be used everywhere - beach gear, 
              sporting gear, toys &amp; books even CD&rsquo;s. They are also microwave 
              and dishwasher safe and UV protected. </p>
            <p class="whitetext">Our vinyl labels can be a hassle free way of 
              fund raising. With personalised name tags on everything that goes 
              to school, your child can easily locate their belongings. Children 
              lose less school stationery if you put name tags on their pens and 
              pencils. You can use vinyl labels for any items your kids take to 
              school. </p>
            <p class="whitetext">Fund raising could not be easier. Order online 
              and the product is delivered directly to the customer &ndash; no 
              extra work. </p>
            <p class="whitetext">By using a picture on your iron-on name tags 
              the kids are able to recognise their own belongings before they 
              can read. </p>
            <p class="whitetext"><img src="images/home_frog.jpg" alt="Frog - Bag Tag" width="98" height="99" hspace="5" vspace="5" align="left">Our 
              shoe labels are an innovative product with special adhesive for 
              hard to stick surfaces. </p>
            <p class="whitetext"><b>Identi Kid&rsquo;s<small>&#8482;</small></b> colourful range of 
              name tags &amp; labels are perfect for everyone. </p></td>
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
