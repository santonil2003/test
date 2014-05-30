<?php

$start = (isset($_GET['start'])?$_GET['start']:0);
$orderBy = (isset($_GET['order'])?$_GET['order']:'EeId');

function listItems($startPage, $orderBy, $page)
{
	require_once(SITE_DIR.'_classes/_collections/_EmployeeUpdateList.php');
	require_once(SITE_DIR.'_classes/_page_elements/_ListTable.php');
	$list = new EmployeeUpdateList($startPage, DOC_NUM_PER_PAGE, $orderBy);
	$lt = new ListTable();
	$lt->page = $page;
	$lt->ItemList = $list;
	$lt->tableStartHtml = "<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
	$lt->tableFinishHtml = "</table>";
	$lt->headerHtml = '<tr bgcolor="#E5E5E5"><td> <p align="left" ><strong><a class="grey"href="#">Date</a></strong><a class="grey" href="#"><img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></p></td>
                  <td><p align="left" ><strong><a class="grey" href="#">Title<img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                  <td> <p align="center"><strong><a class="grey" href="#">Active<img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                  <td>&nbsp;</td><td><p align="center">&nbsp;</p></td><td><p align="center">&nbsp;</p></td></tr>';
	$lt->rowHtml = '<tr bgcolor="#E5E5E5"><td> <p align="left">{createDate}</p></td><td> <p>{title}</p></td>
					<td><p align="center">{getActive()}</p></td><td width="40px" align="center"><a href="index.php?page=a14&id={id}">Edit</a></td>
					<td width="40px"><p align="center"><a href="../employee_updates/index.php?id={id}&type=0" target="_blank">View</a></p></td>
					<td width="40px"><p align="center"><a href="index.php?page=a5&form_action=DeleteUpdateItem&id={id}" onClick="return confirmDelete();">Delete</a></p></td>
                	</tr>';
	
	echo $lt->createTable();
}
?>
<SCRIPT language="JavaScript">
<!--
function confirmDelete()
{
 return confirm("Are you sure?");
}
//-->
</SCRIPT>
<form name="form1" method="post" action="index.php?page=a16">
          <td width="100%" valign="top">

              <table width="100%" border="0" cellpadding="5">
                <tr bgcolor="#CC0000"> 
                  <td colspan="5"> <p align="left" ><strong><font color="#FFFFFF">Employee 
                      Updates</font></strong></p></td>
                </tr>
                <tr bgcolor="#E5E5E5"> 
                  <td colspan="5"> <div align="left">
                      <input name="Submit" type="submit" value="Add New Update">
                    </div></td>
                </tr>
				<tr>
					<td>
						<!-- start dynamic content -->
						<? listItems($start, 0, $page); ?>
						<!-- end dynamic content -->
					</td>
				</tr>
			  </table>
              <p>&nbsp;</p>

            <p><br>
            </p>
</td>
            </form>