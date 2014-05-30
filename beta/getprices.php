<?
//header("Cache-control: private");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
include("_common/_connection.php");
include("useractions.php");
linkme();

function getCurrency($curr_id){
	$query = "SELECT * FROM currencies WHERE id = '{$curr_id}' LIMIT 1";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	$qdata = mysql_fetch_array($result);
	$curr = array();
	$curr['id'] = $qdata['id'];
	$curr['currName'] = $qdata['currName'];
	$curr['symbol'] = $qdata['symbol'];
	$curr['rate'] = $qdata['rate'];
	$curr['postage'] = $qdata['postage'];
	$curr['expresspost'] = $qdata['expresspost'];
	$curr['freeGift'] = $qdata['freeGift'];
	$curr['minimumOrder'] = $qdata['minimumOrder'];
	$curr['fundraisers'] = $qdata['fundraisers'];

	return $curr;
}

if(isset($_GET['test'])){
	$_COOKIE['currency']=1;
}
// && isset($_COOKIE["currency"])

$curr = getCurrency($_COOKIE["currency"]);

if(isset($_GET["productId"]) && isset($_COOKIE["currency"]) || isset($_GET['test'])){
	
	
	if($_GET["productId"]==6){
		$query = "SELECT * FROM currencies a, product b WHERE b.id=".$_GET["productId"]." AND a.id=".$_COOKIE["currency"];

		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		 while($qdata = mysql_fetch_array($result)){
			echo "&id=".$qdata["id"]."&description=".$qdata["productName"]."&symbol=".str_replace("&euro;","EURO", $qdata["symbol"])."&unitQuant=".$qdata["unitQuant"];
		}
		 
		
		//$query = "SELECT * FROM prices_bagtags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
		
		$query = "SELECT * FROM prices_bagtags WHERE currencyInt=1 ORDER BY multiplier";
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$k=1;
		while($qdata = mysql_fetch_array($result)){
		  if($_COOKIE["currency"]=='1') {
		    echo "&price".$k."=".$qdata["price"]; 
		  } else {
		    echo "&price".$k."=".number_format(round(toDollarsAndCents($qdata["price"]*$curr['rate']),1), 2, '.', '');
		  }
			//echo "&price".$k."=".$qdata["price"];
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
			echo "&id".$k."=".$qdata["id"]."&description".$k."=".$qdata["productName"]."&symbol=".str_replace("&euro;","EURO", $qdata["symbol"])."&unitQuant".$k."=".$qdata["unitQuant"];
			$k++;
		}
		
		// price	
		//$query = "SELECT price FROM prices WHERE productID BETWEEN 28 AND 29 AND currencyInt=".$_COOKIE["currency"];
		$query = "SELECT price FROM prices WHERE productID BETWEEN 28 AND 29 AND currencyInt=1";
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
		  if($_COOKIE["currency"]=='1') {
		    $theprice = $qdata["price"];  
		  } else {
		    $theprice = number_format(round(toDollarsAndCents($qdata["price"]*$curr['rate']),1), 2, '.', '');
		  }
		   //$theprice = $qdata["price"];
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
			echo "&id".$k."=".$qdata["id"]."&description".$k."=".$qdata["productName"]."&symbol=".str_replace("&euro;","EURO", $qdata["symbol"])."&unitQuant".$k."=".$qdata["unitQuant"];
			$k++;
		}
		
	// price	
		//$query = "SELECT price FROM prices WHERE productID BETWEEN 24 AND 26 AND currencyInt=".$_COOKIE["currency"];
		$query = "SELECT price FROM prices WHERE productID BETWEEN 24 AND 26 AND currencyInt=1";
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			if($_COOKIE["currency"]=='1') {
		    $theprice = $qdata["price"];  
		  } else {
		    $theprice = number_format(round(toDollarsAndCents($qdata["price"]*$curr['rate']),1), 2, '.', '');
		  }
		   //$theprice = $qdata["price"];
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
			echo "&id=".$qdata["id"]."&description=".$qdata["productName"]."&symbol=".str_replace("&euro;","EURO", $qdata["symbol"])."&unitQuant=".$qdata["unitQuant"]."&reverse=".$reverseprice;
		}
		
		//$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
		$query = "SELECT * FROM prices_identitags WHERE currencyInt=1 ORDER BY multiplier";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$k=1;
		while($qdata = mysql_fetch_array($result)){
		  if($_COOKIE["currency"]=='1') {
		    if ($_GET["reverse"]==1){
				echo "&price".$k."=".$qdata["price"]+2;
			 }
			 else
			 {
				echo "&price".$k."=".$qdata["price"];
			 }
		  } else {
		    if ($_GET["reverse"]==1){
				echo "&price".$k."=".number_format(round(toDollarsAndCents(($qdata["price"]+2)*$curr['rate']),1), 2, '.', '');
			 }
			 else
			 {
				echo "&price".$k."=".number_format(round(toDollarsAndCents($qdata["price"]*$curr['rate']),1), 2, '.', '');
			 }
		  }
		   
			/*
			 if ($_GET["reverse"]==1){
				echo "&price".$k."=".$qdata["price"]+2;
			}
			else
			{
				echo "&price".$k."=".$qdata["price"];
			}
			*/
			$k++;
		}
	}else{
		//$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=".$_GET["productId"]." AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
      $query = "SELECT * FROM prices a, product b WHERE a.productId=".$_GET["productId"]." AND a.productId=b.id AND a.currencyInt='1'";

      //print $query;
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		while($qdata = mysql_fetch_array($result)){
		  $price = 0;
		  if($_COOKIE["currency"]=='1') {
		    $price = $qdata["price"];  
		  } else {
		    $price = number_format(round(toDollarsAndCents($qdata["price"]*$curr['rate']),1), 2, '.', '');
		  }
			echo "&id=".$qdata["id"]."&price=".$price."&description=".$qdata["productName"]."&symbol=".str_replace("&euro;","EURO", $curr["symbol"])."&unitQuant=".$qdata["unitQuant"];
		}
	}
}
?>