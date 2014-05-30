<?php
require_once(SITE_DIR.'_common/_page.php');
require_once(SITE_DIR.'_classes/_factory/_PageFactory.php');

class Section
{
	var $id;
	var $parent_id;
	var $name;
	var $sort_order;
	var $pages;
	var $content;
	var $default_page;
	var $page;	
	var $active;
	
	function Section($id, $parent_id, $name, $sort_order, $default_page, $active)
	{
		$this->id = $id;
		$this->parent_id = $parent_id;
		$this->sort_order = $sort_order;
		$this->name = $name;
		$this->sort_order = $row['sort_index'];
		$this->default_page = $default_page;
		$this->page = & PageFactory::createPage($this->default_page);		
		$this->content = $this->page->content;
		$this->active = $active;
	}
	
	function findById()
	{
		$sql = "SELECT * FROM `site_sections` WHERE `section_id` = {$this->id}";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		$this->id = $row['section_id'];
		$this->parent_id = $row['parent_id'];
		$this->name = $row['name'];
		$this->sort_order = $row['sort_index'];
		$this->default_page = $row['default_page'];
		$this->page = & PageFactory::createPage($this->default_page);		
		$this->content = $this->page->content;
		$this->active = $row['active'];
	}

	function addSection()
	{
		$sql = "INSERT INTO `site_sections` (`parent_id`, `name`, `sort_index`, `active`, `default_page`) VALUES ('{$this->parent_id}','{$this->name}','{$this->sort_order}',1,'{$this->default_page}')";
		mysql_query($sql);
		$this->id = mysql_insert_id();
		$this->changeSortOrder($this->sort_order);
	}

	function editSection()
	{
		$sql = "UPDATE `site_sections` SET `parent_id`='{$this->parent_id}', `name`='{$this->name}', `sort_index`='{$this->sort_order}', `active`='{$this->active}', `default_page`='{$this->default_page}' WHERE `section_id` = '{$this->id}'";
		mysql_query($sql);
	}

	function deleteSection()
	{
		$sql = "DELETE FROM `site_sections` where `section_id` = '{$this->id}' LIMIT 1";
		mysql_query($sql);

		$sql = "DELETE FROM `site_pages` where `section_id` = '{$this->id}'";
		mysql_query($sql);
		$this->removePageFromSortOrder();
	}
	
	function getDisplay()
	{
	   if($this->page->type == '4' || $this->page->sort_order != '0' ){
	     return 'none';
	   } else {
	     return ($this->page->edit?'inline':'none');
	   }
	}
	
	function getViewDisplay()
	{
	   if($this->page->type == '4' || $this->page->id == '0'){
	     return 'none';
	   } else {
	     return 'inline';
	   }
	}
	
	function getViewLink(){
	  switch ($this->type) {
       case PAGE_TYPE_PAGE:return('../content.php?page='.$this->page->id);break;
     	 case PAGE_TYPE_HYPERLINK:return('../'.$this->page->filename);break;
     	 case PAGE_TYPE_DOWNLOAD:return('_common/download_file.php?f='.$this->page->filename);break;
     	 case PAGE_TYPE_IMAGE:return('../image.php?f='.$this->page->filename);break;
     	 default:return('../content.php?page='.$this->page->id);break;
     }
	}
	
	function getEditable(){
	  if($this->page->type == '4'){
	    return 'Stand-Alone Pages (these are not linked to the main navigation, but can be linked from other pages)';
	  } else {
	    return ($this->page->edit&&$this->page->sort_order=='0'?'':$this->name);
	  }
	}
	
	function getParentStatus()
	{
		if($this->page->del){
			return '<a href="content_pages.php?form_action=DeleteSection&id=' .$this->id. '" border="0" onClick="return confirm(\'Are you sure you want to delete this Section?\');"><img src="images/delete.gif" alt="Delete" width="20" height="20" border="0"></a>';
		}
	}

	function getActiveStatus()
	{
		return ($this->active?'active':'inactive');
	}


	function changeSectionActivationStatus()
	{
		if($this->active == '1')
			$new_status = 0;
		elseif($this->active == '0')
			$new_status = 1;	

		$sql = "UPDATE `site_sections` SET `active` = $new_status WHERE `section_id` = {$this->id}";
		mysql_query($sql);
	}

	
	function changeSortOrder($new_position)
	{
		$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$this->parent_id} AND `sort_order` >= {$new_position}";
		mysql_query($sql);
		$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = {$this->parent_id} AND `sort_index` >= {$new_position}";
		mysql_query($sql);
		$thisSql =  "UPDATE `site_sections` SET `sort_index` = {$new_position} WHERE `section_id` = {$this->id}";
		mysql_query($thisSql);
	}	

	function removePageFromSortOrder()
	{
		$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `section_id` = {$this->parent_id} AND `sort_order` > {$this->sort_order}";
		mysql_query($sql);
		$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` - 1) WHERE `parent_id` = {$this->parent_id} AND `sort_index` > {$this->sort_order}";
		mysql_query($sql);		
	}
	
	function changeSortOrderUp()
	{
		if($this->sort_order > 0)
		{

//UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = 2 AND (`sort_order` = 3 - 1)
//UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = 2 AND (`sort_index` = 3 - 1)
//UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `page_id` = 10

			$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$this->parent_id} AND (`sort_order` = {$this->sort_order} - 1)";
			mysql_query($sql);
			
			//$thisSql =  "UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `section_id` = {$this->id}";
			//mysql_query($thisSql);	
			
			$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = {$this->parent_id} AND (`sort_index` = {$this->sort_order} - 1)";
			mysql_query($sql);

			$thisSql =  "UPDATE `site_sections` SET `sort_index` = (`sort_index` - 1) WHERE `section_id` = {$this->id}";
			mysql_query($thisSql);	
			
		}
	}

	function changeSortOrderDown()
	{
	 //FIXED 24 Nov 2008 - Peter Turner

		/*
		if($this->parent_id){
			$maxSql = "SELECT MAX(`sort_order`) AS max FROM `site_pages` WHERE `section_id` = {$this->parent_id}";
		}
		else {
			$maxSql = "select MAX(`sort_index`) as max from `site_sections`";
		}
		*/
		
		$maxSql = "SELECT MAX(`site_pages`.`sort_order`) AS page_max, MAX(`site_sections`.`sort_index`) AS section_max FROM `site_pages`
      JOIN site_sections
      WHERE `site_pages`.`section_id` = {$this->parent_id} AND `site_sections`.`parent_id` = {$this->parent_id}";

		$maxRes = mysql_query($maxSql);
		$maxRow = mysql_fetch_array($maxRes);
		$page_max = $maxRow['page_max'];
		$section_max = $maxRow['section_max'];
		$max = max($page_max, $section_max);

		if($this->sort_order < $max)
		{
				$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `section_id` = {$this->parent_id} AND (`sort_order` = {$this->sort_order} + 1)";
				mysql_query($sql);
	
				//$thisSql =  "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$this->id}";
				//mysql_query($thisSql);	

				$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` - 1) WHERE `parent_id` = {$this->parent_id} AND (`sort_index` = {$this->sort_order} + 1)";
				mysql_query($sql);

				$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `section_id` = {$this->id}";
				mysql_query($sql);


		}
	}
		
}
?> 