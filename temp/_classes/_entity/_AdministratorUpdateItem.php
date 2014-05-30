<?php
require_once(SITE_DIR.'_classes/_entity/_UpdateItemBase.php');
class AdministratorUpdateItem extends UpdateItemBase
{
	function AdministratorUpdateItem($id, $createDate, $title, $filename, $active)
	{	
		$this->type = ADMINISTRATOR;
		$this->id = $id;
		$this->createDate = $createDate;
		$this->title = $title;
		$this->filename = SITE_DIR.'employee_updates/'.$filename.'.php';
		$this->content = file_get_contents($this->filename);		
		$this->active = $active;						
	}
}
?>