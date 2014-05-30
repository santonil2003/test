<?
  require_once('../_common/_connection.php');
  require_once('../_common/_constants.php');
  require_once('../_common/_database.php');
  require_once('../_common/_functions.php');
  include_once("../email/htmlMimeMail.php");
  $cfg = new Config();
  $db = new DbConnect($cfg);
  $db->connectDb();
 
 function sendNewsletter($to, $name, $title, $html ){
	$from = "Identikid <info@identikid.com.au>";
   $bounce = "info@identikid.com.au";
	$text = strip_tags($html);
	if(!empty($to)){
		$mail = new htmlMimeMail();
		$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		$mail->setHtml($html, $text);
		$mail->setReturnPath($bounce);
		$mail->setFrom($from);
		$mail->setSubject($title);
		$attachments = split(',', $attach);
		if($attach!=null){
	     foreach($attachments as $attachment) {
	       $mail->addAttachment(file_get_contents($attachment),basename($attachment));
	     }
	   }

	 //$result = $mail->send(array($to), 'smtp');
	 $result = $mail->send(array($to), 'mail');
	
		if (!$result)  {
      return false;
    } else {
      return true;    
    }
	}
}
 
  function sendNewsletter_old($email,$name,$title,$contents) {
  
    $sendto = "$email"; 
	 $emailHeader  = 'MIME-Version: 1.0' . "\r\n";
    $emailHeader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $emailHeader .= "From: Identikid <info@identikid.com.au>". "\r\n";	
    $subject = "$title";   
	 $message =	$contents;
	 $success = mail($sendto, $subject, $message, $emailHeader);   
	 if (!($success)) {
      return false;
    } else {
      return true;    
    }
    
  }
  
  if(isset($_POST['id']) && $_POST['id']!='' ){
    $sql = "SELECT * FROM newsletter WHERE id = '".$_POST['id']."' LIMIT 1 ";
    $result = mysql_query($sql);
    if($result) {
      $row = mysql_fetch_array($result);
      $title = $row['title'];
      $contents = file_get_contents(SITE_DIR.'newsletter/'.$row['file']);
      $faults = 0;
      
      if(isset($_POST['send']) && $_POST['send']=='bulk' &&
         isset($_POST['startAt']) && $_POST['startAt']!=''){
         
       
        $cats_sql = "SELECT site_newsletter_categories.table, site_newsletter_categories.id,site_newsletter_categories.email_field
				FROM site_newsletter_categories_assign
				JOIN site_newsletter_categories ON ( site_newsletter_categories_assign.newsletter_cat_id = site_newsletter_categories.id )
				WHERE site_newsletter_categories_assign.newsletter_id = '".$_POST['id']."'
				ORDER BY site_newsletter_categories.id";
			
			$total_sub = array();
			   
			$cats_result = mysql_query($cats_sql);
			if($cats_result) {
			  while($cats_row=mysql_fetch_assoc($cats_result)){
			    $total_sub[$cats_row['id']][0]=$cats_row['table'];
			    $total_sub[$cats_row['id']][1]=$cats_row['email_field'];
			    $sql = 	"SELECT * FROM ".$cats_row['table'].
						" WHERE (".$cats_row['email_field']." <> '')".
						// Filter out BigPond addresses
						" AND (".$cats_row['email_field']." NOT LIKE '%@bigpond%')".
						" AND (subscriber = 'Yes')".
						" GROUP BY ".$cats_row['email_field'];
	          $result = mysql_query($sql);
	          if($result) {
	            $total_sub[$cats_row['id']][2] = mysql_num_rows($result);
	          } else {
	            $total_sub[$cats_row['id']][2] = 0;
	          }
			  }
		   } 
      
        $total_processed = 0;
        $offset = 0;
        $start = 0;
        foreach($total_sub as $id => $row) {
        
        $offset+=$row[2];      
        
        if(($total_processed < BULK_EMAIL_SEND_SIZE) && ($offset > $_POST['startAt'])) { 
        
        $start = ($_POST['startAt'] - ($offset-$row[2]))>=0?$_POST['startAt'] - ($offset-$row[2]):0;
        
        $sql = 	"SELECT * FROM `".$row[0]."`".
				" WHERE (".$row[1]." <> '')".
				// Filter out BigPond addresses
				" AND (".$row[1]." NOT LIKE '%@bigpond%')".
				" AND (subscriber = 'Yes')".
				" GROUP BY ".$row[1].
				" ORDER BY `id` DESC LIMIT ".$start." , ".BULK_EMAIL_SEND_SIZE;
				
		  //echo($sql);
	     $result = mysql_query($sql);
	     $count = 0;
	     while ($rows = mysql_fetch_array($result))
	     {
          $ok = sendNewsletter($rows[$row[1]],'',$title,$contents);   
          if($ok==false) $faults++;
          $count++;
          
	     } 
	     
	     $total_processed+=$count;

	     }
	     
	     }
	     
	     $sql = "UPDATE newsletter SET sent = sent + '".$count."' WHERE id = '".$_POST['id']."' LIMIT 1 ";
	     mysql_query($sql);
	     
	     echo $faults;
	     
	   } else if(isset($_POST['send']) && $_POST['send']=='1' && 
	             isset($_POST['email']) && $_POST['email']!='' ){
	             
	     $ok = sendNewsletter($_POST['email'],'',$title,$contents);   
        if($ok==false) $faults++;
        echo $faults;
        
	   } else {
	     echo "false";
	   }
	   
    } else {
      echo "false";
    }
    
  } else {
    echo "false";
  }
  
  exit;

?>
