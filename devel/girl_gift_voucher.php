<?
session_start();


if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();

$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=15 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - Special Girl Voucher</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
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
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_add_order_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="368" bgcolor="#FFFFFF"><h1><span class="headings">Special 
                        Girl Vouchers</span></h1> <br>
                        <br>
                      </td>
                      <td width="30"><img src="images/spacer_trans.gif" width="10" height="10"> 
                        <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="176" valign="top" class="smalltext"><div align="left">Please 
                                enter voucher value </div></td>
                            <td width="98" valign="top" class="smalltext"><strong>$</strong><input name="price" type="text" value="0.00" size="10"> 
                              <img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="124" valign="top" class="smalltext"><div align="right"><a href="#" onClick="checkVoucherValue();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></div></td>
                            <td width="10" rowspan="5" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="30"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="44%">&nbsp;</td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="30"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr bgcolor="#66FF66"> 
                      <td colspan="4" valign="top">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top">
					  
					  <?php include "navigation.php"; ?></td>
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
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
