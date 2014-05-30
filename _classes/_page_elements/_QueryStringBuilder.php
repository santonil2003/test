<?php
class QueryStringBuilder
{
	function buildQs($no_start, $no_order, &$page)
	{
		$qs = '';(!$no_start?'':'page='.$page->id);
		
		foreach($_GET as $key=>$val)
		{
			if($no_start && $no_order)
			{
				if($key != 'page' && $key !='start' && $key !='order') $qs .= '&'.$key.'='.$val;
			}
			elseif($no_start && !$no_order)
			{
				if($key != 'page' && $key !='start') $qs .= '&'.$key.'='.$val;
			}			
			elseif(!$no_start && $no_order)
			{
				if($key !='order') $qs .= '&'.$key.'='.$val;
			}	
			elseif(!$no_start && !$no_order)
			{
				$qs .= '&'.$key.'='.$val;
			}	
		}						
		//if(isset($_POST['start_date_f']))$qs .= '&start_date_f='.$_POST['start_date_f'];
		//if(isset($_POST['end_date_f']))$qs .= '&end_date_f='.$_POST['end_date_f'];		
		if(isset($_POST['num_per_page']))$qs .= '&num_per_page='.$_POST['num_per_page'];
		if(isset($_POST['show']))$qs .= '&show='.$_POST['show'];
		if(isset($_POST['company_id']))$qs .= '&company_id='.$_POST['company_id'];
		if(isset($_POST['type']))$qs .= '&type='.$_POST['type'];		
		if(!empty($_POST['search'])) $qs .= '&search='.urlencode($_POST['search']);
		if(!empty($_POST['search_field'])) $qs .= '&search_field='.urlencode($_POST['search_field']);						
		
		return $qs;
	}
	
	function getPageName()
	{
		return $HTTP_SERVER_VARS['PHP_SELF'];	
	}
}	
?>