<?php
require_once('page_start.php');
//include required classes - list class includes entity class file for entity the list class consists of
require_once(SITE_DIR.'_classes/_collections/_PageList.php');
require_once(SITE_DIR.'_classes/_collections/_SectionList.php');
require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');

function getSections()
{	
	return new SectionList();
}

function getPages()
{
	return new PageList();
}



function listPages()
{
	//simple version that just makes db call every time - written for time's sake, not efficiency. 2 b completed...
	$pages = new PageList();
	$sections = new SectionList();	
//exit();
	$pt = new PageTable();
	$pt->PagesList = &$pages;
	$pt->SectionsList = &$sections;
	$pt->rowHtml = /*'<tr valign="middle" bgcolor="#FFEED6"> 
                  <td width="1%"><img src="images/spacer_trans.gif" width=20></td>
									<td width="1%"><div align="right"><img src="images/smallpage.gif" width="20" height="20"></div></td>
                  <td bgcolor="#FFEED6" width=100%> <p><a href="new_page.php?action=editPage&id={id}" class="grey">{title}</a></p></td>
                  <td width="5%" align="center" bgcolor="#FFEED6"><a href="new_section.php?sort_order={getNextSortOrder()}&parent_id={section}"><img src="images/addfolder.gif" alt="Add section after this page" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center" bgcolor="#FFEED6"><a href="new_page.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#FFEED6"><a href="content_pages.php?form_action=ChangePageSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#FFEED6"><a href="content_pages.php?form_action=ChangePageSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#FFEED6"><a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></td>
                  <td align="center" bgcolor="#FFEED6"><p><a href="../content.php?page={id}" target="_blank" border="0">view</a></p></td>
                  <td align="center" bgcolor="#FFEED6"><a href="content_pages.php?form_action=DeletePage&id={id}" border="0" onClick="return confirm(\'Are you sure you want to delete this Page?\');"><img src="images/delete.gif" alt="Delete" width="20" height="20" border="0"></a></td>
                </tr>';
	$pt->nonEditableRowHtml = '<tr valign="middle" bgcolor="#E5E5E5"> 
                  <td width="1%"><img src="images/spacer_trans.gif" width=20></td>
                  <td width="1%"> <div align="right"><img src="images/smallpage.gif" width="20" height="20"></div></td>
                  <td bgcolor="#E5E5E5"> <p>{title} <small>(this page is non-editable)</small></p></td>
                  <td width="5%" align="center" bgcolor="#E5E5E5"><a href="new_section.php?sort_order={getNextSortOrder()}&parent_id={section}"><img src="images/addfolder.gif" alt="Add page after this page" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center" bgcolor="#E5E5E5"><a href="new_page.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#E5E5E5"><a href="content_pages.php?form_action=ChangePageSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#E5E5E5"><a href="content_pages.php?form_action=ChangePageSortrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#E5E5E5"><a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></td>
                  <td align="center" bgcolor="#E5E5E5"><p><a href="../content.php?page={id}" target="_blank" border="0">view</a></p></td>
                  <td align="center" bgcolor="#E5E5E5"></td>
                </tr>';				
	$pt->sectionHtml = '<tr valign="middle" bgcolor="#FFE3BB"> 
									<td width=20><img src="images/smallfolder.gif" width="20" height="20"></td>
                  <td colspan="2" valign="middle"><p><a href="new_section.php?action=editSection&id={id}" class="grey">{name}</a></p></td>
				 					<td width="30" align="center"><a href="new_section.php?sort_order=1&parent_id={id}"><img src="images/addfolder.gif" alt="Add sub section" width="30" height="20" border="0"></a></td>
                  <td width="30" align="center"><a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add sub page" width="30" height="20" border="0"></a></td>
                  <td align="center" width="15"><a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
                  <td align="center" width="15"><a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
                  <td align="center" width="20"><a href="content_pages.php?form_action=ChangeSectionActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a></td>
                  <td align="center" width="23"><p><a href="../content.php?page={default_page}" target="_blank" border="0">view</a></td>
                  <td align="center" width="20">{getParentStatus()}</td>
                </tr>';
	$pt->nonEditableSectionHtml = '<tr valign="middle" bgcolor="#CCCCCC"> 
									<td width=20><img src="images/smallfolder.gif" width="20" height="20"></td>
                  <td colspan="2"><p>{name} <small>(the content for this section is non-editable)</small></p></td>
				  <td width="5%" align="center"><a href="new_section.php?sort_order=1&parent_id={id}"><img src="images/addfolder.gif" alt="Add sub section" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center"><a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add sub page" width="30" height="20" border="0"></a></td>
                  <td align="center"><a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
                  <td align="center"><a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
                  <td align="center"><a href="content_pages.php?form_action=ChangeSectionActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a></td>
                  <td align="center"><p><a href="../content.php?page={default_page}" target="_blank" border="0">view</a></td>
                  <td align="center"><!--<img src="images/delete.gif" alt="Delete" width="20" height="20">--></td>
                </tr>';*/	
	$pt->nonEditablePagesHtml = '<tr valign="middle" bgcolor="#b8b6b6"> 
                  <td colspan="3"> <p><img src="images/smallfolder.gif" width="20" height="20">Stand-Alone Pages <small>(these are not linked to the main navigation, but can be linked from other pages)</small></p></td>
								  <td width="5%" align="center"></td>

                  <td width="5%" align="center"><a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add sub page" width="30" height="20" border="0"></a></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Up" width="15" height="20" border="0"></a>--></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Down" width="15" height="20" border="0"></a>--></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/active.gif" alt="Click to Deactivate" width="20" height="20" border="0"></a>--></td>
                  <td align="center"> <p><!--ap--></p></td>
                  <td align="center"><!--<img src="images/delete.gif" alt="Delete" width="20" height="20">--></td>
                </tr>';				
	echo $pt->createTable();	
}
?>
          <td width="100%" valign="top" bgcolor="ffffff">
<SCRIPT language="JavaScript">
function submitform()
{
  document.myform.submit();
}
</SCRIPT> 
			<!--spacer table -->
              <table width="100%" border="0" cellpadding="5"><tr><td height="5" bgcolor="#ffffff"></td></tr></table>
			  
			  <table width="100%" border="0" cellpadding="5" bgcolor="#FFFFFF">
			  <!--
                <tr bgcolor="#CC0000"> 
                  <td colspan="8"> <p align="left" ><strong><font color="#FFFFFF">Edit 
                      all other pages </font></strong></p></td>
                </tr>
                <tr valign="middle" bgcolor="#E5E5E5"> 
                  <td> <p align="center" ><img src="images/bigfolder.gif" width="50" height="50"></p></td>
                  <td width="49%"> <p><a href="edit_page.php" class="grey">Home</a></p>
                    <p>&nbsp;</p></td>
                  <td width="5%" align="center"> <p align="center">&nbsp;</p></td>
                  <td width="5%" align="center"> <p>&nbsp;</p></td>
                  <td width="5%" align="center"> <p align="left">&nbsp;</p></td>
                  <td width="5%" align="center">&nbsp;</td>
                  <td width="5%" align="center">&nbsp;</td>
                  <td width="5%" align="center"><form name="sectionform" id="sectionform" name="home"><a href="index.php?page=a8" onClick="javascript:document.home.submit"><input type="hidden" name="parent_id" value="0"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></form></td>
                </tr>
				-->
				<!--
                <tr valign="middle" bgcolor="#CCCCCC"> 
                  <td colspan="2"> <p><img src="images/smallfolder.gif" width="20" height="20"><a href="edit_page.php" class="grey">Company</a></p></td>
                  <td width="5%" align="center"><a href="javascript:document.sectionform2.submit()"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center">&nbsp;</td>
                  <td width="5%" align="center">&nbsp;</td>
                  <td width="5%" align="center">&nbsp;</td>
                  <td width="5%" align="center">&nbsp;</td>
                  <td width="5%" align="center">&nbsp;</td>
                </tr>
				<form name="sectionform2" id="sectionform2" action="index.php?page=a18" method="post"><input name="section_id" type="hidden" value="<?=SECTION_COMPANY?>"><input name="sort_order" type="hidden" value="1">
 				<? //listPages(SECTION_COMPANY, $page); ?>
				</form>			
                <tr valign="middle" bgcolor="#CCCCCC"> 
                  <td colspan="2"> <p><img src="images/smallfolder.gif" width="20" height="20"><a href="edit_page.php" class="grey">Eligible Employers</a></p></td>
                  <td width="5%" align="center"><a href="javascript:document.sectionform3.submit()"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
				<form name="sectionform3" id="sectionform3" action="index.php?page=a18" method="post"><input name="section_id" type="hidden" value="<?=SECTION_ELIGIBLE?>"><input name="sort_order" type="hidden" value="1">				
				<? //listPages(SECTION_ELIGIBLE, $page); ?>			
				</form>				
                <tr valign="middle" bgcolor="#CCCCCC"> 
                  <td colspan="2"> <p><img src="images/smallfolder.gif" width="20" height="20"><a href="edit_page.php" class="grey">Fringe Benefits </a></p></td>
                  <td width="5%" align="center"><a href="javascript:document.sectionform4.submit()"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
				<form name="sectionform4" id="sectionform4" action="index.php?page=a18" method="post"><input name="section_id" type="hidden" value="<?=SECTION_FB?>"><input name="sort_order" type="hidden" value="1">				
				<? //listPages(SECTION_FB, $page); ?>			
				</form>				
                <tr valign="middle" bgcolor="#CCCCCC"> 
                  <td colspan="2"> <p><img src="images/smallfolder.gif" width="20" height="20"><a href="edit_page.php" class="grey">Financial Advisors</a></p></td>
                  <td width="5%" align="center"><a href="javascript:document.sectionform5.submit()"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
				<form name="sectionform5" id="sectionform5"  action="index.php?page=a18" method="post"><input name="section_id" type="hidden" value="<?=SECTION_ADVISORS?>"><input name="sort_order" type="hidden" value="1">				
				<? //listPages(SECTION_ADVISORS, $page); ?>			
				</form>				
                <tr valign="middle" bgcolor="#CCCCCC"> 
                  <td colspan="2"> <p><img src="images/smallfolder.gif" width="20" height="20"><a href="edit_page.php" class="grey">Feedback</a></p></td>
                  <td width="5%" align="center"><a href="javascript:document.sectionform6.submit()"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
				<form name="sectionform5" id="sectionform6" action="index.php?page=a18" method="post"><input name="section_id" type="hidden" value="<?=SECTION_FEEDBACK?>"><input name="sort_order" type="hidden" value="1">				
				<? //listPages(SECTION_FEEDBACK, $page); ?>
				</form>
                <tr valign="middle" bgcolor="#CCCCCC"> 
                  <td colspan="2"> <p><img src="images/smallfolder.gif" width="20" height="20"><a href="edit_page.php" class="grey">Contact</a></p></td>
                  <td width="5%" align="center"><a href="javascript:document.sectionform7.submit()"><img src="images/addpage.gif" alt="Add Sub Page" width="30" height="20" border="0"></a></td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
				<form name="sectionform6" id="sectionform7" action="index.php?page=a18" method="post"><input name="section_id" type="hidden" value="<?=SECTION_CONTACT?>"><input name="sort_order" type="hidden" value="1">				
				<? //listPages(SECTION_CONTACT, $page); ?>	
				</form>
				-->
				<? listPages($page);?>
              </table>
</td>
<? require_once('page_end.php'); ?>