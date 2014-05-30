<?

include("useractions.php"); 

sendLoyalty($_POST['username'], $_POST['emailadd'], $_POST['altemailadd'], $_POST['postadd'], $_POST['phonenumber'], $_POST['mobilenumber']);

exit;

?>