<?php
$start = (isset($_GET['start'])?$_GET['start']:0);
$orderBy = (isset($_GET['order'])?$_GET['order']:'date_added');
$num_per_page = (isset($_POST['num_per_page'])?$_POST['num_per_page']:0);

$doc_type='ANY';
if(isset($_POST['type']) && $_POST['type']!='ANY')	//which field to search on
	$doc_type = $_POST['type'];
elseif(isset($_GET['type']) && $_GET['type']!='ANY')
	$doc_type = $_GET['type'];

$search_field = '';
if(isset($_POST['search_field']))	//which field to search on
	$search_field = $_POST['search_field'];
elseif(isset($_GET['search_field']))
	$search_field = $_GET['search_field'];

$where = '';
if(isset($_POST['search']))	//search term
	$where = $_POST['search'];
elseif(isset($_GET['search']))
	$where = $_GET['search'];

$company_id = 'ANY';
if(isset($_POST['company_id']) && $_POST['company_id']!='ANY')	//search term
	$company_id = $_POST['company_id'];
elseif(isset($_GET['company_id']) && !$_GET['company_id']!='ANY')
	$company_id = $_GET['company_id'];

require_once(SITE_DIR.'_classes/_page_elements/_ListMultiSelect.php');
require_once(SITE_DIR.'_classes/_collections/_CompanyList.php');
$companyList = new CompanyList();
$list = new ListSelect(&$companyList, 'company_id', $company_id);
$listHtml = $list->createSelect();

function listDocuments($startPage, $orderBy, $page, $num_per_page, $doc_type, $company_id, $where)
{
	require_once(SITE_DIR.'_classes/_page_elements/_QueryStringBuilder.php');
	$url = QueryStringBuilder::getPageName().'?'.QueryStringBuilder::buildQs(0,1,&$page);

	require_once(SITE_DIR.'_classes/_collections/_DocumentList.php');
	require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');
	$list = new DocumentList($startPage, $num_per_page, $orderBy, $company_id, $doc_type, $where, $search_field);
	$lt = new ListTable();
	$lt->page = $page;
	$lt->ItemList = $list;
	$lt->tableStartHtml = "<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
	$lt->tableFinishHtml = "</table>";
	$lt->headerHtml = '<tr bgcolor="#E5E5E5"><td><p align="left"><strong><a class="grey" href="'.$url.'&order=date_added">Date</a></strong><a class="grey" href="'.$url.'&order=date_added"> 
						<img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></p></td><td><p align="left"><strong><a class="grey" href="'.$url.'&order=title">Title 
                       <img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                  <td> <p align="center"><strong><a class="grey" href="'.$url.'&order=doc_code">Code <img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                  <td><strong><a class="grey" href="'.$url.'&order=type">Type</a><a class="grey" href="'.$url.'&order=type"> <img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></td>
                  <td>&nbsp;</td> <td> <p align="center"><strong></strong></p></td> <td>&nbsp;</td></tr>';
	$lt->rowHtml = '<tr bgcolor="#E5E5E5"><td><p align="left">{date_added}</p></td><td><p>{title}</p></td><td><p align="center">{code}</p>
						</td><td><p>{getDoctypeName()}</p></td><td><p><a href="javascript:onClick=alert(\'Place Your message here... \n Click OK to contine.\')">
						</a><img src="images/pdf.gif" width="18" height="14"><a href="../pdfdocs/{pdf_file_name()}" target="_blank">View PDF</a></p></td><td><p>
						<a href="javascript:onClick=alert(\'Place Your message here... \n Click OK to contine.\')"></a><a href="index.php?page=a3&doc_id={id}">Edit</a></p></td><td>
						<a href="index.php?page='.$page->id.'&'.'action=DeleteDocument&doc_id={id}" onClick="MM_popupMsg(\'Are you sure you want to delete this ?\r\rYes            No\r\')">
						Delete</a></td></tr>';
	
	echo $lt->createTable();
}
?>
<form name="form1" method="post" action="">
          <td width="100%" valign="top">
              <table width="100%" border="0" cellpadding="5">
                <tr bgcolor="#CC0000"> 
                  <td> <p align="left" ><strong><font color="#FFFFFF">Manage PDF Documents</font></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td> <div align="left"> 
                      <p> 
                        <input name="Submit" type="submit" onClick="MM_goToURL('parent','index.php?page=a1');return document.MM_returnValue" value="Add New Document">
                      </p>
                    </div></td>
                </tr>
				<tr>
				<td>
				<table width="100%" cellpadding="0" cellspacing="2" border="0">
				<tr bgcolor="#E5E5E5"> 
					<td> <p align="left"><strong>Type</strong></p></td>				
					<td> <p align="left"><strong>Company</strong></p></td>					
					<td> <p align="left"><strong>Search Field</strong></p></td>
					<td> <p align="left"><strong>Search String</strong></p></td>
					<td><p align="left"><strong>View Per Page</strong></p></td>
					<td>&nbsp; </td>
				</tr>
				<tr bgcolor="#E5E5E5"> 
					<td>
						<select name="type">
							<option value="ANY"<? echo ($doc_type=='ANY'?' selected':''); ?>>Any</option>
                      		<option value="<?=DOC_TYPE_FORMS?>"<? echo ($doc_type===DOC_TYPE_FORMS?' selected':''); ?>>Forms</option>
                      		<option value="<?=DOC_TYPE_CONTRACTS?>"<? echo (!$doc_type?' selected':''); ?>>Contracts</option>
                      		<option value="<?=DOC_TYPE_BOOKLETS?>"<? echo ($doc_type===DOC_TYPE_BOOKLETS?' selected':''); ?>>Booklets</option>
                      		<option value="<?=DOC_TYPE_INFO_SHEETS?>"<? echo ($doc_type===DOC_TYPE_INFO_SHEETS?' selected':''); ?>>Information Sheets</option>
                    	</select>
					</td>
					<td>
							<?=$listHtml?>
					</td>
					<td>
						<select name="search_field" size="1">
            				<option selected value="0">General</option>
            				<option value="Title">Title</option>
							<option value="Code">Code</option>
          				</select>
					</td>
        			<td><input type="text" name="search" calue="<?=$where?>"></td>
        			<td>
						<select name="num_per_page">
            				<option value="10" <?=($num_per_page==10?'selected':'')?>>10</option>
							<option value="20" <?=($num_per_page==20?'selected':'')?>>20</option>
							<option value="50" <?=($num_per_page==50?'selected':'')?>>50</option>
							<option value="0" <?=($num_per_page==0?'selected':'')?>>All</option>
						</select>
					</td>
        			<td>
						<input type="submit" name="Submit" value="Go"> &nbsp;&nbsp;&nbsp; 
          				<input type="reset" name="reset" value="Reset">
					</td>
      			</tr>
				</table>
				</td>
				</tr>
				
				<tr>
					<td>
						<!-- start dynamic content -->
						<? listDocuments($start, $orderBy, &$page, $num_per_page, $doc_type, $company_id, $where); ?>
						<!-- end dynamic content -->
					</td>
				</tr>				
              </table>
              <p>&nbsp;</p>

            <p><br>
            </p>
</td>
</form>
