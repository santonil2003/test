<?


function sendHtmlEmail($text, $html, $from, $to, $title){
	 include('htmlMimeMail.php');
	 $mail = new htmlMimeMail();
	 $mail->setHtml($html, $text);
	 $mail->setReturnPath($from);
	 $mail->setFrom($from);
	 $mail->setSubject($title);
	 $mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
	 $result = $mail->send(array($to), 'smtp');
	 

	 
	if (!$result) {
		echo "There were errors:<br><br>".print_r($mail->errors);
	}
}

?>