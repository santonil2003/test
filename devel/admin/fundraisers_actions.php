<?
include("../common_db.php");
include("fundraisers_functions.php");
$action = $_REQUEST['action'];
switch($action){
	case "changestat";
	changestat();
	break;
	case "addfundraiser":
	$add=true;
	addeditfundraiser();
	break;
	case "editfundraiser":
	$add=false;
	addeditfundraiser();
	break;
	case "delete":
	$add=false;
	delete();
	case "updatereport":
	updatereport();
	break;
}

function changestat(){
	linkme();
	$query = "UPDATE fundraisers SET status='".$_GET["to"]."' WHERE id=".$_GET["id"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	header("location:fundraisers.php");
}

function delete(){
	linkme();
	$items = split(";",$_GET["id"]);
	$query="DELETE FROM fundraisers_payments WHERE fid=";
	$query2="DELETE FROM fundraisers WHERE id=";
	for($i=0; $i<count($items); $i++){
		if($i!=0){
			$query.=" OR fid=";
			$query2.=" OR id=";
		}
		$query.=$items[$i];
		$query2.=$items[$i];
	}

	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$result = mysql_query($query2);
	if(!$result) error_message(sql_error());
	header("location:fundraisers.php");
	exit;
}

function addeditfundraiser(){
	global $add;
	$returnstring = "?fname=".stripslashes(ereg_replace("\"","'",$_POST["fname"]))."&idnumber=".$_POST["idnumber"]."&address=".stripslashes(ereg_replace("\"","'",$_POST["address"]))."&deladdress=".stripslashes(ereg_replace("\"","'",$_POST["deladdress"]))."&abn=".$_POST["abn"]."&abnexemption=".$_POST["abnexemption"]."&gst=".$_POST["gst"]."&contactname=".$_POST["contactname"]."&contactphone=".$_POST["contactphone"]."&contactemail=".$_POST['contactemail']."&id=".$_POST["id"];

	$date_joined = "{$_POST['joined_year']}-{$_POST['joined_month']}-{$_POST['joined_day']}";
	
	if($_POST["fname"]=="" || $_POST["idnumber"]==""){
		header("location:fundraisers_addedit.php$returnstring&error=there were blank fields");
		exit;
	}else{
		linkme();
		
		// get gst if disabled
		if(isset($_POST["gst"])==false){
			$gst="0";
		}else{
			$gst=$_POST["gst"];
		}
		
		// get abn exemption
		if($_POST["abnexemption"]=="on"){
			$abnexemption=1;
		}else{
			$abnexemption=0;
		}
		
		// id number min 4 chars - add leading zeros
		$idnumber=$_POST["idnumber"];
		for($i=strlen($idnumber); $i<4; $i++){
			$idnumber="0".$idnumber;
		}
		
		if($add==true){
			$query = "SELECT * FROM fundraisers WHERE idnumber='".$_POST["idnumber"]."'";
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			if(mysql_num_rows($result)>0){
				header("location:fundraisers_addedit.php$returnstring&error=that id number is already in use");
				exit;
			}
		}
		
		$id = '';
		if($add==true){
			$query = "INSERT INTO fundraisers (fname, idnumber, address, deladdress, contactname, contactphone, contactemail, contactcheque, abn, abnexemption, gst, status, date_joined, percentage)"
			." VALUES ('".addslashes($_POST["fname"])."', '".$idnumber."', '".addslashes($_POST["address"])."', '".addslashes($_POST["deladdress"])
			."', '".$_POST["contactname"]."', '".$_POST["contactphone"]."', '".$_POST["contactemail"]."' , '".$_POST["contactcheque"]."' , '".$_POST["abn"]."', '".$abnexemption."', ".$gst.", '".$_POST["stat"]."', '{$date_joined}', {$_POST["percentage"]})";
		   //$id = $idnumber;
		}else{
			$query = "UPDATE fundraisers SET fname='".addslashes($_POST["fname"])."', idnumber='".$idnumber."', address='".addslashes($_POST["address"])
			."', deladdress='".addslashes($_POST["deladdress"])."', contactname='".addslashes($_POST["contactname"])."', contactphone='"
			.addslashes($_POST["contactphone"])."', contactemail='".$_POST["contactemail"]."', contactcheque='".addslashes($_POST["contactcheque"])."', abn='".$_POST["abn"]."', abnexemption='".$abnexemption."', gst=".$gst.", status='".$_POST["stat"]."
			', date_joined='{$date_joined}', percentage={$_POST["percentage"]}  WHERE id=".$_POST["id"];
			//$id = mysql_insert_id();
		}
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		
		$returnstring = "?success=successfully added or edited fundraiser";
		header("location:fundraisers.php".$returnstring);
		exit;
		
		//$returnstring = "?id=".$id."&success=successfully added or edited fundraiser";
		//header("location:fundraisers_addedit.php$returnstring");
		//exit;
	}
}

function updatereport(){
	linkme();
	$items = split(";",$_GET["id"]);
	if($_GET["unsent"]==true){
		for($i=0; $i<count($items); $i++){
			$query="DELETE FROM fundraisers_payments WHERE quarter=".$_GET["quart"]." AND year=".$_GET["yr"]." AND fid=".$items[$i];
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			if(isset($_GET['Q2quart']) && isset($_GET['Q2yr']))
			{
				$query="DELETE FROM fundraisers_payments WHERE quarter=".$_GET["Q2quart"]." AND year=".$_GET["Q2yr"]." AND fid=".$items[$i];
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
			}
		}
	}else{
		$setDate = date("Y-m-d 00:00:00", mktime(0,0,0,$_GET["month"],$_GET["day"],$_GET["year"]));
		for($i=0; $i<count($items); $i++){

			// first quarter
			$query="SELECT * FROM fundraisers_payments WHERE fid=".$items[$i]." AND quarter=".$_GET["quart"]." AND year=".$_GET["yr"];

			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			

			if(mysql_num_rows($result)>0){
			   if(!isset($_GET['Q2quart']) && !isset($_GET['Q2yr']))
			   {
				  $query="UPDATE fundraisers_payments SET paiddate='".$setDate."' WHERE fid=".$items[$i]." AND quarter=".$_GET["quart"]." AND year=".$_GET["yr"];
			   }
			}else{
				$query="INSERT INTO fundraisers_payments SET quarter=".$_GET["quart"].", year=".$_GET["yr"].", paiddate='".$setDate."', fid=".$items[$i];
			}
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());

			// second quarter.
			if(isset($_GET['Q2quart']) && isset($_GET['Q2yr']))
			{
				$query="SELECT * FROM fundraisers_payments WHERE fid=".$items[$i]." AND quarter=".$_GET["Q2quart"]." AND year=".$_GET["Q2yr"];
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
				
				if(mysql_num_rows($result)>0){
					$query="UPDATE fundraisers_payments SET paiddate='".$setDate."' WHERE fid=".$items[$i]." AND quarter=".$_GET["Q2quart"]." AND year=".$_GET["Q2yr"];
				}else{
					$query="INSERT INTO fundraisers_payments SET quarter=".$_GET["Q2quart"].", year=".$_GET["Q2yr"].", paiddate='".$setDate."', fid=".$items[$i];
				}
				$result = mysql_query($query);
				if(!$result) error_message(sql_error());
			}


		}
	}
	$sendString = getSendString();
	header("location:fundraisers_showreports.php?".$_SERVER['QUERY_STRING']);
	//header("location:fundraisers_showreports.php?".$sendString."&id=".$_GET["returnIds"]."&type=".$_GET["type"]."&page=".$_GET['page']);
}

?>