<?
function getCurrencies(){
	$query = "SELECT * FROM currencies";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	$curr = array();
	$i=0;
	while($qdata = mysql_fetch_array($result)){
		$curr[$i] = array();
		$curr[$i]['id'] = $qdata['id'];
		$curr[$i]['currName'] = $qdata['currName'];
		$curr[$i]['symbol'] = $qdata['symbol'];
		$curr[$i]['postage'] = $qdata['postage'];
		$curr[$i]['expresspost'] = $qdata['expresspost'];
		$curr[$i]['freeGift'] = $qdata['freeGift'];
		$curr[$i]['minimumOrder'] = $qdata['minimumOrder'];
		$curr[$i]['fundraisers'] = $qdata['fundraisers'];
		$i++;
	}
	return $curr;
}

function getProducts(){
	$query = "SELECT * FROM product";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	$prods = array();
	$i=0;
	while($qdata = mysql_fetch_array($result)){
		$prods[$i] = array();
		$prods[$i]['id'] = $qdata['id'];
		$prods[$i]['productName'] = $qdata['productName'];
		$prods[$i]['unitQuant'] = $qdata['unitQuant'];
		$i++;
	}
	return $prods;
}
?>