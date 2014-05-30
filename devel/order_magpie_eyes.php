<?
header("Cache-control: private");
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$result = product_details(41, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " from " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


/* 

$query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY item";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$k=0;
while($qdata = mysql_fetch_array($result)){
	$k++;
	$prices[$k] = $cur['symbol'].sprintf("%01.2f", $qdata['price']);
	$pricesDbl[$k] = $qdata['price'];
}
*/

$product_name = "Magpie Eyes "; 
$product_type = 41;

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
</head>

<body>
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
                      		<td valign="top" bgcolor="#FFFFFF"><h1 class="headings">Magpie Eyes</h1></td>
                      		<td align="right" bgcolor="#FFFFFF" class="maintext"><strong><?=$price_formatted;?></strong></td>
                      		<td bgcolor="#FFFFFF" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      	</tr>
                      	
                          
                          <tr valign="top"> 
                          	<td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
  <table cellpadding="0" cellspacing="2" border="0" align="center" >
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
<td class="maintext" align="center">
<div id="total_cost" name="total_cost"></div>
</td>
</tr>
<tr>
<td colspan="2"><img src="images/spacer_trans.gif" width="30" height="30"><div align="center"><a href="products_magpie_eyes.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" name="back" width="94" height="22" border="0"></a> 
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
<script>setup();</script>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
