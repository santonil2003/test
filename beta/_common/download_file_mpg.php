<?php
require_once('_connection.php');

$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();

$id = $_GET['id'];

$sql = "SELECT document_db_bin_data, document_db_filename, ";
$sql .="document_db_filesize FROM document_db WHERE document_db_id='$id'";
	
  $result = mysql_query($sql) or die (mysql_error());
  
  //$data = mysql_result($result, 0, "document_db_bin_data");
  $name = mysql_result($result, 0, "document_db_filename");
  $size = mysql_result($result, 0, "document_db_filesize");
  $type = "video/mpg";
	
  header("Content-type: $type");
  header("Content-length: $size");
  header("Content-Disposition: attachment; filename=$name");
  header("Content-Description: PHP Generated Data");
  echo $data;




?>