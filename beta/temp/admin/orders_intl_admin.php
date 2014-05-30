<?php
// set explicit form variables
//print_r($_REQUEST);
$includeabove = true;

include("../useractions.php"); // this includes common_db.php

linkme();

session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);


$query = "SELECT * FROM currencies";
//echo " 1 $query <br>";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = array();
while($qdata = mysql_fetch_array($result)){
	$cur[$qdata["id"]] = array();
	$cur[$qdata["id"]]['currName'] = $qdata["currName"];
	$cur[$qdata["id"]]['symbol'] = $qdata["symbol"];
	$cur[$qdata["id"]]['postage'] = $qdata["postage"];
	$cur[$qdata["id"]]['freeGift'] = $qdata["freeGift"];
}




$where = '';
$rangeWhere='';
$checkArchive = false;
$archiveOrders = false;
$archiveSuffix = "_archive";
$ordersTable = "orders";
$basketItemsTable = "basket_items";
$ccTransactionsTable = "cc_transactions";
$customersTable = "customers";

if($showunfinished!="true"){
	$showunfinished="false";
}
if($showarchived!="true"){
	$showarchived="false";
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identikid.css" rel="stylesheet" type="text/css">
<body bgcolor="5D7EB9">
<table width="350" cellspacing="2" cellpadding="2" border="0" bgcolor="#FFFFFF" align="center">
	<tbody>
		<tr>
			<td><div align="center"><a target="_self" href="index.php"><font face="Arial, Helvetica, sans-serif"><strong>Admin</strong></font> </a> </div></td>
		</tr>
	</tbody>
</table>
<form name="reports" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
	<table width="100%" border="0" cellpadding="2" cellspacing="5" bgcolor="#FFFFFF">
		<tr>
			<td colspan="1" width="100" align="right" class="admintext">From:&nbsp;&nbsp;</td>
			<td colspan="8" class="admintext"><?
			html_pulldown2('from_day', range(1,31),date(('j')-1), false);
			?>
				/
				<?
			html_pulldown2('from_month', range(1,12), date('n'), false);
			?>
				/
				<?
			html_pulldown2('from_year', range(2005, date('Y')+10), date('Y'), false);
			?>
			      &nbsp;&nbsp;Hours
			<?
				html_pulldown2('from_hours', range(00, 23), date('H'), false);
				?>
				&nbsp;&nbsp;Minutes
			<?
				html_pulldown2('from_minutes', range(00, 59), date('i'), false);
				?>
			</td>
		</tr>
		<tr>
			<td colspan="1" width="100" align="right" class="admintext">To:&nbsp;&nbsp;</td>
			<td colspan="9" class="admintext"><?
			html_pulldown2('to_day', range(1,31), date('j'), false);
			?>
				/
				<?
			html_pulldown2('to_month', range(1,12), date('n'), false);
			?>
				/
				<?
			html_pulldown2('to_year', range(2005, date('Y')+10), date('Y'), false);
			?>
			    &nbsp;&nbsp;Hours 
        <?
			html_pulldown2('to_hours', range(00, 23), date('H'), false);
			?>
	        &nbsp;&nbsp;Minutes
        <?
			html_pulldown2('to_minutes', range(00, 59), date('i'), false);
			?>
			</td>
		</tr>
		<tr>
			<td colspan="1" align="right" class="admintext">&nbsp;</td>
			<td colspan="9" class="admintext"><input type="submit" name="Submit" value="Submit"></td>
		</tr>
		<tr>
			<td colspan="10" align="right" class="admintext"><hr noshade></td>
		</tr>
	</table>
</form>
<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#FFFFFF">
	<tr>
		<td colspan="7" align="left" bgcolor="#FFFFFF" style="padding-left:10px"><font face="Arial, Helvetica, sans-serif"><strong>International Transaction Report</strong></font></td>
	</tr>
	<?
		if(trim($_POST['Submit']) == 'Submit')	
		{ ?>
	<tr>
		<td colspan="7" bgcolor="#FFFFFF" align="left" style="padding-left:10px" class='admintext'><?php echo "<span class='admintext'>From: ".date('Y-m-d H:i', $from_date)."&nbsp;&nbsp;&nbsp; To: ".date('Y-m-d H:i', $to_date)."</span>"; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="admintext" valign="middle" align="center"><b>&nbsp;Date&nbsp;</b></td>
		<td class="admintext" valign="middle" align="left"><b>&nbsp;Products&nbsp;</b></td>
		<td class="admintext" valign="middle" align="left"><b>&nbsp;Total&nbsp;</b></td>
		<td class="admintext" valign="middle" align="center"><b>&nbsp;Last Change&nbsp;</b></td>
		<td class="admintext" valign="middle" align="center"><b>&nbsp;Payment 
			Type&nbsp;&nbsp;&amp; Order Type&nbsp;</b></td>
		<td class="admintext" valign="middle" align="center"><b>&nbsp;Urgent&nbsp;</b></td>
		<td class="admintext" valign="middle" align="center"><b>&nbsp;Status&nbsp;</b></td>
	</tr>
	<?
		if(trim($_POST['Submit']) == 'Submit')	
		{
		
			$from_date = mktime((int)form_param('from_hours'), (int)form_param('from_minutes'),0, (int)form_param('from_month'), (int)form_param('from_day'), (int)form_param('from_year'));
			$to_date   = mktime((int)form_param('to_hours'),(int)form_param('to_minutes'),0, (int)form_param('to_month'), (int)form_param('to_day')+1, (int)form_param('to_year'));
			$rangeWhere = " (a.finished >='" . date('Y-m-d H:i:00', $from_date) ."' AND a.finished <='" . date('Y-m-d H:i:00', $to_date)."') ";
			$totalrecords = 0;
			$normalRecords =0;
			$archivedRecords = 0;
			$startrecordHold = $startrecord;
			$showperpageHold = $showperpage;
			$idArray = array();
		    for($ac=0;$ac<2;$ac++) {
			  if($ac==1 && $checkArchive == true){
			    $archiveOrders = true;
			    $archiveSuffix = "_archive";
                $ordersTable.=$archiveSuffix;
                $basketItemsTable.=$archiveSuffix;
                $ccTransactionsTable.=$archiveSuffix;
                $customersTable.=$archiveSuffix;
				if(($startrecord+$showperpage)<$normalRecords) break;
				else{
				  if(($startrecord-$normalRecords) < 0){
				    $showperpage = $normalRecords-$startrecord;
				    $startrecord = 0;
				  }
				  else{$startrecord = $startrecord-$normalRecords;}
				}
			  } else if($ac==1 && $checkArchive == false) {
			    break;
			  }

		    //if(($orders_search || $name_search || $phone_search)){

	       $where = "WHERE a.customer=b.id AND bi.ordernumber=a.id  AND LOWER(b.country) != 'australia'";
	
	       if($label_search==1  && !empty($name_search)){
		     $label_query .= " OR bi.text1 LIKE '%".mysql_real_escape_string($name_search)."' OR bi.text2 LIKE '%".mysql_real_escape_string($name_search)."%' ";
	       }
	
	       if($orders_search){
		     $where.= " AND (a.id=".($orders_search-1000).")";
	       }
	
	       if($name_search){
		     $where.= " AND (b.firstname LIKE '%".mysql_real_escape_string($name_search)."%' OR b.surname LIKE '%".mysql_real_escape_string($name_search)."%' {$label_query} )";
	       }
	
	       if($phone_search){
		     $where.= " AND (b.homephone LIKE '%".$phone_search."%' OR b.workphone LIKE '%".$phone_search."%' OR b.mobilephone LIKE '%".$phone_search."%')";
	       }
	
		   $where .= " AND b.firstname != '' AND b.address != ''"	;
	       $where.=$rangeWhere!=''?" AND ".$rangeWhere:'';
 
	      // if($name_search || $phone_search){
		     /*$query = "SELECT COUNT(*) AS row_count FROM {$ordersTable} a, {$customersTable} b, {$basketItemsTable} bi ".$where." GROUP BY b.id" ;
		     //echo " 2 $query <br>";
		     $result = mysql_query($query);
		     if(!$result) error_message(sql_error() . "<BR>{$query}");
			 $row = mysql_fetch_array($result);
		     $maxrecords = $row['row_count'];*/
		     //echo $query.$maxrecords;
			 if($archiveOrders == false)$normalRecords = $maxrecords;
			 else $archivedRecords = $maxrecords;
		
	      $query = "SELECT a.*, UNIX_TIMESTAMP(a.started) AS ustarted, UNIX_TIMESTAMP(a.finished) AS ufinished, UNIX_TIMESTAMP(a.dateposted) AS udateposted FROM {$ordersTable} a, {$customersTable} b, {$basketItemsTable} bi  ".$where."  GROUP BY b.id ORDER BY started DESC ";
		
          $result = mysql_query($query);
          if(!$result) error_message("sql error: ".sql_error());
		  
		  while($qdata = mysql_fetch_array($result)){

					//print_r($qdata);

					$dontshowme=false;
					$ordertype = $qdata["ordertype"];
					$currency = $qdata["currency"];
					$custid = $qdata["customer"];
					
					if(!$ordertype) $ordertype="Web";
					
					$express_found = 0;
					
					$postsql = "SELECT postage_option FROM {$customersTable} WHERE id = '$custid'";
//					echo " 6 $postsql <br>";
					$theresult = mysql_query($postsql) or die ("postsql error");
					while ($therow = mysql_fetch_assoc($theresult))
					{
						if ($therow["postage_option"]=="Australian Express" || $therow["postage_option"]=="Overseas Express" || $therow["postage_option"]=="Express" )
						{
							$express_found = 1;
						}
					}
					if ($express_found == 1)
					{
						$bgcol = "#FFF600";
					}
									
					elseif($qdata["archived"]==1){
						if($showarchived=="false"){
							$dontshowme=true;
						}
						$bgcol = "#B3CCF7";
					}else if($qdata["status"]=="pending"){
						$bgcol = "#FFFFFF";
					}else if($qdata["status"]=="printed"){
						if($showprinted=="false"){
							$dontshowme=true;
						}
						$bgcol = "#DDDDDD";
					}else if($qdata["status"]=="payment arrived"){
						if($showpayment=="false"){
							$dontshowme=true;
						}
						$bgcol = "#CCCCCC";
					}else if($qdata["status"]=="processing order"){
						if($showprocess=="false"){
							$dontshowme=true;
						}
						$bgcol = "#BBBBBB";
					}else if($qdata["status"]=="posted"){
						if($showposted=="false"){
							$dontshowme=true;
						}
						$bgcol = "#AAAAAA";
					}
					if($qdata['urgent']==1)
					{
						$bgcol="#FF8888";
					}
					
					// Custom Label Background Colour
					$custquery = "SELECT * FROM {$basketItemsTable} WHERE ordernumber=".$qdata["id"];
					//echo " 7 $custquery <br>";
					$cust = mysql_query($custquery);
					if(!$cust) error_message(sql_error());
					$cust_row = mysql_fetch_assoc($cust);
					if ($cust_row["type"] == 27)
					{
						$bgcol="#B096CD";
					}
					

					$query = "SELECT * FROM {$customersTable} WHERE id=".$qdata["customer"];
					$customer = mysql_query($query);
					if(!$customer) error_message(sql_error());
					while($cdata = mysql_fetch_array($customer)){
					    $specialRequirements = stripslashes($cdata["specialreqs"]);
						$paymentmeth = $cdata["paymentmeth"];
						$postage = $cdata["postage"];
						$custId = $cdata["id"];


						if(!empty($cdata['voucher'])){
//							$voucher_amount = "<br />({$cur[$currency]['symbol']}".sprintf("%01.2f", $cdata['voucher_amount']).")";

							$voucher_amount_raw = $cdata['voucher_amount'];
							$voucher_number = str_replace(",", "-", $cdata['voucher']);

						}
						else {
							$voucher_amount = $voucher_number = "";
							$voucher_amount_raw = 0;
						}


// get CC amount & return code
$amount_paid = -999.99;
$RC_output=$AMOUNT="";
$string2 = "	select RC, AM 
					from {$ccTransactionsTable} 
					where OI='" .($qdata["id"]+1000)."' 
					and MR != 'M12'
					order by id desc limit 1";
//echo " 9 $string2 <br>";
$result2 = mysql_query($string2) or die ("SQL Error: ".mysql_error());
if(mysql_num_rows($result2)==1)
{
	list($RC, $AMOUNT)=mysql_fetch_row($result2);
	
	if(strlen(trim($AMOUNT)) > 0 ){
		$amount_paid = $AMOUNT/100;
		$amount_display = " AU$".sprintf("%01.2f", $amount_paid);
	}
	
	$RC_output = returnErrorCode($RC);
	if(!empty($RC_output))
	{
		$RC_output = "<br />({$RC_output})";
	}

	if(!empty($AMOUNT) && $currency!=1 && $currency!=5 )
	{
		$AMOUNT = "<br /><i>(AU$".sprintf("%01.2f", $AMOUNT/100).")</i>";
	}
	else {
		$AMOUNT = "";
	}
}


if($qdata['ustarted'] > $_EPAY['LIVE_TIMESTAMP']){
	$merchant = "MultiBase";
}
else {
	$merchant = "Paystream";
}


/*print "<pre>";
print_r($cdata);
print "</pre>";
*/

						if($cdata["firstname"]!="" && $cdata["confirmed"]!="unconfirmed" && (($cdata["approved"]!=0 && $cdata["approved"]!=2) || $paymentmeth!=1 || $cdata["ccxx"]!="")){
							$name = stripslashes($cdata["firstname"])." ".stripslashes($cdata["surname"]);
							if($cdata["approved"]==1){



								$name.="<br><i><font color=\"#006600\">(order approved by {$merchant}".$amount_display.")</font></i>";
							}
						}else if($paymentmeth==1 && $cdata["approved"]==2){
							$name = "order unfinished";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}else if($cdata["approved"]==0){
							$name = $cdata["firstname"]." ".$cdata["surname"];

							$name.="<br><i><font color=\"#990000\">(order denied by {$merchant}){$RC_output}</font></i>";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}else if($cdata["confirmed"]!="unconfirmed"){

							$name = "order unfinished";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}else{
							$name = "order unconfirmed";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}
						$oseas = $cdata["oseas"];

					}
					$show_payment_received = false;
					$pm = $paymentmeth;
					if($paymentmeth==0){
						$paymentmeth="";
					}else if($paymentmeth==1){
						$paymentmeth="Credit Card";
						if($ordertype=="Phone/fax")
						{
							$show_payment_received = true;
						}
					}else if($paymentmeth==2){
						$show_payment_received = true;
						$paymentmeth="Money Order";
					}else if($paymentmeth==3){
						$show_payment_received = true;
						$paymentmeth="Phone Order";
					}else if($paymentmeth==4){
						$show_payment_received = true;
						$paymentmeth="Direct Debit";
					}else if($paymentmeth==5){
						$show_payment_received = true;
						$paymentmeth="Phone with CC";
					}else if($paymentmeth==6){
						$show_payment_received = true;
						$paymentmeth="Gift Voucher<br />[{$voucher_number}]";
					}
					else if($paymentmeth==7){
						$show_payment_received = true;
						$paymentmeth="PayPal Invoice";
					}

				if($pm!=6 && !empty($voucher_number)){
					$paymentmeth .= " + Voucher<Br />[{$voucher_number}]";
				}

				if($dontshowme==false && $archiveOrders==false) $idArray[] = $qdata["id"];
				
				if($dontshowme==false || $name_search || $order_search){ 
				?>
	<tr bgcolor="#FFFFFFF">
		<td colspan="7"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
	</tr>
	<tr bgcolor="#FFFFFFF">
		<td class="admintext" valign="top" align="center"><? echo date("d M Y H:i", $qdata["ustarted"]);?><br>
			<strong>No: <? echo 1000+$qdata["id"];?></strong></td>
		<td class="admintext" valign="top" align="left"><table cellpadding="0" cellspacing="0" border="0">
				<?
						$query = "SELECT * FROM {$basketItemsTable} bi
							LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
							LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
							LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
							LEFT JOIN product p ON (p.id=bi.text5)
							WHERE ordernumber=".$qdata["id"];
						//echo $query;
						//echo " 10 $query <br>";
						$basket = mysql_query($query);
						if(!$basket) error_message(sql_error());
						$totalprice=0; ?>
				<tr>
					<td class="admintext"><strong><? echo $name;?></strong></td>
				</tr>
				<?
							while($basket_qdata = mysql_fetch_array($basket)){
								$basket_qdata["text1"] = stripslashes($basket_qdata["text1"]);
								$basket_qdata["text2"] = stripslashes($basket_qdata["text2"]);
								$basket_qdata["text3"] = stripslashes($basket_qdata["text3"]);
								$basket_qdata["text4"] = stripslashes($basket_qdata["text4"]);
								$basket_qdata["text5"] = stripslashes($basket_qdata["text5"]);
							
								$totalprice += $basket_qdata["price"];
								?>
				<tr>
					<td class="admintext"><strong><? echo $basket_qdata["quantdesc"];?></strong>
						<?
    		        			switch((int)$basket_qdata['type'])
    		        			{
    		        				
    		        				case 3:
    		        					// mini's
    		        				echo  '<br />' . $basket_qdata['text1'];
//    		        				debug_showvar($basket_qdata);
										if(strlen($basket_qdata['text2']) > 0)
										{
											echo '<Br />' . $basket_qdata['text2'];
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>pic: ".getPicType($basket_qdata['pic']);
										}
										break;
    		        				case 5:
    		        					// pencil
    		        					echo  '<br />' . $basket_qdata['text1'];
										if(strlen($basket_qdata['text2']) > 0)
										{
											echo '<Br />' . $basket_qdata['text2'];
										}
										if((int)$basket_qdata['picon']==1 && (int)$basket_qdata['pic'] > 0)
										{
											print "<br /><i>pic: ".getPicType($basket_qdata['pic']);
										}
										break;
										
									case 24: // address labels
											print "<br>".$basket_qdata["text1"];

											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											print "<br>".$basket_qdata["text4"];
									break;
									
									case 25: // address labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											print "<br>".$basket_qdata["text4"];
									break;
									
									case 26: // address labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											print "<br>".$basket_qdata["text4"];
									break;
									
									case 27: // custon labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											//print "<br>".$basket_qdata["text4"];
									break;
										
    		        				case 17:
										//$types=array('', 'Vinyl Labels', 'Iron-on Labels (Semi-Permanent)', 'Mini Vinyl Labels');
										$types=array();
										$types[1] = 'Vinyl Labels';
										$types[2] = 'Semi-Permanent Iron Ons';
										$types[3] = 'Mini Vinyl Labels';
										$types[19] = 'Permanent Iron Ons';
										
										$packs= explode(",", $basket_qdata["text5"]);
										$text = explode(",", $basket_qdata["text1"]);
										$pic  = explode(",", $basket_qdata["pic"]);
										$picon= explode(",", $basket_qdata["picon"]);
	
										$phone= explode(",", $basket_qdata["text2"]);
										
										
										for($k=0;$k<=1;$k++){
											print "<br /><i><strong>Pack" .($k+1). ": 30 {$types[$packs[$k]]}</strong><br />" .rawurldecode($text[$k]);
											if(!empty($phone[$k]))
												print "<br />" .rawurldecode($phone[$k]);
											if($picon[$k]==1)
												print "<br />".getPicType($pic[$k]);
										}
										break;
									case 18:
										$types = array('', 'Vinyl Labels','','Mini Vinyl Labels');
										print "<br /><i><strong>Pack: ".$types[$basket_qdata['text5']]."</strong><br />".rawurldecode($basket_qdata['text1']);
										if(!empty($basket_qdata['text2']))
										{
											print "<br />{$basket_qdata['text2']}";
										}
										if($basket_qdata['picon']==1)
										{
											print "<br />".getAllergyPicType($basket_qdata['pic']);
										}
										print "</i>";
										break;
									case 21:
										echo  '<br />' . $basket_qdata['text1'];
										if(strlen($basket_qdata['text2']) > 0)
										{
											echo '<Br />' . $basket_qdata['text2'];
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>pic: ".getPicType($basket_qdata['pic']);
										}
										echo '<br />tag: ' . $basket_qdata['data_identitag_name'];
										break;
									case 30:
										// get the product description
										/*
										$sqlBands = "	SELECT *
														FROM product
														WHERE id IN (30,31,32)";
										$resultBands = db_query($sqlBands);
										$products_bands = array();
										while($recordBands = db_fetch_array($resultBands)){
											$products_bands[(int)$recordBands['id']] = $recordBands['productName'];
										}
										$band_qtys = explode(",",$basket_qdata["text5"]);
										*/
										for($k=1; $k<=5; $k++){
											//$productId = $band_qtys[$k-1];
											if($basket_qdata["text".$k] != "0"){
												?>
						<br>
						<i>
						<?
												$temp_output = $basket_qdata["text".$k];
												if($temp_output==strtoupper($basket_qdata["text".$k])){
													$temp_output = getBandPicType($basket_qdata["text".$k]);
												}
												print $temp_output;
												?>
						</i>
						<?
											}
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>".getPicType($basket_qdata['pic']);
										}
										?>
						<br>
						<?=$cur[$currency]['symbol'].number_format($basket_qdata['price'],2)?>
						<?
										break;
										
									case 22:
										for($k=1; $k<6; $k++){
											if($basket_qdata["text".$k]!=""){
												?>
						<br>
						<i>
						<?
												$temp_output = getIdentitagDesc(strtoupper($basket_qdata["text".$k]));
												if($temp_output==strtoupper($basket_qdata["text".$k])){
													$temp_output = getPicTypeZT($basket_qdata["text".$k]);
												}
												print $temp_output;
												?>
						</i>
						<?
											}
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>".getPicTypeZT($basket_qdata['pic']);
										}
										break;
								   case (((int)$basket_qdata['type']>=36) && ((int)$basket_qdata['type']<=39)):
								   ?>
						<br>
						<i>
						<?=$basket_qdata["text1"];?>
						<br>
						<?=$basket_qdata["text2"];?>
						</br>
						<? 
						  			    for( $i=3 ; $i <= 12; $i++) {
						  				   print($basket_qdata["text".$i]!=''?$basket_qdata["text".$i].'<br>':'');
						  				 }
						  			  ?>
						</i>
						<?
									break;		
									
									case (((int)$basket_qdata['type']>=48) && ((int)$basket_qdata['type']<=56)):
								   ?>
						<br>
						<i>
						<?=$basket_qdata["text1"];?>
						<br>
						<?=$basket_qdata["text2"];?>
						</br>
						<? 
						  			    for( $i=3 ; $i <= 12; $i++) {
						  				   print($basket_qdata["text".$i]!=''?$basket_qdata["text".$i].'<br>':'');
						  				 }
						  			  ?>
						</i>
						<?
									break;		
										
									default:
										for($k=1; $k<6; $k++){
											if($basket_qdata["text".$k]!=""){
												?>
						<br>
						<i>
						<?
												$temp_output = getIdentitagDesc(strtoupper($basket_qdata["text".$k]));
												if($temp_output==strtoupper($basket_qdata["text".$k])){
													$temp_output = getPicType($basket_qdata["text".$k]);
												}
												print $temp_output;
												?>
						</i>
						<?
											}
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>".getPicType($basket_qdata['pic']);
										}
										break;

								}
							}	

							// subtract voucher value
							if($voucher_amount_raw>0){
								$voucher_currency = getVoucherDetails($totalprice, str_replace("-", ",", $voucher_number), true);
		
		
		
		
								if(empty($voucher_currency)){
									$voucher_amount="<br />[Voucher not found]";
								} 
								else {
									// change the vouchers into the currency used
									$voucher_amount_raw = convertCurrency($voucher_amount_raw, $currencies[$voucher_currency]['code']."to".$currencies[$currency]['code']);
									$totalprice = $totalprice - $voucher_amount_raw;
									$voucher_amount = "<br />[{$cur[$currency]['symbol']}".sprintf("%01.2f", $voucher_amount_raw)."]";
								}


 ?></td>
				</tr>
				<tr>
					<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
				</tr>
				<? }
				$totalprice+=$postage;
				if($amount_paid != $totalprice && $amount_paid != -999.99 && ($currency==1 || $currency==5)){
					$alert_colour="#FF0000";
					$alert_weight="bold";
				} else {
					$alert_colour="";
					$alert_weight="";
				}
				if(mysql_num_rows($basket)==0) echo "no products"; ?>
			</table></td>
		<td class="admintext" valign="top" align="left"><p style="color: <?=$alert_colour?> ; font-weight: <?=$alert_weight?>;" class="ordertotal"><? echo $cur[$currency]['symbol'].sprintf("%01.2f", $totalprice);?>
				<?=$voucher_amount?>
				<?=$AMOUNT?>
			</p></td>
		<td class="admintext" valign="top" align="center"><? echo date("d M Y H:i", $qdata["ufinished"]);?></td>
		<td class="admintext" valign="top" align="center"><? echo $paymentmeth."<br><b>".$ordertype."<b>";?>
			<?
if($show_payment_received == true)
{
	?>
			<br />
			<table cellpadding=0 cellspacing=0 border=0>
				<tr>
					<td valign='top' class="admintext"><?=($qdata['payment_received']==1)?"Yes":"No";?></td>
					<td  nowrap class="admintext">&nbsp;&nbsp;Payment Rcvd</td>
				</tr>
			</table>
			<?
}

?></td>
		<td class="admintext" valign="top" align="center"><?=($qdata['urgent']==1)?"Yes":"No";?></td>
		<td class="admintext" valign="top" align="center">&nbsp;&nbsp;<b>
			<?=$qdata["status"]?>
			</b><br>
			<br></td>
	</tr>
	<?
			}
		} 
	   }?>
	   
	 <? } ?>  
	<tr bgcolor="#FFFFFFF">
		<td colspan="7"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
	</tr>
</table>
</body>
