<?
require_once("debug_log.php");

include("useractions.php");
checkStalePage();

include("header.php");

/* 
if ($_COOKIE['currency']==1) //Australia
{
	if(!isset($_SESSION["post_option"]))
	{
		header("location:view_order.php?error=nopostage");
	}
	elseif ($_SESSION["post_option"]!="Normal")
	{
		
		if (!isset($_SESSION["postageamount"]))
		{
			$postage = $_POST["postageamount"]; 
			$_SESSION["postageamount"] = $postage;
		}
		else
		{
			$postage = $_SESSION["postageamount"]; 
		}
		$postage_option = $_SESSION["post_option"];
		$post_address = "yes";
	}
	else // if normal post
	{
		$postage = $cur['postage'];
		$postage_option = $_SESSION["post_option"];
		$post_address = "no";
	}
}
else
{
	$postage = $cur['postage'];
}

$postage_option = $_SESSION["post_option"];
*/

/*if (isset($_GET["postageamount"]))
{
	$postage = $_GET["postageamount"];
	$postage_option = $_GET["postageoption"]; 
}*/

//print_r($_POST);

//include("useractions.php");

linkme();

$id = checkOrderId(false);
$order_id = $id+1000;
debug_log_add("order_form_ps.php", "Order ID: " . $order_id);




if(!$id){
	//header("location:view_order.php");
	//exit;
}

getCustomerDetails($id);




	$currencies = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "Australian Dollars (New Zealand Residents)", "currency" => "AU\$", "code" => "AUD"),
	);





//$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$cur = '';
$query = "SELECT * FROM currencies";
$result = mysql_query($query);
if(!$result) error_message(sql_error());
else {
  while($curTmp = mysql_fetch_assoc($result)){
   
    if($curTmp['id']=='1'){
      $postage[0] = $curTmp['postage'];
	   $postage[1] = $curTmp['expresspost']; 
	 }
	 
	 if($curTmp['id']==$_COOKIE['currency']){
	   $cur = $curTmp;
	   $postage[2] = $curTmp['postage'];
	   $postage[3] = $curTmp['expresspost'];
	 }else if($curTmp['id']=='2' && $_COOKIE['currency']=='1') {
	   $postage[2] = $curTmp['postage'];
	   $postage[3] = $curTmp['expresspost'];
	 }  
  }
  
  $postage[0] = sprintf("%01.2f",($postage[0]*$cur['rate']));
  $postage[1] = sprintf("%01.2f",($postage[1]*$cur['rate']));
  $postage[2] = sprintf("%01.2f",($postage[2]*$cur['rate']));
  $postage[3] = sprintf("%01.2f",($postage[3]*$cur['rate']));
  
/* $cur = mysql_fetch_assoc($result);
//if ($_COOKIE['currency']!=1)
//{
	$postage[0] = round(($cur['postage']*$cur['rate']), 1);
	$postage[1] = round(($cur['expresspost']*$cur['rate']), 1);
//}
*/
}

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

// with postage;
$totalprice += $postage[0];

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
		
		$address_cust = (!empty($_POST['address_cust']))?$_POST['address_cust']:$qdata["address_cust"];
		$suburb_cust = (!empty($_POST['suburb_cust']))?$_POST['suburb_cust']:$qdata["suburb_cust"];
		$postcode_cust = (!empty($_POST['postcode_cust']))?$_POST['postcode_cust']:$qdata["postcode_cust"];
		$state_cust = (!empty($_POST['state_cust']))?$_POST['state_cust']:$qdata["state_cust"];
		$country_cust = (!empty($_POST['country_cust']))?$_POST['country_cust']:$qdata["country_cust"];		
		
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

<script language="JavaScript" type="text/JavaScript">
<!--

var postageVals = new Array();

postageVals[0] = <?=$postage[0]?>;
postageVals[1] = <?=$postage[1]?>;
postageVals[2] = <?=$postage[2]?>;
postageVals[3] = <?=$postage[3]?>;

var totalCost = <?=$totalprice_withoutpostage?>;

function getSelectVal(selectList){

  var pagesObj = document.getElementById(selectList);
  return pagesObj.options[pagesObj.selectedIndex].value; 
  
}


function submitForm() {
  if(validateForm()){  
    $("#address").removeAttr("disabled");
    $("#suburb").removeAttr("disabled");
    $("#postcode").removeAttr("disabled");
    $("#state").removeAttr("disabled");
    $("#countrySel").removeAttr("disabled");
    $("#country_other").removeAttr("disabled");
    return true;
  } else {
    return false;
  }

}

function updateAddress() {

  var dupChkBox = $("#duplicate_address");
  var address_obj = $("#address");
  var address_cust_obj = $("#address_cust");
  var suburb_obj = $("#suburb");
  var suburb_cust_obj = $("#suburb_cust");
  var postcode_obj = $("#postcode");
  var postcode_cust_obj = $("#postcode_cust");
  var state_obj = $("#state");
  var state_cust_obj = $("#state_cust");
  var country_obj = $("#countrySel");
  var country_cust_obj = $("#countrySel_cust");
  var country_other_obj = $("#country_other");
  var country_other_cust_obj = $("#country_other_cust");
  
  
  toggleInput(address_obj);
  toggleInput(suburb_obj);
  toggleInput(postcode_obj);
  toggleInput(state_obj);
  toggleInput(country_obj);
  toggleInput(country_other_obj);
    
  if(dupChkBox.attr('checked') == true){
  
    address_cust_obj.keyup(function() {address_obj.val($(this).val()); });
    suburb_cust_obj.keyup(function() {suburb_obj.val($(this).val()); });
    postcode_cust_obj.keyup(function() {postcode_obj.val($(this).val()); });
    state_cust_obj.keyup(function() {state_obj.val($(this).val()); });
    country_cust_obj.change(function() {country_obj.val($(this).val()); update_Postage();});
    country_other_cust_obj.keyup(function() {country_other_obj.val($(this).val()); });
    
    address_obj.val(address_cust_obj.val());
    suburb_obj.val(suburb_cust_obj.val());
    postcode_obj.val(postcode_cust_obj.val());
    state_obj.val(state_cust_obj.val());
    country_obj.val(country_cust_obj.val());
    country_other_obj.val(country_other_cust_obj.val());
    
    update_Postage();
    
  } else {
    
    address_cust_obj.unbind('keyup');
    suburb_cust_obj.unbind('keyup');
    postcode_cust_obj.unbind('keyup');
    state_cust_obj.unbind('keyup');
    country_cust_obj.unbind('change');
    country_other_cust_obj.unbind('keyup');
    
  }
  
  return false;

}

function toggleInput(obj) {

  if ($(obj).attr("disabled") == true) 
  { 
    //$(obj).removeAttr("readonly"); 
    $(obj).removeAttr("disabled");  
  } else {
    //$(obj).attr("readonly", true); 
    $(obj).attr("disabled", true); 
  }
  
}

function update_Postage(){
 
  var tc = 0;
  
  if($("#countrySel").val() == "Australia") {
    if($("#postageoptionSel").val() == "Normal"){
      document.getElementById("postage").value = postageVals[0].toFixed(2);
      tc = totalCost + postageVals[0];
    } else {
      document.getElementById("postage").value = postageVals[1].toFixed(2);
      tc = totalCost + postageVals[1];
    }
  } else {
    if($("#postageoptionSel").val() == "Normal"){
      document.getElementById("postage").value = postageVals[2].toFixed(2);
      tc = totalCost + postageVals[2];
    } else {
      document.getElementById("postage").value = postageVals[3].toFixed(2);
      tc = totalCost + postageVals[3];
    }
  }
  document.getElementById("grand").value = tc.toFixed(2);
}

function initialise(){
	total = Number(document.forms[1].total.value);
	update_Postage();
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
	}else if(document.forms[1].address_cust.value==""){
		alert('You must enter your address');
		return false;
	}else if(document.forms[1].suburb_cust.value==""){
		alert('You must enter your suburb');
		return false;
	}else if(document.forms[1].postcode_cust.value==""){
		alert('You must enter your postcode');
		return false;
   }else if(document.forms[1].state_cust.value==""){
		alert('You must enter your state or territory');
		return false;
	}else if(document.forms[1].country_cust.value==""){
		alert('You must enter your country');
		return false;
	}else if(document.forms[1].country_cust.value=="Other" && document.forms[1].country_other_cust.value==""){
		alert('Your must enter a value for Country (Other)');
		return false;	
	}else if(document.forms[1].address.value==""){
		alert('You must enter a delivery address');
		return false;
	}else if(document.forms[1].suburb.value==""){
		alert('You must enter a delivery suburb');
		return false;
	}else if(document.forms[1].postcode.value==""){
		alert('You must enter a delivery postcode');
		return false;
}else if(document.forms[1].state.value==""){
		alert('You must enter a delivery state or territory');
		return false;
	}else if(document.forms[1].country.value==""){
		alert('You must enter a delivery country');
		return false;
	}else if(document.forms[1].country.value=="Other" && document.forms[1].country_other.value==""){
		alert('Your must enter a delivery value for Country (Other)');
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
	}else if(document.forms[1].paymentmeth.value=="0"){
		alert('You must enter your payment method');
		return false;
	}else if(document.forms[1].referralcode.value!="" && document.forms[1].referralcode.value.length!=4){
		alert('The Fundraiser code must be exactly 4 digits long');
		return false;
	}else if($("paymentmeth").val() =="0"){
		  alert('You must select a Payment Method');
		  document.forms[1].paymentmeth.focus();
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


$(document).ready(function(){
  $("input[name='vouchernumber']").keypress(function (e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    return UpdateVoucherNumber($(this).attr('id'), $(this)[0] ,code);
  });
});

//Check that the characters supplied by the user for the Voucher number do not contain illegal types
//Illegal characters include , . > ? " : { | % * # @ etc.
//Allow backspace, delete, space, arrow keys, shift, ctrl and tab
//Convert lower case characters to upper case as they are typed in
function UpdateVoucherNumber(num, obj, key){

   var ASCIICode = key;  
	var ReturnValue = false;
	if ((ASCIICode < 8) || ((ASCIICode > 9) && (ASCIICode < 16)) || ((ASCIICode > 17) && (ASCIICode < 32)) || ((ASCIICode > 32) && (ASCIICode <=38)) || ((ASCIICode >= 40) && (ASCIICode < 46)) || ((ASCIICode > 46) && (ASCIICode < 48)) || ((ASCIICode > 57) && (ASCIICode < 65)) || ((ASCIICode > 90) && (ASCIICode < 97)) || (ASCIICode > 122)){
		ReturnValue = false;
	}else{
		if ((ASCIICode == 9) || (ASCIICode == 16) || (ASCIICode == 17) || (ASCIICode == 32) || ((ASCIICode >= 37) && (ASCIICode <= 40)) || (ASCIICode == 46)){
			ReturnValue = true;
		}else if (ASCIICode == 8){
		  if (obj.value.length == 1 && ((num == 2) || (num == 3) || (num == 4))){  
		    $(obj).prev().focus();
		    ReturnValue = true;
		  } else {
		    ReturnValue = true;
		  }
		}else if (((ASCIICode >= 48) && (ASCIICode <= 57)) || ((ASCIICode >= 65) && (ASCIICode <= 90)) || ((ASCIICode >= 97) && (ASCIICode <= 122))){
			if (obj.value.length >= 3){
				if ((num == 1) || (num == 2) || (num == 3)){
					$(obj).next().focus();
				} 
			} else{
				obj.value += String.fromCharCode(ASCIICode).toUpperCase(); ;
				ReturnValue = false;
				if (obj.value.length >= 3){
					if ((num == 1) || (num == 2) || (num == 3)){
						$(obj).next().focus();
					}
				}
			}
		}
	}
	return ReturnValue;
}

/*
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
*/


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

                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="10" valign="top" bgcolor="#FFFFFF"><img src="images/gen/spacer.gif" width="30" height="10"></td>
                      <td width="397" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td class="maintext">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td width="55%" class="maintext" colspan="2"><strong>Existing 
                                    Customers</strong></td>
                                </tr>
                                <tr> 
                                  <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" class="smalltext">Existing customers 
                                    can retrieve their details here:</td>
                                </tr>
                                <tr> 
                                  <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <? if($_GET["retrieved"]){?>
                                <tr> 
                                  <td colspan="2" class="smalltext"> 
                                    <? if($_GET["retrieved"]=="true"){?>
                                    Your details have been retrieved from the 
                                    database. 
                                    <? }else{?>
                                    We could not find your details in the database. 
                                    <? }?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <? }?>
                                <form name="retrievedetails" action="/temp/getcustdetails.php" method="post" onSubmit="return validateRetrieve();">
                                  <input type="hidden" name="orderid" value="<? echo $id?>">
                                  <input type="hidden" name="postageamount" value="<? echo $postage[0]?>">
								   <input type="hidden" name="postageoption" value="<? echo $postage_option?>">
								     <input type="hidden" name="postageenc" value="<? echo md5($postage[0]) ?>">
                                  <input type="hidden" name="retrieve" value="1">
                                  <tr> 
                                    <td valign="top" width="55%" class="smalltext">First Name:</td>
                                    <td valign="top" ><input type="text" name="firstname"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top" width="55%" class="smalltext">Email Address:</td>
                                    <td valign="top" ><input type="text" name="emailadd"></td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                    <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td width="55%" class="smalltext">&nbsp;</td>
                                    <td><input type="image" value="submit" src="images/nav/n_retrieve.gif" name="retrieve" width="83" height="22" border="0"></td>
                                  </tr>
                                </form>
                                <tr> 
                                  <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td width="55%" class="maintext"><strong>Your 
                                    Details </strong></td>
                                  <td width="55%">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
								<form name="form1" method="post" action="/temp/submitorder_ps.php" onSubmit="return submitForm();">
                                <input type="hidden" name="orderid" value="<? echo $id;?>">
                              <!--  <input type="hidden" name="postageamount" value="<? //echo $postage?>">
							    <input type="hidden" name="postageoption" value="<? //echo $postage_option?>">-->
                                <input type="hidden" name="submittype" value="unconfirmed">
                                <input type="hidden" name="vouchercode" value="">
                                <input type="hidden" name="oldvouchercode" value="<?=str_replace(",", "", $_POST['vouchercode'])?>">
                                <input type="hidden" name="voucher_valid" value="<?=$voucher_valid?>">
                                <tr> 
                                  <td valign="top" class="smalltext">First Name:</td>
                                  <td valign="top" class="ordertext">
                                      <input name="firstname" type="text" class="ordertext" id="firstname" size="30" value="<? echo stripslashes($firstname);?>">
                                </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Surname:</td>
                                  <td valign="top" class="ordertext"> <input name="surname" type="text" class="ordertext" id="surname" size="30" value="<? echo stripslashes($surname);?>"></td>
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
                                  <td valign="top" class="smalltext">Mobile Phone:</td>
                                  <td valign="top" class="ordertext"> <input name="mobilephone" type="text" class="ordertext" id="mobilephone" size="30" value="<? echo $mobilephone;?>"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td width="55%" class="maintext"><strong>Your Address</strong></td>
                                  <td width="55%">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Street Address:<?php if ($post_address_cust == "yes") { echo "<br>
                                    (not P.O box thanks)"; } ?></td>
                                  <td valign="top" class="ordertext"> <input name="address_cust" type="text" class="ordertext" id="address_cust" size="30" value="<? echo stripslashes($address_cust);?>"></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Suburb/Town/City:</td>
                                  <td valign="top" class="ordertext"> <input name="suburb_cust" type="text" class="ordertext" id="suburb_cust" size="30" value="<? echo $suburb_cust;?>"></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Post/Zip 
                                    Code:</td>
                                  <td valign="top" class="ordertext"> <input name="postcode_cust" type="text" class="ordertext" id="postcode_cust" size="30" value="<? echo $postcode_cust;?>"></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">State/Territory:</td>
                                  <td valign="top" class="ordertext"> 

                                    <input type="text" name="state_cust" id="state_cust" size="30" class="ordertext" value="<? echo $state_cust;?>"> 

                                  </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Country:</td>
                                  <td valign="top" class="ordertext"> 
                                     <?
										
											
											echo '<select name="country_cust" class="ordertext" id="countrySel_cust">';


										$countries = array('','Algeria','Argentina','Australia','Austria','Belgium','Bolivia','Brazil','Bulgaria','Canada','Chile','China','Colombia',
'Costa Rica','Croatia','Czech Republic','Denmark','Dominican Republic','Ecuador','El Salvador','Estonia','Finland','France',
'Germany','Greece','Guatemala','Hong Kong','Hungary','Iceland','India','Indonesia','Ireland','Israel','Italy','Japan','Korea',
'Latvia','Lithuania','Luxembourg','Malaysia','Mexico','Middle East','Morocco','Netherlands','New Zealand','Norway','Panama',
'Paraguay','Peru','Philippines','Poland','Portugal','Puerto Rico','Romania','Russia','Singapore','Slovakia','Slovenia',
'South Africa','Spain','Sweden','Switzerland','Taiwan','Thailand','Tunisia','Turkey','United Kingdom','United States',
'Uruguay','Venezuela','Other');


//$found = array_search($country, $countries);

foreach($countries as $country_name)
{
	if($_COOKIE['currency'] ==1 && $country_name=="Australia" && $country_cust=="")
	{
		
		$SELECTED = "SELECTED";
	}
	elseif($_COOKIE['currency'] ==5 && $country_name=="New Zealand" && $country_cust=="")
	{
		$SELECTED = "SELECTED";
	}
	else 
	{
		$SELECTED = "";
	}
	
	
	if($found === false && $country_name=="Other" && $country_cust!="")
	{
		
		$SELECTED = "SELECTED";
		$country_other = $country_cust;
	}

	
	echo '<option value="' . htmlspecialchars($country_name) . '" ' . $SELECTED . '>' . htmlspecialchars($country_name) . '</option>';
	
	
}


?></select>
                                    </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Country (other):</td>
                                  <td valign="top" class="ordertext"> <input name="country_other_cust" type="text" class="ordertext" id="country_other_cust" size="30" value="<? echo $country_other_cust;?>"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext" align="left"><strong>Delivery Name</string> (if different from above):</td>
                                  <td valign="top" class="ordertext"> <input name="del_name" type="text" class="ordertext" id="del_name" size="30" value="<? echo stripslashes($del_name);?>"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td width="55%" class="maintext" colspan="2" align="left"><strong>Delivery Address</strong>&nbsp;&nbsp;
                                  <input type="checkbox" name="duplicate_address" id="duplicate_address" onclick="updateAddress();" value="1" <?=$dupChecked==true?'CHECKED':'';?> >Same As Above</td>
                                </tr> 
                                <tr> 
                                  <td valign="top" class="smalltext">Street Address:<?php if ($post_address == "yes") { echo "<br>
                                    (not P.O box thanks)"; } ?></td>
                                  <td valign="top" class="ordertext"> <input name="address" type="text" class="ordertext" id="address" size="30" value="<? echo stripslashes($address);?>"></td>
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
                                    <?// if($_COOKIE["currency"]==1){?>
                                    <!--<select name="state" class="ordertext"  id="state"<? if($oseas==1){?> disabled<? }?>>
                                      <option value=""></option>
                                      <option value="Australian Capital Territory"<? if($state=="Australian Capital Territory"){?> selected<? }?>>ACT</option>
                                      <option value="New South Wales"<? if($state=="New South Wales"){?> selected<? }?>>NSW</option>
                                      <option value="Northern Territory"<? if($state=="Northern Territory"){?> selected<? }?>>NT</option>
                                      <option value="Queensland"<? if($state=="Queensland"){?> selected<? }?>>QLD</option>
                                      <option value="South Australia"<? if($state=="South Australia"){?> selected<? }?>>SA</option>
                                      <option value="Tasmania"<? if($state=="Tasmania"){?> selected<? }?>>TAS</option>
                                      <option value="Victoria"<? if($state=="Victoria"){?> selected<? }?>>VIC</option>
                                      <option value="Western Australia"<? if($state=="Western Australia"){?> selected<? }?>>WA</option>
                                    </select> -->
                                    <?// }else{?>
                                    <input type="text" name="state" id="state" size="30" class="ordertext" value="<? echo $state;?>"> 
                                    <?// }?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Country:</td>
                                  <td valign="top" class="ordertext"> 
                                    <!-- <input name="country" type="text" class="ordertext" id="country" value="<? //echo $country;?>" size="30" maxlength="100"> -->
                                    <?
										/*
										if($_COOKIE['currency'] == 1 || $_COOKIE['currency'] ==5)
										{
											echo '<input type="hidden" name="country" value="';
											if($_COOKIE['currency'] == 5)
											{
												echo "New Zealand";
											}
											else 
											{
												echo "Australia";
											}
											echo '"><select name="country_pulldown" class="ordertext" id="country_pulldown"  disabled>';
										}
										else 
										{*/
											
											echo '<select name="country" class="ordertext" id="countrySel" onchange="return update_Postage();">';
										//}

										$countries = array('','Algeria','Argentina','Australia','Austria','Belgium','Bolivia','Brazil','Bulgaria','Canada','Chile','China','Colombia',
'Costa Rica','Croatia','Czech Republic','Denmark','Dominican Republic','Ecuador','El Salvador','Estonia','Finland','France',
'Germany','Greece','Guatemala','Hong Kong','Hungary','Iceland','India','Indonesia','Ireland','Israel','Italy','Japan','Korea',
'Latvia','Lithuania','Luxembourg','Malaysia','Mexico','Middle East','Morocco','Netherlands','New Zealand','Norway','Panama',
'Paraguay','Peru','Philippines','Poland','Portugal','Puerto Rico','Romania','Russia','Singapore','Slovakia','Slovenia',
'South Africa','Spain','Sweden','Switzerland','Taiwan','Thailand','Tunisia','Turkey','United Kingdom','United States',
'Uruguay','Venezuela','Other');


//$found = array_search($country, $countries);

foreach($countries as $country_name)
{
	if($_COOKIE['currency'] ==1 && $country_name=="Australia" && $country=="")
	{
		
		$SELECTED = "SELECTED";
	}
	elseif($_COOKIE['currency'] ==5 && $country_name=="New Zealand" && $country=="")
	{
		$SELECTED = "SELECTED";
	}
	else 
	{
		$SELECTED = "";
	}
	
	
	if($found === false && $country_name=="Other" && $country!="")
	{
		
		$SELECTED = "SELECTED";
		$country_other = $country;
	}

	
	echo '<option value="' . htmlspecialchars($country_name) . '" ' . $SELECTED . '>' . htmlspecialchars($country_name) . '</option>';
	
	
}


?></select>
                                    </td>
                                </tr>
                                <script type="text/javascript">
									function modify_country(f)
									{
										f.country.selectedIndex = f.country.length-1;
										update_Postage();		
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
                                  <td valign="top" class="smalltext">How did you 
                                    hear about us?</td>
                                  <td valign="top" class="ordertext"> 
                                    <?php
									if(($_SESSION['referrer']) && ($_SESSION['referrer'] != '') && ($_SESSION['fundraiser']) && ($_SESSION['fundraiser'] != '')){
									?>
                                    <input name="hear_about" type="text" class="ordertext" id="hear_about" size="30" value="<?=$_SESSION['referrer']?>" readonly="true"> 
                                    <?php
									}else{
									?>
                                    <!--<input name="hear_about" type="text" class="ordertext" id="hear_about" size="30" value="<?=stripslashes($hear_about)?>">-->
                                    <select name="hear_about" class="ordertext" id="hear_about" >
                                    <option <?=strtolower(stripslashes($hear_about))=="google"?"SELECTED":"";?> >google</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="yahoo"?"SELECTED":"";?> >yahoo</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="facebook"?"SELECTED":"";?> >facebook</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="kidspot"?"SELECTED":"";?> >kidspot</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="new idea"?"SELECTED":"";?> >new idea</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="sydneys child"?"SELECTED":"";?> >sydneys child</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="kids on the coast"?"SELECTED":"";?> >kids on the coast</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="parents website"?"SELECTED":"";?> >parents website</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="parents publication"?"SELECTED":"";?> >parents publication</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="friend"?"SELECTED":"";?> >friend</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="repeat order"?"SELECTED":"";?> >repeat order</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="playgroup"?"SELECTED":"";?> >playgroup</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="state playgroup publication"?"SELECTED":"";?> >state playgroup publication</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="fundraiser"?"SELECTED":"";?> >fundraiser</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="baby mall"?"SELECTED":"";?> >baby mall</option>
                                    <option <?=strtolower(stripslashes($hear_about))=="other"?"SELECTED":"";?> >other</option>
                                    </select>
                 
                                    
                                    <?php
									}
									?>
                                    <br> <font size="1">eg: From a friend, Internet 
                                    Search, Advertisement, Brochure, At a School 
                                    or Kindy, Shop...</font></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Special requirements:</td>
                                  <td valign="top" class="ordertext"> <textarea name="specialreqs" cols="25" rows="5" class="ordertext"><? echo stripslashes($specialreqs);?></textarea> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">&nbsp;</td>
                                  <td valign="top" class="ordertext">&nbsp;</td>
                                </tr>
                                <? if($cur['fundraisers']==1){?>
                                <tr> 
                                  <td colspan="2" valign="top" class="maintext"><strong>Important! 
                                    </strong></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td valign="top" class="ordertext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="top" class="smalltext"> 
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext">
                                      <tr> 
                                        <td width="100%" colspan="3" valign="top"><strong>Do 
                                          you have an order form with a 4 digit 
                                          code on it?<br>
                                          </strong>If so we need to know the number 
                                          - without it we can't pay the fundraiser 
                                          their commissions.</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="top" class="smalltext">Please 
                                    enter your 4 digit fundraiser code located 
                                    in the white box on your order form.</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Fundraiser 
                                    Code:</td>
                                  <td valign="top" class="ordertext"> 
                                    <?php
											if(($_SESSION['fundraiser']) && ($_SESSION['fundraiser'] != '') && ($_SESSION['referrer']) && ($_SESSION['referrer'] != '')){
											?>
                                    <input name="referralcode" type="text" class="ordertext" id="referralcode" size="4" maxlength="4" value="<?=$_SESSION['fundraiser']?>" readonly="true"> 
                                    <?php
											}else{
											?>
                                    <input name="referralcode" type="text" class="ordertext" id="referralcode" size="4" maxlength="4" value="<?=$referralcode?>"> 
                                    <?php
											}
											?>
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
                                  <td valign="top" class="maintext"><strong>Gift 
                                    Voucher</strong></td>
                                  <td valign="top" class="ordertext">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td valign="top" class="ordertext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="top" class="smalltext"> 
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="smalltext">
                                      <tr> 
                                        <td width="100%" colspan="3" valign="top"><strong>Do 
                                          you have an gift voucher to pay for 
                                          your order?<br>
                                          </strong>If so, please enter the Gift 
                                          Voucher Code below and click on Update 
                                          Voucher. If your purchase is greater 
                                          than the voucher amount then you will 
                                          need to continue by chosing an additional 
                                          payment method below.</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext" colspan=2><p>&nbsp;</p></td>
                                </tr>
                                <?

if($voucher_currency != $_COOKIE['currency'] && !empty($voucher_currency)){

	?>
                                <tr> 
                                  <td valign="top" class="smalltext" colspan=2><p><strong>Please 
                                      Note:</strong> The Gift Voucher you are 
                                      using has been bought in ( 
                                      <?=$currencies[$voucher_currency]['currency']?>
                                      ) which is different to that of your order 
                                      ( 
                                      <?=$currencies[$_COOKIE['currency']]['currency']?>
                                      ). It will be converted using the current 
                                      exchange rates from <a href="http://finance.yahoo.com.au" target="_blank">Yahoo 
                                      Finance</a> to the same currency as your 
                                      order.</p></td>
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
                                  <td height="23" valign="top" class="smalltext">Voucher 
                                    Total:</td>
                                  <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                    <input type="text" name="voucher_total" value="<? echo sprintf("%01.2f", $voucher_total)?>" readonly=""></td>
                                </tr>
                                <tr> 
                                  <td height="23" valign="top" class="smalltext">Voucher 
                                    Debit:</td>
                                  <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                    <input type="text" name="voucher_usage" value="-<? echo sprintf("%01.2f", $voucher_usage)?>" readonly=""></td>
                                </tr>
                                <tr> 
                                  <td height="23" valign="top" class="smalltext">Voucher 
                                    Balance:</td>
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
                                     <!-- 
                                   <input class="smalltext" type="text" class="voucher" id="voucher_1" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(0, this));" <?=$disabled?> value="<?=$code1?>"> 
                                    &nbsp;-&nbsp; <input class="smalltext" type="text" class="voucher" id="voucher_2" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(1, this));" <?=$disabled?> value="<?=$code2?>"> 
                                    &nbsp;-&nbsp; <input class="smalltext" type="text" class="voucher" id="voucher_3" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(2, this));" <?=$disabled?> value="<?=$code3?>"> 
                                    &nbsp;-&nbsp; <input class="smalltext" type="text" class="voucher" id="voucher_4" name="vouchernumber" size="5" maxlength="3" onKeyDown="JavaScript: return(UpdateVoucherNumber(3, this));" <?=$disabled?> value="<?=$code4?>"> 
                                    -->
                                    <input class="smalltext" type="text"  id="1" name="vouchernumber" size="5" maxlength="3" <?=$disabled?> value="<?=$code1?>"> 
                                    &nbsp;-&nbsp; <input class="smalltext" type="text" id="2" name="vouchernumber" size="5" maxlength="3"  <?=$disabled?> value="<?=$code2?>"> 
                                    &nbsp;-&nbsp; <input class="smalltext" type="text" id="3" name="vouchernumber" size="5" maxlength="3"  <?=$disabled?> value="<?=$code3?>"> 
                                    &nbsp;-&nbsp; <input class="smalltext" type="text" id="4" name="vouchernumber" size="5" maxlength="3"  <?=$disabled?> value="<?=$code4?>"> 

                                  </td>
                                </tr>
                                <?

if(!empty($voucher_error)){

	?>
                                <tr> 
                                  <td valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td valign="top" class="ordertext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="voucherError" colspan=2><strong>Voucher 
                                    Error: 
                                    <?=$voucher_error?>
                                    </strong></td>
                                </tr>
                                <?
}



if(false){
?>
                                <tr> 
                                  <td class="maintext" colspan=2><p>TEST DATA 
                                      - Please ignore</p></td>
                                </tr>
                                <?
}

?>
                                <tr> 
                                  <td class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td width="55%" class="smalltext">&nbsp;</td>
                                  <td><a href="#"  onClick="validateVoucherDetails(); return false;"><img src="images/nav/n_update_voucher.gif" name="updatevoucer" height="22" border="0"></a></td>
                                </tr>
                                <!-- end gift voucher -->
                                <tr> 
                                  <td colspan="2" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext"><strong>Order 
                                    Details</strong></td>
                                  <td valign="top">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td height="23" valign="top" class="smalltext">Order 
                                    Total:</td>
                                  <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                    <input type="text" name="total" value="<? echo sprintf("%01.2f", $totalprice_withoutpostage);?>" readonly=""></td>
                                </tr>
                               <? //if ($_COOKIE['currency']==1) { ?>
							    <tr>
                                  <td height="23" valign="top" class="smalltext">Postage 
                                    Option:</td>
                                  <td valign="top" class="smalltext"><font color="#FFFFFF"><? echo $cur['symbol'];?></font> 
                                  <!--<input type="text" name="postageoption" value="<? echo $postage_option;?>" readonly="">-->
                                  <select name="postageoption" id="postageoptionSel" style="width:185px;" onchange="return update_Postage();"  >
                                    <option value="Normal">Normal Post</option>
                                    <option value="Express">Express Post</option>
                                  </select>
                                  </td>
                                </tr>
								<? // } ?>
                                <tr> 
                                  <td height="23" valign="top" class="smalltext">Postage 
                                    &amp; Handling:</td>
                                  <td valign="top" class="smalltext"><? echo $cur['symbol'];?> 
                                    <input type="text" id="postage" name="postage" value="<? echo sprintf("%01.2f", $postage[0]);?>" readonly=""></td>
                                </tr>
                                <?

if($usevoucher)
{

	?>
                                <tr> 
                                  <td height="23" valign="top" class="smalltext">Voucher 
                                    Debit:</td>
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
                                    <input type="text" id="grand" name="grand" value="<? echo sprintf("%01.2f", $totalprice)?>" readonly=""></td>
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
                                  <td valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td valign="top" class="ordertext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="smalltext">Method of 
                                    Payment</td>
                                  <td valign="top" class="ordertext"> 
                                    <? 

if($totalprice>0){
	if($_COOKIE["currency"]==1){?>
                                    <select name="paymentmeth" class="ordertext" id="paymentmeth" onChange="disableStuff();">
                                      <option value="0" selected>Choose...</option>
                                      <option value="1"<? if($_POST['paymentmeth']==1){?> selected<? }?>>I 
                                      will use my credit card now.</option>
                                      <option value="4"<? if($_POST['paymentmeth']==4){?> selected<? }?>>I 
                                      will pay directly into Identikids bank account</option>
                                      <option value="5"<? if($_POST['paymentmeth']==5){?> selected<? }?>>Will 
                                      phone c/card by next working day</option>
                                      <option value="7"<? if($_POST['paymentmeth']==7){?> selected<? }?>>Please send me a PayPal Invoice</option>
									  <option value="8"<? if($_POST['paymentmeth']==8){?> selected<? }?>>PayPal </option>
                                    </select> 
                                    <?
	}else{
		?>
                                   <select name="paymentmeth" class="ordertext" id="paymentmeth" onChange="disableStuff();">
                                      <option value="0" selected>Choose...</option>
                                      <option value="1"<? if($_POST['paymentmeth']==1){?> selected<? }?>>Pay by credit card Now</option>
                                      <option value="5"<? if($_POST['paymentmeth']==5){?> selected<? }?>>Pay by credit card over the phone-Call during business hours</option>
                                      <option value="7"<? if($_POST['paymentmeth']==7){?> selected<? }?>>Direct deposit by internet banking</option>
									  <option value="8"<? if($_POST['paymentmeth']==8){?> selected<? }?>>Pay by paypal NOW </option>
                                   </select> 
                                    
                                    <!--<input name="paymentmeth" type="hidden" id="paymentmeth" value="1">
                                    Credit Card only -->
                                    <?
	}
}
else {
	?>
                                    <input name="paymentmeth" type="hidden" id="paymentmeth" value="6">
                                    No Payment Required 
                                    <?

}
	

?>
                                  </td>
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
                                        <td width="44%"><a href="javascript:history.go(-1)" ><img src="images/nav/n_back.gif" alt="Go back to previous page" name="back" width="58" height="22" border="0"></a></td>
                                        <td width="4%"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                        <td width="52%"><input type="image" value="submit" src="images/nav/n_submit.gif" name="Image22" width="68" height="22" border="0" ></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="top">&nbsp;</td>
                                </tr>
                              </table>
                              </form>
							  </td>
                          </tr>

<form name="retrievevoucher" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
<input type=hidden name=vouchercode value="<?=$_POST['vouchercode']?>">

</form>
                        </table></td>
                      <td width="10" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
<? include("footer.php"); ?>