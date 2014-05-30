<?PHP
	require_once('../_common/_connection.php');
	require_once('../_common/_constants.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();

	
	function addNewsletter($id, $title, $content)
	{
	
	   $sql = "INSERT INTO `site_newsletters` (`title`, `content`) VALUES ('{$title}', '{$content}')";
	   mysql_query($sql);
		
	}

	function editNewsletter($id, $title, $content)
	{
	
	  $sql = "UPDATE `site_newsletters` SET `title`='{$title}', `content` = '{$content}' WHERE `id` = {$id}";
	  mysql_query($sql);
	
	}

	function deleteNewsletter($id)
	{

	  $sql = "DELETE FROM `site_newsletters` WHERE `id` = {$id}";
	  mysql_query($sql);
		
	}
	
	if(isset($_POST['id']) && $_POST['id']!='') {
	
	   $id = $_POST['id'];
	   $content = str_replace("'", "&#39;",$_POST['spaw1']);;
	   $title = str_replace("'", "''",stripslashes($_POST['title']));
	   $file_name = $_POST['file_name'];
	   
	   if($id=='new') {
        addNewsletter($id, $title, $content);
	   } else {
		  editNewsletter($id, $title, $content);
	   }
	
	}
	
	if(isset($_GET['id']) && $_GET['id']!='') {
	  deleteNewsletter($_GET['id']);
	}
	
?>
<? require_once("header_new.php"); ?>

<td valign="top">
<div id="blockBox" style="background-color:#ffffff;display:none;cursor:default;text-align:center"> 
  <br><div style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:14px; color: #676767;" id="blockBoxContents"></div><br>
  <table border="0" width="100%" align="center"><tr align="center" ><td align="center">
  <table border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td align="center">
        <div id="okButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="image" src="../images/nav/n_ok_o.gif" alt="OK" style="cursor: pointer;" class="ok" id="ok" value="OK" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ok','','../images/nav/n_ok_x.gif',1)"/></div>
      </td>
      <td align="center">
        <div id="yesButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="image" src="../images/nav/n_yes_o.gif" alt="YES" style="cursor: pointer;" class="yes" id="yes" value="YES" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('yes','','../images/nav/n_yes_x.gif',1)"/></div>
      </td>
      <td align="center">
        <div id="noButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="image" src="../images/nav/n_no_o.gif" alt="NO" style="cursor: pointer;" class="no" id="no" value="NO" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('no','','../images/nav/n_no_x.gif',1)"/></div>
      <td>
    </tr>
   </table>
   </td></tr></table>
  <br>
</div>

<table width="1000" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td colspan="6"><strong><font size="4"><br>
        Edit Newletters</font></strong>&nbsp;&nbsp;&nbsp;<a href='newsletter_edit.php?id=new'>Add Newsletter</a><br> <hr noshade> 
      </td>
    </tr>
    <tr bgcolor="#d7d4cd"> 
      <td width="300"><strong>Title</strong></td>
      <td width="250"><strong>Individual Send</strong></td>
      <td><strong>Bulk Send</strong></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php 
         $sql = "SELECT * FROM ".BULK_EMAIL_TABLE;
			$result = mysql_query($sql); 
			$total_sub = mysql_num_rows($result);
			
			$sql = "SELECT * FROM site_newsletters";
			$result = mysql_query($sql);
			$alt = false;
			if($result) {
			while ($rows = mysql_fetch_assoc($result))
			{
			  if($alt==false){ 
             $alt=true;
             $colour = "#f4f3f0";
           } else {
             $alt=false;
             $colour = "#ffffff";
           }
				echo "<tr bgcolor=\"".$colour."\" ><td>".$rows['title']."</td>
				<td><input type='text' id='send_individual_email_".$rows['id']."' name='send_individual_email_".$rows['id']."' value='' size='40'>&nbsp;<input type='button' name='submit_individual' value='Send' onClick='sendIndividual(".$rows['id'].");'></td>
				<td><table><tr><td><div id='display_sent_".$rows['id']."'>".$rows['sent']."&nbsp;of&nbsp;".$total_sub." Sent</div></td><td><input type='button' name='submit_bulk' value='Send' onClick='sendBulk(".$rows['id'].");' ></td></tr></table>
				<input type='hidden' id='sent_".$rows['id']."' name='sent_".$rows['id']."' value='".$rows['sent']."'></td>
				<td>&nbsp;<a href='newsletter_preview.php?id=".$rows['id']."' target='_blank' >preview</a>&nbsp;</td>
				<td>&nbsp;<a href='newsletter_edit.php?id=".$rows['id']."'>edit</a>&nbsp;</td>
				<td>&nbsp;<a href='newsletter_manage.php?id=".$rows['id']."'>remove</a></td>
				</tr>";
			}	
			}
		?>
    <tr> 
      <td colspan="6"><input type="hidden" id="total_sub" name="total_sub" value="<?=$total_sub?>" ><hr noshade></td>
    </tr>
  </table>
</td>
<script type="text/javascript">

  var blockBox = '';
  $(document).ready(
    function(){
      blockBox = $("#blockBox")[0];
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
  var total_sub = parseInt($("#total_sub").val());
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
  
  function setupBockBox() {
  
    $.blockUI(blockBox, { width: '325px' });
    
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
<? include("footer_new.php"); ?>
