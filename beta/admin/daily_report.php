<?PHP 
	/*
	require("../common_db.php");
	require_once("../constants.php");
	*/
	require_once("required.php");
?>
<link href="../css/identikid.css" rel="stylesheet" type="text/css"> 


<body bgcolor="5D7EB9">
<table width="350" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
  <tr>
    <td><div align="center"><a href="index.php" target="_self"><font face="Arial, Helvetica, sans-serif"><strong>Admin</strong></font> 
        </a> </div></td>
  </tr>
</table>
<form name="reports" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
  <table width="100%" border="0" cellpadding="2" cellspacing="5" bgcolor="#FFFFFF">
    <tr> 
      <td colspan="1" width="100" align="right" class="admintext">From:&nbsp;&nbsp;</td>
      <td colspan="8" class="admintext"> 
        <?
			html_pulldown2('from_day', range(1,31),date(('j')-1), false);
			?>
        / 
        <?
			html_pulldown2('from_month', range(1,12), date('n'), false);
			?>
        / 
        <?
			html_pulldown2('from_year', range(2005, date('Y')+10), date('Y'), false);
			?>
	        &nbsp;&nbsp;Hours
        <?
			html_pulldown2('from_hours', range(00, 23), date('H'), false);
			?>
	        &nbsp;&nbsp;Minutes
        <?
			html_pulldown2('from_minutes', range(00, 59), date('i'), false);
			?>
      </td>
    </tr>
    <tr> 
      <td colspan="1" width="100" align="right" class="admintext">To:&nbsp;&nbsp;</td>
      <td colspan="9" class="admintext"> 
        <?
			html_pulldown2('to_day', range(1,31), date('j'), false);
			?>
        / 
        <?
			html_pulldown2('to_month', range(1,12), date('n'), false);
			?>
        / 
        <?
			html_pulldown2('to_year', range(2005, date('Y')+10), date('Y'), false);
			?>
	        &nbsp;&nbsp;Hours 
        <?
			html_pulldown2('to_hours', range(00, 23), date('H'), false);
			?>
	        &nbsp;&nbsp;Minutes
        <?
			html_pulldown2('to_minutes', range(00, 59), date('i'), false);
			?>
	
      </td>
    </tr>
    <tr> 
      <td colspan="1" align="right" class="admintext">&nbsp;</td>
      <td colspan="9" class="admintext"><input type="submit" name="Submit" value="Submit"></td>
    </tr>
    <tr> 
      <td colspan="10" align="right" class="admintext"><hr noshade></td>
    </tr>
  </table>
</form>

 
<table width="100%" border="0" cellpadding="2" cellspacing="5" bgcolor="#FFFFFF">
  <tr> 
     <td colspan="10"><font face="Arial, Helvetica, sans-serif"><strong>Daily 
        Transaction Report</strong></font>
	</td>
   </tr>
  <tr> 
    <td class="admintext"><strong>Order Number</font></strong></td>
    <td class="admintext"><strong>Surname</strong></td>
    <td class="admintext"><strong>Pay Choice</font></strong></td>
    <td class="admintext"><strong>Amount</strong></td>
    <td class="admintext"><strong>Paid Amount</strong></td>
    <td class="admintext"><strong>Postage</strong></td>
    <td class="admintext"><strong>Type of Order</strong></td>
    <td class="admintext"><strong>Settle Date</strong></td>
    <td class="admintext"><strong>Label</strong></td>
    <td class="admintext"><strong>Setup</strong></td>
  </tr>
  <?PHP

if( isset($_POST['from_day']) == true && isset($_POST['to_day']) == true )
{
	$sqltr = "TRUNCATE TABLE `report_data`";
	mysql_query($sqltr);
	
	
	$from_date = mktime((int)form_param('from_hours'), (int)form_param('from_minutes'),0, (int)form_param('from_month'), (int)form_param('from_day'), (int)form_param('from_year'));
	$to_date = mktime((int)form_param('to_hours'),(int)form_param('to_minutes'),0, (int)form_param('to_month'), (int)form_param('to_day')+1, (int)form_param('to_year'));
	
	$sql = "SELECT * FROM orders WHERE finished >='" . date('Y-m-d H:i:00', $from_date) ."' AND finished <='" . date('Y-m-d H:i:00', $to_date)."' AND status != 'pending' ORDER BY id DESC";
	//echo $sql."<br />";
	echo "<span class='admintext'>From: ".date('Y-m-d H:i', $from_date)."&nbsp;&nbsp;&nbsp; To: ".date('Y-m-d H:i', $to_date)."</span>";
	$result = mysql_query($sql) or die("database error ".mysql_error());
	while($qdata = mysql_fetch_array($result)){

		echo "<tr>";

		$dontshowme=false;
		$ordertype = $qdata["ordertype"];
		$orderid = $qdata["id"];
		$orderid += 1000;
		$currency = $qdata["currency"];
		$custid = $qdata["customer"];
		$settledate = $qdata["dateposted"];
		if ($settledate <= "0000-00-00 00:00:00")
		{
			$settledate = "";
		}
					
		echo 	"<td class='admintext'>".$orderid."</td>";
		$data1 = $orderid;			
					
		if(!$ordertype) $ordertype="Web";
		
		//CUSTOMER DETAILS
		$query = "SELECT * FROM customers WHERE id=".$qdata["customer"];
		$customer = mysql_query($query);
		if(!$customer) error_message(sql_error());
		while($cdata = mysql_fetch_array($customer)){
			$paymentmeth = $cdata["paymentmeth"];
			if($paymentmeth==1){
				$paymentmeth="Credit Card";
				if($ordertype=="Phone/fax")
				{
					$show_payment_received = true;
				}
			}else if($paymentmeth==2){
				$show_payment_received = true;
				$paymentmeth="Money Order";
			}else if($paymentmeth==3){
				$show_payment_received = true;
				$paymentmeth="Phone Order";
			}else if($paymentmeth==4){
				$show_payment_received = true;
				$paymentmeth="Direct Debit";
			}else if($paymentmeth==5){
				$show_payment_received = true;
				$paymentmeth="Phone with CC";
			}else if($paymentmeth==6){
				$show_payment_received = true;
				$paymentmeth="Gift Voucher";
			}
			
			
			$postage = $cdata["postage"];
			$postopt = $cdata["postage_option"];
			
			$name = $cdata["surname"];
			echo "<td  class='admintext'>".$name."</td>";
			$data2 = $name;
			echo "<td  class='admintext'>".$paymentmeth."</td>";
			$data3 = $paymentmeth;
			
			$RC_output=$AMOUNT="";
			$string2 = "select RC, AM from cc_transactions where OI='" .($qdata["id"]+1000)."' order by id desc limit 1";
			$result2 = mysql_query($string2) or die ("SQL Error: ".mysql_error());
			if(mysql_num_rows($result2)==1)
			{
				list($RC, $AMOUNT)=mysql_fetch_row($result2);

				//$RC_output = returnErrorCode($RC);
				if(!empty($RC_output))
				{
					$RC_output = "<br />({$RC_output})";
				}

				if(!empty($AMOUNT) && $currency!=1 && $currency!=5 )
				{
					$AMOUNT = "<br /><i>(AU$".sprintf("%01.2f", $AMOUNT/100).")</i>";
				}
			}
			else {
				$AMOUNT = "";
			}
		}
		

			$query = "SELECT * FROM basket_items bi
				LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
				LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
				LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
				LEFT JOIN product p ON (p.id=bi.text5)
				WHERE ordernumber=".$qdata["id"];
			$basket = mysql_query($query);
			if(!$basket) error_message(sql_error());
			$totalprice=0; 
		
			while($basket_qdata = mysql_fetch_array($basket)){
				$totalprice += $basket_qdata["price"];
				$label = $basket_qdata["quantdesc"];
			}
			
			
			echo "<td  class='admintext'>AU$".sprintf("%01.2f", $totalprice)."</td>";
			$data4 = sprintf("%01.2f", $totalprice);
			if ($AMOUNT > 1)
			{
				echo "<td  class='admintext'>AU$".sprintf("%01.2f", $AMOUNT/100)."</td>";
			}
			else
			{
				echo "<td></td>";
			}
			$data5 = sprintf("%01.2f", $AMOUNT/100);
			echo "<td class='admintext'>".$postopt."</td>";
			$data6 = $postopt;
			echo "<td class='admintext'>".$ordertype."</td>";
			$data7 = $ordertype;
			echo "<td class='admintext'>".substr($settledate,0,10)."</td>";
			$data8 = substr($settledate,0,10);
			echo "<td class='admintext'>".$label."</td>";
			$data9 = $label;
			echo "<td class='admintext'>Comming Soon</td>";
			$data10 = "";
	echo "</tr>";
	
	
		$logins[] = array($data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10); 
	
		$sqlin = "INSERT INTO report_data VALUES ('$data1', '$data2', '$data3', '$data4', '$data5', '$data6', '$data7','$data8', '$data9', '$data10')";
		mysql_query($sqlin);
	} //end while 
}//end if?>
	
</table>
	
	<!--
	/*
	while ($rows=mysql_fetch_assoc($result))
	{
		$id = $rows['customer'];
		
		$mysql = "SELECT country, firstname, surname FROM customers WHERE id = '$id'"; 
		$myresult = mysql_query($mysql) or die("database error!");
		while ($myrows = mysql_fetch_array($myresult))
		{
			if ($myrows["country"] !='' && stristr($myrows["country"],"Australia") === FALSE && $myrows["country"] !="AUSTRALIA" && $myrows["country"] !="AUST" && $myrows["country"] != "aust" && $myrows["country"] != "Australiaa" && stristr($myrows["country"],"Austra") === FALSE)
			{
				$logins[] = array($rows['id'], $rows['started'],$rows['finished'],$rows['status'],$myrows['firstname'] . " " . $myrows['surname'],$myrows['country']);
			}
		}
		
	}-->
<form name="form1" method="post" action="daily_report_csv.php">
	<input name="reportdata" type="hidden" value="go">
  <input name="CSV" type="submit" id="CSV" value="Export Report">
</form>

	