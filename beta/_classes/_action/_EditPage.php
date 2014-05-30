<?php
class EditPage
{
	function execute()
	{
		require_once(SITE_DIR.'_common/_page.php');
		if($_POST['spaw1']&&$_POST['title'])
		{
			$page = new UserPage();
			$page->id = $_POST['page_id'];
			$page->findById();
			$page->title = stripslashes($_POST['title']);
			$page->page_title = stripslashes($_POST['page_title']);
			$page->content = stripslashes($_POST['spaw1']); 
			$page->editPage();

			// creates internal links menu.
			require_once(SITE_DIR.'_classes/_page_elements/_InternalLinksBuilder.php');			
			$mb = new InternalLinksBuilder();
			$mb->buildInternalLinks();	

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
 