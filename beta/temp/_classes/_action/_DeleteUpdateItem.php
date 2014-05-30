<?php
class DeleteUpdateItem
{
	function execute()
	{
		$id = (isset($_GET['id'])?$_GET['id']:$_POST['id']);
		if($id)
		{
			require_once(SITE_DIR.'_classes/_entity/_UpdateItemBase.php');		
			$upd = new UpdateItemBase();
			$upd->id = $id;
			$upd->delete();
		}	
		else
		{
			trigger_error('Delete update item is missing id', E_USER_ERROR);
		}
	}
}
?>