<?
if($_POST["showperpage"]){
	setcookie("showperpage", $_POST["showperpage"], time()+36000);
}

$includeabove = true;
include("../useractions.php"); // this includes common_db.php

linkme();

if(!$showperpage) {
	$showperpage=20;
}else{
	$showperpage=$showperpage;
}

if(!$startrecord) $startrecord=0;

if(($orders_search || $name_search)){
	if($orders_search && $name_search){
		$where = "WHERE a.customer=b.id AND (b.firstname LIKE '%".$name_search."%' OR b.surname LIKE '%".$name_search."%') AND a.id=".($orders_search-1000);
	}else if($name_search){
		$where = "WHERE a.customer=b.id AND (b.firstname LIKE '%".$name_search."%' OR b.surname LIKE '%".$name_search."%')";
	}
	
	if($name_search){
		
		$query = "SELECT * FROM orders a, customers b ".$where;
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		$maxrecords = mysql_num_rows($result);
		
		if($startrecord>$maxrecords){
			$startrecord=0;
		}
		$query = "SELECT a.*, UNIX_TIMESTAMP(a.started) AS ustarted, UNIX_TIMESTAMP(a.finished) AS ufinished, UNIX_TIMESTAMP(a.dateposted) AS udateposted FROM orders a, customers b ".$where." ORDER BY started DESC LIMIT ".$startrecord.",".$showperpage;
	}else{		
		
		$where = "WHERE id=".($orders_search-1000);
		
		$query = "SELECT * FROM orders ".$where;
		
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		$maxrecords = mysql_num_rows($result);
		
		if($startrecord>$maxrecords){
			$startrecord=0;
		}
		$query = "SELECT *, UNIX_TIMESTAMP(started) AS ustarted, UNIX_TIMESTAMP(finished) AS ufinished, UNIX_TIMESTAMP(dateposted) AS udateposted FROM orders ".$where." ORDER BY started DESC LIMIT ".$startrecord.",".$showperpage;
	}
	
	
}else{
	$query = "SELECT * FROM orders";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$maxrecords = mysql_num_rows($result);
	
	if($startrecord>$maxrecords){
		$startrecord=0;
	}
	$query = "SELECT *, UNIX_TIMESTAMP(started) AS ustarted, UNIX_TIMESTAMP(finished) AS ufinished, UNIX_TIMESTAMP(dateposted) AS udateposted FROM orders ORDER BY started DESC LIMIT ".$startrecord.",".$showperpage;
	
}

$result = mysql_query($query);
if(!$result) error_message(sql_error());

$pages = ceil($maxrecords/$showperpage);

$currentpage = (floor($startrecord/$showperpage))+1;

if($showunfinished!="true"){
	$showunfinished="false";
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">

<script language="JavaScript">

function checkdelete(id){
	if(window.confirm('Really delete this order entirely?')){
		location.href='deleteorder.php?id='+id;
	}
}

function changeStatus(id){
	location.href='changestatus.php?id='+id+'&to='+document.forms['stat'+id].stat.value+'&showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+document.forms['perpage'].startrecord.value;
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
	if(orders_search.value != Number(orders_search.value)){
		alert('You must enter numbers only into Order Number');
	}else if(orders_search.value=="" && name_search.value==""){
		alert('You must complete at least one field');
	}else{
		location.href='changesearch.php?orders_search='+orders_search.value+'&name_search='+name_search.value+returnstring;
	}
}

function clearSearch(){
	returnstring = getReturnString();
	location.href='changesearch.php?orders_search=&name_search='+returnstring;
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
        </tr>
        <tr>
          <td colspan="15"><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td colspan="15"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td height="38" colspan="15" valign="middle" class="admintext"> 
            <form name="search_form" method="post" action="<? echo $PHP_SELF;?>">
              <div align="center">Order Number 
                <input type="text" name="orders_search">
                &nbsp;OR Name 
                <input type="text" name="name_search">
                &nbsp;&nbsp;
                <input type="button" name="Submit" value="Search" onClick="setSearchParams();">
				<input type="button" name="" value="Clear Search" onClick="clearSearch();">
              </div>
            </form></td>
        </tr>
		<tr>
			<td class="admintext" colspan="15" align="center"><input type="button" name="addphoneorder" value="Add Phone/Fax Order" onClick="location.href='addphoneorder.php?startrecord=<? echo $startrecord;?>&showperpage=<? echo $showperpage;?>'"></td>
		</tr>
		<? if($orders_search || $name_search){ ?>
		<tr>
			<td class="admintext" colspan="15" valign="middle"><div align="center"><strong>Search parameters</strong>:
			<?
			if($orders_search){
				echo " order number: ".$orders_search;
			}
			if($name_search){
				echo " customer name: ".$name_search;
			}
			?>
			</div></td>
		</tr>
		<? }?>
        <tr> 
          <td colspan="15" valign="middle"> <form name="showitems">
              <table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" width="100%">
                <tr> 
                  <td width="1"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
                </tr>
                <tr> 
                  <td width="1"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
                  <td class="admintext" align="center"> <input type="checkbox" onClick="changeShowState('showprinted');" name="showprinted"<? if(($showprinted==true || !$showprinted) && $showprinted!="false"){?> checked<? }?>>
                    Show Printed &nbsp;&nbsp; <input type="checkbox" onClick="changeShowState('showpayment');" name="showpayment"<? if(($showpayment==true || !$showpayment) && $showpayment!="false"){?> checked<? }?>>
                    Show Payment Arrived &nbsp;&nbsp; <input type="checkbox" onClick="changeShowState('showprocess');" name="showprocess"<? if(($showprocess==true || !$showprocess) && $showprocess!="false"){?> checked<? }?>>
                    Show Processing orders &nbsp;&nbsp; <input type="checkbox" onClick="changeShowState('showposted');" name="showposted"<? if(($showposted==true || !$showposted) && $showposted!="false"){?> checked<? }?>>
                    Show Posted &nbsp;&nbsp; <input type="checkbox" onClick="changeShowState('showunfinished');" name="showunfinished"<? if(($showunfinished==true || !$showunfinished) && $showunfinished!="false"){?> checked<? }?>>
                    Show Unfinished </td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr> 
          <td colspan="15" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="25" width="1" border="0"></td>
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
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Status&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="middle" align="center"><b>&nbsp;Action&nbsp;</b></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
        </tr>
        <?
				while($qdata = mysql_fetch_array($result)){
					$dontshowme=false;
					$ordertype = $qdata["ordertype"];
					if(!$ordertype) $ordertype="Web";
					
					if($qdata["status"]=="pending"){
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
					
					$query = "SELECT * FROM customers WHERE id=".$qdata["customer"];
					$customer = mysql_query($query);
					if(!$customer) error_message(sql_error());
					while($cdata = mysql_fetch_array($customer)){
						$paymentmeth = $cdata["paymentmeth"];
						if($cdata["firstname"]!=""){
							$name = $cdata["firstname"]." ".$cdata["surname"];
						}else{
							$name = "order unfinished";
							if($showunfinished=="false"){
								$dontshowme=true;
							}
						}
						$oseas = $cdata["oseas"];
					
					}
					if($paymentmeth==0){
						$paymentmeth="";
					}else if($paymentmeth==1){
						$paymentmeth="Credit Card";
					}else if($paymentmeth==2){
						$paymentmeth="Money Order";
					}else if($paymentmeth==3){
						$paymentmeth="Phone Order";
					}
				
				if($dontshowme==false || $name_search || $order_search){
					?>
        <tr bgcolor="#FFFFFFF"> 
          <td colspan="15"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <tr bgcolor="<? echo $bgcol;?>"> 
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"><? echo date("d M Y H:i", $qdata["ustarted"]);?><br> 
            <strong>No: <? echo 1000+$qdata["id"];?></strong></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="left"> <table cellpadding="0" cellspacing="0" border="0">
             			<?
						$query = "SELECT * FROM basket_items WHERE ordernumber=".$qdata["id"];
						$basket = mysql_query($query);
						if(!$basket) error_message(sql_error());
						$totalprice=0; ?>
              <tr>
                <td class="admintext"><strong><? echo $name;?></strong></td>
              </tr>
              <? while($basket_qdata = mysql_fetch_array($basket)){
					$totalprice += $basket_qdata["price"]; ?>
              <tr>
                <td class="admintext"><strong><? echo $basket_qdata["quantdesc"];?></strong> 
                  <? for($k=1; $k<6; $k++){
						if($basket_qdata["text".$k]!=""){
							?><br><i><? echo $basket_qdata["text".$k];?></i><?
						}
					} ?>
                </td>
              </tr>
              <tr>
                <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
              </tr>
              	<? }
				if($oseas==1) $totalprice+=6;
			
				if(mysql_num_rows($basket)==0) echo "no products"; ?>
            </table></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center">$<? echo toDollarsAndCents($totalprice);?></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"><? echo date("d M Y H:i", $qdata["ufinished"]);?></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"><? echo $paymentmeth."<br><b>".$ordertype."<b>";?></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext" valign="top" align="center"> <form name="stat<? echo $qdata["id"];?>">
              <select name="stat" onChange="changeStatus(<? echo $qdata["id"];?>);">
                <option value="pending"<? if($qdata["status"]=="pending"){?> selected<? }?>>pending</option>
                <option value="printed"<? if($qdata["status"]=="printed"){?> selected<? }?>>printed</option>
                <option value="payment arrived"<? if($qdata["status"]=="payment arrived"){?> selected<? }?>>payment 
                arrived</option>
                <option value="processing order"<? if($qdata["status"]=="processing order"){?> selected<? }?>>processing 
                order</option>
                <option value="posted"<? if($qdata["status"]=="posted"){?> selected<? }?>>posted</option>
              </select>
            </form>
            <? if($qdata["status"]=="posted"){?>
            <form name="date<? echo $qdata["id"];?>" action="changedateposted.php" method="post">
              <input type="hidden" name="id" value="<? echo $qdata["id"];?>">
              <input type="hidden" name="showperpage" value="<? echo $showperpage;?>">
              <input type="hidden" name="startrecord" value="<? echo $startrecord;?>">
              Date posted:<br>
              <select name="dayposted">
                <? for($k=1; $k<32; $k++){ ?>
                <option value="<? echo $k;?>"<? if(date("d",$qdata["udateposted"])==$k){?> selected<? }?>><? echo $k;?></option>
                <? }?>
              </select>
              <select name="monthposted">
                <? for($k=1; $k<13; $k++){ ?>
                <option value="<? echo $k;?>"<? if(date("m",$qdata["udateposted"])==$k){?> selected<? }?>><? echo $k;?></option>
                <? }?>
              </select>
              <select name="yearposted">
                <? for($k=4; $k<10; $k++){ ?>
                <option value="<? echo $k+2000;?>"<? if(date("Y",$qdata["udateposted"])==($k+2000)){?> selected<? }?>><? echo $k+2000;?></option>
                <? }?>
              </select>
              <br>
              <input type="submit" value="&nbsp;update&nbsp;">
            </form>
            <? } ?>
          </td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="smalltext" align="center"><a href="javascript: checkdelete(<? echo $qdata["id"];?>);" class="type1" id="type1">delete</a>&nbsp;<a href="viewitem.php?id=<? echo $qdata["id"];?>&startrecord=<? echo $startrecord;?>&showperpage=<? echo $showperpage;?>" class="type1" id="type1">view</a></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
        </tr><?
			}
		} ?>
        <tr bgcolor="#FFFFFFF"> 
          <td colspan="15"><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <form name="perpage">
          <input type="hidden" name="startrecord" value="<? echo $startrecord;?>">
          <tr> 
            <td colspan="15"> <table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
                <tr> 
                  <td><img src="../images/spacer_trans.gif" height="40" width="5" border="0"></td>
                  <td valign="middle" class="admintext">Show 
                    <select name="showperpage" onChange="window.location.href='<? echo $PHP_SELF;?>?showperpage='+document.forms['perpage'].showperpage.value+'&startrecord='+<? echo $startrecord;?>">
                      <option value="20"<? if($showperpage==20){?> selected<? }?>>20</option>
                      <option value="50"<? if($showperpage==50){?> selected<? }?>>50</option>
                      <option value="100"<? if($showperpage==100){?> selected<? }?>>100</option>
                    </select>
                    per page</td>
                  <td><img src="../images/spacer_trans.gif" height="1" width="100" border="0"></td>
                  <td valign="middle" class="admintext">Jump to:&nbsp; <?
					for($i=0; $i<$pages; $i++){
						if(($i/25) == floor($i/25) && $i!=0){
							echo "<br>";
						}
						if($currentpage==($i+1)){
							echo "<strong>&gt;".($i+1)."&lt;</strong>&nbsp;";
						}else{ ?>
							<strong><a href="<? echo $PHP_SELF?>?showperpage=<? echo $showperpage;?>&startrecord=<? echo ($i*$showperpage)+1;?>&" class="type2" id="type2">[<? echo $i+1;?>]</a></strong>&nbsp; <?
						}
					} ?>
                  </td>
                </tr>
              </table></td>
          </tr>
        </form>
      </table>
			</td>
		</tr>
	</table>
</body>