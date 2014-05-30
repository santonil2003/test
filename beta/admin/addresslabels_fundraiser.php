<?
include("required.php");
linkme();

session_start();
$user_section_id = 2;
require_once("./security.php");
check_access($user_section_id);

$startpoint = ($_GET["page"]-1)*16;

$months = array();
$months[0]="Jan";
$months[1]="Feb";
$months[2]="Mar";
$months[3]="Apr";
$months[4]="May";
$months[5]="Jun";
$months[6]="Jul";
$months[7]="Aug";
$months[8]="Sep";
$months[9]="Oct";
$months[10]="Nov";
$months[11]="Dec";

if(isset($_POST["startDay"]) || isset($_GET["startTS"])){
	if(isset($_GET["startTS"])){
		$startTS=intval($_GET["startTS"]);
		$endTS=intval($_GET["endTS"]);
		
		$startDay = date("j", $startTS);
		$startMonth = date("n", $startTS);
		$startYear = date("Y", $startTS);
		$endDay = date("j", $endTS);
		$endMonth = date("n", $endTS);
		$endYear = date("Y", $endTS);
		
	}else{
		$startDay = $_POST["startDay"];
		$startMonth = $_POST["startMonth"];
		$startYear = $_POST["startYear"];
		$endDay = $_POST["endDay"];
		$endMonth = $_POST["endMonth"];
		$endYear = $_POST["endYear"];
		
		$startTS = date("U",mktime(0,0,0,$startMonth+1,$startDay,$startYear));
		$endTS = date("U",mktime(0,0,0,$endMonth+1,$endDay,$endYear));
	}
	
	$query = "SELECT * FROM orders a, customers b WHERE UNIX_TIMESTAMP(a.finished)>=".$startTS." AND UNIX_TIMESTAMP(a.finished)<=".$endTS." AND a.customer=b.id AND b.confirmed!='unconfirmed' AND b.approved!=0 AND b.firstname!=''";
	$addresses = mysql_query($query);
	if(!$addresses) error_message(sql_error());
}else{
	$startTS = mktime(0,0,0,date("n"),date("d")-1,date("Y"));
	$startDay = date("d", $startTS);
	$startMonth = date("n", $startTS)-1;
	$startYear = date("Y", $startTS);
	
	$endTS = date("U");
	$endDay = date("d", $endTS);
	$endMonth = date("n", $endTS)-1;
	$endYear = date("Y", $endTS);
	
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Fundraiser Address Labels</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>
<script language="JavaScript">
function getSelected(){
	i=0;
	selectedAr = new Array();
	while(document.forms['addressList']['n'+i]!=null){
		if(document.forms['addressList']['check'+i].checked==true){
			id=document.forms['addressList']['n'+i].value;
			selectedAr.push(id);
		}
		i++;
	}
	return selectedAr;
}
function reportItems(){
	selectedAr = getSelected();
	if(selectedAr.length==0){
		alert('you must select at least one item to view');
	}else{
		selections = makeSelections(selectedAr);
		location.href='addresslabels_frameset_fundraiser.php?order_ids=' + document.forms.addressList.order_ids.value + '&type=byDate&startTS='+document.forms.getaddresses.startTS.value+'&endTS='+document.forms.getaddresses.endTS.value+'&id='+selections;
	}
}
function reportByInvoice(){
	selectedAr = new Array();
	for(i=0; i<16; i++){
		selectedAr[i]="";
		val=document.forms['getAddressByInv']['inv'+i].value;
		if(val!="" && val.length>=1){
			val = Number(val);
			selectedAr[i]=val;
		}
	}
	selections = makeSelections(selectedAr);
	location.href='addresslabels_frameset_fundraiser.php?type=byInv&id='+selections;
}

<!-- Empty the 16 boxes containing the manually entered invoice numbers -->
function EmptyByInvoiceBoxes(){
	for(i=0; i<16; i++){
		document.forms['getAddressByInv']['inv'+i].value = "";
	}
}

function makeSelections(selectedAr){
	selections="";
	for(i=0; i<selectedAr.length; i++){
		if(i!=0){
			selections+=";";
		}
		selections+=selectedAr[i];
	}
	return selections;
}
</script>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
				<tr bgcolor="#FFFFFF">
				  <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
				  <td><img src="../images/spacer_trans.gif" height="1" width="650" border="0"></td>
				  <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					 <td class="admintext"><strong>Fundraiser Address Labels</strong></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					 <td align="center" class="admintext">
					 <input type="button" name="back" value="&lt; Back" onClick="location.href='fundraisers.php'">
					 </td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				
				<form name="getAddressByInv" method="post" action="addresslabels_fundraiser.php">
				<tr>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td class="admintext">
						<br>
						<strong>Show addresses by Fundraiser number:</strong><br>
						(labels printed as entered below)<br><br>
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td colspan="3"><input type="button" onClick="JavaScript: EmptyByInvoiceBoxes();" value="empty labels"></td>
							</tr>
							<tr>
								 <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<?php
							$text_box_number = 0;
							if (isset($_POST["id"])){
								$invoice_numbers = split(";",$_POST["id"]);
							}elseif (isset($_GET["id"])){
								$invoice_numbers = split(";",$_GET["id"]);
							}
							if (count($invoice_numbers) > 0){
								for($index = $startpoint; $index < ($startpoint + 16); $index += 2){?>
									<tr>
										<td><input type="text" size="6" name="inv<? echo $text_box_number;?>" value="<? if (!empty($invoice_numbers[$index])){ echo (sprintf("%04d",$invoice_numbers[$index])); } ?>"></td>
										<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
										<td><input type="text" size="6" name="inv<? echo $text_box_number+1;?>"value="<?  if (!empty($invoice_numbers[$index + 1])){ echo (sprintf("%04d",$invoice_numbers[$index + 1])); }?>"></td>
									</tr>
									<tr>
										 <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
									</tr>
									<? 
									$text_box_number += 2;
								}
							}else{
								for($i=0; $i<16; $i+=2){?>
									<tr>
										<td><input type="text" size="6" name="inv<? echo $i;?>"></td>
										<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
										<td><input type="text" size="6" name="inv<? echo $i+1;?>"></td>
									</tr>
									<tr>
										 <td colspan="3"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
									</tr>
								<? }
							}?>
							<tr>
								<td colspan="3"><input type="button" onClick="reportByInvoice();" value="make labels"></td>
							</tr>
						</table>
					</td>
				</tr>
				</form>
				
			</table>
		</tr>
	</table>
</body>
</html>
