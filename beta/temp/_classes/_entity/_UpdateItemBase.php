<?php
class UpdateItemBase
{
	var $id;
	var $createDate;
	var $title;
	var $content;
	var $active;
	var $type;
	var $filename;
	
	function getActive()
	{
		return ($this->active?'Yes':'No');
	}
	
	function findById()
	{
		$sql = "SELECT * FROM update_items WHERE id = '{$this->id}'";
		$selRes = mysql_query($sql);
		$row = mysql_fetch_array($selRes);
		$this->type = $row['type'];
		$this->id = $row['id'];
		$this->createDate = $row['createDate'];
		$this->title = $row['title'];
		$this->filename = SITE_DIR.'employee_updates/'.$row['filename'].'.php';
		$this->content = file_get_contents($this->filename);
		$this->active = $row['active'];		
	}
	
	function add()
	{
		$file_name = $this->generateFileName();
		$full_file_name = SITE_DIR.'employee_updates/'.$file_name.'.php';
		$handle = fopen($full_file_name, 'w+');
		if(fwrite($handle, $this->content)===FALSE)
		{	
			trigger_error('File not saved - file error', E_USER_NOTICE);
		}
		else
		{	
			$sql = "INSERT INTO update_items (type, create_date, title, filename, active) VALUES ({$this->type}, '{$this->createDate}', '{$this->title}', '{$file_name}', {$this->active})";		
			$insRes = mysql_query($sql);
			$this->id = mysql_insert_id();
		}	
	}	

	function generateFileName()
	{
		return strtolower(str_replace(' ', '_', $this->title)); 
	}

	function update()
	{
		$full_file_name = $this->filename;
		$handle = fopen($full_file_name, 'w+');
		if(fwrite($handle, $this->content)===FALSE)
		{	
			trigger_error('File not saved - file error', E_USER_NOTICE);
		}
		else
		{	
			$sql = "UPDATE `update_items` SET `create_date` = '{$this->createDate}', `title`='{$this->title}', `active`={$this->active} WHERE `id` = {$this->id}";		
			$updRes = mysql_query($sql);
		}	
	}
	
	function delete()
	{
		$sql = "DELETE FROM update_items WHERE id = '{$this->id}'";
		$delRes = mysql_query($sql);	
	}	

}
?>