<?

function getSendString(){


	$sendString = "&startMonth=".$_GET["startMonth"]."&startDay=".$_GET["startDay"]."&startYear=".$_GET["startYear"];
	$sendString .= "&endMonth=".$_GET["endMonth"]."&endDay=".$_GET["endDay"]."&endYear=".$_GET["endYear"];
	if(empty($_GET['quart']) == false && empty($_GET['yr']) == false)
	{
		$sendString .="&quart=".$_GET['quart']."&yr=".$_GET['yr'];
	}

	if(isset($_GET['Q2startYear'])  && isset($_GET['Q2startMonth']) && isset($_GET['Q2startDay']) && 
			isset($_GET['Q2endYear']) && isset($_GET['Q2endMonth']) && isset($_GET['Q2endDay']))
	{
		$sendString .= "&Q2startMonth=".$_GET["Q2startMonth"]."&Q2startDay=".$_GET["Q2startDay"]."&Q2startYear=".$_GET["Q2startYear"];
		$sendString .= "&Q2endMonth=".$_GET["Q2endMonth"]."&Q2endDay=".$_GET["Q2endDay"]."&Q2endYear=".$_GET["Q2endYear"];
		$sendString .="&Q2quart=".$_GET['Q2quart']."&Q2yr=".$_GET['Q2yr'];
	}
	$sendString .="&_gt=".$_GET['_gt'];
	return $sendString;
}

function getSentStat($fid, $yr, $quart){
	$query = "SELECT UNIX_TIMESTAMP(paiddate) AS paiddate FROM fundraisers_payments WHERE fid=".$fid." AND year=".$yr." AND quarter=".$quart;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());

	if(mysql_num_rows($result)>0){
		while($qdata=mysql_fetch_array($result)){
			$timestamp = $qdata["paiddate"];
		}
		return $timestamp;
	}else{
		return false;
	}
}


function getCommissionRecordsSummary($code, $startdate, $enddate){
	$query = "SELECT a.type, a.price FROM basket_items a, orders b, customers c WHERE"
	." a.ordernumber=b.id AND b.customer=c.id AND b.archived=0 AND c.referralcode='".$code."'"
	." AND b.finished > '". date('Y-m-d', $startdate-86400)."' AND b.finished < '" . date('Y-m-d', $enddate+86400) . "'";
	//echo $query;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	return $result;
}

function getCommissionFromRecSummary($result){
	while($qdata=mysql_fetch_array($result)){
	    if($qdata['price'] > 0){
		  $totalcommision+=getCommissionSummary($qdata["price"],$qdata["type"]);
		}
	}
//	echo $totalcommission;
	return $totalcommision;
}

function getCommissionSummary($price,$type){
	
	// starter pack 10%
	if($type==10)
	{
		return $price * 0.10;
	}
	// colour my world 10%
	elseif($type==21)
	{
		return $price * 0.10;
	}
	elseif($type==34)
	{
	  //maxi  pack.
	  return $price * 0.10;
	}
	elseif($type==35)
	{
	  //itty bitty pack.
	  return $price * 0.10;
	}
	else 
	{
	// commission has been changed to a set 15% by request of anne.
		return $price * 0.15;
	}
	
}

function getCommissionRecords($code, $startdate, $enddate){
	$query = "SELECT UNIX_TIMESTAMP(b.finished) as finished, b.id AS orderid, a.id, a.type, a.price, a.quantdesc, c.firstname, c.surname FROM basket_items a, orders b, customers c WHERE"
	." a.ordernumber=b.id AND b.customer=c.id AND b.archived=0 AND c.referralcode='".$code."'"
	." AND b.finished > '". date('Y-m-d', $startdate-86400)."' AND b.finished < '" . date('Y-m-d', $enddate+86400) . "'";
	//echo $query;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	return $result;
}

function getCommissionFromRec($result){
	while($qdata=mysql_fetch_array($result)){
	    if($qdata['price'] > 0){
		  $totalcommision+=getCommission($qdata["quantdesc"],$qdata["type"], $qdata);
		}
	}
//	echo $totalcommission;
	return $totalcommision;
}

function getCommission($quantdesc,$type,$qdata=false){
	global $mult;

	if($qdata){
		$price     = $qdata["price"];
	}
	
	// starter pack 10%
	if($type==10)
	{
		return $price * 0.10;
	}
	// colour my world 10%
	elseif($type==21)
	{
		return $price * 0.10;
	}
	elseif($type==34)
	{
	  //maxi  pack.
	  return $price * 0.10;
	}
	elseif($type==35)
	{
	  //itty bitty pack.
	  return $price * 0.10;
	}
	else
	{
	// commission has been changed to a set 15% by request of anne.
		return $price * 0.15;
	}
/*	


	// extract number from description
	$len=4;
	while(substr($quantdesc,0,$len)!=intval(substr($quantdesc,0,$len))){
		$len--;
		if($len==0){
			break;
		}
	}
	$quant = intval(substr($quantdesc,0,$len));
	if(($type>=1 && $type<=3)|| $type==8 || $type==9){
		// vinyl, iron on, mini, diy large and small
		$singleItem = 60;
		$singlePrice = 3;
	}else if($type==11){
		// mixed
		$singleItem = 1;
		$singlePrice = 3;
	}else if($type==13){
		// gift box
		$singleItem = 1;
		$singlePrice = .5;
	}else if($type==12){
		// birthday pack
		$singleItem = 1;
		$singlePrice = 3.5;
	}else if($type==6){
		// bag tags
		 $singleItem = 2;
		 $singlePrice = .75;
	}else if($type==4){
		// shoe labels
		$singleItem = 24;
		$singlePrice = 1.5;
	}else if($type==5){
		// pencil
		$singleItem = 60;
		$singlePrice = 1.5;
	}else if($type==10){
		// starter
		$singleItem = 1;
		$singlePrice = 4;
	}else if($type==7){
		// kidcards
		$singleItem = 1;
		$singlePrice = 2;
	}else if($type==14){
		// IdentiTags 15% of value
		return $price * 0.15;

	}else if($type==15){
		// Gift Vouchers 15% of the value;
		// can ignore quantitiy as they are bought as a single item.
		return $price * 0.15;
	}

	if($singleItem>0){
		$mult = ($quant/$singleItem);
		return ($mult*$singlePrice);
	}
	else {
		return 0;
	}
	
	*/

}
?>