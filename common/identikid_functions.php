<?

/*

IK FUNCTIONS

*/

function product_details($product_id, $currency, &$product)
{
	$sql = "SELECT * FROM product JOIN prices ON (product.id=prices.productID) JOIN currencies ON (prices.currencyInt=currencies.id) WHERE prices.currencyInt=" . (int)$currency . " AND product.id=" . (int)$product_id;
	$result = db_query($sql);
	if($result == true)
	{
		if((int)db_num_rows($result) == 1)
		{
			$product = db_fetch_array($result);
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