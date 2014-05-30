<?

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
	$query = "SELECT * FROM customers WHERE firstname='".$_POST["firstname"]."' AND emailadd='".$_POST["emailadd"]."'";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	if(mysql_num_rows($result)==0){
		$query = "SELECT * FROM customers_archive  WHERE firstname='".$_POST["firstname"]."' AND emailadd='".$_POST["emailadd"]."'";
	    $result = mysql_query($query);
	    if(!$result) error_message(sql_error());
	    if(mysql_num_rows($result)==0){
		  header("location:order_form_ps.php?retrieved=false&orderid=".$_POST["orderid"]);//"&postageamount=".$_POST["postageamount"]."&postageoption=".$_POST["postageoption"]);
		  exit;
		}else{
		  while($qdata=mysql_fetch_array($result)){
			$query = "UPDATE customers SET"
			." oseas=".$qdata["oseas"].","
			." firstname='".$qdata["firstname"]."',"
			." surname='".$qdata["surname"]."',"
			." address='".stripslashes($qdata["address"])."',"
			." suburb='".$qdata["suburb"]."',"
			." postcode='".$qdata["postcode"]."',"
			." state='".$qdata["state"]."',"
			." country='".$qdata["country"]."',"
			." emailadd='".$qdata["emailadd"]."',"
			." homephone='".$qdata["homephone"]."',"
			." workphone='".$qdata["workphone"]."',"
			." mobilephone='".$qdata["mobilephone"]."',"
			." referral='".$qdata["referral"]."',"
			." referralcode='".$qdata["referralcode"]."'"
			." WHERE id=".$customer;
		 }
	  }
	}else{
		while($qdata=mysql_fetch_array($result)){
			$query = "UPDATE customers SET"
			." oseas=".$qdata["oseas"].","
			." firstname='".$qdata["firstname"]."',"
			." surname='".$qdata["surname"]."',"
			." address='".stripslashes($qdata["address"])."',"
			." suburb='".$qdata["suburb"]."',"
			." postcode='".$qdata["postcode"]."',"
			." state='".$qdata["state"]."',"
			." country='".$qdata["country"]."',"
			." emailadd='".$qdata["emailadd"]."',"
			." homephone='".$qdata["homephone"]."',"
			." workphone='".$qdata["workphone"]."',"
			." mobilephone='".$qdata["mobilephone"]."',"
			." referral='".$qdata["referral"]."',"
			." referralcode='".$qdata["referralcode"]."'"
			." WHERE id=".$customer;
		}
		//echo $query."<br>";
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		header("location:order_form_ps.php?retrieved=true&orderid=".$_POST["orderid"]);//."&postageamount=".$_POST["postageamount"]."&postageoption=".$_POST["postageoption"]);
		exit;
	}
}
?>