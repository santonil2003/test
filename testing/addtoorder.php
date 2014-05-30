<?
include("useractions.php");
session_start();
$id = checkOrderId(true);
//debug_showvar('shauns test');
//debug_showvar($_POST);
//exit;


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
		case 19:
		case 5:
		case 3:
			// quantity desc
			product_details($type, $_COOKIE['currency'], &$product);
			$price_formatted = (((int)form_param('chosenQuant') + 1) * (int)$product['unitQuant']) . " " . $product['productName'] . " for " . $product['symbol'].(((int)form_param('chosenQuant') + 1)*$product['price']);
			$price = ((int)form_param('chosenQuant') + 1) * $product['price'];
			
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
			elseif(($_POST["type"]==14) && ($_POST["firstLine1"] != "")){ 
			
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
			for ($i=0; $i<12; $i++)
			{
				if ($varArray[$i] == 'undefined')
					$varArray[$i] = '';
			}
			
			
			// add 2 to the price
			$theprice = $_POST["price"];
			settype ( $theprice , "integer" );
			
			$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
			$result = mysql_query($mysql) or die ("sql error");
			$row = mysql_fetch_assoc($result) or die ("sql error");
			
			$reverseprice = $row["reverse_text_price"];
			
			
			if ($_POST["firstLine1"]!='undefined')
				$addprice=$reverseprice;
			if ($_POST["secondLine1"]!='undefined')
				$addprice=($reverseprice*2);
			if ($_POST["thirdLine1"]!='undefined')
				$addprice=($reverseprice*3);
			if ($_POST["fourthLine1"]!='undefined')
				$addprice=($reverseprice*4);
			
			$theprice += $addprice; 
			
			settype ( $theprice , "string" );
			
			
			$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, text1, text2, text3, text4, text5, text6, text7, text8, text9, text10, text11, text12)"
				." VALUES (".$id.", ".$theprice.",
							 '".$_POST["quantdesc"]."',
							  '".$_POST["type"]."'";
				for ($i=0; $i<12; $i++)
				{
					$query = $query . "".",'".$varArray[$i]."'";
				}								  
					$query = $query.")";
			}
			
			// identitage normal
			elseif(($_POST["type"]==14) && ($_POST["firstLine1"] == ""))
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
			
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, text1, text2, text3, text4)"
				." VALUES (".$id.", ".$_POST["price"].",
							 '".$_POST["quantDesc"]."',
							  '".$_POST["type"]."'";
					$query = $query . "".",'".$varArray[0]."'";
					$query = $query. ",'".$varArray[1]."'";
					$query = $query. ",'".$varArray[2]."'";					
					$query = $query. ",'".$varArray[3]."'";			  
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
		
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split)"
				." VALUES (".$id.", ".$price.", '".$quantDesc."', ".$_POST["type"].", ".$typedetail.", ".$_POST["pic"].", '".$text1."', '"
				.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$text5 ."', '".$_POST['colours']."', ".$_POST["font"].", ".$_POST["picon"].", '".$gift."', ".$_POST["split"].")";
		
			}elseif($_POST['type']==1) // vinyl labels
			{
				$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split, data_font_colour_id)"
				." VALUES (".$id.", ".$_POST["price"].", '".$quantDesc."', ".$_POST["type"].", ".$typedetail.", ".$_POST["pic"].", '".$_POST["text1"]."', '"
				.$text2."', '".$_POST["text3"]."', '".$_POST["text4"]."', '".$_POST["text5"]."', '".$colours."', ".$_POST["font"].", ".$_POST["picon"].", ".$_POST["gift"].", ".$_POST["split"].",".$_POST["font_colour"].")";
			
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
	$text5 = "{$_POST['pack1']},{$_POST['pack2']}";
	
	
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
	
	
	$query = "INSERT INTO basket_items (ordernumber, price, quantdesc, type, typedetail, pic, text1, text2, text3, text4, text5, colours, font, picon, gift, split)"
		." VALUES (".$id.", ".$price.", '{$quantDesc}', ".$_POST["type"].", 0, '{$pic}', '{$text1}', '{$text2}', '{$text3}', '{$text4}', '{$text5}', '{$colours}', '{$font}', '{$picon}', 0, '{$split}')";
	
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
}else if($_POST["type"]==11){
	$typedetail = $_POST["typedetail"];
	insertItem();
}else if($_POST["type"]=="17"){
	insertSharedPack();
}else{
	// type 15 in here, gift certificates.

	$typedetail=0;
	$colours = $_POST["colours"];
	insertItem();
}



$query = "UPDATE orders SET finished='".date("Y-m-d H:i:s")."' WHERE id=".$id;
$result = mysql_query($query);
if(!$result) error_message(sql_error(),'add to order 4');


header("location: item_added.php"); 
exit;
?>