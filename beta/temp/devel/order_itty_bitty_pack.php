<?
header("Cache-control: private");
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$result = product_details(35, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>identi Kid - Order - <?= $product['productName']; ?></title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script  language="javascript">

var kidsName ="";
var kidsPhone="";
var picon="1"; 
var background_colour="12";
var font_colour="2"; 
var font = "3";
var pic="13";
var type="35";
var incName = true;
var incPhone = true;
var splitName = false;
var tagpic = "13.gif";
var bandpic = "N.gif";
var bandbase = "/images/identibands/";
var tagbase = "/images/ziptags/";

function setup() {
  document.getElementById('type').value = type;
  document.getElementById('pic').value = pic;
  document.getElementById('identiband_pic').value = bandpic;
  document.getElementById('ziptag_pic').value = tagpic;
  document.getElementById('background_colour').value = background_colour;
  document.getElementById('font').value = font;
  document.getElementById('font_colour').value = font_colour;
  document.getElementById('picon').value = picon;
  update();
}

function update() { 
        spaceReg =  / +/g;
		if(incName==true) {
          kidsName = document.getElementById('name').value;
		  kidsName = kidsName.replace(spaceReg, "+");
		} else {
		  kidsName = "";
		}
		
		if(incPhone==true) {
		  kidsPhone = document.getElementById('phone').value;
		  kidsPhone = kidsPhone.replace(spaceReg,"+");
		} else {
		  kidsPhone = "";
		}
		
		document.getElementById('identiband').src = bandbase+bandpic;
		document.getElementById('ziptags').src = tagbase+tagpic;
		
		var preview = document.getElementById('dots');
		previewText = "<p><OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'"
						+"codebase='http:\/\/download.macromedia.com\/pub\/shockwave\/cabs\/flash\/swflash.cab\#version=6,0,0,0'"
						+"WIDTH='160' HEIGHT='160' id='tp' ALIGN='left'>"
						+"<PARAM NAME=movie VALUE='images/display_shoe_dots.swf?type="+type+"&pic="+pic+"&kidsName="+kidsName+"&kidsPhone="+kidsPhone+"&picon="+picon+"&background_colour="+background_colour+"&font_colour="+font_colour+"&font="+font+"'>"
						+"<PARAM NAME=quality VALUE=high>"
						+"<PARAM NAME=bgcolor VALUE=#FFFFFF>"
						+"<EMBED src='images/display_shoe_dots.swf?type="+type+"&pic="+pic+"&kidsName="+kidsName+"&kidsPhone="+kidsPhone+"&picon="+picon+"&background_colour="+background_colour+"&font_colour="+font_colour+"&font="+font+"'"
						+"quality=high bgcolor=#FFFFFF  WIDTH='160' HEIGHT='160' NAME='display_vinyl' ALIGN=''"
						+"TYPE='application/x-shockwave-flash' PLUGINSPAGE='http://www.macromedia.com/go/getflashplayer'>"
						+"<\/EMBED><\/OBJECT></p>"
						+"<p><OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\""
						+"codebase=\"http:\/\/download.macromedia.com\/pub\/shockwave\/cabs\/flash\/swflash.cab\#version=6,0,0,0\""
						+"WIDTH=\"160\" HEIGHT=\"160\" id=\"tp1\" ALIGN=\"right\">"
						+"<PARAM NAME=movie VALUE=\"images/display_mini.swf?type="+type+"&pic="+pic+"&text1="+kidsName+"&picon="+picon+"&background_colour="+background_colour+"&font_colour="+font_colour+"&font="+font+"\">"
						+"<PARAM NAME=quality VALUE=high>"
						+"<PARAM NAME=bgcolor VALUE=#FFFFFF>"
						+"<EMBED src=\"images/display_mini.swf?type="+type+"&pic="+pic+"&text1="+kidsName+"&picon="+picon+"&background_colour="+background_colour+"&font_colour="+font_colour+"&font="+font+"\""
						+"quality=high bgcolor=#FFFFFF  WIDTH=\"160\" HEIGHT=\"160\" NAME=\"display_mini\" ALIGN=\"\""
						+"TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">"
						+"<\/EMBED><\/OBJECT></p>"
		preview.innerHTML = previewText;
		//alert(previewText);
						
}

function setBackgroundColour(colour) {
 background_colour = colour;
 document.getElementById('background_colour').value = background_colour;
 update();
}

function setPic(picture) {
switch(picture)
{
  case 'fairy': 
    pic = '13';
	bandpic = "N.gif"
	tagpic = "13.gif";
    break
  case 'ballet':
    pic = '20';
	bandpic = "U.gif"
	tagpic = "20.gif";
    break
  case 'truck':
    pic = '17';
	bandpic = "R.gif"
	tagpic = "17.gif";
    break
  case 'surfer':
    pic = '24';
	bandpic = "Y.gif"
	tagpic = "24.gif";
    break
  case 'butterfly':
    pic = '7';
	bandpic = "H.gif"
	tagpic = "8.gif";
    break
  case 'mermaid':
    pic = '16';
	bandpic = "Q.gif"
	tagpic = "16.gif";
    break
  case 'pirate':
    pic = '25';
	bandpic = "Z.gif"
	tagpic = "25.gif";
    break
  case 'rocket':
    pic = '36';
	bandpic = "F1.gif"
	tagpic = "30.gif";
    break
}
 document.getElementById('pic').value = pic;
 document.getElementById('identiband_pic').value = bandpic.replace('.gif','');
 document.getElementById('ziptag_pic').value = tagpic.replace('.gif','');
 if(picon=="1") update();
}

function setFont(fontNum){
  font = fontNum;
  document.getElementById('font').value = font;
  update(); 
}

function setFontColour(colour) {
  font_colour = colour;
  document.getElementById('font_colour').value = font_colour;
  update(); 
}

function toggleName() {
 if(incName==true) incName=false;
 else incName=true;
 update();
}

function togglePhone() {
 if(incPhone==true) incPhone=false;
 else incPhone=true;
 update();
}

function togglePic() {
 if(picon=="1") picon="0";
 else picon="1"; 
 document.getElementById('picon').value = picon;
 update();
}

function toggleSplit() {
 if(splitName==true) splitName=false;
 else splitName=true; 
}

function submitform()
{
  document.form1.submit();
}

</script>
</head>

<body>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#5D7EBC">
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
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
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
                      <td colspan="4">
                      <table width="100%" border=0 bgcolor="#FFFFFF">
                      	<tr>
                      		<td bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      		<td valign="top" bgcolor="#FFFFFF"><h1 class="headings"><?= $product['productName']; ?></h1></td>
                      		<td align="right" bgcolor="#FFFFFF" class="maintext"><strong><?= $price_formatted; ?></strong></td>
                      		<td bgcolor="#FFFFFF" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      	</tr>
                      	
                          
                          <tr valign="top"> 
                          	<td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td bgcolor="#FFFFFF" align="center">
 <!--// ITTY BITTY PACK START -->
<form name="form1" action="addtoorder.php" method="post">
<input type="hidden" name="type" id="type" value="" />
<input type="hidden" name="font" id="font" value="" />
<input type="hidden" name="font_colour" id="font_colour" value="" />
<input type="hidden" name="background_colour" id="background_colour" value="" />
<input type="hidden" name="pic" id="pic" value="" />
<input type="hidden" name="ziptag_pic" id="ziptag_pic" value="" />
<input type="hidden" name="identiband_pic" id="identiband_pic" value="" />
<input type="hidden" name="picon" id="picon" value="" />
<table>
<tr>
<td colspan="2">
<div align="center" name="dots" id="dots" style="height:160px;"></div>
<img id="ziptags" name="ziptags" src="/images/ziptags/13.gif" />
<img id="identiband" name="identiband" src="/images/identibands/N.gif" />
</td>
</tr>
<tr>
  <td class="maintext"  valign="top"><p> <b>Include:</b> </td>
  <td class="maintext"><p><input type="checkbox" name="name_inc" checked  DISABLED/>Name <input type="checkbox" name="phone_inc" checked onclick="togglePhone();"/>Phone <input type="checkbox" name="pic_inc" checked  onclick="togglePic();"/>Pic</p></td>
</tr>
<tr>
<td class="maintext" valign="top"><b>Name:</b></td>
<td class="maintext"><input class="maintext" type="text" name="name" id="name" onChange="if(incName==true)update();"/>
</td>
</tr>
<td class="maintext" valign="top"><p><b>Phone:</b></td>
<td class="maintext"><input class="maintext" type="text" name="phone" id="phone" onChange="if(incPhone==true)update();"/></p></td>
</tr>
<tr>
<td class="maintext"  valign="top"><p><b>Picture:</b></p></td>
<td class="maintext">
  <table>
    <tr>
      <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('fairy');"><img style="border-color:#FFFFFF;" src="images/pictures/fairy_bw.jpg" alt="Fairy"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('ballet');"><img style="border-color:#FFFFFF;" src="images/pictures/ballet_bw.jpg" alt="Ballet"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('truck');"><img style="border-color:#FFFFFF;" src="images/pictures/tip_truck_bw.jpg" alt="Truck"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('surfer');"><img style="border-color:#FFFFFF;" src="images/pictures/surfer_bw.jpg" alt="Surfer"  /></a></td>
    </tr>
	 <tr>
      <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('butterfly');"><img style="border-color:#FFFFFF;"src="images/pictures/butterfly_bw.jpg" alt="Butterfly"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('mermaid');"><img style="border-color:#FFFFFF;"src="images/pictures/mermaid_bw.jpg" alt="Mermaid"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('pirate');"><img style="border-color:#FFFFFF;" src="images/pictures/pirate_bw.jpg" alt="Pirate"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('rocket');"><img style="border-color:#FFFFFF;" src="images/pictures/rocket_bw.jpg" alt="Rocket" /></a></td>
    </tr>
  </table>
</td>
</tr>
<tr>
<td class="maintext"  valign="top"><p><b>Colours:</b></p></td>
<td> 
<table>
    <tr>
      <td bgcolor="#f287b6" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(12);"><img style="border-color:#FFFFFF;" src="images/pictures/colour.gif" alt="Colour"/></a></td>
	  <td bgcolor="#a689bc" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(6);"><img style="border-color:#FFFFFF;" src="images/pictures/colour.gif" alt="Colour"/></a></td>
	  <td  bgcolor="#00aeef" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(2);"><img style="border-color:#FFFFFF;" src="images/pictures/colour.gif" alt="Colour"/></a></td>
	  <td  bgcolor="#99c93b" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(5);"><img style="border-color:#FFFFFF;" src="images/pictures/colour.gif" alt="Colour"/></a></td>
    </tr>
</table>
</td>
</tr>
<tr>
<td class="maintext"  valign="top"><p><b>Font:</b></p></td>
<td class="maintext">
<table border="0">
    <tr>
	  <td class="maintext">4</td>
      <td style="padding: 0px 0px 0px 0px; border:1px solid #000000;"><img style="border-color:#FFFFFF;" src="images/f4.gif" alt="Font 4"/></td>
	</tr>
</table>
</td>
</tr>
<tr>
<td class="maintext"  valign="top"><p><b>Quantity:</b></p></td>
<td class="maintext">
<select name="quantdesc">
<option value="<?="1 Itty Bitty Pack for " . $product['symbol'].$product['price']?>"><?="1 Itty Bitty Pack for " . $product['symbol'].$product['price']?></option>
<option value="<?="2 Itty Bitty Packs for " . $product['symbol'].(2*$product['price'])?>"><?="2 Itty Bitty Packs for " . $product['symbol'].(2*$product['price'])?></option>
<option value="<?="3 Itty Bitty Packs for " . $product['symbol'].(3*$product['price'])?>"><?="3 Itty Bitty Packs for " . $product['symbol'].(3*$product['price'])?></option>
</select> 
</td>
</tr>
<tr>
<td colspan="2"><img src="images/spacer_trans.gif" width="30" height="30"><div align="center"><a href="products_itty_bitty_pack.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" name="back" width="94" height="22" border="0"></a> 
&nbsp;&nbsp;<a href="javascript: submitform()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','images/button_continue_mo.gif',1)"><img src="images/button_continue.gif" name="Image28" width="94" height="22" border="0"></a> 
</div></td>
</td></tr>
</table>
</form>
<!--// ITTY BITTY PACK END -->
</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="30" height="30"></td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="5" valign="top">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE600">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top" bgcolor="#FFE600">
					  
					  <?php include "navigation.php"; ?></td>
                    </tr>
                    <tr> 
                      <td bgcolor="#FFE600"> 
                        <?php include "orders.php" ?>                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top" bgcolor="#5D7EBC"> 
            <?php include "footer.php" ?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script  language="javascript">setup();</script>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
