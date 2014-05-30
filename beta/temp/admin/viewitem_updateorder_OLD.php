<?

include("../common_db.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);


//Update price
$newprice = $_POST["upd_price"];
settype ( $newprice , "float" );
/*$newprice += $_POST["totalamount"];

$upquery = "UPDATE basket_items SET price = '$newprice' WHERE ordernumber=".$_POST["orderid"];*/
if ($_POST["upd_reason"] == "")
{
	$_POST["upd_reason"] = "none";
}


if($_POST["upd_price"]!=""){
	$upquery = "INSERT INTO basket_items (ordernumber, price,text1, quantdesc, type)"
	." VALUES (".$_POST["orderid"].", ".$newprice.", '".$_POST["upd_reason"]."', 'Additional amount', '666')";
	mysql_query($upquery) or die ("error updating price ".mysql_error());
}

$set_string = "";
if($_POST['changeToFinished']==1)
{
//	if($_POST['paymentmeth']==1){
//		$set_string = " approved='1', confirmed='confirmed', ";
//	}
//	else {
		$set_string = " confirmed='confirmed', ";
//	}

}


$query = "UPDATE customers SET {$set_string} firstname='".$_POST["firstname"]."',"
."surname='".$_POST["surname"]."',"
."address='".$_POST["address"]."',"
."suburb='".$_POST["suburb"]."',"
."postcode='".$_POST["postcode"]."',"
."state='".$_POST["state"]."',"
."country='".$_POST["country"]."',"
."oseas=".$_POST["oseas"].","
."emailadd='".$_POST["emailadd"]."',"
."homephone='".$_POST["homephone"]."',"
."workphone='".$_POST["workphone"]."',"
."mobilephone='".$_POST["mobilephone"]."',"
."specialreqs='".stripslashes($_POST["specialreqs"])."',"
."notes='".stripslashes($_POST["notes"])."',"
."hear_about='".$_POST["hear_about"]."',"
."referralcode='".$_POST["referralcode"]."',"
."paymentmeth='".$_POST['paymentmeth']."'"
." WHERE id=".$_POST["customer"];


$result = mysql_query($query);
if(!$result) error_message(sql_error());

$query = "UPDATE orders SET finished='".date("Y-m-d H:i:s")."' WHERE id=".$_POST["orderid"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

header("location:viewitem.php?id=".$_POST["orderid"]."&startrecord=".$_POST["startrecord"]."&showperpage=".$_POST["showperpage"]."&edited=true");

?>