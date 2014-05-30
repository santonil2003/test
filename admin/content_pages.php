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


//Define how rows are displayed
define('ROW_BACKGROUND', '#CCCCCC');
define('ROW_HYPERLINK', true);
define('ROW_DOWNLOAD', true);
define('ROW_IMAGE', false);
define('ROW_SUBFOLDER', true);
define('ROW_PAGE', true);
define('ROW_SORT', true);
define('ROW_ACTIVE', true);
define('ROW_VIEW', true);
define('ROW_DELETE', true);

//Define how secion headers are displayed
define('SECTION_BACKGROUND', '#b8b6b6');
define('SECTION_HYPERLINK', true);
define('SECTION_DOWNLOAD', true);
define('SECTION_IMAGE', false);
define('SECTION_SUBFOLDER', true);
define('SECTION_PAGE', true);
define('SECTION_SORT', false);
define('SECTION_ACTIVE', false);
define('SECTION_VIEW', true);
define('SECTION_DELETE', false);

//Define how sub-secion headers are displayed
define('SUB_SECTION_BACKGROUND', '#b8b6b6');
define('SUB_SECTION_HYPERLINK', true);
define('SUB_SECTION_DOWNLOAD', true);
define('SUB_SECTION_IMAGE', false);
define('SUB_SECTION_SUBFOLDER', true);
define('SUB_SECTION_PAGE', true);
define('SUB_SECTION_SORT', true);
define('SUB_SECTION_ACTIVE', true);
define('SUB_SECTION_VIEW', true);
define('SUB_SECTION_DELETE', true);



function listPages()
{
	//simple version that just makes db call every time - written for time's sake, not efficiency. 2 b completed...
	$pages = new PageList();
	$sections = new SectionList();	
   //exit();
	$pt = new PageTable();
	$pt->PagesList = &$pages;
	$pt->SectionsList = &$sections;	
	
	
	$pt->rowHtml = '<tr valign="middle" bgcolor="'.ROW_BACKGROUND.'"> 
                  <td width="1%"><img src="images/spacer_trans.gif" width=20></td>
				 		<td width="1%"><div align="right"><img src="images/small{getType()}.gif" height="20"></div></td>
                  <td width=100%><div style="display:{getDisplay()};"><p><a href="new_{getType()}.php?action=editPage&id={id}" class="grey">{title}</a></p></div>{getEditable()}</td>
                  <td width="15" align="center">';
                  
                  if(ROW_IMAGE){
                    $pt->rowHtml.= '<a href="new_image.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a>';
						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						             
                  $pt->rowHtml.= '</td>
 						<td width="5%" align="center">';
                  
                  if(ROW_HYPERLINK){
                    $pt->rowHtml.= '<a href="new_link.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a>';
						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						             
                  $pt->rowHtml.= '</td>
 						<td width="5%" align="center">';
 						
 						if(ROW_DOWNLOAD){
 						  $pt->rowHtml.= '<a href="new_download.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/adddownload.gif" alt="Add download after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						} 
 						
 						$pt->rowHtml.= '</td>
                  <td width="5%" align="center">';
                  
                  if(ROW_PAGE){
 						  $pt->rowHtml.= '<a href="new_page.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a>';
                  } else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						
						$pt->rowHtml.= '</td> 
                  <td align="center">';
						
						if(ROW_SUBFOLDER){
 						  $pt->rowHtml.= '<a href="new_section.php?sort_order={getNextSortOrder()}&parent_id={section}"><img src="images/addfolder.gif" alt="Add sub section" width="30" height="20" border="0"></a>';
                  } else {
                    $pt->rowHtml.= '&nbsp;';  
                  }
                  
						$pt->rowHtml.= '</td> 
                  <td align="center">';
                  
                  if(ROW_SORT){
 						  $pt->rowHtml.= '<a href="content_pages.php?form_action=ChangePageSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a>';
 						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						
						$pt->rowHtml.= '</td>
                  <td align="center">';
                  
                  if(ROW_SORT){
 						  $pt->rowHtml.= '<a href="content_pages.php?form_action=ChangePageSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a>'; 
                  } else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						
						$pt->rowHtml.= '</td>
						<td align="center">';
						
						if(ROW_ACTIVE){
 						  $pt->rowHtml.= '<a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a>';
 						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						} 
						
						$pt->rowHtml.= '</td> 
                  <td align="center">';
                  
                  if(ROW_VIEW){
 						  $pt->rowHtml.= '<p><a href="{getViewLink()}" target="_blank" border="0">view</a></p>';
 						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						
						$pt->rowHtml.= '</td>  
                  <td align="center">';
                  
                  if(ROW_DELETE){
 						  $pt->rowHtml.= '<div style="visibility:{getVisibility()};"><a href="content_pages.php?form_action=DeletePage&id={id}" border="0" onClick="return confirm(\'Are you sure you want to delete this Page?\');"><img src="images/delete.gif" alt="Delete" width="20" height="20" border="0"></a></div>';
 						} else {   
						  $pt->rowHtml.= '&nbsp;';  
						}
						  
 						 $pt->rowHtml.= ' </td>
                </tr>';
                
                
   $pt->sectionHtml = '<tr valign="middle" bgcolor="'.SECTION_BACKGROUND.'"> 
						<td width=20><img src="images/smallfolder.gif" width="20" height="20"></td>
                  <td colspan="2" valign="middle"><p><div style="display:{getDisplay()};"><a href="new_section.php?action=editSection&id={id}" class="grey">{name}</a></p></div>{getEditable()}</td>
                  <td width="15" align="center">';
                  
                  if(SECTION_IMAGE){
 						  $pt->sectionHtml.= '<a href="new_image.php?sort_order=1&section_id={id}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						
 						$pt->sectionHtml.= '</td> 
 						<td width="5%" align="center">';
                  
                  if(SECTION_HYPERLINK){
 						  $pt->sectionHtml.= '<a href="new_link.php?sort_order=1&section_id={id}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						
 						$pt->sectionHtml.= '</td> 
 						<td width="5%" align="center">';
 						
 						if(SECTION_DOWNLOAD){
 						  $pt->sectionHtml.= '<a href="new_download.php?sort_order=1&section_id={id}"><img src="images/adddownload.gif" alt="Add download after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						
 						$pt->sectionHtml.= '</td>
                  <td width="5%" align="center">';
                  
                  if(SECTION_PAGE){
 						  $pt->sectionHtml.= '<a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a>';
						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						 						 
 						$pt->sectionHtml.= '</td>
                  <td align="center" width="5%">';
                  
					   if(SECTION_SUBFOLDER){
 						  $pt->sectionHtml.= '<a href="new_section.php?sort_order=1&parent_id={id}"><img src="images/addfolder.gif" alt="Add sub section" width="30" height="20" border="0"></a>';
                  } else {
                    $pt->sectionHtml.= '&nbsp;';  
                  }
                  
                  $pt->sectionHtml.= '</td>
                  <td align="center" width="15px">';
                  
                  if(SECTION_SORT){
 						  $pt->sectionHtml.= '<a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						  
 						$pt->sectionHtml.= '</td>
                  <td align="center" width="15">';
                  
                  if(SECTION_SORT){
 						  $pt->sectionHtml.= '<a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						
						$pt->sectionHtml.= '</td>
                  <td align="center" width="20">';
                  
                  if(SECTION_ACTIVE){
 						  $pt->sectionHtml.= '<a href="content_pages.php?form_action=ChangeSectionActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						
						$pt->sectionHtml.= '</td>
                  <td align="center" width="23">';
                  
                  if(SECTION_VIEW){
 						  $pt->sectionHtml.= '<p><div style="display:{getViewDisplay()};"><a href="{getViewLink()}" target="_blank" border="0">view</a></div></p>';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}
						
						$pt->sectionHtml.= '</td> 
                  <td align="center" width="20">';
                  
                  if(SECTION_DELETE){
 						  $pt->sectionHtml.= '{getParentStatus()}';
 						} else {   
						  $pt->sectionHtml.= '&nbsp;';  
						}   
                  
                  $pt->sectionHtml.= '</td> 
                </tr>';
                
                
  $pt->subSectionHtml = '<tr valign="middle" bgcolor="'.SUB_SECTION_BACKGROUND.'"> 
						<td width=20><img src="images/smallfolder.gif" width="20" height="20"></td>
                  <td colspan="2" valign="middle"><p><div style="display:{getDisplay()};"><a href="new_section.php?action=editSection&id={id}" class="grey">{name}</a></p></div>{getEditable()}</td>
                  <td width="15" align="center">';
                  
                  if(SUB_SECTION_IMAGE){
 						  $pt->subSectionHtml.= '<a href="new_image.php?sort_order=1&section_id={id}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						
 						$pt->subSectionHtml.= '</td> 
 						<td width="5%" align="center">';
                  
                  if(SUB_SECTION_HYPERLINK){
 						  $pt->subSectionHtml.= '<a href="new_link.php?sort_order=1&section_id={id}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						
 						$pt->subSectionHtml.= '</td> 
 						<td width="5%" align="center">';
 						
 						if(SUB_SECTION_DOWNLOAD){
 						  $pt->subSectionHtml.= '<a href="new_download.php?sort_order=1&section_id={id}"><img src="images/adddownload.gif" alt="Add download after this page" width="30" height="20" border="0"></a>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						
 						$pt->subSectionHtml.= '</td>
                  <td width="5%" align="center">';
                  
                  if(SUB_SECTION_PAGE){
 						  $pt->subSectionHtml.= '<a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a>';
						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						 						 
 						$pt->subSectionHtml.= '</td>
                  <td align="center" width="5%">';
                  
					   if(SUB_SECTION_SUBFOLDER){
 						  $pt->subSectionHtml.= '<a href="new_section.php?sort_order=1&parent_id={id}"><img src="images/addfolder.gif" alt="Add sub section" width="30" height="20" border="0"></a>';
                  } else {
                    $pt->subSectionHtml.= '&nbsp;';  
                  }
                  
                  $pt->subSectionHtml.= '</td>
                  <td align="center" width="15px">';
                  
                  if(SUB_SECTION_SORT){
 						  $pt->subSectionHtml.= '<a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						  
 						$pt->subSectionHtml.= '</td>
                  <td align="center" width="15">';
                  
                  if(SUB_SECTION_SORT){
 						  $pt->subSectionHtml.= '<a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						
						$pt->subSectionHtml.= '</td>
                  <td align="center" width="20">';
                  
                  if(SUB_SECTION_ACTIVE){
 						  $pt->subSectionHtml.= '<a href="content_pages.php?form_action=ChangeSectionActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						
						$pt->subSectionHtml.= '</td>
                  <td align="center" width="23">';
                  
                  if(SUB_SECTION_VIEW){
 						  $pt->subSectionHtml.= '<p><div style="display:{getViewDisplay()};"><a href="{getViewLink()}" target="_blank" border="0">view</a></div></p>';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}
						
						$pt->subSectionHtml.= '</td> 
                  <td align="center" width="20">';
                  
                  if(SUB_SECTION_DELETE){
 						  $pt->subSectionHtml.= '{getParentStatus()}';
 						} else {   
						  $pt->subSectionHtml.= '&nbsp;';  
						}   
                  
                  $pt->subSectionHtml.= '</td> 
                </tr>';
                
	
/*	
	$pt->nonEditableRowHtml = '<tr valign="middle" bgcolor="#b8b6b6"> 
                  <td width="1%"><img src="images/spacer_trans.gif" width=20></td>
                  <td width="1%"> <div align="right"><img src="images/smallpage.gif" width="20" height="20"></div></td>
                  <td bgcolor="#b8b6b6"> <p>{title} <small>(this page is editable via the menu on the left)</small></p></td>
                  <td width="5%" align="center" bgcolor="#b8b6b6"><a href="new_link.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a></td>
 						<td width="5%" align="center" bgcolor="#b8b6b6"><a href="new_download.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/adddownload.gif" alt="Add download after this page" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center" bgcolor="#b8b6b6"><a href="new_section.php?sort_order={getNextSortOrder()}&parent_id={section}"><img src="images/addfolder.gif" alt="Add page after this page" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center" bgcolor="#b8b6b6"><a href="new_page.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#b8b6b6"><a href="content_pages.php?form_action=ChangePageSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#b8b6b6"><a href="content_pages.php?form_action=ChangePageSortrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#b8b6b6"><a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></td>
                  <td align="center" bgcolor="#b8b6b6"><p><a href="../content.php?page={id}" target="_blank" border="0">view</a></p></td>
                  <td align="center" bgcolor="#b8b6b6"></td>
                </tr>';		
   $pt->nonDelRowHtml = '<tr valign="middle" bgcolor="#CCCCCC"> 
                  <td width="1%"><img src="images/spacer_trans.gif" width=20></td>
				 <td width="1%"><div align="right"><img src="images/smallpage.gif" width="20" height="20"></div></td>
                  <td bgcolor="#CCCCCC" width=100%> <p><a href="new_page.php?action=editPage&id={id}" class="grey">{title}</a></p></td>
                  <td width="5%" align="center" bgcolor="#b8b6b6"><a href="new_link.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addlink.gif" alt="Add link after this page" width="30" height="20" border="0"></a></td>
 						<td width="5%" align="center" bgcolor="#b8b6b6"><a href="new_download.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/adddownload.gif" alt="Add download after this page" width="30" height="20" border="0"></a></td>
                  <td width="5%" align="center" bgcolor="#CCCCCC"><a href="new_page.php?sort_order={getNextSortOrder()}&section_id={section}"><img src="images/addpage.gif" alt="Add page after this page" width="30" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#CCCCCC"><a href="content_pages.php?form_action=ChangePageSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#CCCCCC"><a href="content_pages.php?form_action=ChangePageSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
                  <td align="center" bgcolor="#CCCCCC"><a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></td>
                  <td align="center" bgcolor="#CCCCCC"><p><a href="../content.php?page={id}" target="_blank" border="0">view</a></p></td>
                  <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
                </tr>';      		
	$pt->nonEditableSectionHtml = '<tr valign="middle" bgcolor="#b8b6b6"> 
									<td width=20><img src="images/smallfolder.gif" width="20" height="20"></td>
                  <td colspan="2"><p>{name} <small>(the content for this section is non-editable)</small></p></td>
				  <!--<td width="5%" align="center"><a href="new_section.php?sort_order=1&parent_id={id}"><img src="images/addfolder.gif" alt="Add sub section" width="30" height="20" border="0"></a></td>-->
                  <td width="5%" align="center"><!--<a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add sub page" width="30" height="20" border="0">--></a></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a>--></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a>--></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a>--></td>
                  <td align="center"><p><a href="../content.php?page={default_page}" target="_blank" border="0">view</a></td>
                  <td align="center"><!--<img src="images/delete.gif" alt="Delete" width="20" height="20">--></td>
                </tr>';	
   $pt->nonEditableSectionHeaderHtml = '<tr valign="middle" bgcolor="#b8b6b6"> 
									<td width=20><img src="images/smallfolder.gif" width="20" height="20"></td>
                  <td colspan="2" valign="middle"><p>{name}</p></td>
                  <td width="30" align="center"><a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add sub page" width="30" height="20" border="0"></a></td>
                  <td align="center" width="15"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a>--></td>
                  <td align="center" width="15"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a>--></td>
                  <td align="center" width="20"><!--<a href="content_pages.php?form_action=ChangeSectionActivationStatus&id={id}" border="0"><img src="images/{getActiveStatus()}.gif" alt="Click to change" width="20" height="20" border="0"></a>--></td>
                  <td align="center" width="23"><!--<p><a href="../content.php?page={default_page}" target="_blank" border="0">view</a>--></td>
                  <td align="center" width="20">{getParentStatus()}</td>
                </tr>';
	$pt->nonEditablePagesHtml = '<tr valign="middle" bgcolor="#b8b6b6"> 
                  <td colspan="3"> <p><img src="images/smallfolder.gif" width="20" height="20">Stand-Alone Pages <small>(these are not linked to the main navigation, but can be linked from other pages)</small></p></td>
								  <td width="5%" align="center"></td>

                  <td width="5%" align="center" colspan="2"><a href="new_page.php?sort_order=1&section_id={id}"><img src="images/addpage.gif" alt="Add sub page" width="30" height="20" border="0"></a></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderDown&id={id}" border="0"><img src="images/level1down.gif" alt="Move Up" width="15" height="20" border="0"></a>--></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangeSectionSortOrderUp&id={id}" border="0"><img src="images/level1up.gif" alt="Move Down" width="15" height="20" border="0"></a>--></td>
                  <td align="center"><!--<a href="content_pages.php?form_action=ChangePageActivationStatus&id={id}" border="0"><img src="images/active.gif" alt="Click to Deactivate" width="20" height="20" border="0"></a>--></td>
                 <!-- <td align="center"> <p></p></td>
                  <td align="center"><img src="images/delete.gif" alt="Delete" width="20" height="20"></td>-->
                </tr>';		
   */
   		
	echo $pt->createTable();	
}
?><style type="text/css">
<!--
body {
	background-color: #999999;
}
-->
</style>
<td width="100%" valign="top" bgcolor="ffffff">
  <SCRIPT language="JavaScript">
  function submitform()
  {
    document.myform.submit();
  }
  </SCRIPT> 
			<!--spacer table -->
  <table width="100%" border="0" cellpadding="5"><tr><td height="5" bgcolor="#FFFFFF"></td></tr></table>	  
  <table width="100%" border="0" cellpadding="5" bgcolor="#FFFFFF">
  <? listPages($page);?>
  </table>
  
</td>
<? require_once('page_end.php'); ?>