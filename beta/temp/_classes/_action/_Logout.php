<?php
class Logout
{
	function execute()
	{
		require_once(SITE_DIR.'_classes/_entity/_Employee.php');
		$_SESSION['siteuser'] = new User();
		$user = &$_SESSION['siteuser'];
		$user->type = ANONYMOUS_USER;		
	}
}
?>