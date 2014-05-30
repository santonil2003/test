<?php
class Document
{
	var $id;
	var $title;
	var $pdf_file;
	var $type;
	var $code;
	var $date_added;
	var $companies = array();

	function Document($title, $pdf_file, $type, $code, $date_added, $id)
	{
		$this->title = $title;    
		$this->pdf_file = $pdf_file;
		$this->type = $type;		
		$this->code = $code;
		$this->date_added = $date_added;
		if($id) $this->id = $id;
	}
	
	function addDoc()
	{
		$insertSql = "INSERT INTO document (title, pdf_file, type, doc_code, date_added) VALUES('{$this->title}','{$this->pdf_file}','{$this->type}','{$this->code}','{$this->date_added}')";
		$insertResult = mysql_query($insertSql);
		$this->id = mysql_insert_id();
	}

	function updateDoc()
	{
		$updateSql = "UPDATE document SET title='{$this->title}', pdf_file='{$this->pdf_file}', type='{$this->type}', doc_code='{$this->code}', date_added='{$this->date_added}' WHERE doc_id = '{$this->id}'";
		$updateResult = mysql_query($updateSql);		
	}

	function setCompanies($companies)
	{
		if($this->id)
		{
			//delete all associated companies to start with to avoid having to compare lists ever
			$coDelSql = "DELETE FROM document_company WHERE doc_id ='{$this->id}'";
			$coDelResult = mysql_query($coDelSql);
	
			$this->companies = $companies;
			if(isset($this->companies)&&!empty($this->companies))
			{
				$insertSql = "INSERT INTO document_company (doc_id, idDB) VALUES ";
				for($i=0;$i<count($this->companies);$i++)
				{
					if($i>0) $insertSql.=', ';
					$insertSql.= "('{$this->id}', '{$this->companies[$i]}')";
				}
				$companiesResult = mysql_query($insertSql);
			}
		}		
		else
		{
			trigger_error('Class must be instantiated with at least doc_id', E_USER_ERROR);
		}		
	}

	function getCompanies()
	{
		if($this->id)
		{
			if(isset($this->companies)&&!empty($this->companies))
			{
				$selectSql = "SELECT idDB FROM document_company WHERE doc_id = '{$this->id}'";
				$coResult = mysql_query($selectSql);
				$i = 0;
				while($row = mysql_fetch_array($coResult))
				{
					$this->companies[$i] = $row['idDB'];
					$i++;
				}
			}
		}
		else
		{
			trigger_error('Class must be instantiated with at least doc_id', E_USER_ERROR);
		}		
	}
	
	function deleteDoc()
	{
		if($this->id)
		{
			$deleteSql = "DELETE FROM document WHERE doc_id='{$this->id}'";
			$deleteResult = mysql_query($deleteSql);
		}
		else
		{
			trigger_error('Class must be instantiated with at least doc_id', E_USER_ERROR);
		}
	}

	function getById()
	{
		if($this->id)
		{
			$selectSql = "SELECT * FROM document WHERE doc_id = '{$this->id}'";
			$row = mysql_fetch_array(mysql_query($selectSql));
			$this->title = $row['title'];    
			$this->pdf_file = $row['pdf_file'];
			$this->type = $row['type'];		
			$this->code = $row['doc_code'];
			$this->date_added = $row['date_added'];
			
			$this->getCompanies();
		}
		else
		{
			trigger_error('Class must be instantiated with at least doc_id', E_USER_ERROR);
		}

	} 
	
	function findByCompanyAndType($company_id, $type)
	{
		$selectSql = "SELECT d.*, dc.idDB FROM document d INNER JOIN document_company dc ON d.doc_id = dc.doc_id WHERE dc.idDB = '{$company_id}' AND d.type = {$type}";
//echo $selectSql;
		$row = mysql_fetch_array(mysql_query($selectSql));
		$this->title = $row['title'];    
		$this->pdf_file = $row['pdf_file'];
		$this->type = $row['type'];		
		$this->code = $row['doc_code'];
		$this->date_added = $row['date_added'];
	} 
	
	function getDocTypeName()
	{
		switch($this->type)
		{
			case DOC_TYPE_CONTRACTS:
				$type_name = 'Contracts';
				break;
			case DOC_TYPE_FORMS:
				$type_name = 'Forms';
				break;
			case DOC_TYPE_BOOKLETS:
				$type_name = 'Booklets';
				break;
			case DOC_TYPE_INFO_SHEETS:
				$type_name = 'Information Sheets';
				break;
		}
		return $type_name;
	}
	
	function pdf_file_name()
	{
		$strs = explode("/", $this->pdf_file);
//echo 'STRS' .$strs[count($strs)-1];
		return $strs[count($strs)-1];
	}

}
?>