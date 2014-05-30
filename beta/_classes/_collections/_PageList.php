<?php
require_once(SITE_DIR.'_classes/_collections/_ListBase.php');
require_once(SITE_DIR.'_common/_page.php');
class SectionedPageList extends ListBase
{
	function SectionedPageList($section)
	{
		//get pages results
		$sql = "SELECT * FROM `site_pages` WHERE `section_id` = {$section} AND `type` != ".PAGE_TYPE_SECTION_HEADER." ORDER BY `sort_order`";
		$pageList = mysql_query($sql);
		
		$i=0;
		while($row = mysql_fetch_array($pageList))
		{
			$this->itemList[$i] = new UserPage($row['page_id'], $row['name'], $row['page'], $section, $row['type'],  $row['active'], $row['sort_order'], $row['edit'], $row['delete']);
			$i++;
		}	
	}
}

class PageList extends ListBase
{
	function PageList()
	{
		//get pages results
		$sql = "SELECT * FROM `site_pages` ORDER BY `section_id`,`sort_order`";
		$pageList = mysql_query($sql);
		$i=0;
		while($row = mysql_fetch_array($pageList))
		{
			$this->itemList[$i] = new UserPage($row['page_id'], $row['name'], $row['page'], $row['section_id'], $row['type'], $row['active'], $row['sort_order'], $row['edit'], 1);
			$i++;
		}	
	}
	
	function getSectionPages($section_id)
	{
		$arr = array();
		$i = 0;
		while($i<count($this->itemList))
		{
			$obj = $this->itemList[$i];
			if($obj->section == $section_id && $obj->type != PAGE_TYPE_SECTION_HEADER)
			{
				$arr[$obj->sort_order] = $obj;
			}
	
			$i++;
		}
		return $arr;
	}
}
?>