<?php
$section_id = (isset($_GET['id'])?$_GET['id']:$_POST['id']);
require_once(SITE_DIR.'_common/_section.php');
$heading = 'Edit Section';
$section = new Section();
$section->id = $section_id;
$section->findById();

$name = $section->name;


?>

<form action="index.php?page=a9" method="post" name="newSection">
          <td width="100%" valign="top">
              <table width="100%" border="0" cellpadding="5">
      <tr bgcolor="#CC0000"> 
        <td colspan="2"> <p align="left" ><strong><font color="#FFFFFF"> 
            <?=$heading?>
            </font></strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td width="21%"><p><strong>Menu Heading</strong></p></td>
        <td width="79%"><p><?=$name?></p></td>
      </tr>

      <tr bgcolor="#E5E5E5">
        <td><p><strong>Section intro page type</strong></p></td>
        <td><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="4%" valign="top"><input type="radio" name="default_type" value="<?=PAGE_TYPE_USER_CONTENT?>" <? echo $section->default_page->type==PAGE_TYPE_USER_CONTENT?'checked':'';?>></td><td><p>Define content for section introduction</p></td></tr></table>
        </td>
      </tr>
	  <!--
      <tr bgcolor="#E5E5E5"> 
        <td>&nbsp;</td>
        <td><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="4%" valign="top"><input type="radio" name="default_type" value="<?=PAGE_TYPE_SYSTEM_GENERATED?>"></td><td width="96%"><p>Use a system generated page (this will include links to all sub pages and some introductory text)</p></td></tr></table></td>
      </tr>
	  -->
      <tr bgcolor="#E5E5E5"> 
        <td>&nbsp;</td>
        <td><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="4%" valign="top"><input type="radio" name="default_type" value="<?=PAGE_TYPE_ASSIGNED?>" <? echo $section->default_page->type==PAGE_TYPE_ASSIGNED?'checked':'';?>></td><td width="97%"><p>Assign a sub page to be the introductory page for the section (The page with the highest sort order will be automatically used unless another is specified)</p></td></tr></table></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td>&nbsp;</td>
        <td><input type="hidden" name="parent_id" value="<?=$parent_id?>"><input type="hidden" name="section_id" value="<?=$section_id?>"><input name="Submit" type="submit" value="Next >>"> </td>
      </tr>
    </table>
              <p>&nbsp;</p>
          <p><br>
            </p>
</td>
</form>