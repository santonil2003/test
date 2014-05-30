<?php

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
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"> <p><strong>Content</strong></p></td>
                  <td> 
						<textarea name="content" rows="10" cols="85"></textarea></td>
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