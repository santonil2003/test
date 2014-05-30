<?php


//include('../newsletter/' . $file);
//exit();

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
$user_section_id = 3;
require_once("./security.php");
check_access($user_section_id);

	require_once('./spaw/spaw_control.class.php');
	
	define("FIRST_YEAR", 2004);
	define("DEFAULT_NEWSLETTER", "template.php");
	
//echo '<pre>';
//print_r($_GET);
//print_r($_POST);
//echo '</pre>';

function updateMailingLists($id, $lists) {
	  if($lists != '' ) {
        $sql = "DELETE FROM site_newsletter_categories_assign WHERE newsletter_id = '".$id."'";
        mysql_query($sql);
	     foreach($lists as $mailing_list_id) {
	       if($mailing_list_id != "0") {
		      $sql = "INSERT INTO site_newsletter_categories_assign VALUES ('', '$mailing_list_id', '$id')";
		      $result = mysql_query($sql);
		    }
		  }
      }
	}

	if ((isset($_POST['action'])) AND ($_POST['action'] != '')){
		$action = $_POST['action'];
	}elseif ((isset($_GET['action'])) AND ($_GET['action'] != '')){
		$action = $_GET['action'];
	}

	if ((isset($_POST['status'])) AND ($_POST['status'] != '')){
		$status = $_POST['status'];
	}elseif ((isset($_GET['status'])) AND ($_GET['status'] != '')){
		$status = $_GET['status'];
	}

	if ((isset($_POST['file'])) AND ($_POST['file'] != '')){
		$file = $_POST['file'];
	}elseif ((isset($_GET['file'])) AND ($_GET['file'] != '')){
		$file = $_GET['file'];
	}
	
	if ((isset($_POST['new_file'])) AND ($_POST['new_file'] != '')){
		$new_file = $_POST['new_file'];
	}elseif ((isset($_GET['new_file'])) AND ($_GET['new_file'] != '')){
		$new_file = $_GET['new_file'];
	}
	
	if ((isset($_POST['id'])) AND ($_POST['id'] != '')){
		$id = $_POST['id'];
	}elseif ((isset($_GET['id'])) AND ($_GET['id'] != '')){
		$id = $_GET['id'];
	}
	
	if ((isset($_POST['spaw'])) AND ($_POST['spaw'] != '')){
		$spaw = $_POST['spaw'];
	}elseif ((isset($_GET['spaw'])) AND ($_GET['spaw'] != '')){
		$spaw = $_GET['spaw'];
	}
	
	if ((isset($_POST['document_content'])) AND ($_POST['document_content'] != '')){
		$document_content = $_POST['document_content'];
	}elseif ((isset($_GET['document_content'])) AND ($_GET['document_content'] != '')){
		$document_content = $_GET['document_content'];
	}
	
//echo 'Before...<br>';
//echo '$file: ' . $file . '<br>';
//echo '$new_file: ' . $new_file . '<br>';

	if ((isset($file)) AND ($file != "") AND (!is_null($file))){
		if (!file_exists('../newsletter/' . $file)){
			$action = '';
			$file = '';
		}
	}elseif (isset($new_file)){
		$file = $new_file;
	}

//echo 'After...<br>';
//echo '$file: ' . $file . '<br>';
//echo '$new_file: ' . $new_file . '<br>';
	
//	if ((isset($file)) AND ($file != "") AND (!file_exists('../newsletter/' . $file))){
//		$action = '';
//		$file = '';
//	}elseif ((isset($new_file)) AND (!isset($file))){
//		$file = $new_file;
//	}

	
	$newsletter_header = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
	$newsletter_header .= '<html>';
	$newsletter_header .= '<head>';
	$newsletter_header .= '<title>identi Kid - Newsletter</title>';
	$newsletter_header .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
	$newsletter_header .= '<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">';
	$newsletter_header .= '<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.">';
	$newsletter_header .= '</head>';
	$newsletter_header .= '<body background="http://www.identikid.com.au/images/bg_pattern.gif">	';
	
	$newsletter_footer = '</body>';
	$newsletter_footer = '</html>';
;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="admin_stylesheet.css" rel="stylesheet" type="text/css">
<style type="text/css" media="print">

.noshow {
	display: none;
	/* visibility:hidden; */
}

.show {
/*	display: block;
	visibility:visible; */
}

body {
	margin: 0px;
}

.printCentre {
	text-align: center;
}

.printTable {
	width: 100%;
}
</style>
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/interface.js"></script>	
<script type="text/javascript" src="../js/jquery.blockUI.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--

function isdefined( variable)
{
    return (typeof(window[variable]) == "undefined")?  false: true;
}


function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function SetFileName(){
	if ((document.forms.form1.new_volume.value != "") && (document.forms.form1.new_issue.value != "") && (!isNaN(document.forms.form1.new_volume.value)) && (!isNaN(document.forms.form1.new_issue.value))){
		document.forms.form1.new_file.value = "vol" + document.forms.form1.new_volume.value + "iss" + document.forms.form1.new_issue.value + ".php";
	}else{
		document.forms.form1.new_file.value = "";
	}
}
function ValidateForm(prefix){
	var proceed = false;
	if ((eval("document.forms.form1.replace_me_volume.value".replace(/replace_me/gi, prefix)) != "") && (!isNaN(eval("document.forms.form1.replace_me_volume.value".replace(/replace_me/gi, prefix))))){
		if ((eval("document.forms.form1.replace_me_issue.value".replace(/replace_me/gi, prefix)) != "") && (!isNaN(eval("document.forms.form1.replace_me_issue.value".replace(/replace_me/gi, prefix))))){
			if (eval("document.forms.form1.replace_me_title.value".replace(/replace_me/gi, prefix)) != ""){
				proceed = true;
			}else{
				window.alert("[Title Error]\n\nBefore continuing please provide a Title for this Newsletter.");
				eval("document.forms.form1.replace_me_title.focus()".replace(/replace_me/gi, prefix));
			}
		}else{
			window.alert("[Issue Number Error]\n\nBefore continuing please provide a valid Issue number for this Newsletter.");
			eval("document.forms.form1.replace_me_issue.focus()".replace(/replace_me/gi, prefix));
		}
	}else{
		window.alert("[Volume Number Error]\n\nBefore continuing please provide a valid Volume number for this Newsletter.");
		eval("document.forms.form1.replace_me_volume.focus()".replace(/replace_me/gi, prefix));
	}
	if (proceed){
		document.forms.form1.status.value = prefix;
		if ((document.all['SPAW_spaw_editor_mode'].value == 'design') || (document.all['SPAW_spaw_editor_mode'].value == 'html')){
			document.forms.form1.document_content.value = window.frames["spaw_rEdit"].document.body.innerHTML;
			document.forms.form1.submit();
		}else{
			window.alert("[Newsletter Error]\n\nNo valid Newsletter information could be detected .");
		}
	}
}
function SendNewsletter(){
	if (window.confirm("Are you certain you would like to send a newsletter to every currently subscribed customer now?")){
		window_handler = window.open("email_newsletter.php", "SendNewsletters", "top=200, left=25, height=200, width=900");
		window_handler.focus();
	}
}
//-->
</script>
<script type="text/javascript">

  var blockBoxBox = '';
  $(document).ready(
   function(){
     
      blockBox = $("#blockBox");
      $('.ok').click($.unblockUI);
      $('.yes').click($.unblockUI);
      $('.no').click($.unblockUI);
    }
  );

  function sendIndividual(id) {
    setupBockBox('ok');
    $("#blockBoxContents").html("<br><img src='../images/gen/loading.gif'><br>");
    var email = $("#send_individual_email_"+id).val();
    $.ajax({ type: "POST", data:"id="+id+"&email="+email+"&send=1",url: "newsletter_send.php",
             dataType: "textresponse", success: 
      function(response){
        if(response=='0'){ 
          $("#blockBoxContents").html("The newsletter successfully sent to: "+email);
        } else {
          $("#blockBoxContents").html("The newsletter was not sent");
        }
      }
    });  
  }
  
  var bulk_email_send_size = <?=BULK_EMAIL_SEND_SIZE?>;
  var total_sub = 0;
  var sent = 0;
  var not_sent = 0;
  var sent_offest = 0;
  var send_bulk_int = '';
  var sending = false;
  var bulkMsgStart = "To start sending this newsletter to all subscribers press 'Start', to stop sending emails press 'Stop' or 'No'<br><br>"
  bulkMsgStart+="<input type='button' name='start' value='Start' onClick='sendBulkStart();'>&nbsp;<input type='button' name='stop' value='Stop' onClick='sendBulkStop();'>&nbsp;<input type='button' name='reset' value='Reset' onClick='sendBulkReset();'><br><br>";
  var id = 0;
  
  function sendBulk(newsletter_id) {
    id = newsletter_id;
    sent = parseInt($("#sent_"+id).val());
    sent_offest = sent;
    total_sub = parseInt($("#total_sub_"+id).val());
    bulkMsg=bulkMsgStart+"<table border='0' width='100%' align='center' valign='middle' ><tr align='center' ><td align='center'><table height='30px'><tr height='30px'><td height='30px'><div id='num_sent'>"+sent+" of "+total_sub+" Sent</div></td><td height='30px' ><div id='statusDiv'></div></td></tr></table></td></tr></table>";
    setupBockBox('no');
    $('.no').click(function(){sendBulkStop();});
    $("#blockBoxContents").html(bulkMsg);
  } 
  
  function sendBulkStart(id) {
    $("#statusDiv").html('<img src="../images/gen/loading.gif" width="30">');
    send_bulk_int = setInterval('sendBulkAjax()', 200);
  }
  
  function sendBulkAjax() {
    
    if(sending==false) {
      sending=true;
      $.ajax({ type: "POST", data:"id="+id+"&send=bulk&startAt="+sent_offest,url: "newsletter_send.php",
             dataType: "textresponse", success: 
        function(response){
          if(response=='false'){ 
            sendBulkStop();
            $("#num_sent").html("ERROR - The newsletter was not sent");
            sending=false;
          } else {
            not_sent+= parseInt(response);
            sent_offest+=bulk_email_send_size;
            if(sent_offest>=total_sub) {
              msg = total_sub+" of "+total_sub+" Sent";
              sent_offest = total_sub;
              sendBulkStop();
            } else {  
              msg = sent_offest+" of "+total_sub+" Sent"; 
            }
            $("#sent_"+id).val(sent_offest);
            $("#display_sent_"+id).html(msg); 
            $("#num_sent").html(msg);
            sending=false;
          }
        }
      });
    }
    
  }
  
  function sendBulkStop() {  
    clearInterval(send_bulk_int);
    send_bulk_int = '';
    $("#statusDiv").html('');
  }
  
  function sendBulkReset() {  
    if(confirm("Are you sure you want to reset the counter?")){
      $("#statusDiv").html('<img src="../images/gen/loading.gif" width="30">');
      $.ajax({ type: "POST", data:"id="+id,url: "newsletter_reset.php",
             dataType: "textresponse", success: 
        function(response){
          $("#statusDiv").html('');
          if(response=="true") {
            sendBulkStop();
            sent_offest = 0;
            sent = 0;
            msg = sent+" of "+total_sub+" Sent";
            $("#display_sent_"+id).html(msg);  
            $("#num_sent").html(msg);
	         $("#sent_"+id).val(0);
	       }
        }
      });
    }    
  }
  
  function setupBockBox() {

    //$.blockUI(blockBoxBox, { width: '325px' });
    $.blockUI({ message: blockBox, css: { width: '325px' } }); 
    
    $("#blockBoxContents").html('');
    
    var ok = false;
    var yes = false;
    var no = false;
    
    for (var i = 0; i < setupBockBox.arguments.length; i++) {
      switch(setupBockBox.arguments[i]) {
        case 'ok':ok=true;break;
        case 'yes':yes=true;break;
        case 'no':no=true;break;
      }
    }   
     
    if(ok==true)$("#okButton").css("display", "inline");
    else $("#okButton").css("display", "none");
    
    if(yes==true)$("#yesButton").css("display", "inline");
    else $("#yesButton").css("display", "none");
    
    if(no==true)$("#noButton").css("display", "inline");
    else $("#noButton").css("display", "none");


  }
  
</script>

</head>

<body>
<div id="blockBox" style="background-color:#ffffff;display:none;cursor:default;text-align:center"> 
  <br><div style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:14px; color: #676767;" id="blockBoxContents"></div><br>
  <table border="0" width="100%" align="center"><tr align="center" ><td align="center">
  <table border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td align="center">
        <div id="okButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="button"  alt="OK" style="cursor: pointer;" class="ok" id="ok" value="OK" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ok','','../images/nav/n_ok_x.gif',1)"/></div>
      </td>
      <td align="center">
        <div id="yesButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="buton"  alt="YES" style="cursor: pointer;" class="yes" id="yes" value="YES" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('yes','','../images/nav/n_yes_x.gif',1)"/></div>
      </td>
      <td align="center">
        <div id="noButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="button"  alt="NO" style="cursor: pointer;" class="no" id="no" value="NO" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('no','','../images/nav/n_no_x.gif',1)"/></div>
      <td>
    </tr>
   </table>
   </td></tr></table>
  <br>
</div>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td ><table cellpadding="0" cellspacing="0" border="0">
        <tr bgcolor="#FFFFFF" class=noshow> 
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        </tr>
        <tr class=noshow> 
          <td><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr class=noshow> 
          <td class="maintext"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr > 
          <td valign="top" class="maintext"><table width="100%" height="100%" cellpadding="0" cellspacing="0">
              <tr class=noshow> 
                <td width="99%" height="22" valign="top" class="maintext" ><table width="100%" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><a href="index.php" class="type1">Administration Home</a> | <a href="newsletter.php" class="type1">Newsletters</a><?php if ($action){ echo " | <a class='type1'>" . $action . "</a>"; } ?></td>
					  					<td width="11%" title="Click here to send a newsletter to all currenly subscribed customers."><div align="right">
					  					<!--<a class="type1" id="update_subscriber" onMouseOver="JavaScript: document.all('update_subscriber').style.cursor='hand';" onClick="JavaScript: SendNewsletter();">Send Newsletter</a>-->
					  					</div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td valign="top" class="whitetext"><form name="form1" method="post" action="newsletter.php?file=<?= $file ?>&action=Save">
					<input type="hidden" name="status" value="">
					<input type="hidden" name="document_content" value="">
                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr bgcolor="#EE007B"  class=noshow> 
                        <td width="89%"><p><strong><font color="#FFFFFF">Newsletters Administration</font></strong></p></td>
                        <td width="11%" align="right"><p><strong><a href="newsletter.php?action=Add"><font color="#FFFFFF">Add Newsletter</font></a></strong></p></td>
                      </tr>
                      <tr> 
                        <td colspan="2">
							<?php
								switch ($action){
									case 'Save':
										//if ((isset($status)) AND (isset($spaw))){
										if ((isset($status)) AND (isset($document_content))){
											if ($status == "old"){
												//Make sure that the file to be written to exists
												if (file_exists("../newsletter/" . $file)){
													$handle = fopen("../newsletter/" . $file, "w");
													//fwrite($handle, stripslashes($spaw));
													fwrite($handle, $newsletter_header . stripslashes($document_content) . $newsletter_footer);
													fclose($handle);
													$save_sql = "UPDATE newsletter SET newsletter.volume = " . $_POST["old_volume"] . ", newsletter.issue = " . $_POST["old_issue"] . ", newsletter.date = \"#" . $_POST["old_year"] . "-" . $_POST["old_month"] . "-" .  $_POST["old_day"] . "#\", newsletter.title = \"" . $_POST["old_title"] . "\" WHERE newsletter.file = \"" . $_POST["old_file"] . "\"";
													//echo '$save_sql: ' . $save_sql;
													mysql_query($save_sql) or exit(mysql_error());
													updateMailingLists($_POST['old_id'], $_POST['mailing_list']);
												}else{
													//Missing file
													echo '<font color="#FF0000"><strong>An error has occurred. The file you are trying to update does not seem to exist. Please try again. If the problem persists please contact <a href="mailto:info@identikid.com.au">identiKid</a> as soon as possible.</strong></font><br>';
												}
											}elseif ($status == "new"){
												if (!file_exists("../newsletter/" . $file)){
													//Save changes to disc
													$handle = fopen("../newsletter/" . $file, "w");
													//fwrite($handle, stripslashes($spaw));
													fwrite($handle, $newsletter_header . stripslashes($document_content) . $newsletter_footer);
													fclose($handle);
													chmod("../newsletter/" . $file, 0646);
													//Save changes to database
													$save_sql = "INSERT INTO newsletter (volume, issue, date, title, file) VALUES (\"" . $_POST["new_volume"] . "\", \"" . $_POST["new_issue"] . "\", \"" . $_POST["new_year"] . "-" . $_POST["new_month"] . "-" .  $_POST["new_day"] . "\", \"" . $_POST["new_title"] . "\", \"" . $_POST["new_file"] . "\")";
													mysql_query($save_sql) or exit(mysql_error());
													$id = mysql_insert_id();
	   											updateMailingLists($id, $_POST['mailing_list']);
												}else{
													//Trying to write the new Newsletter information to a file that already exists
													echo '<font color="#FF0000"><strong>An error has occurred. The new file you are trying to create seems to exist already. Please try again. If the problem persists please contact <a href="mailto:info@identikid.com.au">identiKid</a> as soon as possible.</strong></font><br>';
												}
											}
										}else{
											//Missing status or WYSIWYG information
											echo '<font color="#FF0000"><strong>An error has occurred. Please try again. If the problem persists please contact <a href="mailto:info@identikid.com.au">identiKid</a> as soon as possible.</strong></font><br>';
										}
									
									case 'Edit':
										if (isset($file)){
										  	$edit_sql = "SELECT * FROM newsletter WHERE newsletter.file = '" . $file . "'";
											$edit_result = mysql_query($edit_sql) or exit(mysql_error());
											if ($edit_rs = mysql_fetch_assoc($edit_result)){
												$edit_day = substr($edit_rs['date'], 8, 2);
												$edit_month = substr($edit_rs['date'], 5, 2);
												$edit_year = substr($edit_rs['date'], 0, 4);
											}
										}
										if (!isset($edit_day)){
											$edit_day = date("j");
										}
										if (!isset($edit_month)){
											$edit_month = date("n");
										}
										if (!isset($edit_year)){
											$edit_year = date("Y");
										}
										?>
										<table width="100%" border="0" cellpadding="5">
											<input type="hidden" name="old_id" value="<?= $edit_rs['id'] ?>">
											<tr bgcolor="#E5E5E5">
											<td width="6%"><p><strong>Volume</strong></p></td>
											<td width="15%">
											  <p align="left" >
											    <input name="old_volume" type="text" value="<?= $edit_rs['volume'] ?>" size="15">
</p>
											</td>
											<td width="6%"><p><strong>Issue</strong></p></td>
											<td width="15%"><input name="old_issue" type="text" value="<?= $edit_rs['issue'] ?>" size="15"></td>
											<td width="6%"><p align="left" ><strong>Date</strong> </p></td>
											<td width="52%"><select name="old_day" size="1">
                                              <option <?php if($edit_day==1){ ?>selected<?php } ?>>1</option>
                                              <option <?php if($edit_day==2){ ?>selected<?php } ?>>2</option>
                                              <option <?php if($edit_day==3){ ?>selected<?php } ?>>3</option>
                                              <option <?php if($edit_day==4){ ?>selected<?php } ?>>4</option>
                                              <option <?php if($edit_day==5){ ?>selected<?php } ?>>5</option>
                                              <option <?php if($edit_day==6){ ?>selected<?php } ?>>6</option>
                                              <option <?php if($edit_day==7){ ?>selected<?php } ?>>7</option>
                                              <option <?php if($edit_day==8){ ?>selected<?php } ?>>8</option>
                                              <option <?php if($edit_day==9){ ?>selected<?php } ?>>9</option>
                                              <option <?php if($edit_day==10){ ?>selected<?php } ?>>10</option>
                                              <option <?php if($edit_day==11){ ?>selected<?php } ?>>11</option>
                                              <option <?php if($edit_day==12){ ?>selected<?php } ?>>12</option>
                                              <option <?php if($edit_day==13){ ?>selected<?php } ?>>13</option>
                                              <option <?php if($edit_day==14){ ?>selected<?php } ?>>14</option>
                                              <option <?php if($edit_day==15){ ?>selected<?php } ?>>15</option>
                                              <option <?php if($edit_day==16){ ?>selected<?php } ?>>16</option>
                                              <option <?php if($edit_day==17){ ?>selected<?php } ?>>17</option>
                                              <option <?php if($edit_day==18){ ?>selected<?php } ?>>18</option>
                                              <option <?php if($edit_day==19){ ?>selected<?php } ?>>19</option>
                                              <option <?php if($edit_day==20){ ?>selected<?php } ?>>20</option>
                                              <option <?php if($edit_day==21){ ?>selected<?php } ?>>21</option>
                                              <option <?php if($edit_day==22){ ?>selected<?php } ?>>22</option>
                                              <option <?php if($edit_day==23){ ?>selected<?php } ?>>23</option>
                                              <option <?php if($edit_day==24){ ?>selected<?php } ?>>24</option>
                                              <option <?php if($edit_day==25){ ?>selected<?php } ?>>25</option>
                                              <option <?php if($edit_day==26){ ?>selected<?php } ?>>26</option>
                                              <option <?php if($edit_day==27){ ?>selected<?php } ?>>27</option>
                                              <option <?php if($edit_day==28){ ?>selected<?php } ?>>28</option>
                                              <option <?php if($edit_day==29){ ?>selected<?php } ?>>29</option>
                                              <option <?php if($edit_day==30){ ?>selected<?php } ?>>30</option>
                                              <option <?php if($edit_day==31){ ?>selected<?php } ?>>31</option>
                                            </select>&nbsp;&nbsp;
                                              <select name="old_month" size="1">
                                                <option value="1" <?php if($edit_month==1){ ?>selected<?php } ?>>January</option>
                                                <option value="2" <?php if($edit_month==2){ ?>selected<?php } ?>>February</option>
                                                <option value="3" <?php if($edit_month==3){ ?>selected<?php } ?>>March</option>
                                                <option value="4" <?php if($edit_month==4){ ?>selected<?php } ?>>April</option>
                                                <option value="5" <?php if($edit_month==5){ ?>selected<?php } ?>>May</option>
                                                <option value="6" <?php if($edit_month==6){ ?>selected<?php } ?>>June</option>
                                                <option value="7" <?php if($edit_month==7){ ?>selected<?php } ?>>July</option>
                                                <option value="8" <?php if($edit_month==8){ ?>selected<?php } ?>>August</option>
                                                <option value="9" <?php if($edit_month==9){ ?>selected<?php } ?>>September</option>
                                                <option value="10" <?php if($edit_month==10){ ?>selected<?php } ?>>October</option>
                                                <option value="11" <?php if($edit_month==11){ ?>selected<?php } ?>>November</option>
                                                <option value="12" <?php if($edit_month==12){ ?>selected<?php } ?>>December</option>
                                              </select>&nbsp;&nbsp;
                                              <select name="old_year" size="1">
                                                <?php
													for ($loop_counter = FIRST_YEAR; $loop_counter <= (date("Y") + 1); $loop_counter++){
												?>
                                                <option <?php if($loop_counter==$edit_year){ ?>selected<?php } ?>>
                                                <?= $loop_counter ?>
                                                </option>
                                                <?php
													}
												?>
                                              </select>&nbsp;&nbsp;
</td>
											</tr>
											<tr bgcolor="#E5E5E5">
											<td><p><strong>Title</strong></p>
											</td>
											<td colspan="5"><input name="old_title" type="text" value="<?= $edit_rs['title'] ?>" size="100">
											</td>
											</tr>
											<tr bgcolor="#E5E5E5">
											  <td><p><strong>File</strong></p></td>
											  <td colspan="5"><input name="old_file" type="text" value="<?= $edit_rs['file'] ?>" size="100" readonly="true"></td>
										  </tr>
										   <tr bgcolor="#E5E5E5"> 
        <td width="16%" bgcolor="#E5E5E5"> 
<p align="left" ><strong>Mailing Lists</strong> </p></td>
<td width="84%" bgcolor="#E5E5E5" colspan="5" > 
          <p align="left" >
          
        <? 
          $assign_array = array();
          $sql = "SELECT * FROM site_newsletter_categories_assign WHERE newsletter_id = '".$edit_rs['id']."' ";
          $result = mysql_query($sql);
          if($result) {
            while($row = mysql_fetch_array($result) ){ 
              $assign_array[$row['newsletter_cat_id']] = $row;
            }
          }
        ?>
      
       <select id="mailing_list" name="mailing_list[]" multiple="multiple" >
         <option value="">None</option>
					<?
					
					  $sql = "SELECT * FROM `site_newsletter_categories` ORDER BY `name` ";
					  $result = mysql_query($sql);
					  if(mysql_num_rows($result) > 0 ) { 
					    while($row = mysql_fetch_array($result)) {
					      $opt_line = '<option value="'.$row['id'].'" ';
					      $opt_line.= $assign_array[$row['id']]!=''? ' selected="selected" ':'';
					      $opt_line.= '>'.$row['name'].'</option>';
					      echo $opt_line;
					      //echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
					    }
					  }
					  
					?>
				</select>
				<small>To select multiple lists, hold Ctrl while clicking</small>
          </p></td>
      </tr>     
											<tr bgcolor="#E5E5E5">
											<td valign="top">
											  <p><strong>Content</strong></p>
											</td>
											<td colspan="5">
											  <?php
											// get contents of a file into a string 
											$filename = "../newsletter/" . $file; 
											$handle = fopen ($filename, "r"); 
											$contents = fread ($handle, filesize ($filename)); 
											fclose ($handle); 
											
											//$sw = new SPAW_Wysiwyg('spaw' /*name*/,$contents /*value*/, 'en' /*language*/, 'full' /*toolbar mode*/, 'default' /*theme*/, '100%' /*width*/, '600px' /*height*/, '', $spaw_dropdown_data /*Drop Down Data*/);
											$sw = new SPAW_Wysiwyg('spaw' /*name*/,$contents /*value*/, 'en' /*language*/, 'full' /*toolbar mode*/, 'default' /*theme*/, '550px' /*width*/, '600px' /*height*/);
											$sw->show();
											?>
											</td>
											</tr>
											<tr bgcolor="#E5E5E5">
											<td>&nbsp;</td>
											<td colspan="5">
												<input name="update" type="button" value="Update" onClick="JavaScript: ValidateForm('old');">
											</td>
											</tr>
										</table>
										<?php
										break;
									case 'Preview':
										include('../newsletter/' . $file);
										break;
									case 'Add':
										$new_day = date("j");
										$new_month = date("n");
										$new_year = date("Y");
										?>
										<table width="100%" border="0" cellpadding="5" class=show>
											<input type="hidden" name="new_id" value="">
											<tr bgcolor="#E5E5E5">
											<td width="6%"><p><strong>Volume</strong></p></td>
											<td width="15%">
												<p align="left" >
													<input name="new_volume" type="text" size="15" value="" onKeyUp="JavaScript: SetFileName();">
												</p>
											</td>
											<td width="6%"><p><strong>Issue</strong></p></td>
											<td width="15%">
												<input name="new_issue" type="text" size="15" value="" onKeyUp="JavaScript: SetFileName();">
											</td>
											<td width="6%"><p align="left" ><strong>Date</strong> </p></td>
											<td width="52%">
												<select name="new_day" size="1">
													<option <?php if($new_day==1){ ?>selected<?php } ?>>1</option>
													<option <?php if($new_day==2){ ?>selected<?php } ?>>2</option>
													<option <?php if($new_day==3){ ?>selected<?php } ?>>3</option>
													<option <?php if($new_day==4){ ?>selected<?php } ?>>4</option>
													<option <?php if($new_day==5){ ?>selected<?php } ?>>5</option>
													<option <?php if($new_day==6){ ?>selected<?php } ?>>6</option>
													<option <?php if($new_day==7){ ?>selected<?php } ?>>7</option>
													<option <?php if($new_day==8){ ?>selected<?php } ?>>8</option>
													<option <?php if($new_day==9){ ?>selected<?php } ?>>9</option>
													<option <?php if($new_day==10){ ?>selected<?php } ?>>10</option>
													<option <?php if($new_day==11){ ?>selected<?php } ?>>11</option>
													<option <?php if($new_day==12){ ?>selected<?php } ?>>12</option>
													<option <?php if($new_day==13){ ?>selected<?php } ?>>13</option>
													<option <?php if($new_day==14){ ?>selected<?php } ?>>14</option>
													<option <?php if($new_day==15){ ?>selected<?php } ?>>15</option>
													<option <?php if($new_day==16){ ?>selected<?php } ?>>16</option>
													<option <?php if($new_day==17){ ?>selected<?php } ?>>17</option>
													<option <?php if($new_day==18){ ?>selected<?php } ?>>18</option>
													<option <?php if($new_day==19){ ?>selected<?php } ?>>19</option>
													<option <?php if($new_day==20){ ?>selected<?php } ?>>20</option>
													<option <?php if($new_day==21){ ?>selected<?php } ?>>21</option>
													<option <?php if($new_day==22){ ?>selected<?php } ?>>22</option>
													<option <?php if($new_day==23){ ?>selected<?php } ?>>23</option>
													<option <?php if($new_day==24){ ?>selected<?php } ?>>24</option>
													<option <?php if($new_day==25){ ?>selected<?php } ?>>25</option>
													<option <?php if($new_day==26){ ?>selected<?php } ?>>26</option>
													<option <?php if($new_day==27){ ?>selected<?php } ?>>27</option>
													<option <?php if($new_day==28){ ?>selected<?php } ?>>28</option>
													<option <?php if($new_day==29){ ?>selected<?php } ?>>29</option>
													<option <?php if($new_day==30){ ?>selected<?php } ?>>30</option>
													<option <?php if($new_day==31){ ?>selected<?php } ?>>31</option>
												</select>&nbsp;&nbsp;
												<select name="new_month" size="1">
													<option value="1" <?php if($new_month==1){ ?>selected<?php } ?>>January</option>
													<option value="2" <?php if($new_month==2){ ?>selected<?php } ?>>February</option>
													<option value="3" <?php if($new_month==3){ ?>selected<?php } ?>>March</option>
													<option value="4" <?php if($new_month==4){ ?>selected<?php } ?>>April</option>
													<option value="5" <?php if($new_month==5){ ?>selected<?php } ?>>May</option>
													<option value="6" <?php if($new_month==6){ ?>selected<?php } ?>>June</option>
													<option value="7" <?php if($new_month==7){ ?>selected<?php } ?>>July</option>
													<option value="8" <?php if($new_month==8){ ?>selected<?php } ?>>August</option>
													<option value="9" <?php if($new_month==9){ ?>selected<?php } ?>>September</option>
													<option value="10" <?php if($new_month==10){ ?>selected<?php } ?>>October</option>
													<option value="11" <?php if($new_month==11){ ?>selected<?php } ?>>November</option>
													<option value="12" <?php if($new_month==12){ ?>selected<?php } ?>>December</option>
												</select>&nbsp;&nbsp;
												<select name="new_year" size="1">
                                                <?php
													for ($loop_counter = FIRST_YEAR; $loop_counter <= (date("Y") + 1); $loop_counter++){
												?>
                                                <option <?php if($loop_counter==$new_year){ ?>selected<?php } ?>>
                                                <?= $loop_counter ?>
                                                </option>
                                                <?php
													}
												?>
                                              </select>&nbsp;&nbsp;
</td>
											</tr>
											<tr bgcolor="#E5E5E5">
											<td><p><strong>Title</strong></p>
											</td>
											<td colspan="5"><input name="new_title" type="text" size="100" value="">
											</td>
											</tr>
											<tr bgcolor="#E5E5E5">
											  <td><p><strong>File</strong></p></td>
											  <td colspan="5"><input name="new_file" type="text" value="" size="100" readonly="true"></td>
										  </tr>
										  <tr bgcolor="#E5E5E5"> 
        <td width="16%" bgcolor="#E5E5E5"> 
<p align="left" ><strong>Mailing Lists</strong> </p></td>
<td width="84%" bgcolor="#E5E5E5" colspan="5" > 
          <p align="left" >
          
        <? 
          $assign_array = array();
          $sql = "SELECT * FROM site_newsletter_categories_assign WHERE newsletter_id = '".$id."' ";
          $result = mysql_query($sql);
          if($result) {
            while($row = mysql_fetch_array($result) ){ 
              $assign_array[$row['newsletter_cat_id']] = $row;
            }
          }
        ?>
      
       <select id="mailing_list" name="mailing_list[]" multiple="multiple" >
         <option value="">None</option>
					<?
					
					  $sql = "SELECT * FROM `site_newsletter_categories` ORDER BY `name` ";
					  $result = mysql_query($sql);
					  if(mysql_num_rows($result) > 0 ) { 
					    while($row = mysql_fetch_array($result)) {
					      $opt_line = '<option value="'.$row['id'].'" ';
					      $opt_line.= $assign_array[$row['id']]!=''? ' selected="selected" ':'';
					      $opt_line.= '>'.$row['name'].'</option>';
					      echo $opt_line;
					      //echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
					    }
					  }
					  
					?>
				</select>
				<small>To select multiple lists, hold Ctrl while clicking</small>
          </p></td>
      </tr>  
											<tr bgcolor="#E5E5E5">
											<td valign="top">
											  <p><strong>Content</strong></p>
											</td>
											<td colspan="5">
											  <?php
											// get contents of a file into a string 
											$filename = "../newsletter/" . DEFAULT_NEWSLETTER; 
											$handle = fopen ($filename, "r"); 
											$contents = fread ($handle, filesize ($filename)); 
											fclose ($handle); 
											
											//$sw = new SPAW_Wysiwyg('spaw' /*name*/,$contents /*value*/, 'en' /*language*/, 'default' /*toolbar mode*/, 'default' /*theme*/, '100%' /*width*/, '600px' /*height*/, '', $spaw_dropdown_data /*Drop Down Data*/);
											$sw = new SPAW_Wysiwyg('spaw' /*name*/,$contents /*value*/, 'en' /*language*/, 'default' /*toolbar mode*/, 'default' /*theme*/, '100%' /*width*/, '600px' /*height*/);
											$sw->show();
											?>
											</td>
											</tr>
											<tr bgcolor="#E5E5E5">
											<td>&nbsp;</td>
											<td colspan="5">
												<input name="save" type="button" value="Save" onClick="JavaScript: ValidateForm('new');">
											</td>
											</tr>
										</table>
										<?php
										break;
									case 'Archive':
										if ((isset($id)) AND ($action == 'Archive')){
										  	$sql = "UPDATE newsletter SET newsletter.archived = 'Yes' WHERE newsletter.id = " . $id;
											mysql_query($sql) or exit(mysql_error());
											//mysql_close($link);
										}
										//break;
									case 'Unarchive':
										if ((isset($id)) AND ($action == 'Unarchive')){
										  	$sql = "UPDATE newsletter SET newsletter.archived = 'No' WHERE newsletter.id = " . $id;
											mysql_query($sql) or exit(mysql_error());
											//mysql_close($link);
										}
										//break;
									default:
										?>
										<table width="100%" border="0" cellpadding="5">
										  <tr bgcolor="#E5E5E5">
										    <td width="8%"><div align="center"><strong><a class="grey">Volume</a></strong></div></td> 
											<td width="7%"><div align="center"><strong><a class="grey">Issue</a></strong></div></td>
											<td width="14%"> 
										<p align="center" ><strong><a class="grey">Date</a></strong></p></td>
											<td width="49%"> 
											  <p align="left" ><strong><a class="grey" >Title</a></strong></p></td>
											  <td><strong><a class="grey" >Mailing List(s)</a></strong>
										    </td>
      <td width="250"><strong><a class="grey" >Individual Send</a></strong></td>
      <td><strong><a class="grey" >Bulk Send</a></strong></td>
											<!--<td width="8%"><div align="center"></div>
										    </td>-->
											<td width="4%"><div align="center"></div>
										    </td>
											<td width="6%">
                                              <p align="center">&nbsp;</p>
										    </td>
										  </tr>
										  <?php
										  
										  														 
			$cat_totals[1] = 0;
			$cat_totals[2] = 0;
			$cat_totals[3] = 0;
                        $cat_totals[4] = 0;
			
	      $sql = "SELECT id FROM customers WHERE (emailadd <> '') AND subscriber = 'Yes' GROUP BY emailadd";
	      $result = mysql_query($sql);
	      if($result) {
	        $cat_totals[3] = mysql_num_rows($result);
	      }
			
			$loyaltyTotal = 0;
			$sql = "SELECT id FROM loyalty_program WHERE (email <> '') AND subscriber = 'Yes' GROUP BY email";
	      $result = mysql_query($sql);
	      if($result) {
	        $cat_totals[2] = mysql_num_rows($result);
	      }
	      
	      $agentsTotal = 0;
	      $sql = "SELECT id FROM agents_info WHERE (email <> '') AND subscriber = 'Yes' GROUP BY email";
	      $result = mysql_query($sql);
	      if($result) {
	        $cat_totals[1] = mysql_num_rows($result);
	      }

	      $agentsTotal = 0;
	      $sql = "SELECT id FROM email_test WHERE (email <> '') GROUP BY email";
	      $result = mysql_query($sql);
	      if($result) {
	        $cat_totals[4] = mysql_num_rows($result);
	      }
	      
										  	$sql = "SELECT * FROM newsletter order by volume, issue";
											$result = mysql_query($sql);
											while ($rs = mysql_fetch_assoc($result)){
											  $total_sub = 0;
										  ?>
											  <tr bgcolor="#E5E5E5">
												<td><p align="center"><?=$rs['volume']?></p></td> 
												<td><p align="center"><?=$rs['issue']?></p></td>
												<td> <p align="center"><?=$rs['date']?></p></td>
												<td> <p><?=$rs['title']?></p></td>
												<td><p align="center">
												<?
				
				
				$cats_sql = "SELECT site_newsletter_categories.name, site_newsletter_categories.id
FROM site_newsletter_categories_assign
JOIN site_newsletter_categories ON ( site_newsletter_categories_assign.newsletter_cat_id = site_newsletter_categories.id )
WHERE site_newsletter_categories_assign.newsletter_id = '".$rs['id']."'
ORDER BY site_newsletter_categories.name ";
			   
				$cats_result = mysql_query($cats_sql);
				if($cats_result) {
				  $num_news = mysql_num_rows($cats_result)-1;
				  $count = 0;
				  while($cats_row=mysql_fetch_assoc($cats_result)){
				    $total_sub+=$cat_totals[$cats_row['id']];
				    print( $count<$num_news?str_replace(" ","&nbsp;",$cats_row['name']).",<br>":$cats_row['name'] ); 
				    $count++;
				  }
				} 
				
												
												?>
												</p></td>
												<td><input type='text' id='send_individual_email_<?=$rs['id']?>' name='send_individual_email_<?=$rs['id']?>' value='' size='40'>&nbsp;<input type='button' name='submit_individual' value='Send' onClick='sendIndividual(<?=$rs['id']?>);'></td>
												<td><table><tr><td><div id='display_sent_<?=$rs['id']?>'><?=$rs['sent']?>&nbsp;of&nbsp;<?=$total_sub?></div></td><td><input type='button' name='submit_bulk' value='Send' onClick='sendBulk(<?=$rs['id']?>);' ></td></tr></table>
												<input type='hidden' id='sent_<?=$rs['id']?>' name='sent_<?=$rs['id']?>' value='<?=$rs['sent']?>'>
												<input type='hidden' id='total_sub_<?=$rs['id']?>' name='total_sub_<?=$rs['id']?>' value='<?=$total_sub?>'>
												</td>
<!--
												<td>
													<p align="center">
													<?php
														if ($rs['archived'] == 'No'){
															echo '<a href="newsletter.php?id=' . $rs['id'] . '&action=Archive">Archive</a>';
														}elseif ($rs['archived'] == 'Yes'){
															echo '<a href="newsletter.php?id=' . $rs['id'] . '&action=Unarchive">Unarchive</a>';
														}else{
															echo 'Archive';
														}
													?>
													</p>
												</td>
												-->
												<td>
													<p align="center">
														<a href="newsletter.php?file=<?=$rs['file']?>&action=Edit">Edit</a>
													</p>
												</td>
												<td>
													<p align="center">
														<a href="newsletter.php?file=<?=$rs['file']?>&action=Preview">Preview</a>
													</p>
												</td>
											  </tr>
										  <?php
										  	}
											mysql_close();
											mysql_free_result($result);
											?>
										</table>
										<?php										
										break;
								}
							?>
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