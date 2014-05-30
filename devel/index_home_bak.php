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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/identi kid.css" rel="stylesheet" type="text/css">
<TITLE>IdentiKid - Home</TITLE>
<META NAME="keywords" CONTENT="identikid,label,labels,vinyl,iron,on,mini,shoe,pencil,diy,pack,packs,starter,mixed,birthday,kidcards,card,bag,tag,gift,box,school,kindergarden
lost,property,clothing">
<META NAME="description" CONTENT="Personalised name labels that really work. Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more. Design your own labels online, with your choice of fun fonts and pictures. All products are high quality, attractive and easy to use.">
<META NAME="rating" CONTENT="General">
<META NAME="expires" CONTENT="never">
<META NAME="language" CONTENT="english">
<META NAME="charset" CONTENT="ISO-8859-1">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="INDEX,FOLLOW">
<META NAME="revisit-after" CONTENT="7 Days">
<META NAME="email" CONTENT="info@identikid.con.au">
<META NAME="author" CONTENT="Echidna Web Design">
<META NAME="publisher" CONTENT="Identi Kid">
<META NAME="copyright" CONTENT="Copyright ©2004 -">
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

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<!-- <body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_openBrWindow('popup.htm','popup','width=218,height=320');MM_preloadImages('images/button_add_order_mo.gif','images/button_more_info_mo.gif');"> -->
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
	<td width="174" valign="top" bgcolor="FFEB33"><img src="images/images_left.gif" alt="identi Kid" width="172" height="626"></td>
	<td width="209" valign="top" bgcolor="FFEB33"> 
      <table width="98%" border="0" cellpadding="0" cellspacing="0">
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
		  <? if($_COOKIE["currency"]==1){
		  	?><a href="competition.php"><img src="images/competition.gif" alt="" width="175" height="235" border="0"></a><?
		  }else{
			  ?><table border="0" align="left" cellpadding="0" cellspacing="0">
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
				  We started with a simple<br>
				  line of products and with our incredible feedback, have continued 
				  to develop a range of fun and high quality products that will help 
		  you combat your lost property problem!<br><br>
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
          <td class="maintext"><br>Orders dispatched within 3 working days.<br>
Assistance available 8am-8pm AEST 7 days throughout January.<br><br></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="5d7eb9" width="335"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top" bgcolor="f0027f">
		  <table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="15" height="10"></td>
                <td colspan="2" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                <td width="19" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
              </tr>
              <tr> 
                <td colspan="2" valign="top"><div align="center"><img src="images/text_easywayout.gif" width="290" height="50"></div></td>
              </tr>
              <tr> 
                <td width="147" valign="top"><img src="images/image_starterpack_home.gif" width="147"></td>
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
						
                      <td width="11" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
						<td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
						
                      <td width="11" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
					  </tr>
					  <tr> 
						<td colspan="3"><div align="left"><img src="images/text_free_gift.gif" width="168" height="33"></div></td>
					  </tr>
					  <tr> 
						
                      <td width="140" rowspan="2" valign="top"><img src="images/image_gift_box.gif" alt="Gift Box" width="140" height="149"></td>
						<td colspan="2"><img src="images/spacer_trans.gif" width="10" height="10"></td>
					  </tr>
					  <tr> 
						
                      <td width="23">&nbsp;</td>
						
                      <td width="150" valign="top" class="whitetext"> 
                        <p>Place an online order of <? echo $cur['symbol'].$cur['freeGift'];?> 
                          or more and receive our gift/storage package <em>free!</em></p>
						  
                        <p><strong><a href="products_home.php" class="type2"><font size="2">Start 
                          shopping&gt;</font></a></strong> </p></td>
					  </tr>
					  <tr> 
						<td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
	    </tr>
      </table></td>
  </tr>
  
  <tr> 
    <td height="30" colspan="3"> 
      <?php include "footer.php" ?>
    </td>
  </tr>
</table>

</body>
</html>
