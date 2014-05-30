<?
session_start();

if ($_COOKIE['currency']==1) //Australia
{
		//$postage = $_GET["postageamount"];
		//$postage_option = $_GET["postageoption"];
		$postage_option = $_SESSION["post_option"];		
		$postage = $_SESSION["postageamount"]; 
}

include("useractions.php");
include("vieworderlist.php");

if($_POST["orderid"]){
	$id = $_POST["orderid"];
}else if($_GET["orderid"]){
	$id = $_GET["orderid"];
}else{
	$id = checkOrderId(false);
}

linkme();
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);
if ($_COOKIE['currency']!=1) //Australia
{
	$postage = $cur['postage'];
}

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




//print_r($_SESSION);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - View Order</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_check_out_mo.gif','images/button_finalisepayment_mo.gif')">
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
							<tr valign="top"> 
								<td colspan="3"> 
									<table width="418" border="0" cellspacing="0" cellpadding="0"> 
										<tr valign="top"> 
											<td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
										</tr> 
										<tr valign="top"> 
											<td bgcolor="6FFF6F"> 
												<div align="right"><img src="images/heading_view_order.gif" alt="View Order" width="167" height="45"></div> 
											</td> 
											<td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td> 
										</tr> 
										<tr valign="top"> 
											<td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
										</tr> 
									</table> 
								</td> 
							</tr> 
							<tr valign="top" bgcolor="#66FF66"> 
								<td colspan="3" bgcolor="#6FFF6F"> 
									<table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF"> 
										<tr> 
											<td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
											<td width="393" valign="top" bgcolor="#FFFFFF"> 
												<table width="393" border="0" cellspacing="0" cellpadding="0"> 
													<tr> 
														<td colspan="3">&nbsp;</td> 
													</tr> 
													<? if($_GET["approved"]==0 && $_GET["approved"]){?> 
													<tr> 
														<td colspan="3"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
																<tr> 
																	<td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td> 
																	<td width="96%" class="maintext"> 
																		<p><strong>Transaction Declined</strong></p> 
																		Unfortunately your credit card transaction has been declined. To try again please click "Check Out" at the bottom of the page. </td> 
																</tr> 
																<tr> 
																	<td><img src="images/spacer_trans.gif" width="1" height="5"></td> 
																</tr> 
															</table> 
														</td> 
													</tr> 
													<? }?> 
													<tr> 
														<td colspan="3"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%" rowspan="2"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" valign="top" class="maintext">
<p>Below 
                                      are details of your order.<a href="javascript: " onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('finalisepayment1','','images/button_finalisepayment_mo.gif',1)"><img src="images/spacer_trans.gif" width="1" height="30" border="0"></a></p>
                                    </td>
                                  <td width="48%" valign="top" class="maintext"><div align="right"><a href="javascript: document.forms['confform'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('finalisepayment1','','images/button_finalisepayment_mo.gif',1)"><img src="images/button_finalisepayment.gif" name="finalisepayment1" height="22" border="0" id="checkout1"></a></div></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" class="maintext">You can make 
                                    changes if needed, then click <strong>Finalise Payment </strong> when you are ready to proceed.</td>
                                </tr>
                                <tr> 
                                  <td><img src="images/spacer_trans.gif" width="1" height="5"></td>
                                </tr>
                                <tr> 
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" colspan="2" class="maintext"> 
                                    <p>This page is printable</p></td>
                                </tr>
                                <tr> 
                                  <td><img src="images/spacer_trans.gif" width="1" height="5"></td>
                                </tr>
                              </table> 
														</td> 
													</tr> 
													<tr> 
														<td><img src="images/spacer_trans.gif" width="1" height="10"></td> 
													</tr> 
													<tr> 
														<td colspan="3"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
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
																	<input type="hidden" name="surname" value="<? echo $surname;?>"> 
																	<input type="hidden" name="address" value="<? echo stripslashes($address);?>"> 
																	<input type="hidden" name="suburb" value="<? echo $suburb;?>"> 
																	<input type="hidden" name="postcode" value="<? echo $postcode;?>"> 
																	<input type="hidden" name="state" value="<? echo $state;?>"> 
																	<input type="hidden" name="country" value="<? echo $country;?>"> 
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
																	<td width="46%" align="right"><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td width="8%"><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td width="46%"><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																</tr> 
																<!--
																<tr> 
																	<td align="right" class="maintext"><strong>Ordered from:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
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
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($firstname)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Surname:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($surname)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Postal Address:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($address)?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Suburb / Town / City:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $suburb?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Postcode:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $postcode?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>State:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $state?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Country:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $country?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Email Address:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $emailadd?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Home Phone:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $homephone?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Work Phone:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $workphone?></td> 
																</tr> 
																<tr> 
																	<td align="right" class="maintext"><strong>Mobile Phone:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $mobilephone?></td> 
																</tr> 
																<tr> 
																	<td valign="top" align="right" class="maintext"><strong>How you heard<br> 
																		about us:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($hear_about)?></td> 
																</tr> 
																<tr> 
																	<td valign="top" align="right" class="maintext"><strong>Special requirements:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo stripslashes($specialreqs)?></td> 
																</tr> 
																<? if($_COOKIE["currency"]==1){?>
																<tr> 
																	<td valign="top" align="right" class="maintext"><strong>Referral:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><? echo $referral;?></td> 
																</tr> 
																<? }?>
																<? if($referralcode!=""){ ?> 
																<tr> 
																	<td align="right" class="maintext"><strong>Referral Code:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
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
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"> <?=$cleanvoucher?></td>
		</tr>
		<tr> 
																	<td align="right" class="maintext"><strong>Voucher Debit:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><?=$currencies[$_COOKIE['currency']]['currency']?><?=sprintf("%01.2f", $voucher_usage)?></td> 
		</tr> 
		<tr> 
																	<td align="right" class="maintext"><strong>Voucher Balance:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
																	<td class="maintext"><?=$currencies[$_COOKIE['currency']]['currency']?><?=sprintf("%01.2f", $voucher_balance)?></td> 
		</tr> 
		<?
	}

?>



																<tr> 
																	<td align="right" class="maintext" valign=top><strong>Method of Payment:</strong></td> 
																	<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
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
																	<td><img src="images/spacer_trans.gif" width="1" height="10"></td> 
																</tr> 
																<tr> 
																	<td colspan="3" align="right"><a href="javascript: document.forms['backform'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_change_details_mo.gif',1)"><img src="images/button_change_details.gif" name="back" width="135" height="22" border="0"></a></td> 
																</tr> 
															</table> 
														</td> 
													</tr> 
													<tr> 
														<td><img src="images/spacer_trans.gif" width="1" height="10"></td> 
													</tr> 
													<tr> 
														<td colspan="3" class="headings">&nbsp;Your items:</td> 
													</tr> 
													<tr> 
														<td><img src="images/spacer_trans.gif" width="1" height="10"></td> 
													</tr> 
													<tr> 
														<td colspan="3"> 
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
																	<td width="2%"><img src="images/spacer_trans.gif" width="20" height="10"></td> 
																	<td colspan="3" valign="top"><strong>FREE GIFT<br> 
																		<br> 
																		Congratulations!</strong> Your order is over <? echo $cur['symbol'].$cur['freeGift'];?> which means you qualify for a <strong>free gift box!</strong></td> 
																</tr> 
																<tr> 
																	<td height="10" colspan="6"> 
																		<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
																			<tr> 
																				<td width="5%" rowspan="3"><img src="images/spacer_trans.gif" width="25" height="10"></td> 
																				<td width="95%"><img src="images/spacer_trans.gif" width="10" height="20"></td> 
																			</tr> 
																			<tr> 
																				<td> 
																					<div align="center"><img src="images/seperator_grey_line.gif" width="100%" height="1"></div> 
																				</td> 
																			</tr> 
																			<tr> 
																				<td><img src="images/spacer_trans.gif" width="10" height="20"></td> 
																			</tr> 
																		</table> 
																	</td> 
																</tr> 
															</table> 
														</td> 
													</tr> <?
 }
//														if($local==true){
															$url = "view_order.php";
//														}else{
//															$url = "http://www.identikid.com.au/view_order.php";
//														} 
?> 
													<tr> 
														<td colspan="3" align="right"><a href="<? echo $url;?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('change','','images/button_change_items_mo.gif',1)"><img src="images/button_change_items.gif" name="change" width="154" height="22" border="0"></a></td> 
													</tr> 
													<tr> 
														<td><img src="images/spacer_trans.gif" width="1" height="20"></td> 
													</tr> 
													<?





													if($id!=false && $itemnums!=0){ ?> 
													<tr class="maintext"> 
														<td height="10" colspan="6"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="6%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td colspan="3" >Order Subtotal (<? echo $cur['symbol'];?>) 
                                    :</td>
                                  <td width="3%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="18%"> <div align="right"><strong><? echo $cur['symbol'].sprintf("%01.2f", $totalprice);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <tr> 
                                  <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3" class="maintext"><? echo $_POST["postageamount"];?></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td colspan="3" class="maintext">Postage &amp; Handling (<? echo $cur['symbol'];?>) 
                                    :
                                    <? if($_COOKIE['currency']==1) 
																																			{ echo "<BR />Postage method : ".$postage_option;} ?>
                                  </td>
                                  <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td class="maintext"> <div align="right"><strong><? echo $cur['symbol'].sprintf("%01.2f", $postage);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <?

$totalprice = $totalprice + $postage;

// reget voucher details, prices after cart has shown
list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $totalprice) = getVoucherDetails($totalprice, $_SESSION['vouchercode'], false, $_COOKIE['currency']);



if($usevoucher)
{


	?>
                                <tr> 
                                  <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td colspan="3">Voucher Debit (<? echo $cur['symbol'];?>) 
                                    :</td>
                                  <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td> <div align="right" nowrap><strong>-<? echo $cur['symbol'].sprintf("%01.2f", $voucher_usage);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <?
}

?>
                                <tr> 
                                  <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="middle"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td height="30" colspan="3" valign="middle" background="images/bg_grey.gif" bgcolor="#CCCCCC"> 
                                    <div align="right"><strong>TOTAL :</strong></div></td>
                                  <td height="30" background="images/bg_grey.gif" bgcolor="#CCCCCC"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td height="30" background="images/bg_grey.gif" bgcolor="#CCCCCC"> 
                                    <div align="right"><strong><? echo $cur['symbol'].sprintf("%01.2f", $totalprice);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
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
                                  <td width="6%" rowspan="3" valign="top" class="maintext"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="94%" valign="top" class="maintext">Notes:</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext"><p>Postage 
                                      &amp; Handling is free within Australia.<br>
                                      All regular orders will be dispatched within 
                                      5 business days from date of payment received. 
                                      Business days M-F<br>
                                      <br>
                                      Overseas orders dispatched via Overseas 
                                      express envelope within 5 business days. 
                                      Transit time around 2 weeks</p>
                                    <p>Express orders dispatched within 48 business 
                                      hours 9-5 Mon-Fri from NSW by Startrack 
                                      express service<br>
                                      (in transit 1-2 days with courier) from 
                                      date of payment received. Allow 3-4 days 
                                      for delivery</p></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext">&nbsp;</td>
                                  <td valign="top" class="maintext">Any order 
                                    not paid within 10 days will be destroyed. 
                                  </td>
                                </tr>
                              </table> 
														</td> 
													</tr> 
													<? }?>
													<tr> 
														<td>&nbsp;</td> 
														<td>&nbsp;</td> 
														<td>&nbsp;</td> 
													</tr> 
<?

// if no identitags are in the order, display identitags data.

//if($identitags_in_order == FALSE)
if($identibands_in_order == FALSE)
{

	?>
	<tr>
		<td width="6%" valign="top" class="maintext"><img src="images/spacer_trans.gif" width="25" height="10"></td> 
		<td colspan="2"><table width=100%>
			<tr>
				<!--<td colspan="2" align="center"><img src="images/wait.gif"></td>-->
				<td colspan="2" align="center"><img src="images/wait_wristbands.gif"></td>
			</tr>
			<tr>
				<td class="maintext"><p><!--Make Schoolbags easy to find by placing one of these.--></p>
					<p><a href="products_identibands.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image29','','images/button_more_info_mo.gif',1)"><img src="images/button_more_info.gif" alt="More Information" name="Image29" width="94" height="22" border="0"></a>
						<a href="order_identibands.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image30','','images/button_add_order_mo.gif',1)"><img src="images/button_add_order.gif" alt="Add to Order" name="Image30" width="94" height="22" border="0"></a></p>
				</td>
				<!--<td><img src="images/backpack.gif" hspace="20"></td>-->
				<td><img src="images/wristbands.gif" hspace="20"></td>
			</tr>
			</table>

		</td>
	</tr>
	<tr> 
		<td>&nbsp;</td> 
		<td>&nbsp;</td> 
		<td>&nbsp;</td> 
	</tr> 
	<?

}


?>
													<tr> 
														
                            <td colspan="3" align="right"><table width="75%" border="0" cellpadding="0" cellspacing="0">
<tr>
                                  <td><div align="center"><a href="javascript:print()"><img src="images/print_page.gif" width="79" height="70" border="0"></a></div></td>
                                  <td width="20">&nbsp;</td>
                                  <td><a href="javascript: document.forms['confform'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('finalisepayment','','images/button_finalisepayment_mo.gif',1)"><img src="images/button_finalisepayment.gif" name="finalisepayment"  height="22" border="0"></a></td>
                                </tr>
                              </table>
                              
                            </td> 
													</tr> 
												</table> 
											</td> 
											<td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="15" height="10"></td> 
										</tr> 
										<tr valign="top" bgcolor="#FFFFFF"> 
											<td><img src="images/spacer_trans.gif" width="10" height="10"></td> 
										</tr> 
										<tr> 
											<td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td> 
										</tr> 
										<tr bgcolor="#6FFF6F"> 
											<td colspan="3" valign="top"><br> 
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
							<tr> 
								<td> 
									<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
										<tr> 
											<td valign="top" bgcolor="#FF0099" class="smalltext"> 
												<?php
					   include "navigation.php"; ?> 
												<!--<strong><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/products_home.php" class="type2">View 
                        Products</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/order_online.php" class="type2">Order 
                        Online</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/view_order.php" class="type2">View 
                        Order</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/fundraising.php" class="type2">Fundraisers 
                        </a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/about_us.php" class="type2">About 
                        Us</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/contact_us.php" class="type2">Contact 
                        Us</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/send_friend.php" class="type2">Send 
                        to a Friend</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/testimonials.php" class="type2">Testimonials</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/links.php" class="type2">Links</a><br>
                        <img src="images/spacer_trans.gif" width="20" height="8"><a href="http://www.identikid.com.au/" class="type2">Home</a> 
                        <br>
                        <br>
                        </strong>
						--> 
											</td> 
										</tr> 
									</table> 
								</td> 
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
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
<? 

// we're done - delete the sess id from the order.
//deleteOrderId($id);

?>
