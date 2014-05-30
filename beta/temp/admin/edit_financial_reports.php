<?PHP
	require_once('../_common/_constants.php');
	require_once('../_common/_connection.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();
?>
<? require_once("header_new.php"); ?>

<?php // view report type
if(isset($_POST['period']))
	$period = $_POST['period'];
else 
	$period = 1; //default quarterly
	
//report end date
if( isset($_POST['from_day']) == true)
{	
	$the_date = mktime(0,0,0, (int)form_param('from_month'), (int)form_param('from_day'), (int)form_param('from_year'));
	$date_released = mktime(0,0,0, (int)form_param('to_month'), (int)form_param('to_day'), (int)form_param('to_year'));
}
?>

<?PHP // Add report
if(isset($_FILES['document_db_id_1']) == true && (int)$_FILES['document_db_id_1']['size'] > 0)
	{
		// upload image path
		$uploaddir = SITE_DIR.'docs/';
		$uploadfile = $uploaddir.basename($_FILES['document_db_id_1']['name']);	  
		if(move_uploaded_file($_FILES['document_db_id_1']['tmp_name'], $uploadfile))
			$data = addslashes(fread(fopen($uploadfile, "r"), filesize($uploadfile)));
		else {
			echo 'Problem: Could not move file to destination directory';
			exit;
		}

		if ($_POST['title']=='')
			$_POST['title'] = "Download Report";

		/*$document_record = array();
		$document_record['document_db_timestamp'] = date('Y-m-d', $date_released);
		//$document_record['*document_db_bin_data'] = "'$data'";
		$document_record['document_db_filename'] = $_FILES['document_db_id_1']['name'];
		$document_record['document_db_filesize'] = $_FILES['document_db_id_1']['size'];
		$document_record['document_db_mimetype'] = $_FILES['document_db_id_1']['type'];
		$document_record['report_type'] = $_POST['reporttype'];
		$document_record['period'] = $_POST['report'];
		$document_record['date_ended'] = date('Y-m-d', $the_date);
		db_insert('document_db', $document_record, &$document_db_id_1);*/


		$timestamp = date('Y-m-d', $date_released);
		$filename = $_FILES['document_db_id_1']['name'];
		$filesize = $_FILES['document_db_id_1']['size'];
		$filetype = $_FILES['document_db_id_1']['type'];
		$report_type = $_POST['reporttype'];
		$period = $_POST['report'];
		$name = $_POST['name'];
		$ended = date('Y-m-d', $the_date);
		
		
		$sql_insert = "INSERT INTO document_db (document_db_timestamp, document_db_filename, document_db_filesize,
		document_db_mimetype, report_type, name, period, date_ended) VALUES ('$timestamp', '$filename', '$filesize', '$filetype', '$report_type', '$name', '$period', '$ended')";
		$result = mysql_query($sql_insert) or die (mysql_error());
	}
?>
<td>
<SCRIPT LANGUAGE="JavaScript">

<!-- Confirm delete report -->
<!-- Begin       
function confirmDelete()
{
	var agree=confirm("Are you sure you want to delete this report?");
	if (agree)
		return true ;
	else
		return false ;
}
// End -->
</SCRIPT>
<table width="630" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td><h1>Financial Reports</h1>
        <form name="form1" method="post" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <table width="90%" border="0">
            <tr> 
              <td colspan="2"><h4><strong>Add new financial report 
                  <input name="reporttype" type="hidden" id="reporttype" value="1">
                  </strong></h4></td>
            </tr>
            <tr> 
              <td width="130">Type of Report :</td>
              <td><input name="report" type="radio" value="1" checked>
                Quarterly&nbsp; 
                <input type="radio" name="report" value="2">
                Half yearly&nbsp;&nbsp; <input type="radio" name="report" value="3">
                Annual</td>
            </tr>
            <tr> 
              <td>Date released :</td>
              <td> 
                <?
							html_pulldown('to_day', range(1,31), date('1'), false);
							?>
                / 
                <?
							html_pulldown('to_month', range(1,12), date('m'), false);
							?>
                / 
                <?
							html_pulldown('to_year', range(1998, date('Y')+15), date('Y'), false);
							?>
              </td>
            </tr>
            <tr> 
              <td>Choose pdf :</td>
              <td><input name="document_db_id_1" type="file" id="document_db_id_1"></td>
            </tr>
            <tr> 
              <td>Date report ended :</td>
              <td> 
                <?
							html_pulldown('from_day', range(1,31), 1, false);
							?>
                / 
                <?
							html_pulldown('from_month', range(1,12), date('m'), false);
							?>
                / 
                <?
							html_pulldown('from_year', range(1998, date('Y')+15),  date('Y'), false);
							?>
              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td><input type="submit" name="Submit" value="Submit"></td>
            </tr>
          </table>
        </form></td>
    </tr>
    <tr> 
      <td height="10"><hr noshade></td>
    </tr>
    <tr> 
      <td><h4><strong>View Reports</strong></h4></td>
    </tr>
    <tr> 
      <td> <form name="form2" method="post" action="">
          <table width="90%" border="0">
            <tr> 
              <td width="180">Select Report Period :</td>
              <td><select name="period" onChange="submit()">
                  <option value="1" <?php if ($period == 1) echo "selected";?>>Quarterly</option>
                  <option value="2" <?php if ($period == 2) echo "selected";?>>Half 
                  Yearly</option>
                  <option value="3" <?php if ($period == 3) echo "selected";?>>Annual</option>
                </select></td>
            </tr>
          </table>
        </form></td>
    </tr>
    <tr> 
      <td> <table width="90%" border="0">
          <tr> 
            <td><strong>Report Type</strong></td>
			 <td><strong>Report Name</strong></td>
            <td><strong>Date Released</strong></td>
            <td><strong>File Size</strong></td>
            <td><strong>Date Report Ended</strong></td>
			<td><strong>Delete Report</strong></td>
          </tr>
          <?PHP
	  	$sql1 = "SELECT * FROM document_db WHERE report_type = 1 AND period = '$period' ORDER BY document_db_timestamp DESC";
	  	$result1 = mysql_query($sql1) or die ("database error ".mysql_error);
		while ($row1 = mysql_fetch_assoc($result1)) 
		{
			if ($row1['period'] == 1)
				$r_period = "Quarterly";
			elseif ($row1['period'] == 2)
				$r_period = "Half Yearly";
			else
				$r_period = "Annual";
				
			$file_size = $row1['document_db_filesize'] / 1024;
			$delid = $row1['document_db_id'];
			$name = $row1['document_db_filename'];
			echo "
				  <tr>
					<td>	
							".$r_period."
					</td>
					<td>	
							".$name."
					</td>
					<td>	
							".date('d/m/Y', convert_datetime_to_timestamp($row1['document_db_timestamp']))."
					</td>
					<td>	
							". number_format($file_size, 2) ." KB
					</td>
					<td>	
						".date('d/m/Y', convert_datetime_to_timestamp($row1['date_ended']))."	
					</td>	
					<td bgcolor='FFCA3B' align='center'><a href='delete_report.php?delete_report=$delid'>Delete</a>
					</td>
				  </tr></form>"; 
		}
	  ?>
        </table></td>
    </tr>
    <tr>
      <td><hr noshade></td>
    </tr>
  </table></td>
<? include("footer_new.php"); ?>


