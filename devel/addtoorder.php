<?
include("useractions.php");
session_start();
$id = checkOrderId(true);

//debug_showvar($_POST);
//exit;

//print_r($_POST);

function insertItem(){
	global $id, $colours,$typedetail;
	$type = (int)form_param('type');
	$text1 = form_param('text1');
	
	//debug_showvar(form_param('text2'));
	if(strlen(form_param('text2')) > 0 && $type!=9 && $type!=8 && $type!=20 && $type!=19 && $type!=21){
		$text2 = "Ph: ".$_POST["text2"];
	}else{
		$text2 = form_param("text2");
	}
	

	$text3 = form_param('text3');
	$text4 = form_param('text4');
	$text5 = form_param('text5');
	
	if(form_param("picVal")=="false" || form_param('pic')=='none'){
		$picon=0;
		$pic=0;
	}else{
		$picon=1;
		$pic=(int)form_param("pic");
	}
	
	
	$record = array();
		
	switch($type)
	{

case 0:
case "":
exit();
break;
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
			/* $record['text3']			= $_POST['icon_1'];		
			$record['text4']			= $_POST['icon_2'];		
			$record['text5']			= $_POST['icon_3'];		
			$record['text6']			= $_POST['icon_4'];		
			$record['text7']			= $_POST['icon_5'];		
			$record['text8']			= "";
			$record['text9']			= "";
			$record['text10']	   = ""; */
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;
				   
	   /*
	   case 38: // Thingamejigs - Boybandz
	   
	      $record = array();
			$record['ordernumber'] 	= $id;
			$record['price']		   = $_POST['price'];
			$record['quantdesc']	   = $_POST['quantdesc'];
			$record['type']			= $type;
			$record['text1']			= $_POST['name'];
		   $record['text2']			= $_POST['background_colour'];
			$record['text3']			= $_POST['icon_1'];		
			$record['text4']			= $_POST['icon_2'];		
			$record['text5']			= $_POST['icon_3'];		
			$record['text6']			= $_POST['icon_4'];		
			$record['text7']			= $_POST['icon_5'];		
			$record['text8']			= "";
			$record['text9']			= "";
			$record['text10']	   = "";
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;
			
      case 37: // Thingamejigs - Collars
	   
	      $record = array();
			$record['ordernumber'] 	= $id;
			$record['price']		   = $_POST['price'];
			$record['quantdesc']	   = $_POST['quantdesc'];
			$record['type']			= $type;
			$record['text1']			= $_POST['name'];
		   $record['text2']			= $_POST['background_colour'];
			$record['text3']			= $_POST['icon_1'];		
			$record['text4']			= $_POST['icon_2'];		
			$record['text5']			= $_POST['icon_3'];		
			$record['text6']			= $_POST['icon_4'];		
			$record['text7']			= $_POST['icon_5'];		
			$record['text8']			= "";
			$record['text9']			= "";
			$record['text10']	   = "";
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;	
				   
	   case 36: // Thingamejigs - Name Bracelet
	   
	      $record = array();
			$record['ordernumber'] 	= $id;
			$record['price']		   = $_POST['price'];
			$record['quantdesc']	   = $_POST['quantdesc'];
			$record['type']			= $type;
			$record['text1']			= $_POST['name'];
		   $record['text2']			= $_POST['background_colour'];
			$record['text3']			= $_POST['icon_1'];		
			$record['text4']			= $_POST['icon_2'];		
			$record['text5']			= $_POST['icon_3'];		
			$record['text6']			= $_POST['icon_4'];		
			$record['text7']			= $_POST['icon_5'];		
			$record['text8']			= "";
			$record['text9']			= "";
			$record['text10']	   = "";
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;	
			
	   */
		case 35: // Itty Bitty Pack
			
			list($price, $notused)= getProductPricing($type, $_COOKIE['currency']);
			
			// get the order details from the wizard $_SESSION variables
			/*
			CSV logic is : vinyl, mini-vinyl, Zip-de-do, shoe dot, iron-on
			$text1 = name (text)
			$text2 = phone (text)
			$text3 = picture (int)
			$text4 = background colour (int)
			$text5 = font colour (1 = black, 2 = white)
			$text6 = split name to two lines ('','on')
			$text7 = tags and bands (letter)
			$text8 = perm or semi-perm ironons (0,1)
			$text9 = show phone boolean (0,1)
			$text10 = show picture boolean (0,1)
			*/
			$record = array();
			$record['ordernumber'] 	= $id;
			$record['price']				= $price;
			$record['quantdesc']	= $_POST['quantdesc'];
			$record['type']				= $type;
			$record['text1']			= $_POST['name'].",".$_POST['name'].",".$_POST['name'];
			$record['text2']			= $_POST['phone'].",".$_POST['phone'].",".$_POST['phone'];			
			$record['text3']			= $_POST['pic'].",".$_POST['pic'].",".$_POST['pic'].",".$_POST['pic'].",".$_POST['pic'];
			$record['text4']			= $_POST['background_colour'].",".$_POST['background_colour'].",".$_POST['background_colour'].",".$_POST['background_colour'].",".$_POST['background_colour'];
			$record['text5']			= $_POST['font_colour'].",".$_POST['font_colour'].",".$_POST['font_colour'].",1,1";
			$record['text6']			= "0,0,0,0,0";
			$record['text7']			= "0,0,0,".$_POST['ziptag_pic'].",".$_POST['identiband_pic'];
			$record['text8']			=  "0,0,0,0,0";
			$record['text9']			= "1,1,1,1,1";
			//$record['text10']			= ($_POST['pic']!="none"?1:0).",".($_POST['pic']!="none"?1:0).",".($_POST['pic']!="none"?1:0).",".($_POST['pic']!="none"?1:0).",".($_POST['pic']!="none"?1:0);
			$record['text10']			= $_POST['picon'].",".$_POST['picon'].",".$_POST['picon'].",0,0";
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;	
		case 34: // Maxi Pack
			
			list($price, $notused)= getProductPricing($type, $_COOKIE['currency']);
			
			// get the order details from the wizard $_SESSION variables
			/*
			CSV logic is : vinyl, mini-vinyl, Zip-de-do, shoe dot, iron-on
			$text1 = name (text)
			$text2 = phone (text)
			$text3 = picture (int)
			$text4 = background colour (int)
			$text5 = font colour (1 = black, 2 = white)
			$text6 = split name to two lines ('','on')
			$text7 = tags and bands (letter)
			$text8 = perm or semi-perm ironons (0,1)
			$text9 = show phone boolean (0,1)
			$text10 = show picture boolean (0,1)
			*/
			$record = array();
			$record['ordernumber'] 	= $id;
			$record['price']				= $price;
			$record['quantdesc']	= $_SESSION['maxi_pack']['quantdesc'];
			$record['type']				= $type;
			$record['text1']				= $_SESSION['maxi_pack1_name'].",".$_SESSION['maxi_pack1_name'].",".$_SESSION['maxi_pack1_name'].",".$_SESSION['maxi_pack1_name'].",".$_SESSION['maxi_pack1_name'];
			if((int)$_SESSION['maxi_pack1_split'] == 1){
				// do the split, so remove the phone number from vinyl, mini-vinyl and ironon
				$record['text2']			= ",,".$_SESSION['maxi_pack1_phone'].",".$_SESSION['maxi_pack1_phone'].",";			
			} else {
				$record['text2']			= $_SESSION['maxi_pack1_phone'].",".$_SESSION['maxi_pack1_phone'].",".$_SESSION['maxi_pack1_phone'].",".$_SESSION['maxi_pack1_phone'].",".$_SESSION['maxi_pack1_phone'];
			}
			$record['text3']				= $_SESSION['maxi_pack1_pic'].",".$_SESSION['maxi_pack1_pic'].",".$_SESSION['maxi_pack1_pic'].",".$_SESSION['maxi_pack1_pic'].",".$_SESSION['maxi_pack1_pic'].",".$_SESSION['maxi_pack1_pic'];
			$record['text4']				= $_SESSION['maxi_pack1_background_colour'].",".$_SESSION['maxi_pack1_background_colour'].",".$_SESSION['maxi_pack1_background_colour'].",".$_SESSION['maxi_pack1_background_colour'].",".$_SESSION['maxi_pack3_background_colour'];
			$record['text5']				= $_SESSION['maxi_pack1_font_colour'].",".$_SESSION['maxi_pack1_font_colour'].",1,1,1";
			$record['text6']				= $_SESSION['maxi_pack1_split'].",".$_SESSION['maxi_pack1_split'].",".$_SESSION['maxi_pack1_split'].",".$_SESSION['maxi_pack1_split'].",".$_SESSION['maxi_pack1_split'];
			$record['text7']				= $_POST['maxi_pack_identitag_pic'].",".$_POST['maxi_pack_identiband_pic'].",".$_POST['maxi_pack_ziptag_pic'];
			$record['text8']				=  "0,0,".($_SESSION['maxi_pack3_vsemiPermanent']?"1":"0");
			$record['text9']				= "1,1,1,1,1";
			$record['text10']				= ($_SESSION['maxi_pack1_pic']!="none"?1:0).",".($_SESSION['maxi_pack1_pic']!="none"?1:0).",".($_SESSION['maxi_pack1_pic']!="none"?1:0).",".($_SESSION['maxi_pack1_pic']!="none"?1:0).",".($_SESSION['maxi_pack1_pic']!="none"?1:0);

			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
			break;
		case 33: // Book Labels
			$prodid = (int)$type;
			list($price, $notused) = getProductPricing($prodid, $_COOKIE['currency']);
	
			/*
			extract($_POST, EXTR_PREFIX_SAME, "pst"); // Generate names
			$designArray = array($design0, $design1, $design2, $design3,$design4); 
			for ($i=0; $i<5; $i++)
			{
				if (strlen($designArray[$i]) < 1)
				{
					$designArray[$i] = "0";
				}
			}
			*/
			
			$sql_bl = "SELECT *
							FROM product
							WHERE id = ".$type;
			$result_bl = db_query($sql_bl) or die (mysql_error());
			$record_bl = db_fetch_array($result_bl);

			$unitQuant  = $record_bl['unitQuant'];
			$productName = $record_bl['productName'];
			$quantity  = (int)$_POST['chosenQuant']+1;
			$cost = $price*$quantity;
			
			$record['ordernumber'] 	= $id;
			$record['price']					= $cost;
			$record['pic']					= $_POST['chosenPic'];
			$record['typedetail']			= $_POST['chosenQuant'];
			$record['quantdesc']			= $quantity*(int)$unitQuant." ".$productName." for ".$_POST['symbol'].$cost;
			$record['type']					= $type;
			$record['text1']				= $_POST['text1'];
			$record['colours']				= $_POST['background_colour'];
			
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
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error()."<BR />".$sql, true);
			}	
		break;
		case 21:
			// Colour My World Pack!
			$quantity = explode(";", $_POST["quantity"]);
			$price = $quantity[0];
			$quantdesc = $quantity[1];
			// quantity desc
			product_details($type, $_COOKIE['currency'], &$product);
			$price_formatted = (((int)form_param('chosenQuant') + 1) * (int)$product['unitQuant']) . " " . $product['productName'] . " for " . $product['symbol'].(((int)form_param('chosenQuant') + 1)*$product['price']);
			$price = ((int)form_param('chosenQuant') + 1) * $product['price'];
			
			// pack sub type;
			if((int)form_param('chosenLabel') == 1)
			{
				// mini labels.
				$text5=3;
			}
			elseif((int)form_param('chosenLabel') == 2)
			{
				// pencil labels
				$text5 = 5;
			}
			
			// get identitag ID
			db_get_field("SELECT data_identitag_id FROM data_identitag WHERE data_identitag_code='" . db_escape_string(form_param('identitag_code')) . "'", &$data_identitag_id);
			
			$record['ordernumber'] 			= $id;
			$record['price']				= $price;
			$record['quantdesc']			= $price_formatted;
			$record['type']					= $type;
			$record['pic']					= (int)$pic;
			$record['picon']				= (int)$picon;
			$record['text1']				= $text1;	// name
			$record['text2']				= $text2;	// phone
			$record['text5'] 				= (int)$text5;
			$record['colours']				= (int)form_param('background_colour'); // rainbox colours
			$record['font']					= (int)form_param('font');
			$record['split']				= (int)form_param('split');
			$record['data_identitag_id'] 	= (int)$data_identitag_id;			// identitag
			$record['data_colour_id']		= (int)form_param('ironon_colour');			// iron on colours
			$record['data_font_colour_id']	= (int)form_param('font_colour');		// font colour.
		
		
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error(), true);
			}
			break;
		case 20:
		case 28:
		case 29:
		case 19:
		case 5:
		case 3:
			// quantity desc
			product_details($type, $_COOKIE['currency'], &$product);
			
			if($_POST["type"]!=28 && $_POST["type"]!=29){
				$price_formatted = (((int)form_param('chosenQuant') + 1) * (int)$product['unitQuant']) . " " . $product['productName'] . " for " . $product['symbol'].(((int)form_param('chosenQuant') + 1)*$product['price']);
				$price = ((int)form_param('chosenQuant') + 1) * $product['price'];
			}
			else {
				$price_formatted = $_POST['quantdesc'];
				$price = $_POST['price'];
			}
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
			$record['data_colour_id']		= (int)form_param('background_colour');			// iron on colours
			$record['data_font_colour_id']	= (int)form_param('font_colour');		// font colour.
			
			$result = db_insert('basket_items', $record, &$insert_id);
			if($result == false)
			{
				display_error('sql error: ' . mysql_error(), true);
			}
			break;
		
		default:
			$quantDesc = str_replace("EURO", "€", $_POST["quantdesc"]);
		
			if($_POST["text2"]=="Ph:" || $_POST["text2"]=="Ph: "){
				$text2="";
			}else{
				$text2=$_POST["text2"];
			}
			if($_POST["type"]==13){
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type)"
						." VALUES (".$id.", ".$_POST["price"].", '".$quantDesc."', 13)";
			}
			elseif($_POST["type"]==15){ 
				// gift certificates
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type)"
						." VALUES (".$id.", ".$_POST["price"].", '".$quantDesc."', 15)";
			}
			
			
			
			
			
			
			
			
			
			
			// identitags with reverse text
			elseif(($_POST["type"] == 14) && ($_POST["normal"] == "no")){ 
			
				$identitagArray = array();
				$datanum = 0;
				
				// load all tag codes into array
				$datasql = "SELECT * FROM data_identitag";
				$dataresult = mysql_query($datasql) or die (mysql_error());
				while ($datarow = mysql_fetch_assoc($dataresult))
				{
					$identitagArray[$datanum] = $datarow['data_identitag_code']; 
					$datanum++;
				}
				$xsize = sizeof($identitagArray);
				
				// Get tag codes from form
				$varArray[0] = $_POST["text1"];
				$varArray[1] = $_POST["text2"];
				$varArray[2] = $_POST["text3"];
				$varArray[3] = $_POST["text4"];
				$varArray[4] = $_POST["firstLine1"];
				$varArray[5] = $_POST["firstLine2"];
				$varArray[6] = $_POST["secondLine1"];
				$varArray[7] = $_POST["secondLine2"];
				$varArray[8] = $_POST["thirdLine1"];
				$varArray[9] = $_POST["thirdLine2"];
				$varArray[10] = $_POST["fourthLine1"];
				$varArray[11] = $_POST["fourthLine2"];
				
				$bad_code="no";
				
				// Check if they are valid codes then add to array
				for ($k=0; $k<4; $k++)
				{
					// error check code return if invalid
					$check_value = strtoupper($varArray[$k]);	
					if ($check_value !='' ) 
					{
						if (!in_array($check_value,$identitagArray))
						{
							$bad_code="yes";
						}
					}
				}
	
				$count = 4;
				$found = "no";
				for ($i=0; $i<$count; $i++)
				{
					for ($x=0; $x<=$xsize; $x++){
						if (strtoupper($varArray[$i]) == $identitagArray[$x] && strtoupper($varArray[$i])!='') 
						{
							$newArray[] = $varArray[$i];
							$found = "yes";
						}
					}
				}
				// check if no codes entered
				if ($found == "no")
				{
					Header("Location: order_identitags2.php?error=No+codes+entered");
					exit;
				}
				
				if($bad_code=="yes")
				{
					Header("Location: order_identitags2.php?error=Invalid+code+entered");
					exit;
				}
				
				// price
				$newsize = sizeof($newArray);
				$priceval = $newsize++;
				switch ($priceval) {
					case 1: $price = $_POST['price1'];
					break;
					case 2: $price = $_POST['price2'];
					break;
					case 3: $price = $_POST['price3'];
					break;
					case 4: $price = $_POST['price4'];
					break;
				}
			
			$theprice = ereg_replace("[^0-9]", "", $price); 
			
			// add 2 to the price
			$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
			$result = mysql_query($mysql) or die ("sql error");
			$row = mysql_fetch_assoc($result) or die ("sql error");
			
			$reverseprice = $row["reverse_text_price"];
			
			
			if ($_POST["firstLine1"]!='')
				$addprice=$reverseprice;
			if ($_POST["secondLine1"]!='')
				$addprice=($reverseprice*2);
			if ($_POST["thirdLine1"]!='')
				$addprice=($reverseprice*3);
			if ($_POST["fourthLine1"]!='')
				$addprice=($reverseprice*4);

			$querye = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
			$resulte = mysql_query($querye);
			if(!$resulte) error_message(sql_error());
			$cur = mysql_fetch_assoc($resulte);
			
			//quantdesc
			$price.=" + ".$cur['symbol'].$addprice;
			
			$theprice += $addprice; 
			
			settype ( $theprice , "string" );
			
			
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, text1, text2, text3, text4, text5, text6, text7, text8, text9, text10, text11, text12)"
				." VALUES (".$id.", ".$theprice.",
							 '".$price."',
							  '".$_POST["type"]."'";
				for ($i=0; $i<12; $i++)
				{
					$query = $query . "".",'".$varArray[$i]."'";
				}								  
					$query = $query.")";
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			// identitage normal
			elseif(($_POST["type"] == 14) && ($_POST["normal"] == "yes"))
			{		
				$identitagArray = array();
				
				$datanum = 0;
				
				// load all tag codes into array
				$datasql = "SELECT * FROM data_identitag";
				$dataresult = mysql_query($datasql) or die (mysql_error());
				while ($datarow = mysql_fetch_assoc($dataresult))
				{
					$identitagArray[$datanum] = $datarow['data_identitag_code']; 
					$datanum++;
				}
				$xsize = sizeof($identitagArray);
				
				// Get tag codes from form
				$varArray[0] = $_POST["text1"];
				$varArray[1] = $_POST["text2"];
				$varArray[2] = $_POST["text3"];
				$varArray[3] = $_POST["text4"];
				
				$bad_code="no";
				
				// Check if they are valid codes then add to array
				for ($k=0; $k<4; $k++)
				{
					// error check code return if invalid
					$check_value = strtoupper($varArray[$k]);	
					if ($check_value !='' ) 
					{
						if (!in_array($check_value,$identitagArray))
						{
							$bad_code="yes";
						}
					}
				}
	
				$count = 4;
				$found = "no";
				for ($i=0; $i<$count; $i++)
				{
					for ($x=0; $x<=$xsize; $x++){
						if (strtoupper($varArray[$i]) == $identitagArray[$x] && strtoupper($varArray[$i])!='') 
						{
							$newArray[] = $varArray[$i];
							$found = "yes";
						}
					}
				}
				// check if no codes entered
				if ($found == "no")
				{
					Header("Location: order_identitags.php?error=No+codes+entered");
					exit;
				}
				
				if($bad_code=="yes")
				{
					Header("Location: order_identitags.php?error=Invalid+code+entered");
					exit;
				}				
					
				// price
				$newsize = sizeof($newArray);
				$priceval = $newsize++;
				switch ($priceval) {
					case 1: $price = $_POST['price1'];
					break;
					case 2: $price = $_POST['price2'];
					break;
					case 3: $price = $_POST['price3'];
					break;
					case 4: $price = $_POST['price4'];
					break;
				}
				
				$price_float = ereg_replace("[^0-9]", "", $price); 
				
				// quantitiy description
				$quantdescription = $priceval." Identitags for ".$price;

				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, text1, text2, text3, text4)"
				." VALUES (".$id.", ".$price_float.",
							 '".$quantdescription."',
							  '".$_POST["type"]."'";
					for ($i=0; $i<=3; $i++)
					{
						$query = $query . "".",'".$newArray[$i]."'";
					}			  
					$query = $query.")";
				
				//echo $query."<BR />";

			}
			
			// Address Labels
			elseif($_POST["type"]==24 || $_POST["type"]==25 || $_POST["type"]==26)
			{
				$varArray[0] = $_POST["text1"];
				$varArray[1] = $_POST["text2"];
				$varArray[2] = $_POST["text3"];
				$varArray[3] = $_POST["text4"];

				for ($i=0; $i<4; $i++)
				{
					if ($varArray[$i] == 'undefined')
						$varArray[$i] = '';
				}
				
				$thequantdesc = "Address Labels ".$_POST["quantdesc"];
			
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, text1, text2, text3, text4, pic, colours)"
				." VALUES (".$id.", ".$_POST["price"].",
							 '".$thequantdesc."',
							  '".$_POST["type"]."'";
				$query = $query . "".",'".$varArray[0]."'";
				$query = $query. ",'".$varArray[1]."'";
				$query = $query. ",'".$varArray[2]."'";					
				$query = $query. ",'".$varArray[3]."'";
				$query = $query. ",'".$_POST["pic"]."'";
				$query = $query. ",'".$_POST["colours"]."'";			  
				$query = $query.")";
			}
			
			elseif($_POST['type']==18) // allergy alerts
			{
		
				list($price, $quantDesc)=getProductPricing($_POST['type'], $_COOKIE['currency']);
		
				$text5=$_POST['pack1'];
				$gift=0;
		
				// kidsName
				$text1 = rawurlencode(stripslashes($_POST['text1']));
				
				// kidsPhone
				if($_POST["pack1_text2"]=="Ph:" || $_POST["text2"]=="Ph: "){
					$text2="";
				}else{
					$text2=stripslashes($_POST["text2"]);
				}
				$typedetail=0;
		
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split, data_font_colour_id)"
				." VALUES (".$id.", ".$price.", '".$quantDesc."', ".$_POST["type"].", ".$typedetail.", ".$_POST["pic"].", '".$text1."', '"
				.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$text5 ."', '".$_POST['colours']."', ".$_POST["font"].", ".$_POST["picon"].", '".$gift."', ".$_POST["split"].", ".$_POST["font_colour"].")";
			}
			// vinyl labels, new baby packs, starter packs, birthday packs, mixed packs
			elseif($_POST['type']==1 || $_POST['type']==16 || $_POST['type']==10 || $_POST['type']==11 || $_POST['type']==12)
			{
				if ($_POST['type']==10){
					$typedetail = $_POST["typedetail"];
				}  
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, text6, colours, font, picon, gift, split, data_font_colour_id)"
				." VALUES (".$id.", ".$_POST["price"].", '".$quantDesc."', ".$_POST["type"].", ".$typedetail.", ".$_POST["pic"].", '".$_POST["text1"]."', '"
				.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$_POST["text5"]."', '".$_POST["text6"]."','".$colours."', ".$_POST["font"].", ".$_POST["picon"].", ".$_POST["gift"].", ".$_POST["split"].",".$_POST["font_colour"].")";
				//echo $query;
			}else{
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split)"
				." VALUES (".$id.", ".$_POST["price"].", '".$quantDesc."', ".$_POST["type"].", ".$typedetail.", ".$_POST["pic"].", '".$_POST["text1"]."', '"
				.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$_POST["text5"]."', '".$colours."', ".$_POST["font"].", ".$_POST["picon"].", ".$_POST["gift"].", ".$_POST["split"].")";
		
			}
			$result = mysql_query($query) or die(sql_error().' function 1');
			if(!$result) error_message(sql_error(),'add to order 1');
	}
}

function getProductPricing($productID, $currency)
{
	// get products pricing.
	$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId='{$productID}' AND a.productId=c.id AND a.currencyInt='{$currency}' AND a.currencyInt=b.id";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error(),'add to order 2');
		
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
	$text1 = rawurlencode(stripslashes($_POST['pack1_text1'])) ."," .rawurlencode(stripslashes($_POST['pack2_text1']));
	
	// kidsPhone
	if($_POST["pack1_text2"]=="Ph:" || $_POST["pack1_text2"]=="Ph: "){
		$phone1="";
	}else{
		$phone1=stripslashes($_POST["pack1_text2"]);
	}
	if($_POST["pack2_text2"]=="Ph:" || $_POST["pack2_text2"]=="Ph: "){
		$phone2="";
	}else{
		$phone2=stripslashes($_POST["pack2_text2"]);
	}
	$text2 = rawurlencode($phone1) ."," .rawurlencode($phone2);
	
	$text3=$text4="";
	
	
	//packType
	if((int)$_POST['pack1'] == 2){
		if((int)$_POST['pack1_iron_type'] == 0){
			//default to 2
			$pack1_value= 2;		
		} else {
			$pack1_value= (int)$_POST['pack1_iron_type'];
		}
	} else {
		$pack1_value = (int)$_POST['pack1'];
	}

	if((int)$_POST['pack2'] == 2){
		if((int)$_POST['pack2_iron_type'] == 0){
			//default to 2
			$pack2_value= 2;		
		} else {
			$pack2_value = (int)$_POST['pack2_iron_type'];
		}
	} else {
		$pack2_value = (int)$_POST['pack2'];
	}
	
	$text5 = "{$pack1_value},{$pack2_value}";
	
	//pic
	$pic = "{$_POST['pack1_pic']},{$_POST['pack2_pic']}";
	$picon = "{$_POST['pack1_picon']},{$_POST['pack2_picon']}";
	
	//font
	$font = "{$_POST['pack1_font']},{$_POST['pack2_font']}";
	
	//split
	$split = "{$_POST['pack1_split']},{$_POST['pack2_split']}";
	
	// colours
	//echo $_POST['pack1_colours'];
	$colours = "{$_POST['pack1_colours']},{$_POST['pack2_colours']}";
	
	//font colours
	$font_colours = "{$_POST['pack1_font_colour']},{$_POST['pack2_font_colour']}";
	
	
	$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split, text10, text11, text12)"
		." VALUES (".$id.", ".$price.", '{$quantDesc}', ".$_POST["type"].", 0, '{$pic}', '{$text1}', '{$text2}', '{$text3}', '{$text4}', '{$text5}', '{$colours}', '{$font}', '{$picon}', 0, '{$split}', '{$font_colours}', ".$_POST["text11"].",".$_POST["text12"].")";
	//echo $query;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error(),'add to order 3');

}

if($_POST["type"]==7){
	$typedetail=0;
	if($_POST["pack1"]==1){
		$colours = 2;
		insertItem();
	}
	if($_POST["pack2"]==1){
		$colours = 1;
		insertItem();
	}
}/*else if($_POST["type"]==11){
	$typedetail = $_POST["typedetail"];
	insertItem();
}*/else if($_POST["type"]=="17"){
	insertSharedPack();
}else{
	// type 15 in here, gift certificates.

	$typedetail=0;
	$colours = $_POST["colours"];
	insertItem();
}

//print_r($_POST);

$query = "UPDATE orders SET finished='".date("Y-m-d H:i:s", time() + 36000)."' WHERE id=".$id;
$result = mysql_query($query);
//echo "bad code = ".$bad_code."<BR />";
if(!$result) error_message(sql_error(),'add to order 4');

if($result && $type != 22 && $type != 23) {
	header("location: item_added.php"); 
	exit;
}
else{
	header("location: item_added.php?id=ziptag"); 
	exit;
}
?>
