<?

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=13 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);

?>
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm(){
	if(document.forms[0].quantdesc[0].selected==true){
		document.forms[0].price.value=<?=$price['price']?>;
	}else if(document.forms[0].quantdesc[1].selected==true){
		document.forms[0].price.value=<?=2*$price['price']?>;
	}if(document.forms[0].quantdesc[2].selected==true){
		document.forms[0].price.value=<?=3*$price['price']?>;
	}
	document.forms[0].submit();
}
//-->
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr valign="top"> 
                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left">(15cm x 20cm)</div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="141" valign="top" class="smalltext">&nbsp;</td>
                            <td rowspan="5" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
						  <form name="giftbox" action="addtoorder.php" method="post">
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td>
								  <table border="0" cellspacing="0" cellpadding="0">
								  	<tr>
										  <td class="smalltext">Please choose 
                                            how many Gift Packages you would like</td>
										<td width="10" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
										<td>
										<input type="hidden" name="price" value="">
										<input type="hidden" name="type" value="13">
										  <select class="smalltext" name="quantdesc">
											<option value="<?=$price['unitQuant']?> Gift Box for <?=$price['symbol'].$price['price']?>">1 Gift Box for <?=$price['symbol'].$price['price']?></option>
											<option value="2 Gift Boxes for <?=$price['symbol'].(2*$price['price'])?>">2 Gift Boxes for <?=$price['symbol'].(2*$price['price'])?></option>
											<option value="3 Gift Boxes for <?=$price['symbol'].(3*$price['price'])?>">3 Gift Boxes for <?=$price['symbol'].(3*$price['price'])?></option>
										  </select>
									  	</td>
									  </tr>
									 </table>
								  </td>
                                </tr>
                              </table></td>
							  </form>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="30" height="30"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="44%"><a href="javascript:history.go(-1)" ><img src="images/nav/n_back.gif" alt="Back to previous page" name="back" width="58" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="javascript: submitForm();" onMouseOut="MM_swapImgRestore()" ><img src="images/nav/n_continue_x.gif" alt="Continue" name="continue" width="80" height="22" border="0"></a></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="30" height="30"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>