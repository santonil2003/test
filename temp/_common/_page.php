<?php 
class PageBase
{
	var $id;
	var $filename;
	var $title;
	var $page_title;
	var $permissions;
	
	
	function checkPermissions(&$user)
	{
		if(($this->permissions) && ($this->permissions != ANONYMOUS_USER))
		{
			$permitted = false;
			switch($user->type)
			{
				case $this->permissions:
					$permitted=true;
					break;
				default:
					$permitted=false;
					break;
			}
		}	
		else
		{
			$permitted = true;
		}
		return $permitted;
	}
}

class SystemPage extends PageBase
{
	function SystemPage($id, $filename, $title, $permissions)
	{
		$this->id = $id;
		$this->filename = $filename;
		$this->title = $title;
		$this->permissions = $permissions;
	}

	function render()
	{
		if(!include($this->filename)) trigger_error('Page '.$this->filename.' not found', E_USER_ERROR);
	}
		
}

class UserPage extends PageBase
{
	var $sort_order;
	var $section; 
	var $type;
	var $edit;
	var $del;
	var $content; 
	var $active;
	var $filename_short;
	
	function UserPage($id, $filename, $title, $section, $type, $active, $sort_order, $edit, $delete, $page_title)
	{
		$this->id = $id;
		$this->filename = $filename;
		$this->title = $title;
		$this->page_title = $page_title;
		$title = str_replace("'", "_",$title);
		$this->section = $section;
		$this->type = $type;
		$this->edit = $edit;
		$this->del = $delete;
		$this->content = file_get_contents(SITE_DIR.'_user_pages/'.trim($this->filename).'.php');
		$this->active = $active;
		$this->sort_order = $sort_order;		

	}

	function findById()
	{
		$selectSql = "SELECT * FROM `site_pages` WHERE `page_id` = '{$this->id}'";
		$selRes = mysql_query($selectSql);
		if(mysql_num_rows($selRes))
		{
			$row = mysql_fetch_array($selRes);
			$this->filename_short = trim($row['name']);
			$this->filename = SITE_DIR.'_user_pages/'.trim($row['name']).'.php';
			$this->title = $row['page'];
			$this->page_title = $row['page_title'];
			$this->section = $row['section_id'];
			$this->type = $row['type'];
			$this->edit = $row['edit'];
			$this->del = $row['delete'];
			$this->content = file_get_contents($this->filename);			
			$this->active  = $row['active'];
			$this->sort_order = $row['sort_order'];
		}
		else
		{
			trigger_error('Page not found! id:'.$this->id.'', E_USER_ERROR);
		}	
	}

	function addPage()
	{
		$file_name = $this->generateFileName();
		$full_file_name = SITE_DIR.'_user_pages/'.$file_name.'.php';

		$handle = fopen($full_file_name, 'w+');
		if(fwrite($handle, $this->content)===FALSE)
		{	
			trigger_error('File not saved - file error', E_USER_NOTICE);
		}
		else
		{
			$title = "test";
			$sql = "INSERT INTO `site_pages` (`page`, `section_id`, `name`, `type`, `edit`, `delete`, `active`, `page_title`) VALUES ('{$this->title}','{$this->section}','{$file_name}','{$this->type}', 1 , 1 , 1,'{$this->page_title}')";
			mysql_query($sql);
			$this->id = mysql_insert_id();
			$this->changeSortOrder($this->sort_order);
		}		
		fclose($handle);
		chmod($full_file_name, 0777);
	}

	function editPage()
	{
		$full_file_name = $this->filename_short;
		$handle = fopen($this->filename, 'w+');
		if(fwrite($handle, $this->content)===FALSE)
		{	
			trigger_error('File not saved - file error ' .$this->filename , E_USER_NOTICE);
		}
		else
		{
			$sql = "UPDATE `site_pages` SET `page_title`='{$this->page_title}', `page`='{$this->title}', `section_id`='{$this->section}', `name`='{$full_file_name}' WHERE `page_id` = {$this->id}";
			mysql_query($sql);
		}		
		fclose($handle);
		chmod($full_file_name, 0777);
	}

	function deletePage()
	{
	// added Jan 06
		$selectSql = "SELECT * FROM `site_pages` WHERE `page_id` = '{$this->id}'";
		$selRes = mysql_query($selectSql);
		if(mysql_num_rows($selRes))
		{
			$row = mysql_fetch_array($selRes);
			$this->filename_short = trim($row['name']);
			$try_this_filename = SITE_DIR.'_user_pages/'.trim($row['name']).'.php'; 
			$this->title = $row['page'];
			$this->page_title = $row['page_title'];
			$this->section = $row['section_id'];
			$this->type = $row['type'];
			$this->edit = $row['edit'];
			$this->del = $row['delete'];
			$this->content = file_get_contents($this->filename);			
			$this->active  = $row['active'];
			$this->sort_order = $row['sort_order'];
		}
		else
		{
			trigger_error('Page not found!', E_USER_ERROR);
		}

		$full_file_name = $try_this_filename;
		unlink($full_file_name);
		$sql = "DELETE FROM `site_pages` WHERE `page_id` = {$this->id}";
		mysql_query($sql);
		$this->removePageFromSortOrder();
	}

	function getActiveStatus()
	{
		return ($this->active?'active':'inactive');
	}
	
	function getVisibility(){
     return ($this->del?'visible':'hidden');
	}
	
	function getDisplay(){
	  return ($this->edit?'inline':'none');
	}
	
   function getEditable(){
	  return ($this->edit?'':$this->title);
	}

   function getType(){
     switch ($this->type) {
       case PAGE_TYPE_PAGE:return('page');break;
     	 case PAGE_TYPE_HYPERLINK:return('link');break;
     	 case PAGE_TYPE_DOWNLOAD:return('download');break;
     	 case PAGE_TYPE_IMAGE:return('image');break;
     	 default:return('page');break;
     }
	}
	
	function getViewLink(){
	  switch ($this->type) {
       case PAGE_TYPE_PAGE:return('../content.php?page='.$this->id);break;
     	 case PAGE_TYPE_HYPERLINK:return('../'.$this->filename);break;
     	 case PAGE_TYPE_DOWNLOAD:return('../_common/download_file.php?f='.$this->filename);break;
     	 case PAGE_TYPE_IMAGE:return('../image.php?f='.$this->filename);break;
     	 default:return('../content.php?page='.$this->id);break;
     }
	}
	
	function changePageActivationStatus()
	{
		if($this->active == 1)$new_status = 0;
		elseif($this->active == 0)$new_status = 1;
		$sql = "UPDATE `site_pages` SET `active` = $new_status WHERE `page_id` = {$this->id}";
		mysql_query($sql);
	}

	function generateFileName()
	{
		$file_name = strtolower(str_replace(' ', '/',str_replace("'", "_",str_replace(' ', '_', $this->title))));
		$i=1;
		while(file_exists(SITE_DIR.'_user_pages/'.$file_name.".php")){
			$file_name .= "_{$i}";
			$i++;
		}
		return $file_name;
	}
		
	function render()
	{
		//require_once(SITE_DIR.'_page_elements/_userpage_start.php');
		if(!include($this->filename)) trigger_error('Page '.$this->filename.' not found', E_USER_ERROR);
		//require_once(SITE_DIR.'_page_elements/_userpage_end.php');	
	}
	
	function changeSortOrderUp()
	{
		if($this->sort_order > 1)
		{
			$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$this->section} AND (`sort_order` = {$this->sort_order} - 1)";
			mysql_query($sql);
			$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = {$this->section} AND (`sort_index` = {$this->sort_order} - 1)";
			mysql_query($sql);
			$thisSql =  "UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `page_id` = {$this->id}";
			mysql_query($thisSql);	
		}
	}

	function changeSortOrderToZero()
	{
		$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$this->section} AND (`sort_order` > {$this->sort_order})";
		mysql_query($sql);
		$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = {$this->section} AND (`sort_index` > {$this->sort_order})";
		mysql_query($sql);
		$thisSql =  "UPDATE `site_pages` SET `sort_order` = 0 WHERE `page_id` = {$this->id}";
		mysql_query($thisSql);	
	}

	function changeSortOrderDown()
	{
		
		/*
		$maxSql = "SELECT MAX(`sort_order`) AS max FROM `site_pages` WHERE `section_id` = {$this->section}";
		$maxRes = mysql_query($maxSql);
		$maxRow = mysql_fetch_array($maxRes);
		$max = $maxRow['max'];
		*/
		
		$maxSql = "SELECT MAX(`site_pages`.`sort_order`) AS page_max, MAX(`site_sections`.`sort_index`) AS section_max FROM `site_pages`
      JOIN site_sections
      WHERE `site_pages`.`section_id` = {$this->section} AND `site_sections`.`parent_id` = {$this->section}";

		$maxRes = mysql_query($maxSql);
		$maxRow = mysql_fetch_array($maxRes);
		$page_max = $maxRow['page_max'];
		$section_max = $maxRow['section_max'];
		$max = max($page_max, $section_max);
		
		if($this->sort_order < $max)
		{
			$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `section_id` = {$this->section} AND (`sort_order` = {$this->sort_order} + 1)";
			mysql_query($sql);
			$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` - 1) WHERE `parent_id` = {$this->section} AND (`sort_index` = {$this->sort_order} + 1)";
			mysql_query($sql);
			$thisSql =  "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `page_id` = {$this->id}";
			mysql_query($thisSql);	
		}
	}
	
	function changeSortOrder($new_position)
	{
		$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$this->section} AND `sort_order` >= {$new_position}";
		mysql_query($sql);
		$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = {$this->section} AND `sort_index` >= {$new_position}";
		mysql_query($sql);		
		$thisSql =  "UPDATE `site_pages` SET `sort_order` = {$new_position} WHERE `page_id` = {$this->id}";
		mysql_query($thisSql);
	}
	
	function removePageFromSortOrder()
	{
		$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` - 1) WHERE `section_id` = {$this->section} AND `sort_order` > {$this->sort_order}";
		mysql_query($sql);
		$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` - 1) WHERE `parent_id` = {$this->section} AND `sort_index` > {$this->sort_order}";
		mysql_query($sql);		
	}
	
	function getNextSortOrder()
	{
		return $this->sort_order+1;
	}
	
	function updateSectionPage($section_id)
	{
		$sql = "UPDATE `site_pages` SET `section_id` = '{$section_id}' WHERE `page_id` = {$this->id}";
		mysql_query($sql);
	}	

	function getSectionName()
	{
		$sql = "SELECT name from `site_sections` where section_id = '{$this->section}'";
		$result = mysql_query($sql);

		$row = mysql_fetch_array($result);
		return $row['name'];	
	}
}

//Added by Sean for News
class News extends PageBase
{
	var $active;
	var $filename_short;
	
	function News($id)
	{
		$this->id = $id;
		$this->filename = $filename;
		//$this->content = file_get_contents(SITE_DIR.'_user_pages/'.trim($this->filename).'.php');
	}
	
	function render()
	{
		//require_once(SITE_DIR.'_page_elements/_userpage_start.php');
		if(!include($this->filename)) trigger_error('Page '.$this->filename.' not found', E_USER_ERROR);
		//require_once(SITE_DIR.'_page_elements/_userpage_end.php');	
	}
	
	function findById()
	{
		$selectSql = "SELECT * FROM `site_news` WHERE `page_id` = '{$this->id}'";
		$selRes = mysql_query($selectSql);
		if(mysql_num_rows($selRes))
		{
			$row = mysql_fetch_array($selRes);
			$this->filename_short = trim($row['name']);
			$this->filename = SITE_DIR.'_user_pages/'.trim($row['name']).'.php';
			$this->title = $row['page'];
			//$this->section = $row['section_id'];
			//$this->type = $row['type'];
			$this->content = file_get_contents($this->filename);			
			$this->active  = $row['active'];
			//$this->sort_order = $row['sort_order'];
		}
		else
		{
			trigger_error('Page not found! eek', E_USER_ERROR);
		}	
	}
}

?>