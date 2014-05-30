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


$query = "UPDATE customers SET {$set_string} firstname='".mysql_real_escape_string($_POST["firstname"])."',"
."surname='".mysql_real_escape_string($_POST["surname"])."',"
."del_name='".mysql_real_escape_string($_POST["del_name"])."',"
."address='".mysql_real_escape_string($_POST["address"])."',"
."suburb='".mysql_real_escape_string($_POST["suburb"])."',"
."postcode='".mysql_real_escape_string($_POST["postcode"])."',"
."state='".mysql_real_escape_string($_POST["state"])."',"
."country='".mysql_real_escape_string($_POST["country"])."',"
."oseas=".mysql_real_escape_string($_POST["oseas"]).","
."emailadd='".$_POST["emailadd"]."',"
."homephone='".$_POST["homephone"]."',"
."workphone='".$_POST["workphone"]."',"
."mobilephone='".$_POST["mobilephone"]."',"
."specialreqs='".mysql_real_escape_string($_POST["specialreqs"])."',"
."notes='".mysql_real_escape_string($_POST["notes"])."',"
."hear_about='".mysql_real_escape_string($_POST["hear_about"])."',"
."referralcode='".$_POST["referralcode"]."',"
."paymentmeth='".$_POST['paymentmeth']."'"
." WHERE id=".$_POST["customer"];


$result = mysql_query($query);
if(!$result) error_message(sql_error());

// change the finished date of the order hasn't been closed
$sql = "SELECT *
			FROM orders
			WHERE id = ".(int)$_POST["orderid"];
$result = mysql_query($sql) or die (error_message(sql_error()));
if(mysql_num_rows($result) > 0){
	$record = mysql_fetch_array($result);
	if((int)$record['id'] > 0 && (int)$record['status'] == 'pending'){ 
		$query = "UPDATE orders SET finished='".date("Y-m-d H:i:s")."' WHERE id=".$_POST["orderid"];
		$result = mysql_query($query);
		if(!$result){
			error_message(sql_error());
		}
	}
}

header("location:viewitem.php?id=".$_POST["orderid"]."&startrecord=".$_POST["startrecord"]."&showperpage=".$_POST["showperpage"]."&edited=true");	

?>