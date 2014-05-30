<?php
require_once('page_start.php');

if(isset($_GET['delete']) && $_GET['delete']!="" ){
  $sql="DELETE FROM wall_art WHERE id='".$_GET['id']."' ";
  mysql_query($sql);
}

if(isset($_POST['update']) && $_POST['update']!=""){
  if($_POST['id'] == '-1'){
    $sql = "INSERT INTO wall_art SET name = '".$_POST['art_name']."',
      preview_img = '".$_POST['preview_img']."', main_img='".$_POST['main_img']."', info='".$_POST['info']."' ";
    //echo $sql;
    mysql_query($sql);
  } else {
    $sql = "UPDATE wall_art SET name = '".$_POST['art_name']."',
      preview_img = '".$_POST['preview_img']."', main_img='".$_POST['main_img']."', info='".$_POST['info']."'  WHERE id='".$_POST['id']."' LIMIT 1";
    //echo $sql;
    mysql_query($sql);
  }
}

$sql = "SELECT * FROM wall_art ORDER BY id";
$result = mysql_query($sql);
?>
<script type="text/javascript">
  function delete_item(id){
    if(confirm('Do you really want to delete this?')){
      window.location='wallart.php?delete=1&id='+id;
      return true; 
    }
    return false; 
  }
</script>
<form>
  <input type="hidden" name="id" value="<?=$id?>" >
  <table width="80%" >
    <tr>
      <td colspan="5" bgcolor="#b8b6b6">
        <strong><font color="#ffffff" >Wallart</font></strong>
        &nbsp;&nbsp;<input type="button" value="New Wall Art" onclick="Javascript: window.location='wallart_edit.php?id=-1';" >
      </td>  
    </tr>
    <tr bgcolor="#CCCCCC" >
      <td><p align="left" ><strong>Name</strong></td>
      <td><p align="left" ><strong>Main Image</strong></td>
      <td><p align="left" ><strong>Info Image</strong></td>  
      <td colspan="2"  ><p align="left">&nbsp;</td>
    </tr>
    <? 
      if(mysql_num_rows($result) === 0 ) {
    ?> 
    <tr bgcolor="#CCCCCC"> 
      <td width="16%" bgcolor="#CCCCCC" colspan="5"><br><p align="middle" >No Items, Please Create a New Wall Art Item</p><br></td>
     </tr>
     <? 
     } else {
       while($row = mysql_fetch_array($result)) {
     ?>
     <tr bgcolor="#CCCCCC"> 
      <td bgcolor="#CCCCCC"><?=$row['name'];?></td>
      <td bgcolor="#CCCCCC"><img width="50px" src="<?=$row['main_img']?>" alt="<?=$row['main_img']?>" /></td>
      <td bgcolor="#CCCCCC"><img width="50px" src="<?=$row['preview_img']?>" alt="<?=$row['main_img']?>" /></td>
      <td bgcolor="#CCCCCC"><input type="button" value="Edit" onclick="Javascript: window.location='wallart_edit.php?id=<?=$row['id']?>';" ></td>
      <td bgcolor="#CCCCCC"><input type="button" value="Delete" onclick="delete_item('<?=$row['id']?>');" ></td>
    </tr>
    <?
      }
    }
    ?>
  </table>
</form>
<? require_once('page_end.php'); ?>