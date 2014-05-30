<?php

class EditSection
{

	function execute()
	{
		if($_POST['section_id'] && $_POST['spaw1']&&$_POST['name'])
		{
			require_once(SITE_DIR.'_common/_section.php');
			require_once(SITE_DIR.'_common/_page.php');
			$section = new Section();
			$section->id = $_POST['section_id'];
			$section->findById();

			$page = &$section->page;
			if($page->sort_order === 0 && $_POST['list_as_page']) $page->changeSortOrderDown();
			if($page->sort_order > 0 && ! $_POST['list_as_page']) $page->changeSortOrderToZero();
			$page->title = stripslashes($_POST['title']);
			$page->page_title = stripslashes($_POST['page_title']);
			$page->content = stripslashes($_POST['spaw1']);
			$page->editPage();

			
			$section->name = $_POST['name'];
			$section->editSection();

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
