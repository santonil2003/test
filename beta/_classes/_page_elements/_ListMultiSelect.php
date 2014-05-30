<?php
class ListMultiSelect
{
	var $ItemList;
	var $name;
	var $selectedList;

	function ListMultiSelect($list, $name, $selectedList)
	{
		$this->ItemList = $list;
		$this->name = $name;
		$this->selectedList = $selectedList;
	}
	
	function createMultiSelect()
	{
		$html = '<select multiple size="'.count($this->ItemList->itemList).'" name="'.$this->name.'[]">';
		$i=0;
		while($i < count($this->ItemList->itemList))
		{
			$obj = $this->ItemList->itemList[$i];		
			$html.='<option value="'.$obj->id.'"';
			if(isset($this->selectedList))$html.=($this->selectedList->itemList[$obj->id]?'selected ':'');
			$html.='>'.$obj->name.'</option>';			
			$i++;
		}
		$html.='</select>';	
		return $html;
	}
}

class ListSelect
{
	var $ItemList;
	var $name;
	var $selected_id;

	function ListSelect($list, $name, $selected_id)
	{
		$this->ItemList = $list;
		$this->name = $name;
		$this->selected_id = $selected_id;
	}
	
	function createSelect()
	{
		$html = '<select size="1" name="'.$this->name.'"><option value="ANY">Any</option>';
		$i=0;
		while($i < count($this->ItemList->itemList))
		{
			$obj = $this->ItemList->itemList[$i];		
			$html.='<option value="'.$obj->id.'"';
			if($this->selectedList==$obj->id)$html.=($this->selectedList->itemList[$obj->id]?'selected ':'');
			$html.='>'.$obj->name.'</option>';			
			$i++;
		}
		$html.='</select>';	
		return $html;
	}
}
?>