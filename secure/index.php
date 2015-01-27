<?PHP

require_once("../debug_log.php");

/**************
*
*	SECURE FORM
*
**************/ 

require_once "../_common/_constants.php";
$includeabove = true;
require_once "../useractions.php";
require_once "./secure_functions.php";
require_once("libcurlemu.inc.php");


session_start();
header("Cache-control: private"); 

// initiate DB connection
linkme();



if(!empty($_POST['paymentAmount']))
	$_SESSION['paymentAmount'] = $_POST['paymentAmount'];

if(!empty($_POST['invoiceNumber']))
	$_SESSION['invoiceNumber'] = $_POST['invoiceNumber'];

if(!empty($_POST['currency']))
	$_SESSION['currency'] = $_POST['currency'];

if(!empty($_POST['custid']))
	$_SESSION['custid'] = $_POST['custid'];

if(!empty($_POST['fromAdmin']))
	$_SESSION['fromAdmin'] = $_POST['fromAdmin'];

if(!empty($_POST['baby_pack_in_order']))
	$_SESSION['baby_pack_in_order'] = $_POST['baby_pack_in_order'];

// testing purposes only.
if(isset($_POST['TEST_AMOUNT']) && !empty($_POST['TEST_AMOUNT'])){
	$_SESSION['paymentAmount'] = $_POST['TEST_AMOUNT'];
}

// TESTING
// $_SESSION['paymentAmount'] = 50;
//print_r($_SESSION);
$order_id = checkOrderId(false)+1000;
debug_log_add("secure/index.php", $_REQUEST['section'] . " - " . $order_id);

//<pre>
//=print_r($_SERVER);
//</pre>

//print (verify_referer())?"true":"false";

//if (verify_referer() && loginUserToSecure())
//{
	// calculates amount
	$AMOUNT = floor($costs[$_SESSION['usertype']] * 100);  // cents

	switch ($_REQUEST['section'])
	{
		case "getcc":
			require_once "secure_header.php";
			getCCDetails();
			require_once "secure_footer.php";
			break;
		case "verify":
			require_once "secure_header.php";
			verifyCCDetails();
			require_once "secure_footer.php";
			break;
		case "submitCC":
			submitCCDetails();
			break;
		default:
			errorMsg();
			break;
	}
/*
} 
else {
	require_once "secure_header.php";
	errorMsg();
	require_once "secure_footer.php";
}
*/
exit();


function submitCCDetails()
{
	global $_EPAY, $AMOUNT, $membership_term;

	// for testing purposes, 00 cents = successful transaction, all others are different error codes.
	$AMOUNT = floor($_SESSION['paymentAmount'] * 100);



	// insert order data into cc_transaction database.
	$string = "insert into cc_transactions (OI)values ('{$_SESSION['invoiceNumber']}')";
	$result = mysql_query($string) or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);
	if ($result)
	{
		$insert_id = mysql_insert_id();
		$OI = $_SESSION['invoiceNumber'];

//======================================================================================
//
// TEST CODE For Debugging issues via CC Payment workflow
// Best to comment this out when not testing - JUST IN CASE!
//
//======================================================================================
		// Extract CC Name - if it is ECHIDNA TEST then use the test gateway
		$ccn = $_POST['Cust_Name'];
		if ("ECHIDNA TEST" == $ccn)
		{
			 //$_EPAY['SC_Merch'] = "identikid-test";
		}
		else
		{
			//$_EPAY['SC_Merch'] = "identikid";
		}
//======================================================================================
		
		$query_data  = "Cust_Card={$_POST['Cust_Card']}";
		$query_data .= "&Cust_Card_MM={$_POST['Cust_Card_MM']}";
		$query_data .= "&Cust_Card_YY={$_POST['Cust_Card_YY']}";
		$query_data .= "&SC_Merch={$_EPAY['SC_Merch']}";
		$query_data .= "&SC_Order={$OI}";
		$query_data .= "&SC_Amount={$AMOUNT}";
		$query_data .= "&ACTION={$_EPAY['ACTION']}";
		$query_data .= "&W={$_EPAY['W']}";
		$query_data .= "&DETAILS=CC Name: {$_POST['Cust_Name']}";
//		$query_data .= "&orderdetails_test=Shauns Test";
		$query_data .= "&submit=SUBMIT";

//print $query_data;

		if (!$ch = curl_init()) {
		    echo "Could not initialize cURL session.\n";
		    exit;
		}

		// submit payment	
		curl_setopt($ch, CURLOPT_URL, $_EPAY['url']);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDSIZE, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
                curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
		$output = curl_exec($ch);
		/*
		echo '<pre>';
		print_r(curl_getinfo($ch));
		echo '</pre>';
		echo 'Errors: ' . curl_errno($ch) . ' ' . curl_error($ch) . '<br><br>';
		*/
		curl_close($ch);




/*

// test data
$output = "MS=0
MR=M0
MT=Clearance started
DETAIL
OI=11302
TI=11302-1
ST=3
SC=0
RC=00
RT=Approved
AM=5500
CR=AUD
RR=7FJd36M1
SD=0210
TY=CAPTURE
TT=10 Feb 2005 03:22:59 EST
IP=202.60.69.120
END
";
*/

		if($output == ''){
			secureErrorMsg("IdentiKid systems did not receive a response from the Payment Gateway.", true);
			$string = "update cc_transactions set notes='IdentiKid systems did not receive a response from the Payment Gateway.' where id='{$insert_id}'";
			$result = mysql_query($string) or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);
		} else {

			$bits = split("\n", $output);
			$results = array();
			foreach($bits as $bit){
				$bits2 = split("=", $bit);
				$results[$bits2[0]] = $bits2[1];
			}

			// insert results into database.
			$string = "update cc_transactions set MS='{$results['MS']}',MR='{$results['MR']}',MT='{$results['MT']}', TI='{$results['TI']}', ST='{$results['ST']}', SC='{$results['SC']}', RC='{$results['RC']}', RT='{$results['RT']}', AM='{$results['AM']}', CR='{$results['CR']}', RR='{$results['RR']}', SD='{$results['SD']}', TY='{$results['TY']}', TT='{$results['TT']}', IP='{$results['IP']}' where id='{$insert_id}'";
			$result = mysql_query($string) or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);

			// if transfer OK, update customers table with approved transaction.



			if($results['MR']=="M12"){
				// This order has already been processed and was successful

			}else{
				if ($results['SC']=="0")
				{
					$approved = "1";
				}
				else {
					$approved = "0";
				}
	
				// update customer table.
				$string = "update customers set approved='{$approved}' where id='{$_SESSION['custid']}'";
				$result = mysql_query($string) or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);
		
				// submit their order via email.			
	
				$query = "SELECT ordertype FROM orders WHERE id=".($_SESSION["InvoiceNumber"]-1000);
				$result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);
				list($ordertype) = mysql_fetch_row($result);
	
				// send customers details
				if($results["SC"]=="0")
				{
					$query = "SELECT firstname, surname, emailadd FROM customers WHERE id=".$_SESSION['custid'];
					$result = mysql_query($query) or secureErrorMsg("SQL ERROR:  Line {__LINE__} ".mysql_error(), $header=true);
					list($firstname, $surname, $emailadd)=mysql_fetch_row($result);
					if($ordertype=="Phone/fax" || $_SESSION['fromAdmin']==1){
						$fromadmin=true;
					}
					sendNewOrder(($_SESSION["invoiceNumber"]-1000), "{$firstname} {$surname}", $emailadd, "Credit Card - ePay", true);
				}
			}

			Header("Location: secure_receipt.php?order={$_SESSION['invoiceNumber']}&id={$insert_id}");

		


//				$string = "select customer from orders where id='{$_SESSION['invoiceNumber']}'";
//				$result = mysql_query($string) or die("SQL error: Line {__LINE__} ".mysql_error());

//				list($custid) = mysql_fetch_row($result);



//				list($begin, $end, $epoch_begin, $epoch_end) = returnMembershipDates($_SESSION['expiry'], $membership_term);
//				$_SESSION['expiry'] = $epoch_end;
//				$string = "update {$_SESSION['usertype']}s set expiry='".date('Y-m-d', $epoch_end)."' where id='{$_SESSION['id']}'";
//				$result = mysql_query($string) or die("SQL error: Line ".__LINE__." ".mysql_error());
//			}

		//	print "<p>output<br /><pre>$output</pre></p>";
		}
//		Header("Location: secure_receipt.php?id={$orderID}&OI={$OI}");
	}

/*
// '{$_SESSION['']}'
// PHP CURL METHOD


*/



}



function verifyCCDetails()
{
	global $AMOUNT, $membership_term;
	// customer verify's form.
	//  then submits to payment gateway.


	?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
						  	<form action="" method="post" name="form" id="form" onSubmit="return validateForm(this);">
								<input type="hidden" name="section" value="submitCC">
								<input type="hidden" name="Cust_Card" value="<?=$_POST['cc1']?><?=$_POST['cc2']?><?=$_POST['cc3']?><?=$_POST['cc4']?>">
								<input type="hidden" name="SC_Amount" value="<?=$_SESSION['paymentAmount']?>">
<?
	if($_SESSION['fromAdmin']){
		?>
		<tr>
			<td colspan=3><strong>Administration Order</strong></td>
		</tr>
		<tr>
			<td colspan=3>&nbsp;</td>
		</tr>
		<?
	}

	$ignore = array('submit', 'section');
	foreach($_POST as $key => $value){
		if(!in_array($key, $ignore)){
			print "<input type=hidden name=\"{$key}\" value=\"{$value}\">\n";
		}	
	}

?>
                            <tr valign="top"> 
                              <td colspan="3">Please verify the details below to finalise payment.<br />&nbsp;</td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Invoice Number:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_SESSION['invoiceNumber']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Amount:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext">$<?=sprintf("%01.2f", $_SESSION['paymentAmount'])?> <strong>AUD</strong></td>
                            </tr>
                            <tr valign="top"> 
                              <td colspan="3" class="maintext"><p>&nbsp;</p></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Card Type:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_POST['Cust_CardType']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Name on Card:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_POST['Cust_Name']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Credit Card Number:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_POST['cc1']?> <?=$_POST['cc2']?> <?=$_POST['cc3']?> <?=$_POST['cc4']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Expiry Date:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_POST['Cust_Card_MM']?> / <?=$_POST['Cust_Card_YY']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Security Code/Issue 
                                Number:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_POST['Cust_CVV']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" colspan=3>&nbsp;</td>
                            </tr></form>
                            <tr> 
                              <td colspan="3" valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td width="150">
									<a href="javascript:document.form.submit();" onMouseOver="MM_swapImage('submitimg','','../images/button_continue_mo.gif',1)"  onMouseOut="MM_swapImgRestore()"><img name="submitimg" id="submitimg" src="../images/button_continue.gif" border="0"></a>
									</td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td><a href="javascript:backForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','../images/button_back_mo.gif',1)"><img src="../images/button_back.gif" alt="Back" name="back" border="0"></a></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
	<?
} 

function getCCDetails()
{
	global $_CONSTANTS;

//	list($membership_begin, $membership_end) = returnMembershipDates($_SESSION['expiry'], $membership_term);
	?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
						  	<form action="" method="post" name="form" id="form" onSubmit="return validateForm(this);">
								<input type="hidden" name="section" value="verify">
<?
	if($_SESSION['fromAdmin']){
		?>
		<tr>
			<td colspan=3><strong>Administration Order</strong></td>
		</tr>
		<tr>
			<td colspan=3>&nbsp;</td>
		</tr>
		<?
	}
/*
>
<tr>
	<td colspan=3><h3>TESTING ONLY</h3>
	.00 cent values will give a valid payment.<br />
	all other cent values will give an error.<br />
	eg. 14.13 will give an error of 'Invalid Amount'<br />
	eg. 14.43 will give an error of 'Stolen card, pick up'<br />
	<br />
			test price: <input type=text name="TEST_AMOUNT" value="<//=sprintf("%01.2f", $_SESSION['paymentAmount'])//>">
	</td>
</tr>

*/

?>
<tr>
	<td colspan=3>&nbsp;</td>
</tr>
                            <tr valign="top"> 
                              <td colspan="3" class="maintext"><p>Please enter your Credit Card details below.<Br />
																&nbsp;</p>
															</td>
                            </tr>

                            <tr> 
                              <td valign="top" class="maintext">Invoice Number:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"><?=$_SESSION['invoiceNumber']?></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Amount:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext">$<?=sprintf("%01.2f", $_SESSION['paymentAmount'])?> <strong>AUD</strong></td>
                            </tr>
                            <tr valign="top"> 
                              <td colspan="3" class="maintext">&nbsp;</td>
                            </tr>

                            <tr> 
                              <td valign="top" class="maintext">Card Type:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"> <select name="Cust_CardType" class="formtext" id="Cust_CardType">
		<?PHP

			// cards
			foreach ($_CONSTANTS['cards'] as $card)
			{
				$SELECTED = ($_POST['Cust_CardType']==$card)?"SELECTED":"";
				print "<option value=\"{$card}\" {$SELECTED}>{$card}</option>\n";
			}
		?>
                                </select></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Name on Card:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"> <input name="Cust_Name" type="text" class="formtext" id="Cust_Name" style="width:300px;"  value="<?=$_POST['Cust_Name']?>"></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Credit Card Number:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"> <input name="cc1" type="text" class="formtext" id="cc1" style="width:61px;"  maxlength="4" value="<?=$_POST['cc1']?>"> 
                                <img src="../images/spacer_trans.gif" width="10" height="10"> 
                                <input name="cc2" type="text" class="formtext" id="cc2" style="width:61px;"  maxlength="4" value="<?=$_POST['cc2']?>"> 
                                <img src="../images/spacer_trans.gif" width="10" height="10"> 
                                <input name="cc3" type="text" class="formtext" id="cc3" style="width:61px;"  maxlength="4" value="<?=$_POST['cc3']?>"> 
                                <img src="../images/spacer_trans.gif" width="10" height="10"> 
                                <input name="cc4" type="text" class="formtext" id="cc4" style="width:61px;"  maxlength="4" value="<?=$_POST['cc4']?>"></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Expiry Date:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="maintext"> <select name="Cust_Card_MM" class="formtext" id="Cust_Card_MM">
                              <?
										$selected_value = (!empty($_POST['Cust_Card_MM']))?$_POST['Cust_Card_MM']:date(m);
										for($i=1; $i<13; $i++){
											$SELECTED = ($selected_value==$i)?"SELECTED":"";
											print "<option {$SELECTED} value=\"".sprintf("%02d", $i)."\">".sprintf("%02d", $i)."</option>\n";
										}

										?>
                                </select>
                                / 
                                <select name="Cust_Card_YY" class="formtext" id="Cust_Card_YY">
                                  <?
										$selected_value = (!empty($_POST['Cust_Card_YY']))?$_POST['Cust_Card_YY']:date(y);
										for($i=date('y'); $i<date('y')+10; $i++){
											$SELECTED = ($selected_value==$i)?"SELECTED":"";
											print "<option {$SELECTED} value=\"".sprintf("%02d", $i)."\">".sprintf("%02d", $i)."</option>\n";
										}

										?>
                                </select></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="maintext">Security Code/Issue 
                                Number:</td>
															<td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                              <td valign="top" class="ordertext"> <input name="Cust_CVV" type="text" class="formtext" id="Cust_CVV" size="4" maxlength="4" value="<?=$_POST['Cust_CVV']?>"></td>
                            </tr>
                            <tr> 
                              <td valign="top" class="ordertext" colspan=3>(<strong>last 3 digits on back of card, 4 digits for AMEX</strong>) </td>
                            </tr>
                            <tr> 
                              <td valign="top" colspan=3>&nbsp;</td>
                            </tr></form>
                            <tr> 
                              <td colspan="3" valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td width="150">

									<a href="javascript:submitForm(document.form);" onMouseOver="MM_swapImage('submitimg','','../images/button_continue_mo.gif',1)"  onMouseOut="MM_swapImgRestore()"><img name="submitimg" id="submitimg" src="../images/button_continue.gif" border="0"></a>
									</td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td><a href="javascript:window.opener.history.back(); window.opener.focus(); self.close();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','../images/button_back_mo.gif',1)"><img src="../images/button_back.gif" alt="Back" name="back" border="0"></a></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
	<?
}




function verify_referer(){

	global $secure_refer, $referer_url, $referer_url2;
	/**
	*	verify's form referer is valid.
	***/

	$REFERER = substr($_SERVER['HTTP_REFERstyle="width:60px;" ER'], 0, strrpos($_SERVER['HTTP_REFERER'], "?"));
	if ($_SERVER['HTTPS']=="on"){
		// secure server is on.

		if ($REFERER==$secure_refer || empty($REFERER))
		{	
			// referrer is itself.
			return true;
		}
		elseif ($REFERER==$referer_url || $REFERER ==$referer_url2)
		{  
			// referer is a from a valid source.
			// reset session
			session_destroy();
			session_start();
			return true;
		}
	}
	return false;
}

?>
