<?php
date_default_timezone_set('Australia/NSW');
error_reporting(E_ERROR | E_PARSE);

$useractions = "loaded";
//if(isset($includeabove) && $includeabove==true){
	include_once("_common/_connection.php");
	require_once("_common/_database.php");
	require_once("_common/_constants.php");
	include_once("email/htmlMimeMail.php");
	linkme();
/* }else{
	include_once("common_db.php");
	require_once "constants.php";
	include_once("htmlMimeMail.php");
} */
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

function convertCurrencyNew($value, $id){

  $string = "select rate from currencies WHERE id =".$id;
  $result = mysql_query($string) or error_message(mysql_error());
  
  if(mysql_num_rows($result)==1)
  {
    $row = mysql_fetch_array($result);
    $value = $value / $row['rate'];
    return $value;
    
  }
  else {
		error_message("Error retrieving currencies");
  }

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

		$string = "select id, unix_timestamp(expiry_date) as expiry, balance, style, currency, active from voucher where number='".str_replace(",", "", $vouchercode)."'";
		$result = mysql_query($string) or error_message(sql_error());

		if(mysql_num_rows($result)==1)
		{

			$row = mysql_fetch_array($result);

			if($justReturnCurrency){
				return $row['currency'];
			}
			elseif($row['active']!='1')
			{
				$voucher_error = "Voucher has not been activated.";
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

function getIdentibandDesc($num){

   $sql="SELECT data_identiband_name, data_identiband_code FROM data_identiband WHERE data_identiband_id='$num' OR data_identiband_code='$num' LIMIT 1";
   $result = mysql_query($sql);
   if(mysql_num_rows($result)==1) {
     list($name, $tag) = mysql_fetch_array($result);
     $rtnStr = $tag." - ".$name;
     return $rtnStr;
   } else {
     return false;
   }

}

function getZiptagDesc($num){

   $sql="SELECT data_ziptag_name, data_ziptag_code FROM data_ziptag WHERE data_ziptag_number='$num' OR data_ziptag_code='$num' LIMIT 1";
   $result = mysql_query($sql);
   if(mysql_num_rows($result)==1) {
     list($name, $tag) = mysql_fetch_array($result);
     $rtnStr = $tag." - ".$name;
     return $rtnStr;
   } else {
     return false;
   }

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
	global $oseas,$firstname,$surname,$address,$suburb,$postcode,$state,$country,$address_cust,$suburb_cust,$postcode_cust,$state_cust,$country_cust,$emailadd,$homephone,$workphone,$mobilephone,$postageoption;
	global $referral,$referralcode,$paymentmeth,$payment,$nameoncard,$cc1,$cc2,$cc3,$cc4,$expirymonth,$expiryyear,$seccode,$hear_about,$specialreqs,$del_name;
	
	$query = "SELECT *,b.oseas FROM orders a, customers b WHERE a.customer=b.id AND a.id=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	while($qdata = mysql_fetch_array($result)){
		$oseas = $qdata["oseas"];
		$firstname = stripslashes($qdata["firstname"]);
		$surname = stripslashes($qdata["surname"]);
		$address = stripslashes($qdata["address"]);
		$suburb = stripslashes($qdata["suburb"]);
		$postcode = $qdata["postcode"];
		$state = $qdata["state"];
		$country = $qdata["country"];
		$del_name = $qdata["del_name"];
				
		$address_cust = stripslashes($qdata["address_cust"]);
		$suburb_cust = stripslashes($qdata["suburb_cust"]);
		$postcode_cust = $qdata["postcode_cust"];
		$state_cust = $qdata["state_cust"];
		$country_cust = $qdata["country_cust"];
		
		$emailadd = $qdata["emailadd"];
		$homephone = $qdata["homephone"];
		$workphone = $qdata["workphone"];
		$mobilephone = $qdata["mobilephone"];
		$referral = $qdata["referral"];
		$referralcode = $qdata["referralcode"];
		$paymentmeth = $qdata["paymentmeth"];
		$payment = $qdata["payment"];
		$nameoncard = stripslashes($qdata["nameoncard"]);
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
		$specialreqs = stripslashes($qdata["specialreqs"]);
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
	}else if($num==49){
		return "Soccer Ball";
	}else if($num==45){
		return "Football";
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
		return "Rocket";	
   }else if($num==37){
		return "Dairy Free";	
   }else if($num==38){
		return "Egg Free";	
   }else if($num==39){
		return "Sugar Free";	
   }else if($num==40){
		return "Nut Free";	
   }else if($num==41){
		return "Wheat Free";	
   }else if($num==42){
		return "Seafood Free";	
   }else if($num==43){
		return "Nurse";	
   }else if($num==44){
		return "Cross";	
   }else if($num==45){
		return "Football";	
   }else if($num==46){
		return "Guitar";	
   }else if($num==47){
		return "Boat";	
   }else if($num==48){
		return "Saxaphone";	
   }else if($num==49){
		return "Soccerball";	
   }else if($num==50){
		return "Drum";	
   }else if($num==51){
		return "Ladybug";	
   }else{
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
	$result = mysql_query($query)or die(mysql_error());
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
		$query = "INSERT INTO orders (sessid, started, finished, customer, ordertype, currency) VALUES ('".$sessid."', '".date("Y-m-d H:i:s",time() + 36000 + 21600)."', '".date("Y-m-d H:i:s,time() + 36000 + 21600")."', ".mysql_insert_id().", '".$ordertype."', '".$currency."')";
		//echo $query;
                $result2 = mysql_query($query)or die(mysql_error());
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

function sendHtmlEmail($text, $html, $from, $to, $title, $attach=false){
	global $includeabove;
	if(!empty($to)){
		if($include){
		}
		$mail = new htmlMimeMail();
		//$mail->setHeader('MIME-Version', '1.0');
		$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		$mail->setHtml($html, $text);
		$mail->setReturnPath($from);
		$mail->setFrom($from);
		$mail->setSubject($title);
		$attachments = split(',', $attach);
		if($attach!=null){
	     foreach($attachments as $attachment) {
	       $mail->addAttachment(file_get_contents($attachment),basename($attachment));
	     }
	   }

	 //$result = $mail->send(array($to), 'smtp');
	 $result = $mail->send(array($to), 'mail');
	
		if (!$result) {
			report_error("error sending email to client\n\n\n");
                        mail('web.developer.sanil@gmail.com', 'Confirmation email could not be sent', $html);
			//report_error("error sending email to client\n\n\n" . print_r($mail->errors, true) . "\n\n\n" . $html . "\n\n\n" . $text);
			//echo "There were errors:<br><br>".print_r($mail->errors);
		}
	}
}

function sendLoyalty($username, $emailadd, $altemailadd, $address, $phonenumber, $mobilenumber){
	global $_CONSTANTS;
	
	$sql="SELECT id FROM loyalty_program WHERE email = '{$emailadd}' LIMIT 1";
	$result = mysql_query($sql);
   if(mysql_num_rows($result) == 1){
     list($id) = mysql_fetch_array($result);
     $sql="UPDATE loyalty_program SET name = '{$username}', email = '{$emailadd}' , alt_email = '{$altemailadd}', 
       address = '{$address}', mobile = '{$mobilenumber}', phone = '{$phonenumber}' WHERE id = '{$id}' ";   
   } else {
     $sql = "INSERT INTO loyalty_program (id, name, email, alt_email, address, mobile, phone) 
       VALUES (null, '{$username}', '{$emailadd}', '{$altemailadd}', '{$address}', '{$mobilenumber}', '{$phonenumber}' ) ";  
   }
   
   mysql_query($sql);
	
	$text = "A loyalty program request has been submitted\n\n"
	."Name: ".$username."\n"
	."Email: ".$emailadd."\n"
	."Alt Email: ".$altemailadd."\n"
	."Address: ".$address."\n"
	."Phone Number: ".$phonenumber."\n"
	."Mobile Number: ".$mobilenumber."\n";
	
//	$to = "info@identikid.com.au";
	$to = $_CONSTANTS['emailAdmin'];
	//$to = "mark@boo-lah.com";
	
	// send the email
		$headers = "From:identi Kid website user\n"
		."X-Sender: <$username>\n"
		."X-Mailer: PHP\n"
		."X-Priority: 3\n"
		."Return-Path: <$username>\n"
		."Content-Type: text/plain; charset=iso-8859-1\n";	
		mail($to, "Loyalty Program Request", $text, $headers);
}

function sendAgents($country,$city,$suburb,$post_code,$username,$postadd,$telephone,$emailadd,$broadband,$scan_docs,$info){
	global $_CONSTANTS;
	
	$boardband_sql = $broadband=='Yes'?'1':'0';
	$scanning_sql = $scan_docs=='Yes'?'1':'0';
	
	$sql="SELECT id FROM agents_info WHERE email = '{$emailadd}' LIMIT 1";
	$result = mysql_query($sql);
   if(mysql_num_rows($result) == 1){
     list($id) = mysql_fetch_array($result);
     $sql="UPDATE agents_info SET country = '{$country}', city = '{$city}' , suburb = '{$suburb}', 
       post_code = '{$post_code}', postal_address = '{$postadd}', name = '{$username}',
       email = '{$emailadd}', phone = '{$telephone}', broadband = '{$boardband_sql}', scanning = '{$scanning_sql}',
       info = '{$info}'
       WHERE id = '{$id}' ";   
   } else {
     $sql= "INSERT INTO agents_info (id, country, city, suburb, post_code, postal_address, name, email, phone, broadband,
       scanning, info) VALUES ( null, '{$country}', '{$city}' ,'{$suburb}','{$post_code}','{$postadd}','{$username}','{$emailadd}',
       '{$telephone}','{$boardband_sql}','{$scanning_sql}','{$info}')";  
   }
   
   mysql_query($sql);
	
	$text = "An agents request has been submitted\n\n"
	."Country: ".$country."\n"
	."City: ".$city."\n"
	."Suburb: ".$suburb."\n"
	."Post Code: ".$post_code."\n"
	."Postal Address: ".$postadd."\n"
	."Name: ".$username."\n"
	."Email: ".$emailadd."\n"
	."Phone Number: ".$telephone."\n"
	."Broadband?: ".$broadband."\n"
	."Scan Documents?: ".$scan_docs."\n"
	."Information: ".$info."\n";
	
   //$to = "info@identikid.com.au";
	$to = $_CONSTANTS['emailAdmin'];
	//$to = "mark@boo-lah.com";
	
	// send the email
		$headers .= "From:identi Kid website user<$from>\n"
		."X-Sender: <$username>\n"
		."X-Mailer: PHP\n"
		."X-Priority: 3\n"
		."Return-Path: <$username>\n"
		."Content-Type: text/plain; charset=iso-8859-1\n";	
		mail($to, "Agents Request", $text, $headers);
}

function sendTestimonialNotice($username, $emailadd, $post_code, $country, $date, $testmonial){
	global $_CONSTANTS;
	
	$text = "A testimonial has been submitted\n\n"
	."Name: ".$username."\n"
	."Email: ".$emailadd."\n"
	."Post Code: ".$post_code."\n"
	."Country: ".$country."\n"
	."Date: ".$date."\n\n"
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
		mail($to, "Testimonial submission", stripslashes($text), $headers);
}


/*
//-------------Old SendNewOrder ---------------------------
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
	
	
	//4/11/2005 removed by request of anne.

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
	
	   if($qdata['type']==44){
	      $sql_Voucher = "INSERT INTO voucher (id) VALUES (null) ";
	      $result_Voucher = mysql_query($sql_Voucher);
	      $voucher_id = mysql_insert_id();
	      $voucher_number = '';
	      $random_required = 12-strlen($voucher_id);
	      for($i=0;$i<$random_required;$i++) {
	        $voucher_number.= rand(1,9);
	      }
	      $voucher_number.=$voucher_id;
	      
	      $activate_Voucher = $ccPayment==true?'1':'0';
	      
	      $sql_Voucher = "UPDATE voucher SET number = '$voucher_number', 
	      purchase_date = NOW(), expiry_date = '2025-01-01 00:00:00',
	      style = 'online', value = '".$qdata['price']."',balance = '".$qdata['price']."',
	      customer_id = '$custid', recipient_id = '".$qdata['id']."', currency = '$currency',
	      online_id='".$qdata['typedetail']."', active = '$activate_Voucher' WHERE id = '$voucher_id' LIMIT 1";
	      $result_Voucher = mysql_query($sql_Voucher);
	      
	      $content.= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."<br>";
	      $correct_cust_id = $custid + 1000;
	      $content.= "<a href='".$_CONSTANTS['weburl']."/giftvoucher_print.php?inv=".$correct_cust_id."&v_num=".$voucher_number."'>Click Here</a> to print your Instant Voucher<br><br>";
	      
		   $text .= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."\n";
		   $text .= "Goto this here  {$_CONSTANTS['weburl']}/giftvoucher_print.php?inv=".$correct_cust_id."&v_num=$voucher_number  to print your Instant Voucher\n\n";
		   
	      
		} else {
	
		  $content.= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."<br>";
		  $text .= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."\n";
		  
		}
	
		//$content.= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."<br>";
		//$text .= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."\n";
		
		
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

*/
/*
//-----------------------------Keep Commented--------
		$content .="<br>Sub Total: " . $currency_symbol["symbol"] . sprintf("%01.2f", $total_before_voucher)."<br>
				<br>
				Voucher Code: " .str_replace(",", "-", $_POST['vouchercode'])."<br />
				Voucher Debit: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_usage)."<br />
				Voucher Balance: ".$currency_symbol["symbol"].sprintf("%01.2f", $voucher_balance)."<br>
				<br />
				Order Total: ".$currency_symbol["symbol"].sprintf("%01.2f", $total_order_charge);
//-----------------------------Keep Commented--------
*/
/*
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
	
	
   $content .=file_get_contents(SITE_DIR."_user_pages/customer_receipt.php");
   
   $text .= strip_tags($content);
 */  
	/*
	//-----------------------------Keep Commented--------
	 $content .="<br><br>Normal postage option orders will be dispatched within 5 working days from date of payment received. Business days Monday-Friday
				<br><br>Express orders dispatched within 48 business hours 9-5 Mon-Fri from NSW by Startrack 
				<br>express service (1-2 days) from date of payment received. Allow 3-4 days for delivery <br> Overseas orders allow 7-10 business days
				<br><br><b>Cheques/money orders post to identikid</b><br>PO Box 8775<br> 
				Wagga Wagga NSW 2650<br> 
				and in the name of identiBiz Pty Ltd
				<br><br><b>Credit Cards - phone your details through next business day on 1300 133949</b>
				<br><br><b>Direct Bank Account Payments (EFT Payments)</b><br><b>Bank:</b> Westpac<br><b>Account Name:</b> identiBiz Pty Ltd<br><b>BSB:</b> 032-769
				<br><b>Acc. Number:</b> 277865 <br><b>Reference:</b>".(1000+$id)."  
				<br><br>* You MUST put your reference number in the description field (and your name too if there's room).
				<br>Without this reference number, we can't match your payment to your order, and this can cause delays in your order being sent out";
				
	$text .= "\n\nNormal postage option orders will be dispatched within 5 working days from date of payment received. Business days M-F
				\n\nExpress orders dispatched within 48 business hours 9-5 Mon-Fri from NSW by Startrack\n
				express service (1-2 days) from date of payment received. Allow 3-4 days for delivery \n Overseas orders allow 7-10 business days
				\n\nCheques/money orders post to identikid\n
				PO Box 8775\n
				Wagga Wagga NSW 2650\n
				and in the name of identiBiz Pty Ltd\n
				\n\nCredit Cards - phone your details through next business day on 1300 133949
				\n\nDirect Bank Account Payments (EFT Payments)\nBank: Westpac\nAccount Name: identiBiz Pty Ltd\nBSB: 032-769
				\nAcc. Number: 277865 \nReference:".(1000+$id)."  
				\n\n* You MUST put your reference number in the description field (and your name too if there's room).
				\nWithout this reference number, we can't match your payment to your order, and this can cause delays in your order being sent out";


	$content.="<br><br>Thank you,<br><br>identiKid";
	$text .= "\n\nThank you,\n\nidentiKid";
	//-----------------------------Keep Commented--------
	*/
/*	
	$content.="</font></td>"
			."</tr>";
	
	$html = makeHtmlContent($content);
	
	//$from=$_CONSTANTS['emailAdmin'];
	$from=ORDER_CONFIRMATION_EMAIL;
	$title = " Your order confirmation: invoice #".(1000+$id);
	$to = $custemail;


	// send the email to the customer and to confirmations for audit purposes
	sendHtmlEmail($text, $html, $from, $to, $title);
	sendHtmlEmail($text, $html, $from, ADMIN_EMAIL, $title);

	//echo $html."<br>".$text;

	// update voucher.

	if($usevoucher){
		updateVoucher($custid);
	}

}

*/
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
			$text = "An order has been submitted\n\n"
			."Name: ".stripslashes($name)."\n"
			."Email: ".$email."\n\n"
			."Payment Type:\n ".$payment."\n\n"
			."View the order here:\n http://www.identikid.com.au/admin/viewitem.php?id=".$id."\n";
			
			
			$from = "info@identikid.com.au";
			// send the email
			$headers .= "From:identi Kid website user<$from>\n"
			."X-Sender: <$username>\n"
			."X-Mailer: PHP\n"
			."X-Priority: 1\n"
			."Return-Path: <$username>\n"
			."Content-Type: text/plain; charset=iso-8859-1\n";
			
	//		$to = "info@identikid.com.au";
			$to = $_CONSTANTS['emailAdmin'];
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
	
	//$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	$query = "SELECT *, bi.id as basketid, di.data_identitag_name FROM basket_items bi
						LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
						LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id OR di.data_identitag_code=bi.text3)
						LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
						LEFT JOIN product p ON (p.id=bi.text5)
						WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());



	// update voucher
	
	// create content
	$text = "";
	
	$content .= "<table><tr>"
				."<td class=\"maintext\"><br>"
					."<font face=\"Comic Sans MS\" size=\"2\"><strong>Thanks for your order!</strong><br><br>"
					."Your invoice number is: ".(1000+$id)."<br><br>"
					."Your order:<br><br>";
	$text = "Thanks for your order!\n\nYour invoice number is: ".(1000+$id)."\n\nYour order:\n";
	$total_order_charge = 0;
	$_SESSION['baby_pack_in_order'] = false;
	
	//Instant Voucher Variables
	$instant_voucher = false ;
   $inv = '';
   $v_num = '';
   
	while($qdata = mysql_fetch_array($result)){
	
	   if($qdata['type']==44){
	      $sql_Voucher = "INSERT INTO voucher (id) VALUES (null) ";
	      $result_Voucher = mysql_query($sql_Voucher);
	      $voucher_id = mysql_insert_id();
	      $voucher_number = '';
	      
	      for($i=0;$i<(12-strlen($voucher_id));$i++) {
	        $voucher_number.= rand(1,9);
	      }
	      $voucher_number.=$voucher_id;
	      
	      $sql_Voucher = "UPDATE voucher SET number = '$voucher_number', 
	      purchase_date = NOW(), expiry_date = '".gmdate("Y-m-d 00:00:00",time()+(31536000))."',
	      style = 'online', value = '".$qdata['price']."',balance = '".$qdata['price']."',
	      customer_id = '$custid', recipient_id = '".$qdata['id']."', currency = '$currency',
	      online_id='".$qdata['typedetail']."', active = '0', voucher_name = '$name - $id' WHERE id = '$voucher_id' LIMIT 1";
	      $result_Voucher = mysql_query($sql_Voucher);
	      
	      $content.= "<font face=\"Comic Sans MS\" size=\"2\"><b>".getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."</b></font><br>";
	      $correct_cust_id = $custid + 1000;
	      
	      $instant_voucher = true;
	      $inv = $correct_cust_id;
	      $v_num = $voucher_number;
	      
	      $content.= "Your gift voucher is attached to this email as a pdf<br><small>If this file does not work your can download another copy <a href='".SITE_URL."/giftvoucher_print.php?inv=".$correct_cust_id."&v_num=".$voucher_number."'>here</a></small><br><br>";
	      
		   $text .= getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."\n";
		   $text .= "Go here  {$_CONSTANTS['weburl']}/giftvoucher_print.php?inv=".$correct_cust_id."&v_num=$voucher_number  to print your Instant Voucher\n";
		   
	      
		} else {		
		  
		  $content.= "<table width='100%' border='0'><tr><td colspan='2'><font face=\"Comic Sans MS\" size=\"2\"><b>".getLabelType($qdata["type"])." - ".$qdata["quantdesc"]."</b></font></td></tr>";
		  
	      switch($qdata['type']) {
	       //Vinyls
	       case '1':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	       	 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr><br>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr></table>";
	         
	         break;
	         
	         //Semi-Permenant Iron-ons
	         case '2':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">White</font></td></tr>";
		 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font&nbsp;Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">black</font></td></tr></table>";

	         break;
	         
	         //Mini Vinyls
	         case '3':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Line 1</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
                 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Line 2</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$text2 = trim(str_replace('Ph:','',$qdata['text2']));"</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['data_colour_id'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr><br>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr></table>";
	         
	         break;
	         
	         
	         //Shoe Labels 
	         case '4':
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phones</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr><br>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">White</font></td></tr>";
$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">Black</font></td></tr></table>";

	         break;
	         	         
	         //Pencil Labels
	         case '5':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['data_colour_id'])."</font></td></tr>";
	     	   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr><br>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr></table>";
	         
	         break;

		 //Kidscard
	         case '7':
		 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Type:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["colours"]=='1'?'Boys':'Girls')."</font></td></tr></table>";

	         break;

	         //DIY
	         case ($qdata['type'] == '8' || $qdata['type'] == '9'):
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 1</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 2</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 3</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text3']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 4</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text4']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 5</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text5']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getPicType($qdata["pic"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['colours']."</font></td></tr>";
	     	 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font&nbsp;Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">White</font></td></tr></table>";
       
	         break;
	         
	         //Starter Pack
	         case '10':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>IdentiTAG:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["data_identitag_name"]."</font></td></tr>";
			   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Print&nbsp;Reverse:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata['text7']=='1'?"Yes":"No")."</font></td></tr>";
			   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Label&nbsp;Type:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["gift"]=="1"?"30 Mini Labels":"60 Pencil Labels")."</font></td></tr></table>";

	         break;
	         
	         //Birthday Pack
	         case '12':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>IdentiTAG:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["data_identitag_name"]."</font></td></tr>";
			   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Print&nbsp;Reverse:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata['text7']=='1'?"Yes":"No")."</font></td></tr>";
			   $content.="<tr><td align='right' valign='top' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>IronOn&nbsp;Type:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".((int)$qdata['text6'] == 2?"Permanent":"Semi-permanent");
	         if ($qdata['text6'] == 2){
				  @db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id=". ((int)$qdata['text4']), $colour_name);
				  if ((int)$qdata['text5'] != 1) {
					 $content.="<br>Colour: $colour_name<br>Font Colour: White";
				  }
				}
				$content.="</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Gift&nbsp;Card:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata['gift']=="50"?"Girl Card":"Boys Card")."</font></td></tr></table>";

	         break;

		      //Gift Boxes
	         case '13':

	         $content.="<tr><td colspan='2' ><br></td></tr></table>";

		      break;

	         //Identitags
	         case '14':

              if($qdata['text1']!=''){
	             $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 1</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentitagDesc($qdata['text1'])."</font></td></tr>";
	             if($qdata['text5']!='' || $qdata['text6']!=''){
                  $content.="<tr><td align='right' valign='top' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 1 Text</i>: </font></td><td align='left' >
			         <font face=\"Comic Sans MS\" size=\"2\">".($qdata['text5']!=''?$qdata['text5'].'<br>':'').$qdata['text6']."</font></td></tr>";
	             }
		 
	           }
		
              if($qdata['text2']!=''){
	             $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 2</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentitagDesc($qdata['text2'])."</font></td></tr>";
	               if($qdata['text7']!='' || $qdata['text8']!=''){
                    $content.="<tr><td align='right' valign='top' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 2 Text</i>: </font></td><td align='left' >
			           <font face=\"Comic Sans MS\" size=\"2\">".($qdata['text7']!=''?$qdata['text7'].'<br>':'').$qdata['text8']."</font></td></tr>";
	               }
		 
	           }

		        if($qdata['text3']!=''){
	             $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 3</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentitagDesc($qdata['text3'])."</font></td></tr>";
	             if($qdata['text9']!='' || $qdata['text10']!=''){
                  $content.="<tr><td align='right' valign='top' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 3 Text</i>: </font></td><td align='left' >
			         <font face=\"Comic Sans MS\" size=\"2\">".($qdata['text9']!=''?$qdata['text9'].'<br>':'').$qdata['text10']."</font></td></tr>";
	             }
		 
	           }
		
		        if($qdata['text4']!=''){
	             $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 4</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentitagDesc($qdata['text4'])."</font></td></tr>";
	             if($qdata['text11']!='' || $qdata['text12']!=''){
                  $content.="<tr><td align='right' valign='top' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Tag 4 Text</i>: </font></td><td align='left' >
			         <font face=\"Comic Sans MS\" size=\"2\">".($qdata['text11']!=''?$qdata['text11'].'<br>':'').$qdata['text12']."</font></td></tr>";
	             }
		 
	           }


		        $content.="<tr><td colspan=\"2\"><br></td></tr></table>";

	           break;

	         //Mailout gift vouchers
	         case '15':

	         $content.="<tr><td colspan='2' ><br></td></tr></table>";

		 break;
	         
	         //New Baby Pack
	         case '16':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>IdentiTAG:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["data_identitag_name"]."</font></td></tr>";
			   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Print&nbsp;Reverse:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata['text7']=='1'?"Yes":"No")."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Gift&nbsp;Card:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata['text5']=="50"?"Girl Card":"Boys Card")."</font></td></tr></table>";

	         break;
	         
	         //Shared Pack
	         case '17':
	         $types=array();
				$types[1] = 'Vinyl Labels';
				$types[2] = 'Semi-Permanent Iron Ons';
				$types[3] = 'Mini Vinyl Labels';
				$types[19] = 'Permanent Iron Ons';
	         // pack type;
				list($pack1, $pack2) = split(",", $qdata['text5']);
				$pack=split(",", $qdata['text5']);
				// kidsName
				list($pack1_text1, $pack2_text1) = split(",", $qdata['text1']);
				$pack1_text1 = rawurldecode($pack1_text1);
				$pack2_text1 = rawurldecode($pack2_text1);
				$text1=split(",", $qdata['text1']);
				// phone number
				list($pack1_text2, $pack2_text2) = split(",", $qdata['text2']);
				$pack1_text2 = rawurldecode($pack1_text2);
				$pack2_text2 = rawurldecode($pack2_text2);
				$text2=split(",", $qdata['text2']);
				// pictures
				list($pack1_picon, $pack2_picon) = split(",", $qdata['picon']);
				$picon=split(",", $qdata['picon']);
				list($pack1_pic, $pack2_pic) = split(",", $qdata['pic']);
				$pic=split(",", $qdata['pic']);
				//font
				list($pack1_font, $pack2_font) = split(",", $qdata['font']);
				$font=split(",", $qdata['font']);
				// colours
				list($pack1_colours, $pack2_colours) = split(",", $qdata['colours']);
				$colours=split(",", $qdata['colours']);
				//split
				list($pack1_split, $pack2_split) = split(",", $qdata['split']);
				$split=split(",", $qdata['split']);
				//font colours
				list($pack1_font_col, $pack2_font_col) = split(",", $qdata['text10']);
				$font_col=split(",", $qdata['text10']);
				$picon=split(",", $qdata['picon']);
				
				$content.="<tr><td align='left' width='80px' nowrap colspan=\"2\"><font face=\"Comic Sans MS\" size=\"2\"><b>Pack 1</b></font></td></tr>";
				$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Type</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$types[$pack[0]]."</font></td></tr>";
				$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$pack1_text1."</font></td></tr>";
				$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$pack1_text2."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($pack[0]=='2'?'White':get_background_colour($colours[0]))."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($picon[0]=="1"?getPicType($pic[0]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($font[0])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($font_col[0])."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\" ><br></td></tr>";
            $content.="<tr><td align='left' width='80px' nowrap colspan=\"2\" ><font face=\"Comic Sans MS\" size=\"2\"><b>Pack 2</b></font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Type</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$types[$pack[1]]."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$pack2_text1."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$pack2_text2."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($pack[1]=='2'?'White':get_background_colour($colours[1]))."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($picon[1]=="1"?getPicType($pic[1]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($font[1])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($font_col[1])."</font></td></tr></table>";

	         break;
	          
		 //Allergy Alert labels
	         case '18':

		 $desc = substr($qdata["quantdesc"], 0, strpos($qdata["quantdesc"], "Allergy")-1);
		 if($qdata['text5']==1)
		 {
		   $desc .= " Vinyl Labels";
		 }else {
		  $desc .= " Mini Labels";
		 }

	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".urldecode($qdata['text1'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack type:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$desc."</font></td></tr>";
		 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr></table>";
	         
	         break;
   
	         //Permenant Iron-ons
	         case '19':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['data_colour_id'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr></table>";
	         
	         break;
	         
	         //Shoe Dots
	         case '20':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['data_colour_id'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr></table>";
	         
	         break;
	         
	         //Colour My World Pack
	         case '21':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($qdata["data_font_colour_id"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>IdentiTAG:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["data_identitag_name"]."</font></td></tr>";
			   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Print&nbsp;Reverse:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata['text7']=='1'?"Yes":"No")."</font></td></tr>";
			   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>IronOn&nbsp;Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['data_colour_id'])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack&nbsp;Choice:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['productName']."</font></td></tr></table>";
	         
	         break;

		 //Zip Tags
	         case '22':
               case '23': 
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getPicType($qdata["pic"])."</font></td></tr></table>";
	         
	         break;
	         
	         
	         //Address Labels
	         case '25':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 1</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 2</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 3</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text3']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Text 4</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text4']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['colours']."</font></td></tr>";
	     	   $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">1</font></td></tr></table>";
	                
	         break;

	         //Zip-de-do dots
	         case '28':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
                 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".($qdata["picon"]=="1"?getPicType($qdata["pic"]):'none')."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">White</font></td></tr>";
		 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font&nbsp;Coulor:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">Black</font></td></tr></table>";       
	         break;

		 //Identibands
	         case '30':
                 
                 for($i=1;$i<=5;$i++) {
                   if($qdata['text'.$i]) {
                     $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Design {$i}</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getBandPicType($qdata['text'.$i])."</font></td></tr>";
	           }
		 }
	         $content.="<tr><td align='right' colspan='2'><br></td></tr></table>";
	                
	         break;
	         
	         //Book Labels
	         case '33':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".(getPicType($qdata["pic"]))."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".((int)$qdata['colours']==10?"Set B":"Set A")."</font></td></tr></table>";
	                
	         break;

		 //Maxipack
	         case '34':

                 $font_face = 3;
		 $text1 = explode(",",$qdata["text1"]); // name
				$text2 = explode(",",$qdata["text2"]); // phone
				$text3 = explode(",",$qdata["text3"]); // picture
				$text4 = explode(",",$qdata["text4"]); // background colour
				$text5 = explode(",",$qdata["text5"]); // font colour
				$text6 = explode(",",$qdata["text6"]); // split name to two lines
				$text7 = explode(",",$qdata["text7"]); // tags and bands
				$text8 = explode(",",$qdata["text8"]); // perm or semi-perm ironons
				$text9 = explode(",",$qdata["text9"]); // show phone boolean
				$text10 = explode(",",$qdata["text10"]); // show picture boolean
									
			   $labelIronon = ($text8[2] == "0"?19:2);
			 $labelType = array(0 => 1, 1=>3, 2=>28, 3=>20, 4=>$labelIronon);
				$swfIronon = ($text8[2] == "0"?"display_coloured_ironon":"display_iron");
				$swf = array(0 => "display_mini", 1=>"display_shoe_dots", 2=>"display_shoe_dots");
				// Show the labels
				for($i = 0;$i<=4;$i++)
				{
					// Get background colour from code - this is correct for most of the labels
					$bgColour = get_background_colour($text4[$i]);
					// If we are processing the iron-ons, see if it is a semi-perm
					if ((4==$i) && ("display_iron" == $swfIronon))
					{
						// Semi-perm is always balck and white!
						$bgColour = "White";
					}
					
				  $phone = ((int)$text9[$i]==1?urlencode($text2[$i]):"");
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType($labelType[$i])."</font></td></tr>";
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$text1[$i]."</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$text2[$i]."</font></td></tr>";
              $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getPicType($text3[$i])."</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$bgColour."</font></td></tr>";
	     	     $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">4</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($text5[$i])."</font></td></tr>";
              $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr>";

				}  
		$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType(14)."</font></td></tr>";
		$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Design:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentitagDesc($text7[0])."</font></td></tr>";
                $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr>";
	         
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType(30)."</font></td></tr>";
		 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Design:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentibandDesc($text7[1])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr>";

		$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType(22)."</font></td></tr>";
		 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Design:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getZiptagDesc($text7[2])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr></table>";
	                         
	         break;
	         
	         //Itty Bitty Pack
	         case '35':
	         
	         $text1 = explode(",",$qdata["text1"]); // name
				$text2 = explode(",",$qdata["text2"]); // phone
				$text3 = explode(",",$qdata["text3"]); // picture
				$text4 = explode(",",$qdata["text4"]); // background colour
				$text5 = explode(",",$qdata["text5"]); // font colour
				$text6 = explode(",",$qdata["text6"]); // split name to two lines
				$text7 = explode(",",$qdata["text7"]); // tags and bands
				$text8 = explode(",",$qdata["text8"]); // perm or semi-perm ironons
				$text9 = explode(",",$qdata["text9"]); // show phone boolean
				$text10 = explode(",",$qdata["text10"]); // show picture boolean
									
			   $labelIronon = ($text8[2] == "0"?19:2);
				$labelType = array(0=>3, 1=>28, 2=>20);
				$swfIronon = ($text8[2] == "0"?"display_coloured_ironon":"display_iron");
				$swf = array(0 => "display_mini", 1=>"display_shoe_dots", 2=>"display_shoe_dots");
																		
				// Show the labels
				for($i = 0;$i<=2;$i++){
				  $phone = ((int)$text9[$i]==1?urlencode($text2[$i]):"");
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType($labelType[$i])."</font></td></tr>";
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$text1[$i]."</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Phone</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$text2[$i]."</font></td></tr>";
              $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getPicType($text3[$i])."</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($text4[$i])."</font></td></tr>";
	     	     $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">4</font></td></tr>";
	           $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_font_colour($text5[$i])."</font></td></tr>";
              $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr>";

				}  
				$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType(30)."</font></td></tr>";
				$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentitagDesc($text7[4])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr>";
	         
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pack Item</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getLabelType(22)."</font></td></tr>";
				$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getIdentibandDesc($text7[4])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap colspan=\"2\"><br></td></tr></table>";
	       					
	                         
	         break;
	         
	         //Thingamejigs
	         case ($qdata['type'] >= '36' && $qdata['type'] <= '39'):
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Band Colour</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
            $content.="<tr><td align='right' valign='top' width='100px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Charms:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">";
	         for( $i=3 ; $i <= 12; $i++) {
				 $content.=$qdata["text".$i]!=''?$qdata["text".$i].'<br>':'';
				}    
				$content.="</font></td></tr></table>";
				
				break; 
	         
	         //Thingamejigs - Extra Charms
	         case '40':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
            $content.="<tr><td align='right' valign='top' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Charms:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">";
	         for( $i=3 ; $i <= 12; $i++) {
				 $content.=$qdata["text".$i]!=''?$qdata["text".$i].'<br>':'';
				}    
				$content.="</font></td></tr></table>";  
				
	         break;

		 
	         //Magpie eyes
	         case '41':

	         $content.="<tr><td colspan='2' ><br></td></tr></table>";

		 break;
	         
	         //Bin Lsbels
	         case '42':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Number</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Street</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text2']."</font></td></tr>";
            $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getPicType($qdata["pic"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".get_background_colour($qdata['colours'])."</font></td></tr></table>";
	                
	         break;
	         
	         //Seniors Pack
	         case '43':
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name</i>: </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['colours']."</font></td></tr>";
	       	$content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Pic:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getPicType($qdata["pic"])."</font></td></tr>";
	         $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Font:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".getFontNumber($qdata["font"])."</font></td></tr></table>";
	         
	         break;
          //Wall Art
	       case '45':

				 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Design:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text3']."</font></td></tr></table>";
				  
	          break;
	          
	      //Kipiis
	       case '46':

				 $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colours:</i> </font></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata['text1']."</font></td></tr></table>";
			    break;
			    
			//Popup window products
			//case ($qdata["type"]>=48)&&($qdata["type"]<=62):
			case (($qdata["type"]>=48 && $qdata["type"]<=72)||($qdata["type"]>=80 && $qdata["type"]<=82)):
				if($qdata["text4"]!='') { 
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Design:</i></td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["text4"]."</td></tr>";
				} 
				if($qdata["text1"]!='') {
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Name:</td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["text1"]."</td></tr>";
				}
				if($qdata["text5"]!='') {
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>".$qdata["text5"].":</td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["text6"]."</td></tr>";
				} 
				if($qdata["text2"]!='') {
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Colour:</td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["text2"]."</td></tr>";
				} 
				if($qdata["text3"]!='') {
				  $content.="<tr><td align='right' width='80px' nowrap ><font face=\"Comic Sans MS\" size=\"2\"><i>Material:</td><td align='left' ><font face=\"Comic Sans MS\" size=\"2\">".$qdata["text3"]."</td></tr>";
				} 
	         break;
	         
	       default:break;
	     }
            if($qdata["quantdesc"]) {
             $content.= '<table width="100%" border="0">'
                     .'<tr>'
                     .'<td width="80px" nowrap="" align="right"><font size="2" face="Comic Sans MS"><i>Quantity</i>: </font></td>'
                     .'<td align="left"><font size="2" face="Comic Sans MS">'.$qdata["quantdesc"].'</font></td>'
                     .'</tr>'
                     .'</table><br>';
            }
            

		  
		}
		
      $total_order_charge += $qdata["price"];
      
		if($qdata['type']==16){
			$_SESSION['baby_pack_in_order'] = true;
		}

	}
	/*if($currency!=1 && $currency!=5)
	{
		$total_order_charge += $cur['postage'];
	}
	else
	{ */
		$total_order_charge += $postageamount;
	//}

	$query = "SELECT symbol FROM currencies LEFT JOIN orders ON currencies.id = orders.currency WHERE orders.customer = " . $custid . " LIMIT 1";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$currency_symbol = "";
	$currency_symbol = mysql_fetch_assoc($result);

	$total_before_voucher = $total_order_charge;
	list($usevoucher, $voucher_valid, $voucher_total, $voucher_balance, $voucher_usage, $total_order_charge, $voucher_errors, $voucher_currency) = getVoucherDetails($total_order_charge, $vouchercode, false, $currency);	

	$content .= "<br/>
		<table cellpadding=2 cellspacing=2 border=0 width=100% style=\"	font-family: Comic Sans MS; font-size: 14px;\">";

	/* if($currency!=1 && $currency!=5)
	{
		$content .= "
				<tr>
					<td valign=top nowrap width=5% class=maintext>Postage</td>
					<td width=5%>&nbsp;</td>
					<td class=maintext>".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."</td>
				</tr>";
		$text .= "\nPostage: ".$currency_symbol["symbol"].sprintf("%01.2f", $cur['postage'])."\n";
	}
	else
	{ */
		$content .= "
				<tr>
					<td valign=top nowrap width=5% class=maintext>Postage</td>
					<td width=5%>&nbsp;</td>
					<td class=maintext>".$currency_symbol["symbol"].sprintf("%01.2f", $postageamount)."</td>
				</tr>
				<tr>
					<td valign=top colspan='3' class=maintext>Postage method&nbsp;&nbsp;&nbsp;&nbsp;".$postageoption." </td>
				</tr>";
				
		/* $text .= "\nPostage: ".$currency_symbol["symbol"].sprintf("%01.2f", $postageamount)."\n";	
		$text .="Postage method: ".$postageoption."\n";
	} */
	
	
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
		$text .= "\nOrder Total: " . $currency_symbol["symbol"] . $total_order_charge;
	}
        
        
        // shipping address detials ////////////////////////////////
        if($_POST['address']){
        $content.= '<hr>
                <table style="background-color:#EFEFEF;padding:10px;">
                <tr> 
                   <td align="left" class="maintext" colspan="2"><strong>Shipping Details</strong><hr></td>  
               </tr>';
               if($_POST['del_name']){
                   $content.='<tr><td align="right" class="maintext"><strong>Delivery Name:</strong></td><td class="maintext">' . stripslashes($_POST['del_name']) . '</td></tr>';
               }
               $content.='<tr> 
                   <td align="left" class="maintext"><strong>Delivery Address:</strong></td> 
                   <td class="maintext">' . stripslashes($_POST['address']) . '</td> 
               </tr> 
               <tr> 
                   <td align="left" class="maintext"><strong>Suburb / Town / City:</strong></td> 
                   <td class="maintext">' . stripslashes($_POST['suburb']) . '</td> 
               </tr> 
               <tr> 
                   <td align="left" class="maintext"><strong>Postcode:</strong></td> 
                   <td class="maintext">' . $_POST['postcode'] . '</td> 
               </tr> 
               <tr> 
                   <td align="left" class="maintext"><strong>State:</strong></td> 
                   <td class="maintext">' . $_POST['state'] . '</td> 
               </tr> 
               <tr> 
                   <td align="left" class="maintext"><strong>Country:</strong></td> 
                   <td class="maintext">' . $_POST['country'] . '</td> 
               </tr>
           </table>';
        }
        // @end of shipping address details ////////////////////////

	if($ccPayment){
		$content .= "<br />Your Credit Card has been charged ".$_CURRENCIES[1]['currency'].sprintf("%01.2f", $_SESSION['paymentAmount']);
		$text .= "\nYour Credit Card has been charged ".$_CURRENCIES[1]['currency'].sprintf("%01.2f", $_SESSION['paymentAmount']);

		if($currency!=1 && $currency!=5)
		{
			$content .= "<br />
				<br />
				Please see our <A href=\"{$_CONSTANTS['weburl']}Home/How_To_Order\" target=\"_blank\">Ordering Online</a> page to see why you have been charged in AU\$.";
			$text .= "\nPlease see our Ordering Online <{$_CONSTANTS['weburl']}Home/How_To_Order}> page to see why you have been charged in AU\$.";
		}
	}		

		
		
   //Custom Email Footer		
   $content .=file_get_contents(SITE_DIR."_user_pages/customer_receipt.php");

	$content.="</font></td>"
			."</tr></table>";
			
	$text = strip_tags($content);
	
	$html = makeHtmlContent($content);
	
	//$from=$_CONSTANTS['emailAdmin'];
	$from=INFO_EMAIL;
	$title = " Your order confirmation: invoice #".(1000+$id);
	$to = $custemail;

   
   include ("htmltotxt/html2text.inc");

   $convertText = nbsp2sp($html);

   $asciiText = new Html2Text ($convertText, 100); // 15 columns maximum
   $text = $asciiText->convert();
   
   $attach = '';
   if($instant_voucher == true) {
     require_once('giftvoucher_print.php');
     $attach = SITE_DIR.'images/tmp/'.$voucher_number.'.pdf';  
     sendHtmlEmail($text, $html, $from, $to, $title,$attach);
     unlink(SITE_DIR.'images/tmp/'.$voucher_number.'.pdf');
   } else {
     sendHtmlEmail($text, $html, $from, $to, $title);
   }

	// send the email to the customer and to confirmations for audit purposes
	//sendHtmlEmail($text, $html, $from, $to, $title);
	sendHtmlEmail($text, $html, $from, ORDER_CONFIRMATION_EMAIL, $title);
        //sendHtmlEmail($text, $html, $from, 'web.developer.sanil@gmail.com', $title);
   
  
	//echo $html;
	//echo "<br><br><br>".$text;
	

	// update voucher.

	if($usevoucher){
		updateVoucher($custid);
	}

}

function nbsp2sp($string)
{
    return preg_replace('/&nbsp;/i', " ", $string);
}

function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}


function sendToAFriend($username, $to, $fromemail){
	global $absimageurl;
	
	// create content
	$text = "Your friend ".$username." (".$fromemail.") thought that you would enjoy our site.\n\n"
	."Click here to visit identi Kid: http://www.identikid.com.au\n\n\nNote: this is an automated email � no need to reply.";
	
	$content .= "<tr>"
				."<td class=\"maintext\"><br>"
					."<font face=\"Comic Sans MS\" size=\"2\">Your friend ".$username." (".$fromemail.") thought that you would enjoy our site. <br>"
					."<a href=\"http://www.identikid.com.au/\">Click here</a> to visit <strong>identi Kid<br></strong></font></td>"
			."</tr>"
			."<tr>"
			."<td><br><font face=\"Comic Sans MS\" size=\"2\"><strong>Note: this is an automated email � no need to reply.</strong></font></td>"
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

//-------------------Old Email Content---------------------------
/*
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
                ."<td bgcolor=\"#FF9900\" width=\"141\" ><!--<img src=\"$absimageurl/images/image_phone_heading.gif\" alt=\"Ph: 02&nbsp;69712276\" width=\"141\" height=\"62\">--></td>"
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
				."<td width=\"137\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Phone:&nbsp;02&nbsp;69212888</font></td>"
				."<td width=\"25\" valign=\"middle\">"
				  ."<div align=\"center\"><img src=\"$absimageurl/images/image_fax.gif\" alt=\"Fax\" width=\"30\" height=\"25\"></div></td>"
				."<td width=\"131\" valign=\"middle\"><font face=\"Comic Sans MS\" size=\"2\">Fax: 02&nbsp;69214933</font></td>"
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
*/

function makeHtmlContent($content, $newAbsImageUrl=""){
  global $absimageurl;
  if(!empty($newAbsImageUrl))
    $absimageurl = $newAbsImageUrl;

  $html.="<table  border=\"0\"  width=\"100%\" cellspacing=\"0\" align=\"center\" cellpadding=\"0\"  >
            <tr>
              <td background=\"$absimageurl/images/bg_pattern.gif\">
		<table  border=\"0\"  width=\"740px\" cellspacing=\"0\" align=\"center\" cellpadding=\"0\"  >
		  <tr>
           	    <td colspan=\"3\" style=\"width:740px; height:176px; background: #ffffff url('$absimageurl/images/newsletter/IK_Header.jpg')  no-repeat top left;\"></td>
         	  </tr>
                  <tr>
                    <td style=\"width:34px; height:220px; background-color: #ffffff;\" ></td>
                    <td style=\"width: 678px; background-color:#ffffff;\">".$content."</td>
                    <td style=\"width:34px; height:220px; background-color: #ffffff;\" ></td>
                  </tr>
                  <tr>
                    <td  colspan=\"3\" style=\" width:740px; height:63px;\">
                      <img src=\"$absimageurl/images/newsletter/IK_Footer.gif\" alt=\"\" width=\"740\" height=\"63\" border=\"0\" usemap=\"#map\"><br>
		      <map name=\"map\">
		        <area shape=\"rect\" coords=\"2,2,61,31\" href=\"/\" />
                        <area shape=\"rect\" coords=\"64,3,562,31\" href=\"/Contact_Us\" />
                        <area shape=\"rect\" coords=\"564,2,629,30\" href=\"/Shipping\" />
                        <area shape=\"rect\" coords=\"631,4,723,30\" href=\"/Fundraisers\" />
                      </map>
                    </td>
                  </tr>
                </table>
              </td>
	    </tr>
          </table>";
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

function getFontNumber($number){
	if($number==1 || $number==6){
		return $number;
	}else if($number==2){
		return 5;
	}else if($number==3){
		return 4;
	}else if($number==4){
		return 3;
	}else if($number==5){
		return 2;
	}
}

function killSession()
{
    session_start();
    // Clear session variables
    $_SESSION = array();
    // Destroy session
	session_destroy();
}

function checkStalePage()
{
	if (!checkOrderId(false))
	{
		header("Location: http://www.identikid.com.au/Products");
	}
}
?>
