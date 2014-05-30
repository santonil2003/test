<?
if(!isset($useractions)){
	$includeabove = true;
	include("../useractions.php");
}

if(!isset($_COOKIE["currency"])){
	$currency=$_POST["currency"];
}else{
	$currency=$_COOKIE["currency"];
}
$submittype = $_POST["submittype"];

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);
$id = checkOrderId(false);

if(!$id){
	header("location:addphoneorder.php");
	exit;
}

if ($_POST["vouchercode"]){
	$vouchercode = split(",", $_POST["vouchercode"]);
}

$query = "SELECT * FROM currencies WHERE id=".$currency;
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);

$query = "SELECT * FROM orders WHERE id=".$id;

$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata = mysql_fetch_array($result)){
	$customer = $qdata["customer"];
}


if($_POST["paymentmeth"]=="1"){
	$cc = $_POST["cc1"]."-".$_POST["cc2"]."-".$_POST["cc3"]."-".$_POST["cc4"];
	$nameoncard = $_POST["nameoncard"];
	$payment = $_POST["payment"];
	$expiry = $_POST["expirymonth"]."/".$_POST["expiryyear"];
	$seccode = $_POST["seccode"];
}else{
	$cc = "";
	$nameoncard = "";
	$payment = "";
	$expiry = "";
	$seccode = "";
}

if($_POST["shopCode"]!=""){
	$refcode = $_POST["shopCode"];
}else if($_POST["centreCode"]!=""){
	$refcode = $_POST["centreCode"];
}

$query = "UPDATE orders SET currency=".$currency." WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());


$query = "UPDATE customers SET firstname='".mysql_real_escape_string($_POST["firstname"])."', surname='".mysql_real_escape_string($_POST["surname"])."', del_name='".mysql_real_escape_string($_POST["del_name"])."', address='".mysql_real_escape_string($_POST["address"])."', suburb='".mysql_real_escape_string($_POST["suburb"])
	."', postcode='".$_POST["postcode"]."', state='".$_POST["state"]."', country='".$_POST["country"]."', address_cust='".mysql_real_escape_string($_POST["address_cust"])."', suburb_cust='".mysql_real_escape_string($_POST["suburb_cust"])
	."', postcode_cust='".$_POST["postcode_cust"]."', state_cust='".$_POST["state_cust"]."', country_cust='".$_POST["country_cust"]."', emailadd='".mysql_real_escape_string($_POST["emailadd"])."', homephone='".$_POST["homephone"]."', workphone='".$_POST["workphone"]
	."', mobilephone='".$_POST["mobilephone"]."', referral='".mysql_real_escape_string($_POST["referral"])."', referralcode='".$_POST["referralcode"]."', hear_about='".mysql_real_escape_string($_POST["hear_about"])
	."', specialreqs='".mysql_real_escape_string($_POST["specialreqs"])."', postage=".$_POST["postage"].", postage_option='".$_POST["postageoption"]."', paymentmeth=".$_POST["paymentmeth"].", confirmed='".$submittype
	."', voucher='" .$_POST['vouchercode']. "', voucher_amount='" .$_POST['voucher_amount']. "' WHERE id=".$customer;



//echo '<br>$query: ' . $query;
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
//exit;
$result = mysql_query($query);

if(!$result) error_message(sql_error());


if ($submittype != "unconfirmed"){
	//Get the current customers id
	$sql_customer = "SELECT customers.id, customers.firstname, customers.surname FROM customers LEFT JOIN orders ON customers.id = orders.customer WHERE orders.id = " . $id;
//echo '<br>$sql_customer: ' . $sql_customer;
	$results_customer = mysql_query($sql_customer);
	if(!$results_customer) error_message(sql_error());
	if (mysql_num_rows($results_customer) > 0){
		list($customer_id, $customer_firstname, $customer_surname) = mysql_fetch_row($results_customer);

//		$rs_customer = mysql_fetch_assoc($results_customer);
//		$customer_id = $rs_customer["id"];
	}
	mysql_free_result($results_customer);
	//Get all the items in the current order
	$sql_order = "SELECT * FROM basket_items WHERE ordernumber = " . $id;
	$result_order = mysql_query($sql_order);
	if (! $result_order) error_message(sql_error());
	if (mysql_num_rows($result_order) > 0){
		while ($rs_order = mysql_fetch_assoc($result_order)){
			if ($rs_order["type"] == 15){
				$voucher_detail = split(" ", $rs_order["quantdesc"]);
//				$sql_insert = "INSERT INTO voucher (purchase_date, expiry_date, style, value, balance, customer_id, recipient_id, currency) VALUES ";

				// added voucher_name, removed recipient and customer id
				$sql_insert = "INSERT INTO voucher (purchase_date, expiry_date, style, value, balance, voucher_name, currency) VALUES ";
				for ($index = 0; $index < $voucher_detail[0]; $index++){
					if ($index > 0){
						$sql_insert .= ", ";
					}
					$sql_insert .= "('#" . date("Y-m-d H:i:s",time() + 7200) . "#', '#" . date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m") + 6, date("d"), date("Y"))) . "#', '" . $voucher_detail[1] . "', " . ($rs_order["price"] / $voucher_detail[0]) . ", 0, '" .$customer_firstname. " " .$customer_surname. "', '$currency')";
				}
//echo '<br>$sql_insert: ' . $sql_insert;
				mysql_query($sql_insert) or die(mysql_error());
			}
		}
	}
	mysql_free_result($result_order);
	
	//Update Voucher balance
	$sql_order = "SELECT * FROM basket_items WHERE ordernumber = " . $id;
	$result_order = mysql_query($sql_order);
	if (! $result_order) error_message(sql_error());
	if (mysql_num_rows($result_order) > 0){
		while ($rs_order = mysql_fetch_assoc($result_order)){
			if ($rs_order["type"] == 16){
				$voucher_part = split("-", $rs_order["quantdesc"]);
				$sql_update = "UPDATE voucher SET voucher.balance = (voucher.balance + " . $rs_order["price"] . ") WHERE voucher.number LIKE '%" . $voucher_part[0] . $voucher_part[1] . $voucher_part[2] . $voucher_part[3] . "%'";
//echo '<br>$sql_update: ' . $sql_update;
				mysql_query($sql_update);
			}
		}
	}
	mysql_free_result($result_order);

	$sql_delete = "DELETE FROM temp WHERE temp.orderid = " . $id;
	mysql_query($sql_delete);
}

if($submittype=="unconfirmed"){
	?><html><head></head><body onLoad="location.href='addphoneorder_confirmdetails.php';"></body></html><?
}else if($submittype=="confirmed" && $_POST["paymentmeth"]!="1"){
	$fromadmin=true;
	sendNewOrder($id, $_POST["firstname"]." ".$_POST["surname"], $_POST["emailadd"], $payment);

	deleteOrderId($id);
	?><html><head></head><body onLoad="location.href='viewitem.php?id=<? echo $id;?>';"></body></html><?
	exit;
}else{
	$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	if(mysql_num_rows($result)>0){
		while($qdata = mysql_fetch_array($result)){
			$totalprice += $qdata["price"];
		}
	}
	$totalprice+=$_POST["postage"];
	
/* OLD PAYSTREAM
	if($_COOKIE["currency"]==1){
		// au dollars
		$psid="ps10124";
	}else if($_COOKIE["currency"]==2){
		// us dollars
		$psid="ps10269";
	}else if($_COOKIE["currency"]==3){
		// euros
		$psid="ps10270";
	}
*/

//	list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice, $voucher_errror, $voucher_currency) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);
	
	$converted = false;
	if($_COOKIE["currency"]==1 || $_COOKIE['currency'] == 5){
		// au dollars
		$_AUTotal = $totalprice;
	}
	else if($_COOKIE["currency"]==2 || $_COOKIE['currency']==3){
		// us & eu dollars
		$_CurrencyTotal = $totalprice;
		$_AUTotal = convertCurrency($totalprice, $_CURRENCIES[$_COOKIE['currency']]['code']."toAUD");
		$converted = true;
	}
	



	?>
	<body onLoad="document.toSecure.submit();">

	<form name="topaystream" action="https://securepayments.paystream.com.au/<? echo $psid;?>/index.cfm" method="post"> 
		<input type="hidden" name="InvoiceNumber" value="<? echo $id+1000;?>"> 
		<input type="hidden" name="PaymentAmount" value="<? echo $totalprice;?>"> 
		<input type="hidden" name="ContactEmail" value="<? echo $_POST["emailadd"];?>"> 
		<input type="hidden" name="ContactName" value="<? echo $_POST["firstname"]." ".$_POST["surname"];?>"> 
	</form> 

<form name="toSecure" action="<?=$_LINKS['secure']?>" method="post"> 
	<input type="hidden" name="fromAdmin" value="1">
	<input type="hidden" name="invoiceNumber" value="<? echo $id+1000;?>"> 
	<input type="hidden" name="paymentAmount" value="<? echo $_AUTotal;?>"> 
	<input type="hidden" name="custid" value="<?=$customer?>">
	<input type="hidden" name="currency" value="<?=$_COOKIE['currency'];?>">
	<input type="hidden" name="section" value="getcc">

<script>
function openSecureWindow(f) {

	f.target="";
	var myWindow = window.open("", "tinyWindow", 'toolbar=no,directories=no,resizable=no,scrollbars=yes,location=no,width=700,height=532') 
	f.target="tinyWindow";
	f.submit();
//	document.location='secure_forwarded.php';
}
</script>



	<p>redirecting to multibase...</p>
	<p>If your browser has not allowed this popup, please <input type="submit" name=subbutton value="Click Here">.</p>

</form>
	</body>
	<?
}
?>