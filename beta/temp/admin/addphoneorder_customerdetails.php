<?
include_once("../common_constants.php");

if(!isset($useractions)){
	$includeabove = true;
	include("../useractions.php");
	include("../vieworderlist.php");
}

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);
$id = checkOrderId(false);

//Find out if there are any Vouchers in the database which have a balance greater than zero and which expire on or after today
$valid_vouchers_found = false;
$sql = "SELECT count(id) AS NumberOfVouchers FROM voucher WHERE voucher.expiry_date >= '" . date("Y-m-d") . "' AND voucher.balance > 0";
$sql_result = mysql_query($sql);
if(!$sql_result) error_message(sql_error());
if(mysql_num_rows($sql_result)>0){
	$sql_result_rs = mysql_fetch_assoc($sql_result);
	if ($sql_result_rs["NumberOfVouchers"] > 0){
		$valid_vouchers_found = true;
		//echo $sql . '<br>There are valid Vouchers in the database at the moment.<br>';
	//}else{
		//echo $sql . '<br>There are no valid Vouchers in the database at the moment!<br>';
	}
//}else{
	//echo $sql . '<br>There are no valid Vouchers in the database at the moment!<br>';
}

//Get the total cost for all items with the specified order number
$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
if(mysql_num_rows($result)>0){
	while($qdata = mysql_fetch_array($result)){
		$totalprice += $qdata["price"];
	}
}

getCustomerDetails($id);

if (isset($_POST["postageoption"]))
{
	$postageoption = $_POST["postageoption"];
	$orderid = $_POST["orderid"];
	$submittype = $_POST["submittype"];
	$firstname = $_POST["firstname"];
	$surname = $_POST["surname"];
	$del_name = $_POST["del_name"];
	$address = $_POST["address"];
	$suburb = $_POST["suburb"];
	$postcode = $_POST["postcode"];
	$state = $_POST["state"];
	$country = $_POST["country"];
	$address_cust = $_POST["address_cust"];
	$suburb_cust = $_POST["suburb_cust"];
	$postcode_cust = $_POST["postcode_cust"];
	$state_cust = $_POST["state_cust"];
	$country_cust = $_POST["country_cust"];
	$emailadd = $_POST["emailadd"];
	$homephone = $_POST["homephone"];
	$workphone = $_POST["workphone"];
	$mobilephone = $_POST["mobilephone"];
	$referralcode = $_POST["referralcode"];
	$hear_about = $_POST["hear_about"];
	$specialreqs = $_POST["specialreqs"];
	$postageopt = $_POST["postageoption"];
	$paymentmeth = $_POST["paymentmeth"];
	$vouchercode = $_POST["vouchercode"];
}

if ($postageoption == 'Australian Express')
{
	$sql = "SELECT expresspost FROM currencies WHERE id = 1";
	$result = mysql_query($sql)or die ("SQL ERROR");
	$row = mysql_fetch_assoc($result);
	$postage = $row["expresspost"]; 
}
else if($postageoption =='Overseas Express')
{
	$sql = "SELECT expresspost FROM currencies WHERE id = 2";
	$result = mysql_query($sql)or die ("SQL ERROR");
	$row = mysql_fetch_assoc($result);
	$postage = $row["expresspost"]; 
}
else if($postageoption =='Overseas Normal')
{
	$sql = "SELECT postage FROM currencies WHERE id = 2";
	$result = mysql_query($sql)or die ("SQL ERROR");
	$row = mysql_fetch_assoc($result);
	$postage = $row["postage"]; 
}
else
{
	$postage = $cur['postage'];
}

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - add phone order item</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript">
/*
function checkReferral(){
	if(document.forms[1].referral.value=="School/Kindy/Daycare Centre"){
		document.forms[1].shopCode.value = "";
		document.forms[1].centreCode.disabled = false;
		document.forms[1].shopCode.disabled = true;
		//alert('IMPORTANT: You can now enter your School/Kindy/Daycare Centre code.');
}else if(document.forms[1].referral.value=="Shop/Agent"){
		document.forms[1].centreCode.value = "";
		document.forms[1].centreCode.disabled = true;
		document.forms[1].shopCode.disabled = false;
	}else{
		document.forms[1].centreCode.value = "";
		document.forms[1].shopCode.value = "";
		document.forms[1].centreCode.disabled = true;
		document.forms[1].shopCode.disabled = true;
	}
}
*/
function disableStuff(){
	if (document.forms.addcustomerdetails.paymentmeth.value == 6){
		for (i = 1; i <= 4; i++){
			eval("document.forms.addcustomerdetails.vouchernumber_"+i+".disabled = false");
		}
		document.forms.addcustomerdetails.vouchernumber_1.focus();
	}else{
		for (i = 1; i <= 4; i++){
		   eval("document.forms.addcustomerdetails.vouchernumber_"+i+".disabled = true");
		}
	}
}
/*
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
*/
function validateForm(){ 

	emailaddress = document.forms[1].emailadd.value;
	if(document.forms[1].firstname.value==""){
		alert('You must enter a first name');
		document.forms[1].firstname.focus();
		return false;
	}else if(document.forms[1].surname.value==""){
		alert('You must enter a surname');
		document.forms[1].surname.focus();
		return false;
	}else if(document.forms[1].address.value==""){
		alert('You must enter a address');
		document.forms[1].address.focus();
		return false;
	}else if(document.forms[1].suburb.value==""){
		alert('You must enter a suburb');
		document.forms[1].suburb.focus();
		return false;
	}else if(document.forms[1].postcode.value==""){
		alert('You must enter a postcode');
		document.forms[1].postcode.focus();
		return false;
	//}else if(document.forms[1].state.value=="" && document.forms[1].oseas[0].checked==true){
		//alert('You must enter a state');
		//return false;
	}else if(document.forms[1].country.value==""){
		alert('You must enter a country');
		document.forms[1].country.focus();
		return false;
	}else if(document.forms[1].homephone.value==""){
		alert('You must enter home phone number');
		document.forms[1].homephone.focus();
		return false;
	}else if((document.forms[1].paymentmeth.value=="") || (document.forms[1].paymentmeth.value==0)){
		if (document.forms[1].grand.value <= 0){
			document.forms[1].paymentmeth.value = 0;
			return true;
		}else{
			alert('You must enter a payment method');
			document.forms[1].paymentmeth.focus();
			return false;
		}
	}else if(document.forms[1].paymentmeth.value == 5){
		if ((document.forms[1].vouchernumber_1.value == "") || (document.forms[1].vouchernumber_2.value == "") || (document.forms[1].vouchernumber_3.value == "") || (document.forms[1].vouchernumber_4.value == "")){
			alert('You must enter the entire Voucher number if you have selected to pay by Gift Voucher.');
			document.forms[1].vouchernumber_1.focus();
			return false;
		}else{
			//Add the user specified Voucher code to an array and store the results in a hidden form variable
			var vouchercode = new Array(4);
			for (i = 1; i <= 4; i++){
				vouchercode[i] = eval("document.forms[1].vouchernumber_"+i+".value");
			}
			document.forms[1].vouchercode.value = vouchercode;
			document.forms[1].action = "addphoneorder_voucherdetails.php";
			return true;
		}
	}else{
		document.forms[1].paymentmeth.disabled=false;
		return true;
	}
}

function validateRetrieve(){
	if(document.forms['retrievedetails'].firstname.value==""){
		alert('You must enter a first name');
		return false;
	}else if(document.forms['retrievedetails'].phonenumber.value==""){
		alert('You must enter a phone number');
		return false;
	}else{
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
	if ((ASCIICode < 8) || ((ASCIICode > 9) && (ASCIICode < 16)) || ((ASCIICode > 17) && (ASCIICode < 32)) || ((ASCIICode > 32) && (ASCIICode < 37)) || ((ASCIICode > 40) && (ASCIICode < 46)) || ((ASCIICode > 46) && (ASCIICode < 48)) || ((ASCIICode > 57) && (ASCIICode < 65)) || ((ASCIICode > 90) && (ASCIICode < 96)) || (ASCIICode > 122)){
		ReturnValue = false;
	}else{
		if ((ASCIICode == 8) || (ASCIICode == 9) || (ASCIICode == 16) || (ASCIICode == 17) || (ASCIICode == 32) || ((ASCIICode >= 37) && (ASCIICode <= 40)) || (ASCIICode == 46)){
			ReturnValue = true;
		}else if (((ASCIICode >= 48) && (ASCIICode <= 57)) || ((ASCIICode >= 65) && (ASCIICode <= 90)) || ((ASCIICode >= 96) && (ASCIICode <= 122))){
			if (obj.value.length >= 3){
				if ((num == 0) || (num == 1) || (num == 2)){
					document.forms.addcustomerdetails.vouchernumber[num + 1].focus();
				}
			}else{
				if(ASCIICode>=92 && ASCIICode<=105)
				{
					ASCIICode = ASCIICode - 48;
				}
				obj.value += String.fromCharCode(ASCIICode);
				ReturnValue = false;
				if (obj.value.length >= 3){
					if ((num == 0) || (num == 1) || (num == 2)){
						document.forms.addcustomerdetails.vouchernumber[num + 1].focus();
					}
				}
			}
		}
	}
	return ReturnValue;
}

function resubmit()
{
	document.addcustomerdetails.action="addphoneorder_customerdetails.php";
	document.addcustomerdetails.submit();
}
function process()
{
	document.addcustomerdetails.action="addphoneorder_confirmdetails.php";
	document.addcustomerdetails.submit();
}

function updateAddress()
{
	var cb = document.getElementById('use_address');
	if (cb.checked)
	{
		document.addcustomerdetails.address.value = document.addcustomerdetails.address_cust.value
		document.addcustomerdetails.suburb.value = document.addcustomerdetails.suburb_cust.value
		document.addcustomerdetails.postcode.value = document.addcustomerdetails.postcode_cust.value
		document.addcustomerdetails.state.value = document.addcustomerdetails.state_cust.value
		document.addcustomerdetails.country.selectedIndex = document.addcustomerdetails.country_cust.selectedIndex
	}
}
</script>
<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>
<!-- <body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" onLoad="initialise();"> 
 -->
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"> 
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr>
		<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
				<tr>
					<td colspan="3" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td> 
				</tr>
				<tr>
					<td><img src="../images/spacer_trans.gif" height="1" width="30" border="0"></td> 
					<td><img src="../images/spacer_trans.gif" height="1" width="540" border="0"></td> 
					<td><img src="../images/spacer_trans.gif" height="1" width="30" border="0"></td> 
				</tr>
				<tr> 
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td> 
					<td align="left">  
							<table cellpadding="0" cellspacing="0" border="0"> 
								<tr> 
									<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td> 
								</tr> 
								<tr> 
									<td colspan="2" class="admintext"><strong>Customer details</strong><br>Please avoid using double quotes "</td> 
								</tr>  
								<?php
								if (isset($_GET["msg"])){
								?>
								<tr> 
									<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td> 
								</tr> 
								<tr> 
									<td colspan="2" class="smalltext">
										<font color="#FFFFFF">
											<?php
												switch ($_GET["msg"]){
													case "C1":
														echo "WARNING: " . C1;
														break;
													case "C2":
														echo "WARNING: " . C2;
														break;
													case "C3":
														echo "WARNING: " . C3;
														break;
													case "C4":
														echo "WARNING: " . C4;
														break;
													case "C5":
														echo "WARNING: " . C5;
														break;
													case "N2":
														echo "NOTICE: " . N2;
														break;
												}
											?>
										</font>
									</td> 
								</tr> 
								<?php
								}
								?>
								<tr> 
									<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td> 
								</tr> 
								<tr> 
									<td colspan="2" class="smalltext">Retrieve existing details:</td> 
								</tr> 
								<tr> 
									<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td> 
								</tr> 
								<form name="retrievedetails" action="addphoneorder_retrievedetails.php" method="post" onSubmit="return validateRetrieve();">
								<input type="hidden" name="orderid" value="<? echo $id;?>">
								<tr> 
									<td class="smalltext">First name:</td> 
									<td><input class="smalltext" type="text" name="firstname"></td>
								</tr> 
								<tr> 
									<td class="smalltext">Phone number:</td> 
									<td><input class="smalltext" type="text" name="phonenumber">
									&nbsp;<input type="submit" value="retrieve &gt;"></td>
								</tr>
								</form>
								<tr> 
									<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td> 
								</tr> 
								<form name="addcustomerdetails" action="addphoneorder_confirmdetails.php" method="post" onSubmit="return validateForm();"> 
								<input type="hidden" name="orderid" value="<? echo $id;?>">
								<input type="hidden" name="submittype" value="unconfirmed">
								<input type="hidden" name="vouchercode" value="">
								<tr> 
									<td valign="top" class="smalltext">First Name:</td> 
									<td valign="top" class="ordertext"> 
										<p> 
											<input name="firstname" type="text" class="ordertext" id="firstname" size="30" value="<? echo $firstname;?>"> 
										</p> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext"> 
										<p>Surname:</p> 
									</td> 
									<td valign="top" class="ordertext"> 
										<input name="surname" type="text" class="ordertext" id="surname" size="30" value="<? echo $surname;?>"> 
									</td> 
								</tr> 
								<tr>
                          <td colspan="2"><strong>Home Address</strong></td>								
								</tr>
								<tr> 
									<td valign="top" class="smalltext">Postal Address:</td> 
									<td valign="top" class="ordertext"> 
										<input name="address_cust" type="text" class="ordertext" id="address_cust" size="30" value="<? echo $address_cust;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Suburb/Town/City:</td> 
									<td valign="top" class="ordertext"> 
										<input name="suburb_cust" type="text" class="ordertext" id="suburb_cust" size="30" value="<? echo $suburb_cust;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Post/Zip Code:</td> 
									<td valign="top" class="ordertext"> 
										<input name="postcode_cust" type="text" class="ordertext" id="postcode_cust" size="30" value="<? echo $postcode_cust;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">State:</td> 
									<td valign="top" class="ordertext"> 
									<? //if($_COOKIE["currency"]==1){?>
										<!--<select name="state" class="ordertext" id="state"> 
											<option value=""></option> 
											<option value="Australian Capital Territory"<? if($state=="Australian Capital Territory"){?> selected<? }?>>ACT</option> 
											<option value="New South Wales"<? if($state=="New South Wales"){?> selected<? }?>>NSW</option> 
											<option value="Northern Territory"<? if($state=="Northern Territory"){?> selected<? }?>>NT</option> 
											<option value="Queensland"<? if($state=="Queensland"){?> selected<? }?>>QLD</option> 
											<option value="South Australia"<? if($state=="South Australia"){?> selected<? }?>>SA</option> 
											<option value="Tasmania"<? if($state=="Tasmania"){?> selected<? }?>>TAS</option> 
											<option value="Victoria"<? if($state=="Victoria"){?> selected<? }?>>VIC</option> 
											<option value="Western Australia"<? if($state=="Western Australia"){?> selected<? }?>>WA</option> 
										</select>  -->
										 <?// }else{?>
										  <!--<input type="text" name="state" class="ordertext" size="30" value="<? echo $state;?>">-->
									  <? //}  ?>
									  <input type="text" name="state_cust" class="ordertext" size="30" value="<? echo $state_cust;?>"> </td>
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Country:</td> 
									<td valign="top" class="ordertext">
										<!-- <input name="country" type="text" class="ordertext" id="country" value="<? //echo $country; ?>" size="30" maxlength="100"> --> 
										<select name="country_cust" class="ordertext" id="country_cust">
											<option value=""></option>
											<option value="Algeria">Algeria</option>
											<option value="Argentina">Argentina</option>
											<option value="Australia" <?php if ($_COOKIE["currency"]==1){ ?>selected<? } ?>>Australia</option>
											<option value="Austria">Austria</option>
											<option value="Belgium">Belgium</option>
											<option value="Bolivia">Bolivia</option>
											<option value="Brazil">Brazil</option>
											<option value="Bulgaria">Bulgaria</option>
											<option value="Canada">Canada</option>
											<option value="Chile">Chile</option>
											<option value="China">China</option>
											<option value="Colombia">Colombia</option>
											<option value="Costa Rica">Costa Rica</option>
											<option value="Croatia">Croatia</option>
											<option value="Czech Republic">Czech Republic</option>
											<option value="Denmark">Denmark</option>
											<option value="Dominican Republic">Dominican Republic</option>
											<option value="Ecuador">Ecuador</option>
											<option value="El Salvador">El Salvador</option>
											<option value="Estonia">Estonia</option>
											<option value="Finland">Finland</option>
											<option value="France">France</option>
											<option value="Germany">Germany</option>
											<option value="Greece">Greece</option>
											<option value="Guatemala">Guatemala</option>
											<option value="Hong Kong">Hong Kong</option>
											<option value="Hungary">Hungary</option>
											<option value="Iceland">Iceland</option>
											<option value="India">India</option>
											<option value="Indonesia">Indonesia</option>
											<option value="Ireland">Ireland</option>
											<option value="Israel">Israel</option>
											<option value="Italy">Italy</option>
											<option value="Japan">Japan</option>
											<option value="Korea">Korea</option>
											<option value="Latvia">Latvia</option>
											<option value="Lithuania">Lithuania</option>
											<option value="Luxembourg">Luxembourg</option>
											<option value="Malaysia">Malaysia</option>
											<option value="Mexico">México</option>
											<option value="Middle East">Middle East</option>
											<option value="Morocco">Morocco</option>
											<option value="Netherlands">Netherlands</option>
											<option value="New Zealand">New Zealand</option>
											<option value="Norway">Norway</option>
											<option value="Panama">Panama</option>
											<option value="Paraguay">Paraguay</option>
											<option value="Peru">Peru</option>
											<option value="Philippines">Philippines</option>
											<option value="Poland">Poland</option>
											<option value="Portugal">Portugal</option>
											<option value="Puerto Rico">Puerto Rico</option>
											<option value="Romania">Romania</option>
											<option value="Russia">Russia</option>
											<option value="Singapore">Singapore</option>
											<option value="Slovakia">Slovakia</option>
											<option value="Slovenia">Slovenia</option>
											<option value="South Africa">South Africa</option>
											<option value="Spain">Spain</option>
											<option value="Sweden">Sweden</option>
											<option value="Switzerland">Switzerland</option>
											<option value="Taiwan">Taiwan</option>
											<option value="Thailand">Thailand</option>
											<option value="Tunisia">Tunisia</option>
											<option value="Turkey">Turkey</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="United States">United States</option>
											<option value="Uruguay">Uruguay</option>
											<option value="Venezuela">Venezuela</option>
										</select>
									</td> 
								</tr>
								<tr> 
									<td colspan="2">&nbsp;</td> 
								</tr> 
								<tr> 
									<td ><strong>Delivery Name:</strong></td> 
									<td><input class="smalltext" type="text" name="del_name"></td>
								</tr> 
								<tr> 
									<td colspan="2">&nbsp;</td> 
								</tr> 
								<tr>
                          <td ><strong>Delivery Address</strong></td><td><input type="checkbox" id="use_address" name="use_address" onclick="updateAddress();"/> <span class="smalltext">Use Same As Above</span>
								</tr>
								<tr> 
									<td valign="top" class="smalltext">Address:</td> 
									<td valign="top" class="ordertext"> 
										<input name="address" type="text" class="ordertext" id="address" size="30" value="<? echo $address;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Suburb/Town/City:</td> 
									<td valign="top" class="ordertext"> 
										<input name="suburb" type="text" class="ordertext" id="suburb" size="30" value="<? echo $suburb;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Post/Zip Code:</td> 
									<td valign="top" class="ordertext"> 
										<input name="postcode" type="text" class="ordertext" id="postcode" size="30" value="<? echo $postcode;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">State:</td> 
									<td valign="top" class="ordertext"> 
									<? //if($_COOKIE["currency"]==1){?>
										<!--<select name="state" class="ordertext" id="state"> 
											<option value=""></option> 
											<option value="Australian Capital Territory"<? if($state=="Australian Capital Territory"){?> selected<? }?>>ACT</option> 
											<option value="New South Wales"<? if($state=="New South Wales"){?> selected<? }?>>NSW</option> 
											<option value="Northern Territory"<? if($state=="Northern Territory"){?> selected<? }?>>NT</option> 
											<option value="Queensland"<? if($state=="Queensland"){?> selected<? }?>>QLD</option> 
											<option value="South Australia"<? if($state=="South Australia"){?> selected<? }?>>SA</option> 
											<option value="Tasmania"<? if($state=="Tasmania"){?> selected<? }?>>TAS</option> 
											<option value="Victoria"<? if($state=="Victoria"){?> selected<? }?>>VIC</option> 
											<option value="Western Australia"<? if($state=="Western Australia"){?> selected<? }?>>WA</option> 
										</select>  -->
										 <?// }else{?>
										  <!--<input type="text" name="state" class="ordertext" size="30" value="<? echo $state;?>">-->
									  <? //}  ?>
									  <input type="text" name="state" class="ordertext" size="30" value="<? echo $state;?>"> </td>
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Country:</td> 
									<td valign="top" class="ordertext">
										<!-- <input name="country" type="text" class="ordertext" id="country" value="<? //echo $country; ?>" size="30" maxlength="100"> --> 
										<select name="country" class="ordertext" id="country">
											<option value=""></option>
											<option value="Algeria">Algeria</option>
											<option value="Argentina">Argentina</option>
											<option value="Australia" <?php if ($_COOKIE["currency"]==1){ ?>selected<? } ?>>Australia</option>
											<option value="Austria">Austria</option>
											<option value="Belgium">Belgium</option>
											<option value="Bolivia">Bolivia</option>
											<option value="Brazil">Brazil</option>
											<option value="Bulgaria">Bulgaria</option>
											<option value="Canada">Canada</option>
											<option value="Chile">Chile</option>
											<option value="China">China</option>
											<option value="Colombia">Colombia</option>
											<option value="Costa Rica">Costa Rica</option>
											<option value="Croatia">Croatia</option>
											<option value="Czech Republic">Czech Republic</option>
											<option value="Denmark">Denmark</option>
											<option value="Dominican Republic">Dominican Republic</option>
											<option value="Ecuador">Ecuador</option>
											<option value="El Salvador">El Salvador</option>
											<option value="Estonia">Estonia</option>
											<option value="Finland">Finland</option>
											<option value="France">France</option>
											<option value="Germany">Germany</option>
											<option value="Greece">Greece</option>
											<option value="Guatemala">Guatemala</option>
											<option value="Hong Kong">Hong Kong</option>
											<option value="Hungary">Hungary</option>
											<option value="Iceland">Iceland</option>
											<option value="India">India</option>
											<option value="Indonesia">Indonesia</option>
											<option value="Ireland">Ireland</option>
											<option value="Israel">Israel</option>
											<option value="Italy">Italy</option>
											<option value="Japan">Japan</option>
											<option value="Korea">Korea</option>
											<option value="Latvia">Latvia</option>
											<option value="Lithuania">Lithuania</option>
											<option value="Luxembourg">Luxembourg</option>
											<option value="Malaysia">Malaysia</option>
											<option value="Mexico">México</option>
											<option value="Middle East">Middle East</option>
											<option value="Morocco">Morocco</option>
											<option value="Netherlands">Netherlands</option>
											<option value="New Zealand">New Zealand</option>
											<option value="Norway">Norway</option>
											<option value="Panama">Panama</option>
											<option value="Paraguay">Paraguay</option>
											<option value="Peru">Peru</option>
											<option value="Philippines">Philippines</option>
											<option value="Poland">Poland</option>
											<option value="Portugal">Portugal</option>
											<option value="Puerto Rico">Puerto Rico</option>
											<option value="Romania">Romania</option>
											<option value="Russia">Russia</option>
											<option value="Singapore">Singapore</option>
											<option value="Slovakia">Slovakia</option>
											<option value="Slovenia">Slovenia</option>
											<option value="South Africa">South Africa</option>
											<option value="Spain">Spain</option>
											<option value="Sweden">Sweden</option>
											<option value="Switzerland">Switzerland</option>
											<option value="Taiwan">Taiwan</option>
											<option value="Thailand">Thailand</option>
											<option value="Tunisia">Tunisia</option>
											<option value="Turkey">Turkey</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="United States">United States</option>
											<option value="Uruguay">Uruguay</option>
											<option value="Venezuela">Venezuela</option>
										</select>
									</td> 
								</tr> 
								<tr>
                          <td colspan="2">&nbsp;</td>								
								</tr 
								<tr> 
									<td valign="top" class="smalltext">Email Address:</td> 
									<td valign="top" class="ordertext"> 
										<input name="emailadd" type="text" class="ordertext" id="emailadd" size="30" value="<? echo $emailadd;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Home Phone:</td> 
									<td valign="top" class="ordertext"> 
										<input name="homephone" type="text" class="ordertext" id="homephone" size="30" value="<? echo $homephone;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Work Phone:</td> 
									<td valign="top" class="ordertext"> 
										<input name="workphone" type="text" class="ordertext" id="workphone" size="30" value="<? echo $workphone;?>"> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">Mobile Phone:</td> 
									<td valign="top" class="ordertext"> 
										<input name="mobilephone" type="text" class="ordertext" id="mobilephone" size="30" value="<? echo $mobilephone;?>"> 
									</td> 
								</tr>  
								<tr> 
									<td valign="top" class="smalltext">How did you hear about us?</td> 
									<td valign="top" class="ordertext"> 
										<input name="hear_about" type="text" class="ordertext" id="hear_about" size="30" value="<? echo $hear_about;?>"> 
									</td> 
								</tr>
								<tr> 
									<td valign="top" class="smalltext">Special requirements:</td> 
									<td valign="top" class="ordertext"> 
										<textarea name="specialreqs" cols="40" rows="5" class="ordertext"></textarea> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr>
								<tr> 
								</tr>
									<td valign="top" class="smalltext">Postage Option:</td> 
									<td valign="top" class="ordertext"> 
										<input name="postageoption" type="radio" value="Normal" <?php if ($postageoption =='Normal' || $postageoption == "") echo "checked";?> onClick="resubmit()">Normal &nbsp;&nbsp;<input name="postageoption" type="radio" value="Australian Express" <?php if ($postageoption =='Australian Express') echo "checked";?> onClick="resubmit()">Australian Express&nbsp;&nbsp;<input name="postageoption" type="radio" value="Overseas Normal"  <?php if ($postageoption =='Overseas Normal') echo "checked";?> onClick="resubmit()">Overseas Normal&nbsp;&nbsp;<input name="postageoption" type="radio" value="Overseas Express"  <?php if ($postageoption =='Overseas Express') echo "checked";?> onClick="resubmit()">Overseas Express
									</td> 
								</tr>					
								
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr>
									<td valign="top" class="smalltext">Referral Code:</td> 
									<td valign="top" class="ordertext"> 
										<input name="referralcode" type="text" class="ordertext" id="referralcode" size="4" maxlength="4" value="<? echo $referralcode;?>"> 
									</td> 
								</tr>
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr>
								<tr> 
									<td height="23" valign="top" class="smalltext">Order Total: </td> 
									<td valign="top" class="smalltext"><? echo $cur['symbol'];?>
										<input type="text" name="total" value="<? echo toDollarsAndCents($totalprice);?>" readonly=""> 
									</td> 
								</tr> 
								<tr> 
									<td height="23" valign="top" class="smalltext">Postage &amp; Handling:</td> 
									<td valign="top" class="smalltext"><? echo $cur['symbol'];?>
										<input type="text" name="postage" value="<? echo toDollarsAndCents($postage);?>" readonly=""> 
									</td> 
								</tr> 
								<tr> 
									<td height="23" valign="top" class="smalltext">Grand Total:</td> 
									<td valign="top" class="smalltext"><? echo $cur['symbol'];?>
										<input type="text" name="grand" value="<? echo toDollarsAndCents($totalprice+$postage);?>" readonly=""> 
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr> 
								<tr> 
									<td height="23" valign="top" class="smalltext">Additional amount:</td> 
									<td valign="top" class="smalltext"><? echo $cur['symbol'];?>
										<input type="text" name="upd_price"> 
									</td> 
								</tr> 
								<tr> 
									<td height="23" valign="top" class="smalltext">Reason:</td> 
									<td valign="top" class="smalltext">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="upd_reason" type="text" id="upd_reason">
									</td> 
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr>
								<tr> 
									<td valign="top" class="smalltext">Method of Payment</td> 
									<td valign="top" class="ordertext">
										<select name="paymentmeth" class="ordertext" id="paymentmeth" onChange="disableStuff();"> 
											<option value="0" selected>Choose...</option> 
											<option value="1"<? if($paymentmeth==1){?> selected<? }?>>I will use my credit card now.</option> 
											<option value="2"<? if($paymentmeth==2){?> selected<? }?>>I will send cheque/money order to the office.</option> 
											<option value="4"<? if($paymentmeth==4){?> selected<? }?>>I will pay directly into Identikids bank account.</option> 
											<option value="5"<? if($paymentmeth==5){?> selected<? }?>>I will pay by Phone with my credit card.</option> 
											<option value="6"<? if($paymentmeth==6){?> selected<? }?>>I will pay using a Gift Voucher.</option> 
											<option value="7"<? if($paymentmeth==7){?> selected<? }?>>I will pay via PayPal.</option> 
										</select> 
									</td> 
								</tr>
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr>
								<tr> 
									<td class="smalltext">Voucher Number:</td> 
									<td>
										<input class="smalltext" type="text" name="vouchernumber_1" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(0, this));" disabled>&nbsp;-&nbsp;
										<input class="smalltext" type="text" name="vouchernumber_2" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(1, this));" disabled>&nbsp;-&nbsp;
										<input class="smalltext" type="text" name="vouchernumber_3" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(2, this));" disabled>&nbsp;-&nbsp;
										<input class="smalltext" type="text" name="vouchernumber_4" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(3, this));" disabled>
									</td>
								</tr> 
								<tr> 
									<td valign="top" class="smalltext">&nbsp;</td> 
									<td valign="top" class="ordertext">&nbsp;</td> 
								</tr> 
								<tr>
									<td>&nbsp;</td>
									<td><input type="button" name="post_data" value="Submit" onclick="process()" /></td> 
								</tr> 
								<tr> 
									<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td> 
								</tr>
								</form> 
							</table> 
					</td> 
				</tr> 
			</table> 
		</td> 
	</tr> 
</table> 
</body>
</body>
</html>
