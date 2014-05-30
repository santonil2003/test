<?PHP
	require_once('../_common/_connection.php');
	require_once('../_common/_constants.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();
?>
<? require_once("header_new.php"); ?>

<?php
	if (isset($_POST['highlight_text']) && $_POST['highlight_text']!='')
	{
		$thetext = $_POST['highlight_text']; 
		$thelink = $_POST['highlight_link'];
		$sql_links = "INSERT INTO links (text, link, type) VALUES ('$thetext','$thelink', 2)";
		mysql_query ($sql_links) or die (mysql_error());
	}
?>

<?PHP // Delete interview
	if (isset($_GET['delete']))
	{
		$theid = $_GET['delete'];
		$sql_delete = "DELETE FROM links WHERE id = '$theid'";
		$result = mysql_query($sql_delete) or die(mysql_error());
	}
?>


<?PHP // Add highlight file
if(isset($_FILES['document_db_id_1']) == true && (int)$_FILES['document_db_id_1']['size'] > 0)
	{
		$name = addslashes($_POST['name']);
		if ($name == '')
		{
			echo "No name/text to display for the file was entered, <br /> please enter text into (Text to display :) field.";
		}
		else {			
			// upload image path
			$uploaddir = '/home/tectonic1/www/docs/';
			$uploadfile = $uploaddir.basename($_FILES['document_db_id_1']['name']);	
			
			// move image to temporary directory     
			if(move_uploaded_file($_FILES['document_db_id_1']['tmp_name'], $uploadfile))
				$data = addslashes(fread(fopen($uploadfile, "r"), filesize($uploadfile)));
			else
				echo 'Problem: Could not move file to destination directory';
	
			
			$timestamp = date('Y-m-d', $date_released);
			$filename = $_FILES['document_db_id_1']['name'];
			$filesize = $_FILES['document_db_id_1']['size'];
			$filetype = $_FILES['document_db_id_1']['type'];
			$report_type = $_POST['reporttype'];
			//$name = $_POST['name'];
			
			
			$sql_insert = "INSERT INTO document_db (document_db_timestamp, document_db_filename, document_db_filesize,
			document_db_mimetype, report_type, name) VALUES ('$timestamp', '$filename', '$filesize', '$filetype', '$report_type', '$name')";
			$result = mysql_query($sql_insert) or die (mysql_error());
		}
		//db_insert('document_db', $document_record, &$document_db_id_1);

	}
?>


<SCRIPT LANGUAGE="JavaScript">

<!-- Confirm delete report -->
<!-- Begin       
function confirmDelete()
{
	var agree=confirm("Are you sure you want to delete this link?");
	if (agree)
		return true ;
	else
		return false ;
}
// End -->
</SCRIPT>
<SCRIPT>	
	submited=false;


	function chkForm(form7) {
	 
	  if(!submited) {
		if (form7.highlight_text.value == '' && form7.highlight_link.value != '') {
			alert('Please enter the link text');
			form7.highlight_text.focus;
			return false;
		}
		  
		if (form7.highlight_link.value == '' && form7.highlight_text.value != '') {
			alert('Please enter the url');
			form7.highlight_link.focus;
			return false;
		}
	  	return true;
	 }
	}
</script>
<td>
<table width="630" border="0" cellspacing="0" cellpadding="2">
<tr> 
      <td><strong><font size="4">Add new highlight link</font></strong></td>
    </tr>
    <tr> 
      <td><form name="form7" method="post" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onSubmit="return chkForm(this)">
          <table width="90%" border="0">
            <tr> 
              <td width="130">Text to display :</td>
              <td><input name="highlight_text" type="text" id="highlight_text" size="40"></td>
            </tr>
            <tr> 
              <td valign="top">Link :</td>
              <td><input name="highlight_link" type="text" id="highlight_link" size="40"> 
                <br>
                (do not include http://)</td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td><input type="submit" name="Submit2" value="Add"></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Text to display :</td>
              <td><input name="name" type="text" id="name" size="40"></td>
            </tr>
            <tr> 
              <td>File :</td>
              <td><input name="document_db_id_1" type="file" id="document_db_id_1">
                <input name="reporttype" type="hidden" value="5">
                <br>
                <font size="2">file size cannot exceed 10 MB</font></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form></td>
    </tr>
    <tr>
      <td><strong><font size="3">Highlight link Archives</font></strong></td>
    </tr>
    <tr> 
      <td><form name="form1" method="post" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	  	<table width="90%" border="0">
       <?php	
		$sql9 = "SELECT * FROM links WHERE type = 2 ORDER BY id";
	  	$result9 = mysql_query($sql9) or die ("database error ".mysql_error);
		while ($row9 = mysql_fetch_assoc($result9)) 
		{  
		  $delid = $row9['id'];
		  echo "
		  <tr> 
            <td bgcolor='#CCCCCC'><a href='http://".$row9['link']."' target='_blank'>".$row9['text']."</a></td>
            <td bgcolor='FFCA3B' align='center'><a href='edit_highlights.php?delete=$delid'>Delete</a></td>
          </tr>";
		 }
		 ?>
		<?php	
		$sql6 = "SELECT * FROM document_db WHERE report_type = 5 ORDER BY document_db_id";
	  	$result6 = mysql_query($sql6) or die ("database error ".mysql_error);
		while ($row6 = mysql_fetch_assoc($result6)) 
		{  
		  $delid2 = $row6['document_db_id'];
		  echo "
		  <tr> 
            <td bgcolor='#CCCCCC'><a href='".SITE_URL."docs/".$row6['document_db_filename']."' target='_blank'>".$row6['name']."</a></td>
            <td bgcolor='FFCA3B' align='center'><a href='delete_highlight_file.php?delete_report=$delid2'>Delete</a></td>
          </tr>";
		 }
		 ?>
        </table></form></td>
    </tr>
    <br>
  </table>
</td>
<? include("footer_new.php"); ?>
