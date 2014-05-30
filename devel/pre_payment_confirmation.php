<?
session_start();
include("useractions.php");
include("vieworderlist.php");
$id = checkOrderId(false);

if($id==false){
	header("location:products_home.php");
	exit;
}

linkme();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - View Order</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif')">
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
            </table></td>
          <td width="418" valign="top" bgcolor="#6FFF6F"> 
            <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304" bgcolor="5d7eb9"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="418" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_view_order.gif" alt="View Order" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
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
                          <tr> 
                            <td colspan="3">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p>Please confirm the details of your order below</p></td>
                                </tr>
								<tr>
								  <td><img src="images/spacer_trans.gif" width="1" height="5"></td>
								</tr>
								<tr>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p>This page is printable</p></td>
                                </tr>
								<tr> 
								  <td><img src="images/spacer_trans.gif" width="1" height="5"></td>
								</tr>
                              </table></td>
                          </tr>
						<tr> 
						  <td><img src="images/spacer_trans.gif" width="1" height="10"></td>
						</tr>
						  <tr> 
                            <td colspan="3">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<? for($i=0; $i<2; $i++){
									if($i==0){
										?><form name="backform" method="post" action="order_form_strans_test.php"><?
									}else{
										?><form name="confform" method="post" action="to_payment.php"><?
									}?>
									<input type="hidden" name="oseas" value="<? echo $_POST["oseas"];?>">
									<input type="hidden" name="firstname" value="<? echo $_POST["firstname"];?>">
									<input type="hidden" name="surname" value="<? echo $_POST["surname"];?>">
									<input type="hidden" name="address" value="<? echo $_POST["address"];?>">
									<input type="hidden" name="suburb" value="<? echo $_POST["suburb"];?>">
									<input type="hidden" name="postcode" value="<? echo $_POST["postcode"];?>">
									<input type="hidden" name="state" value="<? echo $_POST["state"];?>">
									<input type="hidden" name="emailadd" value="<? echo $_POST["emailadd"];?>">
									<input type="hidden" name="homephone" value="<? echo $_POST["homephone"];?>">
									<input type="hidden" name="workphone" value="<? echo $_POST["workphone"];?>">
									<input type="hidden" name="mobilephone" value="<? echo $_POST["mobilephone"];?>">
									<input type="hidden" name="referral" value="<? echo $_POST["referral"];?>">
									<input type="hidden" name="centreCode" value="<? echo $_POST["centreCode"];?>">
									<input type="hidden" name="shopCode" value="<? echo $_POST["shopCode"];?>">
									<input type="hidden" name="hear_about" value="<? echo $_POST["hear_about"];?>">
									<input type="hidden" name="specialreqs" value="<? echo stripslashes($_POST["specialreqs"]);?>">
									<input type="hidden" name="paymentmeth" value="<? echo $_POST["paymentmeth"];?>">
								</form>
								<? }?>
                                <tr>
                                  <td width="46%" align="right"><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td width="8%"><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td width="46%"><img src="images/spacer_trans.gif" width="1" height="1"></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Ordered from:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><?
								  if($_POST["oseas"]==0){
								   	echo "Australia";
								  }else{
								  	echo "Overseas";
								  }
								  ?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>First Name:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["firstname"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Surname:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["surname"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Postal Address:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["address"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Suburb / Town / City:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["suburb"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Postcode:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["postcode"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>State:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["state"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Email Address:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["emailadd"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Home Phone:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["homephone"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Work Phone:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["workphone"]?></td>
                                </tr>
								<tr>
                                  <td align="right" class="maintext"><strong>Mobile Phone:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["mobilephone"]?></td>
                                </tr>
								<tr>
                                  <td valign="top" align="right" class="maintext"><strong>How you heard<br>about us:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["hear_about"]?></td>
                                </tr>
								<tr>
                                  <td valign="top" align="right" class="maintext"><strong>Special requirements:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["specialreqs"]?></td>
                                </tr>
								<tr>
                                  <td valign="top" align="right" class="maintext"><strong>Referral:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["referral"]?></td>
                                </tr>
								<?
								if($_POST["centreCode"]!=""){
								?>
								<tr>
                                  <td align="right" class="maintext"><strong>Kindy/Day Care Code:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["centreCode"]?></td>
                                </tr>
								<?
								}
								if($_POST["shopCode"]!=""){
								?>
								<tr>
                                  <td align="right" class="maintext"><strong>Shop/Agent Code:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext"><? echo $_POST["shopCode"]?></td>
                                </tr>
								<?
								}?>
								<tr>
                                  <td align="right" class="maintext"><strong>Method of Payment:</strong></td>
								  <td><img src="images/spacer_trans.gif" width="1" height="1"></td>
								  <td class="maintext">
								  <?
								  if($_POST["paymentmeth"]==1){
								  	echo "Credit Card";
								  }else if($_POST["paymentmeth"]==2){
								  	echo "Cheque / Money Order";
								  }else if($_POST["paymentmeth"]==3){
								  	echo "Phone Order";
								  }
								  ?></td>
                                </tr>
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
                                <?  viewOrder($id, "confirmation"); ?>
                              </table></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
						 
						  <? if($totalprice>=50){ ?>
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
                                    gift box and 2 gift tags!</strong></td>
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
									  <td colspan="3"><strong>Order Subtotal ($AUD) 
										:</strong></td>
									  <td width="3%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
									  <td width="18%"> <div align="right"><strong>$<? echo toDollarsAndCents($totalprice);?><img src="images/spacer_trans.gif" width="10" height="10"></strong></div></td>
									</tr>
									<tr> 
									  <td colspan="6"><img src="images/spacer_trans.gif" width="10" height="10"></td>
									</tr>
									<?
									if($_POST["oseas"]==1){
										$postage = 6;
									}else{
										$postage = 0;
									}
									 ?>
									<tr> 
									  <td><img src="images/spacer_trans.gif" width="25" height="10"></td>
									  <td colspan="3"><strong>Postage &amp; Handling</strong><strong> 
										($AUD) :</strong></td>
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
                                  <td valign="top" class="maintext">Please allow  7 - 10 days for delivery. </td>
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
                    <tr bgcolor="#6FFF6F"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="FF9900"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
						--></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
