<?

$result = product_details(47, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

?>

<script  language="javascript">

$(document).ready(
  function() {
    setup();
  }
);


var kidsName ="";
var kidsPhone="";
var picon="1"; 
var background_colour="12";
var font_colour="2"; 
var font = "3";
var pic="13";
var type="47";
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
  document.getElementById('phinc').value = "1";
  update();
  
}

function update() { 
        spaceReg =  / +/g;
		if(incName==true) {
                   kidsName = document.getElementById('name').value;
		  kidsName = " "+kidsName.replace(spaceReg, "+")+" ";
		} else {
		  kidsName = "";
		}
		
		if(incPhone==true) {
		  kidsPhone = document.getElementById('phone').value;
		  kidsPhone = kidsPhone.replace(spaceReg,"+");
		} else {
		  kidsPhone = "";
		}
		
		//document.getElementById('identiband').src = bandbase+bandpic;
		//document.getElementById('ziptags').src = tagbase+tagpic;
		
		var preview = document.getElementById('dots');
		previewText = "<p><OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'"
						+"codebase='http:\/\/download.macromedia.com\/pub\/shockwave\/cabs\/flash\/swflash.cab\#version=6,0,0,0'"
						+"WIDTH='160' HEIGHT='160' id='tp' ALIGN='center'>"
						+"<PARAM NAME=movie VALUE='images/display_shoe_dots.swf?type="+type+"&pic="+pic+"&kidsName="+kidsName+"&kidsPhone="+kidsPhone+"&picon="+picon+"&background_colour="+background_colour+"&font_colour="+font_colour+"&font="+font+"'>"
						+"<PARAM NAME=quality VALUE=high>"
						+"<PARAM NAME=bgcolor VALUE=#FFFFFF>"
						+"<EMBED src='images/display_shoe_dots.swf?type="+type+"&pic="+pic+"&kidsName="+kidsName+"&kidsPhone="+kidsPhone+"&picon="+picon+"&background_colour="+background_colour+"&font_colour="+font_colour+"&font="+font+"'"
						+"quality=high bgcolor=#FFFFFF  WIDTH='160' HEIGHT='160' NAME='display_vinyl' ALIGN=''"
						+"TYPE='application/x-shockwave-flash' PLUGINSPAGE='http://www.macromedia.com/go/getflashplayer'>"
						+"<\/EMBED><\/OBJECT></p>";
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
 if(incPhone==true) {
  incPhone=false;
  document.getElementById('phinc').value = "0";
 } else { 
   incPhone=true;
   document.getElementById('phinc').value = "1";
 }
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
<input type="hidden" name="phinc" id="phinc" value="" />
<input type="hidden" name="phone" id="phone" value="" />
<table>
<tr>
<td colspan="2">
<div align="center" name="dots" id="dots" style="height:160px;"></div>
<!-- <img id="ziptags" name="ziptags" src="/images/ziptags/13.gif" />
<img id="identiband" name="identiband" src="/images/identibands/N.gif" /> -->
</td>
</tr>

<tr>
  <td class="maintext"  valign="top" clospan="2">&nbsp;</td>
</tr>
<!-- <tr>
  <td class="maintext"  valign="top"><p> <b>Include:</b> </td>
  <td class="maintext"><p><input type="checkbox" name="name_inc" checked  DISABLED/>Name <input type="checkbox" name="phone_inc" checked onclick="togglePhone();"/>Phone <input type="checkbox" name="pic_inc" checked  onclick="togglePic();"/>Pic</p></td>
</tr> -->
<tr>
<td class="maintext" valign="top"><b>Initals:</b></td>
<td class="maintext"><input class="maintext" type="text" name="name" MAXLENGTH=3 size=3 id="name" onChange="if(incName==true)update();"/>
</td>
<tr>
<td class="maintext"  valign="top"><p><b>Picture:</b></p></td>
<td class="maintext">
  <table>
    <tr>
      <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('fairy');return false;"><img style="border-color:#FFFFFF;" src="images/pictures/fairy_bw.jpg" alt="Fairy"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('ballet');return false;"><img style="border-color:#FFFFFF;" src="images/pictures/ballet_bw.jpg" alt="Ballet"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('truck');return false;"><img style="border-color:#FFFFFF;" src="images/pictures/tip_truck_bw.jpg" alt="Truck"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('surfer');return false;"><img style="border-color:#FFFFFF;" src="images/pictures/surfer_bw.jpg" alt="Surfer"  /></a></td>
    </tr>
	 <tr>
      <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('butterfly');return false;"><img style="border-color:#FFFFFF;"src="images/pictures/butterfly_bw.jpg" alt="Butterfly"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('mermaid');return false;"><img style="border-color:#FFFFFF;"src="images/pictures/mermaid_bw.jpg" alt="Mermaid"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('pirate');return false;"><img style="border-color:#FFFFFF;" src="images/pictures/pirate_bw.jpg" alt="Pirate"  /></a></td>
	  <td style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setPic('rocket');return false;"><img style="border-color:#FFFFFF;" src="images/pictures/rocket_bw.jpg" alt="Rocket" /></a></td>
    </tr>
  </table>
</td>
</tr>
<tr>
<td class="maintext"  valign="top"><p><b>Colours:</b></p></td>
<td> 
<table>
    <tr>
      <td bgcolor="#f287b6" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(12);return false;"><img style="border-color:#FFFFFF;" src="images/colour.gif" alt="Colour"/></a></td>
	  <td bgcolor="#a689bc" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(6);return false;"><img style="border-color:#FFFFFF;" src="images/colour.gif" alt="Colour"/></a></td>
	  <td  bgcolor="#00aeef" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(2);return false;"><img style="border-color:#FFFFFF;" src="images/colour.gif" alt="Colour"/></a></td>
	  <td  bgcolor="#99c93b" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><a href="#" onclick="setBackgroundColour(5);return false;"><img style="border-color:#FFFFFF;" src="images/colour.gif" alt="Colour"/></a></td>
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
<option value="<?="1 Dummy Dot for " . $product['symbol'].$product['price']?>"><?="1 Dummy Dot  for " . $product['symbol'].$product['price']?></option>
<option value="<?="2 Dummy Dots for " . $product['symbol'].(2*$product['price'])?>"><?="2 Dummy Dots for " . $product['symbol'].(2*$product['price'])?></option>
<option value="<?="3 Dummy Dot2 for " . $product['symbol'].(3*$product['price'])?>"><?="3 Dummy Dots  Packs for " . $product['symbol'].(3*$product['price'])?></option>
</select> 
</td>
</tr>
<tr>
<td colspan="2"><img src="images/gen/spacer.gif" width="30" height="30"><div align="center"><a href="javascript: history.go(-1);" ><img src="images/nav/n_back.gif" name="back" width="58" height="22" border="0"></a> 
&nbsp;&nbsp;<a href="" onclick="submitform();return false;" ><img src="images/nav/n_continue_x.gif" name="Image28" width="80" height="22" border="0"></a> 
</div></td>
</td></tr>
</table>
</form>
<!--// Dummy Dot END -->
</td>
 </tr>
</table>