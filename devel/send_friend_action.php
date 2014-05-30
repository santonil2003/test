<?

include("useractions.php");

sendToAFriend($_POST["username"], $_POST["to"], $_POST["fromemail"]);

header("location:send_friend.php?thankyou=true&address=".$_POST["to"]."&from=".$_POST["username"]);
exit;

?>