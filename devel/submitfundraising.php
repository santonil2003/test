<?

if($_POST['form_name']=="sample_pack")
{
	// sample pack submission

	$text = "New Fundraising Info has been requested:

Name  : {$_POST['name']}
Phone : {$_POST['phonenum']}
Email : {$_POST['emailadd']}
Postal: {$_POST['postadd']}

";

$subject = "New Funraising Info requested";



}
else {

	// fundraiser app forms

	$text = "A new fundraising application has been made:\n\n"
	."Group Name: ".$_POST["groupname"]."\n"
	."Contact Name: ".$_POST["contact"]."\n"
	."Phone: ".$_POST["phonenum"]."\n"
	."Email: ".$_POST["emailadd"]."\n"
	."Postal Address: ".$_POST["postadd"]."\n\n"
	."Delivery Address: ".$_POST["deladd"]."\n\n"
	."Stand required: ".$_POST["displaystand"]."\n"
	."Fundraising Type: ".$_POST["fundraisingtype"]."\n"
	."Number of Brochures: ".$_POST["brochnumbers"]."\n"
	."Have ABN Number: ".$_POST["haveabnnum"]."\n";
	if($_POST["haveabnnum"]=="yes"){
		$text .= "ABN Number: ".$_POST["abnnum"]."\n";
	}
	$text .= "GST Registration?: ".$_POST["gst"]."\n\n"
	."Fundraising Method: ".$_POST["frmethod"]."\n";
	
	if($_POST["payment"]=="eft"){
		$text.="BSB Number:\n ".$_POST["bsbnum"]."\n"
		."Account Number:\n ".$_POST["accnum"]."\n"
		."Account Name:\n ".$_POST["accname"]."\n\n";
	}
	
	$text.="Special requirements:\n ".$requirements."\n\n";
	
	$text.="1 Code allocated and details entered onto online spreadsheet"."\n"
	."2 Brochure stamped    No______________\n"
	."3 Posters printed\n"
	."5 Packaged and sent by courier    Date__________  Courier No ___________\n"
	."6 Fundraiser Costed\n"
	."a) courier $_______\n"
	."b) brochures $___________\n"
	."c) packaging $____________\n"
	."d) printouts  $___________\n"
	."e) stand  $____________\n"
	."TL\$___________\n"
	."7 Hard copy filed\n";

	$subject = "A new fundraising application";

}


$to = "info@identikid.com.au,leanne@identikid.com.au";
//$to = "shaun@echidnaweb.com.au";

// send the email
$headers .= "From:identikid website<$emailadd>\n"
."X-Mailer: PHP\n"
."X-Priority: 1\n"
."Content-Type: text/plain; charset=iso-8859-1\n";	
mail($to, $subject, $text, $headers);

header("location:fundraiser_received.php");
exit;
?>