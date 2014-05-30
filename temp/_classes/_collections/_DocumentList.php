<?php
require_once(SITE_DIR.'_classes/_collections/_ListBase.php');
require_once(SITE_DIR.'_classes/_entity/_Document.php');
class DocumentList extends ListBase
{
	function DocumentList($start, $num_per_page, $order_by, $company_id, $doc_type, $where, $search_field)
	{
		//set paging vars
		$this->start = $start;
		$this->num_per_page = $num_per_page;

		$sqlWhere = '';
		//build WHERE clause
		if(($where!='') && (!empty($where)))
		{
			$whereArray = explode(" ", $where);
			foreach($whereArray as $key => $val)
			{
				if(!empty($sqlWhere)) $sqlWhere .= " OR ";
				if(empty($search_field))
					$sqlWhere .= " `title` LIKE('%$val%') OR `doc_code` LIKE('%$val%') ";
				else
					$sqlWhere .= " `$search_field` LIKE('%$val%')";
			}
			//loop thru array to get all WHERE elements
		}

		//get total
		if($company_id=='ANY' && $doc_type=='ANY')
		{ 
			$sql_total = "SELECT * FROM document";
			if(!empty($sqlWhere)) $sql_total.=" WHERE ".$sqlWhere;
		}
		elseif($company_id!='ANY' && $doc_type=='ANY')
		{
			$sql_total = "SELECT d.* FROM document_company dc INNER JOIN document d ON dc.doc_id = d.doc_id WHERE dc.idDB = {$company_id}";
			if(!empty($sqlWhere)) $sql_total.=" AND ".$sqlWhere;
		}
		elseif($company_id=='ANY' && $doc_type!='ANY')
		{
			$sql_total = "SELECT d.* FROM document d WHERE d.type = ".$doc_type;
			if(!empty($sqlWhere)) $sql_total.=" AND ".$sqlWhere;
		}
		elseif($company_id!='ANY' && $doc_type!='ANY')
		{
			$sql_total = "SELECT d.* FROM document_company dc INNER JOIN document d ON dc.doc_id = d.doc_id WHERE dc.idDB = {$company_id} AND d.type = ".$doc_type;
			if(!empty($sqlWhere)) $sql_total.=" AND ".$sqlWhere;
		}

		$this->total = mysql_num_rows(mysql_query($sql_total));

		$sql_select_start = $sql_total;
		if(!empty($order_by))
			$sql_order_by = " ORDER BY `$order_by`";
		else
			$sql_order_by = " ORDER BY `date_added` DESC";
		if($this->num_per_page) $sql_select_limit = " LIMIT $start, $num_per_page";
		$docSql = $sql_select_start . $sql_order_by . $sql_select_limit;
		$documentList = mysql_query($docSql);

		$i=0;
		while($row = mysql_fetch_array($documentList))
		{
			$this->itemList[$i] = new Document($row['title'],$row['pdf_file'],$row['type'], $row['doc_code'],$row['date_added'],$row['doc_id']);
			$i++;
		}	
	}

}
?>