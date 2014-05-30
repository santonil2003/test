<?php
header("Cache-control: private");
include("_common/_connection.php");
linkme();


if(isset($_GET['test'])){
	$_COOKIE['currency']=1;
}
// && isset($_COOKIE["currency"])

if(isset($_GET["productId"]) && isset($_COOKIE["currency"])){
	
	// ZIP TAGS
	if($_GET["productId"]==22){
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 22 AND 23 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			echo "&id".$k."=".$qdata["id"]."&description".$k."=".$qdata["productName"]."&symbol=".str_replace("€","EURO", $qdata["symbol"])."&unitQuant".$k."=".$qdata["unitQuant"];
			$k++;
		}
		
	// price	
		$query = "SELECT price FROM prices WHERE productID BETWEEN 22 AND 23 AND currencyInt=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			$theprice = $qdata["price"];
			settype($theprice,"string");
			echo "&price".$k."=".$theprice;
			$k++;
		}
			
		$sql = "SELECT * FROM prices_reverse_text WHERE prod_id = 22";
		$result = mysql_query($sql) or die("sql error reverse text");
		$row = mysql_fetch_assoc($result);
		$zip3 = $row["reverse_text_price"];
		echo "&reverseprice=".$zip3;						  
		
}   }
?>