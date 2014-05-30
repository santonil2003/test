<?php
require_once(SITE_DIR.'_classes/_collections/_ListBase.php');
require_once(SITE_DIR.'_classes/_collections/_PageList.php');
require_once(SITE_DIR.'_classes/_collections/_SectionList.php');
require_once(SITE_DIR.'_common/_section.php');
class SubSectionPageList extends ListBase
{
	var $section_id;
	var $max_sort_order;
	
	function SubSectionPageList($section_id)
	{
		$this->section_id = $section_id;
		//get pages results
		$sectionMaxSql = "SELECT MAX(`sort_order`) AS max FROM `site_sections` WHERE `parent_id` = {$this->section_id}";
		$pageMaxSql = "SELECT MAX(`sort_order`) FROM `site_pages` WHERE `section_id = {$this->section_id}";
		$sectionListRes = mysql_query($sectionMaxSql);
		$sectionMaxRow = mysql_fetch_array($sectionListRes);
		$sectionMax = $sectionMaxRow['max'];
		$pageMaxRes = mysql_query($pageMaxSql);
		$pageMaxRow = mysql_fetch_array($pageMaxRes);
		$pageMax = $pageMaxRow['max'];
		
		$this->max_sort_order = max($sectionMax, $pageMax);
		$sectionSql = "SELECT * FROM `site_sections` AS max WHERE `parent_id` = {$this->section_id}";
		$pageSql = "SELECT * FROM `site_pages` WHERE `section_id` = {$this->section_id}";
		$sectionList = mysql_query($sectionSql);
		$pageList = mysql_query($pageSql);
		$i=0;

		if(mysql_num_rows($sectionList)>0) 
		{
			while($row = mysql_fetch_array($sectionList))
			{
//				$this->itemList[$row['sort_index']] = new Section($row['section_id'], $row['parent_id'], $row['name'], $row['sort_index'], $row['filename']);
				$this->itemList[$row['sort_index']] = new Section($row['section_id'], $row['parent_id'], $row['name'], $row['sort_index'], $row['default_page'], $row['active']);
				$i++;
			}
		}

		if(mysql_num_rows($pageList)>0) 
		{
			while($row = mysql_fetch_array($pageList))
			{
				$this->itemList[$row['sort_order']] = new UserPage($row['page_id'], $row['name'], $row['page'], $row['section_id'], $row['type'], $row['active'], $row['sort_order'], $row['edit'], $row['delete']);
				$i++;
			}			
		}


		
		ksort($this->itemList);	
	}
	

}

?>