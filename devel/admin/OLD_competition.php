<?php
	require_once("../common_db.php");
	require_once("../useractions.php");
	linkme();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Win A Laptop Competition</title>
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
	border-width: 2px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	align: center;
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

.table {
	border-width: 2px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse
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
						<h1 align=center>Win A Laptop Competition</h1> 
						<ul align=left>
							<li>Only orders 'started' from 1st November 2004 until 1st March (inclusive) can qualify</li>
							<li>Only orders where status = 'posted' or 'printed' qualify</li>
							<li>Customers are given 1 ticket per $50 of their order</li>
						</ul>

						<p><form><input type=button name=back value="&lt; Back" onClick="history.back();"></form></p>
						<p>&nbsp;</p>

					</td>
        </tr>
			</table>
		</td>
	</table>

</div>
<?PHP

	$string = "select o.id, o.finished, o.started, o.status, c.firstname, c.surname from orders o, customers c where o.customer=c.id AND o.started>='2004-11-01' AND o.started < '2005-03-02' AND ( o.status='posted' OR o.status='printed' ) order by o.id ASC";
//print $string;
	$result = mysql_query($string) or die("SQL error: ".mysql_error());

//print "<p>Orders: ".mysql_num_rows($result)."</p>";
$count = 0;

print "<table width=100% cellpadding=0 cellspacing=1 border=1 class=table>";
	$perRow = 3;
	$linesPerPage = 15;
	$td = 0;
	while($row=mysql_fetch_array($result))
	{
		$string2 = "select SUM(price) from basket_items where ordernumber='{$row['id']}'";
		$result2 = mysql_query($string2) or die("SQL error: ".mysql_error());
		list($total) = mysql_fetch_row($result2);
		$total = sprintf("%01.2f", $total);

		if($total>=50){
			for($j=0; $j<numTickets($total); $j++){
				if($td==0){
					if($count% ($linesPerPage * $perRow) == 0 && $count>0){
						$pageBreak = ' class="pageBreak" ';
					}
					else {
						$pageBreak = "";
					}
					print "\n<tr {$pageBreak}>";
				}
				print "\n<td align=center width=25% class=smallText><br /><strong>".($row['id']+1000)."</strong> ({$row['status']})<br />{$row['firstname']} {$row['surname']}<br />\${$total}<Br />&nbsp;<Br />&nbsp;</td>";
				$td++;
	
		
				if($td==$perRow){
					print "\n</tr>";
					$td=0;
				}
				$count++;
			}
		}
		flush();


//		if($count>=200){
//			break;
//		}


	}

	if($td>0){
		for($i=$td; $i<$perRow; $i++){
			print "<td>&nbsp;</td>";
		}
	}
	print "</table>";

exit();

function numTickets($amount){
	return floor($amount / 50);
}

?>