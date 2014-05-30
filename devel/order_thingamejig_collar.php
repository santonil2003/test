<?
header("Cache-control: private");
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

//$result = product_details(36, $_COOKIE['currency'], $product);
//$price_formatted = (int)$product['unitQuant'] . " from " . $product['symbol'].$product['price'];
//$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


$query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY item";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$k=0;
while($qdata = mysql_fetch_array($result)){
	$k++;
	$prices[$k] = $cur['symbol'].sprintf("%01.2f", $qdata['price']);
	$pricesDbl[$k] = $qdata['price'];
}

$product_name = "Thingamejigs- pet collar"; 
$product_type = 37;
$background_colours = array("Black" => "#000000", "Pink" => "#f287b6" );
$font_colours = array();
$icons = array('Fairy' => 'fairy.gif', 'Mermaid' => 'mermaid.gif', 'Butterfly' => 'butterfly.gif', 'Skull(black)' => 'skull_black.gif','Skull(white)' => 'skull_white.gif', 
'Frangapani(green)' => 'frangapani_green.gif', 'Frangapani(red)' => 'frangapani_red.gif','Frangapani(orange)' => 'frangapani_orange.gif','Frangapani(blue)' => 'frangapani_blue.gif',
'Frangapani(purple)' => 'frangapani_purple.gif','Frangapani(pink)' => 'frangapani_pink.gif','Frangapani(yellow)' => 'frangapani_yellow.gif',
'flower' => 'flower.gif', 'Heart' => 'heart.gif', 'Star' => 'star.gif','Shark' => 'shark.gif',  'Dog' => 'dog.gif','Rocket' => 'rocket.gif','Pirate' => 'pirate.gif', 
'Ballerina(purple)' => 'ballerina_purple.gif', 'Ballerina(pink)' => 'ballerina_pink.gif','Surfer Boy' => 'surfer_boy.gif', 'Surfer Girl' => 'surfer_girl.gif', 
'Bee' => 'bee.gif','Cat' => 'cat.gif', 'Nurse' => 'nurse.gif', 'Lady Bird' => 'lady_bird.gif','Motorbike' => 'motorbike.gif', 'Girl' => 'girl.gif');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>identi Kid - Order - <?=$product_name?></title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script  language="javascript">

var kidsName ="";
var background_colours=new Array();
<?
foreach ($background_colours as $name => $colour ) {
  print ("background_colours['{$name}']='{$colour}';");
} 
?>

var background_colour="Black";
var type="<?=$product_type?>";
var icons = new Array();
<?
foreach ($icons as $name => $file ) {
  print ("icons['{$name}']='{$file}';");
} 
?>

var totalAllowed = 20;
var totalLetters = 0;
var totalIcons = 0;
var totalBands = 1;

var currencySymbol = '<?=$cur['symbol'];?>';
var letterCost = <?=$pricesDbl[2];?>;
var iconCost = <?=$pricesDbl[3];?>;
var bandCost = <?=$pricesDbl[4];?>;
var catCollarCost = <?=$pricesDbl[5];?>;
var totalCost = 0;

var iconbase = "images/identibracelet/icons/";
var letterbase = "images/identibracelet/letters/";

function setup() {
  document.getElementById('type').value = type;
  document.getElementById('name').value = '';
  document.getElementById('price').value = '';
  document.getElementById('quantdesc').value = '';
  for ( var i in icons )
  {
    document.getElementById('icon_'+i).value = '0';
  }
  setBackgroundColour(background_colour);
  update();
}

function update() { 
  letterValid = /[A-Za-z]/;
  notValid = /[^A-Za-z ]/;
  kidsNameObj = document.getElementById('name');
  kidsName = kidsNameObj.value
  kidsName = kidsName.replace(notValid, '');
  kidsNameObj.value = new String(kidsName);
  kidsNameLength = kidsName.replace(/\ +/g, '').length;
  
  if((totalIcons+kidsNameLength)<=totalAllowed) {
  totalLetters = kidsNameLength;
  divHtml = '<img src="images/spacer_trans.gif" width="1px" height="3px" alt=" "><table cellpadding="0" cellspacing="0" border="0" height="100%" valign="middle" ><tr>';
  for ( var i in icons )
  {
    num_icons = Math.floor(parseInt(document.getElementById('icon_'+i).value)/2);
    for(j=1;j<=num_icons;j++){
      divHtml+= '<td><img src="'+iconbase+icons[i]+'" alt="'+icons[i]+'"></td>'; 
    }
  }
  for(i=0;i<kidsName.length;i++) {
    kidChar = kidsName.charAt(i);
    if(kidChar.match(letterValid)) {
      divHtml+= '<td><img src="'+letterbase+kidChar.toLowerCase()+'.gif" alt="'+kidChar+'"></td>'; 
    } else {
      divHtml+= '<td><img src="images/spacer_trans.gif" width="5px" alt=" "></td>'; 
    }
  }
  for ( var i in icons )
  {
    num_icons = Math.ceil(parseInt(document.getElementById('icon_'+i).value)/2);
    for(j=1;j<=num_icons;j++){
      divHtml+= '<td><img src="'+iconbase+icons[i]+'" alt="'+icons[i]+'"></td>'; 
    }
  }
    divHtml += '</tr></table>';		
    document.getElementById('bracelet').innerHTML = divHtml;
  } else {
    totalLetters = totalAllowed-totalIcons;
    pos = 0;
    count = 0;
    for (i=0;i<=kidsName.length;i++) {
      pos++;
      if(!(/^\s?$/.test(kidsName.charAt(i)))) { count++; }
      if(count>=totalLetters) { break; }
    }
    kidsName = kidsName.substr(0,pos)
    document.getElementById('name').value = kidsName;
  }
  
  updateCost();
}

function setBackgroundColour(colour) {
  background_colour = colour;
  document.getElementById('background_colour').value = background_colour;
  document.getElementById('bracelet').style.backgroundColor = background_colours[colour];
}

function addIcon(picture) {
  if((totalLetters+totalIcons+1)<=totalAllowed) {
    totalIcons++;
    iconValue = parseInt(document.getElementById('icon_'+picture).value);
    document.getElementById('icon_'+picture).value = iconValue+1;
    document.getElementById(picture+'_qty').innerHTML = '<font size="1" >'+document.getElementById('icon_'+picture).value+'</font>';
    update();
  }
  return false;
}

function remIcon(picture) {
  totalIcons=(totalIcons-1)<0?0:(totalIcons-1);
  iconValue = parseInt(document.getElementById('icon_'+picture).value);
  iconValue = (iconValue-1)<0?0:(iconValue-1);
  document.getElementById('icon_'+picture).value = iconValue;
  document.getElementById(picture+'_qty').innerHTML = '<font size="1">'+(iconValue<=0?'':iconValue)+'</font>';
  update();
  return false;
}

function submitform()
{
  document.form1.submit();
}

function updateCost(){
  //totalBands = document.getElementById('quantdesc').selectedIndex+1;
  totalCost = (((totalLetters*letterCost)+(totalIcons*iconCost))*totalBands)+(bandCost*totalBands);
  var quantDesc = currencySymbol+totalCost.toFixed(2);
  document.getElementById('total_cost').innerHTML = quantDesc;
  document.getElementById('quantdesc').value = "1 <?=$product_name?> For "+quantDesc;
  document.getElementById('price').value = totalCost.toFixed(2);
}

</script>
<style type="text/css" media="screen">
		body
		{
			margin: 20px;
			padding: 0;
			font: normal 85% arial, helvetica, sans-serif;
			color: #000;
			background-color: #fff;
		}
		
		.containingbox
		{
			width: 100%;
			height: 100%;
		}
		
		.floatleft
		{
		   clear:none;
		   float:left;
			max-width:90px;
			max-height:80px;
			width: 90px;
			height: 80px;
		}
</style>
</head>

<body onload="setup();" bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif')">
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
                      		<td valign="top" bgcolor="#FFFFFF"><h1 class="headings">Pet collar</h1></td>
                      		<td align="right" bgcolor="#FFFFFF" class="maintext"><strong>Collar: <?=$prices[4];?><br>
                      		<!--Cat Collar: <?=$prices[5];?><br>-->Letters: <?=$prices[2];?><br>Charms: <?=$prices[3];?></strong></td>
                      		<td bgcolor="#FFFFFF" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      	</tr>
                      	
                          
                          <tr valign="top"> 
                          	<td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td bgcolor="#FFFFFF" align="center">

<form name="form1" action="addtoorder.php" method="post">
<input type="hidden" name="type" id="type" value="" />
<input type="hidden" name="background_colour" id="background_colour" value="" />
<input type="hidden" name="price" id="price" value="" />
<input type="hidden" name="quantdesc" id="quantdesc" value="" />
<?
foreach ($icons as $name => $file ) { 
  print ('<input type="hidden" name="icon_'.$name.'" id="icon_'.$name.'" value="0" />');
} 
?>

<table>
<tr>
<td colspan="2">
<br>
<div width="100%" align="center">
  <div align="center" style="background-image: url('images/identibracelet/collar.png');
   background-repeat:no-repeat;background-position:center;width:375px;height:59px;" name="bracelet" id="bracelet" ></div>
 </div>
</td>
</tr>
<td colspan="2">
&nbsp;<br><br>&nbsp;
</td>
</tr>
<!--<tr>
<td class="maintext" valign="top"><p><b>Collar:</b></p></td>
<td class="maintext">
  Dog <input class="maintext" type="radio" name="collar" id="dog" value="dog" onclick="update();" checked/>&nbsp;&nbsp;&nbsp;
  Cat <input class="maintext" type="radio" name="collar" id="cat" value="cat" onclick="update();" />
</td>
</tr> -->
<tr>
<td class="maintext" valign="top"><p><b>Name:</b><br><font size="2"><?=$prices[2];?> per Letter</font></p></td>
<td class="maintext"><input class="maintext" type="text" size="35" name="name" id="name" onkeyup="update();" />
</td>
<tr>
<td class="maintext"  valign="top"><p><b>Charms:</b><br><font size="2"><?=$prices[3];?> per Charm</font></p></td>
<td class="maintext" align="center" >
 <div class="containingbox" align="center">
 <?
foreach ($icons as $name => $file ) {
?>
<div class="floatleft">
  <table cellpadding="0" cellspacing="2" border="0" align="center" >
    <tr style="padding: 0px 0px 0px 0px;text-align:center;">
      <td style="padding: 0px 0px 0px 0px;text-align:center;">
        <img style="border-color:#FFFFFF;cursor:pointer;" src="images/identibracelet/icons/<?=substr($file, 0, strpos($file,'.'))?>_icon.gif" alt="<?=$name?>" onclick="addIcon('<?=$name?>');" />
        <table cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;" align="center" ><tr>
        <td><input type="image" src="images/identibracelet/add_icon.gif" name="add_icon" value="+" onclick="return addIcon('<?=$name?>');"></td> 
        <td width="20px" ><div name="<?=$name?>_qty" id="<?=$name?>_qty" height="15px" width="20px" ></div></td>
        <td><input type="image" src="images/identibracelet/rem_icon.gif" name="add_icon" value="-" onclick="return remIcon('<?=$name?>');"></td>
        </tr></table>
      </td>
    </tr>
  </table>
</div>
<?
} 
?>

</td>
</tr>
<tr>
<td class="maintext"  valign="top"><p><b>Band Colour:</b></p></td>
<td align="left"> 
<table>
    <tr>
     <?
      foreach($background_colours as $name => $colour ) {
        print ('<td bgcolor="'.$colour.'" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><img style="border-color:#FFFFFF;cursor:pointer;" src="images/pictures/colour.gif" alt="'.$name.'" onclick="setBackgroundColour(\''.$name.'\');" /></td>');
      } 
     ?>  
    </tr>
</table>
</td>
</tr>

<!--<tr>
<td class="maintext"  valign="top"><p><b>Quantity:</b></p></td>
<td class="maintext">
<select name="quantdesc" id="quantdesc" onchange="updateCost();">
<option value="<?="1 ".$product['productName']?>"><?="1 ".$product['productName']?></option>
<option value="<?="2 ".$product['productName']?>"><?="2 ".$product['productName']?></option>
<option value="<?="3 ".$product['productName']?>"><?="3 ".$product['productName']?></option>
<option value="<?="4 ".$product['productName']?>"><?="4 ".$product['productName']?></option>
</select> 
</td>
</tr>-->

<tr>
<td class="maintext"  valign="top"><p><b>Total Cost:</b></p></td>
<td class="maintext" align="left">
<div id="total_cost" name="total_cost"></div>
</td>
</tr>
<tr>
<td colspan="2"><img src="images/spacer_trans.gif" width="30" height="30"><div align="center"><a href="products_thingamejig_collar.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" name="back" width="94" height="22" border="0"></a> 
&nbsp;&nbsp;<a href="javascript: submitform()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','images/button_continue_mo.gif',1)"><img src="images/button_continue.gif" name="Image28" width="94" height="22" border="0"></a> 
</div></td>
</td></tr>
</table>
</form>

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
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
