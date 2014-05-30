<?php
	require_once("../common_db.php");
	require_once("../useractions.php");
	linkme();
	
	include ('validate_date.php');
	
	// date menus
	function printPullDown($name, $values, $selected, $useKeys, $onChange="")
	{
		print "<select name=\"$name\" id=\"$name\" ";
		if (!empty($onChange))
		{
			print " onChange=\"$onChange\"";
		}
			print ">\n";

		foreach ($values as $key => $value)
		{
			$key=($useKeys)?$key:$value;
			$SELECTED=($selected==$key)?"SELECTED":"";
			print "<option value=\"$key\" $SELECTED>$value</option>\n";
		}
		print "</select>";
}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Win A $50 Gift Voucher 2007</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" type="text/javascript">
	function validateForm(f){
		if(f.qty.value == "0"){
			alert("Please choose the Number of Winners to Draw.");
			return false;
		} else {
			return true;
		}
		return false;
	}
</script>
<style>
body {
	margin: 0px;
}

.smallText {
	font-size: 12px;
}


.table {
	border-width: 0px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	align: center;
	font-size: 11px;
}

</style>
<style media=print>
.smallText {
	font-size: 8px;
}

.pageBreak {
	page-break-after: always;
}

.dontShow {
	display: none;
}

</style>
<body >
<div class="dontShow">

	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">

        <tr>
          <td colspan="15"><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td colspan="15"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td height="38" colspan="15" valign="middle" class="admintext" align=left>
						<h1 align=center>Win A $50 Gift Voucher 2007</h1> 
						<ul align=left>
							<li>Only customers who's order amount is greater than or equal to $25</li>
							<li>Only orders where status = 'posted' or 'printed' qualify and </li>
							<li>Searched customers are not included in future searches</li>
						</ul>
						<p><form action="competition_winner_2007.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validateForm(this);">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr> 
                    <td class="table"><strong>Start Date: 
                      <?PHP
						printPullDown("day", range(1, 31), $day, false, "validatedate(day,month,year)");
					?>
                      / 
                      <?
						printPullDown("month", range(1, 12), $month, false, "validatedate(day,month,year)");
					?>
                      / 
                      <?
						printPullDown("year", range(2007, date("Y")+10), $year, false, "validatedate(day,month,year)");
					?>
                      </strong>(day, month, year) </td>
                    <td class="table"><strong>Closing Date: 
                      <?PHP
						printPullDown("dayc", range(1, 31), $dayc, false, "validatedate(dayc,monthc,yearc)");
					?>
                      / 
                      <?
						printPullDown("monthc", range(1, 12), $monthc, false, "validatedate(dayc,monthc,yearc)");
					?>
                      / 
                      <?
						printPullDown("yearc", range(2007, date("Y")+10), $yearc, false, "validatedate(dayc,monthc,yearc)");
					?>
                      </strong> (day, month, year) </td>
                  </tr>
                  <tr> 
                    <td class="table"><strong>Number of Winners to Draw: 
							<select name="qty">
								<option value="0">Choose...</option>
						<?		for($j=1;$j<=20;$j++){ ?>
								<option value="<?=$j?>"><?=$j?></option>
						<?		} ?>
							</select>
							</strong>
					</td>
                  </tr>
                  <tr> 
                    <td>
						<br><br><input type="submit" name="Submit" value="Draw Winners">
					  	<br>
                      	<font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">(Search can take a while)</font></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </form>
						</p>
              <table width="100%" border="0" cellspacing="0" cellpadding="5">
<tr> 
                  <td colspan="8"><font color="#FF0099" size="4"><strong>Past Winners</strong></font></td>
                </tr>
                <tr> 
                  <td class="table"><strong><font color="#FFFFFF">Date starting</font></strong></td>
                  <td class="table"><strong><font color="#FFFFFF">Date ending</font></strong></td>
                  <td class="table"><strong><font color="#FFFFFF">Customers Name</font></strong></td>
                  <td class="table"><font color="#FFFFFF"><strong>Address</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Suburb/Town</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Postcode</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Email</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Mobile</strong></font></td>
                </tr>
                <?php 
			  	// past winners
			  	$sql = "SELECT * FROM competition_winners_2007";
				$result = mysql_query($sql) or die("SQL error: ".mysql_error());
			  	
				while ($row = mysql_fetch_assoc($result))
				{
					$customerid = $row["customerid"];
					$startdate = $row["datestarted"];
					$enddate = $row["dateclosed"];
					
					// get customer details
					$sql2 = "	SELECT * 
									FROM customers 
									WHERE id = '$customerid'
									ORDER BY id";
					$result2 = mysql_query($sql2) or die("SQL error: ".mysql_error());
					$row2 = mysql_fetch_assoc($result2);
					$name = $row2["firstname"] . " " . $row2["surname"];
					$address = $row2["address"];
					$suburb = $row2["suburb"];
					$postcode = $row2["postcode"];
					$state = $row2["state"];
					$homephone = $row2["homephone"];
					$mobilephone = $row2["mobilephone"];
					$emailadd = $row2["emailadd"];
					
					if ($address=='')
						$address="N/A";
					
					if ($suburb=='')
						$suburb="N/A";
					
					if ($postcode=='')
						$postcode="N/A";
					
					if ($homephone=='')
						$homephone="N/A";	
					
					if ($mobilephone=='')
						$mobilephone="N/A";
					
					if ($emailadd=='')
						$emailadd="N/A";
						
					// starting date
					$datearray =array();
					$datestring = $startdate;
					$length = strlen($datestring); 
					$start = 0; 
			
					for($i = 0; $i < $length; $i++){
						$datearray[$i] = $temp_output = substr($datestring, $start, 1);
						$start++;
					}
					
					// closing date
					$datearray2 =array();
					$datestring2 = $enddate;
					$length2 = strlen($datestring2); 
					$start2 = 0; 
			
					for($i = 0; $i < $length2; $i++){
						$datearray2[$i] = $temp_output2 = substr($datestring2, $start2, 1);
						$start2++;
					}
					
					// output details
					echo "<tr>
							<td class='table'>". $datearray[8], $datearray[9] ."-" .$datearray[5],$datearray[6] . "-" . $datearray[0],$datearray[1],$datearray[2],$datearray[3]  ." </td>
							<td class='table'>" . $datearray2[8], $datearray2[9] ."-" .$datearray2[5],$datearray2[6] . "-" . $datearray2[0],$datearray2[1],$datearray2[2],$datearray2[3]  . "</td>
							<td class='table'>" . $name . "</td>
							<td class='table'>" . $address . "</td>
							<td class='table'>" . $suburb . "</td>
							<td class='table'>" . $postcode . "</td>
							<td class='table'>" . $emailadd . "</td>
							<td class='table'>" . $mobilephone . "</td>
						  </tr>
						  <tr>
						  	<td colspan = '8' class='table'><hr height='1'></td>
						  <tr>";
						  
				}	
			  ?>
              </table> 
			  
              <p><form><input name=back type=button onClick="history.back();" value="&lt; Back"></form></p>
						<p>&nbsp;</p>

					</td>
        </tr>
			</table>
		</td>
	</table>

</div>
