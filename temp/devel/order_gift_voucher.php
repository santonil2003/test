<?
header("Cache-control: private");
session_start();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - Gift Box</title>
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

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif')">
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
                      <td colspan="4"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="13"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="160" bgcolor="#FFFFFF"><h1><span class="headings">Gift 
                        Vouchers </td>
                      <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="235" bgcolor="#FFFFFF" class="maintext"> 
                        <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><img src="images/spacer_trans.gif" width="10" height="10"></strong></div>
                      </td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left">(A5)</div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="141" valign="top" class="smalltext">&nbsp;</td>
                            <td rowspan="5" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
						  <form name="giftbox" action="addtoorder.php" method="post">
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td>
								  <table border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td class="smalltext">Please what type 
                                            of voucher your would like</td>
                                          <td width="10" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td> <input type="hidden" name="price" value=""> 
                                            <input type="hidden" name="type" value="13"> 
                                            <select class="smalltext" name="quantdesc">
                                              <option value="Special Boy Voucher" selected>Special 
                                              Boy Voucher</option>
                                              <option value="Special Girl Voucher">Special 
                                              Girl Voucher</option>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="smalltext">&nbsp;</td>
                                          <td class="smalltext">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td class="smalltext">Please enter your 
                                            voucher value</td>
                                          <td class="smalltext">&nbsp;</td>
                                          <td><input name="textfield" type="text" value="$0.00"></td>
                                        </tr>
                                      </table>
								  </td>
                                </tr>
                              </table></td>
							  </form>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="30"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><img src="images/button_continue.gif" alt="Continue" name="continue" width="94" height="22" border="0"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="30" height="30"></td>
                          </tr>
                        </table></td>
                    </tr>
					<tr bgcolor="#66FF66"> 
						<td colspan="5" valign="top">&nbsp;</td>
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
