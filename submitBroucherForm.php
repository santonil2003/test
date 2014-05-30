<?

$text = "A Brouchure has been requested:

Name  : {$_POST['username']}
Postal Address : {$_POST['postadd']}
Email : {$_POST['emailadd']}
Phone : {$_POST['phone']}
";

$subject = "A Brouchure has been requested";


$to = "info@identikid.com.au";
//$to = "peter@echidnaweb.com.au";

// send the email
$headers .= "From:identikid website<$emailadd>\n"
."X-Mailer: PHP\n"
."X-Priority: 1\n"
."Content-Type: text/plain; charset=iso-8859-1\n";	
mail($to, $subject, $text, $headers);

print("true");
exit;

?>