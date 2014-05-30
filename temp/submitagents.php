<?

  include("useractions.php"); 
  
  sendAgents($_POST['country'],$_POST['city'],$_POST['suburb'],$_POST['post_code'],$_POST['username'],$_POST['postadd'],$_POST['telephone'],
  $_POST['emailadd'],$_POST['broadband'],$_POST['scan_docs'],$_POST['info']);
  
  exit;
  
?>