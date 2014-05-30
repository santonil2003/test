<?PHP

session_start();

unset($_COOKIE["currency"]);

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency");
	exit;
}

?>