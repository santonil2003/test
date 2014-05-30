<?php
	/*
	require_once("../common_db.php");
	require_once("../useractions.php");
	*/
	require_once("required.php");
	linkme();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Competition Winner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript1.1" type="text/javascript">

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
						<h1 align=center>Competition Winner</h1> 
						
              <table width="85%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr> 
                  <td colspan="2"><h3 align="center"><font color="#FFFFFF" size="5">* 
                      Winner *</font></h3></td>
                </tr>
               </table>
<table width=90% cellpadding='0' cellspacing='1' border=0 class='table' align='cetner'>

<?PHP

//print_r($_POST);

if($_POST['customers'] == 'true' || $_POST['customers'] == 'on' ) {
 
	$startdate = $_POST['year']."-".sprintf("%02d", $_POST['month'])."-".sprintf("%02d", $_POST['day']);
	$enddate = $_POST['yearc']."-".sprintf("%02d", $_POST['monthc'])."-".sprintf("%02d", $_POST['dayc']);

	$string = "select o.id, o.customer, o.finished, o.started, o.status, c.firstname, c.surname from orders o, customers c where o.customer=c.id AND o.started >='$startdate' AND o.started <= '$enddate' AND ( o.status='posted' OR o.status='printed' ) order by o.id ASC";
   //print $string;
	$result = mysql_query($string) or die("SQL error 1: ".mysql_error());

   $count = 0;

	while($row=mysql_fetch_array($result))
	{	
		$string2 = "select SUM(price) from basket_items where ordernumber='{$row['id']}'";
		$result2 = mysql_query($string2) or die("SQL error 2: ".mysql_error());
		list($total) = mysql_fetch_row($result2);
		$total = sprintf("%01.2f", $total);

		// if customer has spent over $25 or $25
		if($total >= 25)
		{
			// get their id
			$customerid = $row["customer"];

			// check if customer has already been in draw
			$sql3 = "SELECT customerid FROM competitions_pastcompetitors WHERE customerid = '$customerid'";
			$result3 = mysql_query($sql3) or die("SQL error 3: ".mysql_error());
			if (mysql_num_rows($result3))
			{
				$donothing = 'ok';
			}
			else
			{
				// store their id
				$sql2 = "INSERT INTO competitions_pastcompetitors (customerid) VALUES ('$customerid')";
				mysql_query($sql2) or die("SQL error 4: ".mysql_error());
				
				//create array of potential winners
				$potential_winners[] = $row["customer"];
			}
			
		}
			
	}
}


if($_POST['loyalty'] == 'true' || $_POST['loyalty'] == 'on') {

  $sql = "SELECT * FROM loyalty_program ";
  $result = mysql_query($sql);
  if(mysql_num_rows($result) > 0){
    while($row =  mysql_fetch_array($result)) {
      $sql2 = "SELECT loyalty_id FROM competition_winners WHERE deleted = 0 and loyalty_id = '".$row["id"]."' LIMIT 1 ";
      $result2 = mysql_query($sql2);
      if(mysql_num_rows($result2) == 0 ){
        $potential_winners[] = "L_".$row["id"];
      }
    }
  }

}	
	
	
	
	// draw a random winner!
	$number_potential_winners = count($potential_winners);
	echo "Number of Entrants:  " .$number_potential_winners;
	$arraypos = rand(0,$number_potential_winners-1);
	$winning_entrant = $arraypos+1;
	echo "<BR>Winning Entrant: " . $winning_entrant . "<br>";
	$winner = $potential_winners[$arraypos];
	$prize = $_POST['prize'];
	$loyalty_id = "0";
	
	// insert winner into database
	if ($winner !='')
	{
	   if(strpos($winner, "L_") !== false) { 
	     $loyalty_id = substr($winner, 2);
	     $winner = "0";
	     $dateclosed = '';
	     $sql4 = "INSERT INTO competition_winners (customerid, datestarted, dateclosed, prize, loyalty_id) 
	     VALUES ('$winner', NOW() ,'$enddate','$prize', '$loyalty_id' )";
	   } else {
		  $sql4 = "INSERT INTO competition_winners (customerid, datestarted, dateclosed, prize, loyalty_id) 
	     VALUES ('$winner','$startdate','$enddate','$prize', '$loyalty_id' )";
	   }
		mysql_query($sql4) or die("SQL error 5: ".mysql_error());
	}
	
	
	if($loyalty_id == "0") {
	// get winner details
	$sql5 = "SELECT * FROM customers WHERE id = '$winner'";
	//echo $sql5;
	$result5 = mysql_query($sql5) or die("SQL error 6: ".mysql_error());
	$row5 = mysql_fetch_assoc($result5);
	$name = $row5["firstname"] . " " . $row5["surname"];
	$address = $row5["address"];
	$suburb = $row5["suburb"];
	$postcode = $row5["postcode"];
	$state = $row5["state"];
	$homephone = $row5["homephone"];
	$mobilephone = $row5["mobilephone"];
	$emailadd = $row5["emailadd"];
	} else {
	
	$sql2 = "SELECT * FROM loyalty_program WHERE id = '$loyalty_id' ";
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
  }
  
	if ($winner !='')
	{
	echo "
	         <tr><td colspan='2'>
	            <table>
                <tr> 
                  <td><strong>Name:</strong></td>
                  <td>" . $name . "</td>
                </tr>
                <tr> 
                  <td><strong>Address:</strong></td>
                  <td>". $address ." ". $suburb . " " . $postcode . " " . $state . "</td>
                </tr>
                <tr>
                  <td><strong>Home Phone:</strong></td>
                  <td>" . $homephone . "</td>
                </tr>
                <tr>
                  <td><strong>Mobile Phone:</strong></td>
                  <td>" . $mobilephone . "</td>
                </tr>
                <tr>
                  <td><strong>Email Address:</strong></td>
                  <td>" . $emailadd . "</td>
                </tr>
                </table>
                </td></tr>
				";
	}
	
	else
	{
		echo "  <tr>
                  <td colspan='2'>No winner! <br>Click back and try new dates</td>
                </tr>";
	}			
	?>
              </table>
              <form><input name=back type=button onClick="history.back();" value="&lt; Back"></form></p>
						<p>&nbsp;</p>

					</td>
        </tr>
			</table>
		</td>
	</table>

</div>


