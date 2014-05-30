<?php
	require_once("../common_db.php");
	require_once("../useractions.php");
	
	if (isset($_POST["vouchercode"])){
		$voucher_numbers = explode(",", $_POST["vouchercode"]);
		if ((isset($voucher_numbers)) && (count($voucher_numbers) == 4)){
			$voucher_number = strtoupper($voucher_numbers[0] . $voucher_numbers[1] . $voucher_numbers[2] . $voucher_numbers[3]);
			$voucher_number_formatted = strtoupper($voucher_numbers[0] . "-" . $voucher_numbers[1] . "-" . $voucher_numbers[2] . "-" . $voucher_numbers[3]);
		}
	}
	
	linkme();
	
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);
	
	$order_id = checkOrderId(false);


// get postage costs.
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
print $string;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
$cur = mysql_fetch_assoc($result);


//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

//echo '<br>$sql_temp_customer_details: ' . $sql_temp_customer_details;
//exit;	
	$redirect_to = "addphoneorder_customerdetails.php";


	$sql_ordered_items = "SELECT * FROM basket_items WHERE ordernumber = " . $order_id;
	$result_ordered_items = mysql_query($sql_ordered_items);
	if (! $result_ordered_items) error_message(sql_error());
	if (mysql_num_rows($result_ordered_items) > 0){
		$index_counter = 0;
		while ($rs_ordered_items = mysql_fetch_assoc($result_ordered_items)){
			$total_order_cost += $rs_ordered_items["price"]; //Sum of all the items currently in the list of ordered items
		}
		$total_order_cost += $cur['postage'];

		list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice, $voucher_error, $voucher_currency) = getVoucherDetails($total_order_cost, $_POST['vouchercode'], false, $_COOKIE['currency']);
		
		if ((isset($_POST["orderid"])) && (isset($order_id))){
			$sql_temp_customer_details = "INSERT INTO temp (orderid, submittype, firstname, surname, address, suburb, postcode, state, country, emailadd, homephone, workphone, mobilephone, referralcode, hear_about, specialreqs, paymentmeth, vouchercode, total, postage, grand, voucher_amount) VALUES ('" . $_POST["orderid"] . "', '" . $_POST["submittype"] . "', '" . $_POST["firstname"] . "', '" .  $_POST["surname"]. "', '" . $_POST["address"] . "', '" . $_POST["suburb"] . "', '" . $_POST["postcode"] . "', '" . $_POST["state"] . "', '" . $_POST["country"] . "', '" . $_POST["emailadd"] . "', '" . $_POST["homephone"] . "', '" . $_POST["workphone"] . "', '" . $_POST["mobilephone"] . "', '" . $_POST["referralcode"] . "', '" . $_POST["hear_about"] . "', '" . stripslashes($_POST["specialreqs"]) . "', '" . $_POST["paymentmeth"] . "', '" . $_POST["vouchercode"] . "', '" . $_POST["total"] . "', '" . $_POST["postage"] . "', '" . $_POST["grand"] . "', '{$voucher_usage}')";
		}
	
		mysql_query($sql_temp_customer_details);


		if ($totalprice == 0){ //The order cost minus the voucher value equals zero - no charge for order
			$redirect_to = "addphoneorder_confirmdetails.php?msg=N1";
		}else if ($totalprice > 0){ //The voucher value does not cover the cost of the order 
			$redirect_to = "addphoneorder_customerdetails.php?msg=N2";
		}else if ($totalprice < 0){ //The order cost is less than the value of the voucher
			$redirect_to = "addphoneorder_confirmdetails.php?msg=N3";
		}else if ($voucher_balance ==0 && $voucher_usage ==0){ //The balance of the voucher being used as payment for the current order is zero
			$redirect_to = "addphoneorder_customerdetails.php?msg=C5";		
		}
	}else{ //No ordered items could be found
		$redirect_to = "addphoneorder_customerdetails.php?msg=C1";
	}

header("Location: " . $redirect_to);
exit;
		

	
	$sql_ordered_items = "SELECT * FROM basket_items WHERE ordernumber = " . $order_id;
	$result_ordered_items = mysql_query($sql_ordered_items);
	if (! $result_ordered_items) error_message(sql_error());
	if (mysql_num_rows($result_ordered_items) > 0){
		$index_counter = 0;
		while ($rs_ordered_items = mysql_fetch_assoc($result_ordered_items)){
			$total_order_cost += $rs_ordered_items["price"]; //Sum of all the items currently in the list of ordered items
			if ($rs_ordered_items["type"] == 16){ //A voucher payment item was found in the list of ordered items
				$voucher_ordered_items[$index_counter] = $rs_ordered_items["quantdesc"]; //List of all the voucher numbers for any vouchers already used as payment
				$index_counter++;
			}
		}
		if (isset($voucher_number)){

			$sql_available_voucher = "SELECT * FROM voucher WHERE voucher.expiry_date >= '" . date("Y-m-d") . "' AND voucher.number = '" . $voucher_number . "'";
			$result_available_voucher = mysql_query($sql_available_voucher);
			if(!$result_available_voucher) error_message(sql_error());
			if(mysql_num_rows($result_available_voucher) == 1){
				$rs_available_voucher = mysql_fetch_assoc($result_available_voucher);
				if (isset($voucher_ordered_items)){ //List of all the voucher numbers for any vouchers already used as payment for the current order
					$index_counter = 0;
					$voucher_found = false;
					while (($index_counter < count($voucher_ordered_items)) && (! $voucher_found)){
						if ($voucher_ordered_items[$index_counter] == $voucher_number_formatted){
							$voucher_found = true;
						}
						$index_counter++;
					}
				}
				if (! $voucher_found){ //The voucher number passed by the calling page has not yet been used as payment for the current order
					if ($rs_available_voucher["balance"] > 0){


						$voucher_amount_used = $total_order_cost - $rs_available_voucher["balance"];

						if (($total_order_cost - $rs_available_voucher["balance"]) == 0){ //The order cost minus the voucher value equals zero - no charge for order
							$sql_add_voucher = "INSERT INTO basket_items (ordernumber, price, quantdesc, type) VALUES (" . $order_id . ", " . -($total_order_cost) . ", '" . $voucher_number_formatted . "', 16)";
							$redirect_to = "addphoneorder_confirmdetails.php?msg=N1";
						}else if (($total_order_cost - $rs_available_voucher["balance"]) > 0){ //The voucher value does not cover the cost of the order 
							$sql_add_voucher = "INSERT INTO basket_items (ordernumber, price, quantdesc, type) VALUES (" . $order_id . ", " . -($rs_available_voucher["balance"]) . ", '" . $voucher_number_formatted . "', 16)";
							$redirect_to = "addphoneorder_customerdetails.php?msg=N2";
						}else if (($total_order_cost - $rs_available_voucher["balance"]) < 0){ //The order cost is less than the value of the voucher
							$sql_add_voucher = "INSERT INTO basket_items (ordernumber, price, quantdesc, type) VALUES (" . $order_id . ", " . -($total_order_cost) . ", '" . $voucher_number_formatted . "', 16)";
							$redirect_to = "addphoneorder_confirmdetails.php?msg=N3";
						}
	// moved down here to allow the voucher_amount to be inserted.
	if ((isset($_POST["orderid"])) && (isset($order_id))){
		$sql_temp_customer_details = "INSERT INTO temp (orderid, submittype, firstname, surname, address, suburb, postcode, state, country, emailadd, homephone, workphone, mobilephone, referralcode, hear_about, specialreqs, paymentmeth, vouchercode, total, postage, grand, voucher_amount) VALUES ('" . $_POST["orderid"] . "', '" . $_POST["submittype"] . "', '" . $_POST["firstname"] . "', '" .  $_POST["surname"]. "', '" . $_POST["address"] . "', '" . $_POST["suburb"] . "', '" . $_POST["postcode"] . "', '" . $_POST["state"] . "', '" . $_POST["country"] . "', '" . $_POST["emailadd"] . "', '" . $_POST["homephone"] . "', '" . $_POST["workphone"] . "', '" . $_POST["mobilephone"] . "', '" . $_POST["referralcode"] . "', '" . $_POST["hear_about"] . "', '" . stripslashes($_POST["specialreqs"]) . "', '" . $_POST["paymentmeth"] . "', '" . $_POST["vouchercode"] . "', '" . $_POST["total"] . "', '" . $_POST["postage"] . "', '" . $_POST["grand"] . "', '{$voucher_amount_used}')";
	}



						mysql_query($sql_temp_customer_details);
//						mysql_query($sql_add_voucher);
					}else{ //The balance of the voucher being used as payment for the current order is zero
						$redirect_to = "addphoneorder_customerdetails.php?msg=C5";
					}
				}else{ //The voucher number passed by the calling page has already been used as payment for the current order
					$redirect_to = "addphoneorder_customerdetails.php?msg=C4";
				}
			}else{ //No valid voucher with the voucher number passed from the calling page could be found
				$redirect_to = "addphoneorder_customerdetails.php?msg=C3";
			}
		}else{ //No voucher number was passed from the calling page
			$redirect_to = "addphoneorder_customerdetails.php?msg=C2";
		}
	}else{ //No ordered items could be found
		$redirect_to = "addphoneorder_customerdetails.php?msg=C1";
	}
	header("Location: " . $redirect_to);
	exit;
?>