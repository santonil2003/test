<?php
session_start();
require_once("debug_log.php");
include_once("useractions.php");
linkme();
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());
$cur = mysql_fetch_assoc($result);

$_SESSION["post_option"] = $_POST["postageoption"];
if(isset($_POST["postage"]) && $_POST["postage"] != ''){
  $_SESSION["postageamount"] = $_POST["postage"]; 
} else {
  $_SESSION["postageamount"] = $_POST["postageamount"]; 
}

$postage_option = $_SESSION["post_option"];		
$postage = $_SESSION["postageamount"]; 

	$currencies = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "New Zealand", "currency" => "NZ\$", "code" => "NZD"),
	);

$submittype = $_POST["submittype"];


if($_POST["InvoiceNumber"]){
	$id = $_POST["InvoiceNumber"]-1000;
	$approved = $_POST["rApproved"];
	$authcode = $_POST["AuthCode"];
}else{
	$id = $_POST["orderid"];
}

if(!$id){
	header("location:/temp/my_order.php");
	exit;
}

$order_id = $id+1000;
debug_log_add("submitorder_ps.php", "Order ID: " . $order_id);


$query = "SELECT * FROM orders WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata = mysql_fetch_array($result)){
	$customer = $qdata["customer"];
}

if(!$approved){
	if($_POST['country'] == "Other")
	{
		$country = mysql_real_escape_string($_POST['country_other']);
	}
	else 
	{
		$country = mysql_real_escape_string($_POST['country']);
	}
	
	if($_POST['country_cust'] == "Other")
	{
		$country_cust = mysql_real_escape_string($_POST['country_other_cust']);
	}
	else 
	{
		$country_cust = mysql_real_escape_string($_POST['country_cust']);
	}
  
	$query = "UPDATE customers SET firstname='".mysql_real_escape_string($_POST["firstname"])."', surname='".mysql_real_escape_string($_POST["surname"])."', address='".mysql_real_escape_string($_POST["address"])."', suburb='".mysql_real_escape_string($_POST["suburb"])
	."', postcode='".$_POST["postcode"]."', state='".$_POST["state"]."', country='".$country."',  address_cust='".mysql_real_escape_string($_POST["address_cust"])."', suburb_cust='".mysql_real_escape_string($_POST["suburb_cust"])
	."', postcode_cust='".$_POST["postcode_cust"]."', state_cust='".$_POST["state_cust"]."', country_cust='".$country_cust."',  emailadd='".$_POST["emailadd"]."', homephone='".$_POST["homephone"]."', workphone='".$_POST["workphone"]
	."', mobilephone='".$_POST["mobilephone"]."', referral='".$_POST["referral"]."', referralcode='".$_POST["referralcode"]."', hear_about='".mysql_real_escape_string($_POST["hear_about"])
	."', specialreqs='".mysql_real_escape_string($_POST["specialreqs"])."', postage='".$postage."', postage_option='".$postage_option."', paymentmeth=".$_POST["paymentmeth"].", confirmed='".$submittype
	."', voucher='" .$_POST['vouchercode']. "', voucher_amount='" .$_POST['voucher_amount']. "', del_name = '" . mysql_real_escape_string($_POST['del_name']) . "' WHERE id=".$customer;
	//echo "<BR />". $query."<br>";
}else{
	$query = "UPDATE customers SET approved=".$approved.", authcode=".$authcode." WHERE id=".$id;
}



$result = mysql_query($query);
if(!$result) error_message(sql_error());


if($submittype=="unconfirmed"){
	header("location:/temp/order_confirmation_ps.php?orderid=".$id);//."&postageamount=".$postage."&postageoption=".$postage_option);
}else if($submittype=="confirmed" && $_POST["paymentmeth"]!="1" && $_POST["paymentmeth"]!="8"){

	sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);
	header("location:/temp/order_confirmed_ps.php?orderid=".$id);//"&postageamount=".$postage."&postageoption=".$postage_option);

}else if($submittype=="confirmed" && $_POST["paymentmeth"] == "8"){
	// Paypal processing
	sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);
	header("location:/temp/order_payment_paypal.php?orderid=".$id);//"&postageamount=".$postage."&postageoption=".$postage_option);
}else if($_POST["paymentmeth"]=="1"){
	$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());

	$_SESSION['baby_pack_in_order'] = false;
	if(mysql_num_rows($result)>0){
		while($qdata = mysql_fetch_array($result)){
			$totalprice += $qdata["price"];
			// 
			if($qdata['type']==16){
				$_SESSION['baby_pack_in_order'] = true;
			}
		}
	}
	
	$totalprice +=$postage;
	list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice, $voucher_errror, $voucher_currency) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);
	
	if($_COOKIE["currency"]==1 ){
		// au dollars
		$_AUTotal = $totalprice;
	}
	else if($_COOKIE["currency"]==2 || $_COOKIE['currency']==3 || $_COOKIE['currency']== 5 ){
		// us & eu dollars
		$_CurrencyTotal = $totalprice;
		//$_AUTotal = convertCurrency($totalprice, $_CURRENCIES[$_COOKIE['currency']]['code']."toAUD");
		$_AUTotal = convertCurrencyNew($totalprice, $_COOKIE['currency']);
	}
	else {
		header("location:/temp/index.php");
	}

	
include_once("header.php");

	?>
<form name="toSecure" action="<?=$_LINKS['secure']?>" method="post"> 
	<input type="hidden" name="invoiceNumber" value="<? echo $id+1000;?>"> 
	<input type="hidden" name="paymentAmount" value="<? echo $_AUTotal;?>"> 
	<input type="hidden" name="custid" value="<?=$customer?>">
	<input type="hidden" name="currency" value="<?=$_COOKIE['currency'];?>">
	<input type="hidden" name="section" value="getcc">
	<input type="hidden" name="baby_pack_in_order" value="<?=($_SESSION['baby_pack_in_order'])?"1":"0";?>">



<script>
function openSecureWindow(f) {

	var valid=false;
	if(f.agreed.value==1)
	{
		if(f.readHowToOrder.checked==true)
		{	
			valid = true;
		}
	}
	else {
		valid=true;

	}

	if(valid)
	{
		f.target="";
		var myWindow = window.open("", "tinyWindow", 'toolbar=no,directories=no,resizable=no,scrollbars=no,location=no,status=yes,width=710,height=500') 
		f.target="tinyWindow";
		f.submit();
		document.location='secure_forwarded.php';
	}
	else {
		self.alert('You must agree upon the information regarding\nCredit Card payments in foreign currencies before\nyou can continue!');
	}
}

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
</script>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
	<tr>
		<td><a href="http://www.mbase.com.au/" target="_blank"><img src="images/secure_mbase.jpg" alt="Secure Orders" width="97" height="120" border=0></a><br />
			<br />
			<img src="images/secure_credit_cards.jpg" alt="Credit Cards Accepted" width="98" height="282"></td>
		<td width=15>&nbsp;</td>
		<td class=maintext valign=top>
			<h1><span class="headings">Secure Transactions</span></h1>

<p>You will now be taken to our Secure Credit Card Payment page.</p>

<p>We use <a href="http://www.mbase.com.au/" target="_blank">MultiBase</a> as our Secure Payments Gateway to ensure your credit card details are kept 100% secure.</p>

<?PHP
	if($_COOKIE['currency']==2 || $_COOKIE['currency']==3 || $_COOKIE['currency']==5 )
	{
		?>
		<p><strong>Please Note:</strong> Our online payments system charges in AUD only, your order will be converted into AUD using the latest exchange rate from <a href="http://www.rba.gov.au/RSS/rss_cb_exchange_rates.xml" target="_blank">Reserve Bank Of Australia </a>. </p>

		<table cellpadding=2 cellspacing=2 width=50% border=0 class=maintext>
			<tr>
				<td nowrap>Total: <?=$_CURRENCIES[$_COOKIE['currency']]['currency']?><?=sprintf("%01.2f", $_CurrencyTotal)?></td>
				<td align=center><strong>=</strong></td>
				<td nowrap align=right><strong>AU$<?=sprintf("%01.2f", $_AUTotal)?></strong></td>
			</tr>
		</table>

		<input type=hidden name=agreed value=1>
		<p>
		<table width=100% cellpadding=2>
			<tr>
				<td valign=top><input type="checkbox" name="readHowToOrder" value="1"></td>
				<td valign=top class=maintext>I have read, and agree with the information regarding Credit Card payments and foreign currencies on the 
					<a href="order_online.php#ccPayments" target="_blank">Ordering Online</a> page.</p></td>
			</tr>
		</table>
		</p>
		<?


	}
	else {
		?>
		<p><strong>Total: AU$<?=sprintf("%01.2f", $_AUTotal)?></strong></p>
		<input type=hidden name=agreed value=0>
		<?
	}

?>
		</td>
	</tr>
</table>
														</td> 
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
														<td colspan="3" align="right" class="maintext"><a href="javascript:openSecureWindow(document.toSecure);" class="type1" ><img name="submitimg" id="submitimg" src="images/nav/n_continue_o.gif" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;</td> 
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
									</table> 
									</form> 


<?php 
include ("footer.php");
}
exit;
?>
