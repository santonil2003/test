<?
require_once(SITE_DIR.'admin/spaw/spaw_control.class.php');

if($page->id=='a14'||$page->id=='a15')
{
	if($_GET['id'])
	{
		if($page->id == 'a14')
		{
			require_once(SITE_DIR.'_classes/_entity/_EmployeeUpdateItem.php');
			$item = new EmployeeUpdateItem();
			$item->id = $_GET['id'];
			$item->findById();
			$edit_text = 'Employee';
			$action_text = 'EditEmployeeUpdateItem';			
			$next_page = 'a5';
			$content = stripslashes($item->content);					
			$type = EMPLOYEE;			
			
		}
		elseif($page->id == 'a15')
		{
			require_once(SITE_DIR.'_classes/_entity/_AdministratorUpdateItem.php');
			$item = new AdministratorUpdateItem();
			$item->id = $_GET['id'];
			$item->findById();
			$content = stripslashes($item->content);			
			$edit_text = 'Administration';			
			$action_text = 'EditAdministratorUpdateItem';			
			$next_page = 'a6';
			$type = ADMINISTRATOR;								
		}
	}
	else
	{
		trigger_error('An id must be provided to edit an item\'s details', E_USER_ERROR);
	}
}
elseif($page->id=='a16'||$page->id=='a17')
{
	if($page->id == 'a16')
	{
		$edit_text = 'Employee';
		$action_text = 'AddEmployeeUpdateItem';			
		$next_page = 'a5';
		$type = EMPLOYEE;					

	}
	elseif($page->id == 'a17')
	{
		$edit_text = 'Administration';			
		$action_text = 'AddAdministratorUpdateItem';
		$next_page = 'a6';					
		$type = ADMINISTRATOR;		
	}
}
else
{
	trigger_error('This page has been reached by accident', E_USER_ERROR);
}
?> 
<script language="JavaScript" type="text/javascript">
	function setPreviewAction()
	{
		var old_action = document.update_form.action;
		document.update_form.action = "/employee_updates/index.php?mode=preview&type=<?=$type?>";
		//document.update_form.target = '_blank';
		document.update_form.submit();
		document.update_form.action = old_action;
		//document.update_form.target = '_self';		
		
	}
</script>
<form name="update_form" id="update_form" method="post" action="index.php?page=<?=$next_page?>">
<td>
              <table width="100%" border="0" cellpadding="5">
                <tr bgcolor="#CC0000"> 
                  <td colspan="2"> <p align="left" ><strong><font color="#FFFFFF"><?=$edit_text?> 
                      Updates</font></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td width="16%"> <p align="left" ><strong>Date</strong> </p></td>
                  <td width="84%"> <p align="left" > 
                      <select name="date_day" size="1">
                        <option <? echo(date('d')==1?'selected':'');?>>1</option>
                        <option <? echo(date('d')==2?'selected':'');?>>2</option>
                        <option <? echo(date('d')==3?'selected':'');?>>3</option>
                        <option <? echo(date('d')==4?'selected':'');?>>4</option>
                        <option <? echo(date('d')==5?'selected':'');?>>5</option>
                        <option <? echo(date('d')==6?'selected':'');?>>6</option>
                        <option <? echo(date('d')==7?'selected':'');?>>7</option>
                        <option <? echo(date('d')==8?'selected':'');?>>8</option>
                        <option <? echo(date('d')==9?'selected':'');?>>9</option>
                        <option <? echo(date('d')==10?'selected':'');?>>10</option>
                        <option <? echo(date('d')==11?'selected':'');?>>11</option>
                        <option <? echo(date('d')==12?'selected':'');?>>12</option>
                        <option <? echo(date('d')==13?'selected':'');?>>13</option>
                        <option <? echo(date('d')==14?'selected':'');?>>14</option>
                        <option <? echo(date('d')==15?'selected':'');?>>15</option>
                        <option <? echo(date('d')==16?'selected':'');?>>16</option>
                        <option <? echo(date('d')==17?'selected':'');?>>17</option>
                        <option <? echo(date('d')==18?'selected':'');?>>18</option>
                        <option <? echo(date('d')==19?'selected':'');?>>19</option>
                        <option <? echo(date('d')==20?'selected':'');?>>20</option>
                        <option <? echo(date('d')==21?'selected':'');?>>21</option>
                        <option <? echo(date('d')==22?'selected':'');?>>22</option>
                        <option <? echo(date('d')==23?'selected':'');?>>23</option>
                        <option <? echo(date('d')==24?'selected':'');?>>24</option>
                        <option <? echo(date('d')==25?'selected':'');?>>25</option>
                        <option <? echo(date('d')==26?'selected':'');?>>26</option>
                        <option <? echo(date('d')==27?'selected':'');?>>27</option>
                        <option <? echo(date('d')==28?'selected':'');?>>28</option>
                        <option <? echo(date('d')==29?'selected':'');?>>29</option>
                        <option <? echo(date('d')==30?'selected':'');?>>30</option>
                        <option <? echo(date('d')==31?'selected':'');?>>31</option>
                      </select>
                      <select name="date_month" size="1">
                        <option value="01" <? echo(date('m')==1?'selected':'');?>>January</option>
                        <option value="02" <? echo(date('m')==2?'selected':'');?>>February</option>
                        <option value="03" <? echo(date('m')==3?'selected':'');?>>March</option>
                        <option value="04" <? echo(date('m')==4?'selected':'');?>>April</option>
                        <option value="05" <? echo(date('m')==5?'selected':'');?>>May</option>
                        <option value="06" <? echo(date('m')==6?'selected':'');?>>June</option>
                        <option value="07" <? echo(date('m')==7?'selected':'');?>>July</option>
                        <option value="08" <? echo(date('m')==8?'selected':'');?>>August</option>
                        <option value="09" <? echo(date('m')==9?'selected':'');?>>September</option>
                        <option value="10" <? echo(date('m')==10?'selected':'');?>>October</option>
                        <option value="11" <? echo(date('m')==11?'selected':'');?>>November</option>
                        <option value="12" <? echo(date('m')==12?'selected':'');?>>December</option>
                      </select>
                      <select name="date_year">
                        <option <? echo(date('y')==2004?'selected':'');?>>2004</option>
                        <option <? echo(date('y')==2005?'selected':'');?>>2005</option>
                        <option <? echo(date('y')==2006?'selected':'');?>>2006</option>
                      </select>
                    </p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Title</strong></p></td>
                  <td><input name="title" type="text" size="60" value="<?=$item->title?>"></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"> <p><strong>Content</strong></p></td>
                  <td> <table width="558" border="1" cellspacing="0" cellpadding="0">
                       <tr> 
                        <td>
						<?
							$sw = new SPAW_Wysiwyg('spaw1' /*name*/,$content /*value*/,'en' /*language*/, 'full' /*toolbar mode*/, '' /*theme*/,
                       								'250px' /*width*/, '450px' /*height*/, 'http://www.stepmanagement.com.au/employee_updates/employee_stylesheet.css' /*stylesheet file*/);						
							//$spaw = new SPAW_Wysiwyg('spaw1',stripslashes($HTTP_POST_VARS['spaw1']));
							//$spaw->show();
							$sw->show();
						?>
						</td>
                      </tr>
                    </table></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td>&nbsp;</td><input type="hidden" name="id" value="<?=$_GET['id']?>"><input type="hidden" name="type" value="<?=$type?>">
                  <td><input type="hidden" name="form_action" id="form_action"  value="<?=$action_text?>">
				  <!--<input name="Submit" type="button" value="Preview" onClick="setPreviewAction();"> &nbsp;--> 
                    <input name="Submit" type="submit" value="Update"> </td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </form>
            <p><br>
            </p>
</td>