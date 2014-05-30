<?PHP

/**************
*
*	SECURE RECEIPT FORM
*
**************/


session_start();

// CONSTANTS.

require_once "../constants.php";
$includeabove = true;
require_once "../useractions.php";
require_once "./secure_functions.php";

linkme();

/*

$weblocation = "/home/identiki/public_html/devel";
//$secure_form = "echidnaweb.com.au/~labsearc/new/secure.php";
$secure_refer="https://echidnaweb.com.au/~labsearc/new/secure.php";
$secure_receipt = "https://echidnaweb.com.au/~labsearc/new/secure_receipt.php";
$web_url = "http://www.labsearch.com.au/new/";
$ABN = "73 416 424 878";

$membership_term = 12; // months.

// REQUIRES
require_once "$weblocation/Connections/labsearch.php";
require_once "$weblocation/secure_functions.php";

*/


/*

$_GET['order'] = order id
$_GET['id']    = transaction id
*/



	// calculates amount

	switch ($_GET['section'])
	{
		case "receipt":
			showReceipt($_GET['order']);
			break;
		default:
			require_once "secure_header.php";
			showResults();
			require_once "secure_footer.php";
			break;
	}
exit();


function showResults(){
	global $membership_term, $_CONSTANTS;

//	sendNewOrder(($_SESSION["invoiceNumber"]-1000), "Shaun Norman", "shaun@echidnaweb.com.au", "Credit Card - ePay", true);

	$string = "select * from cc_transactions where id='{$_GET['id']}'";
	$result = mysql_query($string)  or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);

	if (mysql_num_rows($result)==1)
	{
		$row=mysql_fetch_array($result);


		if ($row['SC']=="0" || $row['MR']=="M12"){

			// transaction successful.

			if($_SESSION['fromAdmin']==1){
				$location = "{$_CONSTANTS['weburl']}admin/viewitem.php?id=".($_GET['order']-1000);
			}
			else {
				$location = "{$_CONSTANTS['weburl']}order_confirmed_ps.php?orderid=". ($_GET['order']-1000);
				?>
				<script>
					window.opener.location='<?=$location;?>';
	
					function closeWindow(){
						window.opener.location='<?=$location;?>';
						window.opener.focus();
						window.close();
					}
				</script>
				<?
			}

				


			if($row['MR']=="M12"){
				// transaction has already been processed.

				?>
				<p><strong>Transaction Successful.</strong></p>
				<p>Invoice Number: <?=$_GET['order']?></p>
				<p><strong>Warning:</strong> The payment for this order has already been processed and approved.</p>
				<p>A copy of your receipt will have already been emailed to you upon final processing of the order previously.</p>
				<p>If you believe this is an error, please contact <a href="#" onClick="window.opener.location='<?=$_CONSTANTS['weburl']?>contact_us.php'; window.opener.focus(); window.close();">IdentKid</a>
				<?
			}
			else {
				?>
				<p><strong>Transaction Successful.</strong></p>
				<p>Invoice Number: <?=$_GET['order']?></p>
				<p>The transaction will be displayed on your next credit card statement.</p>
				<p>If you require a receipt, please <a href="<?=$_SERVER['PHP_SELF']?>?section=receipt&order=<?=$_GET['order']?>&id=<?=$_GET['id']?>" class="type1">click here</a> to open your receipt and <strong>print</strong> it for future reference as we do not sent receipts unless requested.</p>
				<?
			}

			?>
			<p>With kindest regards,<Br />
			<strong>IdentiKid</strong></p>
			<?


			if($_SESSION['fromAdmin']==1)
			{
				?>
				<p><a href="<?=$location?>">Back to Admin</a></p>
				<?
			}
			else {
				?>
				<p><a href="javascript:closeWindow();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('close','','../images/button_close_mo.gif',1)"><img src="../images/button_close.gif" alt="Back" name="close" border="0"></a></p>
				<?
			}

		}
		else {
			// transaction unsuccessful
			?>
			<p><strong>Transaction Unsuccessful.</strong></p>
			<p>Invoice Number: <?=$_GET['order']?></p>
			<p>There was a problem with your payment, the system received the following response message back from the Payment Gateway.</p>
			<pre><?PHP

			if($row['RC']=="")
			{
			  print $row['MT'];
			}
			else {
				print $row['RT'];
			}
			$RC = returnErrorCode($row['RC']);
			if(!empty($RC)){
				print "

{$RC}";

			}
			?></pre>
			<p>Your Credit Card has <strong>NOT</strong> been debited.</p>
			<p>If you believe this error was a mistake, please contact <a href="mailto:info@identikid.com.au">IdentiKid</a> and quote your receipt number.</p>
			<p>With kindest regards,<Br />
			<strong>IdentiKid</strong></p>
			<?PHP
	
			if($_SESSION['fromAdmin']==1)
			{
				$location = "{$_CONSTANTS['weburl']}admin/viewitem.php?id=".($_GET['order']-1000);
				?>
				<p><a href="<?=$location?>">Back to Admin</a></p>
				<?
			}
			else {			
				?>
				<p><a href="javascript:window.opener.focus(); window.close();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('close','','../images/button_close_mo.gif',1)"><img src="../images/button_close.gif" alt="Back" name="close" border="0"></a></p>
				<?
			}

		}
	}
	else {
		secureErrorMsg("Invalid Order ID.", $_GET['id']);
	}
}




function showReceipt($orderid){
//function showReceipt($id, $name, $email, $payment){

	global $fromadmin, $_CONSTANTS, $_CURRENCIES, $currencies;


	// gets currencies / postage costs.
	$query = "SELECT * FROM currencies WHERE id=".$_SESSION["currency"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$cur = mysql_fetch_assoc($result);

	
	$query = "SELECT customer FROM orders WHERE id=".($orderid-1000);
	$result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line ".__LINE__." ".mysql_error(), $header=true);
	while($qdata = mysql_fetch_array($result)){
		$custid = $qdata["customer"];
	}
	
	$query = "SELECT emailadd, voucher, voucher_amount FROM customers WHERE id=".$custid;
	$result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line ".__LINE__." ".mysql_error(), $header=true);
	while($qdata = mysql_fetch_array($result)){
		$custemail = $qdata["emailadd"];
		$vouchercode = $qdata["voucher"];
		$voucheramount = $qdata['voucher_amount'];
	}
	
	$query = "SELECT * FROM basket_items WHERE ordernumber=".($orderid-1000);
	$result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line " .__LINE__. " ".mysql_error(), $header=true);

	// create content
	
	$content .= "<br>"
					."<font face=\"Comic Sans MS\" size=\"2\"><strong>Thanks for your order!</strong><br><br>"
					."Your invoice number is: {$orderid}<br><br>"
					."Your order:<br>";
	$total_order_charge = 0;

	$_SESSION['baby_pack_in_order'] = false;
	while($qdata = mysql_fetch_array($result)){
		$content.= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."<br>";
		$total_order_charge += $qdata["price"];
		if($qdata['type']==16){

			$_SESSION['baby_pack_in_order'] = true;
		}
	}
	$total_order_charge += $cur['postage'];

	$query = "SELECT symbol FROM currencies LEFT JOIN orders ON currencies.id = orders.currency WHERE orders.customer = " . $custid . " LIMIT 1";
	$result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line " .__LINE__. " ".mysql_error(), $header=true);
	$currency_symbol = "";
	$currency_symbol = mysql_fetch_assoc($result);

	$total_before_voucher = $total_order_charge;


	// used to show voucher usage, even after the voucher has already been debited.
	if(!empty($vouchercode) && strlen($vouchercode)==15 && $voucheramount>0){	// valid voucher usage.
		$usevoucher = true;

		list($voucher_currency) = getVoucherDetails($total_order_charge, $vouchercode, true);
		$voucher_total = convertCurrency($voucheramount, $currencies[$voucher_currency]['code']."to".$currencies[$_SESSION['currency']]['code']);
		$voucher_usage = $voucheramount;
		$total_order_charge = $total_order_charge - $voucher_total;
		

	}

	$content .= "<br />
		<table cellpadding=2 cellspacing=2 border=0 width=100% class=maintext>";

	if($_SESSION['currency']!=1 && $_SESSION['currency']!=5)
	{
		$content .= "
				<tr>
					<td valign=top nowrap width=5% class=maintext>Postage</td>
					<td width=5%>&nbsp;</td>
					<td class=maintext>".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."</td>
				</tr>";
	}


	if($usevoucher){

		$content .="
				<tr>
					<td valign=top nowrap width=5%>Sub Total</td>
					<td width=5%>&nbsp;</td>
					<td>" . $currency_symbol["symbol"] . sprintf("%01.2f", $total_before_voucher)."</td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Voucher Code</td>
					<td width=5%>&nbsp;</td>
					<td nowrap>" .str_replace(",", "-", $vouchercode). "</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Voucher Debit</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $voucher_usage)."</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Voucher Balance</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $voucher_balance)."</td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Order Total</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge). "</td>
				</tr>
			</table>";


/*
				<br>
				Voucher Code: " .str_replace(",", "-", $_POST['vouchercode'])."<br />
				Voucher Debit: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_usage)."<br />
				Voucher Balance: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_balance)."<br>
				<br />
				Order Total: ".$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge);
*/

		if($total_order_charge<=0)
		{
			$content .= "<br><strong>Please Note:</strong> There is no charge for this order as it was paid in full with your voucher<Br />";
		}
	}
	else {
		$content.="				<tr>
					<td valign=top nowrap width=5%>Order Total</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge). "</td>
				</tr>
			</table>";
/*
		br>Order Total: " . $currency_symbol["symbol"] . $total_order_charge;
*/
	}

	$content .= "<br />Your Credit Card has been charged ".$_CURRENCIES[1]['currency'].sprintf("%01.2f", $_SESSION['paymentAmount']);

	if($_SESSION['currency']!=1 && $_SESSION['currency']!=5)
	{
		$content .= "<br />
			<br />
			Please see our <A href=\"{$_CONSTANTS['weburl']}order_online.php\" target=\"_blank\">Ordering Online</a> page to see why you have been charged in AU\$.";
	}


		


	$content.='<br>
			<br>
			Thank you,<br>
			<br>
			identiKid<br />
			<br />
			<a href="javascript:history.back();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'back\',\'\',\'../images/button_back_mo.gif\',1)"><img src="../images/button_back.gif" alt="Back" name="back" border="0"></a>
			<br />
			<br />
			</font>';
	
//	$html = makeHtmlContent($content, $_CONSTANTS['newAbsImageUrl']);

	$receiptHeader = "header_receipt.gif";
	require_once "./secure_header.php";
	print $content;
	require_once "./secure_footer.php";

}

function verify_referer()
{
	global $secure_refer, $secure_receipt;
	/**
	*	verify's form referer is valid.
	***/

	$REFERER = substr($_SERVER['HTTP_REFERER'], 0, strrpos($_SERVER['HTTP_REFERER'], "?"));
	if ($_SERVER['HTTPS']=="on")
	{
		// secure server is on.

		if ($REFERER==$secure_refer || $REFERER==$secure_receipt || empty($REFERER))
		{	
			// referrer is secure page.
			return true;
		}
	}
	return false;
}

?>