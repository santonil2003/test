<?


session_start();
if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}


//print_r($_POST);

include("useractions.php");

linkme();

$id = checkOrderId(false);



if(!$id){
	header("location:view_order.php");
	exit;
}

getCustomerDetails($id);




	$currencies = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "Australian Dollars (New Zealand Residents)", "currency" => "AU\$", "code" => "AUD"),
	);





$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


$_SESSION['baby_pack_in_order'] =false;
$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
if(mysql_num_rows($result)>0){
	while($qdata = mysql_fetch_array($result)){
		$totalprice += $qdata["price"];

		// 
		if($qdata['type']==16){
			$_SESSION['baby_pack_in_order'] = true;
		}
	}
	if($totalprice<$cur['minimumOrder']){
		header("location:view_order.php");
		exit;
	}
}


$totalprice_withoutpostage = $totalprice;
$postage = $cur['postage'];
// with postage;
$totalprice += $cur['postage'];

// get Voucher Details;




if(!empty($_POST['vouchercode'])){
	$_SESSION['vouchercode'] = $_POST['vouchercode'];
	
	// if $_POST's are present, overwrite user details unless its retrieving details.

	if($_POST['retrieve']!="1"){
		
		$firstname = (!empty($_POST['firstname']))?$_POST['firstname']:$qdata["firstname"];
		$surname = (!empty($_POST['surname']))?$_POST['surname']:$qdata["surname"];
		$address = (!empty($_POST['address']))?$_POST['address']:$qdata["address"];
		$suburb = (!empty($_POST['suburb']))?$_POST['suburb']:$qdata["suburb"];
		$postcode = (!empty($_POST['postcode']))?$_POST['postcode']:$qdata["postcode"];
		$state = (!empty($_POST['state']))?$_POST['state']:$qdata["state"];
		$country = (!empty($_POST['country']))?$_POST['country']:$qdata["country"];
		$emailadd = (!empty($_POST['emailadd']))?$_POST['emailadd']:$qdata["emailadd"];
		$homephone = (!empty($_POST['homephone']))?$_POST['homephone']:$qdata["homephone"];
		$workphone = (!empty($_POST['workphone']))?$_POST['workphone']:$qdata["workphone"];
		$mobilephone = (!empty($_POST['mobilephone']))?$_POST['mobilephone']:$qdata["mobilephone"];
		$referral = (!empty($_POST['referral']))?$_POST['referral']:$qdata["referral"];
		$referralcode = (!empty($_POST['referralcode']))?$_POST['referralcode']:$qdata["referralcode"];
		$paymentmeth = (!empty($_POST['paymentmeth']))?$_POST['paymentmeth']:$qdata["paymentmeth"];
		$payment = (!empty($_POST['payment']))?$_POST['payment']:$qdata["payment"];
		$hear_about = (!empty($_POST['hear_about']))?$_POST['hear_about']:$qdata["hear_about"];
		$specialreqs = (!empty($_POST['specialreqs']))?$_POST['specialreqs']:$qdata["specialreqs"];
	}


}


list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice, $voucher_error, $voucher_currency) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);






//print "<p>error = $voucher_error</p>";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Order Online</title>
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

function initialise(){
	total = Number(document.forms[1].total.value);
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
//	}else if(document.forms[1].state.value==""){
//		alert('You must enter your state or territory');
//		return false;
	}else if(document.forms[1].country.value==""){
		alert('You must enter your country');
		return false;
	}else if(document.forms[1].country.value=="Other" && document.forms[1].country_other.value==""){
		alert('Your must enter a value for Country (Other)');
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
	}else if(document.forms[1].referralcode.value!="" && document.forms[1].referralcode.value.length!=4){
		alert('The Fundraiser code must be exactly 4 digits long');
		return false;
	}else if(document.forms[1].paymentmeth.value==6){
		if ((document.forms[1].vouchernumber[0].value == "") || (document.forms[1].vouchernumber[1].value == "") || (document.forms[1].vouchernumber[2].value == "") || (document.forms[1].vouchernumber[3].value == "")){
			alert('You must enter the entire Voucher number.');
			document.forms[1].vouchernumber[0].focus();
			return false;
		}else{

			//Add the user specified Voucher code to an array and store the results in a hidden form variable
			var vouchercode = new Array(4);
			for (i = 0; i < 4; i++){
				vouchercode[i] = document.forms[1].vouchernumber[i].value
			}
			document.forms[1].vouchercode.value = vouchercode;
			document.forms[1].paymentmeth.disabled=false;
//			document.forms[1].action = "addphoneorder_voucherdetails.php";

			if(document.form1.voucher_valid.value==0){
				self.alert('You must have a valid Voucher before continuing');
				return false;
			}
			else if(checkOldVoucherCode() ){
//				self.alert('VALID FORM');
//				return false;
				return true;
			}
			else {
				self.alert('Please Click on Update Voucher to update your order with the new Voucher Details.');
				return false;				
			}
		}
	
	}else{
		document.forms[1].paymentmeth.disabled=false;
//				self.alert('VALID FORM');
//		return false;
		return true;
	}
}


function checkOldVoucherCode()
{
	var oldvouchercode = document.form1.oldvouchercode.value;
	var vouchercode = "";

	for (i = 0; i < 4; i++){
		vouchercode = vouchercode + document.form1.vouchernumber[i].value;
	}
	if(oldvouchercode=="")
	{
		return true;
	}
	else if(vouchercode!=oldvouchercode)
	{
		return false;
	}
	else {
		return true;
	}
}

//Check that the characters supplied by the user for the Voucher number do not contain illegal types
//Illegal characters include , . > ? " : { | % * # @ etc.
//Allow backspace, delete, space, arrow keys, shift, ctrl and tab
//Convert lower case characters to upper case as they are typed in
function UpdateVoucherNumber(num, obj){
	var ASCIICode = window.event.keyCode;
	var ReturnValue = false;
	if ((ASCIICode < 8) || ((ASCIICode > 9) && (ASCIICode < 16)) || ((ASCIICode > 17) && (ASCIICode < 32)) || ((ASCIICode > 32) && (ASCIICode < 37)) || ((ASCIICode > 40) && (ASCIICode < 46)) || ((ASCIICode > 46) && (ASCIICode < 48)) || ((ASCIICode > 57) && (ASCIICode < 65)) || ((ASCIICode > 90) && (ASCIICode < 97)) || (ASCIICode > 122)){
		ReturnValue = false;
	}else{
		if ((ASCIICode == 8) || (ASCIICode == 9) || (ASCIICode == 16) || (ASCIICode == 17) || (ASCIICode == 32) || ((ASCIICode >= 37) && (ASCIICode <= 40)) || (ASCIICode == 46)){
			ReturnValue = true;
		}else if (((ASCIICode >= 48) && (ASCIICode <= 57)) || ((ASCIICode >= 65) && (ASCIICode <= 90)) || ((ASCIICode >= 97) && (ASCIICode <= 122))){
			if (obj.value.length >= 3){
				if ((num == 0) || (num == 1) || (num == 2)){
					document.forms.form1.vouchernumber[num + 1].focus();
				}
			}else{
				obj.value += String.fromCharCode(ASCIICode);
				ReturnValue = false;
				if (obj.value.length >= 3){
					if ((num == 0) || (num == 1) || (num == 2)){
						document.forms.form1.vouchernumber[num + 1].focus();
					}
				}
			}
		}
	}
	return ReturnValue;
}

function disableStuff(){
	if (document.forms.form1.paymentmeth.value == 6){
		for (i = 0; i < 4; i++){
			document.forms.form1.vouchernumber[i].disabled = false;
		}
		document.forms.form1.vouchernumber[0].focus();
	}else{
		for (i = 0; i < 4; i++){
			document.forms.form1.vouchernumber[i].disabled = true;
		}
	}
}


function validateVoucherDetails()
{
/*
		if ((document.forms[1].vouchernumber[0].value == "") || (document.forms[1].vouchernumber[1].value == "") || (document.forms[1].vouchernumber[2].value == "") || (document.forms[1].vouchernumber[3].value == "")){
			alert('You must enter the entire Voucher number.');
			document.form1.vouchernumber[0].focus();
			return false;
		}else{
*/
			//Add the user specified Voucher code to an array and store the results in a hidden form variable
			var vouchercode = new Array(4);
			for (i = 0; i < 4; i++){
				vouchercode[i] = document.forms[1].vouchernumber[i].value
			}
			document.forms[1].vouchercode.value = vouchercode;
//			document.forms[1].paymentmeth.disabled=false;
			document.form1.action="<?=$_SERVER['PHP_SELF']?>";
			document.form1.submit();
//		}

}

//-->
</script>
<link href="css/identi kid.css" rel="stylesheet" type="text/css">
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
									<input type="hidden" name="retrieve" value="1">
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
								<input type="hidden" name="vouchercode" value="">
								<input type="hidden" name="oldvouchercode" value="<?=str_replace(",", "", $_POST['vouchercode'])?>">
								<input type="hidden" name="voucher_valid" value="<?=$voucher_valid?>">
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
                                    <td valign="top" class="smalltext">State/Territory:</td>
                                    <td valign="top" class="ordertext">
									<? if($_COOKIE["currency"]==1){?>
									<select name="state" class="ordertext" id="state"<? if($oseas==1){?> disabled<? }?>>
                                        <option value=""></option>
                                        <option value="Australian Capital Territory"<? if($state=="Australian Capital Territory"){?> selected<? }?>>ACT</option>
                                        <option value="New South Wales"<? if($state=="New South Wales"){?> selected<? }?>>NSW</option>
                                        <option value="Northern Territory"<? if($state=="Northern Territory"){?> selected<? }?>>NT</option>
                                        <option value="Queensland"<? if($state=="Queensland"){?> selected<? }?>>QLD</option>
                                        <option value="South Australia"<? if($state=="South Australia"){?> selected<? }?>>SA</option>
                                        <option value="Tasmania"<? if($state=="Tasmania"){?> selected<? }?>>TAS</option>
                                        <option value="Victoria"<? if($state=="Victoria"){?> selected<? }?>>VIC</option>
                                        <option value="Western Australia"<? if($state=="Western Australia"){?> selected<? }?>>WA</option>
                                      </select>
									  <? }else{?>
									  <input type="text" name="state" size="30" value="<? echo $state;?>">
									  <? }?></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" class="smalltext">Country:</td>
                                    <td valign="top" class="ordertext">
										<!-- <input name="country" type="text" class="ordertext" id="country" value="<? //echo $country;?>" size="30" maxlength="100"> -->
										<select name="country" class="ordertext" id="country" onChange="modify_country_other(this.form);">
										<?

										$countries = array('','Algeria','Argentina','Australia','Austria','Belgium','Bolivia','Brazil','Bulgaria','Canada','Chile','China','Colombia',
'Costa Rica','Croatia','Czech Republic','Denmark','Dominican Republic','Ecuador','El Salvador','Estonia','Finland','France',
'Germany','Greece','Guatemala','Hong Kong','Hungary','Iceland','India','Indonesia','Ireland','Israel','Italy','Japan','Korea',
'Latvia','Lithuania','Luxembourg','Malaysia','Mexico','Middle East','Morocco','Netherlands','New Zealand','Norway','Panama',
'Paraguay','Peru','Philippines','Poland','Portugal','Puerto Rico','Romania','Russia','Singapore','Slovakia','Slovenia',
'South Africa','Spain','Sweden','Switzerland','Taiwan','Thailand','Tunisia','Turkey','United Kingdom','United States',
'Uruguay','Venezuela','Other');


$found = array_search($country, $countries);

foreach($countries as $country_name)
{
	if($_COOKIE['currency'] ==1 && $country_name=="Australia" && $country=="")
	{
		
		$SELECTED = "SELECTED";
	}
	else 
	{
		$SELECTED = "";
	}
	
	
	if($found == false && $country_name=="Other" && $country!="")
	{
		
		$SELECTED = "SELECTED";
		$country_other = $country;
	}
	echo '<option value="' . htmlspecialchars($country_name) . '" ' . $SELECTED . '>' . htmlspecialchars($country_name) . '</option>\n';
	
	
}


?>
										</select>
									</td>
                                  </tr>
                                  <script type="text/javascript">
									function modify_country(f)
									{
										f.country.selectedIndex = f.country.length-1;		
									}
									
									function modify_country_other(f)
									{
										if(f.country.value!="Other")
										{
											f.country_other.value="";
										}
									}
									
								</script>
                                  <tr> 
                                    <td valign="top" class="smalltext">Country (other):</td>
                                    <td valign="top" class="ordertext"> <input name="country_other" type="text" class="ordertext" id="country_other" size="30" value="<? echo $country_other;?>" onChange="modify_country(this.form);"></td>
                                  </tr>
                                  <tr>
                                  	<td colspan="2">&nbsp;</td>
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
                                    <td valign="top" class="ordertext"><input name="hear_about" type="text" class="ordertext" id="hear_about" size="30" value="<?=$hear_about?>"> 
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
									<? if($cur['fundraisers']==1){?>
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
									<? }else{?>
										<input name="referralcode" type="hidden" id="referralcode" value=""> 
									<? }?>

<!-- start gift voucher -->

                                  <tr> 
                                    <td valign="top" class="smalltext">&nbsp;</td>
                                    <td valign="top" class="ordertext">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="maintext"><strong>Gift Voucher</strong></td>
                                    <td valign="top" class="ordertext">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td valign="top" class="ordertext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
									<tr> 
										<td colspan="2" valign="top" class="smalltext"> 
											<table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext"> 
												<tr> 
													<td width="100%" colspan="3" valign="top"><strong>Do you have an gift voucher to pay for your order?<br> 
														</strong>If so, please enter the Gift Voucher Code below and click on Update Voucher.  If your purchase is greater than the voucher amount then you will need to continue by chosing an additional payment method below.</td> 
												</tr> 
											</table> 
										</td> 
									</tr>
                                  <tr> 
                                    <td valign="top" class="smalltext" colspan=2><p>&nbsp;</p></td>
                                  </tr>

<?

if($voucher_currency != $_COOKIE['currency'] && !empty($voucher_currency)){

	?>
                                  <tr> 
                                    <td valign="top" class="smalltext" colspan=2><p><strong>Please Note:</strong> The Gift Voucher you are using has been bought in 
																			(<?=$currencies[$voucher_currency]['currency']?>) which is different to that of your order (<?=$currencies[$_COOKIE['currency']]['currency']?>).
																			It will be converted using the current exchange rates from <a href="http://finance.yahoo.com.au" target="_blank">Yahoo Finance</a> to the same 
																			currency as your order.</p></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="smalltext" colspan=2><p>&nbsp;</p></td>
                                  </tr>
	<?

}



if($usevoucher)
{
	?>

                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Voucher Total:</td>
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                      <input type="text" name="voucher_total" value="<? echo sprintf("%01.2f", $voucher_total)?>" readonly=""></td>
                                  </tr>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Voucher Debit:</td>
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                      <input type="text" name="voucher_usage" value="-<? echo sprintf("%01.2f", $voucher_usage)?>" readonly=""></td>
                                  </tr>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Voucher Balance:</td>
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                      <input type="text" name="voucher_balance2" value="<? echo sprintf("%01.2f", $voucher_balance)?>" readonly=""></td>
                                  </tr>
	<?
}
?>

                                  <tr> 
                                    <td valign="top" class="smalltext">Voucher Number</td>
                                    <td valign="top" class="ordertext" nowrap>
<?

	list($code1,$code2,$code3,$code4)=split(",", $_SESSION['vouchercode']);
	$disabled = "";


/*
if($_POST['paymentmeth']==6)
{
}
else {
	$code1=$code2=$code3=$code4="";
	$disabled = "disabled";
}
*/

?>

					<input class="smalltext" type="text" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(0, this));" <?=$disabled?> value="<?=$code1?>">&nbsp;-&nbsp;
										<input class="smalltext" type="text" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(1, this));" <?=$disabled?> value="<?=$code2?>">&nbsp;-&nbsp;
										<input class="smalltext" type="text" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(2, this));" <?=$disabled?> value="<?=$code3?>">&nbsp;-&nbsp;
										<input class="smalltext" type="text" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(3, this));" <?=$disabled?> value="<?=$code4?>">
	</td>
</tr>

<?

if(!empty($voucher_error)){

	?>
                                 <tr> 
                                    <td valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td valign="top" class="ordertext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" class="voucherError" colspan=2><strong>Voucher Error: <?=$voucher_error?></strong></td>
                                  </tr>
 
<?
}



if(false){
?>

                                  <tr>
                                    <td class="maintext" colspan=2><p>TEST DATA - Please ignore</p>


																		</td>
                                  </tr>
<?
}

?>


                                  <tr>
                                    <td class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  </tr>

<tr>
	<td width="45%" class="smalltext">&nbsp;</td>
	<td><a href="#"  onClick="validateVoucherDetails();"><img src="images/button_updatevoucher.gif" name="updatevoucer" height="22" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('updatevoucher','','images/button_updatevoucher_mo.gif',1)"></a></td>
</tr>


<!-- end gift voucher -->





                                  <tr> 
                                    <td colspan="2" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?>  
                                      <input type="text" name="total" value="<? echo sprintf("%01.2f", $totalprice_withoutpostage);?>" readonly=""></td>
                                  </tr>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Postage 
                                      &amp; Handling:</td>
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?>  
                                      <input type="text" name="postage" value="<? echo sprintf("%01.2f", $postage);?>" readonly=""></td>
                                  </tr>
<?

if($usevoucher)
{

	?>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Voucher Debit:</td>
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                      <input type="text" name="voucher_usage" value="-<? echo sprintf("%01.2f", $voucher_usage)?>" readonly=""></td>
                                  </tr>
	<?




}

?>
                                  <tr> 
                                    <td height="23" valign="top" class="smalltext">Grand 
                                      Total:</td>
                                    <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                      <input type="text" name="grand" value="<? echo sprintf("%01.2f", $totalprice)?>" readonly=""></td>
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
                                    <td valign="top" class="ordertext">
									<? 

if($totalprice>0){
	if($_COOKIE["currency"]==1){?>
									<select name="paymentmeth" class="ordertext" id="paymentmeth" onChange="disableStuff();">
                                        <option selected>Choose...</option>
                                        <option value="1"<? if($_POST['paymentmeth']==1){?> selected<? }?>>I 
                                        will use my credit card now.</option>
                                        <option value="4"<? if($_POST['paymentmeth']==4){?> selected<? }?>>I will pay directly into Identikids bank account</option>
										<option value="5"<? if($_POST['paymentmeth']==5){?> selected<? }?>>Will phone c/card by next working day</option>
                                      </select>
									 <?
	}else{
		?>
		<input name="paymentmeth" type="hidden" id="paymentmeth" value="1"> Credit Card only
		<?
	}
}
else {
	?>
	<input name="paymentmeth" type="hidden" id="paymentmeth" value="6"> No Payment Required
	<?

}
	

?></td>
                                  </tr>

<tr> 
                                    <td valign="top" class="smalltext">&nbsp;</td>
                                    <td valign="top" class="ordertext">&nbsp;</td>
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

<form name="retrievevoucher" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
<input type=hidden name=vouchercode value="<?=$_POST['vouchercode']?>">

</form>
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
						$securesite = false;
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
</body>
</html>
