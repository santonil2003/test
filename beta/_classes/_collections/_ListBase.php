<?php
class ListBase
{
	var $start = 0;
	var $num_per_page = 10;
	var $total;
	var $itemList = array();
	
	function isFirstPage()
	{
		return($this->start==0?true:false);
	}
	
	function isLastPage()
	{
		return(($this->currentPage()>=$this->pageCount()-1?true:false));	
	}
	
	function pageCount()
	{
		return (ceil($this->total/$this->num_per_page)+1);
	}
	
	function currentPage()
	{
		return ($this->start>0?(($this->start/$this->num_per_page)+1):1);
	}
	
	function hasPaging()
	{
		$paging = true;
		if ($this->num_per_page)
			$paging = (ceil($this->total/$this->num_per_page)>1);
		else
			$paging = false;
		return $paging;
	}
	
	function lastPageStart()
	{
		return ((($this->pageCount()-1)*$this->num_per_page)-$this->num_per_page);
	}
	
	function nextPageStart()
	{
		return ($this->start+$this->num_per_page);
	}
	
	function previousPageStart()
	{
		return ($this->start-$this->num_per_page);
	}	
}

?>	