<?
$useractions = "loaded";
if(isset($includeabove) && $includeabove==true){
	include_once("../common_db.php");
	require_once "../constants.php";
	include_once("../htmlMimeMail.php");
}else{
	include_once("common_db.php");
	require_once "constants.php";
	include_once("htmlMimeMail.php");
}
//$absimageurl = "http://www.sitepond.com/~identiki";
$absimageurl = "http://www.identikid.com.au";




	$currencies = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "Australian Dollars (New Zealand Residents)", "currency" => "AU\$", "code" => "AUD"),
	);




function updateVoucher($custid){


	$string = "select voucher, voucher_amount from customers where id='{$custid}'";
	$result = mysql_query($string) or error_message(mysql_error());

	if(mysql_num_rows($result)==1){
		list($vouchercode, $voucher_usage)=mysql_fetch_row($result);
		$string = "select id, balance from voucher where number='" .str_replace(",", "", $vouchercode). "'";
		$result = mysql_query($string) or error_message(mysql_error());
	
		if(mysql_num_rows($result)==1){
			$row=mysql_fetch_array($result);
			$balance = $row['balance'] - $voucher_usage;
	
			$string = "update voucher set balance='{$balance}' where id='{$row['id']}'";
			$result = mysql_query($string) or error_message(mysql_error());
		}
		else {
			error_message("Invalid Voucher Code");
		}
	}
	else {
		error_message("Invalid Customer ID");
	}
	$_SESSION['voucherupdated'] = true;
}


function convertCurrency($value, $conversion){
/*
  Valid Currencies
  AUD
  EUR
  USD
*/

  $string = "select * from currency_table";
  $result = mysql_query($string) or error_message(mysql_error());

  if(mysql_num_rows($result)==1)
  {
    $row = mysql_fetch_array($result);
		if(isset($row[$conversion])){
			$value = $value * $row[$conversion];
			return $value;
		}
		else {
			error_message("Invalid Currency Conversion");
		}
  }
	else {
		error_message("Error retrieving currencies");
	}
}


function getVoucherDetails($total_price, $vouchercode, $justReturnCurrency=false, $orderCurrency=false)
{

//	print "vc: {$vouchercode}<Br />";
	global $currencies;
	/*
		baby style vouchers can only be used to purchase a New Baby Pack
		
		error if it is trying to be used.		
	*/


	$voucher_valid = 0;
	$voucher_total = $voucher_balance = $voucher_usage = "";
	$result_price = $total_price;
	$usevoucher = false;
	if(!empty($vouchercode) && strlen($vouchercode)==15)
	{

		$string = "select id, unix_timestamp(expiry_date) as expiry, balance, style, currency from voucher where number='".str_replace(",", "", $vouchercode)."'";
		$result = mysql_query($string) or error_message(sql_error());

		if(mysql_num_rows($result)==1)
		{

			$row = mysql_fetch_array($result);

			if($justReturnCurrency){
				return $row['currency'];
			}
			elseif($row['expiry'] < time())
			{
				$voucher_error = "Voucher has Expired";
			}
			elseif($row['style']=="baby" && !$_SESSION['baby_pack_in_order'])
			{

				$voucher_error = "The Voucher Number you have tried to use can only be used to purhase a New Baby Pack";
			}
			elseif($row['balance']<=0)
			{
				$voucher_error = "Voucher has no credit left.";
			}
			else {
				$voucher_valid = 1;

				if($orderCurrency)
				{
					$voucher_total = convertCurrency($row['balance'], $currencies[$row['currency']]['code']."to".$currencies[$orderCurrency]['code']);
				}
				else {
					$voucher_total = $row['balance'];
				}
//print "<BR>VT:{$voucher_total}<BR>TP:{$total_price}";
	
//				$voucher_total = $row['balance'];
				if($voucher_total >$total_price)
				{
					$voucher_balance = $voucher_total  - $total_price;
					$voucher_usage = $total_price;
					$result_price = 0;
//print "<BR>RP:{$result_price}";
				}
				else {
					$result_price = $total_price - $voucher_total ;
					$voucher_usage = $voucher_total ;
					$voucher_balance = 0;
				}
				$usevoucher = true;

			}
		
		}
		else {
			if($justReturnCurrency){
				return "";
			}
			else {
				$voucher_error = "Invalid Voucher Number";
			}
		}

	}
	return array($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $result_price, $voucher_error, $row['currency']);
}


function getIdentitagDesc($num){
	if($num=="A"){
		return "A - Sun";
	}else if($num=="C"){
		return "C - Frangipani";
	}else if($num=="H"){
		return "H - Butterfly";
	}else if($num=="M"){
		return "M - Dinosour";
	}else if($num=="N"){
		return "N - Fairy";
	}else if($num=="Q"){
		return "Q - Mermaid";
	}else if($num=="R"){
		return "R - Truck";
	}else if($num=="S"){
		return "S - Shark";
	}else if($num=="T"){
		return "T - Train";
	}else if($num=="U"){
		return "U - Ballerina";
	}else if($num=="V"){
		return "V - Motorbike";
	}else if($num=="W"){
		return "W - Horse";
	}else if($num=="X"){
		return "X - Skull";
	}else if($num=="Y"){
		return "Y - Surfer";
	}else if($num=="C1"){
		return "C1 - Frog";
	}else if($num=="D1"){
		return "D1 - Surfer Girl";
	}else if($num=="Z"){
		return "Z - Pirate";
	}else if($num=="P"){
		return "P - Plane";
	}else if($num=="E"){
		return "E - Love Heart";
	}else{
		return $num;
	}
	
}

function getCustomerDetails($id){
	global $oseas,$firstname,$surname,$address,$suburb,$postcode,$state,$country,$emailadd,$homephone,$workphone,$mobilephone,$postageoption;
	global $referral,$referralcode,$paymentmeth,$payment,$nameoncard,$cc1,$cc2,$cc3,$cc4,$expirymonth,$expiryyear,$seccode,$hear_about,$specialreqs;
	
	$query = "SELECT *,b.oseas FROM orders a, customers b WHERE a.customer=b.id AND a.id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	while($qdata = mysql_fetch_array($result)){
		$oseas = $qdata["oseas"];
		$firstname = $qdata["firstname"];
		$surname = $qdata["surname"];
		$address = $qdata["address"];
		$suburb = $qdata["suburb"];
		$postcode = $qdata["postcode"];
		$state = $qdata["state"];
		$country = $qdata["country"];
		$emailadd = $qdata["emailadd"];
		$homephone = $qdata["homephone"];
		$workphone = $qdata["workphone"];
		$mobilephone = $qdata["mobilephone"];
		$referral = $qdata["referral"];
		$referralcode = $qdata["referralcode"];
		$paymentmeth = $qdata["paymentmeth"];
		$payment = $qdata["payment"];
		$nameoncard = $qdata["nameoncard"];
		$postageoption = $qdata["postage_option"];
		$ccxx = $qdata["ccxx"];
		$cc1 = substr($ccxx,0,4);
		$cc2 = substr($ccxx,5,4);
		$cc3 = substr($ccxx,10,4);
		$cc4 = substr($ccxx,15,4);
		$expdate = $qdata["expdate"];
		$expirymonth = substr($expdate,0,2);
		$expiryyear = substr($expdate,3,2);
		$seccode = $qdata["seccode"];
		$hear_about = $qdata["hear_about"];
		$specialreqs = $qdata["specialreqs"];
	}
	
	if($oseas==1){
		$postage = 10;
	}else{
		$postage = 0;
	}
}

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

function getZipTagNumber($code)
{
	$sql = "SELECT data_ziptag_number FROM data_ziptag WHERE data_ziptag_code='".$code."' ";
	//echo $sql;
	db_get_field($sql , $ziptag_number);
	return $ziptag_number;
}

function getZipTagCode($number)
{
	$sql = "SELECT data_ziptag_code FROM data_ziptag WHERE data_ziptag_number=".(int)$number;
	//echo $sql;
	db_get_field($sql , $ziptag_code);
	return $ziptag_code;
}

function get_background_colour($num)
{
	db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . (int)$num, $colour_name);
	return $colour_name;
}

function get_font_colour($num)
{
	db_get_field("SELECT data_font_colour_name FROM data_font_colour WHERE data_font_colour_id=" . (int)$num, $font_colour_name);
	return $font_colour_name;
}

function getBandPicType($code){
	/*
	switch($type){
		case "U": $name = "Pink Ballerina"; break;
		case "Y": $name = "Surfer Guy"; break;
		case "R": $name = "Truck"; break;
		case "A1": $name = "Cow"; break;
		case "D1": $name = "Surfer Girl"; break;
		case "Q": $name = "Mermaid"; break;
		case "F1": $name = "Rocket"; break;
		case "N": $name = "Fairy"; break;
		case "H": $name = "Butterfly"; break;
		case "Z": $name = "Pirate"; break;
		case "G1": $name = "Bear"; break;
		case "F": $name = "Nurse (Medical)"; break;
	}*/
	$sql = "SELECT data_identiband_name FROM data_identiband WHERE data_identiband_code='".$code."' ";
	//echo $sql;
	db_get_field($sql , $identiband_name);
	return $identiband_name;
}

function getLabelType($num)
{
	db_get_field("SELECT productName FROM product WHERE id=" . (int)$num, $product_name);
	return $product_name;
}

function getPicTypeZT($num){
	if($num==1){
		return "Sun";
	}else if($num==2){
		return "Boy";
	}else if($num==3){
		return "Frangipani";
	}else if($num==4){
		return "Mouse";
	}else if($num==5){
		return "Heart";
	}else if($num==6){
		return "Girl";
	}else if($num==7){
		return "Flower";
	}else if($num==8){
		return "Butterfly";
	}else if($num==9){
		return "UFO";
	}else if($num==10){
		return "Car";
	}else if($num==11){
		return "Alien";
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
		return "Ballerina Pink";
	}else if($num==21){
		return "Motorbike";
	}else if($num==22){
		return "Horse";
	}else if($num==23){
		return "Skull";
	}else if($num==24){
		return "Surfer Boy";
	}else if($num==25){
		return "Pirate";
	}else if($num==26){
		return "Cow";
	}else if($num==27){
		return "Frog";
	}else if($num==28){
		return "Surfer Girl";
	}else if($num==29){
		return "Bee";
	}else if($num==30){
		return "Rocket";
	}else if($num==31){
		return "Teddy Bear";
	}else if($num==31){
		return "Pig";
	}else if($num==32){
		return "Cat";
	}else if($num==33){
		return "Spider";
	}else if($num==34){
		return "Ballerina Purple";
	}else{
		return $num;
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
	}else if($num==21){
		return "Motorbike";
	}else if($num==22){
		return "Horse";
	}else if($num==23){
		return "Skull";
	}else if($num==24){
		return "Surfer";
	}else if($num==25){
		return "Pirate";
	}else if($num==26){
		return "Cow";
	}else if($num==27){
		return "Chicken";
	}else if($num==28){
		return "Frangipani";
	}else if($num==29){
		return "Frog";
	}else if($num==30){
		return "Surfer Girl";
	}else if($num==31){
		return "Bee";
	}else if($num==31){
		return "Bee";
	}else if($num==32){
		return "Spider";
	}else if($num==33){
		return "Teddy Bear";
	}else if($num==34){
		return "Pig";
	}else if($num==35){
		return "Cat";
	}else if($num==36){
		return "Rocket";	}else{
		return $num;
	}
}

function getAllergyPicType($num)
{
	switch($num)
	{
		case 1:	
			return "dairy free";
			break;
		case 2:
			return "egg free";
			break;
		case 3:
			return "sugar free";
			break;
		case 4:
			return "nut free";
			break;
		case 5:
			return "wheat free";
			break;
		case 6:
			return "seafood free";
			break;
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

function array_keyval($v1,$v2) 
{
	return $v1 . "=>" . $v2 . "\n";
}

function checkOrderId($makenew, $newFromAdmin=false){
	global $fromadmin, $currency;
	linkme();
	$newFromAdmin=($newFromAdmin==1)?true:false;

	if (session_id() == ""){
		session_start(); // if no active session we start a new one
	}
	
	//session_destroy();
	$sessid = session_id();
	
	$query = "SELECT * FROM orders WHERE sessid='".$sessid."'";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());

	// return an error if no session ID exists
	if (strlen(trim($sessid)) == 0){
		$subject = "IK session not found at ".date("d/m/Y H:i:s");
		$body = "IK session_start() failed in checkOrderId(".$makenew.") at ".$_SERVER['PHP_SELF']."\n\n";
		$body .= "SQL\n".$query."\n\n";
		$body .= "_COOKIE\n".debug_capture_print_r($_COOKIE)."\n\n";
		$body .= "_GET\n".debug_capture_print_r($_GET)."\n\n";
		$body .= "_POST\n".debug_capture_print_r($_POST)."\n\n";
		$body .= "_SESSION\n".debug_capture_print_r($_SESSION)."\n\n";
		mail(ADMIN_EMAIL,$subject,$body,"");
		error_message("Session ID not found.");
	}
	
	
	if(mysql_num_rows($result)>0 && !$newFromAdmin){
		while($qdata = mysql_fetch_array($result)){
			$id = $qdata["id"];
		}
		return $id;
	}else if($makenew==true){
		$query = "INSERT INTO customers () VALUES ()";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		if($fromadmin==true){
			$ordertype="Phone/fax";
		}else{
			$ordertype="Web";
		}
		
		if($fromadmin!=true){
			$currency = $_COOKIE["currency"];
		}
		
		
		//$query = "INSERT INTO orders (sessid, started, finished, customer, ordertype, currency) VALUES ('".session_id()."', '".date("Y-m-d H:i:s",time() + 7200)."', '".date("Y-m-d H:i:s",time() + 7200)."', ".mysql_insert_id().", '".$ordertype."', ".$currency.")";
		$query = "INSERT INTO orders (sessid, started, finished, customer, ordertype, currency) VALUES ('".$sessid."', '".date("Y-m-d H:i:s",time() + 36000)."', '".date("Y-m-d H:i:s",time() + 36000)."', ".mysql_insert_id().", '".$ordertype."', ".$currency.")";
		$result2 = mysql_query($query);
		if(!$result2) error_message(sql_error());
		
		return mysql_insert_id();
	}else{
		return false;
	}
}

function setOrderCurrency($curr){
	setcookie("currency", $curr, time()+6400);
}

function deleteOrderId($id){
	$query = "UPDATE orders SET sessid='' WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}

function sendHtmlEmail($text, $html, $from, $to, $title){
	global $includeabove;
	if(!empty($to)){
		if($include){
		}
		$mail = new htmlMimeMail();
		$mail->setHtml($html, $text);
		$mail->setReturnPath($from);
		$mail->setFrom($from);
		$mail->setSubject($title);
		$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		 
		 
	 //$result = $mail->send(array($to), 'smtp');
	 $result = $mail->send(array($to), 'mail');
	
		if (!$result) {
			report_error("error sending email to client\n\n\n" . print_r($mail->errors, true) . "\n\n\n" . $html . "\n\n\n" . $text);
			//echo "There were errors:<br><br>".print_r($mail->errors);
		}
	}
}

function sendTestimonialNotice($username, $emailadd, $testmonial){
	global $_CONSTANTS;
	
	$text = "A testimonial has been submitted\n\n"
	."Name: ".$username."\n"
	."Email: ".$emailadd."\n\n"
	."Testimonial:\n ".$testmonial."\n";
	
//	$to = "info@identikid.com.au";
	$to = $_CONSTANTS['emailAdmin'];
	//$to = "mark@boo-lah.com";
	
	// send the email
		$headers .= "From:identi Kid website user<$from>\n"
		."X-Sender: <$username>\n"
		."X-Mailer: PHP\n"
		."X-Priority: 3\n"
		."Return-Path: <$username>\n"
		."Content-Type: text/plain; charset=iso-8859-1\n";	
		mail($to, "Testimonial submission", $text, $headers);
}

function sendNewOrder($id, $name, $email, $payment, $ccPayment=false){
	global $fromadmin, $_CONSTANTS, $_CURRENCIES, $currencies, $cur;


	// function is being used via the secure area.
	if(!isset($cur)){
		// gets currencies / postage costs.
		$query = "SELECT * FROM currencies WHERE id=".$_SESSION["currency"];
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		$cur = mysql_fetch_assoc($result);
		$currency = $_SESSION['currency'];
	}
	else {
		$currency = $_COOKIE['currency'];
	}
	
	
	/*
		4/11/2005 removed by request of anne.
	*/
	if(false)
	{
		if($fromadmin!=true){
			$text = "A order has been submitted\n\n"
			."Name: ".$name."\n"
			."Email: ".$email."\n\n"
			."Payment Type:\n ".$payment."\n\n"
			."View the order here:\n http://www.identikid.com.au/admin/viewitem.php?id=".$id."\n";
			
			
			$from = "info@identikind.com.au";
			// send the email
			$headers .= "From:identi Kid website user<$from>\n"
			."X-Sender: <$username>\n"
			."X-Mailer: PHP\n"
			."X-Priority: 1\n"
			."Return-Path: <$username>\n"
			."Content-Type: text/plain; charset=iso-8859-1\n";
			
	//		$to = "info@identikid.com.au";
			$to = $_CONSTANTS['emailAdmin'];
			if($payment == '7' || $payment == 7) $to .= ", anne@identikid.com.au";
			mail($to, "New order", $text, $headers);
		}
	}
	
	// get order info
	linkme();
	
	$query = "SELECT customer FROM orders WHERE id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$custid = $qdata["customer"];
	}
	
	$query = "SELECT emailadd, voucher, postage, postage_option FROM customers WHERE id=".$custid;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	while($qdata = mysql_fetch_array($result)){
		$custemail = $qdata["emailadd"];
		$vouchercode = $qdata["voucher"];
		$postageamount = $qdata["postage"];
		$postageoption = $qdata["postage_option"];
	}
	
	$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());



	// update voucher
	
	// create content
	$text = "";
	
	$content .= "<tr>"
				."<td class=\"maintext\"><br>"
					."<font face=\"Comic Sans MS\" size=\"2\"><strong>Thanks for your order!</strong><br><br>"
					."Your invoice number is: ".(1000+$id)."<br><br>"
					."Your order:<br>";
	$text = "Thanks for your order!\n\nYour invoice number is: ".(1000+$id)."\n\nYour order:\n";
	$total_order_charge = 0;
	$_SESSION['baby_pack_in_order'] = false;
	while($qdata = mysql_fetch_array($result)){
		$content.= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."<br>";
		$text .= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."\n";
		$total_order_charge += $qdata["price"];

		if($qdata['type']==16){
			$_SESSION['baby_pack_in_order'] = true;
		}

	}
	if($currency!=1 && $currency!=5)
	{
		$total_order_charge += $cur['postage'];
	}
	else
	{
		$total_order_charge += $postageamount;
	}

	$query = "SELECT symbol FROM currencies LEFT JOIN orders ON currencies.id = orders.currency WHERE orders.customer = " . $custid . " LIMIT 1";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$currency_symbol = "";
	$currency_symbol = mysql_fetch_assoc($result);

	$total_before_voucher = $total_order_charge;
	list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $total_order_charge, $voucher_errors, $voucher_currency) = getVoucherDetails($total_order_charge, $vouchercode, false, $currency);	

	$content .= "<br />
		<table cellpadding=2 cellspacing=2 border=0 width=100% style=\"	font-family: Comic Sans MS; font-size: 14px;\">";

	if($currency!=1 && $currency!=5)
	{
		$content .= "
				<tr>
					<td valign=top nowrap width=5% class=maintext>Postage</td>
					<td width=5%>&nbsp;</td>
					<td class=maintext>".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."</td>
				</tr>";
//		$content .= "<br />Postage: ".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."<br />";
		$text .= "\nPostage: ".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."\n";
	}
	else
	{
		$content .= "
				<tr>
					<td valign=top nowrap width=5% class=maintext>Postage</td>
					<td width=5%>&nbsp;</td>
					<td class=maintext>".$currency_symbol["symbol"].sprintf("%01.2f", $postageamount)."</td>
				</tr>
				<tr>
					<td valign=top colspan='3' class=maintext>Postage method: ".$postageoption." </td>
				</tr>";
				
//		$content .= "<br />Postage: ".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."<br />";
		$text .= "\nPostage: ".$currency_symbol["symbol"].sprintf("%01.2f", $postageamount)."\n";	
		$text .="Postage method: ".$postageoption."\n";
	}
	
	
	if($usevoucher){

		$content .="
				<tr>
					<td valign=top nowrap width=5%>Sub Total</td>
					<td width=5%>&nbsp;</td>
					<td>" . $currency_symbol["symbol"] . sprintf("%01.2f", $total_before_voucher)."</td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Voucher Code</td>
					<td width=5%>&nbsp;</td>
					<td>" .str_replace(",", "-", $vouchercode). "</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Voucher Debit</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $voucher_usage)."</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Voucher Balance</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $voucher_balance)."</td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td valign=top nowrap width=5%>Order Total</td>
					<td width=5%>&nbsp;</td>
					<td>" .$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge). "</td>
				</tr>
			</table>";

/*
		$content .="<br>Sub Total: " . $currency_symbol["symbol"] . sprintf("%01.2f", $total_before_voucher)."<br>
				<br>
				Voucher Code: " .str_replace(",", "-", $_POST['vouchercode'])."<br />
				Voucher Debit: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_usage)."<br />
				Voucher Balance: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_balance)."<br>
				<br />
				Order Total: ".$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge);

*/

		$text  .="\nSub Total: " . $currency_symbol["symbol"] . sprintf("%01.2f", $total_before_voucher)."\n\n";
		$text  .= "Voucher Code: " .str_replace(",", "-", $_POST['vouchercode'])."\n";
		$text  .= "Voucher Debit: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_usage)."\nVoucher Balance: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_balance);
		$text  .= "\n\nOrder Total: ".$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge);

		if($total_order_charge<=0)
		{
			$content .= "<br><br><strong>Please Note:</strong> There is no charge for this order as it was paid in full with your voucher";
			$text    .= "\n\nPLEASE NOTE: There is no charge for this order as it was paid in full with your voucher";
		}
	}
	else {
		$content.="				<tr>
					<td valign=top nowrap width=5%><b>Order Total</b></td>
					<td width=5%>&nbsp;</td>
					<td><b>" .$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge). "</b></td>
				</tr>
			</table>";
//		$content.="<br>Order Total: " . $currency_symbol["symbol"] . $total_order_charge;
		$text .= "\nOrder Total: " . $currency_symbol["symbol"] . $total_order_charge;
	}

	if($ccPayment){
		$content .= "<br />Your Credit Card has been charged ".$_CURRENCIES[1]['currency'].sprintf("%01.2f", $_SESSION['paymentAmount']);
		$text .= "\nYour Credit Card has been charged ".$_CURRENCIES[1]['currency'].sprintf("%01.2f", $_SESSION['paymentAmount']);

		if($currency!=1 && $currency!=5)
		{
			$content .= "<br />
				<br />
				Please see our <A href=\"{$_CONSTANTS['weburl']}order_online.php\" target=\"_blank\">Ordering Online</a> page to see why you have been charged in AU\$.";
			$text .= "\nPlease see our Ordering Online <{$_CONSTANTS['weburl']}order_online.php}> page to see why you have been charged in AU\$.";
		}
	}		

	$content .="<br><br>Normal postage option orders will be dispatched within 5 working days from date of payment received. Business days Monday-Friday
				<br><br>Express orders dispatched within 48 business hours 9-5 Mon-Fri from NSW by Startrack 
				<br>express service (1-2 days) from date of payment received. Allow 3-4 days for delivery
				<br><br><b>Cheques/money orders post to identikid</b><br>PO Box 8775<br> 
				Wagga Wagga NSW 2650<br> 
				and in the name of identiBiz Pty Ltd
				<br><br><b>Credit Cards - phone your details through next business day</b>
				<br><br><b>Direct Bank Account Payments (EFT Payments)</b><br><b>Bank:</b> Westpac<br><b>Account Name:</b> identiBiz Pty Ltd<br><b>BSB:</b> 032-769
				<br><b>Acc. Number:</b> 277865 <br><b>Reference:</b>".(1000+$id)."  
				<br><br>* You MUST put your reference number in the description field (and your name too if there's room).
				<br>Without this reference number, we can't match your payment to your order, and this can cause delays in your order being sent out";
				
	$text .= "\n\nNormal postage option orders will be dispatched within 5 working days from date of payment received. Business days M-F
				\n\nExpress orders dispatched within 48 business hours 9-5 Mon-Fri from NSW by Startrack\n
				express service (1-2 days) from date of payment received. Allow 3-4 days for delivery
				\n\nCheques/money orders post to identikid\n
				PO Box 8775\n
				Wagga Wagga NSW 2650\n
				and in the name of identiBiz Pty Ltd\n
				\n\nCredit Cards - phone your details through next business day
				\n\nDirect Bank Account Payments (EFT Payments)\nBank: Westpac\nAccount Name: identiBiz Pty Ltd\nBSB: 032-769
				\nAcc. Number: 277865 \nReference:".(1000+$id)."  
				\n\n* You MUST put your reference number in the description field (and your name too if there's room).
				\nWithout this reference number, we can't match your payment to your order, and this can cause delays in your order being sent out";


	$content.="<br><br>Thank you,<br><br>identiKid";
	$text .= "\n\nThank you,\n\nidentiKid";
	$content.="</font></td>"
			."</tr>";
	
	$html = makeHtmlContent($content);
	
	$from=$_CONSTANTS['emailAdmin'];
	$title = " Your order confirmation: invoice #".(1000+$id);
	$to = $custemail;


	// send the email to the customer and to confirmations for audit purposes
	sendHtmlEmail($text, $html, $from, $to, $title);
	sendHtmlEmail($text, $html, $from, ORDER_CONFIRMATION_EMAIL, $title);

	//echo $html."<br>".$text;

	// update voucher.

	if($usevoucher){
		updateVoucher($custid);
	}

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
	
	$from= $_CONSTANTS['emailAdmin'];
	$title = "A message from ".$username;
	
	// send the email
	sendHtmlEmail($text, $html, $from, $to, $title);
	
}

// if user selects express post, notify admin
function sendExpresspost($id, $name, $email) {
			$text = "An express post order has been submitted!\n\n"
			."Name: ".$name."\n"
			."Email: ".$email."\n\n"
			."View the order here:\n http://www.identikid.com.au/admin/viewitem.php?id=".$id."\n";
			
			
			$from = $_CONSTANTS['emailAdmin'];
			$sender = $_CONSTANTS['emailAdmin'];
			// send the email
			$headers .= "From:identi Kid website user<$from>\n"
			."X-Sender: <$sender>\n"
			."X-Mailer: PHP\n"
			."X-Priority: 1\n"
			."Return-Path: <$sender>\n"
			."Content-Type: text/plain; charset=iso-8859-1\n";
			
	//		$to = "info@identikid.com.au"; 
			$to = $_CONSTANTS['emailAdmin'];
			mail($to, "Express order made", $text, $headers);
			mail(ORDER_CONFIRMATION_EMAIL, "Express order made", $text, $headers);
}


function makeHtmlContent($content, $newAbsImageUrl=""){
	global $absimageurl;
	if(!empty($newAbsImageUrl))
		$absimageurl = $newAbsImageUrl;

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
				."<td width=\"131\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Fax: (08) 9286 2124</font></td>"
				."<td width=\"20\" valign=\"middle\">"
				  ."<div align=\"center\"><img src=\"$absimageurl/images/image_email.gif\" alt=\"Email\" width=\"25\" height=\"20\"></div></td>"
				."<td width=\"176\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Email: <a href=\"mailto:leanne@identikid.com.au\" class=\"type2\">leanne@identikid.com.au</a></font>"
				  ."</td>"
			  ."</tr>"
			."</table>"
          ."</td>"
        ."</tr>"
      ."</table>";
	  return $html;
}

function returnErrorCode($RC){
	global $_EPAY;
	$codes = array();
	$handle = fopen($_EPAY['ERROR_CODES'], "r");
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$codes[sprintf("%02d", $data[0])] = $data[1];
	}
	fclose($handle);
	return $codes[$RC];
}


?>
