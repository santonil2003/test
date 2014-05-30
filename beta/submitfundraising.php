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

$subject = "New Fundraising Info requested";



}
else if($_POST['form_name']=="fundraiser_registration")
{

	// fundraiser app forms

	$text = "A new fundraising application has been made:\n\n"
	."Group Name: ".$_POST["groupname"]."\n"
	."Contact Name: ".$_POST["contact"]."\n"
	."Phone: ".$_POST["phonenum"]."\n"
	."Fax: ".$_POST["faxnum"]."\n"
	."Mobile: ".$_POST["mobilenum"]."\n"
	."Email: ".$_POST["emailadd"]."\n"
	."Cheque in Name of: ".$_POST["cheque_in_name_of"]."\n"
	."Postal Address: ".$_POST["postadd"]."\n\n"
	."Delivery Address: ".$_POST["deladd"]."\n\n"
	//."Stand required: ".$_POST["displaystand"]."\n"
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
	
	$text.="Special requirements:\n ".stripslashes($requirements)."\n\n";
	
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
 else if($_POST['form_name']=="fundraiser_supplies")
{

	// fundraiser supplies

	$text = "A request for fundraising supplies has been made:\n\n"
	."Group Name: ".$_POST["groupname"]."\n"
	."Contact Name: ".$_POST["contact"]."\n"
	."Phone: ".$_POST["phonenum"]."\n"
	."Email: ".$_POST["emailadd"]."\n"
	."Delivery Address: ".$_POST["deladd"]."\n"
	."Code: ".$_POST["funcode"]."\n"
	."Stand: ".$_POST["displaystand"]."\n"
   ."Brouchures: ".$_POST["brochnumbers"]."\n";
   
	$text.="Special requirements:\n ".$requirements."\n\n";

	$subject = "Fundraising supplies";

}

$to = "info@identikid.com.au";
//$to = "gary@echidnaweb.com.au";

// send the email
$headers .= "From:identikid website<$emailadd>\n"
."X-Mailer: PHP\n"
."X-Priority: 1\n"
."Content-Type: text/plain; charset=iso-8859-1\n";	
mail($to, $subject, $text, $headers);

if($_POST['form_name']=="fundraiser_registration")
{

	// fundraiser app forms

	$text = "Your fundraising application has been made with the following details:\n\n"
	."Group Name: ".$_POST["groupname"]."\n"
	."Contact Name: ".$_POST["contact"]."\n"
	."Phone: ".$_POST["phonenum"]."\n"
	."Fax: ".$_POST["faxnum"]."\n"
	."Mobile: ".$_POST["mobilenum"]."\n"
	."Email: ".$_POST["emailadd"]."\n"
	."Cheque in Name of: ".$_POST["cheque_in_name_of"]."\n"
	."Postal Address: ".$_POST["postadd"]."\n\n"
	."Delivery Address: ".$_POST["deladd"]."\n\n"
	//."Stand required: ".$_POST["displaystand"]."\n"
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
	
	$text.="Special requirements:\n ".stripslashes($requirements)."\n\n";

	$text.="\n\nPlease check details and contact fundraising@identikid.com.au if any details are incorrect.\n\n";

	$subject = "Your Identikid fundraising application";

}

$to = $_POST["emailadd"];

// send the email
$headers .= "From:identikid fundraising<fundraising@identikid.com.au>\n"
."X-Mailer: PHP\n"
."X-Priority: 1\n"
."Content-Type: text/plain; charset=iso-8859-1\n";	
mail($to, $subject, $text, $headers);


//header("location:fundraiser_received.php");
print("true");
exit;
?>
