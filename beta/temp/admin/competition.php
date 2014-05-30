<?php
	/*
	require_once("../common_db.php");
	require_once("../useractions.php");
	*/
	require_once("required.php");
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
<title>Identikid Admin - Competitions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript1.1" type="text/javascript">
  var customers = true;
  
  function toggleDates(){
    if(customers == true) {
      customers = false;
      document.form1.day.disabled = true;
      document.form1.month.disabled = true;
      document.form1.year.disabled = true;
      document.form1.dayc.disabled = true;
      document.form1.monthc.disabled = true;
      document.form1.yearc.disabled = true;
    } else {
      customers = true;
      document.form1.day.disabled = false;
      document.form1.month.disabled = false;
      document.form1.year.disabled = false;
      document.form1.dayc.disabled = false;
      document.form1.monthc.disabled = false;
      document.form1.yearc.disabled = false;
    }
  
  
  }
  
  function validatePrizeDraw() {
  
    var loyalty = document.form1.loyalty.checked
    
    if(customers == true || loyalty == true) {
      if(document.form1.prize.value=='') {
        alert("You must enter a Prize");
        return false;
      }
      return true;
    } else {
      alert("You must select at least one Customer group to continue");
      return false;
    }
  
    return false;
  }
  
  function deleteWinner(winnerid)
  {
	var r = confirm("Press OK to confirm deletion of past winner. This cannot be undone later.");
	if (r == true)
	{
		return true;
	}
	else
	{
		return false;
	}
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
						<h1 align=center>Competitions</h1> 
						<ul align=left>
							<li>Only customers who's order amount is greater than or equal to $25</li>
							<li>Only orders where status = 'posted' or 'printed' qualify and </li>
							<li>Searched customers are not included in future searches</li>
						</ul>
						<p><form action="competition_winner.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validatePrizeDraw();">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr> 
                    <td><strong>Include Customers:</strong> <input type="checkbox" name="customers" checked onchange="toggleDates()" value="true" ></td>
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
						printPullDown("year", range(date("Y")-10, date("Y")+10), $year, false, "validatedate(day,month,year)");
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
						printPullDown("yearc", range(date("Y")-10, date("Y")+10), $yearc, false, "validatedate(dayc,monthc,yearc)");
					?>
                      </strong> (day, month, year) </td>
                  </tr>
                  <tr>
                    <td><strong>Include Loyalty Program Subscribers:</strong> <input type="checkbox" name="loyalty" value="true" ></td>                  
                  </tr>
                  <tr> 
                    <td><strong>Prize: </strong><input type="text" name="prize" ><br><br><input type="submit" name="Submit" value="Draw Winner">
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
                  <td class="table"><strong><font color="#FFFFFF">Date/s</font>
                  <td class="table"><strong><font color="#FFFFFF">Name</font></strong></td>
                  <td class="table"><font color="#FFFFFF"><strong>Address</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Email</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Phone</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Prize</strong></font></td>
                  <td class="table"><font color="#FFFFFF"><strong>Actions</strong></font></td>
                </tr>
                <?php 
			  	// past winners
			  	$sql = "SELECT * FROM competition_winners WHERE deleted = 0";
				$result = mysql_query($sql) or die("SQL error: ".mysql_error());
			  	
				while ($row = mysql_fetch_assoc($result))
				{
					$winnerid = $row["id"];
					$customerid = $row["customerid"];
					$loyaltyid = $row["loyalty_id"];
					$startdate = $row["datestarted"];
					$enddate = $row["dateclosed"];
					$prize = $row["prize"];
					
					
					if($loyaltyid!='0') {
					  $sql2 = "SELECT * FROM loyalty_program WHERE id = '$loyaltyid' ";
					  $result2 = mysql_query($sql2) or die("SQL error: ".mysql_error());
					  $row2 = mysql_fetch_assoc($result2);
					  $name = $row2["name"];
					  $address = $row2["address"];
					  $suburb = $row2["suburb"];
					  $postcode = '';
					  $state = '';
					  $homephone = $row2["phone"];
					  $mobilephone = $row2["mobile"];
					  $emailadd = $row2["email"];
					  
					  // starting date
					$datearray =array();
					$datestring = $startdate;
					$length = strlen($datestring); 
					$start = 0; 
			
					for($i = 0; $i < $length; $i++){
						$datearray[$i] = $temp_output = substr($datestring, $start, 1);
						$start++;
					}
					  $datearray2 = '';
					  
					  echo "<tr>
							<td class='table'>". $datearray[8], $datearray[9] ."/" .$datearray[5],$datearray[6] . "/" . $datearray[0],$datearray[1],$datearray[2],$datearray[3] . "</td>";
					} else {
					
					// get customer details
					$sql2 = "SELECT * FROM customers WHERE id = '$customerid' ORDER BY id";
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
					  echo "<tr>
							<td class='table'>". $datearray[8], $datearray[9] ."/" .$datearray[5],$datearray[6] . "/" . $datearray[0],$datearray[1],$datearray[2],$datearray[3]  ."&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;" . $datearray2[8], $datearray2[9] ."/" .$datearray2[5],$datearray2[6] . "/" . $datearray2[0],$datearray2[1],$datearray2[2],$datearray2[3]  . "</td>";
					}
					// output details		
					echo "<td class='table'>" . $name . "</td>
							<td class='table'>" . $address . " " . $suburb . " " . $state . " " . $postcode . "</td>
							<td class='table'>" . $emailadd . "</td>
							<td class='table'>" . $mobilephone . "</td>
							<td class='table'>" . $prize . "</td>
							<td class='table' style=\"text-align: center;\"><a href=\"competition_winner_delete.php?id=$winnerid\" onclick=\"return deleteWinner($winnerid);\"><img src=\"images/delete.gif\" alt=\"Delete\" title=\"Delete\" /></a></td>
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
