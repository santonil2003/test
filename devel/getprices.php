<?
header("Cache-control: private");
include("common_db.php");
linkme();
echo $_GET["productId"];

if(isset($_GET['test'])){
	$_COOKIE['currency']=1;
}
// && isset($_COOKIE["currency"])

if(isset($_GET["productId"]) && isset($_COOKIE["currency"]) || isset($_GET['test'])){
	
	
	if($_GET["productId"]==6){
		$query = "SELECT * FROM currencies a, product b WHERE b.id=".$_GET["productId"]." AND a.id=".$_COOKIE["currency"];
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		while($qdata = mysql_fetch_array($result)){
			echo "&id=".$qdata["id"]."&description=".$qdata["productName"]."&symbol=".str_replace("�","EURO", $qdata["symbol"])."&unitQuant=".$qdata["unitQuant"];
		}
		
		$query = "SELECT * FROM prices_bagtags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$k=1;
		while($qdata = mysql_fetch_array($result)){
			echo "&price".$k."=".$qdata["price"];
			$k++;
		}
		
	// Zipdedo Tags
	}elseif($_GET["productId"]==28){
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 28 AND 29 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			echo "&id".$k."=".$qdata["id"]."&description".$k."=".$qdata["productName"]."&symbol=".str_replace("�","EURO", $qdata["symbol"])."&unitQuant".$k."=".$qdata["unitQuant"];
			$k++;
		}
		
		// price	
		$query = "SELECT price FROM prices WHERE productID BETWEEN 28 AND 29 AND currencyInt=".$_COOKIE["currency"];
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
	
	// Address Labels
	}elseif($_GET["productId"]==24){
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 24 AND 26 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			echo "&id".$k."=".$qdata["id"]."&description".$k."=".$qdata["productName"]."&symbol=".str_replace("�","EURO", $qdata["symbol"])."&unitQuant".$k."=".$qdata["unitQuant"];
			$k++;
		}
		
	// price	
		$query = "SELECT price FROM prices WHERE productID BETWEEN 24 AND 26 AND currencyInt=".$_COOKIE["currency"];
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
		
	}else if($_GET["productId"]==14){
		$query = "SELECT * FROM currencies a, product b WHERE b.id=".$_GET["productId"]." AND a.id=".$_COOKIE["currency"];
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
		$resulte = mysql_query($mysql) or die ("sql error");
		$rowe = mysql_fetch_assoc($resulte) or die ("sql error");
		$reverseprice = $rowe["reverse_text_price"];
		
		while($qdata = mysql_fetch_array($result)){
			echo "&id=".$qdata["id"]."&description=".$qdata["productName"]."&symbol=".str_replace("�","EURO", $qdata["symbol"])."&unitQuant=".$qdata["unitQuant"]."&reverse=".$reverseprice;
		}
		
		$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$k=1;
		while($qdata = mysql_fetch_array($result)){
			if ($_GET["reverse"]==1){
				echo "&price".$k."=".$qdata["price"]+2;
			}
			else
			{
				echo "&price".$k."=".$qdata["price"];
			}
			$k++;
		}
	}else{
		$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=".$_GET["productId"]." AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		while($qdata = mysql_fetch_array($result)){
			echo "&id=".$qdata["id"]."&price=".$qdata["price"]."&description=".$qdata["productName"]."&symbol=".str_replace("�","EURO", $qdata["symbol"])."&unitQuant=".$qdata["unitQuant"];
		}
		//echo $query;
	}
}
?>