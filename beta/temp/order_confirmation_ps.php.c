<?
session_start();

require_once("debug_log.php");

/*
if ($_COOKIE['currency']==1) //Australia
{
		//$postage = $_GET["postageamount"];
		//$postage_option = $_GET["postageoption"];
		$postage_option = $_SESSION["post_option"];		
		$postage = $_SESSION["postageamount"]; 
}
*/
include_once("useractions.php");
include("vieworderlist.php");

if($_POST["orderid"]){
	$id = $_POST["orderid"];
}else if($_GET["orderid"]){
	$id = $_GET["orderid"];
}else{
	$id = checkOrderId(false);
}

linkme();

$id = checkOrderId(false);
$order_id = $id+1000;
debug_log_add("order_confirmation_ps.php", "Order ID: " . $order_id);



$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);
/*
if ($_COOKIE['currency']!=1) //Australia
{
	$postage = $cur['postage'];
}
*/
 
$postage_option = $_SESSION["post_option"];		
$postage = $_SESSION["postageamount"];

if($id==false){
	header("location:products_home.php");
	exit;
}

getCustomerDetails($id);

//$identitags_in_order = false;
$identibands_in_order = false;
$_SESSION['baby_pack_in_order'] =false;
$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
if(mysql_num_rows($result)>0){
	while($qdata = mysql_fetch_array($result)){
		$totalprice += $qdata["price"];
		//if($qdata['type']==14)
		if($qdata['type']==30 || $qdata['type']==31)
		{
			//$identitags_in_order = true;
			$identibands_in_order = true;
		}
		if($qdata['type']==16){
			$_SESSION['baby_pack_in_order'] = true;
		}
	}
}

$totalprice_withoutpostage = $totalprice;
// with postage;
$totalprice += $postage;


//print "TEST: $totalprice, {$_SESSION['vouchercode']}<BR>";



$tempVoucherDetails = getVoucherDetails($totalprice, $_SESSION['vouchercode']);
$voucher_usage_raw = $tempVoucherDetails[4];

// gets voucher usage in the ORDERS currency
list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice, $voucher_error, $voucher_currency) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);


// gets voucher usage in the VOUCHERS currency
//print $currencies[$_COOKIE['currency']]['code']."to".$currencies[$voucher_currency]['code'];
if($usevoucher){
	$voucher_usage_raw = convertCurrency($voucher_usage, $currencies[$_COOKIE['currency']]['code']."to".$currencies[$voucher_currency]['code']);
}


if($usevoucher){
	// change the vouchers amount.
//	$voucher_total = convertCurrency($voucher_total, $currencies[$voucher_currency]['code']."to".$currencies[$_COOKIE['currency']]['code']);
//	$voucher_usage = convertCurrency($voucher_usage, $currencies[$voucher_currency]['code']."to".$currencies[$_COOKIE['currency']]['code']);
//	$voucher_balance = convertCurrency($voucher_balance, $currencies[$voucher_currency]['code']."to".$currencies[$_COOKIE['currency']]['code']);
}

$totalprice = 0;
//print "POST: {$cur['postage']}<BR>";



include("header.php");
//print_r($_SESSION);
?>
															<table width="890" border="0" cellspacing="0" cellpadding="0"> 
																<form name="backform" method="post" action="order_form_ps.php"> 
																	<input type="hidden" name="orderid" value="<? echo $id;?>"> 
																	<input type="hidden" name="paymentmeth" value="<?=$paymentmeth;?>"> 
																</form> 
																<form name="confform" method="post" action="submitorder_ps.php"> 
																	<input type="hidden" name="postageamount" value="<? echo $postage;?>"> 
																	<input type="hidden" name="postageoption" value="<? echo $postage_option;?>">  
																	<input type="hidden" name="submittype" value="confirmed"> 
																	<input type="hidden" name="orderid" value="<? echo $id;?>">  
																	<input type="hidden" name="firstname" value="<? echo stripslashes($firstname);?>"> 
																	<input type="hidden" name="surname" value="<? echo stripslashes($surname);?>"> 
																	<input type="hidden" name="del_name" value="<? echo stripslashes($del_name);?>"> 
																	<input type="hidden" name="address" value="<? echo stripslashes($address);?>"> 
																	<input type="hidden" name="suburb" value="<? echo stripslashes($suburb);?>"> 
																	<input type="hidden" name="postcode" value="<? echo $postcode;?>"> 
																	<input type="hidden" name="state" value="<? echo $state;?>"> 
																	<input type="hidden" name="country" value="<? echo $country;?>"> 
																	<input type="hidden" name="address_cust" value="<? echo stripslashes($address_cust);?>"> 
																	<input type="hidden" name="suburb_cust" value="<? echo stripslashes($suburb_cust);?>"> 
																	<input type="hidden" name="postcode_cust" value="<? echo $postcode_cust;?>"> 
																	<input type="hidden" name="state_cust" value="<? echo $state_cust;?>"> 
																	<input type="hidden" name="country_cust" value="<? echo $country_cust;?>"> 
																	<input type="hidden" name="emailadd" value="<? echo $emailadd;?>"> 
																	<input type="hidden" name="homephone" value="<? echo $homephone;?>"> 
																	<input type="hidden" name="workphone" value="<? echo $workphone;?>"> 
																	<input type="hidden" name="mobilephone" value="<? echo $mobilephone;?>"> 
																	<input type="hidden" name="referral" value="<? echo $referral;?>"> 
																	<input type="hidden" name="referralcode" value="<? echo $referralcode;?>">
																	<input type="hidden" name="hear_about" value="<? echo stripslashes($hear_about);?>"> 
																	<input type="hidden" name="specialreqs" value="<? echo stripslashes($specialreqs);?>"> 
																	<input type="hidden" name="paymentmeth" value="<? echo $paymentmeth;?>"> 
																	<input type="hidden" name="payment" value="<? echo $payment;?>">
																	<input type="hidden" name="vouchercode" value="<?=$_SESSION['vouchercode']?>">
																	<input type="hidden" name="voucher_amount" value="<?=$voucher_usage_raw?>">
																</form> 
																<tr> 
																	<td width="200px" align="right"><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td ><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																</tr> 
																<!--
																<tr> 
																	<td align="right" class="maintext"><strong>Ordered from:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"> 
																		<?
																			if($oseas==0){
																				echo "Australia";
																			}else{
																				echo "Overseas";
																			}
																		?>
																	</td> 
																</tr> 
																-->
																<tr> 
																	<td align="right" class="maintext"><strong>First Name:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($firstname)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Surname:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($surname)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Email Address:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $emailadd?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Home Phone:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $homephone?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Work Phone:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $workphone?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Mobile Phone:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $mobilephone?></td> 
																</tr> 
																<tr><td colspan="3">&nbsp;</td></tr>
																<tr> 
																	<td align="right" class="maintext"><strong>Postal Address:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($address_cust)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Suburb / Town / City:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($suburb_cust)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Postcode:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $postcode_cust?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>State:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $state_cust?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Country:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $country_cust?></td> 
																</tr> 
																<tr><td colspan="3">&nbsp;</td></tr>
																<tr> 
																	<td align="right" class="maintext"><strong>Delivery Name:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($del_name)?></td> 
																</tr> 
																<tr><td colspan="3">&nbsp;</td></tr>
																<tr> 
																	<td align="right" class="maintext"><strong>Delivery Address:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($address)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Suburb / Town / City:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($suburb)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Postcode:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $postcode?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>State:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $state?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Country:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $country?></td> 
																</tr>
																<tr><td colspan="3">&nbsp;</td></tr>
																
																<tr> 
																	<td valign="top" align="right" class="maintext"><strong>How you heard<br> 
																		about us:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($hear_about)?></td> 
																</tr> 
																<tr> 
																	<td valign="top" align="right" class="maintext"><strong>Special requirements:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($specialreqs)?></td> 
																</tr> 
																<? if($_COOKIE["currency"]==1){?>
																<tr> 
																	<td valign="top" align="right" class="maintext"><strong>Referral:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $referral;?></td> 
																</tr> 
																<? }?>
																<? if($referralcode!=""){ ?> 
																<tr> 
																	<td align="right" class="maintext"><strong>Referral Code:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $referralcode?></td> 
																</tr> 
																<? }?>

<?

	if($usevoucher)
	{
		$bits = split(",", $_SESSION['vouchercode']);
		$cleanvoucher = "{$bits[0]}-{$bits[1]}-{$bits[2]}-{$bits[3]}";
		?>
		<tr>
																	<td align="right" class="maintext"><strong>Gift Voucher Code:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"> <?=$cleanvoucher?></td>
		</tr>
		<tr> 
																	<td align="right" class="maintext"><strong>Voucher Debit:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><?=$currencies[$_COOKIE['currency']]['currency']?><?=sprintf("%01.2f", $voucher_usage)?></td> 
		</tr> 
		<tr> 
																	<td align="right" class="maintext"><strong>Voucher Balance:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"><?=$currencies[$_COOKIE['currency']]['currency']?><?=sprintf("%01.2f", $voucher_balance)?></td> 
		</tr> 
		<?
	}

?>



																<tr> 
																	<td align="right" class="maintext" valign=top><strong>Method of Payment:</strong></td> 
																	<td><img src="images/gen/spacer.gif" width="1" height="1"></td> 
																	<td class="maintext"> 
																		<?
																		  if($paymentmeth==1){
																			echo "Credit Card";
																		  }else if($paymentmeth==2){
																			echo "Cheque / Money Order";
																		  }else if($paymentmeth==3){
																			echo "Phone Order";
																		  }else if($paymentmeth==4){
																			echo "I will pay directly into Identikids bank account";
																		  }else if($paymentmeth==5){
																			echo "Will phone c/card by next working day";
																		  } 
																			else if($paymentmeth==6){
																			echo "I will pay with a Gift Voucher";
																			}
																		  ?> 
																	</td> 
																</tr>
																<tr> 
																	<td><img src="images/gen/spacer.gif" width="1" height="10"></td> 
																</tr> 
																<tr> 
																	<td colspan="3" align="center"><a href="javascript: document.forms['backform'].submit();" ><img src="images/nav/n_change_your_details.gif" name="back" width="133" height="22" border="0"></a></td> 
																</tr> 
															</table> 
													<table width="890" border="0" cellspacing="0" cellpadding="0"> 
													</tr> 
													<tr> 
														<td><img src="images/gen/spacer.gif" width="1" height="10"></td> 
													</tr> 
													<tr> 
														<td colspan="3" class="headings">&nbsp;Your items:</td> 
													</tr> 
													<tr> 
														<td><img src="images/gen/spacer.gif" width="1" height="10"></td> 
													</tr> 
													<tr> 
														<td colspan="3" align="center" > 
															<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
																<?
																$secure=true;
																viewOrder($id, "confirmation"); ?> 
															</table> 
														</td> 
													</tr> 
													<tr> 
														<td>&nbsp;</td> 
														<td>&nbsp;</td> 
														<td>&nbsp;</td> 
													</tr> 
													<? 
$getFreeGift = false; // removed at identikids request 28.01.2005
if($totalprice>=$cur['freeGift'] && $getFreeGift){ ?> 
													<td colspan="3"> 
															<table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext"> 
																<tr> 
																	<td>&nbsp;</td> 
																	<td width="36%"><img src="images/image_gift_box.gif" width="140" height="149"></td> 
																	<td width="2%"><img src="images/gen/spacer.gif" width="20" height="10"></td> 
																	<td colspan="3" valign="top"><strong>FREE GIFT<br> 
																		<br> 
																		Congratulations!</strong> Your order is over <? echo $cur['symbol'].$cur['freeGift'];?> which means you qualify for a <strong>free gift box!</strong></td> 
																</tr> 
																<tr> 
																	<td height="10" colspan="6"> 
																		<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
																			<tr> 
																				<td width="5%" rowspan="3"><img src="images/gen/spacer.gif" width="25" height="10"></td> 
																				<td width="95%"><img src="images/gen/spacer.gif" width="10" height="20"></td> 
																			</tr> 
																			<tr> 
																				<td> 
																					<div align="center"><img src="images/seperator_grey_line.gif" width="100%" height="1"></div> 
																				</td> 
																			</tr> 
																			<tr> 
																				<td><img src="images/gen/spacer.gif" width="10" height="20"></td> 
																			</tr> 
																		</table> 
																	</td> 
																</tr> 
															</table> 
														</td> 
													</tr> <?
 }
//														if($local==true){
															$url = "my_order.php";
//														}else{
//															$url = "http://www.identikid.com.au/my_order.php";
//														} 
?> 
													<tr> 
														<td colspan="3" align="center"><a href="<? echo $url;?>" ><img src="images/nav/n_change_ordered_items.gif" name="change" width="133" height="22" border="0"></a></td> 
													</tr> 
													<tr> 
														<td><img src="images/gen/spacer.gif" width="1" height="20"></td> 
													</tr> 
													<?





													if($id!=false && $itemnums!=0){ ?> 
													<tr class="maintext"> 
														<td height="10" colspan="6"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="6%"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td colspan="3" >Order Subtotal (<? echo $cur['symbol'];?>) 
                                    :</td>
                                  <td width="3%"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td width="18%"> <div align="right"><strong><? echo $cur['symbol'].sprintf("%01.2f", $totalprice);?><img src="images/gen/spacer.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <tr> 
                                  <td colspan="6"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3" class="maintext"><? echo $_POST["postageamount"];?></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td colspan="3" class="maintext">
                                    Postage &amp; Handling (<? echo $cur['symbol'];?>):<BR />Postage method : <?=$postage_option?>
                                  </td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td class="maintext"> <div align="right"><strong><? echo $cur['symbol'].sprintf("%01.2f", $postage);?><img src="images/gen/spacer.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <?

$totalprice = $totalprice + $postage;

// reget voucher details, prices after cart has shown
list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);



if($usevoucher)
{


	?>
                                <tr> 
                                  <td colspan="6"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td colspan="3">Voucher Debit (<? echo $cur['symbol'];?>) 
                                    :</td>
                                  <td><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td> <div align="right" nowrap><strong>-<? echo $cur['symbol'].sprintf("%01.2f", $voucher_usage);?><img src="images/gen/spacer.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <?
}

?>
                                <tr> 
                                  <td colspan="6"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="middle"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td height="30" colspan="3" valign="middle" background="images/bg_grey.gif" bgcolor="#CCCCCC"> 
                                    <div align="right"><strong>TOTAL :</strong></div></td>
                                  <td height="30" background="images/bg_grey.gif" bgcolor="#CCCCCC"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td height="30" background="images/bg_grey.gif" bgcolor="#CCCCCC"> 
                                    <div align="right"><strong><? echo $cur['symbol'].sprintf("%01.2f", $totalprice);?><img src="images/gen/spacer.gif" width="10" height="10"></strong></div></td>
                                </tr>
                              </table> 
														</td> 
													</tr> 
													<? }
													
													if($_COOKIE["currency"]==1){?> 
													<tr> 
														<td colspan="3"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="6%" rowspan="3" valign="top" class="maintext"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td width="94%" valign="top" class="maintext"><br />Notes:</td>
                                </tr>
                                <tr> 
									<td valign="top" class="maintext">
									<?php include("_user_pages/upsell.php"); ?>
									</td>
                                </tr>
                              </table> 
														</td> 
													</tr> 
													<? }?>

													<tr> 
														
                            <td colspan="3" align="right"><table width="75%" border="0" cellpadding="0" cellspacing="0">
<tr>
                                  <td><div align="center"><a href="javascript:print()"><img src="images/print_page.gif" width="79" height="70" border="0"></a></div></td>
                                  <td width="20">&nbsp;</td>
                                  <td><a href="javascript: document.forms['confform'].submit();" ><img src="images/nav/n_finalise_payment.gif" name="finalisepayment"  height="22" border="0"></a></td>
                                </tr>
                              </table>
                              
                            </td> 
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
<?php include "footer.php" ?> 