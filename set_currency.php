<?
	session_start();
	
	require_once('_common/_constants.php');
	//db setup - configure & set up db connection
   require_once(SITE_DIR.'_common/_connection.php');
   $cfg = new Config();
   $db = new DbConnect($cfg);
   $db->connectDb();
   //end db setup
   
   include("useractions.php");
   
	if(isset($_POST['currency']))
	{ 
	  $id = checkOrderId(false);
	  if($_POST['reset'] == "true" && $id!="") {
	    $query = "DELETE FROM basket_items WHERE ordernumber=".$id;
	    mysql_query($query);
	    $sessid = session_id();
		 $query = "DELETE FROM orders WHERE sessid='".$sessid."' LIMIT 1";
		 mysql_query($query);
	  }
	  
	  $numRows = 0;
	  
	  if($id!="") {
	    $query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	    //echo $query;
	    $result = mysql_query($query);
	    if(!$result) error_message(sql_error());
	    $numRows = mysql_num_rows($result);
	  }
	  
	  if($numRows>0){
	    echo "confirm";   
	  } else {
	    if(setcookie("currency", $_POST['currency'], 0, "/")){
	      echo "true";
	    } else {
	      echo "false";
	    }
	  }
	} else {
	  echo "false";
	}
	
	
	//close db   if(isset($db))$db->closeDb();
   //end close db
?>