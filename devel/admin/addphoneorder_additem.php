<?
$includeabove = true;
include("../useractions.php");

linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

//debug_showvar($_POST); 
//exit;

$id = checkOrderId(false);

// check for currency
if(!isset($_COOKIE['currency'])){
	// default to AU dollars
	//setcookie("currency", 1, time()+3600);
	setcookie("currency", 1);
}

// allow for colour iron on tyep

function getProductPricing($productID, $currency)
{
		if((int)trim($currency) == 0){
			$currency = 1;
		}
		// get products pricing.
		$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId='{$productID}' AND a.productId=c.id AND a.currencyInt='{$currency}' AND a.currencyInt=b.id";
		//echo $query;
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
			
		while($qdata = mysql_fetch_array($result)){
			$price = $qdata["price"];
			$quantDesc = $qdata["unitQuant"] ." " .$qdata["productName"] ." for " .str_replace("€","EURO", $qdata["symbol"])  .$qdata["price"];
		}
		return array($price, $quantDesc);
}

function insertSharedPack(){

	// type 17;
	global $id;
	
	list($price, $quantDesc)=getProductPricing($_POST['type'], $_COOKIE['currency']);

	// kidsName
	$text1 = rawurlencode($_POST['pack1_text1']) ."," .rawurlencode($_POST['pack2_text1']);
	
	// kidsPhone
	if($_POST["pack1_text2"]=="Ph:" || $_POST["pack1_text2"]=="Ph: " || empty($_POST["pack1_text2"])){
		$phone1="";
	}else{
		$phone1="Ph: {$_POST["pack1_text2"]}";
	}
	if($_POST["pack2_text2"]=="Ph:" || $_POST["pack2_text2"]=="Ph: " || empty($_POST["pack2_text2"])){
		$phone2="";
	}else{
		$phone2="Ph: {$_POST["pack2_text2"]}";
	}
	$text2 = rawurlencode($phone1) ."," .rawurlencode($phone2);
	
	$text3=$text4="";
	
	
	//packType, allow for colour iron on type
	if((int)$_POST['ironon'] == 2){
		$text5_1 = 19;
	} else {
		$text5_1 = $_POST['pack1'];
	}
	if((int)$_POST['ironon2'] == 2){
		$text5_2 = 19;
	} else {
		$text5_2 = $_POST['pack2'];
	}
	$text5 = "$text5_1,$text5_2";
	
	//pic
	if($_POST['pack1_pic']=="none"){
		$pack1_pic = "";
		$pack1_picon = 0;
	}else {
		$pack1_pic = $_POST['pack1_pic'];
		$pack1_picon = 1;
	}
	if($_POST['pack2_pic']=="none"){
		$pack2_pic = "";
		$pack2_picon = 0;
	}else {
		$pack2_pic = $_POST['pack2_pic'];
		$pack2_picon = 1;
	}

	
	$pic = "{$pack1_pic},{$pack2_pic}";
	$picon = "{$pack1_picon},{$pack2_picon}";
	
	//font

	$font = "{$_POST['pack1_font']},{$_POST['pack2_font']}";
	$fontcol = "{$_POST['pack1_fontcol']},{$_POST['pack2_fontcol']}";
	
	//split
	$pack1_split = ($_POST['pack1_split']==1)?1:0;
	$pack2_split = ($_POST['pack2_split']==1)?1:0;
	$split = "{$pack1_split},{$pack2_split}";
	
	// colours
	$colours = "{$_POST['pack1_colours']},{$_POST['pack2_colours']}";
	$fontcol = "{$_POST['pack1_fontcol']},{$_POST['pack2_fontcol']}";
	$vcolours = "{$_POST['vcolours']}}";
	
	// iron-on type
	$text6 = "{$_POST['ironon']},{$_POST['ironon2']}"; 
	
	$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, text6, colours, font, picon, gift, split, text10)"
		." VALUES (".$id.", ".$price.", '{$quantDesc}', ".$_POST["type"].", 0, '{$pic}', '{$text1}', '{$text2}', '{$text3}', '{$text4}', '{$text5}', '{$text6}', '{$colours}', '{$font}', '{$picon}', 0, '{$split}', '{$fontcol}')";
	//echo $query;
	
	
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());

}


function insertItem(){
	global $id, $colours;
	
	$type = (int)form_param('type');
	$text1 = form_param('text1');
	if(strlen(form_param('text2')) > 0 && $type!=9 && $type!=8 && $type!=20 && $type!=22 && $type!=23 && $type!=24){
		
		$text2 = "Ph: ".$_POST["text2"];
	}else{
		$text2 = form_param("text2");
	}
	$text3 = form_param('text3');
	$text4 = form_param('text4');
	$text5 = form_param('text5');
	
	if($_POST["pic"]=="none"){
		$picon=0;
		$pic=0;
	}else{
		$picon=1;
		$pic=$_POST["pic"];
	}

	$record = array();
	
	switch($type)
	{
	
	 case 41: 
	   
	      $record = array();
			$record['ordernumber'] 	= $id;
			$record['price']		   = $_POST['price'];
			$record['quantdesc']	   = $_POST['quantdesc'];
			$record['type']			= $type;
			$record['text1']			= $_POST['quant'];
		   $record['text2']			= "";
			$record['text3']			= "";		
			$record['text4']			= "";		
			$record['text5']			= "";		
			$record['text6']			= "";		
			$record['text7']			= "";		
			$record['text8']			= "";
			$record['text9']			= "";
			$record['text10']	   = ""; 
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;
	
      case ( ($type>=36)&&($type<=39) ): // Thingamejigs

	      $record = array();
			$record['ordernumber'] 	= $id;
			$record['price']		   = $_POST['price'];
			$record['quantdesc']	   = $_POST['quantdesc'];
			$record['type']			= $type;
			$record['text1']			= $_POST['name'];
		   $record['text2']			= $_POST['background_colour'];
		   $recOffset = 3;
		   $recOffsetMax = 12;
		   foreach($_POST as $key => $value) {
		     if((strpos($key, 'icon_')!== false) && ($value > 0)) {
		       $name=substr($key, 5);
		       $record['text'.$recOffset]="{$value} x {$name}";
		       $recOffset++;
		     }
		     if($recOffset>$recOffsetMax) break;
		   }
		  
		  $result = db_insert('basket_items', $record, &$insert_id);
		  if($result == false)
		  {
		  	display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
		  }	
		  break;

	case 34: // Maxi Pack
		list($price, $notused)= getProductPricing($type, $_COOKIE['currency']);
		
		$result = db_query("SELECT id, symbol FROM currencies WHERE currencies.id = " . $_COOKIE["currency"]);
		if ($result){
			list($currency_id, $currency_symbol) = mysql_fetch_row($result);
			//mysql_free_result($result);
		}else{
			$currency_symbol = "AU$";
		}

		// get the order details from the form
		$record = array();
		$record['ordernumber'] 	= $id;
		$record['price']					= $price;
		$record['quantdesc']			= "1 Maxi Pack for ".$currency_symbol.$price;
		$record['type']					= $type;
		$record['text1']				= $_POST['maxi_pack1_name'].",".$_POST['maxi_pack1_name'].",".$_POST['maxi_pack1_name'].",".$_POST['maxi_pack1_name'].",".$_POST['maxi_pack1_name'];
		$record['text2']				= $_POST['maxi_pack1_phone'].",".$_POST['maxi_pack1_phone'].",".$_POST['maxi_pack1_phone'].",".$_POST['maxi_pack1_phone'].",".$_POST['maxi_pack1_phone'];
		$record['text3']				= $_POST['maxi_pack1_pic'].",".$_POST['maxi_pack1_pic'].",".$_POST['maxi_pack1_pic'].",".$_POST['maxi_pack1_pic'].",".$_POST['maxi_pack1_pic'].",".$_POST['maxi_pack1_pic'];
		$record['text4']				= $_POST['maxi_pack1_background_colour'].",".$_POST['maxi_pack1_background_colour'].",8,".$_POST['maxi_pack1_background_colour'].",".$_POST['maxi_pack3_background_colour'];
		$record['text5']				= $_POST['maxi_pack1_font_colour'].",".$_POST['maxi_pack1_font_colour'].",1,1,1";
		$record['text6']				= $_POST['maxi_pack1_split'].",".$_POST['maxi_pack1_split'].",".$_POST['maxi_pack1_split'].",".$_POST['maxi_pack1_split'].",".$_POST['maxi_pack1_split'];
		$record['text7']				= $_POST['maxi_pack_identitag_pic'].",".$_POST['maxi_pack_identiband_pic'].",".getZipTagCode($_POST['maxi_pack_ziptag_pic']);
		$record['text8']				= $_POST['maxi_pack1_vsemiPermanent'].",".$_POST['maxi_pack2_vsemiPermanent'].",".$_POST['maxi_pack3_vsemiPermanent'];
		$record['text8']				=  "0,0,".($_POST['maxi_pack3_vsemiPermanent']?"1":"0");
		$record['text9']				= "1,1,1,1,1";
		$record['text10']				= ($_POST['maxi_pack1_pic']!="none"?1:0).",".($_POST['maxi_pack1_pic']!="none"?1:0).",".($_POST['maxi_pack1_pic']!="none"?1:0).",".($_POST['maxi_pack1_pic']!="none"?1:0).",".($_POST['maxi_pack1_pic']!="none"?1:0);
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
		}	
		break;
	case 33: // Book Labels
		$prodid = (int)$type;
		list($price, $notused)= getProductPricing($prodid, $_COOKIE['currency']);

		$sql_bl = "SELECT *
						FROM product
						WHERE id = ".$type;
		$result_bl = db_query($sql_bl) or die (mysql_error());
		$record_bl = db_fetch_array($result_bl);

		$unitQuant  = $record_bl['unitQuant'];
		$productName = $record_bl['productName'];
		$quantity  = (int)$_POST['quantity']+1;
		$cost = $price*$quantity;
		
		$record['ordernumber'] 	= $id;
		$record['price']					= $cost;
		$record['pic']					= $_POST['pic'];
		$record['typedetail']			= $_POST['quantity'];
		$record['quantdesc']			= $quantity*(int)$unitQuant." ".$productName." for ".$_POST['symbol'].$cost;
		$record['type']					= $type;
		$record['text1']				= $_POST['text1'];
		$record['colours']				= $_POST['colours'];
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
		}	
		break;
	case 30: // Identi Bands
		$quantity = (int)$_POST['quantity'];
		if ($quantity == 1)
		{
			$quantdesc = "1 Lot (10 Bands 1 design)";
			$prodid = 30;
		}
		elseif ($quantity == 2)
		{
			$quantdesc = "2 Lots (20 Bands 2 designs)";
			$prodid = 31;
		}
		else
		{
			$quantdesc = "5 Lots (50 Bands 5 designs)";
			$prodid = 32;
		}
		list($price, $notused)= getProductPricing($prodid, $_COOKIE['currency']);

		extract($_POST, EXTR_PREFIX_SAME, "pst"); // Generate names
		$designArray = array($design0, $design1, $design2, $design3,$design4); 
		for ($i=0; $i<5; $i++)
		{
			if (strlen($designArray[$i]) < 1)
			{
				$designArray[$i] = "0";
			}
		}

		$record['ordernumber'] 			= $id;
		$record['price']				= $price;
		$record['typedetail']			= $quantity; 
		$record['quantdesc']			= $quantdesc;
		$record['type']					= $type;
		$record['text1']				= $designArray[0];
		$record['text2']				= $designArray[1];
		$record['text3']				= $designArray[2];
		$record['text4']				= $designArray[3];
		$record['text5']				= $designArray[4];
		
		//print_r($record);
			
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
		}	
	break;
	case 28:
	case 29:
		// Zipdedo dots
				
			$price = $_POST["price"];
			$price_formatted = $_POST["quantdesc"];
			
//			product_details($type, $_COOKIE['currency'], &$product);
			//$price_formatted = (((int)form_param('chosenQuant') + 1) * (int)$product['unitQuant']) . " " . $product['productName'] . " for " . $product['symbol'].(((int)form_param('chosenQuant') + 1)*$product['price']);
			//$price = ((int)form_param('chosenQuant') + 1) * $product['price'];
			
			
			$record['ordernumber'] 			= $id;
			$record['price']				= $price;
			$record['quantdesc']			= $price_formatted;
			$record['type']					= $type;
			$record['pic']					= (int)$pic;
			$record['picon']				= (int)$picon;
			$record['text1']				= $text1;	// name
			$record['text2']				= $text2;	// phone
//			$record['text5'] 				= (int)$text5;
//			$record['colours']				= (int)form_param('colours'); // rainbox colours
			$record['font']					= 3;//(int)form_param('font');
			$record['split']				= (int)0;
			$record['data_colour_id']		= 8;			// iron on colours
			$record['data_font_colour_id']	= 1;		// font colour.
			//debug_showvar($_POST);
			//debug_showvar($record); exit;
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error(), true);
			}
		break;
	
	case 27:
	// file attachment
		if(isset($_FILES['document_db_id_1']) == true && (int)$_FILES['document_db_id_1']['size'] > 0)
		{
			// upload image path
			$uploaddir = '/home/identiki/public_html/pdf/';
			$uploadfile = $uploaddir . basename($_FILES['document_db_id_1']['name']);	
			
			// move image to temporary directory     
			if(move_uploaded_file($_FILES['document_db_id_1']['tmp_name'], $uploadfile))
				$data = addslashes(fread(fopen($uploadfile, "r"), filesize($uploadfile)));
			else
				echo 'Problem: Could not move file to destination directory';
	
			$document_record = array();
			$document_record['*document_db_timestamp'] = 'NOW()';
			$document_record['*document_db_bin_data'] = "'$data'";
			$document_record['document_db_filename'] = $_FILES['document_db_id_1']['name'];
			$document_record['document_db_filesize'] = $_FILES['document_db_id_1']['size'];
			$document_record['document_db_mimetype'] = $_FILES['document_db_id_1']['type'];
			
			db_insert('document_db', $document_record, &$document_db_id_1);
			$record['text4'] = $document_db_id_1;
		}


		$record['ordernumber'] 			= $id;
		$record['price']				= $_POST["price"];
		$record['quantdesc']			= $_POST["quantdesc"];
		$record['type']					= $_POST["type"];
		$record['text1']				= $_POST["size"];	// size
		$record['text2']				= $_POST["material"];	// material
		$record['text3']				= $_POST["delivery"];	// delivery instructions
		$record['colours']				= $_POST["colour"];	// colours
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error(), true);
		}
		break;

	case 24:
		// Address Labels
		$quantdesc = "Address Labels ".$_POST["quantity"];
		//echo "<BR />quantity desc = ". $quantdesc."<BR />";
		$colour = $_POST["colourchoice"];

		$findf  = 'f';
		$posf = strpos($quantdesc, $findf);
		$quantity = substr($quantdesc,0, $posf);		
		
		if ($quantity==60)
		{
			$thetype=24;
			$thequantity = 60;
		}
		elseif ($quantity==100)
		{
			$thetype=25;
			$thequantity = 100;
		}
		else 
		{
			$thetype=26;
			$thequantity = 200;
		}
		
		$findme  = '$';
		$pos = strpos($quantdesc, $findme);
		$pos +=1;
		$price = substr($quantdesc, $pos);
		
		// set price to integer
		settype ( $price , "integer" );
		
		/*if ($text1 != '')
		{
			$price += $thequantity;
		}*/
		
		
		//$quantdesc = $_POST["quantity"];
		
		$record['ordernumber'] 			= $id;
		$record['price']				= $price;
		$record['quantdesc']			= $quantdesc;
		$record['type']					= $thetype;
		$record['pic']					= (int)$pic;
		$record['text1']				= $text1;	// line 1
		$record['text2']				= $text2;	// line 2
		$record['text3']				= $text3;	// line 3
		$record['text4']				= $text4;	// line 4
		$record['colours']				= $colour;	// colours
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error(), true);
		}			
		break;
	
	case 22:
		// Zip Tags 3
		$quantdesc = $_POST["quantity"];
		$quantity = $quantdesc{0};
		if ($quantity=='3')
		{
			$thetype=22;
			$thequantity = 3;
		}
		else 
		{
			$thetype=23;
			$thequantity = 5;
		}
		
		// extract last two digits from quantity description
		$temp_price = substr($quantdesc, -2);

		// if price is single digit (ie 8)
		if ($thetype == 22) 
		{
			$temp_price = substr($temp_price, -1);
		}
		
		
		$price = $temp_price;
		// set price to integer
		settype ( $price , "integer" );
		
		if ($text1 != '')
		{
			$price += $thequantity;
		}
		
		
		$quantdesc = $_POST["quantity"];
		
		
		
		$record['ordernumber'] 			= $id;
		$record['price']				= $price;
		$record['quantdesc']			= $quantdesc;
		$record['type']					= $thetype;
		$record['pic']					= (int)$pic;
		$record['text1']				= $text1;	// line 1
		$record['text2']				= $text2;	// line 2
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error(), true);
		}			
		break;
		
	case 21:
		// Colour My World Pack!
		$quantity = explode(";", $_POST["quantity"]);
		$price = $quantity[0];
		$quantdesc = $quantity[1];
		
		$record['ordernumber'] 			= $id;
		$record['price']				= $price;
		$record['quantdesc']			= $quantdesc;
		$record['type']					= $type;
		$record['pic']					= (int)$pic;
		$record['picon']				= (int)$picon;
		$record['text1']				= $text1;	// name
		$record['text2']				= $text2;	// phone
		$record['text5'] 				= (int)form_param('pencil_or_mini');
		$record['colours']				= (int)form_param('colours'); // rainbox colours
		$record['font']					= (int)form_param('font');
		$record['split']				= (int)form_param('split');
		$record['data_identitag_id'] 	= (int)form_param('data_identitag_id');			// identitag
		$record['data_colour_id']		= (int)form_param('data_colour_id');			// iron on colours
		$record['data_font_colour_id']	= (int)form_param('data_font_colour_id');		// font colour.
		
//			debug_showvar($record); exit;
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error(), true);
		}
		break;
	case 20:

	
		// quantity desc
		
		$quantity = explode(";", $_POST["quantity"]);
			
		$price = $quantity[0];
		$price_formatted = $quantity[1];
		
//			product_details($type, $_COOKIE['currency'], &$product);
		//$price_formatted = (((int)form_param('chosenQuant') + 1) * (int)$product['unitQuant']) . " " . $product['productName'] . " for " . $product['symbol'].(((int)form_param('chosenQuant') + 1)*$product['price']);
		//$price = ((int)form_param('chosenQuant') + 1) * $product['price'];
		
		
		$record['ordernumber'] 			= $id;
		$record['price']				= $price;
		$record['quantdesc']			= $price_formatted;
		$record['type']					= $type;
		$record['pic']					= (int)$pic;
		$record['picon']				= (int)$picon;
		$record['text1']				= $text1;	// name
		$record['text2']				= $text2;	// phone
//			$record['text5'] 				= (int)$text5;
//			$record['colours']				= (int)form_param('colours'); // rainbox colours
		$record['font']					= (int)form_param('font');
		$record['split']				= (int)0;
		$record['data_colour_id']		= (int)form_param('colour');			// iron on colours
		$record['data_font_colour_id']	= (int)form_param('font_colour');		// font colour.
//			debug_showvar($_POST);
//			debug_showvar($record); exit;
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error(), true);
		}
		break;
	case 5:
	case 3:
	case 19:
		// quantity desc
		$quantity = explode(";", $_POST["quantity"]);
			
		$price = $quantity[0];
		$price_formatted = $quantity[1];
		
		
		$record['ordernumber'] 			= $id;
		$record['price']				= $price;
		$record['quantdesc']			= $price_formatted;
		$record['type']					= $type;
		$record['pic']					= (int)$pic;
		$record['picon']				= (int)$picon;
		$record['text1']				= $text1;	// name
		$record['text2']				= $text2;	// phone
//			$record['text5'] 				= (int)$text5;
//			$record['colours']				= (int)form_param('colours'); // rainbox colours
		$record['font']					= (int)form_param('font');
		$record['split']				= (int)0;
		$record['data_colour_id']		= (int)form_param('colour');			// iron on colours
		$record['data_font_colour_id']	= (int)form_param('font_colour');		// font colour.
		
		
//			debug_showvar($record);
//			debug_showvar($_POST);
//			exit;
		
		$result = db_insert('basket_items', $record, &$insert_id);
		if($result == false)
		{
			display_error('sql error: ' . mysql_error(), true);
		}
		break;
	default:
		$text5 = form_param('text5');

		if($_POST["text2"]!="" && $_POST["type"]!=9 && $_POST["type"]!=8){
			$text2 = "Ph: ".$_POST["text2"];
		}else{
			$text2 = $_POST["text2"];
		}
	
		if($_POST["pic"]=="none"){
			$picon=0;
			$pic=0;
		}else{
			$picon=1;
			$pic=$_POST["pic"];
		}
		
		if(!$_POST["split"]){
			$split=0;
		}else{
			$split=1;
		}
		
		if(!$_POST["gift"]){
			$gift=0;
		}else{
			$gift=$_POST["gift"];
		}
		
		if($_POST["type"]==10){
			$gift=$_POST["typedetail"];
			$typedetail=0;
			
			// IdentiTag Selection Options
			if (($_POST["text3"] != "") AND ($_POST["text4"] != "")){ // An IdentiTag was selected from each of the two drop down lists
				$text3 = $_POST["text3"];
				$text4 = $_POST["text4"];
			}elseif ($_POST["text3"] != ""){ // Only one IdentiTag was selected from the first drop down list
				$text3 = $_POST["text3"];
			}elseif ($_POST["text4"] != ""){ // Only one IdentiTag was selected from the second drop down list
				$text3 = $_POST["text4"];
			}else{
				$text3 = "";
			}
			
		}else if($_POST["type"]==11){
			$typedetail=$_POST["typedetail"];
		}else{
			$typedetail=0;
		}
	
		// new baby pack.
		if($_POST['type']==16){
			$text5=$gift;
			$gift = 0;
		}
		
		// show dots, coloured iron-ons
		if((int)form_param('type') == 19 || (int)form_param('type') == 20)
		{
			$colours = (int)form_param('colour');
			$text5 = (int)form_param('font_colour');
		}
		
		
		
		if($_POST["type"]!=14 && $_POST["type"]!=16){
			$quantity = explode(";", $_POST["quantity"]);
			
			$price = $quantity[0];
			$quantdesc = $quantity[1];
		}else if($_POST["type"] == 15){
	
		}
		else if($_POST["type"] == 16){
			$query = "SELECT * FROM prices WHERE productID = 16 AND currencyInt=".$_COOKIE['currency'];
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			$row = mysql_fetch_assoc($result);
			$price = $row['price'];
		}
		else{
			$cards = explode(":", $_POST["cardsVal"]);
			
			$query = "SELECT * FROM product WHERE id=14";
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			
			while($qdata = mysql_fetch_array($result)){
				$productName = $qdata["productName"];
			}
			
			$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
			//echo $query;
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			
			$k=0;
			$prices = array();
			while($qdata = mysql_fetch_array($result)){
				$prices[$k] = $qdata["price"];
				$k++;
			}
			$price = $prices[count($cards)-1];
		}
		
		if($_POST["type"]==13){
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type)"
					." VALUES (".$id.", ".$price.", '".$quantdesc."', 13)";
		}else if($_POST["type"]==7){
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, colours, type)"
					." VALUES (".$id.", ".$price.", '".$quantdesc."', '".$colours."', 7)";
		//Identitags
		} else if($_POST["type"]==14){
			$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
			$result = mysql_query($mysql) or die ("sql error");
			$row = mysql_fetch_assoc($result) or die ("sql error");
			$reverseprice = $row["reverse_text_price"];	
			$temp_price = 0;
			
			if (($_POST["text5"]!=''))
			{
				$temp_price = $reverseprice;
			}
			if ($_POST["text7"]!='')
			{
				$temp_price = ($reverseprice*2);
			}
			if ($_POST["text9"]!='')
			{
				$temp_price = ($reverseprice*3);
			}
			if ($_POST["text11"]!='')
			{
				$temp_price = ($reverseprice*4);
			}
			$price += $temp_price;
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, colours, type, text1, text2, text3, text4, text5, text6, text7, text8, text9, text10, text11, text12)"
					." VALUES (".$id.", ".$price.", '".count($cards)." ".$productName." for ".$_POST["symbol"].$price."', '".$colours."', 14, '".$cards[0]."', '".$cards[1]."', '".$cards[2]."', '".$cards[3]."', '".$_POST["text5"]."', '".$_POST["text6"]."', '".$_POST["text7"]."', '".$_POST["text8"]."', '".$_POST["text9"]."', '".$_POST["text10"]."', '".$_POST["text11"]."', '".$_POST["text12"]."')";
		}else if($_POST["type"] == 15){
	
	
		}else if($_POST['type'] == 18){
	
			$text5=$_POST['text5'];
			$gift=0;
	
			// kidsName
			$text1 = rawurlencode(stripslashes($_POST['text1']));
			
			// kidsPhone
			if($_POST["text2"]=="Ph:" || $_POST["text2"]=="Ph: " || empty($_POST['text2'])){
				$text2="";
			}else{
				$text2="Ph: ".stripslashes($_POST["text2"]);
			}
			$typedetail=0;
			$gift=0;
			// split
			$split = (isset($_POST['split']))?$_POST['split']:0;
			$picon = ($_POST['pic']=="none")?0:1;
			$pic = ($_POST['pic']=="none")?0:$_POST['pic'];
	
			list($price, $quantDesc)=split(";", $_POST['quantity']); 
	
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split, data_font_colour_id)"
			." VALUES (".$id.", ".$price.", '".$quantDesc."', ".$_POST["type"].", ".$typedetail.", ".$pic.", '".$text1."', '"
			.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$text5 ."', '".$_POST['pack1_colours']."', ".$_POST["font"].", ".$picon.", '".$gift."', ".$split.", ".$_POST["fontcol"].")";
	
		}else if($_POST['type'] == 1 || $_POST['type'] == 10 || $_POST['type'] == 11 || $_POST['type'] == 12){ // Vinyl Labels + Starter packs
		
			if ($_POST['type'] == 12) // birthday pack
			{
				$gift = $_POST['text5'];
				if ($gift ==''){
					$gift = "none";
				}
				$_POST['text6'] = $_POST['ironon'];
				$_POST["text4"] = $_POST['icolours'];
				//$text5 = $_POST['ifcolour'];
				$text5 = $gift;
			}
			elseif ($_POST['type'] == 11) {
				$_POST['text3'] = $_POST['ironon'];
				$_POST["text4"] = $_POST['icolours'];
				$text5 = $_POST['ifcolour'];
			}
			elseif ($_POST['type'] == 10) {
				$_POST["text4"] = $_POST['icolours'];
				$text5 = $_POST['ifcolour'];
				$typedetail = $_POST['ironon'];
			}
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, text6, colours, font, picon, gift, split, data_font_colour_id)"
			." VALUES (".$id.", ".$price.", '".$quantdesc."', ".$_POST["type"].", ".$typedetail.", ".$pic.", '".$_POST["text1"]."', '".$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$text5."', '".$_POST["text6"]."', '".$_POST["vcolours"]."', ".$_POST["font"].", ".$picon.", '".$gift."', ".$split.", ".$_POST["fontcol"].")";
		}else if($_POST['type'] == 16){
			/*echo "orderno.".$id."<BR />";
			echo "price.".$price."<BR />";
			echo "quantdesc.".$_POST['quantity']."<BR />";
			echo "type.".$_POST["type"]."<BR />";
			echo "pic.".$_POST["pic"]."<BR />";
			echo "text1.".$_POST["text1"]."<BR />";
			echo "text3.".$_POST["text3"]."<BR />";
			echo "text5.".$_POST["text5"]."<BR />";
			echo "colours.".$_POST["colours"]."<BR />";
			echo "font.".$_POST["font"]."<BR />";
			echo "picon.".$picon."<BR />";*/
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc,type,pic,text1, text3, text5, colours, font, picon,data_font_colour_id) VALUES (".$id.", ".$price.", '".$_POST['quantity']."', ".$_POST["type"].",".$pic.",'".$_POST["text1"]."','".$_POST["text3"]."','".$_POST["text5"]."','".$_POST["colours"]."',".$_POST["font"].",".$picon.",2)";
		}else{
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split)"
			." VALUES (".$id.", ".$price.", '".$quantdesc."', ".$_POST["type"].", ".$typedetail.", ".$pic.", '".$_POST["text1"]."', '"
			.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$text5."', '".$colours."', ".$_POST["font"].", ".$picon.", ".$gift.", ".$split.")";
		}
	
		if($_POST["type"] == 15){
			$gift_vouchers = explode(",", $_POST["VoucherOrders"]);
			$voucher_count = count($gift_vouchers);
			$loop_counter = 0;
			$query_part = "";
			
			if ($voucher_count > 0){
				//echo '$_COOKIE["currency"] = ' . $_COOKIE["currency"] . '<br>';
				$result = mysql_query("SELECT id, symbol FROM currencies WHERE currencies.id = " . $_COOKIE["currency"]);
				if ($result){
					list($currency_id, $currency_symbol) = mysql_fetch_row($result);
					mysql_free_result($result);
				}else{
					$currency_symbol = array("symbol" => "AU$");
				}
				$query_part = "INSERT INTO basket_items (ordernumber, price, quantdesc, type) VALUES ";
				while ($loop_counter < $voucher_count){
					//for ($index = 1; $index <= $gift_vouchers[$loop_counter]; $index++){
						if ($gift_vouchers[$loop_counter] > 1){
							// Plural Quantity
							$plural = "s";
							$each = " ea.";
						}else{
							// Single Quantity
							$plural = "";
							$each = "";
						}
						if ($loop_counter > 0){
							$query_part .= ", ";
						}
						$query_part .= "(" . $id . ", " . ($gift_vouchers[$loop_counter + 2] * $gift_vouchers[$loop_counter]) . ", '" . $gift_vouchers[$loop_counter] . " " . $gift_vouchers[$loop_counter + 1] . $plural . " for " . $currency_symbol["symbol"] . $gift_vouchers[$loop_counter + 2] . $each . "', 15)";
						
						//echo $query_part . '<br>';
						//$result = mysql_query($query);
						//if($result) error_message(sql_error());
						
					//}
					$loop_counter += 3;
				}
				//echo $query_part . '<br>';
				if ($query_part <> ""){
					mysql_query($query_part);
					//if($result) error_message(sql_error());
				}
			}
			
			
			//echo '<pre>';
			//print_r($gift_vouchers);
			//echo '<pre>';
			
			//echo count($gift_vouchers);
			
			//exit;
		}else{
	
			$result = mysql_query($query);
			if(!$result) error_message(sql_error()." ".$query);
		}
	}
}

if($_POST["type"]==7){
	if($_POST["colours1"]==1){
		$colours = 2;
		insertItem();
	}
	if($_POST["colours2"]==1){
		$colours = 1;
		insertItem();
	}
}else if($_POST["type"]==8 || $_POST["type"]==9){
	for($i=0; $i<8; $i++){
		if($_POST["colours".$i]!=""){
			if($colours==""){
				$colours=$_POST["colours".$i];
			}else{
				$colours.=", ".$_POST["colours".$i];
			}
		}
	}
	insertItem();
//}else if($_POST["type"] == 15){
//	$colours = $_POST["colours"];
//	insertItem();
}elseif($_POST['type'] == 17){
	insertSharedPack();


}else{
	$colours = $_POST["colours"];
	insertItem();
}

$query = "UPDATE orders SET finished='".date("Y-m-d H:i:s",time() + 7200)."' WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error());


header("location: addphoneorder.php");
exit;
?>