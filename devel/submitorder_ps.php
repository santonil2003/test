<?php
session_start();
header("Cache-control: private");

include("useractions.php");

$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());
$cur = mysql_fetch_assoc($result);


if ($_COOKIE['currency']==1) //Australia
{
	if(!isset($_SESSION["post_option"]))
	{
		header("location:view_order.php?error=nopostage");
	}
	$postage_option = $_SESSION["post_option"];		
	$postage = $_SESSION["postageamount"]; 
}
else // if overseas
{
	$postage = $cur['postage'];
	$postage_option = "Overseas Express";
}


	$currencies = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "Australian Dollars (New Zealand Residents)", "currency" => "AU\$", "code" => "AUD"),
	);

$submittype = $_POST["submittype"];

linkme();



if($_POST["InvoiceNumber"]){
	$id = $_POST["InvoiceNumber"]-1000;
	$approved = $_POST["rApproved"];
	$authcode = $_POST["AuthCode"];
}else{
	$id = $_POST["orderid"];
}

if(!$id){
	header("location:view_order.php");
	exit;
}

$query = "SELECT * FROM orders WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata = mysql_fetch_array($result)){
	$customer = $qdata["customer"];
}

if(!$approved){
	if($_POST['country'] == "Other")
	{
		$country = $_POST['country_other'];
	}
	else 
	{
		$country = $_POST['country'];
	}
	
	$query = "UPDATE customers SET firstname='".addslashes($_POST["firstname"])."', surname='".addslashes($_POST["surname"])."', address='".addslashes($_POST["address"])."', suburb='".addslashes($_POST["suburb"])
	."', postcode='".$_POST["postcode"]."', state='".$_POST["state"]."', country='".$country."', emailadd='".$_POST["emailadd"]."', homephone='".$_POST["homephone"]."', workphone='".$_POST["workphone"]
	."', mobilephone='".$_POST["mobilephone"]."', referral='".$_POST["referral"]."', referralcode='".$_POST["referralcode"]."', hear_about='".addslashes($_POST["hear_about"])
	."', specialreqs='".addslashes($_POST["specialreqs"])."', postage='".$postage."', postage_option='".$postage_option."', paymentmeth=".$_POST["paymentmeth"].", confirmed='".$submittype
	."', voucher='" .$_POST['vouchercode']. "', voucher_amount='" .$_POST['voucher_amount']. "' WHERE id=".$customer;
	//echo "<BR />". $query."<br>";
}else{
	$query = "UPDATE customers SET approved=".$approved.", authcode=".$authcode." WHERE id=".$id;
}



$result = mysql_query($query);
if(!$result) error_message(sql_error());

//$_SESSION['vouchercode'] = $_POST['vouchercode'];




if($submittype=="unconfirmed"){
	header("location:order_confirmation_ps.php?orderid=".$id);//."&postageamount=".$postage."&postageoption=".$postage_option);
}else if($submittype=="confirmed" && $_POST["paymentmeth"]!="1"){

	sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);
	header("location:order_confirmed_ps.php?orderid=".$id);//"&postageamount=".$postage."&postageoption=".$postage_option);

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
	
	if($_COOKIE["currency"]==1 || $_COOKIE['currency'] == 5){
		// au dollars
		$_AUTotal = $totalprice;
	}
	else if($_COOKIE["currency"]==2 || $_COOKIE['currency']==3){
		// us & eu dollars
		$_CurrencyTotal = $totalprice;
		$_AUTotal = convertCurrency($totalprice, $_CURRENCIES[$_COOKIE['currency']]['code']."toAUD");
	}
	else {
		header("location:index.php");
	}

	
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - View Order</title>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.">
<body  background="images/bg_pattern.gif"> 
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
		var myWindow = window.open("", "tinyWindow", 'toolbar=no,directories=no,resizable=no,scrollbars=yes,location=no,status=yes,width=700,height=532') 
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
						</table> 
					</td> 
					<td width="418" valign="top" bgcolor="#6FFF6F"> 
						<table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F"> 
							<tr valign="top"> 
								<td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td> 
								<td width="304" bgcolor="5d7eb9"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td> 
								<td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td> 
							</tr>
							<tr valign="top" bgcolor="#66FF66"> 
								<td colspan="3" bgcolor="#6FFF6F"> 
									<table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
										<tr valign="top" bgcolor="#FFFFFF"> 
											<td><img src="images/spacer_trans.gif" width="10" height="10"></td> 
										</tr>
										<tr>
											<td>
												<table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">	

													<tr>
														<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
														<td colspan="3" class="maintext">
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
	if($_COOKIE['currency']==2 || $_COOKIE['currency']==3)
	{
		?>
		<p><strong>Please Note:</strong> Our online payments system charges in AUD only, your order will be converted into AUD using the latest exchange rate from <a href="http://finance.yahoo.com" target="_blank">Yahoo Finance</a>. </p>

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
														<td colspan="3" align="right" class="maintext"><a href="javascript:openSecureWindow(document.toSecure);" class="type1" onMouseOver="MM_swapImage('submitimg','','../images/button_continue_mo.gif',1)"  onMouseOut="MM_swapImgRestore()"><img name="submitimg" id="submitimg" src="../images/button_continue.gif" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;</td> 
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
								</td> 
							</tr> 
						</table> 
					</td> 
					<td valign="top" bgcolor="FF9900"> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
							<tr> 
								<td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td> 
							</tr>
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td height="30" colspan="3" valign="top"> 
						<?php include "footer.php" ?> 
					</td> 
				</tr> 
			</table> 
		</td> 
	</tr> 
</table> 
</form> 
</body>
<?
}
exit;
?>
