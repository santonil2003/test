<?
$includeabove=true;
include("../useractions.php");
include("fundraisers_functions.php");

$type=$_GET["type"];

linkme();
session_start();
$user_section_id = 2;
require_once("./security.php");
check_access($user_section_id);
if(isset($_GET['set_ids']) && $_GET['set_ids'] == '1'){
  if(isset($_SESSION['ids'])) unset($_SESSION['ids']);
  $post_ids = $_POST["ids"]!=''?';'.$_POST["ids"]:'';
  $_SESSION['ids'] = $_GET["id"].$post_ids;
}

$items = split(";",$_SESSION['ids']);

//print_r($items);

$query = "SELECT * FROM fundraisers WHERE id=";
for($i=0; $i<count($items); $i++){
  if($i!=0){
    $query.=" OR id=";
  }
  $query.=$items[$i];
}


if(isset($_GET["_gt"]) && $_GET["_gt"] != ''){
   $gt=$_GET["_gt"];
} else {
  $gt=false;
}

$result = mysql_query($query);
if(!$result) error_message(sql_error());


$num_results = mysql_num_rows($result);

$per_page = 100;

$pages = ceil($num_results/$per_page);

if(!isset($_GET["page"]) || $_GET["page"] == '') $page = 1;
else $page = (int)$_GET['page'];

$next_page = $page + 1;
$prev_page = $page - 1;

$last = $page * $per_page;
if($last > $num_results) $last = $num_results;

$first = $last - $per_page;
if($first < 0) $first = 0;


$query.= " ORDER BY idnumber LIMIT {$first} , {$per_page} ";
$result = mysql_query($query);
if(!$result) error_message(sql_error());


$startdate = mktime(0,0,0,$_GET["startMonth"]+1,$_GET["startDay"],$_GET["startYear"]);
$enddate = mktime(23,59,59,$_GET["endMonth"]+1,$_GET["endDay"],$_GET["endYear"]);

$Q2=FALSE;
if(isset($_GET['Q2startYear'])  && isset($_GET['Q2startMonth']) && isset($_GET['Q2startDay']) && 
		isset($_GET['Q2endYear']) && isset($_GET['Q2endMonth']) && isset($_GET['Q2endDay']))
{
	$Q2=TRUE;
	$Q2startdate = mktime(0,0,0, $_GET["Q2startMonth"]+1, $_GET["Q2startDay"], $_GET["Q2startYear"]);
	$Q2enddate   = mktime(0,0,0, $_GET["Q2endMonth"]+1, $_GET["Q2endDay"], $_GET["Q2endYear"]);
}

//echo date('d m Y', $enddate);

$sendString = getSendString();

//print $sendString; exit;

if($type=="quarter"){
	$yr=date("Y", $startdate);
	if(date("n", $startdate)==1){
		$quart = 1;
	}else if(date("n", $startdate)==4){
		$quart = 2;
	}else if(date("n", $startdate)==7){
		$quart = 3;
	}else if(date("n", $startdate)==10){
		$quart = 4;
	}

	if($Q2==TRUE)
	{
		$Q2yr=date("Y", $Q2startdate);
		if(date("n", $Q2startdate)==1){
			$Q2quart = 1;
		}else if(date("n", $Q2startdate)==4){
			$Q2quart = 2;
		}else if(date("n", $Q2startdate)==7){
			$Q2quart = 3;
		}else if(date("n", $Q2startdate)==10){
			$Q2quart = 4;
		}
	}
		
}

$cols=8;
if($type=="quarter")
{
	if($Q2==true)
	{
		$cols=20;
	}
	else { 
		$cols=12;
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Fundraisers - Reports</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>

<script language="javascript">


function getSelected(){
	i=0;
	selectedAr = new Array();
	while(document.forms[0]['n'+i]!=null){
		if(document.forms[0]['check'+i].checked==true){
			id=document.forms[0]['n'+i].value;
			selectedAr.push(id);
		}
		i++;
	}
	return selectedAr;
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

function validateDateArray(selectedAr){
	found=false;
	i=0;
	while(document.forms[0]['n'+i]!=null){
		if(document.forms[0].unposted.checked==true && document.forms[0]['sentStat'+i].value=="" && document.forms[0]['check'+i].checked==true){
			found=true;
		}
		i++;
	}
	if(found==true){
		alert('There are chosen items that are already marked as Not Sent');
		return false;
	}else{
		return true;
	}
}

function updatePaidDate(){
	selectedAr = getSelected();
	if(selectedAr.length>0){
		result=validateDateArray(selectedAr);
		if(result==true){
			if(selectedAr.length==0){
				alert('you must select items to change their sent date');
			}else{
				selections = makeSelections(selectedAr);
				qandy='&quart='+document.forms[0].quarter.value+'&yr='+document.forms[0].year.value;
				sendString = document.forms[0].sendString.value;
				//returnIds = '&returnIds='+document.forms[0].returnIds.value;
				type = '&type='+document.forms[0].type.value;

				var	Q2qandy='';
				if(document.forms[0].Q2.value==1)
				{	// Q2 is valid.
					Q2qandy='&Q2quart='+document.forms[0].Q2quarter.value+'&Q2yr='+document.forms[0].Q2year.value;

					updateDate='day='+document.forms[0].dayposted.value+'&month='+document.forms[0].monthposted.value+'&year='+document.forms[0].yearposted.value;
					location.href='fundraisers_actions.php?action=updatereport&'+updateDate+'&id='+selections+qandy+sendString+type+Q2qandy+'&page=<?=$page?>';
				}
				else {
					if(document.forms[0].unposted.checked==true){
						location.href='fundraisers_actions.php?action=updatereport&unsent=true&id='+selections+qandy+sendString+type+Q2qandy+'&page=<?=$page?>';
					}else{
						updateDate='day='+document.forms[0].dayposted.value+'&month='+document.forms[0].monthposted.value+'&year='+document.forms[0].yearposted.value; 
						location.href='fundraisers_actions.php?action=updatereport&'+updateDate+'&id='+selections+qandy+sendString+type+Q2qandy+'&page=<?=$page?>';
					}
				}
			}
		}
	}else{
		alert('You must select at least one Fundraiser');
	}
}

function viewDetails(){
	sendString = document.forms[0].sendString.value;
	//returnIds = '&returnIds='+document.forms[0].returnIds.value;
	type = '&type='+document.forms[0].type.value;
	selectedAr = getSelected();
	selections = makeSelections(selectedAr);
	qandy="";
	if(document.forms[0].type.value=="quarter"){
		qandy='&quart='+document.forms[0].quarter.value+'&yr='+document.forms[0].year.value;
		if(document.forms[0].Q2.value==1)
		{	// Q2 is valid.
			qandy = qandy + '&Q2quart='+document.forms[0].Q2quarter.value+'&Q2yr='+document.forms[0].Q2year.value;
		}
	}
	if(selectedAr.length==0){
		alert('you must select at least one item to view reports');
	}else{
 		location.href='fundraisers_reports_frameset.php?id='+selections+sendString+type+qandy+'&page=<?=$page?>';
	}
}

function disableDates(){
	if(document.forms[0].unposted.checked==true){
		way=true;
	}else{
		way=false;
	}
	document.forms[0].dayposted.disabled=way;
	document.forms[0].monthposted.disabled=way;
	document.forms[0].yearposted.disabled=way;
}

function deselectItems(){
	i=0;
	while(document.forms[0]['n'+i]!=null){
		document.forms[0]['check'+i].checked=false;
		i++;
	}
}

function selectItems(){
	i=0;
	while(document.forms[0]['n'+i]!=null){
		document.forms[0]['check'+i].checked=true;
		i++;
	}
}

function selectItemsGT(value){
	i=0;
	while(document.forms[0]['n'+i]!=null){
	    if(document.forms[0]['com_'+i].value > value) {
		  document.forms[0]['check'+i].checked=true;
		} else {
		  document.forms[0]['check'+i].checked=false;
		}
		i++;
	}
}

function jump_page(jump_to){
 var type = '&type='+document.forms[0].type.value;
 location.href="<?=$_SERVER['PHP_SELF']?>?<?=$sendString?>"+type+"&page="+jump_to
}
</script>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<form action="" method="post">
			<?
			if($type=="quarter"){
				if($Q2)
				{
					?>
					<input type="hidden" name="Q2quarter" value="<?=$Q2quart;?>">
					<input type="hidden" name="Q2year" value="<?=$Q2yr;?>">
					<input type="hidden" name="Q2" value=1>
					<?
				}
				else {
					?><input type="hidden" name="Q2" value=0>
					<?
				}
				?>
				<input type="hidden" name="quarter" value="<?=$quart;?>">
				<input type="hidden" name="year" value="<?=$yr;?>">
				<?
			}?>
			<input type="hidden" name="sendString" value="<?=$sendString;?>">
			<input type="hidden" name="type" value="<?=$type;?>">
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
					 <td class="admintext"><strong>Fundraising Reports</strong></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<?
				if($type=="quarter"){
					if($Q2==TRUE)
					{
						// two quarters per column

						?>
						<tr class="Q1admintext">
							 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
							 <td class="Q1admintext" colspan=3><strong>Quarter A: <? echo $quart;?> Year: <? echo $yr;?></strong></td>
						</tr>
						<tr>
							 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
						</tr>
						<tr class="Q2admintext">
							 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
							 <td class="Q2admintext" colspan=3><strong>Quarter B: <? echo $Q2quart;?> Year: <? echo $Q2yr;?></strong></td>
						</tr>
						<tr>
							 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
						</tr>
						<?
					}
					else {
						?>
						<tr>
							 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
							 <td class="admintext"><strong>Quarter: <? echo $quart;?> Year: <? echo $yr;?></strong></td>
						</tr>
						<tr>
							 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
						</tr>
						<?
					}
				}
				?>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					 <td align="center" class="admintext">
					   <input type="button" name="back" value="&lt; Back" onClick="location.href='fundraisers.php'">
						<input type="button" name="jumpPrev" value="Prev" onClick="jump_page(<?=$prev_page?>);">
					   <select name="page_jump" onChange="jump_page(this.value);">
					   <?
					    for($i=1;$i<=$pages;$i++){ ?>
				    	  <option value="<?=$i?>" <?=$i==$page?'selected':''?>><?=(($i-1)*$per_page)+1?>-<?=$i*$per_page?></option>
					   <?}?>
					   </select>
				      <input type="button" name="jumpNext" value="Next" onClick="jump_page(<?=$next_page?>);">
			      </td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td colspan="3">
						 <table cellpadding="0" cellspacing="0" border="0" width="100%">
						 	<tr bgcolor="#FFFFFF">
								<td colspan="<?=$cols;?>"><img src="../images/spacer_trans.gif" height="2" width="100%" border="0"></td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>

						<?
if($Q2)
{
	?>
							<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
								<td align="left"><strong>Fundraiser</strong></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
<!--
								<td nowrap align="left" width=60 class="Q1admintext"><strong>Orders</strong></td>
								<td class="Q1admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
// -->
								<td nowrap align="left" width=60 class="Q1admintext"><strong>Total (inc)</strong></td>
								<td class="Q1admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td nowrap align="left" width=60 class="Q1admintext"><strong>GST</strong></td>
								<td class="Q1admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td nowrap align="left" width=130 class="Q1admintext"><strong>Sent Status</strong></td>

								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
<!--
								<td nowrap align="left" width=60 class="Q2admintext"><strong>Orders</strong></td>
								<td class="Q2admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
// -->
								<td nowrap align="left" width=60 class="Q2admintext"><strong>Total (inc)</strong></td>
								<td class="Q2admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td nowrap align="left" width=60 class="Q2admintext"><strong>GST</strong></td>
								<td class="Q2admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td nowrap align="left" width=130 class="Q2admintext"><strong>Sent Status</strong></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td nowrap align="left" width=130 style="background: white;"><strong>Cheque</strong></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td nowrap align="left" width=100><strong>Grand Total</strong></td>



							</tr>
							<tr>
								 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
	<?

}
else {
	?>
							<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
								<td align="left"><strong>Fundraiser</strong></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><strong>Orders</strong></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><strong>Grand Total (inc)</strong></td>
								<? if($type=="quarter"){?>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><strong>Sent Status</strong></td>
								<? }?>
							</tr>
							<tr>
								 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
	<?
}

// display schools.
						if($Q2==TRUE)
						{

							$i=0;
							while($qdata = mysql_fetch_array($result)){
								
									$GST = $commission = $Q2GST = $Q2commission = 0;
								
								
									$grandTotal = 0;
									$result2 = getCommissionRecordsSummary($qdata["idnumber"], $startdate, $enddate);
									$commission = getCommissionFromRecSummary($result2);
									$sentStat = getSentStat($qdata["id"], $yr, $quart);


									$Q2result = getCommissionRecordsSummary($qdata["idnumber"], $Q2startdate, $Q2enddate);
									$Q2commission = getCommissionFromRecSummary($Q2result);
									
									$Q2sentStat = getSentStat($qdata["id"], $Q2yr, $Q2quart);

									// if fundraiser is registered for GST, add GST.
									if($qdata['gst']==1)
									{
										$GST = $commission * GST;
										$commission = $commission * ( 1 + GST );
										$Q2GST = $Q2commission * GST;
										$Q2commission = $Q2commission * ( 1 + GST );
									}
									
									if(!$sentStat && !$Q2sentStat){$grandTotal += $commission;}
									if(!$Q2sentStat){$grandTotal += $Q2commission;}

							if($gt==false || $grandTotal > $gt) {
							?>
							<input type="hidden" name="n<? echo $i;?>" value="<? echo $qdata["id"];?>">
							<input type="hidden" name="sentStat<? echo $i;?>" value="<? echo $sentStat;?>">
							<input type="hidden" name="com_<? echo $i;?>"value="<?=$grandTotal?>" >
							<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
								<td align="left">[<?=$qdata['idnumber'];?>] <? echo $qdata["fname"];?></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
<!--
								<td align="left" class="Q1admintext"><? echo mysql_num_rows($result2);?></td>
								<td class="Q1admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
//-->
								<td align="left" class="Q1admintext"><? echo "$".sprintf("%01.2f", $commission);?></td>
								<td class="Q1admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left" class="Q1admintext">$<?=sprintf("%01.2f", $GST);?></td>
								<td class="Q1admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>

								<td align="left" class="Q1admintext">
								<?
								if($sentStat){
									echo "<font color=\"#006600\">Sent: ".date("d M Y", $sentStat)."</font>";
								}else{
									?><font color="#990000">Not Sent</font><?
									//$grandTotal += $commission;
								}
									?>
									</td>
<!--
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left" class="Q2admintext"><? echo mysql_num_rows($Q2result);?></td>
//-->
								<td class="Q2admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left" class="Q2admintext"><? echo "$".sprintf("%01.2f", $Q2commission);?></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left" class="Q2admintext">$<?=sprintf("%01.2f", $Q2GST);?></td>

								<td class="Q2admintext"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left" class="Q2admintext">
								<?
								if($Q2sentStat){
									echo "<font color=\"#006600\">Sent: ".date("d M Y", $Q2sentStat)."</font>";
								}else{
									?><font color="#990000">Not Sent</font><?
									//$grandTotal += $Q2commission;
								}
									?>
									</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td style="background: white;"></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td>$<?=sprintf("%01.2f", $grandTotal);?></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="right"><input type="checkbox" name="check<? echo $i;?>"></td><?
								
								$i++;
								$totalcommission+= $grandTotal;
							}
						  }
						}
						else {
							$i=0;
							while($qdata = mysql_fetch_array($result)){
									$commission = 0;
									$result2 = getCommissionRecords($qdata["idnumber"], $startdate, $enddate);
									$commission = getCommissionFromRec($result2);

									// if fundraiser is registered for GST, add GST.
									if($qdata['gst']==1)
									{
										$commission = $commission * ( 1 + GST );
									}
									
						if($gt==false || $commission > $gt) {
						
									if($type=="quarter"){
										$sentStat = getSentStat($qdata["id"], $yr, $quart);
									}
						          ?>
							<input type="hidden" name="n<? echo $i;?>" value="<? echo $qdata["id"];?>">
							<input type="hidden" name="sentStat<? echo $i;?>" value="<? echo $sentStat;?>">
							<input type="hidden" name="com_<? echo $i;?>"value="<?=$commission?>" >
							<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
								<td align="left">[<?=$qdata['idnumber'];?>] <? echo $qdata["fname"];?></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><? echo mysql_num_rows($result2);?></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><? echo "$".sprintf("%01.2f", $commission);?></td>
								<? if($type=="quarter"){?>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left">
								<? 	if($sentStat){
										echo "<font color=\"#006600\">Sent: ".date("d M Y", $sentStat)."</font>";
									}else{?>
										<font color="#990000">Not Sent</font><?
									}
								?>
								</td>
								<? }?>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="right"><input type="checkbox" name="check<? echo $i;?>"></td><?
								
								$i++;
								$totalcommission+= $commission;
							}
						  }
						}



?>
							<tr>
								 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td colspan="<?=($cols-3);?>" align="right" class="admintext"><strong>Total:</strong>&nbsp;&nbsp;</td>
								<td align="left"><strong><? echo "$".sprintf("%01.2f", $totalcommission);?></strong></td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr>
								<td colspan="<?=$cols;?>" align="right" class="admintext">
									<table cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td align="left" valign="bottom"><strong>With selected:</strong></td>
											<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
											<?
										if($type=="quarter"){
											?>
											<td align="left" valign="bottom">
											<select name="dayposted">
											<?
											for($k=1; $k<32; $k++){ ?>
												<option value="<? echo $k;?>"<? if(date("d")==$k){?> selected<? }?>><? echo $k;?></option>
												<?
											}
											?></select>
										  <select name="monthposted">
											<? for($k=1; $k<13; $k++){ ?>
											<option value="<? echo $k;?>"<? if(date("m")==$k){?> selected<? }?>><? echo $k;?></option>
											<? }?>

										  </select>
										  <select name="yearposted">
											<? for($k=4; $k<10; $k++){ ?>
											<option value="<? echo $k+2000;?>"<? if(date("Y")==($k+2000)){?> selected<? }?>><? echo $k+2000;?></option>
											<? }?>

										  </select>
											<?if(!$Q2)
											{ ?><br>
										  <input type="checkbox" name="unposted" onClick="disableDates();"> Mark as Unsent<?
											}
											else { ?><input type=hidden name="unposted" value="false"><?
											}
											?><br>
										  <input type="button" value="update sent status &gt;" onClick="updatePaidDate();"></td>

										  <?
										}
										?>
									  <td><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
									  <td valign="bottom"><input type="button" name="viewdetails" value="view details" onClick="viewDetails();"></td>
									  <td><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
									  <?
										if($type=="quarter"){?>
											<td valign="bottom"><img src="../images/arrow_large.gif" height="60" width="30" border="0"></td>
											<?
										}else{
											?>
											<td valign="bottom"><img src="../images/arrow.gif" height="30" width="30" border="0"></td>
											<?
										}
										?>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
							</tr>
							<tr>
								 <td colspan="<?=$cols;?>"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td colspan="<?=($cols-1);?>" align="right" class="admintext">
								<input type="button" name="deselect" value="Deselect All" onClick="deselectItems();">&nbsp;<input type="button" name="select0" value="Select > $0.00" onClick="selectItemsGT(0);">&nbsp;<input type="button" name="select20" value="Select > $20.00" onClick="selectItemsGT(20);">&nbsp;<input type="button" name="selectall" value="Select All" onClick="selectItems();">&nbsp;</td>
							</tr>
							<tr>
								 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
						 </table>
					 </td>
				</tr>
			</table>
			</form>
		</tr>
	</table>
</body>
</html>
