<?
include("../common_db.php");


linkme();
session_start();
$user_section_id = 2;
require_once("./security.php");
check_access($user_section_id);
if($_GET["error"]!=""){
	$id = $_GET["id"];
	$fname = stripslashes($_GET["fname"]);
	$idnumber = $_GET["idnumber"];
	$address = $_GET["address"];
	$deladdress = $_GET["deladdress"];
	$contactname = $_GET["contactname"];
	$contactphone = $_GET["contactphone"];
	$abn = $_GET["abn"];
	$abnexemption = $_GET["abnexemption"];
	$gst = $_GET["gst"];
	$status = $_GET["status"];
	$datejoined = $_GET["datejoined"];
}else if(isset($_GET["id"])){

	$query = "SELECT * FROM fundraisers WHERE id=".$_GET["id"];

	$result = mysql_query($query);
	if(!$result) error_message(sql_error());

	while($qdata = mysql_fetch_array($result)){
		$id = $qdata["id"];
		$fname = stripslashes($qdata["fname"]);
		$idnumber = $qdata["idnumber"];
		$address = $qdata["address"];
		$deladdress = $qdata["deladdress"];
		$contactname = $qdata["contactname"];
		$contactphone = $qdata["contactphone"];
		$abn = $qdata["abn"];
		$abnexemption = $qdata["abnexemption"];
		$gst = $qdata["gst"];
		$status = $qdata["status"];
		$datejoined = $qdata["date_joined"];
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Fundraisers - Add or Edit Fundraiser</title>
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
	
	function clearAbn(){
		tF=document.forms[0];
		if(tF.abnexemption.checked==true){
			tF.abn.value="";
		}
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
					 <td class="admintext"><strong>Add/Edit Fundraiser Group</strong></td>
				</tr>
				<tr>
					 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
				</tr>
				<tr>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
					<td>
						<form name="addeditfundraiser" method="post" action="fundraisers_actions.php">
						<? if($id){ ?>
						<input type="hidden" name="id" value="<? echo $id;?>">
						<input type="hidden" name="action" value="editfundraiser">
						<? }else{?>
						<input type="hidden" name="action" value="addfundraiser">
						<? }?>
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><img src="../images/spacer_trans.gif" height="1" width="200" border="0"></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="300" border="0"></td>
							</tr>
							<? if($_GET["error"]!=""){ ?>
							<tr>
								<td colspan="3" align="center" class="admintext"><strong>There were errors with your submission:</strong><br><? echo $_GET["error"];?></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<? }
							?>
							<tr class="admintext">
								<td align="right">Name:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><input type="text" name="fname" size="50" value="<? echo $fname;?>"></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">Id Number:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><input type="text" name="idnumber" size="20" value="<? echo $idnumber;?>"></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right" valign="top">Postal Address:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><textarea name="address" rows=7 cols=30><? echo stripslashes($address);?></textarea></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right" valign="top">Delivery Address for Brochures:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><textarea name="deladdress" rows=7 cols=30><? echo stripslashes($deladdress);?></textarea></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">Contact Name:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><input type="text" name="contactname" size="20" value="<? echo $contactname;?>"></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">Contact Phone:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><input type="text" name="contactphone" size="20" value="<? echo $contactphone;?>"></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">ABN:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><input type="text" name="abn" size="20" value="<? echo $abn;?>">&nbsp;&nbsp;<input type="checkbox" name="abnexemption"<? if($abnexemption==1){?> checked<? }?> onClick="clearAbn();">&nbsp;Exemption received</td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">GST Registered:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left">Yes&nbsp;<input type="radio" name="gst" value="1"<? if($gst==1){?> checked<? } 

									if($abn=="" && $id){ print " disabled"; }

							?>>&nbsp;&nbsp;No<input type="radio" name="gst" value="0"<? if($gst==0 || !$gst){?> checked<? }

									if($abn=="" && $id){ print " disabled"; }
							?>></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">Status:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left">
								<select name="stat">
								 	<option value="live"<? if($status=="live"){?> selected<? }?>>live</option>
									<option value="offline"<? if($status=="offline"){?> selected<? }?>>offline</option>
								 </select></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr class="admintext">
								<td align="right">Date Joined:</td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left">
<?PHP
	$datejoined = (empty($datejoined))?date("Y-m-d"):$datejoined;
	list($year, $month, $day) = split("-", $datejoined);

	?><select name=joined_day>
	<?
	for($i=1; $i<=31; $i++){
		$SELECTED = (sprintf("%02d", $i)==$day)?"SELECTED":"";
		print "<option {$SELECTED}>".sprintf("%02d", $i)."</option>\n";
	}
	?></select>
	<select name=joined_month>
	<?
	for($i=1; $i<=12; $i++){
		$SELECTED = (sprintf("%02d", $i)==$month)?"SELECTED":"";
		print "<option {$SELECTED}>".sprintf("%02d", $i)."</option>\n";
	}
	?></select>
	<select name=joined_year>
	<?
	for($i=2002; $i<=date("Y")+2; $i++){
		$SELECTED = (sprintf("%04d", $i)==$year)?"SELECTED":"";
		print "<option {$SELECTED}>".sprintf("%04d", $i)."</option>\n";
	}
	?></select>
								</td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
							</tr>
							<tr>
								<td align="right"><input type="button" value="&lt; cancel" onClick='location.href="fundraisers.php"'></td>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
								<td align="left"><input type="submit" value="submit &gt;"></td>
							</tr>
							<tr>
								<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
							</tr>
						</table>
						</form>
					</td>
					<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
				</tr>
			</table>
		</tr>
	</table>
</body>
</html>
