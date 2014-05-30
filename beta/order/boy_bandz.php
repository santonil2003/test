<?

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

$product_name = "Thingamejigs- boybandz"; 
$product_type = 38;
$background_colours = array("Leather" => "#000000");
$font_colours = array();
$icons = array('Skull(black)' => 'skull_black.gif', 'Skull(white)' => 'skull_white.gif', 'Shark' => 'shark.gif',  'Dog' => 'dog.gif',
'Rocket' => 'rocket.gif','Pirate' => 'pirate.gif','Surfer Boy' => 'surfer_boy.gif','Motorbike' => 'motorbike.gif');

?>

<script  language="javascript">

$(document).ready( 
  function() {
    setup();
  }
);


var kidsName ="";
var background_colours=new Array();
<?
foreach ($background_colours as $name => $colour ) {
  print ("background_colours['{$name}']='{$colour}';");
} 
?>

var background_colour="Leather";
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
var bandCost = <?=$pricesDbl[6];?>;
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
    if(i != 'indexOf') {
    document.getElementById('icon_'+i).value = '0';
    }
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
  divHtml = '<img src="images/gen/spacer.gif" width="1px" height="3px" alt=" "><table cellpadding="0" cellspacing="0" border="0" height="100%" valign="middle"><tr>';
  for ( var i in icons )
  {
    if(i != 'indexOf') {
    num_icons = Math.floor(parseInt(document.getElementById('icon_'+i).value)/2);
    for(j=1;j<=num_icons;j++){
      divHtml+= '<td><img src="'+iconbase+icons[i]+'" alt="'+icons[i]+'"></td>'; 
    }
    }
  }
  for(i=0;i<kidsName.length;i++) {
    kidChar = kidsName.charAt(i);
    if(kidChar.match(letterValid)) {
      divHtml+= '<td><img src="'+letterbase+kidChar.toLowerCase()+'.gif" alt="'+kidChar+'"></td>'; 
    } else {
      divHtml+= '<td><img src="images/gen/spacer.gif" width="5px" alt=" "></td>'; 
    }
  }
  for ( var i in icons )
  {
    if(i != 'indexOf') {
    num_icons = Math.ceil(parseInt(document.getElementById('icon_'+i).value)/2);
    for(j=1;j<=num_icons;j++){
      divHtml+= '<td><img src="'+iconbase+icons[i]+'" alt="'+icons[i]+'"></td>'; 
    }
    }
  }
    divHtml += '</tr></table>';		
    document.getElementById('items_display').innerHTML = divHtml;
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
  document.getElementById('items_display').style.backgroundColor = background_colours[colour];
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td bgcolor="#FFFFFF" align="center">

<form name="form1" action="addtoorder.php" method="post">
<input type="hidden" name="type" id="type" value="<?=$product_type?>" />
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
  <div align="center" style="background-image: url('images/identibracelet/boybandz.gif');
   background-repeat:no-repeat;background-position:center;width:360px;height:57px;" name="items_display" id="items_display" ></div>

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
        print ('<td bgcolor="'.$colour.'" width="24px" height="24px" style="padding: 0px 0px 0px 0px;"><img style="border-color:#FFFFFF;cursor:pointer;" src="images/colour.gif" alt="'.$name.'" onclick="setBackgroundColour(\''.$name.'\');" /></td>');
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
<td colspan="2"><img src="images/gen/spacer.gif" width="30" height="30"><div align="center"><a href="javascript:history.go(-1)" ><img src="images/nav/n_back.gif" name="back" width="58" height="22" border="0"></a> 
&nbsp;&nbsp;<a href="javascript: submitform()" ><img src="images/nav/n_continue_x.gif" name="Image28" width="80" height="22" border="0"></a> 
</div></td>
</td></tr>
</table>
</form>

</td>
                                </tr>
                              </table>