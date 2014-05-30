<?php
/*
	require_once("../common_db.php");
	require_once("../useractions.php");
	linkme();
	*/
	include("required.php");
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
	
// display settings
$show_columns = 5;
$font_size = "11pt";	


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Win a Portable DVD Player!!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<?
if(!isset($_POST['Submit'])){
?>
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
						<h1 align=center>Win a Portable DVD Player!!</h1> 
						<ul align=left>
							<b>ENTRY CONDITIONS:</b><br>
							<li>Only customers who's order amount is greater than or equal to $25.00</li>
							<li>Only orders where status = 'posted' or 'printed'</li>
							<li>Australian Residents</li>
							<li>Orders started between AEST 01/09/2006 00:01:00 and AEST 01/12/2006 18:00:00</li>
							<li>Searched customers are included in future $50 Voucher searches</li>
						</ul>
						<br>
						<br>
						Labels show the order number and the name of the customer.
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="form1" target="_blank">
                 <table width="100%" border="0" cellspacing="0" cellpadding="5">         
                  <tr> 
                    <td align="center" colspan="2"><input type="submit" name="Submit" value="Show Elligible Orders">
                      <br>
                      <font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">(Search can take a while)</font></td>
                  </tr>
                </table>
              </form>
             <p><form><input name=back type=button onClick="history.back();" value="&lt; Back"></form></p>
						<p>&nbsp;</p>

					</td>
        	</tr>
			</table>
		</td>
	</table>

</div>
<?
} else {
?>
             <body>
			  <table width="100%" style="border: black 1px solid; page-break-inside: avoid;" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
<?
			  	// qualifying orders
			  	$sql = "	SELECT o.id, date_format(o.started, '%d/%m/%Y %h:%i:%s') as datestarted , o.customer, c.firstname, c.surname, c.address, c.suburb, c.postcode, c.emailadd, c.homephone, c.mobilephone, c.state, format(sum(bi.price),2) as order_amount
							FROM orders o, customers c, basket_items bi
							WHERE o.customer=c.id 
							AND o.id = bi.ordernumber
							AND ( o.status='posted' OR o.status='printed' )
							AND o.started >='2006-08-31 22:01:00' 
							AND o.started <= '2006-12-01 16:00:00'
							AND c.country = 'Australia'
							GROUP BY o.id, o.customer, o.started, c.firstname, c.surname, c.address, c.suburb, c.postcode, c.emailadd, c.homephone, c.mobilephone, c.state
							HAVING sum(bi.price) > 25.0
							ORDER BY o.id ASC";
				$result = mysql_query($sql) or die("SQL error: ".mysql_error());
				$rowcount = mysql_num_rows($result);
				$tr_count = (int)($rowcount / $show_columns)+2;
				//$tr_count = 5;
				//echo $rowcount." : ".$tr_count;
				for($r=1;$r<=$tr_count;$r++)
				{
					?><tr><?
					for($c=1;$c<=$show_columns;$c++)
					{
							$row = mysql_fetch_assoc($result); ?>
							<td style="border: black 1px solid; font-size: <?=$font_size?>;" align="center" width="<?=(int)(100/$show_columns)?>%" nowrap><?=$row['id']?><br><?=$row['firstname']?> <?=$row['surname']?></td>
							<?
					}
					?></tr><?
				}
				?>
              </table>
			  </body> 
		<?	} ?>

