<?php

require_once('page_start.php');

$link = '';
$name = '';
$id = -1;
$sort_order = -1;
$section_id = -1;
$action = 'New';
$page_type = 'download';

if(isset($_GET['action']) && $_GET['action']=='editPage'){
  $action = 'Edit';
  $id = $_GET['id'];
  if(isset($_GET['id']) && $_GET['id']!=''){
    $sql = "SELECT * FROM site_pages WHERE page_id = '".$_GET['id']."' LIMIT 1";
    $result = mysql_query($sql);
    if(mysql_num_rows($result) == 1) {
      $row = mysql_fetch_array($result);
      $name = $row['page'];
      $link = $row['name'];
    }
  }
} else {

 $sort_order = $_GET['sort_order'];
 $section_id = $_GET['section_id']; 

}


?><body bgcolor="#4C4C4C">
</td>
<td>
<br>
<table border="0" width="100%">
  <tr>
    <td>
      <form name="new_link" method="post" action="content_pages.php">
      <input name="page_type" type="hidden" value="<?=$page_type?>">
      <input name="form_action" type="hidden" value="<?=$action?>">
      <input name="page_id" type="hidden" value="<?=$id?>">
      <input name="sort_order" type="hidden" value="<?=$sort_order?>">
      <input name="section_id" type="hidden" value="<?=$section_id?>">
      <table width="100%">
        <tr>
          <td colspan="5" bgcolor="#b8b6b6">
          <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2"><strong><?=$action?> Download</font>
          </td>
       </tr>
       <tr>
         <td width="50" bgcolor="#CCCCCC" valign="top" align="right">Name:</td>
         <td colspan="4" bgcolor="#CCCCCC" valign="top" align="left"><input type="text" value="<?=$name?>" name="page" size="30"></td>
       <tr>
       <tr>
         <td width="50"bgcolor="#CCCCCC" valign="top" align="right">File&nbsp;URL:</td>
         <td colspan="4" bgcolor="#CCCCCC" valign="top" align="left"><input type="text" value="<?=$link?>" id="name" name="name" size=50">&nbsp;
         &nbsp;<input type="button" value="Browse" onclick="updateText();">
		 </tr>       
       <tr>
        <td colspan="5" bgcolor="#CCCCCC" valign="top">
          <input type="submit" name="Submit" value="Update">
        </td>
       </tr>
      </table>
    </td>
  </tr>
</table>
</td>
<script> 
function updateText(){

var doc =  window.showModalDialog('spaw/dialogs/doc_library.php', '#000000', 
      'dialogHeight:420px; dialogWidth:400px; resizable:no; status:no');

if(doc.link != null) {  
  var link = doc.link.substring(28,doc.link.length);
  document.getElementById('name').value = link;
}

}
</script>
<?PHP include('footer_new.php'); ?>