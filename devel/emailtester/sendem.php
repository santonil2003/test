<?
include('functions.php');

$to = $_POST["to"];
$from = $_POST["fromemail"];
$title = $_POST["title"];
$html = $_POST["htmlv"];
$text = $_POST["textv"];
 
sendHtmlEmail($text, $html, $from, $to, $title);

header("location:done.php");
?>
