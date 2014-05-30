<?php
class AddPage
{
	function execute()
	{
		require_once(SITE_DIR.'_common/_page.php');
		if($_POST['spaw1']&&$_POST['title'])
		{
			$page = new UserPage();
			$page->title = str_replace("'", "''",stripslashes($_POST['title']));
			$page->page_title = str_replace("'", "''",stripslashes($_POST['page_title']));
			$page->section = $_POST['section_id']; 
			$page->type=0;
			$page->content = stripslashes($_POST['spaw1']); 
			$page->sort_order = $_POST['sort_order'];
			$page->addPage();

			// creates internal links menu.
			require_once(SITE_DIR.'_classes/_page_elements/_InternalLinksBuilder.php');			
			$mb = new InternalLinksBuilder();
			$mb->buildInternalLinks();	

			//now update Milonic Menus
			require_once(SITE_DIR.'_classes/_page_elements/_MilonicBuilder.php');			
			$mb = new MilonicBuilder();
			$mb->buildMilonicMenu();
		}
		else
		{
			trigger_error('All fields must have data entered', E_USER_NOTICE);
		}
		return 1;
	}

}
?>
 