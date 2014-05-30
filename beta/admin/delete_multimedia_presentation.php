<?PHP
	require_once('../_common/_connection.php');
	require_once('../_common/_constants.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();
?>
<?PHP // Delete multimedia presentation
	if (isset($_GET['delete_report']))
	{
		$report_id = $_GET['delete_report'];
		// remove old presentation
		$sql_ppt = "SELECT document_db_filename FROM document_db WHERE document_db_id = '$report_id'";
		$result_ppt = mysql_query($sql_ppt) or die (mysql_query());
		$row_ppt = mysql_fetch_assoc($result_ppt);
		$remove_name = SITE_DIR."docs/".$row_ppt['document_db_filename'];
		$fh = fopen($remove_name, 'r') or die("can't open file");
		fclose($fh);
		unlink($remove_name);
	
		$theid = $_GET['delete_report'];
		$sql_delete = "DELETE FROM document_db WHERE document_db_id = '$theid'";
		$result = mysql_query($sql_delete) or die(mysql_error());
		
		Header('Location: edit_multimedia.php');
		
	}
	
	 // Delete interview
	if (isset($_GET['delete_interview']))
	{
		$theid = $_GET['delete_interview'];
		$sql_delete = "DELETE FROM links WHERE id = '$theid'";
		$result = mysql_query($sql_delete) or die(mysql_error());
		Header('Location: edit_multimedia.php');
	}
	
	//Display or hide presentation
	if (isset($_GET['show_powerpoint']))
	{
		$display_status = $_GET['show_powerpoint'];
		$sql = "UPDATE `document_db` SET `show` ='$display_status' WHERE `document_db_id` = 14";
		$result = mysql_query($sql) or die($sql." ".mysql_error());
		Header('Location: edit_multimedia.php');
	}
	
		//Display or hide presentation
	if (isset($_GET['show_presentation']))
	{
		$display_status = $_GET['show_presentation'];
		$sql = "UPDATE `document_db` SET `show` ='$display_status' WHERE `report_type` = 2";
		$result = mysql_query($sql) or die($sql." ".mysql_error());
		Header('Location: edit_multimedia.php');
	}
?>
