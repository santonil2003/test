<?php
session_start();
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
	require_once(SITE_DIR.'_classes/_factory/_ActionFactory.php');
	$action = ActionFactory::createAction($action);
	$result = $action->execute();
}

function renderPage(& $page)
{
	if(!include($page->filename)) trigger_error('Page not found', E_USER_ERROR);
}
//end functions used on page

//header - include at top so always seen, in case error occurs
include("header_maps.php"); 
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
if(isset($act)) performAction($act);
?>