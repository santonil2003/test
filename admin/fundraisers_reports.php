<?
include("../common_db.php");
linkme();
session_start();
$user_section_id = 2;
require_once("./security.php");
check_access($user_section_id);

/*
$items = split(";",$_GET["id"]);

$query = "SELECT * FROM fundraisers WHERE id=";
for($i=0; $i<count($items); $i++){
	if($i!=0){
		$query.=" OR id=";
	}
	$query.=$items[$i];
}

$result = mysql_query($query);
if(!$result) error_message(sql_error()); 
*/

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

function get_radio_value(name)
{
  var rad_array = document.getElementsByName(name);
  var rad_val = false;
  for (var i=0; i < rad_array.length; i++)
  {
    if (rad_array[i].checked)
    {
      rad_val = rad_array[i].value;
    }
  }
  return rad_val; 
}

function viewQuarter(){
	thisF=document.forms[0];

	startDay=1;
	endYear = startYear = thisF.year.value;
	greater = get_radio_value('gtq');
	if(thisF.quarter[thisF.quarter.selectedIndex].value==1){
		startMonth=0;
		endMonth=2;
	}else if(thisF.quarter[thisF.quarter.selectedIndex].value==2){
		startMonth=3;
		endMonth=5;
	}else if(thisF.quarter[thisF.quarter.selectedIndex].value==3){
		startMonth=6;
		endMonth=8;
	}else if(thisF.quarter[thisF.quarter.selectedIndex].value==4){
		startMonth=9;
		endMonth=11;
	}
	
	endDay=31;
	testDate = new Date(endYear, endMonth, endDay, 0, 0);
	while(testDate.getMonth()!=endMonth){
		endDay--;
		testDate = new Date(endYear, endMonth, endDay, 0, 0);
	}


	// setup second quarter selection
	var Q2String = "";
	if(thisF.quarter2[thisF.quarter2.selectedIndex].value>0 && thisF.year2[thisF.year2.selectedIndex].value>0)
	{
		Q2startDay=1;
		Q2endYear = Q2startYear = thisF.year2.value;
		if(thisF.quarter2[thisF.quarter2.selectedIndex].value==1){
			Q2startMonth=0;
			Q2endMonth=2;
		}else if(thisF.quarter2[thisF.quarter2.selectedIndex].value==2){
			Q2startMonth=3;
			Q2endMonth=5;
		}else if(thisF.quarter2[thisF.quarter2.selectedIndex].value==3){
			Q2startMonth=6;
			Q2endMonth=8;
		}else if(thisF.quarter2[thisF.quarter2.selectedIndex].value==4){
			Q2startMonth=9;
			Q2endMonth=11;
		}
		
		Q2endDay=31;
		Q2testDate = new Date(Q2endYear, Q2endMonth, Q2endDay, 0, 0);
		while(Q2testDate.getMonth()!=Q2endMonth){
			Q2endDay--;
			Q2testDate = new Date(Q2endYear, Q2endMonth, Q2endDay, 0, 0);
		}
		Q2String = '&Q2startDay='+Q2startDay+'&Q2startMonth='+Q2startMonth+'&Q2startYear='+Q2startYear+'&Q2endDay='+Q2endDay+'&Q2endMonth='+Q2endMonth+'&Q2endYear='+Q2endYear;
	}
	if(thisF.quarter2[thisF.quarter2.selectedIndex].value == thisF.quarter[thisF.quarter.selectedIndex].value &&
		thisF.year2[thisF.year2.selectedIndex].value == thisF.year[thisF.year.selectedIndex].value)
	{
		self.alert('Please select different quarters.');
	}
	else {
	   document.send.action = 'fundraisers_showreports.php?_gt='+greater+'&startDay='+startDay+'&startMonth='+startMonth+'&startYear='+startYear+'&endDay='+endDay+'&endMonth='+endMonth+'&endYear='+endYear+'&id='+thisF.id.value+'&type=quarter'+Q2String;
		document.send.submit();
	}
}

function viewDefined(){
	thisF=document.forms[0];
	startDay=thisF.startDay.value;
	startMonth=thisF.startMonth.value;
	startYear=thisF.startYear.value;
	endDay=thisF.endDay.value;
	endMonth=thisF.endMonth.value;
	endYear=thisF.endYear.value;
	startDate = new Date(startYear,startMonth,startDay,0,0);
	endDate = new Date(endYear,endMonth,endDay,0,0);
	greater = get_radio_value('gt');
	if(endDate<startDate){
		alert('The end date is earlier than the start date');
	}else{
		location.href='fundraisers_showreports.php?gt='+greater+'&startDay='+startDay+'&startMonth='+startMonth+'&startYear='+startYear+'&endDay='+endDay+'&endMonth='+endMonth+'&endYear='+endYear+'&id='+thisF.id.value+'&type=defined';
	}
}

</script>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<form action="" method="post">
			<input type="hidden" name="id" value="<? echo $_GET["id"];?>">
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
					 <td class="admintext"><strong>Fundraising Reports - Select report type</strong></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					 <td align="center" class="admintext">
					 <input type="button" name="back" value="&lt; Back" onClick="location.href='fundraisers.php'"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td bgcolor="#FFFFFF" colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					 <td class="admintext"><b>Quarterly report</b> (recorded)</td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td colspan="3" align="left">
						 <table cellpadding="0" cellspacing="0" border="0">
						 	<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="1" width="20" border="0"></td>
								<td align="right">Quarter A:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td><select name="quarter">
									<option value="1">Q1 - Jan to Mar</option>
									<option value="2">Q2 - Apr to Jun</option>
									<option value="3">Q3 - Jul to Sep</option>
									<option value="4">Q4 - Oct to Dec</option>
								</select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="20" border="0"></td>
								<td align="right">Year:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td>
									<? 
									$query = "SELECT UNIX_TIMESTAMP(Min(started)) as started FROM orders";
									$result = mysql_query($query);
									if(!$result) error_message(sql_error());
									while($qdata = mysql_fetch_array($result)){
										$firstYear = $qdata["started"];
									}
									$firstYear = intval(date("Y",$firstYear));
									$nowYear = date("Y");
									?><select name="year"><?
									for($i=$firstYear; $i<=$nowYear; $i++){
										?><option value="<? echo $i;?>" <?=($i==(int)date("Y"))?"SELECTED":"";?>><? echo $i;?></option><?
									} ?></select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td>Greater than $0.00 <input type="radio" name="gtq" id="gtq" value="0.00"> or $20.00 <input type="radio" name="gtq" id="gtq" value="20.00"> <input type="button" value="go &gt;" onClick="viewQuarter();"></td>
							</tr>
						 </table>
					</td>
				</tr>
				<tr>
					 <td colspan="3" align="left">
						 <table cellpadding="0" cellspacing="0" border="0">
						 	<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="1" width="20" border="0"></td>
								<td align="right">Quarter B:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td><select name="quarter2">
									<option value="0">None</option>
									<option value="1">Q1 - Jan to Mar</option>
									<option value="2">Q2 - Apr to Jun</option>
									<option value="3">Q3 - Jul to Sep</option>
									<option value="4">Q4 - Oct to Dec</option>
								</select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="20" border="0"></td>
								<td align="right">Year:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td>
									<? 
									$query = "SELECT UNIX_TIMESTAMP(Min(started)) as started FROM orders";
									$result = mysql_query($query);
									if(!$result) error_message(sql_error());
									while($qdata = mysql_fetch_array($result)){
										$firstYear = $qdata["started"];
									}
									$firstYear = intval(date("Y",$firstYear));
									$nowYear = date("Y");
									?><select name="year2">
									<option value="0">None</option><?
									for($i=$firstYear; $i<=$nowYear; $i++){
										?><option value="<? echo $i;?>"><? echo $i;?></option><?
									} ?></select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td>&nbsp;</td>
							</tr>
						 </table>
					</td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td bgcolor="#FFFFFF" colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					 <td class="admintext"><b>By-date report</b> (not recorded)</td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td colspan="3">
						 <table cellpadding="0" cellspacing="0" border="0">
						 	<tr class="admintext">
								<td><img src="../images/spacer_trans.gif" height="1" width="20" border="0"></td>
								<td align="right">Start:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td><select name="startDay">
								<? for($i=0; $i<31;$i++){?>
									<option value="<? echo $i+1;?>"><? echo $i+1;?></option>
								<? }?>
								</select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="2" border="0"></td>
								<td><select name="startMonth">
								<? for($i=0; $i<12;$i++){?>
									<option value="<? echo $i;?>"><? echo $months[$i];?></option>
								<? }?>
								</select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="2" border="0"></td>
								<td><select name="startYear"><?
								for($i=$firstYear; $i<=$nowYear; $i++){
									?><option value="<? echo $i;?>"><? echo $i;?></option><?
								} ?></select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="20" border="0"></td>
								<td align="right">End:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td><select name="endDay">
								<? for($i=0; $i<31;$i++){?>
									<option value="<? echo $i+1;?>"><? echo $i+1;?></option>
								<? }?>
								</select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="2" border="0"></td>
								<td><select name="endMonth">
								<? for($i=0; $i<12;$i++){?>
									<option value="<? echo $i;?>"><? echo $months[$i];?></option>
								<? }?>
								</select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="2" border="0"></td>
								<td><select name="endYear"><?
								for($i=$firstYear; $i<=$nowYear; $i++){
									?><option value="<? echo $i;?>"><? echo $i;?></option><?
								} ?></select></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td>Greater than $0.00 <input type="radio" name="gt" value="0"> or $20.00 <input type="radio" name="gt" value="20"> <input type="button" value="go &gt;" onClick="viewDefined();"></td>
							</tr>
						 </table>
					</td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					 <td bgcolor="#FFFFFF" colspan="3"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
			</table>
			</form>
		</tr>
	</table>
	<form name="send" action="" method="post">
			  <input type="hidden" name="ids" value="<? echo $_POST["ids"];?>">
	</form>
</body>
</html>
