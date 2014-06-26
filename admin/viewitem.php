<?php
ini_set('display_errors', '0');
//print_r($_REQUEST);
$id = $_REQUEST['id'];
$showperpage = $_REQUEST['showperpage'];
$startrecord = $_REQUEST['startrecord'];
$showunfinished = $_REQUEST['showunfinished'];
$fromviewer = $_REQUEST['fromviewer'];

$includeabove = true;
include("../useractions.php"); // this includes common_db.php
include("../vieworderlist.php");

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

$query = "SELECT * FROM currencies";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = array();
while($qdata = mysql_fetch_array($result)){
	$cur[$qdata["id"]] = array();
	$cur[$qdata["id"]]['currName'] = $qdata["currName"];
	$cur[$qdata["id"]]['symbol'] = $qdata["symbol"];
	$cur[$qdata["id"]]['postage'] = $qdata["postage"];
	$cur[$qdata["id"]]['freeGift'] = $qdata["freeGift"];
}

//echo "REQUEST ID ".$_REQUEST['id']."id = ".$_GET['id']." global variable id not working<br />"; 

$query = "SELECT *, UNIX_TIMESTAMP(started) AS ustarted, UNIX_TIMESTAMP(finished) AS ufinished FROM orders WHERE id=".$_GET['id'];
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata = mysql_fetch_array($result)){
	$started = $qdata["ustarted"];
	$finished = $qdata["ufinished"];
	$customer = $qdata["customer"];
	$ordertype = $qdata["ordertype"];
	$currency = $qdata["currency"];
}


$query = "SELECT * FROM customers WHERE id=".$customer;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata = mysql_fetch_array($result)){
	$oseas = $qdata["oseas"];
	$firstname = stripslashes($qdata["firstname"]);
	$surname = stripslashes($qdata["surname"]);
	$address_cust = stripslashes($qdata["address_cust"]);
	$suburb_cust = stripslashes($qdata["suburb_cust"]);
	$postcode_cust = $qdata["postcode_cust"];
	$state_cust = $qdata["state_cust"];
	$country_cust = $qdata["country_cust"];
	$address = stripslashes($qdata["address"]);
	$suburb = stripslashes($qdata["suburb"]);
	$postcode = $qdata["postcode"];
	$state = $qdata["state"];
	$country = $qdata["country"];
	$emailadd = $qdata["emailadd"];
	$homephone = $qdata["homephone"];
	$workphone = $qdata["workphone"];
	$mobilephone = $qdata["mobilephone"];
	$referral = $qdata["referral"];
	$referralcode = $qdata["referralcode"];
	$hear_about = stripslashes($qdata["hear_about"]);
	$specialreqs = stripslashes($qdata["specialreqs"]);
	$notes = stripslashes($qdata["notes"]);
	$paymentmeth = $qdata["paymentmeth"];
	$payment = $qdata["payment"];
	$postage = $qdata["postage"];
	$postage_option = $qdata["postage_option"];
	$nameoncard = stripslashes($qdata["nameoncard"]);
	$ccxx = $qdata["ccxx"];
	$expdate = $qdata["expdate"];
	$seccode = $qdata["seccode"];
	$voucher_number = $qdata["voucher"];
	$voucher_amount = $qdata["voucher_amount"];
	$del_name = stripslashes($qdata["del_name"]);

	$confirmed = $qdata["confirmed"];
	$approved = $qdata["approved"];

	if( ($paymentmeth==1 && $approved==1) || ($confirmed=="confirmed") )
	{
		$changeToFinished = "checked";
	}
}

/*
if($paymentmeth==0){
	$paymentmeth="";
}else if($paymentmeth==1){
	$paymentmeth="Credit Card";
}else if($paymentmeth==2){
	$paymentmeth="Money Order";
}else if($paymentmeth==3){
	$paymentmeth="Phone Order";
}else if($paymentmeth==4){
	$paymentmeth="Direct Debit";
}else if($paymentmeth==6){
	$paymentmeth="Gift Voucher Payment";
}
*/

	$paymentmeths = array("0" => "",
		"1" => "Credit Card",
		"2" => "Money Order",
		"3" => "Phone Order",
		"4" => "Direct Debit",
		"5" => "Phone with CC",
		"6" => "Gift Voucher",
		"7" => "PayPal Invoice",
	);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - View Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
<script language="javascript">

function printAndToggle(urlstring){
	print();
	window.location.href='changestatus.php?'+urlstring;
}

function populateCountry(){
	if (document.forms[0].oseas[0].checked == true){
		document.forms[0].country.value = "Australia";
		document.forms[0].state.disabled=false;
	}else{
		document.forms[0].country.value = "";
		document.forms[0].state[0].selected=true;
		document.forms[0].state.disabled=true;
	}
}
</script>
<style type="text/css" media="print">
.maintext {
	font-family: "Comic Sans MS";
	font-size: 12px;
}
.whitetext {
	font-family: "Comic Sans MS";
	font-size: 12px;
	color: #FFFFFF;
}

INPUT, SELECT, .ORDERTEXT {
	font-family: "Comic Sans MS";
	font-size: 12px;
	border-width : 1px;
	border-style : inset;
	height: 17px;
	margin: 0px;
}

TEXTAREA {
	font-family: "Comic Sans MS";
	font-size: 12px;
	border-width : 1px;
	border-style : inset;
}
	

.noshow {
	display: none;
}

body {
	margin: 0px;
}

</style>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"> 
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%"> 
	<tr> 
		<td valign="top" align="center"> 
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="">
        <tr class="noshow"> 
          <td colspan=3><img src="../images/spacer_trans.gif" height="10" width="330" border="0"></td>
        </tr>
        <tr class="noshow"> 
         <!-- <td align=center colspan=3><input type="button" onClick="history.go();document.location='orders_admin.php?startrecord=<? echo $startrecord;?>&showperpage=<? echo $showperpage;?>';" value="Back"> -->
		  <td align=center colspan=3><input type="button" onClick="javascript:window.location.href='orders_admin.php';" value="Back"> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" onClick="printAndToggle('startrecord=<? echo $startrecord;?>&showperpage=<? echo $showperpage;?>&fromviewer=true&to=printed&id=<?=$_GET['id']?>');" value="print this page & change status"> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="update order details" onClick="document.updateOrder.submit();"> 
          </td>
        </tr>
        <tr class="noshow"> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr><form name="updateOrder" action="viewitem_updateorder.php" method="post">
        <input type="hidden" name="orderid" value="<?=$_GET['id']?>">
        <input type="hidden" name="customer" value="<? echo $customer;?>">
        <input type="hidden" name="showperpage" value="<? echo $showperpage;?>">
        <input type="hidden" name="startrecord" value="<? echo $startrecord;?>">
        <tr> 
          <td valign="top"> <table cellpadding="0" cellspacing="0" border="0" bgcolor="">
              <tr  class="noshow"> 
                <td colspan=3><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
              </tr>
              <? if($_GET["edited"]=="true"){?>
              <tr> 
                <td align="center" colspan="3" class="maintext"><strong>Successfully 
                  updated order.</strong></td>
              </tr>
              <? }?>
              <tr> 
                <td class="maintext" align="right">Receipt Number:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"><?=$_GET['id']+1000;?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">First Name:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="firstname" value="<? echo $firstname;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Last Name:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="surname" value="<? echo $surname;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="left" colspan="3"><strong>Home Address</strong></td>
              </tr>
               <tr> 
                <td class="maintext" align="right">Address:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="address_cust" value="<? echo $address_cust;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Suburb:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="suburb_cust" value="<? echo $suburb_cust;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Postcode:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="postcode_cust" value="<? echo $postcode_cust;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td align="right" class="maintext">State:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext">
                
                <!-- <select name="state_cust" class="ordertext" id="state_cust" <? if($oseas==1){?> disabled<? }?>>
                    <option value=""></option>
                    <option value="Australian Capital Territory"<? if($state_cust=="Australian Capital Territory"){?> selected<? }?>>ACT</option>
                    <option value="New South Wales"<? if($state_cust=="New South Wales"){?> selected<? }?>>NSW</option>
                    <option value="Northern Territory"<? if($state_cust=="Northern Territory"){?> selected<? }?>>NT</option>
                    <option value="Queensland"<? if($state_cust=="Queensland"){?> selected<? }?>>QLD</option>
                    <option value="South Australia"<? if($state_cust=="South Australia"){?> selected<? }?>>SA</option>
                    <option value="Tasmania"<? if($state_cust=="Tasmania"){?> selected<? }?>>TAS</option>
                    <option value="Victoria"<? if($state_cust=="Victoria"){?> selected<? }?>>VIC</option>
                    <option value="Western Australia"<? if($state_cust=="Western Australia"){?> selected<? }?>>WA</option>
                  </select>-->
                  
                  <input type="text" name="state_cust" id="state_cust" value="<?=$state_cust?>" size="35" class="input_padding" > 
                   </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Country:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="country_cust" value="<? echo $country_cust;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="left" colspan="3"><strong>Delivery Address</strong></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Delivery Name:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="del_name" value="<? echo $del_name;?>" size="35" class="input_padding"> 
               </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Address:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="address" value="<? echo $address;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Suburb:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="suburb" value="<? echo $suburb;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Postcode:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="postcode" value="<? echo $postcode;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td align="right" class="maintext">State:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> 
                <!--<select name="state" class="ordertext" id="state"<? if($oseas==1){?> disabled<? }?>>
                    <option value=""></option>
                    <option value="Australian Capital Territory"<? if($state=="Australian Capital Territory"){?> selected<? }?>>ACT</option>
                    <option value="New South Wales"<? if($state=="New South Wales"){?> selected<? }?>>NSW</option>
                    <option value="Northern Territory"<? if($state=="Northern Territory"){?> selected<? }?>>NT</option>
                    <option value="Queensland"<? if($state=="Queensland"){?> selected<? }?>>QLD</option>
                    <option value="South Australia"<? if($state=="South Australia"){?> selected<? }?>>SA</option>
                    <option value="Tasmania"<? if($state=="Tasmania"){?> selected<? }?>>TAS</option>
                    <option value="Victoria"<? if($state=="Victoria"){?> selected<? }?>>VIC</option>
                    <option value="Western Australia"<? if($state=="Western Australia"){?> selected<? }?>>WA</option>
                  </select>-->
                   <input type="text" name="state" id="state" value="<?=$state?>" size="35" class="input_padding" >                  
                   </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Country:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="country" value="<? echo $country;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Overseas:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input name="oseas" type="radio" class="smalltext" value="0" <? if($oseas==0){?> checked<? }?> onClick="populateCountry();"> 
                  &nbsp;No&nbsp;&nbsp; <input name="oseas" type="radio" class="smalltext" value="1" <? if($oseas==1){?> checked<? }?> onClick="populateCountry();"> 
                  &nbsp;Yes </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Email Address:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="emailadd" value="<? echo $emailadd;?>" size="35" class="input_padding"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Home Phone:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="homephone" value="<? echo $homephone;?>" size="35"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Work Phone:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="workphone" value="<? echo $workphone;?>" size="35"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Mobile Phone:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="mobilephone" value="<? echo $mobilephone;?>" size="35"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Postage Option:</td>
                <td>&nbsp;</td>
                <td class="maintext"><input name="postageoption" type="text" id="postageoption" value="<? echo $postage_option;?>" size="35"></td>
              </tr>
              <tr> 
                <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
              </tr>
            </table></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td valign="top"> <table cellpadding="0" cellspacing="0" border="0" bgcolor="">
              <tr> 
                <td><img src="../images/spacer_trans.gif" height="10" width="130" border="0"></td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td><img src="../images/spacer_trans.gif" height="1" width="200" border="0"></td>
              </tr>
              <tr> 
                <td class="maintext">How did you<br>
                  hear about us?</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="hear_about" value="<? echo $hear_about;?>" size="35"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Referral Code:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
                <td class="maintext"> <input type="text" name="referralcode" value="<? echo $referralcode;?>"> 
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Payment Method:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"> <select name="paymentmeth">
                    <? 



	foreach($paymentmeths as $key => $value)
	{
		$SELECTED = ($key == $paymentmeth)?"SELECTED":"";
		print "<option value=\"{$key}\" {$SELECTED}>{$value}</option>\n";
	}
?>
                  </select> </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Order type:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $ordertype;?></td>
              </tr>
              <?
if($paymentmeth==1){
	?>
              <tr> 
                <td class="maintext" align="right">Card:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $payment;?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Name on Card:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $nameoncard;?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Card Number:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $ccxx;?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Expiry Date:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $expdate;?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Security Code:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $seccode;?></td>
              </tr>
              <?
}

if(!empty($voucher_number))
{


	?>
              <tr> 
                <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Voucher Code:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"> 
                  <?=str_replace(",", "-", $voucher_number);?>
                </td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Voucher Amount:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"> 
                  <?=$cur[$currency]['symbol'];?>
                  <?=$cur['symbol'].toDollarsAndCents($voucher_amount);?>
                </td>
              </tr>
              <?
}

?>
              <tr> 
                <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
              </tr>
              <?
											$took = $finished-$started;
											$hours = floor($took/3600);
											$minutes = floor(($took-($hours*3600))/60);
										?>
              <tr> 
                <td class="maintext" align="right">Order took:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo $hours;?> hours and <? echo $minutes;?> 
                  minutes</td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Started at:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo date("dS M Y H:i", $started);?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Finished at:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><? echo date("dS M Y H:i", $finished);?></td>
              </tr>
              <tr> 
                <td class="maintext" align="right">Confirmed:</td>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td class="maintext"><input type=checkbox name="changeToFinished" value="1" <?=$changeToFinished?>></td>
              </tr>
              <tr> 
                <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td class="maintext" colspan=3> <table cellpadding=0 cellspacing=0 border=0 width=100%>
              <tr> 
                <td class=maintext align=right valign=top>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width=120 class=maintext align=right valign=top>Special requirements:</td>
                <td width=5><img src="../images/spacer_trans.gif" height="5" width="5" border="0"></td>
                <td width=100%><textarea name="specialreqs" style="width:100%;" rows=4><? echo stripslashes($specialreqs);?></textarea></td>
              </tr>
              <input type=hidden name=notes value="">
              <!--
	<tr>
		<td width=120 class=maintext align=right valign=top>Notes:</td>
		<td width=5><img src="../images/spacer_trans.gif" height="5" width="5" border="0"></td> 
		<td width=100%><textarea name="notes"  style="width:100%;"><? echo stripslashes($notes);?></textarea></td>
	</tr>
-->
            </table></td>
        </tr>
        <tr class="noshow"> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td colspan="3" align="center" class="maintext"><strong>Products:</strong></td>
        </tr><trclass="noshow">
        <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr bgcolor="#FFFFFF"class="noshow"> 
          <td colspan="3"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td colspan="3" bgcolor="#FFFFFF" align="center"> <table cellpadding="0" cellspacing="0" border="0">
              <? viewOrder($_REQUEST['id'], "admin");?>
            </table></td>
        </tr><trclass="noshow">
        <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td class="maintext" align="right">Subtotal:</td>
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
          <td class="maintext"><? echo $cur[$currency]['symbol'].toDollarsAndCents($totalprice);?></td>
        </tr>
        <tr> 
          <td class="maintext" align="right">Postage:</td>
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
          <td class="maintext"><? echo $cur[$currency]['symbol'].toDollarsAndCents($postage);?></td>
        </tr>
        <?

$totalprice += $postage;

if($voucher_amount>0){
	?>
        <tr> 
          <td class="maintext" align="right">Voucher Debit:</td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="maintext">- 
            <?=$cur[$currency]['symbol'];?>
            <?=$cur['symbol'].toDollarsAndCents($voucher_amount);?>
          </td>
        </tr>
        <?
	$totalprice = $totalprice - $voucher_amount;
}

$t_totalprice = $totalprice;
list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice) = getVoucherDetails($totalprice, $voucher_number);

if($usevoucher && false)
{

	?>
        <tr> 
          <td class="maintext" align="right">Voucher Debit:</td>
          <td><img src="images/spacer_trans.gif" width="1" height="10"></td>
          <td class="maintext" nowrap>-<? echo $cur[$currency]['symbol'];?><? echo $cur['symbol'].toDollarsAndCents($voucher_amount);?><img src="images/spacer_trans.gif" width="10" height="10"></td>
        </tr>
        <?
	$t_totalprice = $t_totalprice - $voucher_amount;
}

//$totalprice = $t_totalprice;

?>
        <tr> 
          <td class="maintext" align="right"><strong>Total:</strong></td>
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
          <td class="maintext"><strong><? echo $cur[$currency]['symbol'].toDollarsAndCents($totalprice);?></strong></td>
        </tr>
        <tr>
          <td class="maintext" align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td class="maintext">&nbsp;</td>
        </tr>
        <tr> 
          <td class="maintext" align="right"><strong>Additional amount</strong>:</td>
          <td>&nbsp;</td>
          <td class="maintext"><input name="totalamount" type="hidden" value="<? echo $cur[$currency]['symbol'].toDollarsAndCents($totalprice);?>"> 
            <input type="text" name="upd_price"></td>
        </tr>
        <tr> 
          <td class="maintext" align="right"><strong>Reason:</strong></td>
          <td>&nbsp;</td>
          <td class="maintext"><input name="upd_reason" type="text" id="upd_reason"></td>
        </tr>
        <tr> 
          <td class="maintext" align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td class="maintext">&nbsp;</td>
        </tr>
        <tr> 
          <td class="maintext" align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td class="maintext">&nbsp;</td>
        </tr>
        <tr> 
          <td class="maintext" align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td class="maintext">&nbsp;</td>
        </tr><trclass="noshow">
        <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr></form>
      </table> 
	</tr> 
</table> 
</body>
