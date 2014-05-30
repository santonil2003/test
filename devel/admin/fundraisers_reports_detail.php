<?
$includeabove=true;
include("../useractions.php");
include("fundraisers_functions.php");
linkme();
session_start();
$user_section_id = 2;
require_once("./security.php");
check_access($user_section_id);

$startdate = mktime(0,0,0,$_GET["startMonth"]+1,$_GET["startDay"],$_GET["startYear"]);
$enddate = mktime(0,0,0,$_GET["endMonth"]+1,$_GET["endDay"],$_GET["endYear"]);

$Q2=FALSE;
if(isset($_GET['Q2startYear'])  && isset($_GET['Q2startMonth']) && isset($_GET['Q2startDay']) && 
		isset($_GET['Q2endYear']) && isset($_GET['Q2endMonth']) && isset($_GET['Q2endDay']))
{
	$Q2=TRUE;
	$Q2startdate = mktime(0,0,0, $_GET["Q2startMonth"]+1, $_GET["Q2startDay"], $_GET["Q2startYear"]);
	$Q2enddate   = mktime(0,0,0, $_GET["Q2endMonth"]+1, $_GET["Q2endDay"], $_GET["Q2endYear"]);
}

$query = "SELECT * FROM fundraisers WHERE id=".$id = $_GET["id"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());
	
while($qdata=mysql_fetch_array($result)){
	$fname = stripslashes($qdata["fname"]);
	$idnumber = $qdata["idnumber"];
	$address = $qdata["address"];
	$deladdress = $qdata["deladdress"];
	$contactname = $qdata["contactname"];
	$contactphone = $qdata["contactphone"];
	$contactcheque = $qdata["contactcheque"];
	$abn = $qdata["abn"];
	$abnexemption = $qdata["abnexemption"];
	$gst = $qdata["gst"];
	$status = $qdata["status"];
	$percentage = $qdata["percentage"];
}

$result = getCommissionRecords($idnumber, $startdate, $enddate);
if($Q2)
{
	$Q2result =  getCommissionRecords($idnumber, $Q2startdate, $Q2enddate);
}



if($abn=="" && $gst==0){
	$addgst=false;
	if($abnexemption==0){
		$withholding=true;
	}
}else if($gst==0){
	$addgst=false;
}else{
	$addgst=true;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="150" width="10" border="0"></td>
			<td colspan="12" align="right"><img src="../images/bwlogoplain.jpg" height="175" width="159"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="12" align="right" class="admintext">PO Box 8775<br>Wagga Wagga <br>NSW 2650<br>Australia</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="5" class="admintext"><strong><? if($addgst==true){?>RECIPIENT CREATED TAX INVOICE<? }else{?>INVOICE<? }?></strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="20" width="10" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="5" class="admintext"><strong>Date Printed: <? echo date("d M Y");?></strong></td>
		</tr>

		<tr>
			<td><img src="../images/spacer_trans.gif" height="20" width="10" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="5" class="admintext"><?
if($Q2)
{
	$sentStat = getSentStat($_GET["id"], $_GET['yr'], $_GET['quart']);
	$flag=false;
	if(!$sentStat)
	{
		$flag=true;
		?><strong>From: <? echo date("d M Y", $startdate);?> To:<? echo date("d M Y", $enddate);?><?

	}
	$Q2sentStat = getSentStat($_GET["id"], $_GET['Q2yr'], $_GET['Q2quart']);
	if(!$Q2sentStat)
	{
		if($flag)
			print "<br /><strong>&</strong><br />";
		?><strong>From: <? echo date("d M Y", $Q2startdate);?> To:<? echo date("d M Y", $Q2enddate);?><?
	}
	

}
else {
	?><strong>From:<? echo date("d M Y", $startdate);?> To:<? echo date("d M Y", $enddate);?><?
}

?></strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="20" width="10" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="9" class="admintext">
			<? if($contactcheque!=''){ ?>
			<strong><? echo stripslashes($contactcheque);?></strong><br>
			<? } ?>
			<strong><? echo stripslashes($fname);?></strong><br><? echo stripslashes($address); if($abn!=""){?><br><br><strong>ABN:<? echo $abn; } ?></strong><? echo "<br><br>Code: ".$idnumber;?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
		</tr>
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td width="100"><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td width="50"><img src="../images/spacer_trans.gif" height="1" width="50" border="0"></td>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td width="100"><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td width="100"><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td width="50"><img src="../images/spacer_trans.gif" height="1" width="50" border="0"></td>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td width="100"><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
		</tr>
		<tr class="admintext">
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td valign="top" ><strong>Date</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td valign="top" ><strong>Order Id</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td valign="top" ><strong>Order Name</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td valign="top" ><strong>Item Ordered</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td valign="top" ><strong>Total</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td valign="top" ><strong>Commission (<?=sprintf("%01.2f", $percentage); ?>%)</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="11"><img src="../images/black_dot.gif" height="1" width="550" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<?
		$totalitems=0;

		while($qdata = mysql_fetch_array($result)){
//			$sentStat = getSentStat($_GET["id"], $_GET['yr'], $_GET['quart']);
			if(($Q2 && !$sentStat) || !$Q2)
			{
				//$comm = getCommission($qdata["quantdesc"],$qdata["type"], $qdata);
				$comm = $qdata["price"]*($percentage/100);
				$totalitems+=$mult;
				$totalcomm+=$comm;
				if($qdata["type"]==6) $mult*=2;?>
				<tr class="admintext">
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td><? echo date("d M Y", $qdata["finished"]);?></td>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td><? echo $qdata["orderid"]+1000;?></td>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td><? echo $qdata["firstname"]." ".$qdata["surname"];?></td>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td><? echo getLabelType($qdata["type"]);?></td>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td>$<? echo sprintf("%01.2f", $qdata["price"]);?></td>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td><? echo "$".sprintf("%01.2f", $comm);?></td>
				</tr>
				<?
			}
		}

		if($Q2)
		{  
		
			while($qdata = mysql_fetch_array($Q2result)){
				if(!$Q2sentStat)
				{
					//$comm = getCommission($qdata["quantdesc"],$qdata["type"], $qdata);
				   $comm = $qdata["price"]*($percentage/100);
					$totalitems+=$mult;
					$totalcomm+=$comm;
					if($qdata["type"]==6)
						$mult*=2;
					?>
					<tr class="admintext">
						<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
						<td><? echo date("d M Y", $qdata["finished"]);?></td>
						<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
						<td><? echo $qdata["orderid"]+1000;?></td>
						<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
						<td><? echo $qdata["firstname"]." ".$qdata["surname"];?></td>
						<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
						<td><? echo getLabelType($qdata["type"]);?></td>
						<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
						<td>$<? echo sprintf("%01.2f", $qdata["price"]);?></td>
						<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
						<td><? echo "$".sprintf("%01.2f", $comm);?></td>
					</tr>
					<?
				}
			}
		}


		$gst = round(($totalcomm*.1)*100)/100;


		
		if($addgst==true){
			$grandtotal = round(($totalcomm*1.1)*100)/100;
		}else if($withholding==true && $totalcomm>50){
			$withholdingam = round(($totalcomm*.485)*100)/100;
			$grandtotal = $totalcomm-$withholdingam;
		}else{
			$grandtotal = $totalcomm;
		}
		?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="11"><img src="../images/black_dot.gif" height="1" width="550" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr class="admintext">
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="7"><strong>TOTAL</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td><!--<strong><? echo $totalitems;?></strong>--></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td><strong><? echo "$".sprintf("%01.2f", $totalcomm);?></strong></td>
		</tr>
		<? if($addgst==true){?>
		<tr class="admintext">
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="9"><strong>GST (10%)</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td><strong><? echo "$".sprintf("%01.2f", $gst);?></strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<? }else if($withholding==true && $totalcomm>50){?>
		<tr class="admintext">
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="9"><strong>WITHHOLDING TAX (48.5%)</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td><strong><? echo "$".sprintf("%01.2f", $withholdingam);?></strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<? }?>
		
		<tr class="admintext">
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="9"><strong>GRAND TOTAL</strong></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td><strong><? echo "$".sprintf("%01.2f", $grandtotal);?></strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td colspan="7" class="admintext">Thankyou for your support.</td>
		</tr>
	</table>
	<script language="javascript"> 
	  var msg = '<?=$_GET['msg'];?>';
	
	  switch(msg) {
	    case '1':alert('Email Succsesfully Sent');break;
	    case '2':alert('There is no email address set for that fundraiser');break;
	    default:break;
     }
     
  </script>
</body>
</html>
