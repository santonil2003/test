<?php
	require_once("../common_db.php");
	require_once("../useractions.php");
	linkme();

	$startdate = $_POST['year']."-".sprintf("%02d", $_POST['month'])."-".sprintf("%02d", $_POST['day']);
	$enddate = $_POST['yearc']."-".sprintf("%02d", $_POST['monthc'])."-".sprintf("%02d", $_POST['dayc']);
	$qty = (int)$_POST['qty']; // number of winners to be drawn
	echo "<br>qty=".$qty;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Win A $50 Gift Voucher</title>
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
						<h1 align=center>Win A $50 Gift Voucher 2007</h1> 
		 <table width="85%" border="0" align="center" cellpadding="5" cellspacing="0">
						

<?PHP

	// get the list of orders
	$string = "SELECT o.id, o.customer, o.finished, o.started, o.status, c.firstname, c.surname 
					FROM orders o, customers c 
					WHERE o.customer=c.id 
					AND o.started >='$startdate' 
					AND o.started <= '$enddate' 
					AND o.status IN ('posted') 
					ORDER BY o.id ASC";
	//echo "<br>".$string;
	$result = mysql_query($string) or die("SQL error 1: ".mysql_error());

	$potential_winners = array();
	$winners = array();
	
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
			//$sql3 = "SELECT customerid FROM competitions_pastcompetitors_2007 WHERE customerid = '$customerid'";
			//$result3 = mysql_query($sql3) or die("SQL error 3: ".mysql_error());
			//if (mysql_num_rows($result3))
			//{
			//	$donothing = 'ok';
			//}
			//else
			//{
				// store their id
				$sql2 = "INSERT INTO competitions_pastcompetitors_2007 (customerid) VALUES ('$customerid')";
				echo "<br>".$sql2;
				mysql_query($sql2) or die("SQL error 4: ".mysql_error());
				
				//create array of potential winners
				$potential_winners[] = $row["customer"];
			//}
			
		}
			
	}
		
	if(count($potential_winners) > 0){
		?>
			<tr> 
			  <td colspan="2"><h3 align="center"><font color="#FFFFFF" size="5">* 
				  <?=($qty>1?$qty:"")?> Winner<?=($qty>1?"s":"")?> *</font></h3></td>
			</tr>
			<tr>
				<td>
					<table cellpadding="2" cellspacing="0" border=0 class='table' align='center'>

		<?
		//first check there are more entrants than the number of winners drawn, otherwise the random feature isn't needed, they all won!
		if(count($potential_winners) > $qty){
			// draw random winner(s)!
			//$usedpos = array();
			//$number_potential_winners = count($potential_winners);
			for ($n=0;$n<$qty;$n++){
				//echo "<br>number_potential_winners = " .count($potential_winners);
				$arraypos = rand(0,count($potential_winners)-1);
				/*
				$repeat = false;
				// make sure the random arraypos isn't re-used (highly likely if number of entrants is close to number of draws)
				foreach ($usedpos as $alreadyused){
					if($arraypos == $alreadyused){
						whil
						$repeat = true;
					}
				}
				if(!$repeat){
					$chosenpos[] = $arraypos;
				}
				*/
				//echo "<br>arraypos = " . $arraypos."<br>";
				//print_r($potential_winners);
				$winners[$n] = $potential_winners[$arraypos];
				//echo "<br>winner = " . $winners[$n]."<br>";
				//$usedpos[] = $arraypos; 
				$potential_winners = array_remove_element($arraypos, $potential_winners);
			}
		} else {
			$winners = $potential_winners;
		}
		
		// insert winner(s) into database
		if (count($winners) > 0)
		{
			foreach($winners as $winner){
				$sql4 = "INSERT INTO competition_winners_2007 (customerid, datestarted, dateclosed) VALUES ('$winner','$startdate','$enddate')";
				//echo "<br>".$sql4;
				mysql_query($sql4) or die("SQL error 5: ".mysql_error());
			}
		}
	
		// get winner details
		$sql5 = "	SELECT * 
						FROM customers 
						WHERE id IN (".implode(",",$winners).")";
		//echo $sql5;
		$result5 = mysql_query($sql5) or die("SQL error 6: ".mysql_error());
		while($row5 = mysql_fetch_assoc($result5)){
			$name = $row5["firstname"] . " " . $row5["surname"];
			$address = $row5["address"];
			$suburb = $row5["suburb"];
			$postcode = $row5["postcode"];
			$state = $row5["state"];
			$homephone = $row5["homephone"];
			$mobilephone = $row5["mobilephone"];
			$emailadd = $row5["emailadd"];
	
			if ($winner !='')
			{
			?>
						<tr> <td><strong>Name:</strong></td><td><?=$name?></td></tr>
						<tr> <td><strong>Address:</strong></td><td><?=$address?></td></tr>
						<tr> <td><strong>Suburb:</strong></td><td><?=$suburb?></td></tr>
						<tr> <td><strong>Postcode:</strong></td><td><?=$postcode?></td></tr>
						<tr> <td><strong>State:</strong></td><td><?=$state?></td></tr>
						<tr><td><strong>Home Phone:</strong></td><td><?=$homephone?></td></tr>
						<tr><td><strong>Mobile Phone:</strong></td><td><?=$mobilephone?></td></tr>
						<tr><td><strong>Email Address:</strong></td><td><?=$emailadd?></td></tr>
						<tr><td colspan="2">&nbsp;</td></tr>
			<?
			}
			
			else
			{
				?><tr>
						<td colspan='2'>No winner! <br>Click back and try new dates</td>
					</tr>
				<?
			}
		} // while
	} else {
		?><tr><td align="center">No potential winners were found for the date range entered.</td></tr><?
	}			
	?>
              </table>
			  </td>
			  </tr>
			  <tr><td align="center">
            	<form><input name=back type=button onClick="history.back();" value="&lt; Back"></form></p>
			  </td></tr>
			</table>
		</td>
		</tr>
	</table>

</div>


