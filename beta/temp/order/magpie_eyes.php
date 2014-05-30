<?

$result = product_details(41, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " from " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);

$product_name = "Magpie Eyes "; 
$product_type = 41;

?>
<script  language="javascript">

$(document).ready(
  function() {
    setup();
  }
);


var currencySymbol = '<?=$cur['symbol'];?>';
var cost = <?=$price;?>;
var totalPacks = 1;
var totalCost = 0;
var totalAllowed = 20;


function setup() {
  updateCost();
}

function addIcon(picture) {
  if((totalPacks+1) <=totalAllowed) {
    totalPacks++;
    document.getElementById(picture+'_qty').innerHTML = '<font size="1" >'+totalPacks+'</font>';
    updateCost();
  }
  return false;
}

function remIcon(picture) {
  totalPacks=(totalPacks-1)<1?1:(totalPacks-1);
  document.getElementById(picture+'_qty').innerHTML = '<font size="1">'+totalPacks+'</font>';
  updateCost();
  return false;
}

function submitform()
{
  document.form1.submit();
}

function updateCost(){

  totalCost = cost*totalPacks;
  var quantDesc = currencySymbol+totalCost.toFixed(2);
  document.getElementById('total_cost').innerHTML = quantDesc;
  if(totalPacks > 1 ) packs = "Packs";
  else packs = "Pack";
  document.getElementById('quantdesc').value = totalPacks+" <?=$product_name?> "+packs+" For "+quantDesc;
  document.getElementById('quant').value = totalPacks;
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
<input type="hidden" name="type" id="type" value="41" />
<input type="hidden" name="price" id="price" value="" />
<input type="hidden" name="quant" id="quant" value="" />
<input type="hidden" name="quantdesc" id="quantdesc" value="" />
 <table width="100%" border="0" >
   <tr> <td align="center" colspan="2"><img src="images/magpie_eyes_big.gif" ></td></tr> 
   <tr> <td align="center" colspan="2">&nbsp;</td></tr> 
   <tr>
<td class="maintext"  valign="top" align="right" width="150px" ><b>Packs (24 per Pack):</b></td>
<td class="maintext" align="left" width="150px" >
 <div align="left">
  <table cellpadding="0" cellspacing="2" border="0" align="left" >
    <tr style="padding: 0px 0px 0px 0px;text-align:center;">
      <td style="padding: 0px 0px 0px 0px;text-align:center;">
        <table cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;" align="center" ><tr>
        <td><input type="image" src="images/identibracelet/add_icon.gif" name="add_icon" value="+" onclick="return addIcon('magpie_eyes');"></td> 
        <td width="20px" ><div name="magpie_eyes_qty" id="magpie_eyes_qty" height="15px" width="20px" ><font size="1">1</font></div></td>
        <td><input type="image" src="images/identibracelet/rem_icon.gif" name="add_icon" value="-" onclick="return remIcon('magpie_eyes');"></td>
        </tr></table>
      </td>
    </tr>
  </table>
</div>
</td>
</tr>
<tr>
<td class="maintext"  valign="top" align="right"><p><b>Total Cost:</b></p></td>
<td class="maintext" align="left" valign="bottom" >
<div id="total_cost" name="total_cost"></div>
</td>
</tr>
<tr>
<td colspan="2"><img src="images/gen/spacer.gif" width="30" height="30"><div align="center"><a href="javascript: history(-1);" ><img src="images/nav/n_back.gif" name="back" width="58" height="22" border="0"></a> 
&nbsp;&nbsp;<a href="javascript: submitform()" ><img src="images/nav/n_continue_x.gif" name="Image28" width="80" height="22" border="0"></a> 
</div></td>
</td></tr>
</table>
</form>

</td>
                                </tr>
                              </table>