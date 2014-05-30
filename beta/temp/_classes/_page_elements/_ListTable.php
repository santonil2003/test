<?php
require_once(SITE_DIR.'_classes/_page_elements/_QueryStringBuilder.php');

class ListTable
{
	var $width = 100;
	var $headerHtml;
	var $rowHtml;
	var $altRowHtml;
	var $ItemList;
	var $tableStartHtml;
	var $tableFinishHtml;
	var $page;
	var $cellpadding = 0;
	var $cellspacing = 0;
	var $border = 0;
	var $page_name;
	
	function createTable()
	{
		$tableHtml = $this->generatePagingControl().$this->tableStartHtml.$this->headerHtml;
		$i=0;
		while($i < count($this->ItemList->itemList))
		{
			if((isset($this->altRowHtml))&&($this->altRowHtml!='')&&($i%2==0))
				$rowHtml = $this->altRowHtml;
			else			
				$rowHtml = $this->rowHtml;
			$obj = $this->ItemList->itemList[$i];
			$rowHtml = preg_replace('/{([^}]+)}/e', '$obj->\1', $rowHtml); 
			$tableHtml.=$rowHtml;
			$i++;		
		}
		$tableHtml .= $this->tableFinishHtml.$this->generatePagingControl();		
		return $tableHtml;
	}
	
	function generatePagingControl()
	{
		if(is_subclass_of($this->ItemList, 'ListBase'))
		{
			if($this->ItemList->hasPaging())
			{
				$ctrlHtml = '<table width="'.$this->width.'%" cellpadding='.$this->cellpadding.' cellspacing='.$this->cellspacing.' border='.$this->border.'><tr><td align="right"><p>';
				if(!$this->ItemList->isFirstPage())
				{
					$ctrlHtml.='<a href="'.QueryStringBuilder::getPageName().'?page='.$this->page->id.'&start=0'.QueryStringBuilder::buildQs(1,0,$this->page).'"><< First </a> ';
					$ctrlHtml.='<a href="'.QueryStringBuilder::getPageName().'?page='.$this->page->id.'&start='.$this->ItemList->previousPageStart().QueryStringBuilder::buildQs(1,0,$this->page).'">< Previous</a> ';
				}
				else
				{
					$ctrlHtml.= '<strong>First</strong> < Previous ';
				}
				if($this->ItemList->currentPage()>2) $ctrlHtml.= '... ';
				if($this->ItemList->isLastPage()||($this->ItemList->pageCount()-$this->ItemList->currentPage())<10)
				{
					$countStart = (($this->ItemList->pageCount()-10)>1?$this->ItemList->pageCount()-10:1);
				}	
				else
				{
					$countStart = $this->ItemList->currentPage();
				}	
				$i = 0;	
				while(($countStart+$i)<$this->ItemList->pageCount()&&$i<10)
				{
					if(($countStart+$i)==$this->ItemList->currentPage())
					{
						$ctrlHtml.='<strong>('.($countStart+$i).')</strong>';
					}
					else
					{
						$ctrlHtml.= ' <a href="'.QueryStringBuilder::getPageName().'?page='.$this->page->id.'&start='.(($countStart+$i)*($this->ItemList->num_per_page)-$this->ItemList->num_per_page).QueryStringBuilder::buildQs(1,0,$this->page).'">'.($countStart+$i).'</a> ';
					}
					$i++;
				}
				if($this->ItemList->pageCount()>($this->ItemList->currentPage()+10)) $ctrlHtml.= '... ';
				if(!$this->ItemList->isLastPage())
				{
					$ctrlHtml.='<a href="'.QueryStringBuilder::getPageName().'?page='.$this->page->id.'&start='.$this->ItemList->nextPageStart().QueryStringBuilder::buildQs(1,0,$this->page).'">Next ></a> ';
					$ctrlHtml.='<a href="'.QueryStringBuilder::getPageName().'?page='.$this->page->id.'&start='.$this->ItemList->lastPageStart().QueryStringBuilder::buildQs(1,0,$this->page).'"> Last >></a>';				
				}
				else
				{
					$ctrlHtml.= ' Next > <strong>Last</strong>';
				}						
				$ctrlHtml .= '</p></td></tr></table>';	
			
			}
			else
			{
				$ctrlHtml = '';
			}
			return $ctrlHtml;
		}
		else
		{
			trigger_error('Incorrect class type', E_USER_ERROR);
		}
	}
}

class PrintableListTable
{
	var $width = 100;
	var $headerHtml;
	var $rowHtml;
	var $altRowHtml;
	var $pageBreakHtml;
	var $ItemList;
	var $tableStartHtml;
	var $tableFinishHtml;
	var $page;
	var $cellpadding = 0;
	var $cellspacing = 0;
	var $border = 0;
	var $page_name;
	
	function createTable()
	{
		$tableHtml = $this->tableStartHtml.$this->headerHtml;
		$i=0;
		while($i < count($this->ItemList->itemList))
		{
			if(($i>0)&&($i%20==0)) $tableHtml .= $this->pageBreakHtml;	
			if((isset($this->altRowHtml))&&($this->altRowHtml!='')&&($i%2==0))
				$rowHtml = $this->altRowHtml;
			else			
				$rowHtml = $this->rowHtml;
			$obj = $this->ItemList->itemList[$i];
			$rowHtml = preg_replace('/{([^}]+)}/e', '$obj->\1', $rowHtml); 
			$tableHtml.=$rowHtml;
			$i++;		
		}
		$tableHtml .= $this->tableFinishHtml;		
		return $tableHtml;
	}
	
}

class PageTable
{
	var $width = 100;
	var $rowHtml;
	var $nonDelRowHtml;
	var $sectionHtml;
	var $subSectionHtml;
	var $nonEditableRowHtml;
	var $nonEditableSectionHtml;
	var $nonEditableSectionHeaderHtml;	
	var $tableStartHtml;
	var $tableFinishHtml;	
	var $PagesList;
	var $SectionsList;
	var $page;
	var $cellpadding = 0;
	var $cellspacing = 0;
	var $border = 0;
	var $page_name;
	
	function createPage($obj)
	{
	  /*
	   switch($obj->type){
	     case PAGE_TYPE_USER_CONTENT:
	       $rowHtml = $this->rowHtml;
	       break;//0
	     case PAGE_TYPE_SYSTEM_GENERATED:
	       $rowHtml = $this->nonEditableRowHtml;
	       break;//1
	     case PAGE_TYPE_PAGES_NOT_DELETEABLE:
	       $rowHtml = $this->nonDelRowHtml;
	       break;//5
	     default:
	       $rowHtml = $this->rowHtml;
	       break;//0
	   } */
	    
	    
	    $rowHtml = $this->rowHtml;
		/*if($obj->type != PAGE_TYPE_SYSTEM_GENERATED)
			$rowHtml = $this->rowHtml;
		elseif($obj->type == PAGE_TYPE_SYSTEM_GENERATED)
			$rowHtml = $this->nonEditableRowHtml; */
			
		$rowHtml = preg_replace('/{([^}]+)}/e', '$obj->\1', $rowHtml); 
 		return $rowHtml;
	}

	function createSection($obj)
	{
		if($obj->parent_id) {
		  $tableHtml = '<tr bgcolor="#CCCCCC"><td><img src="images/spacer_trans.gif" width="20" height="20"></td><td colspan="12" bgcolor="#FFFFFF" ><table width="100%" cellpadding="5" cellspacing="0" align="right" border=0>';
	     $rowHtml = $this->subSectionHtml; 
	   } else {
	     $rowHtml = $this->sectionHtml;
	   }
	   
		//$tableHtml = '';//'<tr><td><table width="100%" cellpadding="0" cellspacing="1">';

		/* if($obj->page->type==2)
			$rowHtml = $this->nonEditableSectionHtml;
		elseif($obj->page->type == 4)
			$rowHtml = $this->nonEditablePagesHtml;
		elseif($obj->page->id==0)
			$rowHtml = $this->nonEditableSectionHeaderHtml;
		else */ 

		$rowHtml = preg_replace('/{([^}]+)}/e', '$obj->\1', $rowHtml); 
		$tableHtml .= $rowHtml;
		
		require_once(SITE_DIR.'_classes/_collections/_SubSectionPageList.php');

		$pages = new SubSectionPageList($obj->id);
		$i=0;
		foreach($pages->itemList as $key=>$val)
		{
			if(strtolower(get_class($val))=='section')
				$tableHtml.=$this->createSection($val);		
			elseif(strtolower(get_parent_class($val))=='pagebase' && $val->sort_order>0)
			{
				$tableHtml.=$this->createPage($val); 
			}
			$i++;
		}
		if($obj->parent_id)
			$tableHtml .= '</table></td></tr>';
		return $tableHtml;
	}
	
	function createTable()
	{
		$i=0;
		$tableHtml = '<tr><td>';
		while($i < count($this->SectionsList->itemList))
		{
			$obj = $this->SectionsList->itemList[$i];
			if(!$obj->parent_id)
			{
				$tableHtml .= $this->createSection($obj);
			}
			$i++;
		}	
		return $tableHtml.'</table></td></tr>';
	}
}

class SiteMap
{
	var $width = 100;
	var $tableStartHtml;
	var $tableFinishHtml;	
	var $PagesList;
	var $SectionsList;
	var $page;
	var $cellpadding = 0;
	var $cellspacing = 0;
	var $border = 0;
	var $page_name;
		
	
	function createSitemapPagesList($section_id)
	{
		$tableHtml = '';
		$i=0;
		$pages = $this->PagesList->getSectionPages($section_id);
		$count = count($pages);
		if(! is_object($pages[0]))
		{
			$i = 1;
			$count++;
		}
		$tableHtml .= '<ul>';		
		while($i < $count)
		{
			$obj = $pages[$i];
			if($obj->sort_order > 0) $tableHtml.= "<li><a href=\"index.php?page=$obj->id\">$obj->title</li>";
			$i++;		
		}
		$tableHtml .= '</ul>';		

		return $tableHtml;
	}
	
	function createSiteMap()
	{
	
	   require_once(SITE_DIR.'_classes/_collections/_SectionList.php');
		require_once(SITE_DIR.'_classes/_collections/_PageList.php');

		$this->PagesList = new PageList();
		$this->SectionsList = new SectionList();
print_r($this->SectionsList);
		$i=0;
		$html = '<table><tr><td valign=top width=100%><h1>Sitemap</h1>';//$this->tableStartHtml;
		while($i < count($this->SectionsList->itemList))
		{

			$obj = $this->SectionsList->itemList[$i];
			if($obj->name!="pages"){
				$html .= '<ul>';
	
				$html .= '<a href="index.php?page='.$obj->default_page.'">'.$obj->name.'</a>';
				$html .= $this->createSitemapPagesList($obj->id);
				$html .= '</ul>';
			}
	
			$i++;
		}
		$html .= '</td></tr></table>';			
		return $html;
	}
}
?>