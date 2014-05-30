<?

/*

IK FUNCTIONS

*/

function product_details($product_id, $currency, &$product)
{
	//$sql = "SELECT * FROM product JOIN prices ON (product.id=prices.productID) JOIN currencies ON (prices.currencyInt=currencies.id) WHERE prices.currencyInt=" . (int)$currency . " AND product.id=" . (int)$product_id;
	$sql = "SELECT * FROM prices a, currencies b, product c WHERE a.productId='{$product_id}' AND a.productId=c.id AND a.currencyInt='1' AND b.id ='{$currency}'";		
	$result = db_query($sql);
	if($result == true)
	{
		if((int)db_num_rows($result) == 1)
		{
			$product = db_fetch_array($result);
			if($_COOKIE["currency"]=='1') {
		    	  $product['price'] = number_format(toDollarsAndCents($product['price'] * $product['rate']), 2, '.', '');
		        } else {
	      		  $product['price'] = number_format(round(toDollarsAndCents($product['price'] * $product['rate']),1), 2, '.', '');
			}
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

function html_pulldown2($name, $values, $default="", $keys=false, $extra="", $print=true)
{

	$output_text = "<select name=\"{$name}\" {$extra}>\n";
	foreach($values as $key => $value)
	{
		$key = ($keys==true)?$key:$value;
		if(strcmp($key,$default) == 0)
		{
			$SELECTED = "SELECTED";
		}
		else 
		{
			$SELECTED = "";
		}
		$output_text .= "<option value=\"{$key}\" {$SELECTED}>{$value}</option>\n";
	}
	$output_text .= "</select>\n";
	
	if($print == true)
	{
		echo $output_text;
	}
	else 
	{
		return $output_text;
	}
}

?>