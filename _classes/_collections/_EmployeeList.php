<?php
require_once(SITE_DIR.'_classes/_collections/_ListBase.php');
require_once(SITE_DIR.'_classes/_entity/_Employee.php');
class EmployeeList extends ListBase
{
	function EmployeeList($start, $num_per_page, $order_by, $where, $search_field)
	{
		//set paging vars
		$this->start = $start;
		$this->num_per_page = $num_per_page;
		$sqlWhere = " WHERE `LastName` NOT LIKE ('%(T)%') ";
		//build WHERE clause
		if(($where!='') && (!empty($where)))
		{
			if($search_field!='in') $whereArray = explode(" ", $where);
			foreach($whereArray as $key => $val)
			{
				if($sqlWhere == " WHERE `LastName` NOT LIKE ('%(T)%') ") $sqlWhere .= " AND ";
				elseif($sqlWhere != " WHERE `LastName` NOT LIKE ('%(T)%') ") $sqlWhere .= " OR ";
				if(empty($search_field))				
					$sqlWhere .= " `FirstName` LIKE('%$val%') OR `LastName` LIKE ('%$val%') OR `ErName` LIKE ('%$val%') OR `PostalCity` LIKE ('%$val%') OR `Email` LIKE ('%$val%') OR `PostalAddress1` LIKE ('%$val%') OR e.EeId LIKE ('%$val%')";
				elseif($seach_field == 'in')
					$sqlWhere .= " e.$search_field IN($val)";				
				else
					$sqlWhere .= " e.$search_field LIKE('%$val%')";				
			}
			//loop thru array to get all WHERE elements
		}		
		//get total
		$sql_total = "SELECT e.*, p.password FROM `employees` e LEFT OUTER JOIN `passwords` p ON e.EeId = p.EeId ".$sqlWhere;
		$this->total = mysql_num_rows(mysql_query($sql_total));

		//get pages results
		$sql_select_start = "SELECT e.*, p.password, p.last_login FROM `employees` e LEFT OUTER JOIN `passwords` p ON e.EeId = p.EeId ".$sqlWhere;
		if(!empty($order_by))
		$sql_order_by = " ORDER BY ".($order_by != 'EeId'?"`$order_by`":"e.$order_by");
		if($this->num_per_page) $sql_select_limit = " LIMIT $start,$num_per_page";
		$sql = $sql_select_start . $sql_order_by . $sql_select_limit;
		$employeeList = mysql_query($sql);
		$i=0;
		while($row = mysql_fetch_array($employeeList))
		{
			$this->itemList[$i] = new Employee($row['EeId'], $row['FirstName'], $row['LastName'], $row['PostalAddress1'], $row['PostalAddress2'], $row['PostalAddress3'], $row['PostalCity'], $row['PostalState'], $row['PostalPostcode'], $row['Phone'], $row['FAX'], $row['Email'], $row['Title'], $row['ErName'], $row['idDB'], $row['password'], $row['last_login']);
			$i++;
		}	
	}
}
?>