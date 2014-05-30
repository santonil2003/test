<?
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Contact Us</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm()
{
	msg="";
	if(document.onlineenquiry.name.value=="")
	{
		msg += "- Please enter your name\n";
	}
	if(document.onlineenquiry.address.value=="")
	{
		msg += "- Please enter your postal address\n";
	}
	if(document.onlineenquiry.email.value=="")
	{
		msg += "- Please enter your email address\n";
	}
	if(msg=="")
	{
		document.onlineenquiry.submit();
	}
	else {
		self.alert("The following errors were found:\n" + msg);
	}
}
//-->
</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.
"></head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_send_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="740" valign="top"> 
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
          <td width="418" valign="top" bgcolor="#6FFF6F"> 
            <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
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
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_contact_us.gif" alt="Contact Us" width="169" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top" bgcolor="#66FF66"> 
                <td colspan="3" bgcolor="#6FFF6F"> 
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td valign="top" bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="5" colspan="3"><img src="images/spacer_trans.gif" width="10" height="5"></td>
                          </tr>
                          <? if($_COOKIE["currency"]==1){ ?>
                          <tr> 
                            <td width="42" valign="top"> 
<div align="right"><img src="images/pic_brochure.gif" alt="Mail" width="30" height="50"></div></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="375" valign="top"><form name="onlineenquiry" method="post" action="http://www.echidnaweb.com.au/cgi-sys/FormMail-clone.cgi">
<h1><span class="headings">Please mail me a brochure</span></h1>
                                <table width="341" border="0" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="117" class="maintext" > <p><strong>Your 
                                        Name*</strong></p></td>
                                    <td width="224" height="30"> <input type="text" name="name" class="formText" maxlength="30" size="30"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="17" valign="top" class="maintext"> 
                                      <p><strong><br>
                                        Your Postal Address*</strong></p></td>
                                    <td height="110"> <textarea name="address" class="formText"rows="6" cols="25"></textarea> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"> <p><strong>Your Email*</strong></p></td>
                                    <td height="30"> <input type="text" name="email" class="formText"maxlength="30" size="30"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"> <p><strong>Your Phone</strong></p></td>
                                    <td height="30"> <input type="text" name="phone" class="formText"maxlength="30" size="15"></td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext">&nbsp;</td>
                                    <td><p><span class="smallerText">* Required</span></p>
                                      <table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="44%" valign="top"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                          <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td width="52%" valign="top"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('send','','images/button_send_mo.gif',1)"> 
                                            <input name="Submit" type="image" id="Submit" src="images/button_send.gif" width="86" height="22" border="0"  onClick="submitForm(); return false;">
                                            </a> <input type="hidden" name="redirect" value="http://www.identikid.com.au/thankyou.php"> 
                                            <input type="hidden" name="recipient" value="info@identikid.com.au,leanne@identikid.com.au"> 
                                            <input type="hidden" name="subject" value="Brochure Request from website"> 
                                            <input type="hidden" name="required" value="name,address,email"> 
                                            <input type="hidden" name="title" value="Thank You"> 
                                          </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                              </form></td>
                          </tr>
                          <? } ?>
                        </table>
                        
                      </td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td valign="top"><br> </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="FF9900"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top"> 
                        <?php include("navigation.php"); ?>
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
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
