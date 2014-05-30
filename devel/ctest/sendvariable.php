<?PHP
	
	$var = $_POST['variable_send'] + 10;
	if ( strlen($_POST['variable_send']) == 0 )
		echo "Variable is empty!";
	else
		echo "variable=" . $var . " from the php file"; 

?>