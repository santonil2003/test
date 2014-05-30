<?PHP
	require_once('../_common/_connection.php');
	require_once('../_common/_constants.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();
?>
<?PHP // Delete report
	if (isset($_GET['delete_report']))
	{
		$report_id = $_GET['delete_report'];
		$sql_ppt = "SELECT document_db_filename FROM document_db WHERE document_db_id = '$report_id'";
		$result_ppt = mysql_query($sql_ppt) or die (mysql_query());
		$row_ppt = mysql_fetch_assoc($result_ppt);
		$remove_name = SITE_DIR."docs/".$row_ppt['document_db_filename'];
		$fh = fopen($remove_name, 'r') or die("can't open file");
		fclose($fh);
		//unlink($remove_name);
		$theid = $_GET['delete_report'];
		$sql_delete = "DELETE FROM document_db WHERE document_db_id = '$theid'";
		$result = mysql_query($sql_delete) or die(mysql_error());
		//unset($_GET['delete_report']);
		Header('Location: edit_financial_reports.php');
	}
?>