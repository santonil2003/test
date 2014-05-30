<?php

$start = (isset($_GET['start'])?$_GET['start']:0);
$orderBy = (isset($_GET['order'])?$_GET['order']:'id');

function listItems($startPage, $orderBy, $page)
{
	require_once(SITE_DIR.'_classes/_collections/_AdministratorUpdateList.php');
	require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');
	$list = new AdministratorUpdateList($startPage, DOC_NUM_PER_PAGE, $orderBy);
	$lt = new ListTable();
	$lt->page = $page;
	$lt->ItemList = $list;
	$lt->tableStartHtml = "<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
	$lt->tableFinishHtml = "</table>";
	$lt->headerHtml = '<tr bgcolor="#E5E5E5"><td><p align="left" ><strong><a class="grey"href="#">Date</a></strong><a class="grey" href="#">
						<img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></p></td><td><p align="left" ><strong>
						<a class="grey" href="#">Title<img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                        <td> <p align="left">&nbsp;</p></td></tr>';
	$lt->rowHtml = '<tr bgcolor="#E5E5E5"><td> <p align="left">{createDate}</p></td><td> <p>{title}</p></td>
                        <td> <p align="center"><a href="employee_updates/index.php?id={id}&type=1" target="_blank">View</a></p></td>
                      </tr>';
	$lt->altRowHtml = '<tr bgcolor="#CCCCCC"><td><p align="left">{createDate}</p></td><td><p>{title}</p></td>
                        <td> <p align="center"><a href="employee_updates/index.php?id={id}&type=1" target="_blank">View</a></p></td>
                      </tr>';	
	echo $lt->createTable();
}
?>
<tr> 
	<td height="100%" colspan="2" valign="top" > <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
	<tr> 
	<td width="149" rowspan="3" valign="top"><?php include("admin_nav_include.php"); ?></td>
                <td valign="top" rowspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="20">
<tr><td><form name="form1" method="post" action="">
                    <table width="100%" border="0" cellpadding="5">
                      <tr bgcolor="#CC0000"> 
                        <td colspan="3"> <p align="left" ><strong><font color="#FFFFFF">Administrators 
                            Update</font></strong></p></td>
                      </tr>


					<?listItems($start, 0, $page);?>
                    <p>&nbsp; </p>
                  </form></td></tr></table></td>
				
