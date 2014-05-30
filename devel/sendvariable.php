<?PHP
	
	$variable = $_POST['variable'];
	
	if ($variable=='')
		echo "Variable is empty!";
	else
		echo "Variable = " . $variable; 


?>