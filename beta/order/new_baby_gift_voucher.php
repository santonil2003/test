<?

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=15 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);

?>
<script language="JavaScript" type="text/JavaScript">
<!--

function submitForm(){
	if(document.forms[0].quantdesc[0].selected==true){
		document.forms[0].price.value=3;
	}else if(document.forms[0].quantdesc[1].selected==true){
		document.forms[0].price.value=6;
	}if(document.forms[0].quantdesc[2].selected==true){
		document.forms[0].price.value=9;
	}
	document.forms[0].submit();
}
//-->
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td colspan="3" align="center">
                             <table width="320"><tr>
                            <td width="176" valign="top" class="smalltext"><div align="left">
								<strong><?=$price['symbol']." ".$price['price']?></strong></div></td>
                            <td width="98" valign="top" class="smalltext">&nbsp; </td>
<form name="addorder" method="POST" action="addtoorder.php">
<input type="hidden" name="type" value="15">
<input type="hidden" name="price" value="<?=$price['price']?>">
<input type="hidden" name="quantdesc" value="<?=$price['unitQuant']." New Baby voucher for ".$price['symbol'].$price['price'];?>">
                            <td width="124" valign="top" class="smalltext"><div align="right"><input type="image" src="images/nav/n_add_to_order.gif" alt="Add to Order" name="add_order" width="101" height="22" border="0" ></div></td>
                           </form>
                           </tr></table></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3" class=maintext>Please note this voucher can only be used to purchase a <a href="Products~Packs~Baby_Pack~Add_To_Order">New Baby Pack</a>.</td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>

                          <tr valign="top"> 
                            <form name="giftbox" action="addtoorder.php" method="post">
                              <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td><p align="center"><img src="images/baby_outside.gif" alt="Special Baby Voucher" width="378" height="278"> 
                                      </p>
                                      <p align="center"> <img src="images/baby_inside.gif" alt="Special Baby Voucher" width="378" height="278"> 
                                      </p></td>
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
                                  <td width="44%">&nbsp;</td>
                                  <td width="4%"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="javascript:history.go(-1)" ><img src="images/nav/n_back.gif" alt="Back to previous page" name="back" width="58" height="22" border="0"></a></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="30" height="30"></td>
                          </tr>
                        </table>