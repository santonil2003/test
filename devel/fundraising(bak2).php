<?
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Fundraisers</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function disableForm(){
	if(document.forms[0].payment[1].checked==true){
		document.forms[0].bsbnum.disabled=false;
		document.forms[0].accnum.disabled=false;
		document.forms[0].accname.disabled=false;
	}else{
		document.forms[0].bsbnum.disabled=true;
		document.forms[0].accnum.disabled=true;
		document.forms[0].accname.disabled=true;
		document.forms[0].bsbnum.value="";
		document.forms[0].accnum.value="";
		document.forms[0].accname.value="";
	}
}

function validateForm(){
	if(document.forms[0].groupname.value==""){
		alert('Please enter a group name');
		return false;
	}else if(document.forms[0].contact.value==""){
		alert('Please enter a contact name');
		return false;
	}else if(document.forms[0].phonenum.value==""){
		alert('Please enter a phone number');
		return false;
	}else if(document.forms[0].emailadd.value==""){
		alert('Please enter a email address');
		return false;
	}else if(document.forms[0].postadd1.value=="" && document.forms[0].postadd2.value==""){
		alert('Please enter a postal address');
		return false;
	}else if(document.forms[0].payment[0].checked!=true && document.forms[0].payment[1].checked!=true){
		alert('Please enter a payment type');
		return false;
	}else if(document.forms[0].payment[1].checked==true){
		if(document.forms[0].bsbnum.value==""){
			alert('Please enter a bsb number');
			return false;
		}else if(document.forms[0].accnum.value==""){
			alert('Please enter an account number');
			return false;
		}else if(document.forms[0].accname.value==""){
			alert('Please enter an account name');
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}
//-->
</script>
<link href="css/identi kid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/image_fundraisers_more_mo.gif','images/button_back_mo.gif','images/button_send_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="740" valign="top"> 
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
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_fundraising.gif" alt="About Us" width="168" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                      <td width="397" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td class="maintext"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="383" height="67">
                                <param name="movie" value="images/plane_flies.swf">
                                <param name="quality" value="high">
                                <embed src="images/plane_flies.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="383" height="67"></embed></object></td>
                          </tr>
                          <tr> 
                            <td class="maintext"> <p><br>
                              </p>
                              <table width="190" height="120" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><div align="right"><a href="#" onClick="MM_openBrWindow('fundraiser_details.htm','','width=400,height=259')" onMouseOver="MM_swapImage('Image18','','images/image_fundraisers_more_mo.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="images/image_fundraisers_more.gif" alt="Find Out What The Fundraiser Includes" name="Image18" width="181" height="109" border="0"></a></div></td>
                                </tr>
                              </table>
                              <p><strong>identi Kid</strong> understands that 
                                every fundraiser is unique and we have therefore 
                                designed our packs to be flexible enough to suit 
                                your needs.</p>
                              <p>Our three options, <span class="type2"><strong><font color="#5d7eb9"><a href="#" class="type3" onClick="MM_openBrWindow('standard_popup.htm','','width=400,height=170')">standard</a></font></strong></span><strong>, 
                                <font color="#f0027f"><a href="#" class="type4" onClick="MM_openBrWindow('ongoing_popup.htm','','width=400,height=225')">ongoing</a></font> 
                                </strong>and<font color="#FF9900"><strong> <a href="#" class="type5" onClick="MM_openBrWindow('flexi_popup.htm','','width=400,height=150')">flexi</a></strong></font> 
                                have been proven highly successful and will cater 
                                for any requirements. You simply choose which 
                                option suits you and we do the rest.</p>
                              <p>We offer generous returns on all our products 
                                (about 15% on all our products) and with ten or 
                                more orders, give you a gift voucher to the value 
                                of $25 to use for your group or raffle to assist 
                                further fundraising.<br>
                                <br>
                                Don't forget our KIDCARDS too. Combine the two 
                                fundraisers and for no extra effort you can increase 
                                your returns and receive a free set of gift tags 
                                to display or raffle.</p>
                              <p>All our costs include GST and postage and handling. 
                                Our brochures, return postage and easy to use 
                                Fundraiser Kit are all supplied free of charge. 
                                Fundraisers will be completed and posted within 
                                three weeks. </p>
                              <p>To commence your identiKid Fundraiser fill in 
                                the registration form below, or call us on 1300 
                                133 949 and ask for our Information Pack. It&#8217;s 
                                that easy.<br>
                                <br>
                              </p></td>
                          </tr>
                          <tr>
                            <td class="maintext"> 
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><form name="form1" method="post" action="submitfundraising.php" onSubmit="return validateForm();">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td><div align="center">Fundraiser Registration Form</div></td>
                                        </tr>
                                        <tr> 
                                          <td><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext">
                                              <tr> 
                                                <td colspan="2">Name of Fundraiser Group</td>
                                                <td width="51%"><input name="groupname" type="text" class="ordertext" size="35"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Contact Person</td>
                                                <td><input name="contact" type="text" class="ordertext" size="35"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Phone Number</td>
                                                <td><input name="phonenum" type="text" class="ordertext" size="25"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">EmailAddress</td>
                                                <td><input name="emailadd" type="text" class="ordertext" size="35"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Postal Address (No PO Box's)</td>
                                                <td><input name="postadd1" type="text" class="ordertext" size="35"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp; </td>
                                                <td><input name="postadd2" type="text" class="ordertext" size="35"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Fundraising Options</td>
                                                <td><select name="fundoptions" class="ordertext">
                                                    <option>Standard</option>
                                                    <option>Ongoing</option>
                                                    <option>Flexi</option>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Type of Fundraisers</td>
                                                <td><select name="type" class="ordertext">
                                                    <option>Labels</option>
                                                    <option>KIDCARDS</option>
                                                    <option>Both</option>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Number of brochures required?</td>
                                                <td><input name="brochnumbers" type="text" class="ordertext" size="10"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">ABN (if applicable)</td>
                                                <td><input name="abnnum" type="text" class="ordertext" size="25"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Registered for GST?</td>
                                                <td><select name="gst" class="ordertext">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Preferred Payment Method</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td width="6%" valign="middle"><div align="center"><img src="images/black_dot.gif" width="3" height="6"></div></td>
                                                <td width="43%">Cheque</td>
                                                <td><input name="payment" type="radio" class="ordertext" value="cheque" onClick="disableForm();"></td>
                                              </tr>
                                              <tr> 
                                                <td valign="middle"><div align="center"><img src="images/black_dot.gif" width="3" height="6"></div></td>
                                                <td>E.F.T </td>
                                                <td><input name="payment" type="radio" class="ordertext" value="eft" onClick="disableForm();"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3" valign="middle"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td valign="middle">&nbsp;</td>
                                                <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext">
                                                    <tr> 
                                                      <td width="46%">BSB</td>
                                                      <td width="54%"><input name="bsbnum" type="text" class="ordertext" size="6" disabled></td>
                                                    </tr>
                                                    <tr> 
                                                      <td colspan="2" valign="middle"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                                    </tr>
                                                    <tr> 
                                                      <td>Account Number</td>
                                                      <td><input name="accnum" type="text" class="ordertext" size="25" disabled></td>
                                                    </tr>
                                                    <tr> 
                                                      <td colspan="2" valign="middle"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                                    </tr>
                                                    <tr> 
                                                      <td>Account Name</td>
                                                      <td><input name="accname" type="text" class="ordertext" size="25" disabled></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3" valign="middle"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">Special Requirements</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><div align="center"> 
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr> 
                                                        <td width="99%"> <div align="left"> 
                                                            <textarea name="requirements" cols="44" rows="5"></textarea>
                                                          </div></td>
                                                        <td width="1%">&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                  </div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="3"><table width="198" border="0" align="left" cellpadding="0" cellspacing="0">
                                                    <tr> 
                                                      <td width="44%"><input type="image" value="submit" src="images/button_send.gif" name="Image37" width="86" height="22" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','images/button_send_mo.gif',1)"></a></td>
                                                      <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                                      <td width="52%"><div align="center"></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                    </form></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/spacer_trans.gif" width="10" height="20"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="44%">&nbsp;</td>
                            <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="52%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#66FF66"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table></td>
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
</body>
</html>
