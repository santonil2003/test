<?

if(isset($_POST['ids']) && $_POST['ids'] != ''){
  session_start();
  if(isset($_POST['reset_ids']) && $_POST['reset_ids'] == '1'){
    unset($_SESSION['ids']);
  }
  $_SESSION['ids'] = $_SESSION['ids'].$_POST['ids'];
}

?>