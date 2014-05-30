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
//$spaw_root = '/public_html/admin/spaw/';
//$spaw_root = 'C:\\echidna\\acuron\\public_html\\admin\\spaw\\';

// include the control file
require $spaw_root.'spaw_control.class.php';

require_once('page_start.php');
$parent_id = (isset($_GET['parent_id'])?$_GET['parent_id']:$_POST['parent_id']);
$section_id = (isset($_GET['id'])?$_GET['id']:$_POST['id']);
$sort_order = (isset($_GET['sort_order'])?$_GET['sort_order']:$_POST['sort_order']);

if(!empty($section_id))
{
	require_once(SITE_DIR.'_common/_section.php');
	$heading = 'Edit Section';
	$section = new Section();
	$section->id = $section_id;
	$section->findById();
	$page_contents = $section->content;
	$name = $section->name;
	$parent_id = $section->parent_id;
	$check_list_as_page = ($section->page->sort_order?1:0);
	$page_title = ($check_list_as_page?$section->page->title:'');
	$page_tile_top = $section->page->page_title;
	$form_action = 'EditSection';
}
else
{
	$heading = 'Add Section' ;
	$form_action = 'AddSection';
}
?>

<form action="content_pages.php" method="post" name="newSection">
          <td width="100%" valign="top">
			<!-- Spacer table -->
			<table width="100%" border="0" cellpadding="0"><tr><td height="5" bgcolor="#ffffff"></td></tr></table>
		  
              <table width="100%" border="0" cellpadding="5">
      <tr bgcolor="#b8b6b6"> 
        <td colspan="5"> 
<p align="left" ><strong><font color="#FFFFFF"> 
            <?=$heading?>
            </font></strong></p></td>
      </tr>
      <tr bgcolor="#CCCCCC"> 
        <td width="20%" bgcolor="#CCCCCC">
<p><strong>Menu Heading</strong></p></td>
        <td colspan="4" bgcolor="#CCCCCC"> 
          <?  
			if($parent_id) echo '<input type="text" name="name" value="'.$name.'">';
			else echo '<input type="hidden" name="name" value="'.$name.'"><p>'.$name.'</p>';
		?>
        </td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
                  
        <td width="16%" bgcolor="#CCCCCC"> 
<p align="left" ><strong>Page Title</strong> </p></td>
                  
        <td width="84%" bgcolor="#CCCCCC"> 
          <p align="left" >
                      <input name="page_title" type="text" size="60" value="<?=$page_tile_top?>">
          </p></td>
                </tr>
      <tr bgcolor="#E5E5E5"> 
        <td valign="top" bgcolor="#CCCCCC">
<p><strong>Content</strong></p></td>
        <td colspan="4" bgcolor="#CCCCCC"> 
          <?
			
			$sw = new SPAW_Wysiwyg('spaw1' /*name*/,$page_contents /*value*/,'en' /*language*/, 'full' /*toolbar mode*/, 'default' /*theme*/,
									'890px' /*width*/, '450px' /*height*/, SPAW_STYLESHEET /*stylesheet file*/);
			$sw->show();			
		?>
        </td>
      </tr>
      <!--
      <tr bgcolor="#E5E5E5"> 
        <td>&nbsp;</td>
        <td><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="4%" valign="top"><input type="radio" name="default_type" value="<?=PAGE_TYPE_SYSTEM_GENERATED?>"></td><td width="96%"><p>Use a system generated page (this will include links to all sub pages and some introductory text)</p></td></tr></table></td>
      </tr>
	  -->
      <!--<tr bgcolor="#E5E5E5"> 
        <td valign="top" bgcolor="#FFEED6">
<p><strong>List as page on site menus?</strong></p></td>
        <td width="12%" valign="top" bgcolor="#FFEED6">
          <input name="list_as_page" type="checkbox" value="yes" <? //if($check_list_as_page) echo 'checked'; ?> >
        </td>
        <td width="9%" valign="top" bgcolor="#FFEED6">
          <p><strong>Page title</strong></p></td>
        <td width="19%" valign="top" bgcolor="#FFEED6">-->
          <!--&nbsp;</td>
        <td width="40%" valign="top" bgcolor="#FFEED6">
          <p><small>(this only needs to be provided if this content is to be listed 
            as a page for the purposes of site navigation)</small></p></td>
      </tr>-->
      <tr bgcolor="#CCCCCC" valign="top"> 
        <td bgcolor="#CCCCCC">&nbsp;<input type="hidden" name="title" value="<?PHP echo addslashes($name); ?>"></td>
        <td colspan="4" bgcolor="#CCCCCC">
          <input type="hidden" name="parent_id" value="<?=$parent_id?>"><input type="hidden" name="sort_order" value="<?=$sort_order?>"><input name="form_action" type="hidden" value="<?=$form_action?>"> 
          <input type="hidden" name="section_id" value="<?=$section->id?>"> <input name="Submit" type="submit" value="Update">
        </td>
      </tr>
    </table>
</td>
</form>
<? require_once('page_end.php'); ?>