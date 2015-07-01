<?php

require_once("PHPMailer.php");
require_once("SMTP.php");
include_once("POP3.php");


//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "info@identikid.com.au";

//Password to use for SMTP authentication
$mail->Password = "flappers66";

//Set who the message is to be sent from
$mail->setFrom('info@identikid.com.au', 'Identikid');

//Set an alternative reply-to address
$mail->addReplyTo('info@identikid.com.au', 'Identikid Info');

//Set who the message is to be sent to
$mail->addAddress('confirmations@identikid.com.au', 'Confirmations');
$mail->addAddress('web.developer.sanil@gmail.com', 'Sanil Shrestha');

//Set the subject line
$mail->Subject = 'Confirmation email test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('content.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
$mail->addAttachment('images/banner.gif');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
