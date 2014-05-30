<?PHP
	session_start();
	
	if(!isset($_POST['thecurrency']))
	{
		header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	}
	else
	{
		$chosencurrency = $_POST['thecurrency'];
		setcookie("currency", $chosencurrency);
		if (isset($_GET["returnurl"]) && $_GET["returnurl"]!='')
			header("Location:".$_GET["returnurl"]);
		else
		header("location:products_home.php");
	}
	
?>