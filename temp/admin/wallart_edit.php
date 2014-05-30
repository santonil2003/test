<?php
require_once('page_start.php');

$art_name = '';
$preview_img = '';
$main_img = '';
$info = '';

if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM wall_art WHERE id='$id' LIMIT 1";
  //echo $sql;
  $result=mysql_query($sql);
  $row = mysql_fetch_array($result);
  $art_name = $row['name'];
  $preview_img = $row['preview_img'];
  $main_img = $row['main_img'];
  $info = $row['info'];
} else {
  $id = '-1';
}

?>
<script type="text/javascript">

function updateText(id){

  var doc =  window.showModalDialog('spaw/dialogs/img_library.php', '#000000', 
      'dialogHeight:420px; dialogWidth:400px; resizable:no; status:no');

  if(doc != null) {  
    var link = doc.substring(27,doc.length);
    document.getElementById(id+"_img").value = link;
    preview = document.getElementById(id+"_img_prev");
    preview.src = link;
    preview.alt = link;
    //preview.style.width="250px";
 }

}

</script>
<form method="POST" action="wallart.php">
  <input type="hidden" name="id" value="<?=$id?>" >
  <table width="80%" >
    <tr>
      <td colspan="2" bgcolor="#b8b6b6"><font color="#ffffff" >Edit Wallart</font></td>  
    </tr>
    <tr bgcolor="#CCCCCC" >
      <td><p align="left" ><strong>Name</strong> </p></td><td><input type="text" name="art_name" value="<?=$art_name?>" size="60" ></td>  
    </tr>
    <tr bgcolor="#CCCCCC"> 
      <td width="16%" bgcolor="#CCCCCC"><p align="left" ><strong>Main Image</strong> </p></td>
      <td width="84%" bgcolor="#CCCCCC"> 
        <p align="left" >
          <? if($main_img=="") { ?>
            <img id="main_img_prev" src="../images/gen/spacer.gif" alt="" >
          <? } else { ?>
            <img id="main_img_prev" src="<?PHP echo addslashes($main_img); ?>" alt="<?PHP echo addslashes($main_img); ?>"  >
          <? } ?>
          <small>Uploaded Images must be x pixels</small><br><br>
          <input type="text" size="60" name="main_img" id="main_img" value="<?PHP echo addslashes($main_img); ?>">&nbsp;<input type="button" value="Browse" onclick="updateText('main');">
          </p>
        </td>
     </tr> 
    <tr bgcolor="#CCCCCC"> 
      <td width="16%" bgcolor="#CCCCCC"><p align="left" ><strong>Infomation Image</strong> </p></td>
      <td width="84%" bgcolor="#CCCCCC"> 
        <p align="left" >
          <? if($preview_img=="") { ?>
            <img id="preview_img_prev" src="../images/gen/spacer.gif" alt="" >
          <? } else { ?>
            <img id="preview_img_prev" src="<?PHP echo addslashes($preview_img); ?>" alt="<?PHP echo addslashes($preview_img); ?>"  >
          <? } ?>
          <small>Uploaded Images must be x pixels</small><br><br>
          <input type="text" size="60" name="preview_img" id="preview_img" value="<?PHP echo addslashes($preview_img); ?>">&nbsp;<input type="button" value="Browse" onclick="updateText('preview');">
          </p>
        </td>
     </tr>
     <tr bgcolor="#CCCCCC"> 
      <td width="16%" bgcolor="#CCCCCC"><p align="left" ><strong>Information</strong> </p></td>
      <td width="84%" bgcolor="#CCCCCC"> 
        <p align="left" >
          <textarea name="info" cols="50" rows="15" ><?=$info;?></textarea>
        </p>
       </td>
     </tr>         
    <tr bgcolor="#CCCCCC" >
      <td colspan="2">
        <input type="submit" name="update" value="Update" />
        <input type="button" name="exit" value="Exit" onclick="Javascript: window.location='wallart.php';"/>
      </td>
    </tr>
  </table>
</form>
<? require_once('page_end.php'); ?>