<?

function array_to_csv($array)
{
	foreach($array as $key => $value)
	{
		if(preg_match('/("|,)/', $value) > 0)
		{
			$array[$key] = '"' . str_replace('"', '""', $value) . '"';
		}
	}
	return join(",", $array);
}

?>