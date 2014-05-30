<?php
class MenuDataBuilder
{

	//public $rowHtml = "This is an editable page - {title}\n";
	public $rowHtml = "{title}\n";
	//public $nonEditableRowHtml = "This is a non editable page {title}\n";
	public $nonEditableRowHtml = "!{title}\n";
	//public $sectionHtml = "This is a section {name}\n";
	public $sectionHtml = "{name}\n";
	//public $nonEditableSectionHtml = "This is a non editable section {name}\n";
	public $nonEditableSectionHtml = "!{name}\n";

	function buildMenuData()
	{
		require_once(SITE_DIR.'_classes/_collections/_SectionList.php');
		require_once(SITE_DIR.'_classes/_collections/_PageList.php');

		$pages = new PageList();
		$sections = new SectionList();	

		// build main menu.
		$js_string = file_get_contents(SITE_DIR.'_classes/_page_elements/milonic_start.php')."\n";
		list($js_temp) = $this->createMilonicJSList($sections->itemList, true);
		$js_string .= $js_temp."\n}";

		// create header menu.

		$i=0;
		while($i < count($sections->itemList))
		{
			$obj = $sections->itemList[$i];
			if(!$obj->parent_id)
			{
				if($obj->name!="Pages")
					if($obj->active){
						$js_string .= $this->buildMenu($obj, 'menuSub');
					}
			}
			$i++;
		}	

		$js_string .= file_get_contents(SITE_DIR.'_classes/_page_elements/milonic_end.php');	
//print "<pre>{$js_string}</pre>";
//exit();	
		$this->saveMenu($js_string);

		
	}

	
	function saveMenu($menu_data)
	{
		$full_file_name = SITE_DIR.'js/raw_menu_data.js'; 
		$handle = fopen($full_file_name, 'w+');
		if(fwrite($handle, $menu_data)===FALSE)
		{	
			trigger_error('Menu not updated - file error', E_USER_NOTICE);
		}
		fclose($handle);
		//chmod($full_file_name, 0777);	
	}	
	
//	function buildMenu($menu_name, $style, $items, $sections)
	function buildMenu($obj, $style)
	{

		$js = "";

		require_once(SITE_DIR.'_classes/_collections/_SubSectionPageList.php');
		$pages = new SubSectionPageList($obj->id);
		$i=0;

		list($temp_js, $subsections) = $this->createMilonicJSList($pages->itemList);
		if(!empty($temp_js)){
			$js.="\n".'with(milonic=new menuname("'.$this->convertToMenuName($obj->name).'")){'."\n
						style=$style;\n";
			$js.=$temp_js;
			$js.="\n} " .$subsections;
		}

		return $js;

/*
		if(count($items)>0)
		{

			$js="\n".'with(milonic=new menuname("'.$menu_name.'")){'."\n
					style=$style;\n";
			$js.=$this->createMilonicJSList($items);
			$js.="\n}";
		}
		return $js;
*/
	}
	
	function createMilonicJSList($items, $mainmenu=false)
	{
		$extra_js = '';
		$js_start = 'aI("';
		$js_end = ';");';
		$js = '';
		foreach($items as $key=>$val)
		{

			// modified by shaun to allow for seperate page for index.
			if($this->convertToMenuName($val->name)=="home")
			{
				$url="index.php";
			}
			else {
				$url="content.php";
			}
			if($this->convertToMenuName($val->name)!="pages"){
				if($val->active){
					if(is_a($val, 'PageBase') && $val->sort_order > 0)
					{
						if($val->active){
						  switch($val->type){
						    case PAGE_TYPE_PAGE: $js.=$js_start.'text='.$val->title.';url='.$url.'?page='.$val->id.$js_end."\n"; break;
						    case PAGE_TYPE_HYPERLINK: $js.=$js_start.'text='.$val->title.';url='.$val->filename.$js_end."\n"; break;
						    case PAGE_TYPE_DOWNLOAD: $js.=$js_start.'text='.$val->title.';url=_common/download_file.php?f='.$val->filename.$js_end."\n"; break;
							 case PAGE_TYPE_IMAGE: $js.=$js_start.'text='.$val->title.';url='.$url.'?page='.$val->id.$js_end."\n"; break;
							 default: $js.=$js_start.'text='.$val->title.';url='.$url.'?page='.$val->id.$js_end."\n"; break;
                    }
						}						
					}	
					elseif(strtolower(get_class($val))=='section' && $val->parent_id && !$mainmenu)
					{
					   if( $val->default_page=='0' ) $js.=$js_start.'text='.$val->name.';showmenu='.$this->convertToMenuName($val->name).';'.$js_end."\n";
					   else $js.=$js_start.'text='.$val->name.';showmenu='.$this->convertToMenuName($val->name).';url='.$url.'?page='.$val->default_page.$js_end."\n"; 
						$extra_js .= $this->buildMenu($val, 'menuSub');
					}	
					/*elseif(get_class($val)=='section' && !$val->parent_id)
					{
						$js.=$js_start.'text='.$val->name.';showmenu='.$this->convertToMenuName($val->name).';url='.$url.'?page='.$val->default_page.$js_end."\n"; 
					}*/
				}
			}
		}

		return array($js, $extra_js);
	}
	
	function convertToMenuName($name)
	{
		return str_replace(' ', '', strtolower($name));
	}
	
	function convertToImageName($name)
	{
		return str_replace(' ', '_', strtolower($name));	
	}

	function convertToNormalImageName($name)
	{
		return 'images/menu/'.$this->convertToImageName(str_replace("'", "", $name)).'.jpg';
	}

	function convertToImageOverName($name)
	{
		return 'images/menu/'.$this->convertToImageName(str_replace("'", "", $name)).'_over.jpg';
	}
	
}
/*
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
$mb = new MilonicBuilder();
echo "<pre>".$mb->buildMilonicMenu()."</pre>";	
$db->closeDb();
*/
?>