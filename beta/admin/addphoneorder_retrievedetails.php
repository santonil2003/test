<?
include("../useractions.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

$query = "SELECT customer FROM orders WHERE id=".$_POST["orderid"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata=mysql_fetch_array($result)){
	$customer = $qdata["customer"];
}

if($_POST["firstname"]=="" || $_POST["phonenumber"]==""){
	header("location:addphoneorder_customerdetails.php?retrieved=false");
	exit;
}else{
	$query = "SELECT * FROM customers WHERE firstname='".mysql_real_escape_string($_POST["firstname"])."' AND homephone='".mysql_real_escape_string($_POST["phonenumber"])."'";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	if(mysql_num_rows($result)==0){
		header("location:addphoneorder_customerdetails.php?retrieved=false");
		exit;
	}else{
		while($qdata=mysql_fetch_array($result)){
			$query = "UPDATE customers SET"
			." firstname='".$qdata["firstname"]."',"
			." surname='".mysql_real_escape_string($qdata["surname"])."',"
			." address='".stripslashes($qdata["address"])."',"
			." suburb='".$qdata["suburb"]."',"
			." postcode='".$qdata["postcode"]."',"
			." state='".$qdata["state"]."',"
			." country='".$qdata["country"]."',"
			." address_cust='".stripslashes($qdata["address_cust"])."',"
			." suburb_cust='".$qdata["suburb_cust"]."',"
			." postcode_cust='".$qdata["postcode_cust"]."',"
			." state_cust='".$qdata["state_cust"]."',"
			." country_cust='".$qdata["country_cust"]."',"
			." emailadd='".$qdata["emailadd"]."',"
			." homephone='".$qdata["homephone"]."',"
			." postage_option='".$qdata["postage_option"]."',"
			." workphone='".$qdata["workphone"]."',"
			." mobilephone='".$qdata["mobilephone"]."',"
			." referral='".$qdata["referral"]."',"
			." referralcode='".$qdata["referralcode"]."'"
			." WHERE id=".$customer;
		}
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		header("location:addphoneorder_customerdetails.php?retrieved=true");
		exit;
	}
}
?>