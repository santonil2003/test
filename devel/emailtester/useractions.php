<?
$useractions = "loaded";
if(isset($includeabove) && $includeabove==true){
	include("../common_db.php");
}else{
	include("common_db.php");
}
$absimageurl = "http://www.sitepond.com/~identiki";

function getDisplayFlash($num){
	if($num==1 || $num>9){
		return "display_vinyl.swf";
	}else if($num==2){
		return "display_iron.swf";
	}else if($num==3){
		return "display_mini.swf";
	}else if($num==4){
		return "display_shoe.swf";
	}else if($num==5){
		return "display_pencil.swf";
	}else if($num==6){
		return "display_bag.swf";
	}else if($num==8){
		return "display_diy_small.swf";
	}else if($num==9){
		return "display_diy_large.swf";
	}
}

function getLabelType($num){
	if($num==1){
		return "Vinyl labels";
	}else if($num==2){
		return "Iron on labels";
	}else if($num==3){
		return "Mini Vinyl labels";
	}else if($num==4){
		return "Shoe labels";
	}else if($num==5){
		return "Pencil labels";
	}else if($num==6){
		return "Bag Tags";
	}else if($num==7){
		return "KIDCARDS";
	}else if($num==8){
		return "DIY labels - Small";
	}else if($num==9){
		return "DIY labels - Large";
	}else if($num==10){
		return "Starter Pack";
	}else if($num==11){
		return "Mixed Pack";
	}else if($num==12){
		return "Birthday Pack";
	}else if($num==13){
		return "Gift Box";
	}
}

function getPicType($num){
	if($num==1){
		return "Sun";
	}else if($num==2){
		return "Boy";
	}else if($num==3){
		return "Mouse";
	}else if($num==4){
		return "Heart";
	}else if($num==5){
		return "Girl";
	}else if($num==6){
		return "Flower";
	}else if($num==7){
		return "Butterfly";
	}else if($num==8){
		return "UFO";
	}else if($num==9){
		return "Car";
	}else if($num==10){
		return "Alien";
	}else if($num==11){
		return "Star";
	}else if($num==12){
		return "Dinosaur";
	}else if($num==13){
		return "Fairy";
	}else if($num==14){
		return "Dog";
	}else if($num==15){
		return "Aeroplane";
	}else if($num==16){
		return "Mermaid";
	}else if($num==17){
		return "Truck";
	}else if($num==18){
		return "Shark";
	}else if($num==19){
		return "Train";
	}else if($num==20){
		return "Ballerina";
	}
}

function toDollarsAndCents($num){
	$pos = strpos($num, ".");
	if ($pos === false){
		$decimal = "";
	}else{
		$decimal = substr($num, $pos, strlen($num));
	}
	if(strlen($decimal)==0){
		$decimal = ".00";
	}else if(strlen($decimal)==2){
		$decimal .= "0";
	}
	return floor($num).$decimal;
}

function checkOrderId($makenew){
	linkme();

	$query = "SELECT * FROM orders WHERE sessid='".session_id()."'";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	if(mysql_num_rows($result)>0){
		while($qdata = mysql_fetch_array($result)){
			$id = $qdata["id"];
		}
		return $id;
	}else if($makenew==true){
		$query = "INSERT INTO customers () VALUES ()";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$query = "INSERT INTO orders (sessid, started, finished, customer) VALUES ('".session_id()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', ".mysql_insert_id().")";
		$result2 = mysql_query($query);
		if(!$result2) error_message(sql_error());
		
		return mysql_insert_id();
	}else{
		return false;
	}
}


function deleteOrderId($id){
	$query = "UPDATE orders SET sessid='' WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}

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

function sendTestimonialNotice($username, $emailadd, $testmonial){
	$text = "A testimonial has been submitted\n\n"
	."Name: ".$username."\n"
	."Email: ".$emailadd."\n\n"
	."Testimonial:\n ".$testmonial."\n";
	
	$to = "info@identikid.com.au";
	
	// send the email
		$headers .= "From:identi Kid website user<$from>\n"
		."X-Sender: <$username>\n"
		."X-Mailer: PHP\n"
		."X-Priority: 3\n"
		."Return-Path: <$username>\n"
		."Content-Type: text/plain; charset=iso-8859-1\n";	
		mail($to, "Testimonial submission", $text, $headers);
}

function sendNewOrder($id, $name, $email, $payment){
	$text = "A order has been submitted\n\n"
	."Name: ".$name."\n"
	."Email: ".$email."\n\n"
	."Payment Type:\n ".$payment."\n\n"
	."View the order here:\n http://www.identikid.com.au/admin/vieworder.php?id=".$id."\n";
	
	
	$from = "info@identikind.com.au";
	// send the email
	$headers .= "From:identi Kid website user<$from>\n"
	."X-Sender: <$username>\n"
	."X-Mailer: PHP\n"
	."X-Priority: 1\n"
	."Return-Path: <$username>\n"
	."Content-Type: text/plain; charset=iso-8859-1\n";
	
	$to = "info@identikid.com.au";
	//mail($to, "New order", $text, $headers);
	
	$to = "simon@echidnaweb.com.au;";
	//mail($to, "New order", $text, $headers);
	
	// get order info
	linkme();
	
	$query = "SELECT customer FROM orders WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$custid = $qdata["customer"];
	}
	
	$query = "SELECT emailadd FROM customers WHERE id=".$custid;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$custemail = $qdata["emailadd"];
	}
	
	$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	// create content
	$text = "";
	
	$content .= "<tr>"
				."<td class=\"maintext\"><br>"
					."<font face=\"Comic Sans MS\" size=\"2\"><strong>Thanks for your order!</strong><br><br>"
					."Your invoice number is: ".(1000+$id)."<br><br>"
					."Your order:<br>";
	$text = "Thanks for your order!\n\nYour invoice number is: ".(1000+$id)."\n\nYour order:\n";
	while($qdata = mysql_fetch_array($result)){
		$content.= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."<br>";
		$text .= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."\n";
	}
	$content.="<br><br>Thankyou,<br><br>identiKid";
	$text .= "\n\nThankyou,\n\nidentiKid";
	$content.="</font></td>"
			."</tr>";
	
	$html = makeHtmlContent($content);
	
	$from="info@identikid.com.au";
	$title = " Your order confirmation: invoice #".(1000+$id);
	$to = $custemail;
	
	// send the email
	sendHtmlEmail($text, $html, $from, $to, $title);
	//echo $html."<br>".$text;

}


function sendToAFriend($username, $to, $fromemail){
	global $absimageurl;
	
	// create content
	$text = "Your friend ".$username." (".$fromemail.") thought that you would enjoy our site.\n\n"
	."Click here to visit identi Kid: http://www.identikid.com.au\n\n\nNote: this is an automated email – no need to reply.";
	
	$content .= "<tr>"
				."<td class=\"maintext\"><br>"
					."<font face=\"Comic Sans MS\" size=\"2\">Your friend ".$username." (".$fromemail.") thought that you would enjoy our site. <br>"
					."<a href=\"http://www.identikid.com.au/\">Click here</a> to visit <strong>identi Kid<br></strong></font></td>"
			."</tr>"
			."<tr>"
			."<td><br><font face=\"Comic Sans MS\" size=\"2\"><strong>Note: this is an automated email – no need to reply.</strong></font></td>"
			."</tr>";
	
	$html = makeHtmlContent($content);
	
	$from="info@identikid.com.au";
	$title = "A message from ".$username;
	
	// send the email
	sendHtmlEmail($text, $html, $from, $to, $title);
	
}


function makeHtmlContent($content){
	global $absimageurl;
	$html.="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
       ."<tr>"
          ."<td width=\"181\" valign=\"top\" background=\"$absimageurl/images/bg_left_column.gif\">"
            ."<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
              ."<tr>"
                ."<td><a href=\"index.php\"><img src=\"$absimageurl/images/logo_top_products.gif\" alt=\"Identi Kid\" width=\"181\" height=\"62\" border=\"0\"></a></td>"
              ."</tr>"
              ."<tr>"
                ."<td><a href=\"index.php\"><img src=\"$absimageurl/images/logo_middle_products.gif\" alt=\"Identi Kid\" width=\"181\" height=\"90\" border=\"0\"></a></td>"
              ."</tr>"
              ."<tr>"
                ."<td><a href=\"index.php\"><img src=\"$absimageurl/images/logo_bottom_products.gif\" alt=\"Identi Kid\" width=\"181\" height=\"43\" border=\"0\"></a></td>"
              ."</tr>"
            ."</table></td>"
          ."<td width=\"418\" valign=\"top\" bgcolor=\"#6FFF6F\">"
		  ."<table width=\"418\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#6FFF6F\">"
              ."<tr valign=\"top\">"
                ."<td width=\"60\" background=\"$absimageurl/images/bg_blue_heading.gif\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"60\" height=\"10\"></td>"
                ."<td width=\"304\"><img src=\"$absimageurl/images/heading_labels_for_littlies.gif\" alt=\"Labels for littlies\" width=\"304\" height=\"62\"></td>"
                ."<td width=\"54\" background=\"$absimageurl/images/bg_blue_heading.gif\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"54\" height=\"10\"></td>"
              ."</tr>"
              ."<tr valign=\"top\">"
                ."<td colspan=\"3\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
                    ."<tr valign=\"top\">"
                      ."<td colspan=\"2\" bgcolor=\"6FFF6F\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"10\" height=\"10\"></td>"
                    ."</tr>"
                    ."<tr valign=\"top\">"
                      ."<td colspan=\"2\" bgcolor=\"6FFF6F\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"10\" height=\"10\"></td>"
                    ."</tr>"
                  ."</table></td>"
              ."</tr>"
              ."<tr valign=\"top\" bgcolor=\"#66FF66\">"
                ."<td colspan=\"3\" bgcolor=\"#6FFF6F\">"
				."<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"FFFFFF\">"
                    ."<tr>"
                      ."<td width=\"10\" rowspan=\"2\" valign=\"top\" bgcolor=\"#FFFFFF\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"20\" height=\"10\"></td>"
                      ."<td width=\"397\" valign=\"top\" bgcolor=\"#FFFFFF\">"
					  ."<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
                          ."<tr>"
                            ."<td>&nbsp;</td>"
                          ."</tr>"
                          .$content
                        ."</table></td>"
                      ."<td width=\"10\" rowspan=\"2\" valign=\"top\" bgcolor=\"#FFFFFF\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"10\" height=\"10\"></td>"
                    ."</tr>"
                    ."<tr valign=\"top\">"
                      ."<td bgcolor=\"#FFFFFF\">&nbsp;</td>"
                    ."</tr>"
                    ."<tr>"
                      ."<td colspan=\"3\" valign=\"top\"><img src=\"$absimageurl/images/spacer_trans.gif\" width=\"10\" height=\"10\"></td>"
                    ."</tr>"
                    ."<tr bgcolor=\"#6FFF6F\">"
                      ."<td colspan=\"3\" valign=\"top\"><br> </td>"
                    ."</tr>"
                  ."</table></td>"
              ."</tr>"
            ."</table></td>"
          ."<td valign=\"top\" bgcolor=\"#FF9900\">"
		  ."<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
              ."<tr>"
                ."<td><img src=\"$absimageurl/images/image_phone_heading.gif\" alt=\"Ph: 1300 133 949\" width=\"141\" height=\"62\"></td>"
              ."</tr>"
              ."<tr>"
                ."<td>&nbsp;</td>"
              ."</tr>"
            ."</table></td>"
        ."</tr>"
        ."<tr>"
          ."<td height=\"30\" colspan=\"3\" valign=\"top\">"
          ."<table width=\"100%\" height=\"30\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"f0027f\">"
			  ."<tr>"
				."<td width=\"172\" height=\"30\" valign=\"top\"><img src=\"$absimageurl/images/logo_footer.gif\" alt=\"identi kid\" width=\"172\" height=\"30\"></td>"
				."<td width=\"23\" valign=\"middle\">"
				  ."<div align=\"center\"><img src=\"$absimageurl/images/image_phone.gif\" alt=\"Phone\" width=\"35\" height=\"23\"></div></td>"
				."<td width=\"137\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Phone: 1300 133 949</font></td>"
				."<td width=\"25\" valign=\"middle\">"
				  ."<div align=\"center\"><img src=\"$absimageurl/images/image_fax.gif\" alt=\"Fax\" width=\"30\" height=\"25\"></div></td>"
				."<td width=\"131\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Fax: (02) 9589 3749</font></td>"
				."<td width=\"20\" valign=\"middle\">"
				  ."<div align=\"center\"><img src=\"$absimageurl/images/image_email.gif\" alt=\"Email\" width=\"25\" height=\"20\"></div></td>"
				."<td width=\"176\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Email: <a href=\"mailto:info@identikid.com.au\" class=\"type2\">info@identikid.com.au</a></font>"
				  ."</td>"
			  ."</tr>"
			."</table>"
          ."</td>"
        ."</tr>"
      ."</table>";
	  return $html;
}


?>