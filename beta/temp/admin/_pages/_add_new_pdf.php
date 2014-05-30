<?php
/*
file: _add_edit_pdf.php
type: dynamically created form
purpose: HTML interface to update OR add new PDF documents into the system
written: 11/10/04 TR
*/
if($page->id=='a1')
{
	$action = 'Add';
}
elseif($page->id=='a3')
{
	$action='Edit';
	if($_GET['doc_id'])					//querystring doc_id always when loading this page
	{
		require_once(SITE_DIR.'_classes/_entity/_Document.php');
		require_once(SITE_DIR.'_classes/_entity/_Userfile.php');		
		$doc = new Document;			//document object's properties will populate form
		$doc->id = $_GET['doc_id'];	
		$doc->getById();
		$title = $doc->title;
		$date = $doc->date_added;
		$code = $doc->code;
		$type = $doc->type;
		$id = $doc->id;
		$pdf_file = $doc->pdf_file;
				
	}
	else
	{
		trigger_error('A doc_id must be provided to edit a document', E_USER_ERROR);
	}
}
else
{
	trigger_error('Incorrect page identifier', E_USER_ERROR);
}

//now generate the companies list for asscoiating documents
require_once(SITE_DIR.'_classes/_page_elements/_ListMultiSelect.php');
require_once(SITE_DIR.'_classes/_collections/_CompanyList.php');
require_once(SITE_DIR.'_classes/_collections/_SelectedCompanyList.php');
$companyList = new CompanyList();
$selected = new SelectedCompanyList($id);
$multi = new ListMultiSelect(&$companyList, 'companies', &$selected);
$multiHtml = $multi->createMultiSelect();

?>
<form name="form1" method="post" action="index.php?page=a2" enctype="multipart/form-data">
          <td width="100%" valign="top">
              <table width="100%" border="0" cellpadding="5">
                <tr bgcolor="#CC0000"> 
                  <td colspan="2"> <p align="left" ><strong><font color="#FFFFFF"><?=$action?> Document</font></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td width="16%"> <p align="left" ><strong>Title</strong></p></td>
                  <td width="84%"> <p align="left" > 
                      <input name="title" type="text" size="60" value="<?=$title?>">
                    </p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td width="16%"> <p align="left" ><strong>Code</strong></p></td>
                  <td width="84%"> <p align="left" > 
                      <input name="doc_code" type="text" size="10" value="<?=$code?>">
                    </p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td><p><strong>Type of Document</strong></p></td>
                  <td><select name="type">
                      <option value="<?=DOC_TYPE_FORMS?>"<? echo ($type==DOC_TYPE_FORMS?' selected':''); ?>>Forms</option>
                      <option value="<?=DOC_TYPE_CONTRACTS?>"<? echo ($type==DOC_TYPE_CONTRACTS?' selected':''); ?>>Contracts</option>
                      <option  value="<?=DOC_TYPE_BOOKLETS?>"<? echo (!isset($type)||$type==DOC_TYPE_BOOKLETS?' selected':''); ?>>Booklets</option>
                      <option value="<?=DOC_TYPE_INFO_SHEETS?>"<? echo ($type==DOC_TYPE_INFO_SHEETS?' selected':''); ?>>Information Sheets</option>
                    </select></td>
                </tr>
				<? if($action == 'Edit') /* if this is an edit form... */{?>
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"><p><strong>PDF file</strong></p></td>
                  <td><input name="pdf_file" type="hidden" value="<?=$pdf_file?>"><p><strong><a href="C:\echidna\step\public_html\pdfdocs\chapter14a-2e-6pp.pdf" 
target=_blank><?=Userfile::returnFilename($pdf_file)?></a></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"><p><strong>New PDF Location</strong></p></td>
                  <td><p><input name="filename" type="file" size="60"><input type="hidden" name="MAX_FILE_SIZE" value="1000000"><br> (only choose a file if you wish to replace the existing document)</p></td>
                </tr>
				<? } else { ?>
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"><p><strong>PDF Location</strong></p></td>
                  <td><input name="filename" type="file" size="60"><input type="hidden" name="MAX_FILE_SIZE" value="1000000"></td>
                </tr>
				<? } ?>				
                <tr bgcolor="#E5E5E5"> 
                  <td valign="top"> <p><strong>Applies to:</strong></p></td>
	              <td><?=$multiHtml?><input type="hidden" name="doc_id" value="<?=$id?>"><input type="hidden" name="date_added" value="<?=$date?>">
				  					<input type="hidden" name="form_action" id="form_action" value="<?=$action?>Document"><input name="Submit" type="submit" value="Update"> <!--onClick="MM_goToURL('parent','manage_pdf_docs.php');return document.MM_returnValue" >--></td>
                </tr>
              </table>
              <p>&nbsp;</p>

            <p><br>
            </p>
</td>
</form>
