<?
include("../common_db.php");
include("fundraisers_functions.php");

$items = split(";",$_GET["id"]);
if(!$_GET["chosenId"]){
	$chosenId=0;
}else{
	$chosenId=$_GET["chosenId"];
}

$sendString = getSendString();

linkme();
session_start();
$user_section_id = 2;
require_once("./security.php");
check_access($user_section_id);

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


for($i=0; $i<count($items); $i++){
	$query = "SELECT * FROM fundraisers WHERE id=".$items[$i];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$items[$i] = array($items[$i], $qdata["fname"]);
	}
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
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

function goBack(){
	sendString = document.forms[0].sendString.value;
	//returnIds = document.forms[0].returnIds.value;
	id = document.forms[0].id.value;
	type = 'type='+document.forms[0].type.value;
   //parent.body.send.action = 'fundraisers_showreports.php?id='+returnIds+sendString+type+'&page=<? echo $_GET["page"];?>';
   //parent.body.send.submit();
	//parent.location.href='fundraisers_showreports.php?id='+returnIds+sendString+type+'&page=<? echo $_GET["page"];?>';
	parent.location.href='fundraisers_showreports.php?'+type+sendString+'&page=<? echo $_GET["page"];?>';
}


function changeReport(){
	for(i=0; i<document.forms[0].fundraiserChooser.length; i++){
		if(document.forms[0].fundraiserChooser[i].selected==true){
			newChosen=i;
			break;
		}
	}
	sendString = document.forms[0].sendString.value;
	returnIds = document.forms[0].returnIds.value;
	id = document.forms[0].id.value;
	type = '&type='+document.forms[0].type.value;
	parent.viewer.location.href='fundraisers_reports_detail.php?id='+document.forms[0].fundraiserChooser.value+sendString;
	location.href='fundraisers_reports_control.php?chosenId='+newChosen+sendString+'&returnIds='+returnIds+'&id='+id+type+'&page=<? echo $_GET["page"];?>';
}
</script>


<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" bgcolor="#5D7EB9">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td width="10"><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td width="30"><input type="button" value="&lt; back" onClick="goBack();"></td>
			<td width="10"><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td align="center">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext">Currently viewing: <strong><? echo $items[$chosenId][1];?></strong></td>
					</tr>
					<tr>
						 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
<!--
					<tr class="admintext">
						 <td><? echo "From: <strong>".date("d M Y", $startdate)."</strong> To: <strong>".date("d M Y", $enddate);?></strong></td>
					</tr>
					<tr>
						 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
// -->
					<form name="control">
<?
if($Q2)
{
	?>
	<input type="hidden" name="Q2quart" value="<? echo $_GET["Q2quart"];?>">
	<input type="hidden" name="Q2yr" value="<? echo $_GET["Q2yr"];?>">
	<?
}

?>
	<input type="hidden" name="quart" value="<? echo $_GET["quart"];?>">
	<input type="hidden" name="yr" value="<? echo $_GET["yr"]?>">
					<input type="hidden" name="returnIds" value="<? echo $_GET["returnIds"];?>">
					<input type="hidden" name="type" value="<? echo $_GET["type"]?>">
					<input type="hidden" name="sendString" value="<? echo $sendString;?>">
					<input type="hidden" name="id" value="<? echo $_GET["id"];?>">
				
					<? if(count($items)>1){?>
					<tr>
						<td class="admintext">Change to:&nbsp;
						<select name="fundraiserChooser">
						<?
						for($i=0; $i<count($items); $i++){
							?><option value="<? echo $items[$i][0];?>"<? if($chosenId==$i){?> selected<? }?>><? echo $items[$i][1];?></option><?
						}
						?>
						</select>&nbsp;
						<input type="button" value="view &gt;" onClick="changeReport();">
						</td>
					</tr>
					<tr>
						 <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<? }?>
					<tr>
						 <td><input type="button" value="print current report" onClick="parent.viewer.focus(); parent.viewer.print();">&nbsp;<img src="../images/arrow_down.gif" width="30" height="30" border="0"></td>
					</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
