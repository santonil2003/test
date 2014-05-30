<?PHP
	require_once('../_common/_connection.php');
	require_once('../_common/_constants.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();
?>
<? 
  require_once("header_new.php");
  require_once("msg_box.php");
?>

<td valign="top">
<table width="630" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td colspan="3"><strong><font size="4"><br>
        Edit Subscriptions
        </font></strong>&nbsp;&nbsp;&nbsp;<a href="new" onclick="return newSub();">New Subscription</a><br><hr noshade> 
        <?php
 if (isset($_GET['id']))
 {
 	$id = $_GET['id'];	
	$sql = "DELETE FROM email_list WHERE id = '$id'";
	if ($result = mysql_query($sql))
		echo "<BR />Successfully removed from mailing list";
	else
		echo "Database error";
		
 }
 
  if($_GET['order']=='DESC') {
    $nextOrder = 'ASC';
    $nowOrder = 'DESC';
  } else {
    $nextOrder = 'DESC';
    $nowOrder = 'ASC';
  }
  
  if($_GET['sort']!='') $sort = $_GET['sort'];
  else $sort = 'id';
  
?>
      </td>
    </tr>
    <tr bgcolor="#d7d4cd"> 
      <td width="150"><a href="<?=$_SERVER['PHP_SELF'];?>?sort=name<?=$_GET['sort']=='name'?"&order=".$nextOrder:'';?>"><strong>Name</strong></a></td>
      <td width="200"><a href="<?=$_SERVER['PHP_SELF'];?>?sort=email<?=$_GET['sort']=='email'?"&order=".$nextOrder:'';?>"><strong>Email Address</strong></a></td>
      <td><strong>remove</strong></td>
      <td><strong>edit</strong></td>
    </tr>
    <?php 
			$sql = "SELECT * FROM email_list ORDER BY {$sort} {$nowOrder}";
			$result = mysql_query($sql);
			$alt = false;
			while ($rows = mysql_fetch_assoc($result))
			{
			  if($alt==false){ 
             $alt=true;
             $colour = "#f4f3f0";
           } else {
             $alt=false;
             $colour = "#ffffff";
           }
				echo "<tr bgcolor=\"".$colour."\" ><td><div id='name_".$rows['id']."'>".$rows['name']."</div></td>
				<td><div id='email_".$rows['id']."'>".$rows['email']."</div></td>
				<td><a href='edit_mailing_list.php?id=".$rows['id']."&sort={$sort}&order={$nowOrder}'>remove</a>
				<td><a href='edit' onclick='return editSub(\"".$rows['id']."\");'>edit</a></td>
				</tr>";
			}	
		?>
    <tr> 
      <td colspan="3"><hr noshade></td>
    </tr>
    <tr>
      <td colspan="3"><a href="view_mailing_list.php">Prepare 
        Subscriber List</a></td>
    </tr>
  </table>
</td>
<script type="text/javascript">

  var currentId = '';
  var newName = '';
  var newEmail = '';
  
  function editSub(id) {
    currentId = id;
    msg.load('ok');
    var initContent = '<strong>Edit Subscription</strong><br><br>';
    initContent+= 'Name: <input type="text" size="30" id="name" value="'+$("#name_"+id).html()+'"><br>Email: <input type="text" size="30" id="email" value="'+$("#email_"+id).html()+'"><br>';
    initContent+= '<input type="button" value="Update" onclick="updateSub(0)"><br><div id="statusDiv"></div><br><br>';
    msg.content(initContent);
    return false;
  
  }
  
  function newSub() {
  
    currentId = '-1';
    msg.load('ok');
    var initContent = '<strong>New Subscription</strong><br><br>';
    initContent+= 'Name: <input type="text" size="30" id="name" value=""><br>Email: <input type="text" size="30" id="email" value=""><br>';
    initContent+= '<input type="button" value="Update" onclick="updateSub(1)"><br><div id="statusDiv"></div><br><br>';
    msg.content(initContent);
    return false;
  
  }

  function updateSub(type) {
    newName = $("#name").val();
    newEmail = $("#email").val();
    $("#statusDiv").html('<img src="../images/gen/loading.gif" width="15">');
    $.ajax({
      type: "POST",
      url: "update_sub.php",
      data: {id:currentId, name:newName, email:newEmail},
      dataType: "responseText",
      success : function(text) {
        if(text=='true') {
          $("#statusDiv").html('<small>Subscription updated</small>');
          if(type==0){
            $("#name_"+currentId).html(newName);
            $("#email_"+currentId).html(newEmail);
          } else {
            msg.click('ok', 'window.location="<?=$_SERVER['PHP_SELF'];?>?sort=<?=$sort?>&order=<?=$nowOrder?>"');
          }
        } else {
          $("#statusDiv").html('<small>Error updating Subscription</small>');
        }
      }
    });
     
  }
 
  
</script>
<? include("footer_new.php"); ?>