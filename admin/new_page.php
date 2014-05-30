<?php

require_once('page_start.php');

// this part determines the physical root of your website
// it's up to you how to do this

/*
if (!ereg('/$', $HTTP_SERVER_VARS['DOCUMENT_ROOT']))
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'].'/';
else
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];
*/
$_root =SITE_DIR;
define('DR', $_root);
unset($_root);


// set $spaw_root variable to the physical path were control resides
// don't forget to modify other settings in config/spaw_control.config.php
// namely $spaw_dir and $spaw_base_url most likely require your modification
//$spaw_root = DR.'admin/spaw/';
$spaw_root = SITE_DIR.'admin/spaw/';
//$spaw_root = 'C:\\echidna\\acuron\\public_html\\admin\\spaw\\';



// include the control file
require $spaw_root.'spaw_control.class.php';

function generateInsertAfterSelect($section_id)
{
	$pages = new PageList();
	$pages->getBySectionId($section_id);
	
}

if(isset($_GET['action'])) $action = $_GET['action'];
elseif(isset($_POST['action'])) $action = $_POST['action'];

if(!isset($action))
{
	$title='Add page';
	$section_id = (isset($_GET['section_id'])?$_GET['section_id']:$_POST['section_id']);	
	$sort_order = (isset($_GET['sort_order'])?$_GET['sort_order']:$_POST['sort_order']);	
	//$insert_after_select_html = generateInserAfterSelect($section_id);
	$form_action = 'AddPage';

}
elseif($action=='editPage')
{
	require_once(SITE_DIR.'_common/_page.php');
	$title='Edit page';
	$id = $_GET['id'];
	$user_page = new UserPage();
	$user_page->id = $id;
	$user_page->findById();
	$page_contents = $user_page->content;
	$form_action = 'EditPage';


}

?>

<form name="new_page" method="post" action="content_pages.php">
          <td width="100%" valign="top">
		  
				<!-- Spacer table -->
				<table width="100%" border="0" cellpadding="0"><tr><td height="5" bgcolor="#ffffff"></td></tr></table>
				
                <table width="100%" border="0" cellpadding="5">
                
      <tr bgcolor="#b8b6b6"> 
        <td colspan="2"> 
<p align="left" ><strong><font color="#FFFFFF">
            <?=$title?>
            </font></strong></p></td>
                </tr>
                <tr bgcolor="#CCCCCC"> 
                  
        <td width="16%" bgcolor="#CCCCCC"> 
<p align="left" ><strong>Page Heading</strong> </p></td>
                  
        <td width="84%" bgcolor="#CCCCCC"> 
          <p align="left" >
                      <input name="title" type="text" size="60" value="<?PHP echo addslashes($user_page->title); ?>">
          </p></td>
                </tr>
				<? if($action=='defaultPage') { ?>
                <tr bgcolor="#CCCCCC"> 
                  
        <td bgcolor="#CCCCCC">
<p><strong>Menu Heading</strong></p></td>
                  
        <td bgcolor="#CCCCCC">
          <input name="menu_heading" type="text" size="60">
        </td>
                </tr>
				<!--
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Insert After</strong></p></td>
                  <td><?=$insert_after_select_html?></td>
                </tr>
				-->
				<? } ?>
				<tr bgcolor="#CCCCCC"> 
                  
        <td width="16%" bgcolor="#CCCCCC"> 
<p align="left" ><strong>Page Title</strong> </p></td>
                  
        <td width="84%" bgcolor="#CCCCCC"> 
          <p align="left" >
                      <input name="page_title" type="text" size="60" value="<?PHP echo addslashes($user_page->page_title); ?>">
          </p></td>
                </tr>
                
                <tr bgcolor="#CCCCCC"> 
                  
        <td valign="top" bgcolor="#CCCCCC"> 
<p><strong>Content</strong></p></td>
                  
        <td bgcolor="#CCCCCC"> 
          <table width="558" border="1" cellspacing="0" cellpadding="0">
                       <tr> 
                        <td>
						<?
							$content = '';
							if(isset($page_contents))$content = $page_contents;
							//elseif(isset($HTTP_POST_VARS['spaw1']))$content = stripslashes($HTTP_POST_VARS['spaw1']);
							//$sw = new SPAW_Wysiwyg('spaw1' /*name*/,$content /*value*/, 'en');
							$sw = new SPAW_Wysiwyg('spaw1' /*name*/,$content /*value*/,'en' /*language*/, 'full' /*toolbar mode*/, 'default' /*theme*/,
                       								'890px' /*width*/, '450px' /*height*/, SPAW_STYLESHEET /*stylesheet file*/);
							$sw->show();						

 
//$sw = new SPAW_Wysiwyg('spaw1' /*name*/,isset($HTTP_POST_VARS['spaw1'])?stripslashes($HTTP_POST_VARS['spaw1']):'' /*value*/);
//$sw->show();

							//$spaw = new SPAW_Wysiwyg('spaw1',stripslashes($HTTP_POST_VARS['spaw1']));
							//$spaw->show();
						?>
						</td>
                      </tr>
                    </table>
        </td>
                </tr>
                <tr bgcolor="#CCCCCC"> 
                  
        <td bgcolor="#CCCCCC">&nbsp;</td>
<input name="page_id" type="hidden" value="<?=$id?>"><input name="sort_order" type="hidden" value="<?=$sort_order?>">
                  
        <td bgcolor="#CCCCCC"> &nbsp; 
<input name="Submit" type="submit" value="Update"><input name="form_action" type="hidden" value="<?=$form_action?>"><input name="section_id" type="hidden" value="<?=$section_id?>">
        </td>
                </tr>
              </table>
</td>
</form>
<? require_once('page_start.php'); ?>
<?PHP include('footer_new.php'); ?>