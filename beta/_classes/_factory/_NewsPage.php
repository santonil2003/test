<?php 
//News pages
class NewsPage 
{
	function createPage($id)
	{
		if(require_once("/home/cpawa/public_html/_common/_page.php"))	//include & check that was included
		{
			$pg = new News();
			$pg->id = $id;						
			$pg->findById();
		}

		return $pg;
	}
}
?>