<?
session_start();
include("useractions.php");
include("vieworderlist.php");

if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}

linkme();
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Fundraisers</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--

function validateForm(){
	if(document.forms[0].quart_ok.checked==false){
		alert('You must agree that payments are made quarterly');
		return false;
	}else if(document.forms[0].groupname.value==""){
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
	}else{
		return true;
	}
}
function disableAbn(){
	if(document.forms[0].haveabnnum[0].checked==true){
		document.forms[0].abnnum.disabled=false;
	}else{
		document.forms[0].abnnum.disabled=true;
	}
}
//-->
</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
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
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_fundraising.gif" alt="About Us" width="168" height="45"></div></td>
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
                    <tr> 
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                      <td width="397" valign="top" bgcolor="#FFFFFF">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td class="maintext"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="383" height="67">
                                <param name="movie" value="images/plane_flies.swf">
                                <param name="quality" value="high">
                                <embed src="images/plane_flies.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="383" height="67"></embed></object></td>
                          </tr>
                          <tr> 
                            <td class="maintext">
							<? if($cur['fundraisers']==1){?>
                              <table width="190" height="120" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><div align="right"><a href="javascript:;" onClick="MM_openBrWindow('fundraiser_details.htm','','width=400,height=492')" onMouseOver="MM_swapImage('Image18','','images/image_fundraisers_more_mo.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="images/image_fundraisers_more.gif" alt="Find Out What The Fundraiser Includes" name="Image18" width="181" height="109" border="0"></a></div></td>
                                </tr>
                              </table>
                              <p><strong>Fantastic Fundraisers</strong><br>
                                An easy way to solve your lost property problem 
                                and earn extra money at the same time.! We offer 
                                generous returns on all our products (about 15%) 
                                and give every new fundraiser a gift voucher to 
                                the value of $25 to use for your group or raffle 
                                to assist further fundraising. </p>
                              <p><strong>How It Works</strong><br>
                                We provide each new fundraiser with a code which 
                                will be stamped onto each brochure. This allows 
                                us to keep track of your orders as they come in. 
                                Your customers can shop on line from our ever 
                                growing range of products or order by phone. Your 
                                code/orders will be automatically tallied together 
                                by computer and a print out of orders along with 
                                your commission will be sent to you on a quarterly 
                                basis. </p>
                              <p>Completed orders will be packed and posted individually 
                                to each customer within 4 to 5 working days.</p>
                              <p>No fuss, no hassles and no extra work for you!!<br>
                                <font color="#CCCCCC">_________________________________________</font><br>
                                <br>
                                If you'd like a Fundraiser Information &amp; Sample 
                                Pack, Please complete this section...</p>
                              <form name="form2" method="post" action="">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext">
                                  <tr> 
                                    <td colspan="2"> <div align="center"> <font size="3">Fundraiser 
                                        Info &amp; Sample Pack</font></div></td>
                                  </tr>
                                  <tr> 
                                    <td height="0" colspan="2"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2"><input type="checkbox" name="checkbox" value="checkbox">
                                      Yes, please send me the Fundraiser Info 
                                      &amp; Sample Pack.</td>
                                  </tr>
                                  <tr> 
                                    <td height="0" colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                  </tr>
                                  <tr> 
                                    <td width="48%">Name</td>
                                    <td width="52%"><input name="name" type="text" class="ordertext" id="name" size="30"></td>
                                  </tr>
                                  <tr> 
                                    <td height="0" colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                  </tr>
                                  <tr> 
                                    <td>Phone Number</td>
                                    <td><input name="phone" type="text" class="ordertext" id="phone" size="30"></td>
                                  </tr>
                                  <tr> 
                                    <td height="0" colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                  </tr>
                                  <tr> 
                                    <td>EmailAddress</td>
                                    <td><input name="emailadd" type="text" class="ordertext" size="30"></td>
                                  </tr>
                                  <tr> 
                                    <td height="0" colspan="2" valign="top"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">Postal Address<br> <font size="1">(Please 
                                      include your postcode)</font></td>
                                    <td><textarea name="postadd" cols="20" rows="5"></textarea></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                    <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image36','','images/button_send_mo.gif',1)"><img src="images/button_send.gif" alt="Send details to identiKid and receive a Fundraiser Info & Sample Pack" name="Image36" width="86" height="22" border="0"></a></td>
                                  </tr>
                                </table>
                              </form>
                              <p><font color="#CCCCCC">_________________________________________</font><br>
                                <br>
                                To commence your identikid fundraiser just fill 
                                in the registration form below or call us on 1300 
                                133 949 and ask for our info pack. Its that easy.<br>
                                <br>
                              </p>
                              </td>
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
                                                <td width="49%">Name of Fundraiser 
                                                  Group</td>
                                                <td width="51%"><input name="groupname" type="text" class="ordertext" size="30"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Contact Person</td>
                                                <td><input name="contact" type="text" class="ordertext" size="30"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td height="24">Phone Number</td>
                                                <td><input name="phonenum" type="text" class="ordertext" size="25"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>EmailAddress</td>
                                                <td><input name="emailadd" type="text" class="ordertext" size="30"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td valign="top">Postal Address<br><font size="1">(Please include your postcode)</font></td>
                                                <td><textarea name="postadd" cols="20" rows="5"></textarea></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td valign="top">Delivery Address<br><font size="1">(Our courier can not deliver to PO BOX addresses, please provide a full street address)</font></td>
                                                <td><textarea name="deladd" cols="20" rows="5"></textarea></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td valign="top">Fundraising Type</td>
                                                <td><input type="radio" value="single" name="fundraisingtype" checked>&nbsp;Single drive
												&nbsp;&nbsp;&nbsp;<input type="radio" value="ongoing" name="fundraisingtype">&nbsp;Ongoing</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Do you require a display stand?</td>
                                                <td><select name="displaystand" class="ordertext" id="displaystand">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No" selected>No</option>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Number of brochures required?</td>
                                                <td><input name="brochnumbers" type="text" class="ordertext" size="10"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Do you have an ABN number?</td>
                                                <td><input name="haveabnnum" type="radio" class="ordertext" value="yes" checked onClick="disableAbn();">
                                                  &nbsp;Yes&nbsp;&nbsp;
                                                  <input name="haveabnnum" type="radio" class="ordertext" value="no" onClick="disableAbn();">
                                                  &nbsp;No&nbsp;&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>ABN (if applicable)</td>
                                                <td><input name="abnnum" type="text" class="ordertext" size="25"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Registered for GST?</td>
                                                <td><select name="gst" class="ordertext">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Payment Method</td>
                                                <td>Cheque</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2" valign="middle"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td>Special Requirements</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"> 
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr> 
                                                        <td width="99%"> <div align="left"> 
                                                            <textarea name="requirements" cols="35" rows="5"></textarea>
                                                          </div></td>
                                                        <td width="1%">&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                  </div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2" valign="middle"><input type="checkbox" name="quart_ok">&nbsp;I acknowledge that payments are made quarterly throughout the year and am happy for payment to be made at these times.</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2" valign="middle"><img src="images/spacer_trans.gif" width="20" height="2"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><table width="188" border="0" align="left" cellpadding="0" cellspacing="0">
<tr> 
                                                      <td width="44%"></a> 
                                                      </td>
                                                      <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                                      <td width="52%"><div align="center"></div></td>
                                                    </tr>
                                                  </table><input type="image" value="submit" src="images/button_send.gif" name="Image37" width="86" height="22" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','images/button_send_mo.gif',1)"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                    </form></td>
                                </tr>
                              </table><? }else{?>
									Fundraisers are not available at present.<br>
									We are currently working on this, so please check back soon.
									<br><br>
									<table width="200">
									  <tr> 
										<td colspan="2" valign="middle"><img src="images/spacer_trans.gif" width="1" height="300"></td>
									  </tr>
									</table>
									<? }?></td>
                          </tr>
                        </table>
						</td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="15" height="10" border=""></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="20"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="3" bgcolor="#FFFFFF" align="right"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a>&nbsp;&nbsp;</td>
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
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
