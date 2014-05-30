<?PHP
	session_start();
	
	if($_POST['postage'] == "Normal")
	{
		$_SESSION["post_option"] = "Normal";
	}
	
	elseif($_POST['postage'] == "Australian Express")
	{
		$_SESSION["post_option"] = "Australian Express";
	}
	else 
	{
		$_SESSION["post_option"] = "Overseas Express";
	}

	header("location:view_order.php");
?>