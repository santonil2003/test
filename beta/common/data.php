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

// remove an element from an array
function array_remove_element($pos,$arr){
  	// $val = element index value, $arr = the subject array
  	//$i = array_search($val,$arr);
  //	if($i===false){
  //		return false;
	//}
  	//$arr = array_merge(array_slice($arr, 0,$i), array_slice($arr, $i+1));
	if($pos > 0){
		$leftarr = array_slice($arr, 0,$pos);
	} else {
		$leftarr = array();
	}
	$rightarr = array_slice($arr, $pos+1);
	/*
	echo "<br>----<br>";
	print_r($leftarr);
	echo "<br>";
	print_r($rightarr);
	echo "<br>----";
	*/
	$return_arr = array_merge($leftarr, $rightarr);
  	return $return_arr;
}

?>