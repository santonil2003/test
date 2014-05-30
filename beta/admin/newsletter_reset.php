<?

  if(isset($_POST['id']) && $_POST['id']!='') {
  
   require_once('../_common/_connection.php');
   require_once('../_common/_constants.php');
   require_once('../_common/_database.php');
   require_once('../_common/_functions.php');
   $cfg = new Config();
   $db = new DbConnect($cfg);
   $db->connectDb();
  
    $sql = "UPDATE newsletter SET sent = 0 WHERE id = '".$_POST['id']."' LIMIT 1 ";
    $result = mysql_query($sql);
    if($result){
      if(mysql_affected_rows()==1){
        echo "true";
      } else {
        echo "false";
      }
    } else {
      echo "false";
    }
  
  }
	     
?>