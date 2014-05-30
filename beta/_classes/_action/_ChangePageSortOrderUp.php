<?php
class ChangePageSortOrderUp
{
	function execute()
	{
		require_once(SITE_DIR.'_common/_page.php');
		if($_GET['id'])
		{
			$page = new UserPage();
			$page->id = $_GET['id'];
			$page->findById();
			$page->changeSortOrderUp();
			require_once(SITE_DIR.'_classes/_page_elements/_MilonicBuilder.php');			
			$mb = new MilonicBuilder();
			$mb->buildMilonicMenu();			
		}
		else
		{
			trigger_error('At least ID must be provided to change a page\'s status', E_USER_NOTICE);
		}
		return 1;
	}
}
?>