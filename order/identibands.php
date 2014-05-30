<?

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

?>
<script language="JavaScript" src="js/myAHAHlib.js"></script>
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
<form name="form1" action="addtoorder.php" method="post"><input name="type" type="hidden" value="30">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                
                                <tr> 
                                  <td><p align="center"><img src="images/identibands_options.jpg" width="375" height="267"><br>
                                    <br>
                                  </p>                                  </td>
                                </tr>
                         
							    <tr>
                                  <td align="center" ><table width="100%" border="0" cellpadding="3">            
								   <tr>
                					<td colspan="2"  align="center">
								      <span class="style2">Select your quantity :</span>&nbsp;&nbsp;&nbsp;
								   <span class="admintext">
                                    <select name="quantity" id="quantity" onChange="adjustForm(),callAHAH('identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...')">
                                      <option value="1" SELECTED>1 Lot (10 Bands 1 design)</option>
                                      <option value="2">2 Lots (20 Bands 2 designs)</option>
                                      <option value="5">5 Lots (50 Bands 5 designs)</option>
                                    </select>
                                  </span>
                              </td>
								  </tr>
								  </table>
								  </td>
                                </tr>
                                <tr>
                                  <td height="10"><img src="images/gen/spacer.gif" width="1" height="10"></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="2">
                                        <tr>
                                          <td colspan="2" align="center"><span class="style2"><br><br>Select a design</span></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="center" ><div id="displaydiv" class="style3"></div></td>
                                        </tr>
                                        <tr> 
                                          <?php
			$quantity = 1;		
		
			for ($i=0; $i<=4; $i++)
			{ 
			$design = "design".$i; 
			?>
                                        <tr> 
                                          <td colspan="2">
                                            <div align="center" id="<?= 'b'.$design; ?>"><span class="style1">Design<? echo $i + 1; ?> 
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
											<div id="<?= 'band'.$design ?>" align="center" ></div>
                                          </td>
                                        </tr>
                                        <? } ?>
                                      </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" onLoad="callAHAH('identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...'), adjustForm()"  width="30" height="30"><div align="center"><a href="javascript: history.go(-1);"><img src="images/nav/n_back.gif" name="back" width="58" height="22" border="0"></a> 
                                            &nbsp;&nbsp;<a href="javascript: submitform()" ><img src="images/nav/n_continue_x.gif" name="Image28" width="80" height="22" border="0"></a> 
                                          </div></td>
                          </tr></table></form>
                        