<?php
require_once('_constants.php');
function force_download ($data, $name, $mimetype='', $filesize=false) {
    // File size not set?
    if ($filesize == false OR !is_numeric($filesize)) {
      $filesize = strlen($data);
    }

    // Mimetype not set?
    if (empty($mimetype)) {
      $mimetype = mime_content_type (SITE_DIR.$name);
      //$mimetype = 'application/octet-stream';
    }

    // Make sure there's not anything else left
    ob_clean_all();

    // Start sending headers
    header("Pragma: public"); // required
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); // required for certain browsers
    header("Content-Type: " . $mimetype);
    header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . $filesize);

    // Send data
    echo $data;
    die();
}

function ob_clean_all () {
    $ob_active = ob_get_length () !== false;
    while($ob_active) {
        ob_end_clean();
        $ob_active = ob_get_length () !== false;
    }

    return true;
}


if(isset($_GET['id']) && $_GET['id'] != '') {

  require_once('_connection.php');
  $cfg = new Config();
  $db = new DbConnect($cfg);
  $db->connectDb();

  $id = $_GET['id'];

  $sql = "SELECT document_db_bin_data, document_db_filename, ";
  $sql .="document_db_filesize, document_db_type  FROM document_db WHERE document_db_id='$id'";
	
  $result = mysql_query($sql) or die (mysql_error());
  
  $data = mysql_result($result, 0, "document_db_bin_data");
  $name = mysql_result($result, 0, "document_db_filename");
  $size = mysql_result($result, 0, "document_db_filesize");
  $type = mysql_result($result, 0, "document_db_type");  
  
  header("Content-type: $type");
  header("Content-length: $size");
  header("Content-Disposition: attachment; filename=$name");
  header("Content-Description: PHP Generated Data");
  echo $data;
  exit;
  
} else if(isset($_GET['f']) && $_GET['f'] != '') {

  $filename = basename($_GET['f']);
  if(!ereg("." . "php", $filename) && !ereg("." . "js", $filename)
  && !ereg("." . "htm", $filename) && !ereg("." . "html", $filename)
  && !ereg("." . "ht", $filename) && !ereg("password", $filename) ){ 
    if( ($filedata = file_get_contents(SITE_DIR.$_GET['f'])) !==false ) {
      force_download($filedata, $_GET['f']);
    }
  }
  exit;
  
}

?>