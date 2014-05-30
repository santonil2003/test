<?

  require_once('../_common/_connection.php');
  require_once('../_common/_constants.php');
  require_once('../_common/_database.php');
  require_once('../_common/_functions.php');
  $cfg = new Config();
  $db = new DbConnect($cfg);
  $db->connectDb();
  
 
  if(isset($_POST['id']) && $_POST['id']!='') {
  
    if($_POST['list']=="agents"||$_POST['list']=="loyalty") {
	 
	   switch($_POST['list']){
	     case "agents": 
	       $table = "agents_info";
	       $name_feild = "name";
	       $email_field ="email";
	       break;  
	     case "loyalty":  
	       $table = "loyalty_program";
	       $name_feild = "name";
	       $email_field ="email";
	       break;
	   }
	 
      if($_POST['id']=='-1') {
    
        $sql = "INSERT INTO `".$table."` ( ".$email_field." ) VALUES ( '".$_POST['email']."' ) ";
        $result = mysql_query($sql);
        if($result===true){
          if(mysql_affected_rows() == 1) {
            echo "true";
          } else {
            echo "nothing";
          }
        } else {
          echo "false";
        }      
      
      } else {    
        $sql = "UPDATE `".$table."` SET ".$email_field." = '".$_POST['email']."' WHERE id = '".$_POST['id']."' LIMIT 1";
        $result = mysql_query($sql);
        if($result===true){
          if(mysql_affected_rows() == 1) {
            echo "true";
          } else {
            echo "nothing";
          }
        } else {
          echo "false";
        }        
      }
      
    } else {
      
      if($_POST['id']=='-1') {
    
        $sql = "INSERT INTO `customers` ( emailadd  ) VALUES ( '".$_POST['email']."' ) ";
        $result = mysql_query($sql);
        if($result===true){
          if(mysql_affected_rows() == 1) {
            echo "true";
          } else {
            echo "nothing";
          }
        } else {
          echo "false";
        }      
      
      } else {    
        $sql = "UPDATE `customers` SET  emailadd  = '".$_POST['email']."' WHERE id = '".$_POST['id']."' LIMIT 1";
        $result = mysql_query($sql);
        if($result===true){
          if(mysql_affected_rows() == 1) {
            echo "true";
          } else {
            echo "nothing";
          }
        } else {
          echo "false";
        }      
      }
    
    }
  
  } else {
    echo "false";
  }
  
 
?>