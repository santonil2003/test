<?
include_once("../common_constants.php");

if(!isset($useractions)){
	$includeabove = true;
	include("../useractions.php");
	include("../vieworderlist.php");
}

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);


$id = checkOrderId(false);
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';


//Update price
$newprice = $_POST["upd_price"];
settype ( $newprice , "float" );

if ($_POST["upd_reason"] == "")
{
	$_POST["upd_reason"] = "none";
}

if($_POST["upd_price"] != ""){
	$upquery = "INSERT INTO basket_items (ordernumber, price,text1, quantdesc, type)"
	." VALUES (".$_POST["orderid"].", ".$newprice.", '".$_POST["upd_reason"]."', 'Additional amount', '666')";
	mysql_query($upquery) or die ("error updating price ".mysql_error());
}

if (isset($_GET["msg"])){
	$sql_temp_customer_details = "SELECT * FROM temp WHERE temp.orderid = " . $id;
	$result_temp_customer_details = mysql_query($sql_temp_customer_details);
	if(!$result_temp_customer_details) error_message("line 25".sql_error());


/*
Shaun 27/1/2005
changed: 	if(mysql_num_rows($result_temp_customer_details) > 1){
to     : 	if(mysql_num_rows($result_temp_customer_details) == 1){
reason : id's should be unique, and thus will only be 1 of them.

*/
	if(mysql_num_rows($result_temp_customer_details) == 1){
		$rs_temp_customer_details = mysql_fetch_assoc($result_temp_customer_details);
		$orderid = $rs_temp_customer_details["orderid"];
		$submittype = $rs_temp_customer_details["submittype"];
		$firstname = $rs_temp_customer_details["firstname"];
		$surname = $rs_temp_customer_details["surname"];
		$address = $rs_temp_customer_details["address"];
		$suburb = $rs_temp_customer_details["suburb"];
		$postcode = $rs_temp_customer_details["postcode"];
		$state = $rs_temp_customer_details["state"];
		$country = $rs_temp_customer_details["country"];
		$emailadd = $rs_temp_customer_details["emailadd"];
		$homephone = $rs_temp_customer_details["homephone"];
		$workphone = $rs_temp_customer_details["workphone"];
		$mobilephone = $rs_temp_customer_details["mobilephone"];
		$referralcode = $rs_temp_customer_details["referralcode"];
		$hear_about = $rs_temp_customer_details["hear_about"];
		$specialreqs = $rs_temp_customer_details["specialreqs"];
		$postageopt = $rs_temp_customer_details["postage_option"]; 
		$paymentmeth = $rs_temp_customer_details["paymentmeth"];
		$vouchercode = $rs_temp_customer_details["vouchercode"];
		$total = $rs_temp_customer_details["total"];
		$postage = $rs_temp_customer_details["postage"];
		$grand = $rs_temp_customer_details["grand"];
		$voucher_amount = $rs_temp_customer_details["voucher_amount"];
		//$sql_temp_customer_details = "DELETE FROM temp WHERE temp.orderid = " . $id;
		//mysql_query($sql_temp_customer_details);
	}
}else if (isset($_POST["orderid"])){
		$orderid = $_POST["orderid"];
		$submittype = $_POST["submittype"];
		$firstname = $_POST["firstname"];
		$surname = $_POST["surname"];
		$address = $_POST["address"];
		$suburb = $_POST["suburb"];
		$postcode = $_POST["postcode"];
		$state = $_POST["state"];
		$country = $_POST["country"];
		$emailadd = $_POST["emailadd"];
		$homephone = $_POST["homephone"];
		$workphone = $_POST["workphone"];
		$mobilephone = $_POST["mobilephone"];
		$referralcode = $_POST["referralcode"];
		$hear_about = $_POST["hear_about"];
		$specialreqs = $_POST["specialreqs"];
		$postageopt = $_POST["postageoption"];
		if ($_POST["postageoption"]=="")
		{
			$postageopt = "Normal";
		}
		$paymentmeth = $_POST["paymentmeth"];
		$vouchercode = $_POST["vouchercode"];
		$total = $_POST["total"];
		$postage = $_POST["postage"];
		$grand = $_POST["grand"];
		$voucher_amount = $_POST['voucheramount'];
}

if (($paymentmeth == 5) && (isset($orderid))){
	if ($vouchercode){
		$vouchercode_array = split(",", $vouchercode);
		//$valid_vouchers_found = false;
		$sql = "SELECT * FROM voucher WHERE voucher.expiry_date >= '" . date("Y-m-d") . "' AND voucher.balance > 0 AND voucher.number = '" . $vouchercode_array[0] . $vouchercode_array[1] . $vouchercode_array[2] . $vouchercode_array[3] . "'";
		//echo $sql . '<br>';
		$sql_result = mysql_query($sql);
		if(!$sql_result) error_message("line 95".sql_error());
		if(mysql_num_rows($sql_result) == 1){
			$sql_result_rs = mysql_fetch_assoc($sql_result);
			$valid_vouchers_found = true;
		}else{
			$valid_vouchers_found = false;
			//$sql_result_rs = mysql_fetch_assoc($sql_result);
			//if ($sql_result_rs["id"] > 0){
				//$valid_vouchers_found = true;
			//}
		}
	}
}

$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
$result = mysql_query($query);
if(!$result) error_message("line 111".sql_error());
if(mysql_num_rows($result)>0){
	while($qdata = mysql_fetch_array($result)){
		$totalprice += $qdata["price"];
	}
}

//echo $valid_vouchers_found . '<br>';
//echo $totalprice . '<br>';
//echo $sql_result_rs["balance"] . '<br>';
//echo $totalprice - $sql_result_rs["balance"] . '<br>';

//if ((isset($valid_vouchers_found)) && ($valid_vouchers_found)){
//	if (($totalprice - $sql_result_rs["balance"]) >= 0){
		//$totalprice -= $sql_result_rs["balance"];
//	}else if (($totalprice - $sql_result_rs["balance"]) < 0){
//		$totalprice = 0;
//	}
//}
if (!isset($_COOKIE["currency"]))
{
 $_COOKIE["currency"] = 1;
}
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message("line 133".sql_error());

$cur = mysql_fetch_assoc($result);

//echo '<pre>';
//print_r($_POST);
//echo '<pre>';
	if ($postageopt != 'Normal' && $postageopt !="")
	{
		$sql = "SELECT expresspost FROM currencies WHERE id = 1";
		$result = mysql_query($sql)or die ("SQL ERROR");
		$row = mysql_fetch_assoc($result);
		$postage = $row["expresspost"]; 
	}
	else
	{
 		$postage = $cur['postage'];
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Add phone order - confirm details</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"> 
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%"> 
<tr> 
<td valign="top" align="center"> 
<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9"> 
	<tr> 
		<td colspan="3" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td> 
	</tr> 
	<tr> 
		<td><img src="../images/spacer_trans.gif" height="1" width="30" border="0"></td> 
		<td><img src="../images/spacer_trans.gif" height="1" width="540" border="0"></td> 
		<td><img src="../images/spacer_trans.gif" height="1" width="30" border="0"></td> 
	</tr> 
	<tr> 
		<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td> 
		<td align="left"> 
	 		<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <!-- <form name="backform" method="post" action="order_form_ps.php"> -->
            <form name="backform" method="post" action="addphoneorder_customerdetails.php">
              <input type="hidden" name="orderid" value="<? echo $id;?>">
            </form>
            <form name="confform" method="post" action="addphoneorder_submitorder_ps.php">
              <input type="hidden" name="submittype" value="confirmed">
              <input type="hidden" name="orderid" value="<? echo $orderid;?>">
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
              <input type="hidden" name="referralcode" value="<? echo $referralcode;?>">
              <input type="hidden" name="hear_about" value="<? echo $hear_about;?>">
              <input type="hidden" name="specialreqs" value="<? echo $specialreqs;?>">
			  <input type="hidden" name="postage" value="<? echo $postage;?>">
			  <input type="hidden" name="postageoption" value="<? echo $postageopt;?>">
              <input type="hidden" name="paymentmeth" value="<? echo $paymentmeth;?>">
              <input type="hidden" name="vouchercode" value="<? echo $vouchercode;?>">
              <input type="hidden" name="voucher_amount" value="<? echo $voucher_amount;?>">
            </form>
            <tr> 
              <td width="46%" align="right"><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td width="8%"><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td width="46%"><img src="../images/spacer_trans.gif" width="1" height="1"></td>
            </tr>
            <?php
			if (isset($_GET["msg"])){
			?>
            <tr> 
              <td colspan="3" class="smalltext"> <font color="#FFFFFF"> 
                <div align="center"> 
                  <?php
								switch ($_GET["msg"]){
									case "N1":
										echo "NOTICE: " . N1;
										break;
									case "N3":
										echo "NOTICE: " . N3;
										break;
								}
							?>
                </div>
                </font> </td>
            </tr>
            <tr> 
              <td colspan="3"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
            </tr>
            <?php
			}
			?>
            <tr> 
              <td align="right" class="admintext"><strong>First Name:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $firstname?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Surname:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $surname?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Postal Address:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $address?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Suburb / Town / City:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $suburb?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Postcode:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $postcode?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>State:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $state?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Country:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $country?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Email Address:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $emailadd?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Home Phone:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $homephone?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Work Phone:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $workphone?></td>
            </tr>
            <tr> 
              <td align="right" class="admintext"><strong>Mobile Phone:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $mobilephone?></td>
            </tr>
            <tr> 
              <td valign="top" align="right" class="admintext"><strong>How you 
                heard<br>
                about us:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $hear_about?></td>
            </tr>
            <tr> 
              <td valign="top" align="right" class="admintext"><strong>Special 
                requirements:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $specialreqs?></td>
            </tr>
            <tr>
              <td valign="top" align="right" class="admintext"><strong>Postage 
                Option:</strong></td>
              <td>&nbsp;</td>
              <td class="admintext"><? echo $_POST["postageoption"] ?></td>
            </tr>
            <tr> 
              <td valign="top" align="right" class="admintext"><strong>Referral:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $referralcode?></td>
            </tr>
            <? if($_POST["centreCode"]!=""){ ?>
            <tr> 
              <td align="right" class="admintext"><strong>Kindy/Day Care Code:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $_POST["centreCode"]?></td>
            </tr>
            <? }
						if($_POST["shopCode"]!=""){ ?>
            <tr> 
              <td align="right" class="admintext"><strong>Shop/Agent Code:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"><? echo $_POST["shopCode"]?></td>
            </tr>
            <? } ?>
            <tr> 
              <td align="right" class="admintext"><strong>Method of Payment:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext"> 
                <?
						  if($paymentmeth==0){
							echo "Payment Not Required";
						  }else if($paymentmeth==1){
							echo "Credit Card";
						  }else if($paymentmeth==2){
							echo "Cheque / Money Order";
						  }else if($paymentmeth==3){
							echo "Phone Order";
						  }else if($paymentmeth==4){
							echo "Direct Debit";
						  }else if($paymentmeth==5){
							echo "Gift Voucher";
						  }
						  ?>
              </td>
            </tr>
            <?
			if($voucher_amount>0){
				?>
            <tr valign="top"> 
              <td align="right" class="admintext"><strong>Voucher(s) Used:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext">
                <?=str_replace(",", "-", $vouchercode);?>
              </td>
            </tr>
            <tr valign="top"> 
              <td align="right" class="admintext"><strong>Voucher Usage:</strong></td>
              <td><img src="../images/spacer_trans.gif" width="1" height="1"></td>
              <td class="admintext">$
                <?=sprintf("%01.2f", $voucher_amount);?>
              </td>
            </tr>
            <?
			}

		
/*
					$sql_voucher_as_payment = "SELECT quantdesc FROM basket_items WHERE basket_items.ordernumber = " . $id . " AND basket_items.type = 15";
//echo '<br>$sql_voucher_as_payment: ' . $sql_voucher_as_payment;
					$result_voucher_as_payment = mysql_query($sql_voucher_as_payment);
					if (! $result_voucher_as_payment) error_message(sql_error());
					if (mysql_num_rows($result_voucher_as_payment) > 0){
						$loop_counter = 1;
						while ($rs_voucher_as_payment = mysql_fetch_assoc($result_voucher_as_payment)){
							if ($loop_counter > 1){
								echo '<br>' . $rs_voucher_as_payment["quantdesc"];
							}else{
								echo $rs_voucher_as_payment["quantdesc"];
							}
							$loop_counter++;
						}
					}
*/
					//if($paymentmeth==5){
						//echo strtoupper($vouchercode_array[0]) . "-" . strtoupper($vouchercode_array[1]) . "-" . strtoupper($vouchercode_array[2]) . "-" . strtoupper($vouchercode_array[3]);
					//}
			?>
            <tr> 
              <td><img src="../images/spacer_trans.gif" width="1" height="10"></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
            </tr>
            <tr> 
              <td colspan="3" align="center" class="smalltext">Credit Card orders 
                will be directed to the MultiBase system</td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
            </tr>
            <tr> 
              <td><input type="button" onClick="javascript: document.forms['backform'].submit();" value="&lt; back"></td>
              <td>&nbsp;</td>
              <td align="right"><input type="button" onClick="javascript: document.forms['confform'].submit();" value="confirm &gt;"></td>
            </tr>
          </table> 
		</td> 
		 </tr> 
		  <tr> 
			<td><img src="../images/spacer_trans.gif" width="1" height="10"></td> 
		</tr> 
		<tr> 
			<td colspan="3" class="admintext">&nbsp;<strong>Ordered items:</strong></td> 
		</tr> 
		<tr> 
			<td><img src="../images/spacer_trans.gif" width="1" height="10"></td> 
		</tr>
		<tr> 
			<td colspan="3" bgcolor="#FFFFFF" align="center"> 
				<table cellpadding="0" cellspacing="0" border="0"> 
					<? 
					$totalprice = 0;
					viewOrder($id, "admin");?> 
				</table> 
			</td> 
		</tr>  
		<!---
		<tr> 
			<td colspan="3"> 
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<? /*
					$runningtotal=0;
					if($id!=false){
						$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
						$result = mysql_query($query);
						if(!$result) error_message(sql_error());
						if(mysql_num_rows($result)>0){
							while($qdata = mysql_fetch_array($result)){
							$runningtotal+=$qdata["price"];
							?>
							<tr>
								<td class="admintext" align="center">
								<strong><? echo getLabelType($qdata["type"]); ?></strong>
								<? for($k=1; $k<6; $k++){
									if($qdata["text".$k]!=""){
										?><br><i><? echo $qdata["text".$k];?></i><?
									}
								} ?><br>$<? echo toDollarsAndCents($qdata["price"]);?></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<?
							}
						}
					}*/ ?>
				</table> 
			</td> 
		</tr> --->
		<tr> 
			<td>&nbsp;</td> 
			<td>&nbsp;</td> 
			<td>&nbsp;</td> 
		</tr> 
		<tr>
			<td><img src="../images/spacer_trans.gif" width="1" height="20"></td>
		</tr>
		<? if($id!=false){ ?>
		<tr class="admintext">
			<td height="10" colspan="3">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="6%"><img src="../images/spacer_trans.gif" width="25" height="10"></td> 
						<td colspan="3"><strong>Order Subtotal (<? echo $cur['symbol'];?>) :</strong></td> 
						<td width="3%"><img src="../images/spacer_trans.gif" width="10" height="10"></td> 
						<td width="18%"> 
							<div align="right"><strong><? echo $cur['symbol'].toDollarsAndCents($totalprice);?><img src="../images/spacer_trans.gif" width="10" height="10"></strong></div> 
						</td>
					</tr>
					<tr>
						<td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td> 
					</tr> 
					<tr> 
						<td><img src="../images/spacer_trans.gif" width="25" height="10"></td> 
						<td colspan="3"><strong>Postage &amp; Handling</strong><strong> (<? echo $cur['symbol'];?>) :</strong></td> 
						<td><img src="../images/spacer_trans.gif" width="10" height="10"></td> 
						<td><div align="right"><strong><?php
															if ($postageopt != 'Normal' && $postageopt !="")
															{
																$sql = "SELECT expresspost FROM currencies WHERE id = 1";
																$result = mysql_query($sql)or die ("SQL ERROR");
																$row = mysql_fetch_assoc($result);
																$postage = $row["expresspost"]; 
																echo $cur['symbol'].toDollarsAndCents($postage);?><img src="../images/spacer_trans.gif" width="10" height="10">	
													<?php	}
															else
															{											
																echo $cur['symbol'].toDollarsAndCents($cur['postage']); $postage = $cur['postage'];?><img src="../images/spacer_trans.gif" width="10" height="10">
														 <? } ?>								 
						</strong></div></td>
					</tr>
					<?
					if($voucher_amount>0){
					?>
					<tr>
						<td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td> 
					</tr> 
					<tr> 
						<td><img src="../images/spacer_trans.gif" width="25" height="10"></td> 
						<td colspan="3"><strong>Voucher Debit</strong><strong> (<? echo $cur['symbol'];?>) :</strong></td> 
						<td><img src="../images/spacer_trans.gif" width="10" height="10"></td> 
						<td><div align="right"><strong>-<? echo $cur['symbol'].toDollarsAndCents($voucher_amount);?><img src="../images/spacer_trans.gif" width="10" height="10"></strong></div></td>
					</tr>
					<?
					}
					?>
					<tr>
						<td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
					</tr>
					<tr>
						<td valign="middle"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
						<td height="30" colspan="3" valign="middle"><div align="right"><strong>TOTAL:</strong></div></td>
						<td height="30"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
						<td height="30"><div align="right"><strong><? echo $cur['symbol'].toDollarsAndCents($totalprice+$postage-$voucher_amount);?><img src="../images/spacer_trans.gif" width="10" height="10"></strong></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<? }?> 
		<tr>
			<td colspan="3"> 
				<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
					<tr> 
						<td valign="top" class="admintext"><strong>Notes:</strong></td> 
					</tr> 
					<tr> 
						<td valign="top" class="admintext">Postage &amp; Handling is free within Australia.<br>For overseas orders the P&amp;H is $10.00 AUD</td> 
					</tr> 
					<tr> 
						<td valign="top" class="admintext">Please allow 7 - 10 days for delivery. </td> 
					</tr> 
					<tr> 
						<td valign="top" class="admintext">All items are mailed using <a href="http://www.australiapost.com.au" target="_blank" class="type1">Australia Post</a>. </td> 
					</tr> 
					<tr>
						<td valign="top" class="admintext">Any order not paid within 10 days will be destroyed. </td> 
					</tr> 
				</table> 
			</td> 
		</tr> 
		<tr> 
			<td>&nbsp;</td> 
			<td>&nbsp;</td> 
			<td>&nbsp;</td> 
		</tr>
	</table> 
	</html> 
