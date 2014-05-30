<?PHP


class InternalLinksBuilder
{
	function buildInternalLinks()
	{
		require_once(SITE_DIR.'_classes/_collections/_SectionList.php');
		require_once(SITE_DIR.'_classes/_collections/_PageList.php');

		$pages = new PageList();
		$sections = new SectionList();	
		
		$js_string = "";
		//build main menu		
//		$js_string .= $this->createOptionsList($sections->itemList)."\n}";
		//buiild sub menus
		foreach($sections->itemList as $key=>$val)
		{
			$js_string .= $this->buildOptions($val,$pages->getSectionPages($val->id));	
		}
		$this->saveMenu($js_string);
		
	}
	
	function saveMenu($menu_data)
	{
		$full_file_name = SITE_DIR.'/_pages/_internal_links.php';
		$handle = fopen($full_file_name, 'w+');
		if(fwrite($handle, $menu_data)===FALSE)
		{	
			trigger_error('Internal Links not updated - file error', E_USER_NOTICE);
		}
		fclose($handle);
		//chmod($full_file_name, 0777);	
	}	
	
	function buildOptions($val, $items)
	{
		if(count($items)>0 && !is_object($items))
		{
			//if($val->active) $js="<option value=\"" .SITE_URL. "content.php?page={$val->default_page}\">{$val->name}</option>\n";
			$js="<option value=\"" .SITE_URL.str_replace(' ', '_',$val->name)."\">{$val->name}</option>\n";
			$js.=$this->createOptionsList($items, $val->name);
		}
		return $js;
	}
	
	function createOptionsList($items, $title)
	{
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

//$js .= "{$val} {$val->name} {$val->default_page} {$val->id}\n";
			if(is_a($val, 'PageBase') && $val->sort_order > 0)
			{
				//if($val->active) $js.="<option value=\"" .SITE_URL. "content.php?page={$val->id}\">{$title}: {$val->title}</option>\n";
				$js.="<option value=\"" .SITE_URL.str_replace(' ', '_',$title)."/".str_replace(' ', '_',$val->title)."\">{$title}: {$val->title}</option>\n";
			}	
			elseif(strtolower(get_class($val))=='section' && $val->parent_id)
			{
//$js.="here2";
//				$js.=$js_start.'text='.$val->name.';showmenu='.$this->convertToMenuName($val->name).';url='.$url.'?page='.$val->default_page.$js_end."\n"; 
			}	
			elseif(strtolower(get_class($val)=='section') && !$val->parent_id)
			{
//$js.="here3";
//				$js.=$js_start.'image='.$this->convertToNormalImageName($val->name).';overimage='.$this->convertToImageOverName($val->name).';showmenu='.$this->convertToMenuName($val->name).';url='.$url.'?page='.$val->default_page.$js_end."\n"; 
			}
		}
		return $js;
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
		return 'images/'.$this->convertToImageName($name).'.gif';
	}

	function convertToImageOverName($name)
	{
		return 'images/'.$this->convertToImageName($name).'_over.gif';
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