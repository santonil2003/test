<?php
	require_once("../common_db.php");
	require_once("../useractions.php");



linkme();
session_start();
$user_section_id = 7;
require_once("./security.php");
check_access($user_section_id);
	
	$action = "search";

	$currencies = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "Australian Dollars (New Zealand Residents)", "currency" => "AU\$", "code" => "AUD"),
	);
	
	if (isset($_POST["id"])){
		$id = $_POST["id"];
	}else{
		$id = 0;
	}
	
	if (isset($_POST["action"])){
		$purchase_timestamp = mktime(0,0,0, (int)form_param('purchase_month'), (int)form_param('purchase_day'), (int)form_param('purchase_year'));
		$expiry_timestamp = mktime(0,0,0, (int)form_param('expiry_month'), (int)form_param('expiry_day'), (int)form_param('expiry_year'));

		
		
		switch ($_POST["action"]){

			case 'delete':
				$string = "delete from voucher where id='{$_POST['id']}'";
				$result = mysql_query($string);

				$_POST['action'] = "search";

			case 'search':
			
				// new search, customer/purchaser are no longer used upon request of anne.
				$sql_search = "SELECT id, number, voucher_name, style, purchase_date, expiry_date, value, balance, currency FROM voucher ";
				switch ($id){
					case "number":
						$sql_search .= " WHERE number LIKE '%". $_POST['number'] ."%' ";
						break;
					case "voucher_name":
						$sql_search .= " WHERE voucher_name LIKE '%". $_POST['voucher_name'] ."%' ";
						break;
				}
				$sql_search .= " ORDER BY number ASC";
				


/*
				$sql_search = 'SELECT voucher.id, voucher.number, CONCAT(customers.surname, ", ", customers.firstname) AS customer, IF(ISNULL(recipients.id), "", CONCAT(recipients.surname, ", ", recipients.firstname)) AS recipient, voucher.style, voucher.purchase_date, voucher.expiry_date, voucher.value, voucher.balance, voucher.currency, customers.id AS customers_id, IF(ISNULL(recipients.id), "", recipients.id) AS recipients_id';
				$sql_search .= ' FROM (voucher INNER JOIN customers ON voucher.customer_id = customers.id) LEFT JOIN customers AS recipients ON voucher.recipient_id = recipients.id';
				$sql_search_where = ' WHERE (';
				//switch ($_POST["id"]){
				switch ($id){
					case 'number':
						$sql_search_where .= '(voucher.number LIKE "%' . $_POST["number"] . '%")';
						break;
					case 'customer':
						if ((isset($_POST["customer_first_name"])) && (isset($_POST["customer_last_name"]))){
							$sql_search_where .= '((customers.firstname LIKE "%' . $_POST["customer_first_name"] . '%") AND (customers.surname LIKE "%' . $_POST["customer_last_name"] . '%"))';
						}else if (isset($_POST["customer_first_name"])){
							$sql_search_where .= '(customers.firstname LIKE "%' . $_POST["customer_first_name"] . '%")';
						}else if (isset($_POST["customer_last_name"])){
							$sql_search_where .= '(customers.surname LIKE "%' . $_POST["customer_last_name"] . '%")';
						}
						break;
					case 'recipient':
						if ((isset($_POST["recipient_first_name"])) && (isset($_POST["recipient_last_name"]))){
							$sql_search_where .= '((recipients.firstname LIKE "%' . $_POST["recipient_first_name"] . '%") AND (recipients.surname LIKE "%' . $_POST["recipient_last_name"] . '%"))';
						}else if (isset($_POST["recipient_first_name"])){
							$sql_search_where .= '(recipients.firstname LIKE "%' . $_POST["recipient_first_name"] . '%")';
						}else if (isset($_POST["recipient_last_name"])){
							$sql_search_where .= '(recipients.surname LIKE "%' . $_POST["recipient_last_name"] . '%")';
						}
						break;
				}
				$sql_search_where .= ')';
				if ($sql_search_where <> " WHERE ()"){
					$sql_search .= $sql_search_where;
				}
				$sql_search .= " ORDER BY voucher.number ASC";
*/


//echo '<br>' . $sql_search . '<br>';
				//$result_search = mysql_query($sql_search);
				//if (! $result_search) error_message(sql_error());
				//if (mysql_num_rows($result_search) > 0){
					//while ($rs_search = mysql_fetch_assoc($result_search)){
						
					//}
				//}
				//$action = "search";
				//break;
			case 'results':
				$action = "results";
				break;
			case 'update':
				//Update the old voucher details
				//$sql_update = "UPDATE voucher SET voucher.number = '" . $_POST["number"] . "', voucher.purchase_date = '#" . $_POST["purchase_date"] . "#', voucher.expiry_date = '#" . $_POST["expiry_date"] . "#', voucher.style = '" . $_POST["style"] . "', voucher.value = '" . $_POST["value"] . "', voucher.balance = '" . $_POST["balance"] . "', voucher.customer_id = " . $_POST["customer_id"] . ", voucher.recipient_id = " . $_POST["recipient_id"] . ", voucher.currency = '" . $_POST['currency']. "' WHERE voucher.id = " . $_POST["id"];
				//$sql_update = "UPDATE voucher SET voucher.number = '" . $_POST["number"] . "', voucher.purchase_date = '#" . $_POST["purchase_date"] . "#', voucher.expiry_date = '#" . $_POST["expiry_date"] . "#', voucher.style = '" . $_POST["style"] . "', voucher.value = '" . $_POST["value"] . "', voucher.balance = '" . $_POST["balance"] . "', voucher.customer_id = " . $_POST["customer_id"] . ", voucher.recipient_id = '" . $_POST["recipient_id"] . "' , voucher.currency = '" . $_POST['currency']. "' WHERE voucher.id = " . $id;

				// voucher name added, customer_id removed.
				
				
				$sql_update = "UPDATE voucher SET voucher.number = '" . $_POST["number"] . "', voucher.purchase_date = '" . date('Y-m-d', $purchase_timestamp) .  " 00:00:00', voucher.expiry_date = '" . date('Y-m-d', $expiry_timestamp) .  " 00:00:00', voucher.style = '" . $_POST["style"] . "', voucher.value = '" . $_POST["value"] . "', voucher.balance = '" . $_POST["balance"] . "', voucher.voucher_name = '" .$_POST['voucher_name']. "', voucher.currency = '" . $_POST['currency']. "' WHERE voucher.id = " . $id;
				mysql_query($sql_update);
				$action = "edit";
				break;
			case 'edit':
				$action = "edit";
				break;
			case 'new':
				$action = "new";
				break;
			case 'save':
				//Save all the new voucher details
				//$sql_insert = "INSERT INTO voucher (number, purchase_date, expiry_date, style, value, balance, customer_id, currency) VALUES ('" . $_POST["number"] . "', '#" . $_POST["purchase_date"] . "#', '#" . $_POST["expiry_date"] . "#', '" . $_POST["style"] . "', '" . $_POST["value"] . "', '" . $_POST["balance"] . "', " . $_POST["customer_id"] . ", '" .$_POST['currency']. "')";

				// voucher name added, customer_id removed
				$sql_insert = "INSERT INTO voucher (number, purchase_date, expiry_date, style, value, balance, voucher_name, currency) VALUES ('" . $_POST["number"] . "', '" . date('Y-m-d', $purchase_timestamp) .  " 00:00:00', '" . date('Y-m-d', $expiry_timestamp) .  " 00:00:00', '" . $_POST["style"] . "', '" . $_POST["value"] . "', '" . $_POST["balance"] . "', '" . $_POST["voucher_name"] . "', '" .$_POST['currency']. "')";
//echo '<br>' . $sql_insert . '<br>';
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
//exit;
//print $sql_insert;
				mysql_query($sql_insert) or die(mysql_error());
				$id = mysql_insert_id();
				$action = "edit";
				break;
		}
	}
/*
	$sql_vouchers = "SELECT * FROM voucher";
	$result_vouchers = mysql_query($sql_vouchers);
	if (! $result_vouchers) error_message(sql_error());
	if (mysql_num_rows($result_vouchers) > 0){
		while ($rs_vouchers = mysql_fetch_assoc($result_vouchers)){
			
		}
	}
*/
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
//exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - add phone order item</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript1.1" type="text/javascript">
function SubmitForm(do_what, to_whom){
	switch (do_what){
		case "delete":
			if(confirm('Are you sure you wish to delete this Gift Voucher?')){
				document.forms[0].action.value= do_what;
				document.forms[0].id.value = to_whom;
				document.forms[0].submit();
			}
			break;
		case "search":
			document.forms[0].action.value = do_what;
			document.forms[0].id.value = to_whom;
			document.forms[0].submit();
			break;
		case "edit":
			document.forms.results.action.value = do_what;
			document.forms.results.id.value = to_whom;
			document.forms.results.submit();
			break;
		case "update":
			document.forms.edit.action.value = do_what;
			document.forms.edit.id.value = to_whom;
			document.forms.edit.submit();
			break;
		case "new":
			//document.forms.{to_whom}.action.value = do_what;
			//document.forms.edit.id.value = to_whom;
			//document.forms.edit.submit();
			//window.alert("document.forms." + to_whom + ".action.value = '" + do_what + "'");
			eval("document.forms." + to_whom + ".action.value = '" + do_what + "'");
			eval("document.forms." + to_whom + ".submit()");
			break;
		case "save":
			document.forms.save.action.value = do_what;
			//document.forms.save.id.value = to_whom;
			document.forms.save.submit();
			break;
		case "back":
			history.back(-1);
			break;
	}
}

function FillDate(obj){
	var obj_date = new Date();
	var str_year = obj_date.getFullYear();
	var str_month = obj_date.getMonth() + 1;
	var str_day = obj_date.getDate();
	var str_hour = obj_date.getHours();
	var str_minute = obj_date.getMinutes();
	var str_second = obj_date.getSeconds();

	if (str_month < 10){
		str_month = "0" + str_month;
	}

	if (str_day < 10){
		str_day = "0" + str_day;
	}

	if (str_hour < 10){
		str_hour = "0" + str_hour;
	}

	if (str_minute < 10){
		str_minute = "0" + str_minute;
	}

	if (str_second < 10){
		str_second = "0" + str_second;
	}

	if (obj.value == ""){
		obj.value = str_year + "-" + str_month + "-" + str_day + " " + str_hour + ":" + str_minute + ":" + str_second;
	}
}
</script>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" width=884>

        <tr>
          <td colspan="15"><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td colspan="15"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td height="38" colspan="15" valign="middle" class="admintext">

<!--
						<h1 align=center>Win A Laptop Competition</h1> 
						<ul align=left>
							<li>Only orders from 1st November 2004 until 28th February 2005 can qualify</li>
							<li>Only orders where status = 'posted' quality</li>
							<li>Customers are given 1 ticket per $50 of their order</li>
						</ul>

						<p><form><input type=button name=back value="&lt; Back" onClick="history.back();"></form></p>
						<p>&nbsp;</p>

					</td>
        </tr>
			</table>
		</td>
	</table>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
				<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" width=80%>
					<tr>
						<td bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td><img src="../images/spacer_trans.gif" height="1" width="600" border="0"></td>
					</tr>
					<tr>
						<td>

// -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
								</tr>
								<tr>
									<td class="admintext"><h2>Gift Vouchers</h2></td>
								</tr>
								<tr>
									<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
								</tr>
								<?php
//Search Table
if ($action == "search"){
								?>
								<tr>
									<td>
										<form name="search" method="post" action="vouchers.php">
											<input type="hidden" name="action" value="">
											<input type="hidden" name="id" value="">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
											  <tr>
												<td width="22%"><div align="left">Search By</div></td>
												<td width="54%">&nbsp;</td>
												<td width="24%">
													<div align="right">
														<a href="../admin/">Admin</a> | <a href="JavaScript: SubmitForm('new', 'search');">New</a>
													</div>
												</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
												<tr>
												  <td><div align="left">Voucher Number</div></td>
												  <td><input name="number" type="text" style="width: 100%"></td>
												  <td><div align="right">
												    <input name="search" type="button" style="width: 90%" value="Search..." onClick="JavaScript: SubmitForm('search', 'number');">
												    </div></td>
												</tr>
												<tr>
													<td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
												</tr>
												<tr>
												  <td><div align="left">Voucher/Purchaser's Name</div></td>
													<td><input name="voucher_name" type="text" style="width: 100%"></td>
												  <td><div align="right">
												    <input name="search" type="button" style="width: 90%" value="Search..." onClick="JavaScript: SubmitForm('search', 'voucher_name');">
												    </div></td>

												</tr>
												<tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
<!--
												<tr>
												  <td><div align="left">Customer's Last Name</div></td>
												  <td><input name="customer_last_name" type="text" style="width: 100%"></td>
												  <td><div align="right">
												    <input name="search" type="button" style="width: 90%" value="Search..." onClick="JavaScript: SubmitForm('search', 'customer');">
												    </div></td>
												</tr>
												<tr>
													<td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
-- >
<!--
												<tr>
												  <td><div align="left">Recipient's First Name</div></td>
												  <td><input name="recipient_first_name" type="text" style="width: 100%"></td>
												  <td>&nbsp;</td>
												</tr>
												<tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
												  </tr>
												<tr>
												  <td><div align="left">Recipient's Last Name</div></td>
												  <td><input name="recipient_last_name" type="text" style="width: 100%"></td>
												  <td><div align="right">
												    <input name="search" type="button" style="width: 90%" value="Search..." onClick="JavaScript: SubmitForm('search', 'recipient');">
												    </div></td>
												</tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
// -->
											  <tr bgcolor="#FFFFFF">
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><div align="left">You may search for Vouchers by their number, by the first and/or last name of the person who bought the voucher.
<!-- 
or by the<br>first and/or last name of the person who received the voucher. 
// -->
To see a list of all the Vouchers click on the Search button next to Customer's Last Name while the customer's first and last names are empty.</div></td>
											  </tr>
											</table>
										</form>
									</td>
								</tr>
								<?php
								}
//Results Table
if ($action == "results"){
								?>
								<tr>
									<td>
										<form name="results" method="post" action="vouchers.php">
											<input type="hidden" name="action" value="">
											<input type="hidden" name="id" value="">
											<table width="100%" border="0" cellspacing="0" cellpadding="0" width=100%>
											  <tr>
												<td><div align="left">Search Results</div></td>
												<td colspan="11">
													<div align="right">
														<a href="../admin/">Admin</a> | <a href="../admin/vouchers.php">Search</a> | <a href="JavaScript: SubmitForm('new', 'results');">New</a>
													</div>
												</td>
											  </tr>
											  <tr>
												  <td colspan="12"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="12"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="12"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr valign=top>
												<td><div align="left">Voucher Number</div></td>
												<td><div align="left">Voucher/Purchaser's Name</div></td>
<!--
												<td><div align="left">Recipient's Name<br>&nbsp;</div></td>
// -->
												<td><div align="left">Style</div></td>
												<td><div align="left">Purchase Date</div></td>
												<td><div align="left">Expiry Date</div></td>
												<td><div align="left">Original Value</div></td>
												<td><div align="left">Current Balance</div></td>
												<td><div align="left">Currency</div></td>
												<td>&nbsp;&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;&nbsp;</td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="12"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <?php
												//$sql_results = "SELECT voucher.id, voucher.number, voucher.purchase_date, voucher.expiry_date, voucher.style, voucher.value, voucher.balance, voucher.customer_id, voucher.recipient_id, customers.firstname, customers.surname FROM voucher LEFT JOIN customers ON voucher.customer_id = customers.id";
												//$result_results = mysql_query($sql_results);
												$result_results = mysql_query($sql_search);
												if (! $result_results) error_message(sql_error());
												if (mysql_num_rows($result_results) > 0){
													while ($rs_results = mysql_fetch_assoc($result_results)){
													  ?>
													  <tr>
														<td>
															<div align="left">
																<input name="number" type="text" value="<?php echo $rs_results["number"]; ?>" readonly="" size="15">
															</div>
														</td>
														<td>
															<div align="left">
														 		<input name="voucher_name" type="text" value="<?php echo $rs_results["voucher_name"]; ?>" readonly="" size=50>
															</div>
														</td>

<?

/*
														<td>
															<div align="left">
														  		<input name="recipient" type="text" value="<//php echo $rs_results["recipient"]; //>" readonly="" size="14">
															</div>
														</td>
*/

?>

														<td>
															<div align="left">
														  		<input name="style" type="text" value="<?php echo $rs_results["style"]; ?>" readonly="" size="3">
															</div>
														</td>
														<td>
															<div align="left">
														  		<input name="purchase_date" type="text" value="<?php echo date('d/m/Y', convert_datetime_to_timestamp($rs_results["purchase_date"])); ?>" readonly="" size="10">
															</div>
														</td>
														<td>
															<div align="left">
														  		<input name="expiry_date" type="text" value="<?php echo date('d/m/Y', convert_datetime_to_timestamp($rs_results["expiry_date"])); ?>" readonly="" size="10">
															</div>
														</td>
														<td>
															<div align="left">
														  		<input name="value" type="text" value="<?php echo $rs_results["value"]; ?>" readonly="" size="4">
															</div>
														</td>
														<td>
															<div align="left">
														  		<input name="balance" type="text" value="<?php echo $rs_results["balance"]; ?>" readonly="" size="4">
															</div>
														</td>
														<td>
															<div align="left">
														  		<input name="currency" type="text" value="<?php echo $currencies[$rs_results["currency"]]["currency"]; ?>" readonly="" size="3">
															</div>
														</td>
														<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
														<td><div align="center"><a href="JavaScript: SubmitForm('delete', <?php echo $rs_results["id"]; ?>);">delete</a></div></td>
														<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
														<td><div align="center"><a href="JavaScript: SubmitForm('edit', <?php echo $rs_results["id"]; ?>);">edit</a></div></td>
													  </tr>
													  <?php
													}
												}
												mysql_free_result($result_results);
											  ?>
											  <tr>
												  <td colspan="122"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="12"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="12"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="12"><div align="left">Click on the word 'edit' next to the result in order to view or update any of its details.</div></td>
											  </tr>
											</table>
										</form>
									</td>
								</tr>
								<?php
								}
								//Edit Voucher
								if ($action == "edit"){
//									$sql_edit = "SELECT voucher.id, voucher.number, voucher.purchase_date, voucher.expiry_date, voucher.style, voucher.value, voucher.balance, voucher.customer_id, voucher.recipient_id, voucher.currency, customers.firstname, customers.surname FROM voucher LEFT JOIN customers ON voucher.customer_id = customers.id WHERE (voucher.id = " . $id . ")";
										$sql_edit = "SELECT id, number, purchase_date, expiry_date, style, value, balance, voucher_name, currency from voucher WHERE id='". $id . "'";

									//$sql_edit = "SELECT voucher.id, voucher.number, voucher.purchase_date, voucher.expiry_date, voucher.style, voucher.value, voucher.balance, voucher.customer_id, voucher.recipient_id, customers.firstname, customers.surname FROM voucher LEFT JOIN customers ON voucher.customer_id = customers.id WHERE (voucher.id = " . $_POST["id"] . ")";
									//$sql_edit = "SELECT voucher.id, voucher.number, voucher.style, voucher.purchase_date, voucher.expiry_date, voucher.value, voucher.balance, customers.id AS customers_id, IF(ISNULL(recipients.id), 0, recipients.id) AS recipients_id FROM (voucher INNER JOIN customers ON voucher.customer_id = customers.id) LEFT JOIN customers AS recipients ON voucher.recipient_id = recipients.id";
//echo '<br>$sql_edit: ' . $sql_edit;//exit;
									$result_edit = mysql_query($sql_edit);
									if (mysql_num_rows($result_edit) == 1){
										$rs_edit = mysql_fetch_assoc($result_edit);
									}
								?>
								<tr>
									<td>
										<form name="edit" method="post" action="vouchers.php">
											<input type="hidden" name="action" value="">
											<input type="hidden" name="id" value="">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td width="22%"><div align="left">Edit Voucher</div></td>
												<td width="54%">&nbsp;</td>
												<td width="24%">
													<div align="right">
														<a href="../admin/">Admin</a> | <a href="../admin/vouchers.php">Search</a> | <a href="JavaScript: SubmitForm('new', 'edit');">New</a>
													</div>
												</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Number</div></td>
												<td><input name="number" type="text" style="width: 100%" value="<?php echo $rs_edit["number"]; ?>" maxlength="12"></td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Voucher/Purchaser Name</div></td>
												<td>
<input type=text name="voucher_name" style="width: 100%" value="<?=$rs_edit['voucher_name'];?>"></td>
<?

/*
													<select name="customer_id" style="width: 100%">
														<option value="0">[None]</option>
														<//php
															$sql_purchasers = "SELECT DISTINCT id, firstname, surname FROM customers WHERE ((customers.firstname <> '') AND (customers.surname <>'')) ORDER BY surname ASC";
//echo '<br>$sql_purchasers: ' . $sql_purchasers;
															$result_purchasers = mysql_query($sql_purchasers);
															if (! $result_purchasers) error_message(sql_error());
															if (mysql_num_rows($result_purchasers) > 0){
																while ($rs_purchasers = mysql_fetch_assoc($result_purchasers)){
																	echo '<option value="' . $rs_purchasers["id"] . '" ';
																	if ($rs_purchasers["id"] == $rs_edit["customer_id"]){ echo "selected"; }
																	echo '>' . $rs_purchasers["surname"] . ', ' . $rs_purchasers["firstname"] . '</option>';
																}
															}
															mysql_free_result($result_purchasers);
														//>
													</select>
												</td>
<?

*/

?>

												<td>&nbsp;</td>
											  </tr>
<?PHP

/*
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Recipient</div></td>
												<td>
													<select name="recipient_id" style="width: 100%">
														<option value="0">[None]</option>
//														<php
															$sql_recipients = "SELECT DISTINCT id, firstname, surname FROM customers WHERE ((customers.firstname <> '') AND (customers.surname <>'')) ORDER BY surname ASC";
//echo '<br>$sql_purchasers: ' . $sql_purchasers;
															$result_recipients = mysql_query($sql_recipients);
															if (! $result_recipients) error_message(sql_error());
															if (mysql_num_rows($result_recipients) > 0){
																while ($rs_recipients = mysql_fetch_assoc($result_recipients)){
																	echo '<option value="' . $rs_recipients["id"] . '" ';
																	if ($rs_recipients["id"] == $rs_edit["recipient_id"]){ echo "selected"; }
																	echo '>' . $rs_recipients["surname"] . ', ' . $rs_recipients["firstname"] . '</option>';
																}
															}
															mysql_free_result($result_recipients);
//														>
													</select>
												</td>
												<td>&nbsp;</td>
											  </tr>
*/

?>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Style</div></td>
												<td>
													<select name="style" style="width: 100%">
														<option value="baby" <?php if ($rs_edit["style"] == "baby"){ echo "selected"; } ?>>Baby</option>
														<option value="boy" <?php if ($rs_edit["style"] == "boy"){ echo "selected"; } ?>>Boy</option>
														<option value="girl" <?php if ($rs_edit["style"] == "girl"){ echo "selected"; } ?>>Girl</option>
														?>
													</select>
												</td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Purchase Date</div></td>
												<td><?
													$purchase_timestamp = convert_datetime_to_timestamp($rs_edit["purchase_date"]);
													if( strcmp($purchase_timestamp, $rs_edit["purchase_date"]) == 0 )
													{
														$purchase_timestamp = mktime(0,0,0, date('m'), date('d'), date('Y'));
													}
												
													html_pulldown('purchase_day', range(1,31), date('j', $purchase_timestamp), false);
													?> / <?
													html_pulldown('purchase_month', range(1,12), date('n', $purchase_timestamp), false);
													?> / <?
													html_pulldown('purchase_year', range(2005, date('Y') + 10), date('Y', $purchase_timestamp), false);
													?></td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Expiry Date</div></td>
												<td><?
													$expiry_timestamp = convert_datetime_to_timestamp($rs_edit["expiry_date"]);
													if( strcmp($expiry_timestamp, $rs_edit["expiry_date"]) == 0 )
													{
														$expiry_timestamp = mktime(0,0,0, date('m') + 6, date('d'), date('Y'));
													}
												
													html_pulldown('expiry_day', range(1,31), date('j', $expiry_timestamp), false);
													?> / <?
													html_pulldown('expiry_month', range(1,12), date('n', $expiry_timestamp), false);
													?> / <?
													html_pulldown('expiry_year', range(2005, date('Y') + 10), date('Y', $expiry_timestamp), false);
													?></td>
												
												
												
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Original Value</div></td>
												<td><input name="value" type="text" style="width: 100%" value="<?php echo $rs_edit["value"]; ?>"></td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Current Balance</div></td>
												<td><input name="balance" type="text" style="width: 100%" value="<?php echo $rs_edit["balance"]; ?>"></td>
												<td>&nbsp;</td>
											  </tr>

											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Currency</div></td>
												<td align="left">
<select name="currency"  style="width: 100%">
<?PHP

foreach($currencies as $key => $value){
	
	$SELECTED = ($key == $rs_edit["currency"])?"SELECTED":"";
	print "<option value=\"{$key}\" {$SELECTED}>{$value["desc"]}</option>\n";
}

?>
</select>
</td>
												<td><div align="right">

												  <input name="save" type="button" style="width: 90%" value="Save" onClick="JavaScript: SubmitForm('update', <?php echo $rs_edit["id"] ?>);">
											    </div></td>
											  </tr>



											  <tr>
												  <td height="17" colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><div align="left">You may change any or all of the information above. Once you have finished modifying the information for the selected Voucher<br>click the Save button.</div></td>
											  </tr>
											</table>
										</form>
									</td>
								</tr>
								<?php
									mysql_free_result($result_edit);
								}
								//New Voucher
								if ($action == "new"){
									//$sql_edit = "SELECT voucher.id, voucher.number, voucher.purchase_date, voucher.expiry_date, voucher.style, voucher.value, voucher.balance, voucher.customer_id, voucher.recipient_id, customers.firstname, customers.surname FROM voucher LEFT JOIN customers ON voucher.customer_id = customers.id WHERE (voucher.id = " . $_POST["id"] . ")";
									//$result_edit = mysql_query($sql_edit);
									//if (mysql_num_rows($result_edit) == 1){
										//$rs_edit = mysql_fetch_assoc($result_edit);
									//}
								?>
								<tr>
									<td>
										<form name="save" method="post" action="vouchers.php">
											<input type="hidden" name="action" value="">
											<input type="hidden" name="id" value="">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td width="22%"><div align="left">Edit Voucher</div></td>
												<td width="54%">&nbsp;</td>
												<td width="24%">
													<div align="right">
														<a href="../admin/">Admin</a> | <a href="../admin/vouchers.php">Search</a>
													</div>
												</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Number</div></td>
												<td><input name="number" type="text" style="width: 100%" maxlength="12"></td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Voucher/Purchaser Name</div></td>
												<td>
<input type=text name="voucher_name" style="width: 100%" value="<?=$rs_edit['voucher_name'];?>"></td>
<?PHP

/*

												<td>
													<select name="customer_id" style="width: 100%">
														<option value="0">[None]</option>
														<//php
															$sql_purchasers = "SELECT DISTINCT id, firstname, surname FROM customers WHERE ((customers.firstname <> '') AND (customers.surname <>'')) ORDER BY surname ASC";
//echo '<br>$sql_purchasers: ' . $sql_purchasers;
															$result_purchasers = mysql_query($sql_purchasers);
															if (! $result_purchasers) error_message(sql_error());
															if (mysql_num_rows($result_purchasers) > 0){
																while ($rs_purchasers = mysql_fetch_assoc($result_purchasers)){
																	echo '<option value="' . $rs_purchasers["id"] . '" ';
																	//if ($rs_purchasers["id"] == $rs_edit["customer_id"]){ echo "selected"; }
																	echo '>' . $rs_purchasers["surname"] . ', ' . $rs_purchasers["firstname"] . '</option>';
																}
															}
															mysql_free_result($result_purchasers);
														//>
													</select>
												</td>
<?PHP

*/

?>
												<td>&nbsp;</td>
											  </tr>
<?PHP
/*
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Recipient</div></td>
												<td>
													<select name="recipient_id" style="width: 100%">
														<option value="0">[None]</option>
//														<php
															$sql_recipients = "SELECT DISTINCT id, firstname, surname FROM customers WHERE ((customers.firstname <> '') AND (customers.surname <>'')) ORDER BY surname ASC";
//echo '<br>$sql_purchasers: ' . $sql_purchasers;
															$result_recipients = mysql_query($sql_recipients);
															if (! $result_recipients) error_message(sql_error());
															if (mysql_num_rows($result_recipients) > 0){
																while ($rs_recipients = mysql_fetch_assoc($result_recipients)){
																	echo '<option value="' . $rs_recipients["id"] . '" ';
																	//if ($rs_recipients["id"] == $rs_edit["recipient_id"]){ echo "selected"; }
																	echo '>' . $rs_recipients["surname"] . ', ' . $rs_recipients["firstname"] . '</option>';
																}
															}
															mysql_free_result($result_recipients);
//														>
													</select>
												</td>
												<td>&nbsp;</td>
											  </tr>

*/

?>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Style</div></td>
												<td>
													<select name="style" style="width: 100%">
														<option value="baby">Baby</option>
														<option value="boy">Boy</option>
														<option value="girl">Girl</option>
														?>
													</select>
												</td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Purchase Date</div></td>
												<td><?
													$purchase_timestamp = mktime(0,0,0, date('m'), date('d'), date('Y'));
													html_pulldown('purchase_day', range(1,31), date('j', $purchase_timestamp), false);
													?> / <?
													html_pulldown('purchase_month', range(1,12), date('n', $purchase_timestamp), false);
													?> / <?
													html_pulldown('purchase_year', range(2005, date('Y') + 10), date('Y', $purchase_timestamp), false);
													?></td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Expiry Date</div></td>
												<td><?
													$expiry_timestamp = mktime(0,0,0, date('m') + 6, date('d'), date('Y'));
												
													html_pulldown('expiry_day', range(1,31), date('j', $expiry_timestamp), false);
													?> / <?
													html_pulldown('expiry_month', range(1,12), date('n', $expiry_timestamp), false);
													?> / <?
													html_pulldown('expiry_year', range(2005, date('Y') + 10), date('Y', $expiry_timestamp), false);
													?></td>
												
												<td>&nbsp;</td>
											  </tr>
											  
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Original Value</div></td>
												<td><input name="value" type="text" style="width: 100%" value=""></td>
												<td>&nbsp;</td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Current Balance</div></td>
												<td><input name="balance" type="text" style="width: 100%" value=""></td>
												<td>&nbsp;</td>
											  </tr>




											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												<td><div align="left">Currency</div></td>
												<td align="left">
<select name="currency"  style="width: 100%">
<?PHP

foreach($currencies as $key => $value){
	
	$SELECTED = ($key == $rs_edit["currency"])?"SELECTED":"";
	print "<option value=\"{$key}\" {$SELECTED}>{$value["desc"]}</option>\n";
}

?>
</select>
</td>
												<td><div align="right">
												  <input name="save" type="button" style="width: 90%" value="Save" onClick="JavaScript: SubmitForm('save', '');">
											    </div></td>
											  </tr>

											  <tr>
												  <td height="17" colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr bgcolor="#FFFFFF">
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
											  </tr>
											  <tr>
												  <td colspan="3"><div align="left">Here you may provide one or more pieces of information for the new Voucher. If you wish you may change any of the details at<br>a later time. Once you have finished you need to click on the Save button.</div></td>
											  </tr>
											</table>
										</form>
									</td>
								</tr>
								<?php
									//mysql_free_result($result_edit);
								}
								?>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>