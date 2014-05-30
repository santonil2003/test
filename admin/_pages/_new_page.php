<?php

require_once(SITE_DIR.'admin/spaw/spaw_control.class.php');
/*
global $spaw_root;
$spaw_root = "C:/echidna/Step/public_html/admin/spaw/";
// include the control file
include $spaw_root.'spaw_control.class.php';
*/
function generateInsertAfterSelect($section_id)
{
	$pages = new PageList();
	$pages->getBySectionId($section_id);
	
}

if($page->id=='a9')
{
	$title='Define default page content for section '.$section_name;
	$action = 'UpdateSectionPage';
	$nextpage = 'a7';
	$id = $_POST[''];
	$user_page = new UserPage();
	$user_page->id = $id;
	$user_page->findById();
	$page_contents = $user_page->content;	
	
}
elseif($page->id=='a18')
{
	$title='Add page';
	$section_id = (isset($_GET['section_id'])?$_GET['section_id']:$_POST['section_id']);	
	$sort_order = (isset($_GET['sort_order'])?$_GET['sort_order']:$_POST['sort_order']);	
	//$insert_after_select_html = generateInserAfterSelect($section_id);
	$action = 'AddPage';
	$nextpage = 'a7';	
}
elseif($page->id=='a10')
{
	require_once(SITE_DIR.'_common/_page.php');
	$title='Edit page';
	$id = $_GET['id'];
	$user_page = new UserPage();
	$user_page->id = $id;
	$user_page->findById();
	$page_contents = $user_page->content;
	$action = 'EditPage';
	$nextpage = 'a7';

}
?>
<form name="new_page" method="post" action="index.php?page=<?=$nextpage?>">
          <td width="100%" valign="top">
                <table width="100%" border="0" cellpadding="5">
                <tr bgcolor="#CC0000"> 
                  <td colspan="2"> <p align="left" ><strong><font color="#FFFFFF"><?=$title?></font></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td width="16%"> <p align="left" ><strong>Heading</strong> </p></td>
                  <td width="84%"> <p align="left" >
                      <input name="title" type="text" size="60" value="<?=$user_page->title?>">
                    </p></td>
                </tr>
				<? if($page=='a10') { ?>
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Menu Heading</strong></p></td>
                  <td><input name="menu_heading" type="text" size="60"></td>
                </tr>
				<!--
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Insert After</strong></p></td>
                  <td><?=$insert_after_select_html?></td>
                </tr>
				-->
				<? } ?>
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"> <p><strong>Content</strong></p></td>
                  <td> <table width="558" border="1" cellspacing="0" cellpadding="0">
                       <tr> 
                        <td>
						<?
							$content = '';
							if(isset($page_contents))$content = $page_contents;
							//elseif(isset($HTTP_POST_VARS['spaw1']))$content = stripslashes($HTTP_POST_VARS['spaw1']);
							//$sw = new SPAW_Wysiwyg('spaw1' /*name*/,$content /*value*/, 'en');
							$sw = new SPAW_Wysiwyg('spaw1' /*name*/,$content /*value*/,'en' /*language*/, 'full' /*toolbar mode*/, '' /*theme*/,
                       								'250px' /*width*/, '450px' /*height*/, 'http://www.stepmanagement.com.au/stylesheet.css' /*stylesheet file*/);
							$sw->show();						
							//$spaw = new SPAW_Wysiwyg('spaw1',stripslashes($HTTP_POST_VARS['spaw1']));
							//$spaw->show();
						?>
						</td>
                      </tr>
                    </table></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td>&nbsp;</td><input name="page_id" type="hidden" value="<?=$id?>"><input name="sort_order" type="hidden" value="<?=$sort_order?>">
                  <td> 
                    &nbsp; <input name="Submit" type="submit" value="Update"><input name="form_action" type="hidden" value="<?=$action?>"><input name="section_id" type="hidden" value="<?=$section_id?>">  
                  </td>
                </tr>
              </table>
              <p>&nbsp;</p>

          <p><br>
            </p>
</td>
</form>