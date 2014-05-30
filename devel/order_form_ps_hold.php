<?
session_start();
include("useractions.php");

linkme();

$id = checkOrderId(false);

if(!$id){
	header("location:http://www.identikid.com.au/view_order.php");
	exit;
}

getCustomerDetails($id);

$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
if(mysql_num_rows($result)>0){
	while($qdata = mysql_fetch_array($result)){
		$totalprice += $qdata["price"];
	}
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order Online</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--


function initialise(){
	total = Number(document.forms[1].total.value);
	if(document.forms[1].oseas.value=="0"){
		postage=0;
	}else{
		postage=6;
	}
	disableStuff();
	populateCountry(false);
}

function changetotals(){
	if(document.forms[1].oseas[0].checked == true){
		postage=0;
		document.forms[1].postage.value = "0.00";
		document.forms[1].paymentmeth.disabled=false;
		document.forms[1].state.disabled=false;
	}else{
		postage=10;
		document.forms[1].postage.value = "10.00";
		document.forms[1].paymentmeth[1].selected = true;
		document.forms[1].paymentmeth.disabled=true;
		document.forms[1].state[0].selected=true;
		document.forms[1].state.disabled=true;
		disableStuff();
	}
	document.forms[1].grand.value = toDollarsAndCents(total+postage);
	populateCountry(true);
}

function populateCountry(resetCountry){
	if (document.forms[1].oseas[0].checked == true){
		document.forms[1].country.value = "Australia";
	}else if(resetCountry==true){
		document.forms[1].country.value = "";
	}
}

function toDollarsAndCents(value){
	value = value.toString();
	if(value.indexOf('.')==-1){
		value += '.';
	}
	while(value.length-(value.indexOf('.'))<3){
		value += '0';
	}
	return '$'+value;
}

function disableStuff(){
	document.forms[1].oseas[0].disabled = false;
	document.forms[1].oseas[1].disabled = false;
}

function checkReferral(){
	if(document.forms[1].referral.value=="School/Kindy/Daycare Centre"){
		document.forms[1].shopCode.value = "";
		document.forms[1].centreCode.disabled = false;
		document.forms[1].shopCode.disabled = true;
		alert('IMPORTANT: You can now enter your School/Kindy/Daycare Centre code.');
}else if(document.forms[1].referral.value=="Shop/Agent"){
		document.forms[1].centreCode.value = "";
		document.forms[1].centreCode.disabled = true;
		document.forms[1].shopCode.disabled = false;
		alert('IMPORTANT: You can now enter your Shop/Agent code.');
//		alert('IMPORTANT: Please check your order form for a' + '\n' + 'four digit fundraiser code. If there is a code, ' + '\n' + 'enter it in the Shop/Agent box, otherwise leave blank.');
	}else{
		document.forms[1].centreCode.value = "";
		document.forms[1].shopCode.value = "";
		document.forms[1].centreCode.disabled = true;
		document.forms[1].shopCode.disabled = true;
		
	}
}

function validateRetrieve(){
	emailaddress = document.forms[0].emailadd.value;
	if(document.forms[0].firstname.value==""){
		alert('You must enter your first name');
		return false;
	}else if(emailaddress==""){
		alert('You must enter your email address');
		return false;
	}else if(emailaddress.indexOf('@')==-1 || emailaddress.indexOf('@')==emailaddress.length-1){
		alert('You must enter a valid email address');
		return false;
	}
}

function validateForm(){
	emailaddress = document.forms[1].emailadd.value;
	if(document.forms[1].firstname.value==""){
		alert('You must enter your first name');
		return false;
	}else if(document.forms[1].surname.value==""){
		alert('You must enter your surname');
		return false;
	}else if(document.forms[1].address.value==""){
		alert('You must enter your address');
		return false;
	}else if(document.forms[1].suburb.value==""){
		alert('You must enter your suburb');
		return false;
	}else if(document.forms[1].postcode.value==""){
		alert('You must enter your postcode');
		return false;
	}else if(document.forms[1].state.value=="" && document.forms[1].oseas[0].checked==true){
		alert('You must enter your state');
		return false;
	}else if(document.forms[1].country.value==""){
		alert('You must enter your country');
		return false;
	}else if(emailaddress==""){
		alert('You must enter your email address');
		return false;
	}else if(emailaddress.indexOf('@')==-1 || emailaddress.indexOf('@')==emailaddress.length-1){
		alert('You must enter a valid email address');
		return false;
	}else if(document.forms[1].homephone.value==""){
		alert('You must enter home phone number');
		return false;
	}else if(document.forms[1].paymentmeth.value==""){
		alert('You must enter your payment method');
		return false;
	}else{
		document.forms[1].paymentmeth.disabled=false;
		return true;
	}
}
//-->
</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif'); initialise();">
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
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_order_online.gif" alt="Contact Us" width="168" height="45"></div></td>
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
                      <td width="10" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="30" height="10"></td>
                      <td width="397" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td class="maintext">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="45%" class="maintext" colspan="2"><strong>Existing Customers</strong></td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
								  <tr>
								  	<td colspan="2" class="smalltext">Existing customers can retrieve their details here:</td>
								  </tr>
                                  <tr> 
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
								  <? if($_GET["retrieved"]){?>
								  <tr>
								  	<td colspan="2" class="smalltext">
									<? if($_GET["retrieved"]=="true"){?>
									Your details have been retrieved from the database.
									<? }else{?>
									We could not find your details in the database.
									<? }?>
									</td>
								  </tr>
                                  <tr> 
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
								  <? }?>
								  <form name="retrievedetails" action="getcustdetails.php" method="post" onSubmit="return validateRetrieve();">
								  <input type="hidden" name="orderid" value="<? echo $id?>">
								  <tr>
								  	 <td width="45%" class="smalltext">First Name:</td>
									 <td><input type="text" name="firstname"></td>
								  </tr>
								  <tr>
								  	 <td width="45%" class="smalltext">Email Address:</td>
									 <td><input type="text" name="emailadd"></td>
								  </tr>
                                  <tr>
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
								  <tr>
								  	 <td width="45%" class="smalltext">&nbsp;</td>
									 <td><input type="image" value="submit" src="images/button_retrieve.gif" name="retrieve" width="94" height="22" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('retrieve','','images/button_retrieve_mo.gif',1)"></td>
								  </tr>
								  </form>
                                  <tr> 
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td width="45%" class="maintext"><strong>Your Details </strong></td>
                                    <td width="55%">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
								  <form name="form1" method="post" action="submitorder_ps.php" onSubmit="return validateForm();">
								<input type="hidden" name="orderid" value="<? echo $id;?>">
								<input type="hidden" name="submittype" value="unconfirmed">
                                  <tr> 
                                    <td valign="top" class="smalltext">Is your Address:</td>
                                    <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="9%"><input name="oseas" type="radio" class="smalltext" value="0" onClick="changetotals();" disabled<? if($oseas==0 || !$_POST["oseas"]){?> checked<? }?>> 
                                          </td>
                                          <td width="2%"><img src="images/spacer_trans.gif" width="5" height="10"></td>
                                          <td width="48%" class="smalltext">In Australia?</td>
                                          <td width="5%"><input name="oseas" type="radio" class="smalltext" value="1" onClick="changetotals();" disabled<? if($oseas==1){?> checked<? }?>></td>
                                          <td width="3%"><p><img src="images/spacer_trans.gif" width="5" height="10"></p></td>
                                          <td width="33%" class="smalltext">Overseas?</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">First Name:</td>
                                    <td valign="top" class="ordertext"> <p> 
                                        <input name="firstname" type="text" class="ordertext" id="firstname" size="30" value="<? echo $firstname;?>">
                                      </p></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext"> <p>Surname:</p></td>
                                    <td valign="top" class="ordertext"> <input name="surname" type="text" class="ordertext" id="surname" size="30" value="<? echo $surname;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Postal 
                                      Address:</td>
                                    <td valign="top" class="ordertext"> <input name="address" type="text" class="ordertext" id="address" size="30" value="<? echo $address;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Suburb/Town/City:</td>
                                    <td valign="top" class="ordertext"> <input name="suburb" type="text" class="ordertext" id="suburb" size="30" value="<? echo $suburb;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Post/Zip 
                                      Code:</td>
                                    <td valign="top" class="ordertext"> <input name="postcode" type="text" class="ordertext" id="postcode" size="30" value="<? echo $postcode;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">State:</td>
                                    <td valign="top" class="ordertext"> <select name="state" class="ordertext" id="state"<? if($oseas==1){?> disabled<? }?>>
                                        <option value=""></option>
                                        <option value="Australian Capital Territory"<? if($state=="Australian Capital Territory"){?> selected<? }?>>ACT</option>
                                        <option value="New South Wales"<? if($state=="New South Wales"){?> selected<? }?>>NSW</option>
                                        <option value="Northern Territory"<? if($state=="Northern Territory"){?> selected<? }?>>NT</option>
                                        <option value="Queensland"<? if($state=="Queensland"){?> selected<? }?>>QLD</option>
                                        <option value="South Australia"<? if($state=="South Australia"){?> selected<? }?>>SA</option>
                                        <option value="Tasmania"<? if($state=="Tasmania"){?> selected<? }?>>TAS</option>
                                        <option value="Victoria"<? if($state=="Victoria"){?> selected<? }?>>VIC</option>
                                        <option value="Western Australia"<? if($state=="Western Australia"){?> selected<? }?>>WA</option>
                                      </select></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" class="smalltext">Country:</td>
                                    <td valign="top" class="ordertext"><input name="country" type="text" class="ordertext" id="country" value="<? echo $country;?>" size="30" maxlength="100"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Email Address:</td>
                                    <td valign="top" class="ordertext"> <input name="emailadd" type="text" class="ordertext" id="emailadd" size="30" value="<? echo $emailadd;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Home Phone:</td>
                                    <td valign="top" class="ordertext"> <input name="homephone" type="text" class="ordertext" id="homephone" size="30" value="<? echo $homephone;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Work Phone:</td>
                                    <td valign="top" class="ordertext"> <input name="workphone" type="text" class="ordertext" id="workphone" size="30" value="<? echo $workphone;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Mobile 
                                      Phone:</td>
                                    <td valign="top" class="ordertext"> <input name="mobilephone" type="text" class="ordertext" id="mobilephone" size="30" value="<? echo $mobilephone;?>"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">How did 
                                      you hear about us?</td>
                                    <td valign="top" class="ordertext"><input name="hear_about" type="text" class="ordertext" id="hear_about" size="30"> 
                                      <br>
                                      <font size="1">eg: From a friend, Internet 
                                      Search, Advertisement, Brochure, At a School 
                                      or Kindy, Shop...</font></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Special 
                                      requirements:</td>
                                    <td valign="top" class="ordertext"> <textarea name="specialreqs" cols="25" rows="5" class="ordertext"><? echo stripslashes($specialreqs);?></textarea> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">&nbsp;</td>
                                    <td valign="top" class="ordertext">&nbsp;</td>
                                  </tr>
                                  <tr> 
										<td colspan="2" valign="top" class="maintext"><strong>Important! </strong></td> 
									</tr> 
									<tr> 
										<td valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
										<td valign="top" class="ordertext"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
									</tr> 
									<tr> 
										<td colspan="2" valign="top" class="smalltext"> 
											<table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext"> 
												<tr> 
													<td width="100%" colspan="3" valign="top"><strong>Do you have an order form with a 4 digit code on it?<br> 
														</strong>If so we need to know the number - without it we can't pay the fundraiser their commissions.</td> 
												</tr> 
											</table> 
										</td> 
									</tr> 
									<tr> 
										<td colspan="2" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
									</tr> 
									<tr> 
										<td colspan="2" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
									</tr> 
									<tr> 
										<td colspan="2" valign="top" class="smalltext">Please enter your 4 digit fundraiser code located in the white box on your order form.</td> 
									</tr> 
									<tr> 
										<td valign="top" class="smalltext">Fundraiser Code:</td> 
										<td valign="top" class="ordertext">
											<input name="referralcode" type="text" class="ordertext" id="referralcode" size="4" maxlength="4" value="<? echo $referralcode;?>"> 
										</td> 
									</tr> 
                                  <tr> 
                                    <td colspan="2" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Kindy/Day 
                                      Care Code:</td>
                                    <td valign="top" class="ordertext"> <input name="centreCode" type="text" class="ordertext" id="centreCode" size="4" maxlength="4"<? if($referral!="School/Kindy/Daycare Centre"){?> disabled<? }else{?> value="<? echo $referralcode;?>"<? }?>></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Shop/Agent 
                                      Code:</td>
                                    <td valign="top" class="ordertext"> <input name="shopCode" type="text" class="ordertext" id="shopCode" size="4" maxlength="4"<? if($referral!="Shop/Agent"){?> disabled<? }else{?> value="<? echo $referralcode;?>"<? }?>></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="maintext"><strong>Order 
                                      Details</strong></td>
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
                                  <tr>
                                    <td height="23" valign="top" class="smalltext">Order 
                                      Total:</td>
                                    <td valign="top" class="smalltext">$ 
                                      <input type="text" name="total" value="<? echo toDollarsAndCents($totalprice);?>" readonly=""></td>
                                  </tr>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Postage 
                                      &amp; Handling:</td>
                                    <td valign="top" class="smalltext">$ 
                                      <input type="text" name="postage" value="<? echo toDollarsAndCents($postage);?>" readonly=""></td>
                                  </tr>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Grand 
                                      Total:</td>
                                    <td valign="top" class="smalltext">$ 
                                      <input type="text" name="grand" value="<? echo toDollarsAndCents($totalprice+$postage);?>" readonly=""></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">&nbsp;</td>
                                    <td valign="top" class="ordertext">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="maintext"><strong>Payment 
                                      Method</strong></td>
                                    <td valign="top" class="ordertext">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td valign="top" class="ordertext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext">Method 
                                      of Payment</td>
                                    <td valign="top" class="ordertext"><select name="paymentmeth" class="ordertext" id="paymentmeth" onChange="disableStuff();">
                                        <option selected>Choose...</option>
                                        <option value="1"<? if($paymentmeth==1){?> selected<? }?>>I 
                                        will use my credit card now.</option>
                                        <option value="2"<? if($paymentmeth==2){?> selected<? }?>>I will pay the total into Identikids bank account</option>
                                     </select></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2" valign="top"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                          <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td width="52%"><input type="image" value="submit" src="images/button_continue.gif" name="Image22" width="94" height="22" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image22','','images/button_continue_mo.gif',1)"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2" valign="top">&nbsp;</td>
                                  </tr>
                                </table>
                              </form></td>
                          </tr>
                        </table></td>
                      <td width="10" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td colspan="3" valign="top"><br> </td>
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
                      <td valign="top" bgcolor="#FF0099" class="smalltext">
					  <?php
					  $secure=true;
					  include "navigation.php"; ?>
					  <!--<strong><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/products_home.php" class="type2">View 
                        Products</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/order_online.php" class="type2">Order 
                        Online</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/view_order.php" class="type2">View 
                        Order</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/fundraising.php" class="type2">Fundraisers 
                        </a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/about_us.php" class="type2">About 
                        Us</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/contact_us.php" class="type2">Contact 
                        Us</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/send_friend.php" class="type2">Send 
                        to a Friend</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/testimonials.php" class="type2">Testimonials</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/links.php" class="type2">Links</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/" class="type2">Home</a> 
                        <br>
                        <br>
                        </strong>
						--></td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php 
						$securesite = true;
						include "orders.php"; ?>
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
