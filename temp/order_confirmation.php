<?php
session_start();
include("useractions.php");
include_once("vieworderlist.php");

if($_POST["orderid"]){
	$id = $_POST["orderid"];
}else{
	$id = $_GET["orderid"];
}

if($id==false){
	header("location:products_home.php");
	exit;
}

linkme();

getCustomerDetails($id);
include("header.php");
?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<form name="backform" method="post" action="order_form.php">
									<input type="hidden" name="orderid" value="<? echo $id;?>">
								</form>
								<form name="confform" method="post" action="submitorder.php">
									<input type="hidden" name="submittype" value="confirmed">
									<input type="hidden" name="orderid" value="<? echo $id;?>">
									<input type="hidden" name="oseas" value="<? echo $oseas;?>">
									<input type="hidden" name="firstname" value="<? echo $firstname;?>">
									<input type="hidden" name="surname" value="<? echo $surname;?>">
									<input type="hidden" name="address" value="<? echo $address;?>">
									<input type="hidden" name="suburb" value="<? echo $suburb;?>">
									<input type="hidden" name="postcode" value="<? echo $postcode;?>">
									<input type="hidden" name="state" value="<? echo $state;?>">
									<input type="hidden" name="country" value="<? echo $country;?>">
									<input type="hidden" name="emailadd" value="<? echo $emailadd;?>">
									<input type="hidden" name="homephone" value="<? echo $homephone;?>">
									<input type="hidden" name="workphone" value="<? echo $workphone;?>">
									<input type="hidden" name="mobilephone" value="<? echo $mobilephone;?>">
									<input type="hidden" name="referral" value="<? echo $referral;?>">
									<input type="hidden" name="centreCode" value="<? echo $centreCode;?>">
									<input type="hidden" name="shopCode" value="<? echo $shopCode;?>">
									<input type="hidden" name="hear_about" value="<? echo $hear_about;?>">
									<input type="hidden" name="specialreqs" value="<? echo stripslashes($specialreqs);?>">
									<input type="hidden" name="paymentmeth" value="<? echo $paymentmeth;?>">
									<input type="hidden" name="payment" value="<? echo $payment;?>">
									<input type="hidden" name="nameoncard" value="<? echo $nameoncard;?>">
									<input type="hidden" name="cc1" value="<? echo $cc1;?>">
									<input type="hidden" name="cc2" value="<? echo $cc2;?>">
									<input type="hidden" name="cc3" value="<? echo $cc3;?>">
									<input type="hidden" name="cc4" value="<? echo $cc4;?>">
									<input type="hidden" name="expirymonth" value="<? echo $expirymonth;?>">
									<input type="hidden" name="expiryyear" value="<? echo $expiryyear;?>">
									<input type="hidden" name="seccode" value="<? echo $seccode;?>">
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
                                  <td align="right" class="maintext"><strong>First 
                                    Name:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $firstname?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Surname:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $surname?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Postal 
                                    Address:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $address?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Suburb 
                                    / Town / City:</strong></td>
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
                                  <td align="right" class="maintext"><strong>Email 
                                    Address:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $emailadd?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Home 
                                    Phone:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $homephone?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Work 
                                    Phone:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $workphone?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Mobile 
                                    Phone:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $mobilephone?></td>
                                </tr>
                                <tr> 
                                  <td valign="top" align="right" class="maintext"><strong>How 
                                    you heard<br>
                                    about us:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $hear_about?></td>
                                </tr>
                                <tr> 
                                  <td valign="top" align="right" class="maintext"><strong>Special 
                                    requirements:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $specialreqs?></td>
                                </tr>
								<tr> 
								  <td align="right" class="maintext"><strong>Fundraiser Code:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $referralcode;?></td>
								</tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Method 
                                    of Payment:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"> 
                                    <?
								  if($paymentmeth==1){
								  	echo "Credit Card";
								  }else if($paymentmeth==2){
								  	echo "Cheque / Money Order";
								  }else if($paymentmeth==3){
								  	echo "Phone Order";
								  }
								  ?>
                                  </td>
                                </tr>
                                <?
								if($paymentmeth==1){?>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Payment:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $payment?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Name 
                                    on Card:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $nameoncard?></td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Card 
                                    Number:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $cc1?>-xxxx-xxxx-xxxx</td>
                                </tr>
                                <tr> 
                                  <td align="right" class="maintext"><strong>Expiry 
                                    Date:</strong></td>
                                  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                  <td class="maintext"><? echo $expirymonth."/".$expiryyear?></td>
                                </tr>
                                <?
								}?>
                                <tr> 
                                  <td><img src="images/spacer_trans.gif" width="1" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="3" align="right"><a href="javascript: document.forms['backform'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_change_details_mo.gif',1)"><img src="images/button_change_details.gif" name="back" width="135" height="22" border="0"></a></td>
                                </tr>
                              </table></td>
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
                              </table></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
						 
						  <? 
$getFreeGift = false; // removed at identikids request 28.01.2005
	if($totalprice>=50 && $getFreeGift){ ?>
						   <td colspan="3">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td width="36%"><img src="images/image_gift_box.gif" width="140" height="149"></td>
                                  <td width="2%"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                  <td colspan="3" valign="top"><strong>FREE GIFT<br>
                                    <br>
                                    Congratulations!</strong> Your order is over 
                                    $50AUD which means you qualify for a <strong>free 
                                    gift box!</strong></td>
                                </tr>
                                <tr> 
                                  <td height="10" colspan="6">
								  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="5%" rowspan="3"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                        <td width="95%"><img src="images/spacer_trans.gif" width="10" height="20"></td>
                                      </tr>
                                      <tr> 
                                        <td><div align="center"><img src="images/seperator_grey_line.gif" width="100%" height="1"></div></td>
                                      </tr>
                                      <tr> 
                                        <td><img src="images/spacer_trans.gif" width="10" height="20"></td>
                                      </tr>
                                    </table>
									</td>
                                </tr>
								</table>
								</td>
							</tr>
							 <? }
							if($local==true){
							 	$url = "view_order.php";
							}else{
								$url = "http://www.identikid.com.au/view_order.php";
							}
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
									  
                                  <td colspan="3">Order Subtotal ($AUD) :</td>
									  <td width="3%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
									  <td width="18%"> <div align="right"><strong>$<? echo toDollarsAndCents($totalprice);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
									</tr>
									<tr> 
									  <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
									</tr>
									<?
									if($oseas==1){
										$postage = 10;
									}else{
										$postage = 0;
									}
									 ?>
									<tr> 
									  <td><img src="images/spacer_trans.gif" width="25" height="10"></td>
									  
                                  <td colspan="3">Postage &amp; Handling ($AUD) 
                                    :</td>
									  <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
									  <td><div align="right"><strong>$<? echo toDollarsAndCents($postage);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
									</tr>
									<tr> 
									  <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
									</tr>
									<tr> 
									  <td valign="middle"><img src="images/spacer_trans.gif" width="25" height="10"></td>
									  <td height="30" colspan="3" valign="middle" background="images/bg_grey.gif" bgcolor="#CCCCCC"> 
										<div align="right"><strong>TOTAL :</strong></div></td>
									  <td height="30" background="images/bg_grey.gif" bgcolor="#CCCCCC"><img src="images/spacer_trans.gif" width="10" height="10"></td>
									  <td height="30" background="images/bg_grey.gif" bgcolor="#CCCCCC"> 
										<div align="right"><strong>$<? echo toDollarsAndCents($totalprice+$postage);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
									</tr>
								</table>
							</td>
						  </tr>
						<? }?>
						  
                          <tr> 
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="6%" rowspan="4" valign="top" class="maintext"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="94%" valign="top" class="maintext">Notes:</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext">Postage &amp; 
                                    Handling is free within Australia.<br>
                                    For overseas orders the P&amp;H is $10.00 
                                    AUD</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext">All orders dispatched within 5 working days.
<!-- Please allow  7 - 10 days for delivery. --></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext">All items are mailed using <a href="http://www.australiapost.com.au" target="_blank" class="type1">Australia Post</a>. </td>
                                </tr>
                                <tr>
                                  <td valign="top" class="maintext">&nbsp;</td>
                                  <td valign="top" class="maintext">Any order not paid within 10 days will be destroyed. 
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
						  <tr>
							  <td colspan="3" align="right"><a href="javascript: document.forms['confform'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('checkout','','images/button_check_out_mo.gif',1)"><img src="images/button_check_out.gif" name="checkout" width="94" height="22" border="0"></a></td>
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
                  </table>


<?php include "footer.php" ?>
