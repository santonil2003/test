<?php
class ActionFactory
{
	function createAction($action)
	{
		if(include(SITE_DIR.'_classes/_action/_'.$action.'.php'))
		{
			if(class_exists($action))
			{
				$act = new $action();
			}	
			else
			{
				trigger_error('Class '.$action.' does not exists.', E_USER_ERROR);
			}
		}
		else
		{
			trigger_error('Include page not found.', E_USER_ERROR);
		}			
		return $act;
	}
}
?>