<?php
   error_reporting(E_ALL);
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
      <td colspan="1" width="100" align="right" class="admintext">Product:&nbsp;&nbsp;</td>
      <td colspan="9" class="admintext">
        <?php
			$sql = "SELECT  id,productName FROM product";
			$result = mysql_query($sql);
			
			if($result == true)
			{
					while ($row = mysql_fetch_array($result)) {
						$productArr[$row['productName']] = $row['productName'];
					}
					
					html_pulldown2('productName', $productArr, 0, false);
			}
			
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
     <td colspan="10"><font face="Arial, Helvetica, sans-serif"><strong>Product Sales Report</strong></font>
	</td>
   </tr>
   <tr>
   <td>
  <?php
if( isset($_POST['from_day']) == true && isset($_POST['to_day']) == true  && isset($_POST['productName']) == true)
{
	print_r($_POST);
	$from_date = mktime((int)form_param('from_hours'), (int)form_param('from_minutes'),0, (int)form_param('from_month'), (int)form_param('from_day'), (int)form_param('from_year'));
	$to_date = mktime((int)form_param('to_hours'),(int)form_param('to_minutes'),0, (int)form_param('to_month'), (int)form_param('to_day')+1, (int)form_param('to_year'));
	$productName = $_POST['productName'];
	
	$query = "SELECT *, bi.id as basketid FROM basket_items bi
						LEFT JOIN orders ord ON (ord.id = bi.ordernumber)
						LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
						LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
						LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
						LEFT JOIN product p ON (p.id=bi.text5)
						WHERE finished >='" . date('Y-m-d H:i:00', $from_date) ."' AND finished <='" . date('Y-m-d H:i:00', $to_date)."' AND status != 'pending' AND quantdesc LIKE '%".$productName."%' ORDER BY id DESC";
	echo $query."<br />";
	echo "<span class='admintext'>From: ".date('Y-m-d H:i', $from_date)."&nbsp;&nbsp;&nbsp; To: ".date('Y-m-d H:i', $to_date)."</span>";
	$result = mysql_query($query) or die("database error ".mysql_error());
	echo "<pre>";
	$qdata = mysql_fetch_array($result);
	print_r($qdata);
	die;
?>	
</td></tr>
</table>
	