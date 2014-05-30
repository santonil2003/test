<?PHP

header("Cache-control: private");
require_once('../_common/_constants.php');

//db setup - configure & set up db connection
require_once('../_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();

define('HEADER', "header_jobs.php");
define('FOOTER', "footer_new.php");

$errors = array("001" => "Invalid News ID",
		"002" => "Invalid Job ID",
		"003" => "Invalid Job ID",
		"004" => "Error Updating Article",
		"005" => "Error Updating Article",
		"006" => "Error Deleting Article");

/*
if (!ereg('/$', $HTTP_SERVER_VARS['DOCUMENT_ROOT']))
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'].'/';
else
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];
*/

$_root ='/home/cpawa/public_html/';
define('DR', $_root);
unset($_root);

$spaw_root = '/home/cpawa/public_html/admin/spaw/';
require $spaw_root.'spaw_control.class.php';


//check if there are no jobs in database
$sql = "SELECT * FROM site_jobs";
$result = mysql_query($sql); 
$records_returned = mysql_num_rows($result);

//if no jobs found - create new job	
if ($records_returned <= 0) {
	editNews(-1);
}

else {

	switch($_POST['section'])
	{

		case "save":
			saveNews($_POST['id']);
			break;
		case "edit":
			editNews($_POST['id']);
			break;
		case "create":
			editNews(-1);
			break;
		case "active":
			changeActive($_POST['id']);
			break;
		case "delete":
			deleteNews($_POST['id']);
			break;
		default:
			listNews();
			break;
	}
}

function deleteNews($id)
{
	$string = "delete from site_jobs where id='{$id}' limit 1";
	$result = mysql_query($string) or errorMsg("006", mysql_error());

	Header("Location: {$_SERVER['PHP_SELF']}");
}


function saveNews($id)
{

	$date = $_POST['year']."-".sprintf("%02d", $_POST['month'])."-".sprintf("%02d", $_POST['day']);
	$datec = $_POST['yearc']."-".sprintf("%02d", $_POST['monthc'])."-".sprintf("%02d", $_POST['dayc']);
	$content = fixSqlQuotes(stripslashes($_POST['content']));
	$title = fixSqlQuotes(stripslashes($_POST['title']));
	$short = fixSqlQuotes(stripslashes($_POST['short']));
	$positions = $_POST['positions'];
	if($id=="-1")
	{
		// create new news item (insert)
		$string = "insert into site_jobs values('', '{$_POST['title']}','{$_POST['positions']}', '{$date}', '{$datec}', '{$_POST['active']}','{$content}','{$short}')";
	}
	else {
		// update previous (update)
		$string = "update site_jobs set title='{$_POST['title']}', positions='{$positions}', dateactive='{$date}', dateclosing='{$datec}', active='{$_POST['active']}', content='{$_POST['content']}', short='{$_POST['short']}' where id='{$id}'";
	}

//	print $string;

	$result = mysql_query($string) or errorMsg("005", mysql_error());
	Header("Location: {$_SERVER['PHP_SELF']}");


}

function changeActive($id)
{

	$string = "select active from site_jobs where id='$id'";
	$result = mysql_query($string) or die("SQL error: ".mysql_error());

	if(mysql_num_rows($result)==1)
	{
		list($active)=mysql_fetch_row($result);
		$new_active = ($active=="1")?"0":"1";
		$string = "update site_jobs set active='$new_active' where id='$id'";
		$result = mysql_query($string) or die("SQL error: ".mysql_error());

		if($result)
		{
			Header("Location: {$_SERVER['PHP_SELF']}");
		}
		else {
			errorMsg("002");
		}
	} 
	else {
		errorMsg("001");
	}
}


function errorMsg($errorID, $extra="")
{
	global $errors;
	require_once HEADER;

	?>
	<h1>Error</h1>
	<p>There was an error editing the News items, please report this error to the Administrator.</p>
	<p><strong><?=$errorID?>: <?=$errors[$errorID]?></strong></p>
	<?
	if(!empty($extra))
	{
		?>
		<p><strong><?=$extra?></strong></p>
		<?
	}
	?>
	
<p><a href="<?=$_SERVER['PHP_SELF']?>">Back to Job Vacancies</a></p>
	
<?

	require_once FOOTER;
	exit();
}

function listNews()
{
	$sub_menu = true;
	require_once HEADER;

	$string = "select id, title, positions, date_format(dateactive, '%d/%m/%Y') as date2, date_format(dateclosing, '%d/%m/%Y') as date3, active, content, short from site_jobs order by dateactive desc";
	$result = mysql_query($string) or die("SQL error: ".mysql_error());

	if(mysql_num_rows($result)>0)
	{
		?>
<form name="edit" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
  <table width=100% cellpadding="3">
    <input type=hidden name="section" value="edit">
		<input type=hidden name="id" value="">
		<tr>
		
      <td bgcolor="#FFE3BB"><font color="#998870" face="Arial, Helvetica, sans-serif" size="2"><strong>Date 
        Job added, Job Closing and News title</strong></font></td>
      <td width="10%" align="center" bgcolor="#FFE3BB"><font color="#998870" face="Arial, Helvetica, sans-serif" size="2"><strong>Active</strong></font></td>
		
      <td width="10%" align="center" bgcolor="#FFE3BB"><font color="#998870" face="Arial, Helvetica, sans-serif" size="2"><strong>Delete</strong></font></td>
		</tr>
		<?
		
		while($row=mysql_fetch_array($result))
		{
			?>
			<tr valign="middle" bgcolor="#FFE3BB"> 
				
      <td bgcolor="#FFEED6"> 
<p> Date added:
          <?=$row['date2']?> - Date closing: <?=$row['date3']?>
          - <a href="javascript:submitForm(document.edit, 'edit', '<?=$row['id']?>');" class="grey"> 
          <?=$row['title']?>
          </a></p></td>
				
      <td width=10% align="center" bgcolor="#FFEED6"><a href="javascript:submitForm(document.edit, 'active', '<?=$row['id']?>');"><img src="images/<?=($row['active']==1)?"active.gif":"inactive.gif";?>" alt="Click to <?=($row['active']==1)?"Deactivate":"Activate";?>" width="20" height="20" border="0"></a></td>
				
      <td width=10% align="center" bgcolor="#FFEED6"><a href="javascript:submitForm(document.edit, 'delete', '<?=$row['id']?>');"><img src="images/delete.gif" alt="Click to Delete News item" width="20" height="20"  border="0"></a></td>
			</tr>
			<?
		}

		?>
		</table>
		</form>
		<?
	}
	else {
		?>
			<div class="adminBody">
  <table width="100%" border="0" cellspacing="0" bgcolor="#FFEED6">
    <tr>
      <td width="10%">&nbsp;</td>
      <td><div class="adminBody"><br>
          There are currently no job items. <br>
          <br>
          You can create a new Job item by clicking on Create Job Vacancy above.</div>
          
        <p><br>
        </p>
        <p><br></p>
          </p></td>
    </tr>
  </table>
</div>
			<?
	}

	require_once FOOTER;

}

function editNews($id)
{
	require_once HEADER;
	global $spaw_root;


	if($id=="-1")
	{
		// new news item.
		$title=$content=$short="";
		$active=0;
		$dateactive = date('Y-m-d');
		$dateclosing = date('Y-m-d');
		$page_title = "Create Job Vacancy";
		$submit_button = "Create";
	}
	else {
		$string = "select * from site_jobs where id='$id'";
		$result = mysql_query($string) or die("SQL error: ".mysql_error());

		if(mysql_num_rows($result)==1)
		{
			list($id, $title, $positions, $dateactive, $dateclosing, $active, $content, $short)=mysql_fetch_row($result);		
			$page_title = "Edit News Article";
			$submit_button = "Save";
		}
		else {
			errorMsg("003");
		}
	}
	list($year, $month, $day)=split("-", $dateactive);
	list($yearc, $monthc, $dayc)=split("-", $dateclosing);

	?>
	<form name="edit" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
	<input type=hidden name="section" value="save">
	<input type=hidden name="id" value="<?=$id?>">
	
  <table width="100%" border="0" cellpadding="5">
    <tr> 
      <td height="10" colspan="2"></td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="#FFE3BB"> <p align="left" ><strong><font color="#998870"> 
          <?=$page_title?>
          </font></strong></p></td>
    </tr>
    <tr> 
      <td width="20%" bgcolor="#FFEED6"> <p><strong>Job Title</strong></p></td>
      <td bgcolor="#FFEED6"> <input type="text" name="title" value="<?=$title?>" style="width:100%;font-family: Arial, Helvetica, sans-serif;font-size: 12px; color: #666666;"></td>
    </tr>
    <tr> 
      <td bgcolor="#FFEED6"><p><strong>Positions</strong></p></td>
      <td bgcolor="#FFEED6"> <select name="positions" class="adminBody">
          <?PHP 
      // select years, populate list/menu	
			$numberofpositions = array(1,2,3,4,5,6,7,8,9,10); 

					for ($i=0; $i<11; $i++)
					{
						print ("<option value=\"".$numberofpositions[$i]."\"");
					 	// check for selected category
						if ($numberofpositions[$id] == $positions)
						{
							echo "selected";
						}
						print(">".$numberofpositions[$i]."</option>");
					} ?>
        </select> </td>
    </tr>
    <tr>
      <td bgcolor="#FFEED6"><p><strong>Short Description</strong></p></td>
      <td bgcolor="#FFEED6"><input type="text" name="short" value="<?=$short?>" style="width:100%;font-family: Arial, Helvetica, sans-serif;font-size: 12px; color: #666666;"></td>
    </tr>
    <tr> 
      <td width="20%" bgcolor="#FFEED6"> <p><strong>Date Active</strong></p></td>
      <td bgcolor="#FFEED6" class="adminBody"> 
        <?PHP

	printPullDown("day", range(1, 31), $day, false, "validatedate(document.edit.day,document.edit.month,document.edit.year)");
	?>
        / 
        <?
	printPullDown("month", range(1, 12), $month, false, "validatedate(document.edit.day,document.edit.month,document.edit.year)");
	?>
        / 
        <?
	printPullDown("year", range(date("Y")-10, date("Y")+10), $year, false, "validatedate(document.edit.day,document.edit.month,document.edit.year)");

			?>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#FFEED6"><p><strong>Date Closing</strong></p></td>
      <td bgcolor="#FFEED6" class="adminBody"> 
        <?PHP

	printPullDown("dayc", range(1, 31), $dayc, false, "validatedate(document.edit.dayc,document.edit.monthc,document.edit.yearc)");
	?>
        / 
        <?
	printPullDown("monthc", range(1, 12), $monthc, false, "validatedate(document.edit.dayc,document.edit.monthc,document.edit.yearc)");
	?>
        / 
        <?
	printPullDown("yearc", range(date("Y")-10, date("Y")+10), $yearc, false, "validatedate(document.edit.dayc,document.edit.monthc,document.edit.yearc)");

			?>
      </td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFEED6"><p><strong>Active?</strong></p></td>
      <td bgcolor="#FFEED6"><input type="checkbox" name="active" value="1" <?=($active==1)?"checked":""; ?>></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFEED6"> <p><strong>Job Details</strong></p></td>
      <td bgcolor="#FFEED6"> 
        <?
			
				$sw = new SPAW_Wysiwyg('content' /*name*/,$content /*value*/,'en' /*language*/, 'full' /*toolbar mode*/, 'default' /*theme*/,
									'250px' /*width*/, '450px' /*height*/, SPAW_STYLESHEET /*stylesheet file*/);
				$sw->show();			

			?>
      </td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFEED6"> <p>&nbsp;</p></td>
      <td bgcolor="#FFEED6">&nbsp; </td>
    </tr>
    <tr valign="top"> 
      <td bgcolor="#FFEED6">&nbsp;</td>
      <td bgcolor="#FFEED6"> <input name="Submit" type="submit" value="<?=$submit_button?>"> 
      </td>
    </tr>
  </table>
		</form>
	<?

	require_once FOOTER;

}


function printPullDown($name, $values, $selected, $useKeys, $onChange="")
{
	print "<select name=\"$name\" id=\"$name\" ";
	if (!empty($onChange))
	{
		print " onChange=\"$onChange\"";
	}
	print ">\n";

	foreach ($values as $key => $value)
	{
		$key=($useKeys)?$key:$value;
		$SELECTED=($selected==$key)?"SELECTED":"";
		print "<option value=\"$key\" $SELECTED>$value</option>\n";
	}
	print "</select>";
}

function fixSqlQuotes($input)
{
	return str_replace("'", "''", stripslashes($input));
}


?>
<?php // include("footer_new.php"); ?>