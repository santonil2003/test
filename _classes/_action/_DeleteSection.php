<?php
class DeleteSection
{
	function execute()
	{
		require_once(SITE_DIR.'_common/_section.php');
		if($_GET['id'])
		{
			$section = new Section();
			$section->id = $_GET['id'];
			$section->findById();
			$section->deleteSection();

			require_once(SITE_DIR.'_classes/_page_elements/_MilonicBuilder.php');			
			$mb = new MilonicBuilder();
			$mb->buildMilonicMenu();			
		}
		else
		{
			trigger_error('At least ID must be provided to delete a document', E_USER_NOTICE);
		}
		return 1;
	}

}
?>
 