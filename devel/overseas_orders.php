<?PHP

require("common_db.php");
require_once("constants.php");

	$sql = "SELECT * FROM orders";
	$result = mysql_query($sql) or die("database error ".mysql_error());
	
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
		
	}
	$csv_output.="poo";
	
	// cache issues
	header('Pragma: private');
	header('Cache-control: private, must-revalidate');
	
	// do headers.
  //You cannot have the breaks in the same feed as the content. 
	 header('Content-type: application/excel');
	 header('Content-Disposition: attachment; filename="report_overseas_' . date("Y-m-d") . '.csv"');
	 echo "order_id,order_started,order_finished,status,customer_name,country";
	foreach($logins as $login)
	{
		foreach($login as $key => $value)
		{
			if(preg_match('/("|,)/', $value) > 0)
			{
				$login[$key] = '"' . str_replace('"', '""', $value) . '"';
			}
		}
		echo "\n" . join(",",$login);
	}
	exit;

?>