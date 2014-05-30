<?php
class AddEmployeeUpdateItem
{
	function execute()
	{
		if($_POST['title'] && $_POST['spaw1'])
		{
			require_once(SITE_DIR.'_classes/_entity/_EmployeeUpdateItem.php');
			$item = new EmployeeUpdateItem();
			$item->id = $_POST['id'];			
			$item->createDate = $_POST['date_year'].'-'.$_POST['date_month'].'-'.$_POST['date_day'];
			$item->title = $_POST['title'];
			$item->content = $_POST['spaw1'];
			$item->active = ACTIVE;
			$item->add();
		}
		else
		{
			trigger_error('All details other than secondary contact details must be filled in', E_USER_NOTICE);
		}
		return 1;
	}
}
?>
