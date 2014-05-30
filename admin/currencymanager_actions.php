<?
$includeabove=true;
include("../useractions.php");
include("currencymanager_functions.php");
linkme();
session_start();
$user_section_id = 6;
require_once("./security.php");
check_access($user_section_id);


$prods = getProducts();
$curr = getCurrencies();

switch($_POST["action"]){
	case "updateprices":
	updateprices();
	break;
	case "updatepostagegift":
	updatepostagegift();
	break;
	case "updateidentireverse":
	updateidentireverse();
	break;
	case "updatezip3":
	updatezip3();
	break;
	case "updatezip5":
	updatezip5();
	break;
	case "updateEx":
	updateEx();
	break;
	
}

function updateEx(){
  get_ex_rate();
  header("location:currencymanager.php");
}


function updatepostagegift(){
	global $curr;
	for($j=0; $j<count($curr); $j++){
		$query = "UPDATE currencies SET postage=".$_POST["p".$curr[$j]['id']].", expresspost=".$_POST["po".$curr[$j]['id']].", freeGift=".$_POST["g".$curr[$j]['id']].", minimumOrder=".$_POST["m".$curr[$j]['id']].", fundraisers=".((isset($_POST["f".$curr[$j]['id']]))?"1":"0")." ,postage2=".$_POST["pp".$curr[$j]['id']].",postage3=".$_POST["ppp".$curr[$j]['id']]."  WHERE id=".$curr[$j]['id'];
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
	}
	header("location:currencymanager.php");
}


function updateprices(){
	global $curr, $prods;
	for($j=0; $j<count($curr); $j++){
		// bag tags special case
		if($_POST["productId"]==6){
			for($k=1; $k<3; $k++){
				$query = "SELECT * FROM prices_bagtags WHERE currencyInt=".$curr[$j]['id']." AND multiplier=".$k;
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
				
				if(mysql_num_rows($result)>0){
					while($qdata = mysql_fetch_array($result)){
						$id = $qdata["id"];
					}
					$query = "UPDATE prices_bagtags SET price=".$_POST["c".$curr[$j]['id']."~".$k]." WHERE id=".$id;
				}else{
					$query = "INSERT INTO prices_bagtags (price, currencyInt, multiplier) VALUES (".$_POST["c".$curr[$j]['id']."~".$k].", ".$curr[$j]['id'].", ".$k.")";
				}
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
			}
		// identitags special case
		}else if($_POST["productId"]==14){
			for($k=1; $k<5; $k++){
				$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$curr[$j]['id']." AND multiplier=".$k;
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
				
				if(mysql_num_rows($result)>0){
					while($qdata = mysql_fetch_array($result)){
						$id = $qdata["id"];
					}
					$query = "UPDATE prices_identitags SET price=".$_POST["c".$curr[$j]['id']."~".$k]." WHERE id=".$id;
				}else{
					$query = "INSERT INTO prices_identitags (price, currencyInt, multiplier) VALUES (".$_POST["c".$curr[$j]['id']."~".$k].", ".$curr[$j]['id'].", ".$k.")";
				}
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
			}
	   }else if($_POST["productId"]>=36 && $_POST["productId"]<=40){
	     for($k=1; $k<8; $k++){
		    if(isset($_POST["c".$curr[$j]['id']."~".$k]) && $_POST["c".$curr[$j]['id']."~".$k] != "" ) {
		    
				$query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$curr[$j]['id']." AND item='".$k."' ";
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
				
				if(mysql_num_rows($result)>0){
					while($qdata = mysql_fetch_array($result)){
						$id = $qdata["id"];
					}
					$query = "UPDATE prices_thingamejig SET price=".$_POST["c".$curr[$j]['id']."~".$k]." WHERE id=".$id;
				}else{
					$query = "INSERT INTO prices_identitags (price, currencyInt, item) VALUES (".$_POST["c".$curr[$j]['id']."~".$k].", ".$curr[$j]['id'].", ".$k.")";
				}
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
				
	       }
		  }
		}else{
			$query = "SELECT * FROM prices WHERE currencyInt=".$curr[$j]['id']." AND productId=".$_POST["productId"];
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			if(mysql_num_rows($result)>0){
				while($qdata = mysql_fetch_array($result)){
					$id = $qdata["id"];
				}
				$query = "UPDATE prices SET price=".$_POST["c".$curr[$j]['id']]." WHERE id=".$id;
			}else{
				$query = "INSERT INTO prices (price, currencyInt, productId) VALUES (".$_POST["c".$curr[$j]['id']].", ".$curr[$j]['id'].", ".$_POST["productId"].")";
			}
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
		}
	}
	header("location:currencymanager.php");
}

function updateidentireverse()
{
	if($_POST["reverse_identi"]!='')
	{
		$query = "UPDATE prices_reverse_text SET reverse_text_price=".$_POST["reverse_identi"]." WHERE prod_id=14";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
	}
	
	header("location:currencymanager.php");
}
function updatezip3()
{
	if($_POST["zip3"]!='')
	{
		$query = "UPDATE prices_reverse_text SET reverse_text_price=".$_POST["zip3"]." WHERE prod_id=22";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
	}
	
	header("location:currencymanager.php");
}
function updatezip5()
{
	if($_POST["zip5"]!='')
	{
		$query = "UPDATE prices_reverse_text SET reverse_text_price=".$_POST["zip5"]." WHERE prod_id=23";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
	}
	
	header("location:currencymanager.php");
}


?>
