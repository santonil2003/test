<?php
function generateInsertAfterSelect($section_id)
{
	$pages = new PageList();
	$pages->getBySectionId($section_id);
	
	
}

if($page->id=='a9')
{
	$title='Add default page for section '.$section_name;
	
}
elseif($page->id=='a10')
{
	$title='Add page';
	$section_id = $_POST['section_id'];
	$insert_after_select_html = generateInserAfterSelect($section_id);
}

?>
<form name="form1" method="post" action="">
          <td width="100%" valign="top">
                <table width="100%" border="0" cellpadding="5">
                <tr bgcolor="#CC0000"> 
                  <td colspan="2"> <p align="left" ><strong><font color="#FFFFFF"><?=$title?></font></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td width="16%"> <p align="left" ><strong>Heading</strong> </p></td>
                  <td width="84%"> <p align="left" >
                      <input name="textfield2" type="text" size="60">
                    </p></td>
                </tr>
				<? if($page=='a10') { ?>
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Menu Heading</strong></p></td>
                  <td><input name="textfield" type="text" size="60"></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Insert After</strong></p></td>
                  <td><?=$insert_after_select_html?></td>
                </tr>
				<? } ?>
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"> <p><strong>Content</strong></p></td>
                  <td> <table width="558" border="1" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><p><img src="images/mock_toolbar.gif" width="558" height="58"></p></td>
                      </tr>
                      <tr> 
                        <td><textarea rows='20' cols='90'><p><br>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing 
                            elit. Vestibulum sagittis hendrerit dolor. Phasellus 
                            aliquam tortor a diam. Curabitur erat. Suspendisse 
                            ornare lacus quis odio. Aliquam accumsan nisl non 
                            dui. Sed erat purus, cursus a, sodales a, vehicula 
                            ut, erat. Aenean elementum. </p>
                          <p>roin vestibulum condimentum neque. Fusce arcu. Integer 
                            semper. Duis imperdiet metus ultrices purus molestie 
                            porta. Phasellus ac nunc. Aenean vel eros ut magna 
                            placerat gravida. Nullam neque tellus, luctus et, 
                            ullamcorper vitae, pretium sed, massa. </p>
                          <p>asdf</p>
                          <p>asdf</p>
                          <p>asdf<br>
                          </p></textarea></td>
                      </tr>
                      <tr> 
                        <td><img src="images/mock_toolbar_bottom.gif" width="559" height="26"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td>&nbsp;</td>
                  <td><input name="Submit" type="submit" onClick="MM_goToURL('parent','employee_update_preview.php');return document.MM_returnValue" value="Preview"> 
                    &nbsp; <input name="Submit" type="submit" onClick="MM_goToURL('parent','content_pages.php');return document.MM_returnValue" value="Update"> 
                  </td>
                </tr>
              </table>
              <p>&nbsp;</p>

          <p><br>
            </p>
</td>
</form>