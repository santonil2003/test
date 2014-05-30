<?

/*

IK FUNCTIONS

*/

function product_details($product_id, $currency, $product_name, $product_price)
{
	$sql = "SELECT * FROM product JOIN prices ON (product.id=prices.productID) JOIN currencies ON (prices.currencyInt=currencies.id) WHERE prices.currencyInt=" . (int)$currency . " AND product.id=" . (int)$product_id;
	$result = db_query($sql);
	if($result == true)
	{
		if((int)db_num_rows($result) == 1)
		{
			$record = db_fetch_array($result);
			$product_name = $record['productName'];
			$product_price = $record['unitQuant']." for ".$record['symbol'].$record['price'];
			return true;
		}		
		else 
		{
			return false;
		}
	}
	else 
	{
		return false;
	}
}

?>