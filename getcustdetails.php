<?php

include("useractions.php");
linkme();

$query = "SELECT customer FROM orders WHERE id=".$_POST["orderid"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());
while($qdata=mysql_fetch_array($result)){
	$customer = $qdata["customer"];
}

if($_POST["firstname"]=="" || $_POST["emailadd"]==""){
	header("location:order_form_ps.php?retrieved=false&orderid=".$_POST["orderid"]);
	exit;
}else{
	$query = "SELECT * FROM customers WHERE firstname='".trim($_POST["firstname"])."' AND emailadd='".trim($_POST["emailadd"])."'";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	if(mysql_num_rows($result)==0){
		header("location:order_form_ps.php?retrieved=false&orderid=".$_POST["orderid"]);//"&postageamount=".$_POST["postageamount"]."&postageoption=".$_POST["postageoption"]);
		exit;
	}else{
		while($qdata=mysql_fetch_array($result)){
			$query = "UPDATE customers SET"
			." oseas=".$qdata["oseas"].","
			." firstname='".mysql_real_escape_string($qdata["firstname"])."',"
			." surname='".mysql_real_escape_string($qdata["surname"])."',"
			." address='".mysql_real_escape_string($qdata["address"])."',"
			." suburb='".mysql_real_escape_string($qdata["suburb"])."',"
			." postcode='".$qdata["postcode"]."',"
			." state='".$qdata["state"]."',"
			." country='".$qdata["country"]."',"
			." address_cust='".mysql_real_escape_string($qdata["address_cust"])."',"
			." suburb_cust='".mysql_real_escape_string($qdata["suburb_cust"])."',"
			." postcode_cust='".$qdata["postcode_cust"]."',"
			." state_cust='".$qdata["state_cust"]."',"
			." country_cust='".$qdata["country_cust"]."',"
			." emailadd='".$qdata["emailadd"]."',"
			." homephone='".$qdata["homephone"]."',"
			." workphone='".$qdata["workphone"]."',"
			." mobilephone='".$qdata["mobilephone"]."',"
			." referral='".$qdata["referral"]."',"
			." referralcode='".$qdata["referralcode"]."'"
			." WHERE id=".$customer;
		}
		//$query = mysql_real_escape_string($query);
		//echo $query."<br>";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		header("location:order_form_ps.php?retrieved=true&orderid=".$_POST["orderid"]);//."&postageamount=".$_POST["postageamount"]."&postageoption=".$_POST["postageoption"]);
		exit;
	}
}
?>