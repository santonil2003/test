<?php
//set up paging & search parameters
$start = (isset($_GET['start'])?$_GET['start']:0); //starting record 4 paging

if(isset($_POST['num_per_page']))	//which field to search on
	$num_per_page = $_POST['num_per_page'];
elseif(isset($_GET['num_per_page']))
	$num_per_page = $_GET['num_per_page'];
else
	$num_per_page = DOC_NUM_PER_PAGE;

if(isset($_POST['search_field']))	//which field to search on
	$search_field = $_POST['search_field'];
elseif(isset($_GET['search_field']))
	$search_field = $_GET['search_field'];

if(isset($_POST['search']))	//search term
	$where = $_POST['search'];
elseif(isset($_GET['search']))
	$where = $_GET['search'];

$list = EMPLOYEE;	//members OR admins?
if(isset($_POST['show']))
	$list = $_POST['show'];
elseif(isset($_GET['show']))
	$list = $_GET['show'];

//set up initial search fields & order by
if($list == EMPLOYEE)
{
	$orderBy = (isset($_GET['order'])?$_GET['order']:'EeId');
	$search_fields = '<option value="EeId">Employee ID</option><option value="LastName">Last Name</option><option value="FirstName">First Name</option><option value="ErName">Organisation</option>';

}	
elseif($list==ADMINISTRATOR)
{
	$orderBy = (isset($_GET['order'])?$_GET['order']:'trading_as');
	$search_fields = '<option value="trading_as">Trading As</option><option value="legal_name">Legal Name</option><option value="trading_as">Trading As</option><option value="contact1_name">Administrator Name</option>';	
}

function createList($list, $startPage, $num_per_page, $orderBy, &$page, $where, $search_field)
{
	require_once(SITE_DIR.'_classes/_page_elements/_QueryStringBuilder.php');
	$url = QueryStringBuilder::getPageName().'?'.QueryStringBuilder::buildQs(0,1,&$page);

	if($list==EMPLOYEE)
	{
		listEmployees($startPage, $num_per_page, $orderBy, $page, $where, $search_field, $url);
	}
	elseif($list==ADMINISTRATOR)
	{
		listAdministrators($startPage, $num_per_page, $orderBy, $page, $where, $search_field, $url);
	}
}

function listAdministrators($startPage, $num_per_page, $orderBy, $page, $where, $search_field, $url)
{
	require_once(SITE_DIR.'_classes/_collections/_AdministratorList.php');
	require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');
	$list = new AdministratorList($startPage, $num_per_page, $orderBy, $where, $search_field);
	$lt = new ListTable();
	$lt->page = & $page;
	$lt->ItemList = $list;
	$lt->tableStartHtml = "<table width=\"$lt->width%\" border=\"0\" cellpadding=\"5\">";
	$lt->tableFinishHtml = "</table>";
	$lt->headerHtml = '<tr bgcolor="#e5e5e5"><td><p align="center"><strong><a class="grey" href="'.$url.'&order=id">id </a></strong><a class="grey" href="#"><img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></p></td>
					  <td><p align="center" ><strong><a class="grey" href="'.$url.'&order=legal_name">Legal Name<img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="center"><strong><a class="grey" href="'.$url.'&order=trading_as">Trading As<img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="center"><strong><a class="grey" href="'.$url.'&order=contact1_name">Administrator_name<img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p><strong><a class="grey" href="'.$url.'&order=contact1_email">Administrator Email<img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="left"><strong><a class="grey" href="'.$url.'&order=password">Password <img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="center">&nbsp;</p></td></tr>';
	$lt->rowHtml = "<tr bgcolor=\"#E5E5E5\"><td><p align=\"center\">{id}</p></td><td><p>{legal_name}</p></td><td><p>{trading_as}</p></td><td><p align=\"center\">{contact1_name}</p></td>
					  <td><p>{contact1_email}</p></td><td><p align=\"left\">{password}</p></td><td><p><a href=\"index.php?page=a11&id={id}&show=".ADMINISTRATOR."\">Assign / Change Details</a></p></td></tr>";
	
	echo $lt->createTable();
}	

function listEmployees($startPage, $num_per_page, $orderBy, $page, $where, $search_field, $url)
{
	require_once(SITE_DIR.'_classes/_collections/_EmployeeList.php');
	require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');

	$list = new EmployeeList($startPage, $num_per_page, $orderBy, $where, $search_field);
	$lt = new ListTable();
	$lt->page = & $page;
	$lt->ItemList = $list;
	$lt->tableStartHtml = "<table width=\"$lt->width%\" border=\"0\" cellpadding=\"5\">";
	$lt->tableFinishHtml = "</table>";
	$lt->headerHtml = '<tr bgcolor="#e5e5e5"><td><p align="center"><strong><a class="grey" href="'.$url.'&order=EeId">eEid </a></strong><a class="grey" href="#"><img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></p></td>
					  <td><p align="center" ><strong><a class="grey" href="'.$url.'&order=LastName">Last Name<img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="center"><strong><a class="grey" href="'.$url.'&order=FirstName">First Name <img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="center"><strong><a class="grey" href="'.$url.'&order=IdDB">IdDB <img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p><strong><a class="grey" href="'.$url.'&order=ErName">Company <img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="left"><strong><a class="grey" href="'.$url.'&order=password">Password <img src="../images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
					  <td><p align="center">&nbsp;</p></td></tr>';
	$lt->rowHtml = "<tr bgcolor=\"#E5E5E5\"><td><p align=\"center\">{EeId}</p></td><td><p>{lastName}</p></td><td><p>{firstName}</p></td><td><p align=\"center\">{idDB}</p></td>
					  <td><p>{erName}</p></td><td><p align=\"left\">{password}</p></td><td><p><a href=\"index.php?page=a12&EeId={EeId}&show=".EMPLOYEE."\">Assign / Change Details</a></p></td></tr>";
	
	echo $lt->createTable();
}	
?>
<form name="form1" method="post" action="index.php?page=a4">
          <td width="100%" valign="top">
		  <table width="100%" border="0" cellpadding="5">
      <tr bgcolor="#CC0000"> 
        <td colspan="5"> <p><strong><font color="#FFFFFF">Edit Details and Passwords 
            for Members / Administrators</font></strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td width="26%"> <p align="left"><strong>Show</strong></p></td>
        <td width="21%"> <p align="left"><strong>Search Field</strong></p></td>
        <td width="14%"> <p align="left"><strong>Search String</strong></p></td>
        <td width="15%"><p align="left"><strong>View Per Page</strong></p></td>
        <td width="24%">&nbsp; </td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <select name="show" size="1">
            <option value="<?=EMPLOYEE?>" <?=($list==EMPLOYEE?'selected':'')?>>Members 
            Only</option>
            <option value="<?=ADMINISTRATOR?>" <?=($list==ADMINISTRATOR?'selected':'')?>>Administrators 
            Only</option>
          </select> </td>
        <td> <select name="search_field" size="1">
            <option selected value="0">General</option>
            <?=$search_fields?>
          </select></td>
        <td> <input type="text" name="search" calue="<?=$where?>"></td>
        <td><select name="num_per_page">
            <option value="10" <?=($num_per_page==10?'selected':'')?>>10</option>
            <option value="20" <?=($num_per_page==20?'selected':'')?>>20</option>
            <option value="50" <?=($num_per_page==50?'selected':'')?>>50</option>
            <option value="0" <?=($num_per_page==0?'selected':'')?>>All</option>
          </select></td>
        <td> <input type="submit" name="Submit" value="Go"> &nbsp;&nbsp;&nbsp; 
          <input type="reset" name="reset" value="Reset"></td>
      </tr>
    </table>
				<!-- start dynamic content -->
				<? createList($list, $start, $num_per_page, $orderBy, $page, $where, $search_field); ?>
				<!-- end dynamic content -->
              <p>&nbsp;</p>

            <p><br>
            </p>
</td>

</form>