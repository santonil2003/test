<?PHP 
require("../common_db.php");
require_once("../constants.php");
if (isset($_POST["reportdata"]))
{
	
	$csv_output.="poo";
	
	// cache issues
	header('Pragma: private');
	header('Cache-control: private, must-revalidate');
	
	// do headers.
  //You cannot have the breaks in the same feed as the content. 
	 header('Content-type: application/excel');
	 header('Content-Disposition: attachment; filename="daily_report_' . date("Y-m-d") . '.csv"');
	 echo "order_id,surname,pay_choice,amount,paid_amount,postage,type_of_order,settle_date,label,setup";
	
	$sql = "SELECT data1,data2,data3,data4,data5,data6,data7,data8,data9,data10 FROM report_data";
	$result = mysql_query($sql)or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		print("\n");
   		printf("%s,%s,%s,%s,%s,%s,%s,%s,%s,%s", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]); 
	}
	
	/*foreach($logins as $login)
	{
		foreach($login as $key => $value)
		{
			if(preg_match('/("|,)/', $value) > 0)
			{
				$login[$key] = '"' . str_replace('"', '""', $value) . '"';
			}
		}
		echo "\n" . join(",",$login);
	}*/
	exit;
}
?>