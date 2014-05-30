<?php
	session_start();

/*
	28.1.2005 modified
		mysql_query($__STRING__, $link)
		TO
		mysql_query($__STRING__)

		Also added useractions.php include to include the database connection files etc.

*/

if(!isset($useractions)){
	$includeabove = true;
	include("../useractions.php");
}

linkme();
session_start();
$user_section_id = 4;
require_once("./security.php");
check_access($user_section_id);

   if(isset($_GET['list']) && $_GET['list'] != ''){
	  $_SESSION['list'] = $_GET['list'];
	} 

   $list = $_SESSION['list'];

	if ((isset($_POST['file'])) AND ($_POST['file'] != '')){
		$file = $_POST['file'];
	}elseif ((isset($_GET['file'])) AND ($_GET['file'] != '')){
		$file = $_GET['file'];
	}
	
	if ((isset($_POST['id'])) AND ($_POST['id'] != '')){
		$id = $_POST['id'];
	}elseif ((isset($_GET['id'])) AND ($_GET['id'] != '')){
		$id = $_GET['id'];
	}
	
	if ((isset($_POST['subscriber_id'])) AND ($_POST['subscriber_id'] != '')){
		$subscriber_id = $_POST['subscriber_id'];
	}elseif ((isset($_GET['subscriber_id'])) AND ($_GET['subscriber_id'] != '')){
		$subscriber_id = $_GET['subscriber_id'];
	}
	
//echo '<pre>';
//print_r($subscriber_id);
//print_r($_POST);
//echo '</pre>';
	
	if ((isset($_POST['category'])) AND ($_POST['category'] != '')){
		$category = $_POST['category'];
	}elseif ((isset($_GET['category'])) AND ($_GET['category'] != '')){
		$category = $_GET['category'];
	}
	
	if ($category == "all"){
		$category = "";
	}elseif ((!isset($category)) OR (strlen($category) > 1)){
		$category = 'a';
	}
	
	if ((isset($_POST['subscriber_action'])) AND ($_POST['subscriber_action'] != '')){
		$subscriber_action = $_POST['subscriber_action'];
	}elseif ((isset($_GET['subscriber_action'])) AND ($_GET['subscriber_action'] != '')){
		$subscriber_action = $_GET['subscriber_action'];
	}

	if ((isset($_POST['subscriber_number'])) AND ($_POST['subscriber_number'] != '')){
		$subscriber_number = $_POST['subscriber_number'];
	}elseif ((isset($_GET['subscriber_number'])) AND ($_GET['subscriber_number'] != '')){
		$subscriber_number = $_GET['subscriber_number'];
	}

	if ((isset($_POST['subscriber_status'])) AND ($_POST['subscriber_status'] != '')){
		$subscriber_status = $_POST['subscriber_status'];
	}elseif ((isset($_GET['subscriber_status'])) AND ($_GET['subscriber_status'] != '')){
		$subscriber_status = $_GET['subscriber_status'];
	} 

?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="admin_stylesheet.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="../js/interface.js"></script>	
<script type="text/javascript" src="../js/jquery.blockUI.js" ></script>
<script type="text/javascript" src="../js/jquery.dimensions.js" ></script>
<script type="text/javascript" src="../js/pos.js" ></script>
<script type="text/javascript" src="../js/jquery.multiSelect.js" ></script>
<script type="text/javascript" src="../js/validate_block.js" ></script>

<script language="JavaScript" type="text/JavaScript">
<!--

  var currentId = '';
  var currentList = '';
  var newName = '';
  var newEmail = '';
  
  function editSub(list, id) {
    currentList = list;
    currentId = id;
    msg.load('ok');
    var initContent = '<strong>Edit Subscription</strong><br><br>';
    //initContent+= 'Name: <input type="text" size="30" id="name" value="'+$("#name_"+id).html()+'"><br>';
    initContent+= 'Email: <input type="text" size="30" id="email" value="'+$("#email_"+id).html()+'"><br>';
    initContent+= '<input type="button" value="Update" onclick="updateSub(0)"><br><div id="statusDiv"></div><br><br>';
    msg.content(initContent);
    return false;
  
  }
  
  function newSub() {
  
    currentId = '-1';
    msg.load('ok');
    var initContent = '<strong>New Subscription</strong><br><br>';
    //initContent+= 'Name: <input type="text" size="30" id="name" value=""><br>';
    initContent+= 'Email: <input type="text" size="30" id="email" value=""><br>';
    initContent+= '<input type="button" value="Update" onclick="updateSub(1)"><br><div id="statusDiv"></div><br>';
    msg.content(initContent);
    return false;
  
  }

  function updateSub(type) {
    //newName = $("#name").val();
    newEmail = $("#email").val();
    $("#statusDiv").html('<img src="../images/gen/loading.gif" width="15">');
    $.ajax({
      type: "POST",
      url: "update_sub.php",
      data: {id:currentId, list:currentList, email:newEmail},
      dataType: "responseText",
      success : function(text) {
        if(text=='true') {
          $("#statusDiv").html('<small>Subscription updated</small>');
          if(type==0){
            //$("#name_"+currentId).html(newName);
            $("#email_"+currentId).html(newEmail);
          } else {
            msg.click('ok', 'window.location="<?=$_SERVER['PHP_SELF'];?>?sort=<?=$sort?>&order=<?=$nowOrder?>"');
          }
        } else {
          if(text=='false') {
            $("#statusDiv").html('<small>Error updating Subscription</small>');
          } else {
            $("#statusDiv").html('<small>Subscription info has not chnaged</small>');          
          }
        }
      }
    });
     
  }
  
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function UpdateSubscriber(obj){
	var id = obj.value;
	var status = "";
	if (obj.checked){
		status = "Yes";
	}else{
		status = "No";
	}
	//window.status = id + " " + status;
	document.forms.form1.subscriber_action.value = "update subscriber";
	document.forms.form1.subscriber_number.value = id;
	document.forms.form1.subscriber_number.value = id;
	document.forms.form1.subscriber_status.value = status;
	document.forms.form1.submit();
}
function SendNewsletter(){
	if (window.confirm("Are you certain you would like to send a newsletter to every currently subscribed customer now?")){
		//window.status = "Sending newsletters now...";
		//document.forms.form1.subscriber_action.value = "send newsletter";
		//document.forms.form1.submit();
		window_handler = window.open("email_newsletter.php", "SendNewsletters", "top=200, left=25, height=300, width=925, scrollbars");
		window_handler.focus();
	}
}
//-->
</script>
</head>

<body>
<? require_once("msg_box.php"); ?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><table cellpadding="0" cellspacing="0" border="0">
        <tr bgcolor="#FFFFFF"> 
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr> 
          <td class="maintext"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td valign="top" class="maintext"> <table width="100%" height="100%" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="99%" height="22" valign="top" class="maintext"><table width="100%" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="89%"><a href="index.php" class="type1">Administration Home</a> | <a class="type1">Subscriber</a></td>
					  <td width="11%" title="Click here to send a newsletter to all currenly subscribed customers.">
					  <div align="right">
					  <!--<a class="type1" id="update_subscriber" onMouseOver="JavaScript: document.all('update_subscriber').style.cursor='hand';" onClick="JavaScript: SendNewsletter();">Send Newsletter</a>-->
					  <a class="type1"  href="newsletter.php" >Send Newsletter</a>
					  </div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td valign="top" class="whitetext"><form name="form1" method="post" action="subscriber.php">
					<input type="hidden" name="subscriber_action" value="">
					<input type="hidden" name="category" value="<?= $category ?>">
					<input type="hidden" name="subscriber_number" value="">
					<input type="hidden" name="subscriber_status" value="">
                    <table width="100%" border="0" cellpadding="5">
                      <tr bgcolor="#EE007B"> 
                        <td> <p><strong><font color="#FFFFFF"> Subscriber Administration 
                          </font></strong></p></td>
                      </tr>
                      <tr>
 						      <td>
 						        <div align="center">
 						        <font size="2px">
 						        Mailig Lists:
                           <?
                             if($list=='customer'||$list=='') {
                                print('<font size="2px">Customers</font> - ');  
                             } else {
                                print('<a href="subscriber.php?list=customer"><font size="2px">Customers</font></a> - ');
                             }
                             
                             if($list=='loyalty') {
                                print('<font size="2px">Loyalty Program</font> - ');  
                             } else {
                                print('<a href="subscriber.php?list=loyalty"><font size="2px">Loyalty Program</font></a> - ');
                             }
                             
                             if($list=='agents') {
                                print('<font size="2px">Agents</font>');  
                             } else {
                                print('<a href="subscriber.php?list=agents"><font size="2px">Agents</font></a>');
                             }
                           ?>
                           </font>
                         </div>
 						      </td>                      
                      </tr>

                      <tr title="Clicking a letter will display only the customers whose last names begin with that letter."> 
                        <td><div align="center"><a href="subscriber.php?category=a">A</a> - <a href="subscriber.php?category=b">B</a> - <a href="subscriber.php?category=c">C</a> - <a href="subscriber.php?category=d">D</a> - <a href="subscriber.php?category=e">E</a> - <a href="subscriber.php?category=f">F</a> - <a href="subscriber.php?category=g">G</a> - <a href="subscriber.php?category=h">H</a> - <a href="subscriber.php?category=i">I</a> - <a href="subscriber.php?category=j">J</a> - <a href="subscriber.php?category=k">K</a> - <a href="subscriber.php?category=l">L</a> - <a href="subscriber.php?category=m">M</a> - <a href="subscriber.php?category=n">N</a> - <a href="subscriber.php?category=o">O</a> - <a href="subscriber.php?category=p">P</a> - <a href="subscriber.php?category=q">Q</a> - <a href="subscriber.php?category=r">R</a> - <a href="subscriber.php?category=s">S</a> - <a href="subscriber.php?category=t">T</a> - <a href="subscriber.php?category=u">U</a> - <a href="subscriber.php?category=v">V</a> - <a href="subscriber.php?category=w">W</a> - <a href="subscriber.php?category=x">X</a> - <a href="subscriber.php?category=y">Y</a> - <a href="subscriber.php?category=z">Z</a> - <a href="subscriber.php?category=all">All</a></div></td>
                      </tr>

                      <tr> 
                        <td align=center class=maintext><p><strong>Search</strong> <input type=text name=keywords value="<?=$_POST['keywords']?>"><input type=submit name=submit_but value="Search"></p></td>
                      </tr>
                      
<?
//------------------------------------------LOYALTY & AGENTS LISTS------------------------------------------------  	
  if($list=="agents"||$list=="loyalty") {
	 
	 switch($list){
	  case "agents": 
	    $table = "agents_info";
	    $email_field ="email";
	    break;  
	  case "loyalty":  
	    $table = "loyalty_program";
	    $email_field ="email";
	    break;
	 }
	 
	if (($subscriber_action == "update subscriber") AND ($subscriber_number != "") AND ($subscriber_status != "")){
		$update_sql = "UPDATE ".$table." SET subscriber = '" . $subscriber_status . "' WHERE ".$email_field." = '". $subscriber_number . "'";
		echo $update_sql . '<br>';
		mysql_query($update_sql) or exit(mysql_error());
	} 
	
	$total = "unknown";		
	$sql = "SELECT id FROM ".$table." WHERE (".$email_field." <> '') AND subscriber = 'Yes' GROUP BY ".$email_field;
	$result = mysql_query($sql);
	if($result) {
	  $total = mysql_num_rows($result);
	}
						
	$index = 0;

// add search fields.
if(!empty($_POST['keywords'])){
	$search = " AND ( name like '%{$_POST['keywords']}%' OR  ".$email_field." like '%{$_POST['keywords']}%' ) ";
}
else {
	// when no search field, only display category letter;

	$search = " AND (name LIKE '%" . $category . "%')  ";
}

$sql = "SELECT id, name, ".$email_field." , subscriber FROM ".$table."  WHERE (".$email_field."  <> '')  {$search} GROUP BY ".$email_field." ORDER BY name ASC, id DESC ";
											
											//echo $sql;
										   $num_on_page = "unknown";
											$result = mysql_query($sql) or mysql_error("sql error: ".mysql_error());
											$num_on_page = mysql_num_rows($result); 
											?>
											
											 <tr>
												<td><div align="center"><strong>
												  <?=$total;?> Subscribers
												  </strong></div></td> 
											  </tr>
											   <tr> 
                        <td>
							<table width="100%" border="0" cellpadding="5">
										  <tr bgcolor="#E5E5E5">
										    <td width="25%"><div align="center"><strong><a class="grey">Name</a></strong></div></td> 
											<td width="39%"><div align="center"><strong><a class="grey">Email
											        Address</a></strong></div></td>
										   <td width="11%"><div align="center"><strong><a class="grey">Subscriber</a></strong></div>
										   </td>
											<td width="11%"><div align="center"><strong><a class="grey">Edit</a></strong></div>
										    </td> 
										  </tr>
											<?
											
											while ($rs = mysql_fetch_assoc($result)){

										  ?>
											  <tr bgcolor="#E5E5E5">
												<td><div align="center"><strong>
												  <?=$rs['name']?>
												  </strong></div></td> 
												<td>
												  <div id='email_<?=$rs['id'];?>' align="center"><?=$rs[$email_field]?></div>
												</td>
												<td>
													<div align="center">
														<input type="checkbox" name="subscriber_id[<?= $rs['id'] ?>]" value="<?= $rs[$email_field] ?>" <?php if ($rs['subscriber'] == 'Yes'){ ?>checked<?php } ?> onClick="JavaScript: UpdateSubscriber(this);">
													</div>
												</td>
												<td>
													<div align="center">
														<input type="button" name="edit_subscriber_id[<?= $rs['id'] ?>]" value="Edit" onClick="JavaScript: editSub('<?=$list;?>',<?= $rs['id'] ?>);">
													</div>
												</td>
											  </tr>
										  <?php
										  		$index++;
										  	}
											mysql_close();
											mysql_free_result($result);
										    
	   
//------------------------------------------CUSTOMER LIST------------------------------------------------  
 } else {
 
	 $table = "customers";
	 $email_field ="emailadd";
	
	if (($subscriber_action == "update subscriber") AND ($subscriber_number != "") AND ($subscriber_status != "")){
		$update_sql = "UPDATE ".$table." SET subscriber = '" . $subscriber_status . "' WHERE ".$email_field." = '". $subscriber_number."'";
		//echo $update_sql . '<br>';
		mysql_query($update_sql) or exit(mysql_error());
	}
	
	$total = "unknown";
	$sql = "SELECT id FROM ".$table." WHERE (".$email_field." <> '') AND subscriber = 'Yes' GROUP BY ".$email_field;
	$result = mysql_query($sql);
	if($result) {
	  $total = mysql_num_rows($result);
	}
									
											$index = 0;

// add search fields.
if(!empty($_POST['keywords'])){
	$search = " AND ( firstname like '%{$_POST['keywords']}%' OR  surname like '%{$_POST['keywords']}%' OR  emailadd like '%{$_POST['keywords']}%' ) ";
}
else {
	// when no search field, only display category letter;

	$search = " AND (surname LIKE '" . $category . "%')  ";
}

$sql = "SELECT id, firstname, surname, ".$email_field." , subscriber FROM ".$table."  WHERE (".$email_field."  <> '')  {$search} GROUP BY ".$email_field." ORDER BY surname ASC, id DESC ";
											
											//echo $sql;
										   $num_on_page = "unknown";
											$result = mysql_query($sql) or mysql_error("sql error: ".mysql_error());
											$num_on_page = mysql_num_rows($result); 
											?>
											
											 <tr>
												<td><div align="center"><strong>
												  <?=$total;?> Subscribers
												  </strong></div></td> 
											  </tr>
											   <tr> 
                        <td>
							<table width="100%" border="0" cellpadding="5">
										  <tr bgcolor="#E5E5E5">
										    <td width="25%"><div align="center"><strong><a class="grey">Last Name</a></strong></div></td> 
											<td width="25%"><div align="center"><strong><a class="grey">First Name</a></strong></div></td>
											<td width="39%"><div align="center"><strong><a class="grey">Email
											        Address</a></strong></div></td>
											<td width="11%"><div align="center"><strong><a class="grey">Subscriber</a></strong></div>
										   </td>
											<td width="11%"><div align="center"><strong><a class="grey">Edit</a></strong></div>
										    </td> 
										  </tr>
											<?
											
											while ($rs = mysql_fetch_assoc($result)){

										  ?>
											  <tr bgcolor="#E5E5E5">
												<td><div align="center"><strong>
												  <?=$rs['surname']?>
												  </strong></div></td> 
												<td><div align="center">
												  <?=$rs['firstname']?>
												</div></td>
												<td>
												  <div id='email_<?=$rs['id'];?>' align="center"><?=$rs[$email_field]?></div>
												</td>
												<td>
													<div align="center">
														<input type="checkbox" name="subscriber_id[<?= $rs['id'] ?>]" value="<?= $rs[$email_field] ?>" <?php if ($rs['subscriber'] == 'Yes'){ ?>checked<?php } ?> onClick="JavaScript: UpdateSubscriber(this);">
													</div>
												</td>
												<td>
													<div align="center">
														<input type="button" name="edit_subscriber_id[<?= $rs['id'] ?>]" value="Edit" onClick="JavaScript: editSub('<?=$list;?>',<?= $rs['id'] ?>);">
													</div>
												</td>
											  </tr>
										  <?php
										  		$index++;
										  	}
											mysql_close();
											mysql_free_result($result);
											 
   }					
											?>
						  </table>
                        </td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>