<?


function convert_datetime_to_timestamp($datetime)
{
	
	if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", trim($datetime), $matches) == true)
	{
		return mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]);
	}
	else 
	{
		return $datetime;
	}
}


?>