<?php
include("required.php");
linkme();

session_start();
$user_section_id = 12;
require_once("./security.php");
check_access($user_section_id);

//header("Cache-control: private");

require_once('../_common/_constants.php');

//this is the error handler for all errors that occur anywhere. It will render the warning
function default_error_handler($errno, $errstr, $errfile, $errline)
{
	if($errno == E_USER_ERROR || $errno == E_ERROR)
	{
		if(isset($db))$db->closeDb();	
		include(SITE_DIR.'_pages/_error.php');
		include('footer_new.php');
		exit;
	}
	elseif($errno == E_USER_NOTICE)
	{
		if(isset($db))$db->closeDb();
		include(SITE_DIR.'_pages/_notice.php');
		include('footer_new.php');
		exit;
	}
}
set_error_handler('default_error_handler');
//end error handler setup

//functions used on page
function performAction($action)
{

   if($_REQUEST['page_type'] == 'link'){
     updateLink($action);
   } else if($_REQUEST['page_type'] == 'download'){
     updateDownload($action);
   } else {
	  require_once(SITE_DIR.'_classes/_factory/_ActionFactory.php');
	  $action = ActionFactory::createAction($action);
	  $result = $action->execute();
	  updateMenu();
	}
}

function renderPage(& $page)
{
	if(!include($page->filename)) trigger_error('Page not found', E_USER_ERROR);
}
//end functions used on page

//header - include at top so always seen, in case error occurs
if(strpos($_SERVER['PHP_SELF'], 'edit_maps.php') > 0 ){
  include("header_maps.php"); 
  print("MAPS");
} else {
  include("header_new.php"); 
}
//end header

//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
//end db setup

//check for then perform any action
if(isset($_POST['form_action']))
{
	$act = $_POST['form_action'];
}	
elseif(isset($_GET['form_action']))
{
	$act = $_GET['form_action'];
}	
if(isset($act))performAction($act);

function  updateLink($action) {

  if($action == 'New'){
    $sql = "INSERT INTO site_pages (page_id, page, section_id, name, type, edit, `delete`, active) VALUES 
    (null, '".$_REQUEST['page']."' , '".$_REQUEST['section_id']."' , '".$_REQUEST['name']."' , 1 , 1, 1, 1 ) ";
    mysql_query($sql); 
    $id = mysql_insert_id(); 
    updateOrder($id,$_REQUEST['sort_order'],$_REQUEST['section_id']);
  } else if($action == 'Edit') {
    $sql = "UPDATE site_pages SET page='".$_REQUEST['page']."',  name='".$_REQUEST['name']."' WHERE page_id=".$_REQUEST['page_id']." LIMIT 1";
    mysql_query($sql);
  }
  
  updateMenu();
  
}

function  updateDownload($action) {
  if($action == 'New'){
    $sql = "INSERT INTO site_pages (page_id, page, section_id, name, type, edit, `delete`, active) VALUES 
    (null, '".$_REQUEST['page']."' , '".$_REQUEST['section_id']."' , '".$_REQUEST['name']."' , 2 , 1, 1, 1 ) ";
    mysql_query($sql);  
    $id = mysql_insert_id(); 
    updateOrder($id,$_REQUEST['sort_order'],$_REQUEST['section_id']);
  } else if($action == 'Edit') {
    $sql = "UPDATE site_pages SET page='".$_REQUEST['page']."',  name='".$_REQUEST['name']."' WHERE page_id=".$_REQUEST['page_id']." LIMIT 1";
    mysql_query($sql);
  }
  
  updateMenu();
  
}

function updateOrder($id,$new_position,$section)
{
      
		$sql = "UPDATE `site_pages` SET `sort_order` = (`sort_order` + 1) WHERE `section_id` = {$section} AND `sort_order` >= {$new_position}";
		mysql_query($sql);
		$sql = "UPDATE `site_sections` SET `sort_index` = (`sort_index` + 1) WHERE `parent_id` = {$section} AND `sort_index` >= {$new_position}";
		mysql_query($sql);		
		$thisSql =  "UPDATE `site_pages` SET `sort_order` = {$new_position} WHERE `page_id` = {$id}";
		mysql_query($thisSql);
}

function updateMenu(){

		require_once(SITE_DIR.'_classes/_page_elements/_MilonicBuilder.php');			
      $mb = new MilonicBuilder();
      $mb->buildMilonicMenu();
      
      require_once(SITE_DIR.'_classes/_page_elements/_MenuDataBuilder.php');			
      $md = new MenuDataBuilder();
      $md->buildMenuData();
      
      $sitemap_html = '';
      $sql = "SELECT section_id FROM site_sections WHERE active = '1' ORDER BY sort_index ASC ";
	  	$result = mysql_query($sql);	  	  
	  	if (mysql_num_rows($result) > 0){
	  	  $sectionPages = '';
		  $siteSections = '';
		              
		  while ($row = mysql_fetch_array($result)) {
		    getSiteMapPages($row['section_id'], $sectionPages, $siteSections);
		  }
		              
		  $page_name = $row['page'];
		                     
		  $siteSections = array_reverse($siteSections, true);
		                
		  $sectionCount = 0;
		                
		  foreach($siteSections as $section_id => $parent){
		                  
		    $siteSectionPages = $sectionPages[$section_id]; 
		                   
		    ksort($siteSectionPages);
		                   
		    if($count==0) {

		      $sitemap_html.="<li><h6>".$parent['name']."</h6></li>";
		      
		    } else {
		    
		      /* $sitemap_html.="<li>".$parent['name']."</li>"; */
		      
		    } 
		                   
		    foreach($siteSectionPages as $row) {
		                   
		      if(intval($row['sort_order']) > 0) {
		        
			     switch($row['type']) {
				    case PAGE_TYPE_PAGE: $sitemap_html.='<li><a href="content.php?page='.$row['page_id'].'" >'.$row['page'].'</a></li>';
					 break;
								     
					 case PAGE_TYPE_HYPERLINK: $sitemap_html.='<li><a href="'.$row['name'].'" class="submenu">'.$row['page'].'</a></li>';
					 break;
									  
					 case PAGE_TYPE_DOWNLOAD: $sitemap_html.='<li><a href="_common/download_file.php?f='.$row['name'].'" class="submenu">'.$row['page'].'</a></li>';
					 break;
									  
					 case PAGE_TYPE_IMAGE: $sitemap_html.='<li><a href="image_popup.php?f='.$row['name'].'" class="submenu">'.$row['page'].'</a></li>';
					 break;
									  
					 default: $sitemap_html.='<li><a href="content.php?page='.$row['page_id'].'" class="submenu">'.$row['page'].'</a></li>';
				    break;
				  }
					
				  /*----------------------------------------------------*/			    
				  if($row['subSectionHeader']) {
								    

				    $subSecHeader = $row['subSectionHeader']; 
								      
					 $siteSubSectionPages = $sectionPages[$subSecHeader]; 
		                   
		          ksort($siteSubSectionPages);
		                        
					 foreach($siteSubSectionPages as $subRow) {
								      
		            if(intval($subRow['sort_order']) > 0) {
							      
						  switch($subRow['type']) {
						    case PAGE_TYPE_PAGE: $sitemap_html.='<li><a href="content.php?page='.$row['page_id'].'" >'.$row['page'].'</a></li>';
							 break;
								     
							 case PAGE_TYPE_HYPERLINK: $sitemap_html.='<li><a href="'.$row['name'].'" class="submenu">'.$row['page'].'</a></li>';
							 break;
									  
							 case PAGE_TYPE_DOWNLOAD: $sitemap_html.='<li><a href="_common/download_file.php?f='.$row['name'].'" class="submenu">'.$row['page'].'</a></li>';
							 break;
									  
							 case PAGE_TYPE_IMAGE: $sitemap_html.='<li><a href="image_popup.php?f='.$row['name'].'" class="submenu">'.$row['page'].'</a></li>';
							 break;
									  
							 default: $sitemap_html.='<li><a href="content.php?page='.$row['page_id'].'" class="submenu">'.$row['page'].'</a></li>';
							 break;
						  }
						}
				    }
					 
					 $sectionPages[$subSecHeader] = '';
								     
				}
				
				/*----------------------------------------------------*/
								  
		    }
							     
		  }
		  
		  $count++;  
		  
		}
		}
      
      
      /* require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');	
      $sm = new SiteMap();
      $sitemap_html = $sm->createSiteMap(); */

		$full_file_name = SITE_DIR.'_pages/site_map.php';

		$handle = fopen($full_file_name, 'w+');
		if(fwrite($handle, $sitemap_html)===FALSE)
		{	
			trigger_error('File not saved - file error', E_USER_NOTICE);
		}
		fclose($handle);
		chmod($full_file_name, 0777);
      
}

function getSiteMapPages($section_id, &$pages, &$sections){
			     $sql = "SELECT * FROM site_pages WHERE section_id = '{$section_id}' AND active='1'";
	  	        $result = mysql_query($sql);
		        if(mysql_num_rows($result) > 0){
		          while($row = mysql_fetch_array($result)){	
		            $pages[$section_id][$row['sort_order']] = $row;
		          }
		          $sql = "SELECT * FROM site_sections WHERE parent_id = '{$section_id}' AND active='1' LIMIT 1";
	  	          $result = mysql_query($sql);
		          if(mysql_num_rows($result) > 0){
		            $row = mysql_fetch_array($result);
		            $sql = "SELECT * FROM site_pages WHERE page_id = '{$row['default_page']}' AND active='1'";
	  	            $result = mysql_query($sql);
		            if(mysql_num_rows($result) > 0){
		              $subSecRow = mysql_fetch_array($result);
		              $pages[$section_id][$row['sort_index']] = array('page_id'=>$subSecRow['page_id'],'page'=>$row['name'],'name'=>$subSecRow['name'],
		              'sort_order'=>$row['sort_index'], 'type'=>$subSecRow['type'], 'subSectionHeader'=>$row['section_id']);
		            }
		          }
		          
		          $sql = "SELECT * FROM site_sections WHERE section_id = '{$section_id}' AND active='1' LIMIT 1";
	  	          $result = mysql_query($sql);
		          if(mysql_num_rows($result) > 0){
		            $row = mysql_fetch_array($result);
		            $sections[$section_id] = $row;
		            if(intval($row['parent_id']) > 0) {
		               getPages($row['parent_id'],$pages,$sections);
		             }  
		          }
		        } else {
		          return false;
		        }	  
}
?>