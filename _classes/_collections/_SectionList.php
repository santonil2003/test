<?php
require_once(SITE_DIR.'_classes/_collections/_ListBase.php');
require_once(SITE_DIR.'_classes/_collections/_PageList.php');
require_once(SITE_DIR.'_common/_section.php');
class SectionList extends ListBase
{

	var $page_array;
	function SectionList()
	{
		//get pages results
		$sql = "SELECT * FROM `site_sections`  order by `sort_index` asc";
		$pageSql = "SELECT * FROM `site_sections` order by `sort_index` asc";
		$sectionList = mysql_query($sql);
		
		$i=0;
		while($row = mysql_fetch_array($sectionList))
		{
		
			$this->itemList[$i] = new Section($row['section_id'], $row['parent_id'], $row['name'], $row['sort_index'], $row['default_page'], $row['active']);
			$i++;
		
		}	
	}
}


?>