<?php
session_start();
include("useractions.php");
include("vieworderlist.php");
require_once("debug_log.php");

$id = $_GET["orderid"];
$order_id = $id+1000;
debug_log_add("order_confirmed_ps.php", "Order ID: " . $order_id);

// check if express post chosen
if(isset($_SESSION["express_post"]) && $_SESSION["express_post"]!='')
{
	$postage = $_SESSION["express_post"];
}
else // if normal post
{
	$postage = $cur['postage'];
}

if($id==false){
	exit();
	header("location:products_home.php");
	exit;
}else{
	linkme();
	$query = "SELECT firstname, surname FROM customers a, orders b WHERE a.id=b.customer AND b.id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$qdata = mysql_fetch_array($result);


	if(!isset($cur)){
		// gets currencies / postage costs.
		$query = "SELECT * FROM currencies WHERE id=".$_SESSION["currency"];
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		$cur = mysql_fetch_assoc($result);
		$currency = $_SESSION['currency'];
	}
	else {
		$currency = $_COOKIE['currency'];
	}
	
	
	$query = "SELECT customer FROM orders WHERE id=" . $_GET['orderid'];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$custid = $qdata["customer"];
	}
	
	$query = "SELECT emailadd, voucher, firstname FROM customers WHERE id=".$custid;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$custemail = $qdata["emailadd"];
		$vouchercode = $qdata["voucher"];
		$firstname = $qdata["firstname"];
	}
	
	$query = "SELECT * FROM basket_items WHERE ordernumber=" . $_GET['orderid'];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());

	$total_order_charge = 0;
	$_SESSION['baby_pack_in_order'] = false;
	while($qdata = mysql_fetch_array($result)){
		$total_order_charge += $qdata["price"];
	}
	$total_order_charge += $postage;

	$query = "SELECT symbol FROM currencies LEFT JOIN orders ON currencies.id = orders.currency WHERE orders.customer = " . $custid . " LIMIT 1";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$currency_symbol = "";
	$currency_symbol = mysql_fetch_assoc($result);

	$total_before_voucher = $total_order_charge;
	list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $total_order_charge, $voucher_errors, $voucher_currency) = getVoucherDetails($total_order_charge, $vouchercode, false, $currency);	


	if($_GET["postageoption"]=="Australian Express" || $_GET["postageoption"]=="Overseas Express")
	{
		$ordid = $_GET['orderid'];
		$orderid -= 1000;
		sendExpresspost($ordid, $firstname, $custemail);
	}

	$ezyTrackerJScript = '<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439&ezsale=1&ezorderref=' . $_GET['orderid'] . '&ezamount=' . $total_order_charge . '"></script>';

}




// reset voucher details.
$_SESSION['voucher']="";

linkme();
include("header.php");
?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p>Thanks! 
                                      Your order has been received.</p></td>
                                </tr>
                                <tr> 
                                  <td width="4%"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p>Your invoice 
                                      number is <strong><? echo 1000+$id;?>.</strong></p></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <?php 
                                        $_GET['page'] = $_REQUEST['page'] = 481;
                                        include 'content_only.php';
                                        ?>
                                        
                                    </td>
                                </tr>
                                
                                <!--
                                <tr> 
                                  <td width="4%"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p><Br />Your order will be dispatched from NSW within 5 business days from date of payment received. Allow regular postage transit time to your state/area with Australia Post unless using the express option.</strong></p></td>
                                </tr>
-->


                              </table></td>
                          </tr>
                          <!--
                          <tr> 
                            <td><img src="images/gen/spacer.gif" width="1" height="10"></td>
                          </tr>
                          <tr> 
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext"><strong>Credit 
                                          Card Payments</strong></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext">If 
                                          you have paid by credit card, your order 
                                          is complete! <a href="http://www.identikid.com.au/index.php" class="type1">Click 
                                          here to return to the home page.</a></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" valign="top" class="maintext"><strong>PayPal&trade; Invoice</strong></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext">If you have requested that identiKid invoice you via PayPal&trade;, an invoice will be sent to the email address provided during the checkout process.
                                          <br></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" valign="top" class="maintext"><strong>Direct 
                                          Bank Account Payments (EFT Payments)</strong></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext">If 
                                          you will be paying directly into identiKid's 
                                          bank account, please do so now using 
                                          the details below.<br>
                                          <br>
                                          IdentiKid's Postal Address / Bank Account 
                                          details are:</td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top"><strong><img src="images/gen/spacer.gif" width="10" height="10"></strong></td>
                                      </tr>
                                      <tr> 
                                        <td width="91" valign="top"> <div class="maintext"><strong> 
                                            NSW OFFICE</strong></div></td>
                                        <td width="24" rowspan="5" valign="top"><img src="images/gen/spacer.gif" width="5" height="10"></td>
                                        <td width="251" valign="top"> <div class="maintext"><strong>Direct 
                                            Bank Account Payments<br>
                                            (EFT Payments)</strong></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><strong><img src="images/gen/spacer.gif" width="10" height="10"></strong></td>
                                        <td valign="top"><strong><img src="images/gen/spacer.gif" width="10" height="10"></strong></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext">&nbsp;</td>
                                        <td valign="top" class="smalltext"><strong>Bank:</strong> 
                                          Westpac</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext">PO 
                                          Box 8775</td>
                                        <td valign="top" class="smalltext"><strong>Account 
                                          Name:</strong> identiBiz Pty Ltd</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext"> Wagga Wagga NSW</td>
                                        <td valign="top" class="smalltext"><strong>BSB</strong>: 
                                          032-769 </td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext">Australia 
                                          2650</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top" class="smalltext"><strong>Acc. 
                                          Number:</strong> 277865</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top" class="smalltext"><strong>Reference:</strong> 
                                          <? echo (1000+$id)." ".$qdata['firstname']." ".$qdata['surname']; ?> 
                                          *<strong><br>
                                          </strong></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="maintext">&nbsp;</td>
                                        <td rowspan="4" valign="top">&nbsp;</td>
                                        <td rowspan="4" valign="top" bgcolor="#EAEAEA" class="smalltext"><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                            <tr> 
                                              <td class="smalltext"><strong>*</strong> 
                                                <strong>You MUST put your reference 
                                                number in the description field</strong> 
                                                (and your name too if there's 
                                                room).<br>
                                                Without this reference number, 
                                                we can't match your payment to 
                                                your order, and this can cause 
                                                delays in your order being sent 
                                                out</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext">&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="smalltext">&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td valign="top" class="maintext">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                </table>
                                  
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          -->
                          <tr valign="top" colspan="3"> 
                            <td align="right">&nbsp;</td>
                          </tr>
                          <tr valign="top" colspan="3"> 
                            <td align="right"><a href="index.php"><img src="images/nav/n_continue_o.gif" alt="Continue" name="Image25" width="80" height="22" border="0"></a></td>
                          </tr>
                        </table>
                      </td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/gen/spacer.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                    </tr>
                  </table>
              

<? 
include "footer.php" ;
// we're done - delete the sess id from the order.
deleteOrderId($id);
killSession();
?>
