<?php

/*
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

function html_pulldown($name, $values, $default="", $keys=false, $extra="", $print=true)
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

function form_param($param_name)
{
	assert(is_string($param_name));
	if(isset($_POST[$param_name]) == true)
	{
		return stripslashes(trim($_POST[$param_name]));
	}
	else 
	{
		return "";
	}
}

*/

?>
