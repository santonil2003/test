<?
require_once('../_common/_constants.php');
require_once(SITE_DIR.'_common/_connection.php'); 
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();

function get_ex_rate() {

  $currency_array = xml2array("http://www.rba.gov.au/rss/rss-cb-exchange-rates.xml");
  //print_r($currency_array);

  foreach($currency_array['rdf:RDF']['item'] as $item) {

    switch($item['cb:statistics']['cb:exchangeRate']['cb:targetCurrency']) {
      case "USD":
        $sql = "UPDATE currencies SET rate = {$item['cb:statistics']['cb:exchangeRate']['cb:observation']['cb:value']} WHERE id = '2' LIMIT 1";
        mysql_query($sql);
        break;
      case "NZD":
        $sql = "UPDATE currencies SET rate = {$item['cb:statistics']['cb:exchangeRate']['cb:observation']['cb:value']} WHERE id = '5' LIMIT 1";
        mysql_query($sql);
        break;
      case "EUR": 
        $sql = "UPDATE currencies SET rate = {$item['cb:statistics']['cb:exchangeRate']['cb:observation']['cb:value']} WHERE id = '3' LIMIT 1";
        mysql_query($sql);
        break;
      default:break;
    }
    //print("1 AUD$ = ".$item['cb:statistics']['cb:exchangeRate']['cb:targetCurrency']." ".$item['cb:statistics']['cb:exchangeRate']['cb:observation']['cb:value']."<br>");
  } 
} 


function xml2array($url, $get_attributes = 1, $priority = 'tag')
{
    $contents = "";
    if (!function_exists('xml_parser_create'))
    {
        return array ();
    }
    $parser = xml_parser_create('');
    if (!($fp = @ fopen($url, 'rb')))
    {
        return array ();
    }
    while (!feof($fp))
    {
        $contents .= fread($fp, 8192);
    }
    fclose($fp);
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if (!$xml_values)
        return; //Hmm...
    $xml_array = array ();
    $parents = array ();
    $opened_tags = array ();
    $arr = array ();
    $current = & $xml_array;
    $repeated_tag_index = array ();
    foreach ($xml_values as $data)
    {
        unset ($attributes, $value);
        extract($data);
        $result = array ();
        $attributes_data = array ();
        if (isset ($value))
        {
            if ($priority == 'tag')
                $result = $value;
            else
                $result['value'] = $value;
        }
        if (isset ($attributes) and $get_attributes)
        {
            foreach ($attributes as $attr => $val)
            {
                if ($priority == 'tag')
                    $attributes_data[$attr] = $val;
                else
                    $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }
        if ($type == "open")
        {
            $parent[$level -1] = & $current;
            if (!is_array($current) or (!in_array($tag, array_keys($current))))
            {
                $current[$tag] = $result;
                if ($attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                $current = & $current[$tag];
            }
            else
            {
                if (isset ($current[$tag][0]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    );
                    $repeated_tag_index[$tag . '_' . $level] = 2;
                    if (isset ($current[$tag . '_attr']))
                    {
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset ($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = & $current[$tag][$last_item_index];
            }
        }
        elseif ($type == "complete")
        {
            if (!isset ($current[$tag]))
            {
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
            }
            else
            {
                if (isset ($current[$tag][0]) and is_array($current[$tag]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    if ($priority == 'tag' and $get_attributes and $attributes_data)
                    {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    );
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes)
                    {
                        if (isset ($current[$tag . '_attr']))
                        {
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset ($current[$tag . '_attr']);
                        }
                        if ($attributes_data)
                        {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                }
            }
        }
        elseif ($type == 'close')
        {
            $current = & $parent[$level -1];
        }
    }
    return ($xml_array);
}
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
		$curr[$i]['rate'] = $qdata['rate'];
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