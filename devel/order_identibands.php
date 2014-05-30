<?
header("Cache-control: private");
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=30 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());
$price = mysql_fetch_assoc($result);

$query2 = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=31 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result2 = mysql_query($query2);
if(!$result2) error_message(sql_error());
$price2 = mysql_fetch_assoc($result2);

$query2 = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=32 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result2 = mysql_query($query2);
if(!$result2) error_message(sql_error());
$price3 = mysql_fetch_assoc($result2);


$result = product_details(30, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].sprintf("%01.2f", $product['price']);



$result2 = product_details(31, $_COOKIE['currency'], $product);
$price_formatted2 = (int)$product['unitQuant'] . "  for " . $product['symbol'].sprintf("%01.2f", $product['price']);



$result3 = product_details(32, $_COOKIE['currency'], $product);
$price_formatted3 = (int)$product['unitQuant'] . "  for " . $product['symbol'].sprintf("%01.2f", $product['price']);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - Identi Bands</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<script language="JavaScript" src="myAHAHlib.js"></script>
<script>
	function adjustForm() {
		var quantity = document.form1.quantity.value;
		
		for (var i=1; i<quantity; i++)
		{	
			document.getElementById("design"+i).disabled=false;
			document.getElementById("bdesign"+i).style.display='';
			document.getElementById("banddesign"+i).style.display='';
		}
		for (var i=4; i>=quantity; i--)
		{	
			document.getElementById("design"+i).disabled=true;
			document.getElementById("bdesign"+i).style.display='none';
			document.getElementById("banddesign"+i).style.display='none';
		}
	}
	
	function submitform()
	{
  		document.form1.submit();
	}
</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style2 {
	font-size: 13px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-color: "#5D7EBC";
}
-->
</style>
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="index.php"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
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
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                <td colspan="3">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="4"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="13"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="50%" bgcolor="#FFFFFF"><h1><span class="headings">identi 
                        Bands </td>
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="50%" bgcolor="#FFFFFF" class="maintext"> <div align="left"><strong><? echo $price_formatted."<BR />".$price_formatted2."<BR />".$price_formatted3; ?></strong></div></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left"></div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="141" valign="top" class="smalltext">&nbsp;</td>
                            <td rowspan="5" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr><form name="form1" action="addtoorder.php" method="post"><input name="type" type="hidden" value="30">
                          <tr valign="top">
                            <td colspan="3" bgcolor="#FFFFFF">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                
                                <tr> 
                                  <td><p align="center"><img src="images/identibands_options.jpg" width="375" height="267"><br>
                                    <br>
                                  </p>                                  </td>
                                </tr>
                         
							    <tr>
                                  <td><table width="100%" border="0" cellpadding="3">            
								   <tr>
                					<td width="150">
								      <span class="style2">Select your quantity :</span></td>
								  <td>
								   <span class="admintext">
                                    <select name="quantity" id="quantity" onChange="adjustForm(),callAHAH('identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...')">
                                      <option value="1" SELECTED>1 Lot (10 Bands 1 design)</option>
                                      <option value="2">2 Lots (20 Bands 2 designs)</option>
                                      <option value="5">5 Lots (50 Bands 5 designs)</option>
                                    </select>
                                  </span></td>
								  </tr>
								  </table>
								  </td>
                                </tr>
                                <tr>
                                  <td height="10"><img src="images/spacer_trans.gif" width="1" height="10"></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="2">
                                        <tr>
                                          <td><span class="style2">Select a design</span></td>
                                          <td><div id="displaydiv" class="style3"></div></td>
                                        <tr> 
                                          <?php
			$quantity = 1;		
		
			for ($i=0; $i<=4; $i++)
			{ 
			$design = "design".$i; 
			?>
                                        <tr> 
                                          <td colspan="2">
                                            <div align="left" id="<?= 'b'.$design; ?>"><span class="style1">Design<? echo $i + 1; ?> 
                                              :</span> <br />
                                              <select name="<?= $design ?>" onChange="callAHAH('identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...')" id="<?= $design ?>" <? if ($i >= $quantity) echo "DISABLED" ?>>
                                                <option value="U" SELECTED>U - 
                                                Pink Ballerina</option>
                                                <option value="Y">Y - Surfer Guy</option>
                                                <option value="R">R - Truck</option>
                                                <option value="A1">A1 - Cow</option>
                                                <option value="D1">D1 - Surfer 
                                                Girl</option>
                                                <option value="Q">Q - Mermaid</option>
                                                <option value="F1">F1 - Rocket</option>
                                                <option value="N">N - Fairy</option>
                                                <option value="H">H - Butterfly</option>
                                                <option value="Z">Z - Pirate</option>
                                                <option value="G1">G1 - Bear</option>
                                                <option value="F">F - Nurse (Medical)</option>
                                              </select>
                                            </div>
											<div id="<?= 'band'.$design ?>"></div>
                                          </td>
                                        </tr>
                                        <? } ?>
                                      </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="30"><div align="center"><a href="products_identibands.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" name="back" width="94" height="22" border="0"></a> 
                                            &nbsp;&nbsp;<a href="javascript: submitform()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','images/button_continue_mo.gif',1)"><img src="images/button_continue.gif" name="Image28" width="94" height="22" border="0"></a> 
                                          </div></td>
                          </tr></form>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <tr bgcolor="#66FF66"> 
				<td colspan="2" valign="top">&nbsp;</td>
			  </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62" onLoad="callAHAH('identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...'), adjustForm()"></td>
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
            <?php include("footer.php") ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
