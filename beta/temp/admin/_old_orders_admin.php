<?php

// set explicit form variables
//print_r($_REQUEST);
$showperpage = $_REQUEST['showperpage'];
$startrecord = $_REQUEST['startrecord'];
$orders_search = $_REQUEST['orders_search'];
$name_search = $_REQUEST['name_search'];
$phone_search = $_REQUEST['phone_search'];
$label_search = $_REQUEST['label_search'];

$showprinted = $_REQUEST['showprinted'];
$showpayment = $_REQUEST['showpayment'];
$showprocess = $_REQUEST['showprocess'];
$showposted = $_REQUEST['showposted'];
$showunfinished = $_REQUEST['showunfinished'];
$showarchived = $_REQUEST['showarchived'];
if($_REQUEST['range'] == '')
	$range = 3;
else
	$range = $_REQUEST['range'];

if($_POST["showperpage"]){
	setcookie("showperpage", $_POST["showperpage"], time()+36000);
}

$includeabove = true;

include("../useractions.php"); // this includes common_db.php

linkme();

session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);


$query = "SELECT * FROM currencies";
//echo " 1 $query <br>";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = array();
while($qdata = mysql_fetch_array($result)){
	$cur[$qdata["id"]] = array();
	$cur[$qdata["id"]]['currName'] = $qdata["currName"];
	$cur[$qdata["id"]]['symbol'] = $qdata["symbol"];
	$cur[$qdata["id"]]['postage'] = $qdata["postage"];
	$cur[$qdata["id"]]['freeGift'] = $qdata["freeGift"];
}




if(!$showperpage) {
	$showperpage=50;
}else{
	$showperpage=$showperpage;
}

if(!$startrecord) $startrecord=0;


$where = '';
$rangeWhere='';
$checkArchive = false;
$archiveOrders = false;
$archiveSuffix = "_archive";
$ordersTable = "orders";
$basketItemsTable = "basket_items";
$ccTransactionsTable = "cc_transactions";
$customersTable = "customers";
if($_REQUEST['range'] == '')
{
	$dateRange = mktime(0,0,0,date('m')-$range,date('d'),date('Y'));
	$rangeWhere.= " (a.finished >='" . date('Y-m-d H:i:s',  $dateRange) . "') ";
}
else
{
	if($_COOKIE['range'] == '12' || $_COOKIE['range'] == 'a') $checkArchive = true;
	
	if($_COOKIE['range'] == '3' || $_COOKIE['range'] == '12'){
	  $dateRange = mktime(0,0,0,date('m')-$_COOKIE['range'],date('d'),date('Y'));
	  $rangeWhere.= " (a.finished >='" . date('Y-m-d H:i:s',  $dateRange) . "') ";
	}
}
	

if($showunfinished!="true"){
	$showunfinished="false";
}
if($showarchived!="true"){
	$showarchived="false";
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">

<script language="JavaScript">

function checkdelete(id, archive){
	if(archive==true){
		if(window.confirm('Really delete this order? (The order will be archived and is recoverable)')){
			location.href='deleteorder.php?archive=true&id='+id;
		}
	}else{
		if(window.confirm('Really delete this order? (This order is already in the recycle bin and will be deleted permanently)')){
			location.href='deleteorder.php?archive=false&id='+id;
		}
	}
}

function changeRange(){
	returnstring = getReturnString();
	location.href='changeshowstate.php?which=range&to='+document.forms['showitems']['range'].value+returnstring;
}

function changeStatus(){

    if(document.getElementById("status").value == "posted"){
	  document.getElementById("daypostedall").disabled = false;
	  document.getElementById("monthpostedall").disabled = false;
	  document.getElementById("yearpostedall").disabled = false;
	} else {
	  document.getElementById("daypostedall").disabled = true;
	  document.getElementById("monthpostedall").disabled = true;
	  document.getElementById("yearpostedall").disabled = true;
    }
	return true;
	//location.href='changestatus.php?id='+id+'&to='+document.forms['stat'+id].stat.value+'&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;
}

function changeUrgent(id){

	var checked = 0;
	if(document.forms['stat'+id].urgent.checked)
	{
		checked=1;
	}
	location.href='changeurgent.php?id='+id+'&checked='+checked+'&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;

}

function changePaymentReceived(id){

	var checked = 0;
	if(document.forms['stat'+id].payment_received.checked)
	{
		checked=1;
	}
	location.href='change_payment_received.php?id='+id+'&checked='+checked+'&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;

}

function getReturnString(){
	return '&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;
}

function changeShowState(which){
	returnstring = getReturnString();
	location.href='changeshowstate.php?which='+which+'&to='+document.forms['showitems'][which].checked+returnstring;
}

function setSearchParams(){
	returnstring = getReturnString();
	orders_search = document.forms['search_form']['orders_search'];
	name_search = document.forms['search_form']['name_search'];
	phone_search = document.forms['search_form']['phone_search'];
	if(document.forms['search_form'].label_search.checked){
		label_search=1;
	}
	else {
		label_search=0;
	}
	if(orders_search.value != Number(orders_search.value)){
		alert('You must enter numbers only into Order Number');
	}else if(orders_search.value=="" && name_search.value=="" && phone_search.value==""){
		alert('You must complete at least one field');
	}else{
		location.href='changesearch.php?orders_search='+orders_search.value+'&label_search=' +label_search+ '&phone_search='+phone_search.value+'&name_search='+name_search.value+returnstring;
	}
}

function clearSearch(){
	returnstring = getReturnString();
	location.href='changesearch.php?orders_search=&name_search='+returnstring;
}

var selected_orders = new Array();
var all_orders;

function toggle_order(obj) {
      if (document.getElementById("selectAll").checked == true){
	    document.getElementById("selectAll").checked = false;
	  }
      var id = obj.value;
      if (obj.checked == true){
        //alert("check "+id); 
        var length = selected_orders.length;
        selected_orders[length] = id;
      } else {
        //alert("uncheck "+id);
        var new_array="";
        for (var i = 0; i < selected_orders.length; i++){
          if (selected_orders[i] != id && selected_orders[i] != "") {
            new_array+=selected_orders[i]+",";
          }
	}
        
        selected_orders = new_array.split(",");
      }
      //alert(selected_orders+" - "+selected_orders.length+" - "+selected_orders.toString());
}

function process_selected() {
      if (selected_orders.length > 0){
	    var data = selected_orders.toString();
		var status = document.getElementById("status").value;
		if(status=="posted"){
		  day = document.getElementById("daypostedall").value;
		  month = document.getElementById("monthpostedall").value;
		  year = document.getElementById("yearpostedall").value;
		  location.href='changestatus.php?orders='+data+'&to='+status+'&dayposted='+day+'&monthposted='+month+'&yearposted='+year+'&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;
		} else {
	      location.href='changestatus.php?orders='+data+'&to='+status+'&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;
        }
	  } else {
        alert("Please select at least one Order");
      }
}


function selectAll() {
  if (document.getElementById("selectAll").checked == true){
        selected_orders = all_orders;
        for (var i=0;i<(all_orders.length-1);i++)
        { 
		  name = "select"+all_orders[i];
          document.getElementById(name).checked = true;
        }
      } else {
	    selected_orders = new Array();
		for (var i=0;i<(all_orders.length-1);i++)
        {
		  name = "select"+all_orders[i];
          document.getElementById(name).checked = false;
        }
	  }
}



</script>
<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
        <tr bgcolor="#FFFFFF"> 
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="150" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="50" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="60" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="50" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="50" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        </tr>
        <tr>
          <td colspan="17" align="center" bgcolor="#6ffd6e"><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td colspan="17"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr>
			<td class="admintext" colspan="17" align="center"><input name="back" type="button" onClick="location.href='index.php'" value="&lt; back">&nbsp;&nbsp;
			<input name="back" type="button" onClick="location.href='addphoneorder.php?neworder=1'" value="add phone/fax order &gt;"></td>
       </tr>
<form name="search_form" method="POST" action="<? echo $PHP_SELF;?>">
        <tr> 
        <td height="58" colspan="14" align="center" valign="top" class="admintext"> 
        <b> Search </b><br><br><br>
	    <div>
		Order Number: <input type="text" name="orders_search" value="<?=$_COOKIE['orders_search']?>">
                Name(<input type=checkbox name="label_search" value="1" <?=($_COOKIE['label_search']==1)?"CHECKED":"";?>>labels): <input type="text" name="name_search" value="<?=$_COOKIE['name_search']?>">
                Phone: <input type="text" name="phone_search" value="<?=$_COOKIE['phone_search']?>">
                <input type="button" name="Submit" value="Search" onClick="setSearchParams();">
		        <input type="button" name="" value="Clear Search" onClick="clearSearch();">
	    </div>
		</td>
		<td height="58" colspan="2" valign="middle" align="center" class="admintext">
        <b> Status Change </b>
	    <div>
		<select name="status" id="status" onChange="return changeStatus();">
                  <option value="pending" selected>pending</option>
                  <option value="printed">printed</option>
                  <option value="posted">posted</option>
                </select><br>
                Date posted:<br>
                <select name="daypostedall" id="daypostedall" disabled>
                <? for($k=1; $k<32; $k++){ ?>
                <option value="<? echo $k;?>"<? if(date("d")==$k){?> selected<? }?>><? echo $k;?></option>
                <? }?>
                </select>
                <select name="monthpostedall" id="monthpostedall" disabled>
                <? for($k=1; $k<13; $k++){ ?>
                <option value="<? echo $k;?>"<? if(date("m")==$k){?> selected<? }?>><? echo $k;?></option>
                <? }?>
                </select>
                <select name="yearposted" id="yearpostedall" disabled>
                <? for($k=4; $k<31; $k++){ ?>
                <option value="<? echo $k+2000;?>"<? if(date("Y")==($k+2000)){?> selected<? }?>><? echo $k+2000;?></option>
                <? }?>
                </select>
                <br />
                <input type="button" value="&nbsp;Update&nbsp;" onClick="process_selected();">
	      </div>
		</td>
		<td>&nbsp;</td>
        </tr>
</form>

		<? if($orders_search || $name_search){ ?>
		<tr>
			<td class="admintext" colspan="17" valign="middle"><div align="center"><strong>Search parameters</strong>:
			<?
			if($orders_search){
				echo " order number: ".$orders_search;
			}
			if($name_search){
				echo " customer name: ".$name_search;
			}
			if($label_search==1){
				echo " searching labels: true";
			}
			?>
			</div></td>
		</tr>
		<? }?>
        <tr> 
          <td colspan="17" valign="middle"> <form name="showitems">
              <table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" width="100%">
                <tr> 
                  <td width="1"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
                </tr>
                <tr> 
                  <td width="1"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
                  <td class="admintext" align="center"> <input type="checkbox" onClick="changeShowState('showprinted');" name="showprinted"<? if(($showprinted==true || !$showprinted) && $showprinted!="false"){?> checked<? }?>>
                    Show Printed &nbsp;&nbsp; <!-- <input type="checkbox" onClick="changeShowState('showpayment');" name="showpayment"<? if(($showpayment==true || !$showpayment) && $showpayment!="false"){?> checked<? }?>>
                    Show Payment Arrived &nbsp;&nbsp;<input type="checkbox" onClick="changeShowState('showprocess');" name="showprocess"<? if(($showprocess==true || !$showprocess) && $showprocess!="false"){?> checked<? }?>>
                    Show Processing orders &nbsp;&nbsp;  --> <input type="checkbox" onClick="changeShowState('showposted');" name="showposted"<? if(($showposted==true || !$showposted) && $showposted!="false"){?> checked<? }?>>
                    Show Posted &nbsp;&nbsp; <input type="checkbox" onClick="changeShowState('showunfinished');" name="showunfinished"<? if(($showunfinished==true || !$showunfinished) && $showunfinished!="false"){?> checked<? }?>>
                    Show Unfinished &nbsp;&nbsp; <input type="checkbox" onClick="changeShowState('showarchived');" name="showarchived"<? if(($showarchived==true || !$showarchived) && $showarchived!="false"){?> checked<? }?>>
                    Show Recycle Bin &nbsp;&nbsp; Range: <select name="range" onChange="changeRange('range');">
					<option value="a" <?=$range=="a"?"selected":'' ?>>All Records</option>
					<option value="12" <?=$range=="12"?"selected":'' ?>>&lt; 12 months</option>
			        <option value="3" <?=$range=="3"?"selected":'' ?>>&lt; 3 months</option>
		            </select>
				 </td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr> 
          <td colspan="17" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><input type="checkbox" name="selectAll" id="selectAll" onClick="selectAll();" /></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Date&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="left"><b>&nbsp;Products&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="left"><b>&nbsp;Total&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Last Change&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Payment 
            Type&nbsp;<br>&nbsp;&amp; Order Type&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Urgent&nbsp;</b></td>

          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Status&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Action&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
        </tr>
        <?
		    $totalrecords = 0;
			$normalRecords =0;
			$archivedRecords = 0;
			$startrecordHold = $startrecord;
			$showperpageHold = $showperpage;
			$idArray = array();
		    for($ac=0;$ac<2;$ac++) {
			  if($ac==1 && $checkArchive == true){
			    $archiveOrders = true;
			    $archiveSuffix = "_archive";
                $ordersTable.=$archiveSuffix;
                $basketItemsTable.=$archiveSuffix;
                $ccTransactionsTable.=$archiveSuffix;
                $customersTable.=$archiveSuffix;
				if(($startrecord+$showperpage)<$normalRecords) break;
				else{
				  if(($startrecord-$normalRecords) < 0){
				    $showperpage = $normalRecords-$startrecord;
				    $startrecord = 0;
				  }
				  else{$startrecord = $startrecord-$normalRecords;}
				}
			  } else if($ac==1 && $checkArchive == false) {
			    break;
			  }

		    if(($orders_search || $name_search || $phone_search)){

	       $where = "WHERE a.customer=b.id AND bi.ordernumber=a.id ";
	
	       if($label_search==1  && !empty($name_search)){
		     $label_query .= " OR bi.text1 LIKE '%".mysql_real_escape_string($name_search)."' OR bi.text2 LIKE '%".mysql_real_escape_string($name_search)."%' ";
	       }
	
	       if($orders_search){
		     $where.= " AND (a.id=".($orders_search-1000).")";
	       }
	
	       if($name_search){
		     $where.= " AND (b.firstname LIKE '%".mysql_real_escape_string($name_search)."%' OR b.surname LIKE '%".mysql_real_escape_string($name_search)."%' {$label_query} )";
	       }
	
	       if($phone_search){
		     $where.= " AND (b.homephone LIKE '%".$phone_search."%' OR b.workphone LIKE '%".$phone_search."%' OR b.mobilephone LIKE '%".$phone_search."%')";
	       }
	
	       $where.=$rangeWhere!=''?" AND ".$rangeWhere:'';
 
	      // if($name_search || $phone_search){
		     $query = "SELECT COUNT(*) AS row_count FROM {$ordersTable} a, {$customersTable} b, {$basketItemsTable} bi ".$where." GROUP BY b.id" ;
		     //echo " 2 $query <br>";
		     $result = mysql_query($query);
		     if(!$result) error_message(sql_error() . "<BR>{$query}");
			 $row = mysql_fetch_array($result);
		     $maxrecords = $row['row_count'];
		     //echo $query.$maxrecords;
			 if($archiveOrders == false)$normalRecords = $maxrecords;
			 else $archivedRecords = $maxrecords;
		
		     if(($startrecord>$maxrecords) && $checkArchive == false){
			   $startrecord=0;
		     }
		     $query = "SELECT a.*, UNIX_TIMESTAMP(a.started) AS ustarted, UNIX_TIMESTAMP(a.finished) AS ufinished, UNIX_TIMESTAMP(a.dateposted) AS udateposted FROM {$ordersTable} a, {$customersTable} b, {$basketItemsTable} bi  ".$where."  GROUP BY b.id ORDER BY started DESC LIMIT ".$startrecord.",".$showperpage;
	
	      /* }else{		
		     $where = " WHERE a.id=".($orders_search-1000);
		     $where.=$rangeWhere!=''?" AND ".$rangeWhere:'';
		     $query = "SELECT a.* FROM {$ordersTable} a ".$where;
		     //echo " 3 $query <br>";
		     $result = mysql_query($query);
		     if(!$result) error_message("sql error: ".sql_error());
		       $maxrecords = mysql_num_rows($result);
		       //echo $query.$maxrecords;
		
		      if($startrecord>$maxrecords){
			    $startrecord=0;
		      }
		      $query = "SELECT a.*, UNIX_TIMESTAMP(a.started) AS ustarted, UNIX_TIMESTAMP(a.finished) AS ufinished, UNIX_TIMESTAMP(a.dateposted) AS udateposted FROM {$ordersTable} a ".$where." ORDER BY started DESC LIMIT ".$startrecord.",".$showperpage;
	        } */
          }else{
	        $where = $rangeWhere!=''?" WHERE ".$rangeWhere:'';
	        //$query = "SELECT a.* FROM orders a ".$where." ORDER BY a.started DESC LIMIT ".$startrecord.",".$showperpage;
	        $query = "SELECT COUNT(*) AS row_count FROM {$ordersTable}";
	        //echo " 4 $query <br>";
	        $result = mysql_query($query);
	        if(!$result) error_message("sql error: ".sql_error());
			 $row = mysql_fetch_array($result);
		     $maxrecords = $row['row_count'];
//	          $maxrecords = mysql_num_rows($result);
	          //$sql = " SELECT count(*) as count FROM orders a";
	          //$result_count = mysql_query($sql);
	          //$record_count = mysql_fetch_row($result_count);
	          //$maxrecords = $record_count[0];
	          //echo " 4.5 $sql <br>";
			  
			  if($archiveOrders == false)$normalRecords = $maxrecords;
			  else $archivedRecords = $maxrecords;
				
	          if(($startrecord>$maxrecords) && $checkArchive == false ){
		        $startrecord=0;
	          }
	          $query = "SELECT *, UNIX_TIMESTAMP(a.started) AS ustarted, UNIX_TIMESTAMP(a.finished) AS ufinished, UNIX_TIMESTAMP(a.dateposted) AS udateposted FROM {$ordersTable} a ".$where." ORDER BY started DESC LIMIT ".$startrecord.",".$showperpage;
          }
   			
          $result = mysql_query($query);
          if(!$result) error_message("sql error: ".sql_error());
		  
		  $showperpage = $showperpageHold;
		  $startrecord = $startrecordHold;
		  
		  $totalrecords = $normalRecords + $archivedRecords;

          //$maxrecords = 100; 
          $pages = ceil($totalrecords/$showperpage);
		  
          $currentpage = (floor($startrecord/$showperpage))+1;
				
				while($qdata = mysql_fetch_array($result)){

					//print_r($qdata);

					$dontshowme=false;
					$ordertype = $qdata["ordertype"];
					$currency = $qdata["currency"];
					$custid = $qdata["customer"];
					
					if(!$ordertype) $ordertype="Web";
					
					$express_found = 0;
					
					$postsql = "SELECT postage_option FROM {$customersTable} WHERE id = '$custid'";
					//echo " 6 $postsql <br>";
					$theresult = mysql_query($postsql) or die ("postsql error");
					while ($therow = mysql_fetch_assoc($theresult))
					{
						if ($therow["postage_option"]=="Australian Express" || $therow["postage_option"]=="Overseas Express" || $therow["postage_option"]=="Express" )
						{
							$express_found = 1;
						}
					}
					if ($express_found == 1)
					{
						$bgcol = "#FFF600";
					}
									
					elseif($qdata["archived"]==1){
						if($showarchived=="false"){
							$dontshowme=true;
						}
						$bgcol = "#B3CCF7";
					}else if($qdata["status"]=="pending"){
						$bgcol = "#FFFFFF";
					}else if($qdata["status"]=="printed"){
						if($showprinted=="false"){
							$dontshowme=true;
						}
						$bgcol = "#DDDDDD";
					}else if($qdata["status"]=="payment arrived"){
						if($showpayment=="false"){
							$dontshowme=true;
						}
						$bgcol = "#CCCCCC";
					}else if($qdata["status"]=="processing order"){
						if($showprocess=="false"){
							$dontshowme=true;
						}
						$bgcol = "#BBBBBB";
					}else if($qdata["status"]=="posted"){
						if($showposted=="false"){
							$dontshowme=true;
						}
						$bgcol = "#AAAAAA";
					}
					if($qdata['urgent']==1)
					{
						$bgcol="#FF8888";
					}
					
					// Custom Label Background Colour
					$custquery = "SELECT * FROM {$basketItemsTable} WHERE ordernumber=".$qdata["id"];
					//echo " 7 $custquery <br>";
					$cust = mysql_query($custquery);
					if(!$cust) error_message(sql_error());
					$cust_row = mysql_fetch_assoc($cust);
					if ($cust_row["type"] == 27)
					{
						$bgcol="#B096CD";
					}
					

					$query = "SELECT * FROM {$customersTable} WHERE id=".$qdata["customer"];
					//echo " 8 $query <br>";
					$customer = mysql_query($query);
					if(!$customer) error_message(sql_error());
					while($cdata = mysql_fetch_array($customer)){
					    $specialRequirements = stripslashes($cdata["specialreqs"]);
						$paymentmeth = $cdata["paymentmeth"];
						$postage = $cdata["postage"];
						$custId = $cdata["id"];


						if(!empty($cdata['voucher'])){
//							$voucher_amount = "<br />({$cur[$currency]['symbol']}".sprintf("%01.2f", $cdata['voucher_amount']).")";

							$voucher_amount_raw = $cdata['voucher_amount'];
							$voucher_number = str_replace(",", "-", $cdata['voucher']);

						}
						else {
							$voucher_amount = $voucher_number = "";
							$voucher_amount_raw = 0;
						}


// get CC amount & return code
$amount_paid = -999.99;
$RC_output=$AMOUNT="";
$string2 = "	select RC, AM 
					from {$ccTransactionsTable} 
					where OI='" .($qdata["id"]+1000)."' 
					and MR != 'M12'
					order by id desc limit 1";
//echo " 9 $string2 <br>";
$result2 = mysql_query($string2) or die ("SQL Error: ".mysql_error());
if(mysql_num_rows($result2)==1)
{
	list($RC, $AMOUNT)=mysql_fetch_row($result2);
	
	if(strlen(trim($AMOUNT)) > 0 ){
		$amount_paid = $AMOUNT/100;
		$amount_display = " AU$".sprintf("%01.2f", $amount_paid);
	}
	
	$RC_output = returnErrorCode($RC);
	if(!empty($RC_output))
	{
		$RC_output = "<br />({$RC_output})";
	}

	if(!empty($AMOUNT) && $currency!=1 && $currency!=5 )
	{
		$AMOUNT = "<br /><i>(AU$".sprintf("%01.2f", $AMOUNT/100).")</i>";
	}
	else {
		$AMOUNT = "";
	}
}


if($qdata['ustarted'] > $_EPAY['LIVE_TIMESTAMP']){
	$merchant = "MultiBase";
}
else {
	$merchant = "Paystream";
}

/*
print "<pre>";
print_r($cdata);
print "</pre>";
*/

						if($cdata["firstname"]!="" && $cdata["confirmed"]!="unconfirmed" && (($cdata["approved"]!=0 && $cdata["approved"]!=2) || $paymentmeth!=1 || $cdata["ccxx"]!="")){
							$name = stripslashes($cdata["firstname"])." ".stripslashes($cdata["surname"]);
							if($cdata["approved"]==1){



								$name.="<br><i><font color=\"#006600\">(order approved by {$merchant}".$amount_display.")</font></i>";
							}
						}else if($paymentmeth==1 && $cdata["approved"]==2){
							$name = "order unfinished";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}else if($cdata["approved"]==0){
							$name = $cdata["firstname"]." ".$cdata["surname"];

							$name.="<br><i><font color=\"#990000\">(order denied by {$merchant}){$RC_output}</font></i>";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}else if($cdata["confirmed"]!="unconfirmed"){

							$name = "order unfinished";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}else{
							$name = "order unconfirmed";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}
						$oseas = $cdata["oseas"];

					}
					$show_payment_received = false;
					$pm = $paymentmeth;
					if($paymentmeth==0){
						$paymentmeth="";
					}else if($paymentmeth==1){
						$paymentmeth="Credit Card";
						if($ordertype=="Phone/fax")
						{
							$show_payment_received = true;
						}
					}else if($paymentmeth==2){
						$show_payment_received = true;
						$paymentmeth="Money Order";
					}else if($paymentmeth==3){
						$show_payment_received = true;
						$paymentmeth="Phone Order";
					}else if($paymentmeth==4){
						$show_payment_received = true;
						$paymentmeth="Direct Debit";
					}else if($paymentmeth==5){
						$show_payment_received = true;
						$paymentmeth="Phone with CC";
					}else if($paymentmeth==6){
						$show_payment_received = true;
						$paymentmeth="Gift Voucher<br />[{$voucher_number}]";
					}
					else if($paymentmeth==7){
						$show_payment_received = true;
						$paymentmeth="PayPal Invoice";
					}

				if($pm!=6 && !empty($voucher_number)){
					$paymentmeth .= " + Voucher<Br />[{$voucher_number}]";
				}

				if($dontshowme==false && $archiveOrders==false) $idArray[] = $qdata["id"];
				
				if($dontshowme==false || $name_search || $order_search){ 
				?>
				
        <tr bgcolor="#FFFFFFF"> 
          <td colspan="17"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <tr bgcolor="<? echo $bgcol;?>"> 
          <td valign="middle">
		  <? if($archiveOrders==false) {?>
		   <input type="checkbox" id="select<?=$qdata["id"]?>" name="select<?=$qdata["id"]?>" onClick="toggle_order(this);" value="<?=$qdata["id"]?>" />
		  <? } else { ?>
		    &nbsp;
		  <? }?>
		  </td>
          <td class="admintext" valign="top" align="center"><? echo date("d M Y H:i", $qdata["ustarted"]);?><br> 
            <strong>No: <? echo 1000+$qdata["id"];?></strong></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="left"> <table cellpadding="0" cellspacing="0" border="0">
             			<?
						$query = "SELECT * FROM {$basketItemsTable} bi
							LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
							LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
							LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
							LEFT JOIN product p ON (p.id=bi.text5)
							WHERE ordernumber=".$qdata["id"];
						//echo $query;
						//echo " 10 $query <br>";
						$basket = mysql_query($query);
						if(!$basket) error_message(sql_error());
						$totalprice=0; ?>
              <tr>
                <td class="admintext"><strong><? echo $name;?></strong></td>
              </tr>

              <?
							while($basket_qdata = mysql_fetch_array($basket)){
								$basket_qdata["text1"] = stripslashes($basket_qdata["text1"]);
								$basket_qdata["text2"] = stripslashes($basket_qdata["text2"]);
								$basket_qdata["text3"] = stripslashes($basket_qdata["text3"]);
								$basket_qdata["text4"] = stripslashes($basket_qdata["text4"]);
								$basket_qdata["text5"] = stripslashes($basket_qdata["text5"]);
							
								$totalprice += $basket_qdata["price"];
								?>
      		        <tr>
		                <td class="admintext"><strong><? echo $basket_qdata["quantdesc"];?></strong> 
    		        <?
    		        			switch((int)$basket_qdata['type'])
    		        			{
    		        				
    		        				case 3:
    		        					// mini's
    		        				echo  '<br />' . $basket_qdata['text1'];
//    		        				debug_showvar($basket_qdata);
										if(strlen($basket_qdata['text2']) > 0)
										{
											echo '<Br />' . $basket_qdata['text2'];
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>pic: ".getPicType($basket_qdata['pic']);
										}
										break;
    		        				case 5:
    		        					// pencil
    		        					echo  '<br />' . $basket_qdata['text1'];
										if(strlen($basket_qdata['text2']) > 0)
										{
											echo '<Br />' . $basket_qdata['text2'];
										}
										if((int)$basket_qdata['picon']==1 && (int)$basket_qdata['pic'] > 0)
										{
											print "<br /><i>pic: ".getPicType($basket_qdata['pic']);
										}
										break;
										
									case 24: // address labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											print "<br>".$basket_qdata["text4"];
									break;
									
									case 25: // address labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											print "<br>".$basket_qdata["text4"];
									break;
									
									case 26: // address labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											print "<br>".$basket_qdata["text4"];
									break;
									
									case 27: // custon labels
											print "<br>".$basket_qdata["text1"];
											print "<br>".$basket_qdata["text2"];
											print "<br>".$basket_qdata["text3"];
											//print "<br>".$basket_qdata["text4"];
									break;
										
    		        				case 17:
										//$types=array('', 'Vinyl Labels', 'Iron-on Labels (Semi-Permanent)', 'Mini Vinyl Labels');
										$types=array();
										$types[1] = 'Vinyl Labels';
										$types[2] = 'Semi-Permanent Iron Ons';
										$types[3] = 'Mini Vinyl Labels';
										$types[19] = 'Permanent Iron Ons';
										
										$packs= explode(",", $basket_qdata["text5"]);
										$text = explode(",", $basket_qdata["text1"]);
										$pic  = explode(",", $basket_qdata["pic"]);
										$picon= explode(",", $basket_qdata["picon"]);
	
										$phone= explode(",", $basket_qdata["text2"]);
										
										
										for($k=0;$k<=1;$k++){
											print "<br /><i><strong>Pack" .($k+1). ": 30 {$types[$packs[$k]]}</strong><br />" .rawurldecode($text[$k]);
											if(!empty($phone[$k]))
												print "<br />" .rawurldecode($phone[$k]);
											if($picon[$k]==1)
												print "<br />".getPicType($pic[$k]);
										}
										break;
									case 18:
										$types = array('', 'Vinyl Labels','','Mini Vinyl Labels');
										print "<br /><i><strong>Pack: ".$types[$basket_qdata['text5']]."</strong><br />".rawurldecode($basket_qdata['text1']);
										if(!empty($basket_qdata['text2']))
										{
											print "<br />{$basket_qdata['text2']}";
										}
										if($basket_qdata['picon']==1)
										{
											print "<br />".getAllergyPicType($basket_qdata['pic']);
										}
										print "</i>";
										break;
									case 21:
										echo  '<br />' . $basket_qdata['text1'];
										if(strlen($basket_qdata['text2']) > 0)
										{
											echo '<Br />' . $basket_qdata['text2'];
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>pic: ".getPicType($basket_qdata['pic']);
										}
										echo '<br />tag: ' . $basket_qdata['data_identitag_name'];
										break;
									case 30:
										// get the product description
										/*
										$sqlBands = "	SELECT *
														FROM product
														WHERE id IN (30,31,32)";
										$resultBands = db_query($sqlBands);
										$products_bands = array();
										while($recordBands = db_fetch_array($resultBands)){
											$products_bands[(int)$recordBands['id']] = $recordBands['productName'];
										}
										$band_qtys = explode(",",$basket_qdata["text5"]);
										*/
										for($k=1; $k<=5; $k++){
											//$productId = $band_qtys[$k-1];
											if($basket_qdata["text".$k] != "0"){
												?><br><i><?
												$temp_output = $basket_qdata["text".$k];
												if($temp_output==strtoupper($basket_qdata["text".$k])){
													$temp_output = getBandPicType($basket_qdata["text".$k]);
												}
												print $temp_output;
												?></i><?
											}
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>".getPicType($basket_qdata['pic']);
										}
										?><br><?=$cur[$currency]['symbol'].number_format($basket_qdata['price'],2)?><?
										break;
										
									case 22:
										for($k=1; $k<6; $k++){
											if($basket_qdata["text".$k]!=""){
												?><br><i><?
												$temp_output = getIdentitagDesc(strtoupper($basket_qdata["text".$k]));
												if($temp_output==strtoupper($basket_qdata["text".$k])){
													$temp_output = getPicTypeZT($basket_qdata["text".$k]);
												}
												print $temp_output;
												?></i><?
											}
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>".getPicTypeZT($basket_qdata['pic']);
										}
										break;
								   case (((int)$basket_qdata['type']>=36) && ((int)$basket_qdata['type']<=39)):
								   ?>
								     <br><i><?=$basket_qdata["text1"];?><br>
						  		     <?=$basket_qdata["text2"];?></br>
						  		     <? 
						  			    for( $i=3 ; $i <= 12; $i++) {
						  				   print($basket_qdata["text".$i]!=''?$basket_qdata["text".$i].'<br>':'');
						  				 }
						  			  ?>
						  			 
						  				</i>
								   <?
									break;		
									
									case (((int)$basket_qdata['type']>=48) && ((int)$basket_qdata['type']<=56)):
								   ?>
								     <br><i><?=$basket_qdata["text1"];?><br>
						  		     <?=$basket_qdata["text2"];?></br>
						  		     <? 
						  			    for( $i=3 ; $i <= 12; $i++) {
						  				   print($basket_qdata["text".$i]!=''?$basket_qdata["text".$i].'<br>':'');
						  				 }
						  			  ?>
						  			 
						  				</i>
								   <?
									break;		
										
									default:
										for($k=1; $k<6; $k++){
											if($basket_qdata["text".$k]!=""){
												?><br><i><?
												$temp_output = getIdentitagDesc(strtoupper($basket_qdata["text".$k]));
												if($temp_output==strtoupper($basket_qdata["text".$k])){
													$temp_output = getPicType($basket_qdata["text".$k]);
												}
												print $temp_output;
												?></i><?
											}
										}
										if($basket_qdata['picon']==1)
										{
											print "<br /><i>".getPicType($basket_qdata['pic']);
										}
										break;

								}
							}	

							// subtract voucher value
							if($voucher_amount_raw>0){
								$voucher_currency = getVoucherDetails($totalprice, str_replace("-", ",", $voucher_number), true);
		
		
		
		
								if(empty($voucher_currency)){
									$voucher_amount="<br />[Voucher not found]";
								} 
								else {
									// change the vouchers into the currency used
									$voucher_amount_raw = convertCurrency($voucher_amount_raw, $currencies[$voucher_currency]['code']."to".$currencies[$currency]['code']);
									$totalprice = $totalprice - $voucher_amount_raw;
									$voucher_amount = "<br />[{$cur[$currency]['symbol']}".sprintf("%01.2f", $voucher_amount_raw)."]";
								}


 ?>
                </td>
              </tr>
              <tr>
                <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
              </tr>
              	<? }
				$totalprice+=$postage;
				if($amount_paid != $totalprice && $amount_paid != -999.99 && ($currency==1 || $currency==5)){
					$alert_colour="#FF0000";
					$alert_weight="bold";
				} else {
					$alert_colour="";
					$alert_weight="";
				}
				if(mysql_num_rows($basket)==0) echo "no products"; ?>
            </table></td>
 <form name="stat<? echo $qdata["id"];?>">
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"><p style="color: <?=$alert_colour?> ; font-weight: <?=$alert_weight?>;" class="ordertotal"><? echo $cur[$currency]['symbol'].sprintf("%01.2f", $totalprice);?><?=$voucher_amount?><?=$AMOUNT?></p></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"><? echo date("d M Y H:i", $qdata["ufinished"]);?></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"><? echo $paymentmeth."<br><b>".$ordertype."<b>";?>
          
          <?
if($show_payment_received == true)
{
	?>
          <br />
          <table cellpadding=0 cellspacing=0 border=0>
          	<tr>
          		<td valign=top><input type=checkbox name="payment_received" value="1" <?=($qdata['payment_received']==1)?"checked":"";?> onClick="changePaymentReceived(<?=$qdata['id'];?>);"  <?=$archiveOrders==true?'disabled':''?>></td>
          		<td  nowrap class="admintext">Payment Rcvd</td>
          	</tr>
          	</table>
    <?
}

?>
          </td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>

          <td class="admintext" valign="top" align="center"><input type=checkbox name="urgent" value="1" <?=($qdata['urgent']==1)?"checked":"";?> onClick="changeUrgent(<?=$qdata['id'];?>);"  <?=$archiveOrders==true?'disabled':''?>></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"> 
	     <b><?=$qdata["status"]?></b><br><br>
</form>
            <? if(($qdata["status"]=="posted")){?>
            <form name="date<? echo $qdata["id"];?>" action="changedateposted.php" method="post">
              <input type="hidden" name="id" value="<? echo $qdata["id"];?>">
              <input type="hidden" name="showperpage" value="<? echo $showperpage;?>">
              <input type="hidden" name="startrecord" value="<? echo $startrecord;?>">
              Date posted:<br>
              <select name="dayposted" <?=$archiveOrders==true?'disabled':''?> >
                <? for($k=1; $k<32; $k++){ ?>
                <option value="<? echo $k;?>"<? if(date("d",$qdata["udateposted"])==$k){?> selected<? }?>><? echo $k;?></option>
                <? }?>
              </select>
              <select name="monthposted" <?=$archiveOrders==true?'disabled':''?>>
                <? for($k=1; $k<13; $k++){ ?>
                <option value="<? echo $k;?>"<? if(date("m",$qdata["udateposted"])==$k){?> selected<? }?>><? echo $k;?></option>
                <? }?>
              </select>
              <select name="yearposted" <?=$archiveOrders==true?'disabled':''?>>
                <? for($k=4; $k<31; $k++){ ?>
                <option value="<? echo $k+2000;?>"<? if(date("Y",$qdata["udateposted"])==($k+2000)){?> selected<? }?>><? echo $k+2000;?></option>
                <? }?>
              </select>
              <br />
              <input type="text" name="postal_tracking_number" size="22" maxlength="16" value="<?= $qdata['postal_tracking_number']; ?>" <?=$archiveOrders==true?'disabled':''?>>
              <br>
              <input type="submit" value="&nbsp;update&nbsp;" <?=$archiveOrders==true?'disabled':''?>>
            </form>
            <? } ?>
			 <form name="specialReq" action="changeReq.php" method="post">
              <input type="hidden" name="id" value="<?=$custId;?>">
              <input type="hidden" name="showperpage" value="<? echo $showperpage;?>">
              <input type="hidden" name="startrecord" value="<? echo $startrecord;?>">
			  <input type="hidden" name="archived" value="<?=$archiveOrders==true?'true':'false'?>" >
			  <textarea cols="15" rows="3" name="requirements"><?=$specialRequirements;?></textarea>
              <br>
              <input type="submit" value="&nbsp;update&nbsp;">
            </form>
          </td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="smalltext" align="center">
		  <? if ($archiveOrders==false){ ?>
		  <a href="javascript: checkdelete(<? echo $qdata["id"];?>, <? if($qdata["archived"]==1){?>false<? }else{?>true<? }?>);" class="type1" id="type1">delete</a><br>
		  <a href="viewitem.php?id=<? echo $qdata["id"];?>&startrecord=<? echo $startrecord;?>&showperpage=<? echo $showperpage;?>" class="type1" id="type1">view</a><br>
		  <? if($qdata["archived"]==1){?>
		  <a href="undelete.php?id=<? echo $qdata["id"];?>" class="type1" id="type1">undelete</a>
		  <? }
		    }?>
		  </td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
        </tr><?
			}
		} 
	   }?>
        <tr bgcolor="#FFFFFFF"> 
          <td colspan="17"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <form name="perpage">
          <input type="hidden" name="startrecord" value="<? echo $startrecord;?>">
          <tr> 
            <td colspan="17"> <table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
                <tr> 
                  <td><img src="../images/spacer_trans.gif" height="40" width="5" border="0"></td>
                  <td valign="middle" class="admintext">Show 
                    <select name="showperpage" onChange="window.location.href='<? echo $PHP_SELF;?>?showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+<? echo $startrecord;?>">
                      <option value="50"<? if($showperpage==50){?> selected<? }?>>50</option>
                      <option value="100"<? if($showperpage==100){?> selected<? }?>>100</option>
					  <option value="150"<? if($showperpage==150){?> selected<? }?>>150</option>
                    </select>
                    per page</td>
                  <td><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
                  <td valign="middle" class="admintext">Jump to:&nbsp; 
				  <select name="showpage" onChange="location.href='orders_admin.php?showperpage=<? echo $showperpage;?>&startrecord='+document.forms.perpage.showpage.value">
				  <? echo $pages;
				  
				  for($i=0; $i<$pages; $i++){?>
				  	<option<? if($currentpage==($i+1)){?> selected<? }?> value="<? echo ($i*$showperpage)+1;?>"><? echo $i+1;?></option>
				  <? }?>
				  </select>
				  &nbsp; Currently on page <? echo $currentpage;
				  if($currentpage>1){
				  	?>&nbsp;&nbsp;<a href="orders_admin.php?showperpage=<? echo $showperpage;?>&startrecord=<? echo (($currentpage-2)*$showperpage)+1;?>">&lt;prev</a><?
				  }
				  if($currentpage<$pages){
				  	?>&nbsp;&nbsp;<a href="orders_admin.php?showperpage=<? echo $showperpage;?>&startrecord=<? echo (($currentpage)*$showperpage)+1;?>">next&gt;</a><?
				  }
				  ?>
                  </td>
                </tr>
              </table></td>
          </tr>
        </form>
      </table>
			</td>
		</tr>
	</table>
<script> all_orders = new Array(<?foreach($idArray as $value){print($value.","); }?>0)</script>
</body>