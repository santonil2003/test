<?php
if(isset($_POST['default_type']))
{
	//include the appropriate page form as specified by the page type post variable
	switch($_POST['default_type'])
	{
		case PAGE_TYPE_USER_CONTENT:
			if(!include('_pages/_new_page.php')) trigger_error('Page not found', E_USER_ERROR);
			break;
			/*
		case PAGE_TYPE_SYSTEM_GENERATED:
			if(!include('_pages/_system_page.php')) trigger_error('Page not found', E_USER_ERROR);
			break;
		*/	
		case PAGE_TYPE_ASSIGNED:
			if(!include('_pages/_assign_page.php')) trigger_error('Page not found', E_USER_ERROR);
			break;
	}
}
else
{
	trigger_error('Page type not specified. Operation cannot procede', E_USER_NOTICE);
}
?>