<?php

class AddSection
{
	var $page ;
	
	function execute()
	{
		if($_POST['spaw1']&& $_POST['name'])
		{
			require_once(SITE_DIR.'_common/_section.php');
			require_once(SITE_DIR.'_common/_page.php');
			$this->page = new UserPage();


			if($_POST['list_as_page'] == "yes" && !empty($_POST['title'])){
				$title = str_replace("'", "''",stripslashes($_POST['title']));
			}
			else {
				$title = str_replace("'", "''",stripslashes($_POST['name']));
			}
			$this->page->title = str_replace("'", "''",stripslashes($title));
			$this->page->page_title = str_replace("'", "''",stripslashes($_POST['page_title']));
			$this->page->type=0;
			$this->page->content = stripslashes($_POST['spaw1']); 
			if($_POST['list_as_page']) $this->page->sort_order = 1;
			else $this->page->sort_order = 0;
			$this->page->addPage();

		
			$section = new Section();
			$section->parent_id = $_POST['parent_id'];
			$section->name = str_replace("'", "''",stripslashes($_POST['name']));
			$section->default_page=$this->page->id;
   		$section->sort_order = $_POST['sort_order'];
			$section->addSection();

			$this->page->updateSectionPage($section->id);

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
