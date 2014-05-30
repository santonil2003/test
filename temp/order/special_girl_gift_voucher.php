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
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                    </tr>
<form name="addorder" method="POST" action="addtoorder.php">
<input type="hidden" name="type" value="15">
<input type="hidden" name="quantdesc" value="<?=$price['unitQuant']." Special Girl voucher for ".$price['symbol'];?>">

<script>

function checkVoucherValue()
{

	if(isNaN(document.addorder.price.value) || document.addorder.price.value<=0)
	{	
		self.alert('Please enter a valid number into the Voucher Value');
		
	}
	else {
		document.addorder.price.value = twoDecimals(document.addorder.price.value);
		document.addorder.quantdesc.value = document.addorder.quantdesc.value + document.addorder.price.value + " ea";
		document.addorder.submit();
	}

}

function twoDecimals(string){

	var bits = string.split(".");
	if(bits.length>1){
		if(bits[1].length==0){
			string = string + "00";
		}
		else if(bits[1].length==1){
			string = string + "0";
		}
		else if(bits[1].length>2){
			string = bits[0] + "." + bits[1].substr(0,2);
		}
	}
	else {
		string = string + ".00";
	}
	return string;

}
</script>
                
                    <tr valign="top"> 
                      <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                            <td colspan="3" align="center">
                            <table width="514" border="0" ><tr>
                            <td width="176" valign="top" class="smalltext"><div align="left">Please 
                                enter voucher value </div></td>
                            <td width="98" valign="top" class="smalltext"><strong>$</strong><input name="price" type="text" value="0.00" size="10"> 
                              <img src="images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="124" valign="top" class="smalltext"><div align="right"><a href="#" onClick="checkVoucherValue();" ><img src="images/nav/n_add_to_order.gif" alt="Add to Order" name="add_order" width="101" height="22" border="0"></a></div></td>
                            </td></tr></table></td>
                            <td width="10" rowspan="5" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <form name="giftbox" action="addtoorder.php" method="post">
                              <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td><p align="center"><img src="images/girl_outside.gif" alt="Special Girl Voucher" width="378" height="278"> 
                                      </p>
                                      <p align="center"> <img src="images/girl_inside.gif" alt="Special Girl Voucher" width="378" height="278">  
                                      </p></td>
                                  </tr>
                                </table></td>
                            </form>
                          </tr>
</form>
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
                        </table></td>
                    </tr>
                  </table>