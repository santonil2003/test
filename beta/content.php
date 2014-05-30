<?php
	//require login
	//require_once('_common/_require_login.php');	

/*
file: admin/index.php
purpose: main index page for admin. Sets up error handling, header, db, action, page then performs action and/or renders page. Then closes db & includes footer
*/
require_once('_common/_constants.php');
require_once(SITE_DIR.'_common/_connection.php'); 
//this is the error handler for all errors that occur anywhere. It will render the warning
function default_error_handler($errno, $errstr, $errfile, $errline)
{
	if($errno == E_USER_ERROR || $errno == E_ERROR)
	{
		if(isset($db))$db->closeDb();
		include(SITE_DIR.'_pages/_error.php');
		include('footer.php');
		exit;
	}
	elseif($errno == E_USER_NOTICE)
	{
		if(isset($db))$db->closeDb();
		include(SITE_DIR.'_pages/_notice.php');
		include('footer.php');
		exit;
	}
}
set_error_handler('default_error_handler');
//end error handler setup

//create user etc...
//require_once(SITE_DIR.'_common/_user.php');
//global $user;

session_start();

//functions used on page
function performAction($action)
{
	require_once(SITE_DIR.'_classes/_factory/_ActionFactory.php');
	$action = ActionFactory::createAction($action);
	$result = $action->execute();
}

function renderPage(& $page)
{
	$page->render();
}
//end functions used on page


//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
//end db setup

//This is the main part of the page - here the page object is created by page factory
//set up page object for use thruout
$pageid = 1;
if(isset($_GET['page'])) {
 $active = true;
 $pageid = $_GET['page'];
 $type = 0;
}
else if(isset($_GET['page_name'])) {
  $fault = false;
  $query_str = $_SERVER['QUERY_STRING'];
  $page_name = substr($query_str, 10);
  $page_name = trim($page_name, '{}');
  $page_name = str_replace("_", " ", $page_name);
  $page_name_split = split("/", $page_name);

  //---------------------------------------
  // Access Via Parent Pages and Page Name
  //---------------------------------------
  if(sizeof($page_name_split)>1) {
  
    $section_id = 0;

    for($i = 0; $i < (sizeof($page_name_split)-1); $i++) {
      $sql = "SELECT `section_id` FROM `site_sections` WHERE `name` LIKE '".trim($page_name_split[$i])."'
      AND `parent_id` = $section_id LIMIT 1 ";
      $result = mysql_query($sql);
      if(mysql_num_rows($result) == 1) {
        list($section_id) = mysql_fetch_array($result);
      } else {
        $fault = true; break;
      }
    }

    if ($fault == false) {
      //$sql = "SELECT `page_id` FROM `site_pages` WHERE `page` LIKE '".trim($page_name_split[sizeof($page_name_split)-1])."' AND `section_id`= $section_id";
      $sql = "SELECT `site_pages`.`page_id`, `site_pages`.`page`, `site_pages`.`name`, `site_pages`.`type`, `site_sections`.`active`  FROM `site_pages` 
				  LEFT JOIN `site_sections` ON (`site_pages`.`page_id` = `site_sections`.`default_page`)
				  WHERE ( `site_pages`.`page` LIKE '".trim($page_name_split[sizeof($page_name_split)-1])."' AND `site_pages`.`section_id`= $section_id ) 
			     OR
				  ( `site_sections`.`name` LIKE '".trim($page_name_split[sizeof($page_name_split)-1])."' AND `site_sections`.`parent_id`= $section_id)";
    } else {
      $sql = "SELECT  `page_id`, `page`, `name`, `type`, `active`  FROM `site_pages` WHERE `page` LIKE '".trim($page_name_split[sizeof($page_name_split)-1])."' ";
    }
    
    //echo($sql);
    
    $result = mysql_query($sql);
    if(mysql_num_rows($result) == 1) {
      list($pageid,$page,$name,$type,$active) = mysql_fetch_array($result);
    } else if(mysql_num_rows($result) > 1) { 
      $page_ids = '';
      while(list($page_id,$page,$name,$type,$active) = mysql_fetch_array($result)) {
        $pages_ids.= $page_id.";";
      }
      header("location: ".SITE_URL."multiple_pages.php?pages=".$pages_ids);
      exit;
    } else {
      if ($fault == false) {
        //$sql = "SELECT `page_id` FROM `site_pages` WHERE `page` LIKE '%".trim($page_name_split[sizeof($page_name_split)-1])."%' AND `section_id`= $section_id ";     
        $sql = "SELECT `site_pages`.`page_id`,  `site_pages`.`page`, `site_pages`.`name`, `site_pages`.`type` , `site_sections`.`active` FROM `site_pages` 
				  LEFT JOIN `site_sections` ON (`site_pages`.`page_id` = `site_sections`.`default_page`)
				  WHERE ( `site_pages`.`page` LIKE '%".trim($page_name_split[sizeof($page_name_split)-1])."%' AND `site_pages`.`section_id`= $section_id ) 
			     OR
				  ( `site_sections`.`name` LIKE '%".trim($page_name_split[sizeof($page_name_split)-1])."%' AND `site_sections`.`parent_id`= $section_id) ";
      } else {
        $sql = "SELECT  `page_id`, `page`, `name`, `type`, `active` FROM `site_pages` WHERE `page` LIKE '%".trim($page_name_split[sizeof($page_name_split)-1])."%' ";     
      }
      $result = mysql_query($sql);
      if(mysql_num_rows($result) == 1) {
        list($pageid,$page,$name,$type,$active) = mysql_fetch_array($result);
      } else if(mysql_num_rows($result) > 1) {
        $page_ids = '';
        while(list($page_id,$page,$name,$type,$active) = mysql_fetch_array($result)) {
          $pages_ids.= $page_id.";";
        }
        header("location: ".SITE_URL."multiple_pages.php?pages=".$pages_ids);
        exit;
      } 
    }
   
  
  
  //------------------------------------
  // Access Via Page Name Only 
  //------------------------------------ 
  } else {
    $sql = "SELECT  `page_id`, `page`, `name`, `type`, `active` FROM `site_pages` WHERE `page` LIKE '".trim($page_name)."' ";
    $result = mysql_query($sql);
    if(mysql_num_rows($result) == 1) {
      list($pageid,$page,$name,$type,$active) = mysql_fetch_array($result);
    } else if(mysql_num_rows($result) > 1) {
      $page_ids = '';
      while(list($page_id,$page,$name,$type,$active) = mysql_fetch_array($result)) {
        $pages_ids.= $page_id.";";
      }
      header("location: ".SITE_URL."multiple_pages.php?pages=".$pages_ids);
      exit;
    } else { 
      $sql = "SELECT  `page_id`, `page`, `name`, `type`, `active` FROM `site_pages` WHERE `page` LIKE '%".trim($page_name)."%' ";
      $result = mysql_query($sql);
      if(mysql_num_rows($result) == 1) {
        list($pageid,$page,$name,$type,$active) = mysql_fetch_array($result);
      } else if(mysql_num_rows($result) > 1) {
        $page_ids = '';
        while(list($page_id,$page,$name,$type,$active) = mysql_fetch_array($result)) {
          $pages_ids.= $page_id.";";
        }
        header("location: ".SITE_URL."multiple_pages.php?pages=".$pages_ids);
        exit;
      } 
    }
  }
}

if($active===false|$active=='0') {
  if(strpos(strtolower($page), "add_to_order")!==false) {
    $type = 0;
    $pageid = 273;
  } else {
    header("location: ".SITE_URL."index.php");
  }

}

switch($type){
  case PAGE_TYPE_PAGE: break;
  case PAGE_TYPE_HYPERLINK: header("location: ".$name); exit; break;
  case PAGE_TYPE_DOWNLOAD: header("location: ".SITE_URL."_common/download_file.php?f=".$name); exit; break;
  case PAGE_TYPE_IMAGE: header("location: ".$name) ;exit; break;
  default: break;
}

header("Cache-control: private");

require_once(SITE_DIR.'_classes/_factory/_PageFactory.php');
global $page;	//set $page as global variable
$page = PageFactory::createPage($pageid);
//end set up page

//check for then perform any action
if(isset($_POST['form_action']))
{
	$act = $_POST['form_action'];
}	
elseif(isset($_GET['form_action']))
{
	$act = $_GET['form_action'];
}	
if(isset($act)) performAction($act);
//end perform action

//header - include at top so always seen, in case error occurs
include("header.php"); 
//end header
// render page.
renderPage($page);


//close db
if(isset($db))$db->closeDb();
//end close db


//footer
include("footer.php"); 
//end footer
?>