<?php
require_once(SITE_DIR.'_classes/_collections/_ListBase.php');
require_once(SITE_DIR.'_classes/_entity/_AdministratorUpdateItem.php');
class AdministratorUpdateList extends ListBase
{
	function AdministratorUpdateList($start, $num_per_page, $order_by)
	{
		//set paging vars
		$this->start = $start;
		$this->num_per_page = $num_per_page;

		//get total
		$sql_total = "SELECT * FROM `update_items` u WHERE u.type = ".ADMINISTRATOR;
		$this->total = mysql_num_rows(mysql_query($sql_total));

		//get pages results
		$sql_select_start = "SELECT * FROM `update_items` u WHERE u.type = ".ADMINISTRATOR;
		if($order_by) $sql_order_by = " ORDER BY '$order_by'";
		if($this->num_per_page) $sql_select_limit = " LIMIT $start,$num_per_page";
		$sql = $sql_select_start . $sql_order_by . $sql_select_limit;
		$administratorList = mysql_query($sql);
		$i=0;
		while($row = mysql_fetch_array($administratorList))
		{
			$this->itemList[$i] = new AdministratorUpdateItem($row['id'], $row['create_date'], $row['title'], $row['filename'], $row['active']);
			$i++;
		}	
	}
}
?>