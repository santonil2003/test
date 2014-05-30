<?PHP

header("Cache-control: private");
require_once('../_common/_constants.php');
//db setup - configure & set up db connection
require_once('../_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();

$_upload_dir = IMAGES_LOCATION."/projects";
$quote_base = "../images/projects/"; 
$_valid_imgs = array('gif', 'jpg', 'jpeg', 'png');


switch($_GET['prop_action']) {

  case 'ChangePageSortOrderDown':
    down($_GET['prop_id'], $_GET['order']);
    break;
  case 'ChangePageSortOrderUp':
    up($_GET['prop_id'], $_GET['order']);
    break;
  case 'ChangePageActivationStatus':
    toggleActive($_GET['prop_id'],$_GET['stat']);
	 break; 
  case 'DeletePage':
    deleteQuote($_GET['prop_id']);
    break;
}

if(isset($_FILES['prop_img']['size']) && $_FILES['prop_img']['size']>0) {
  uploadQuote('prop_img');
} 


function down($id, $order) { 
  $new_order = $order + 1; 
  $sql = "SELECT id, sort_order FROM site_properties WHERE sort_order='{$new_order}'";
  $result = mysql_query($sql);
  if(mysql_num_rows($result) > 0){
    $row = mysql_fetch_array($result);
    $sql = "UPDATE site_properties SET sort_order = '{$order}' WHERE id ='{$row['id']}' ";
    mysql_query($sql);
    $sql = "UPDATE site_properties SET sort_order = '{$new_order}' WHERE id ='{$id}' ";
    mysql_query($sql);
  }
}

function up($id, $order) {
  $new_order = $order - 1; 
  if($new_order >= 1) { 
    $sql = "SELECT id, sort_order FROM site_properties WHERE sort_order='{$new_order}'";
    $result = mysql_query($sql);
    if(mysql_num_rows($result) > 0){
      $row = mysql_fetch_array($result);
      $sql = "UPDATE site_properties SET sort_order = '{$order}' WHERE id ='{$row['id']}' ";
      mysql_query($sql);
    }
    $sql = "UPDATE site_properties SET sort_order = '{$new_order}' WHERE id ='{$id}' ";
    mysql_query($sql);
  }
}

function toggleActive($id, $status){
  $sql = "UPDATE `site_properties` SET `active` = '".$status."' WHERE `id` ='".$id."' LIMIT 1";
  mysql_query($sql);
}

function uploadQuote($img) {
	
  global $_valid_imgs;
  global $_upload_dir;
  global $_FILES;

  if ($_FILES[$img]['size']>0) {
    $data['type'] = $_FILES[$img]['type'];
    $data['name'] = $_FILES[$img]['name'];
    $data['size'] = $_FILES[$img]['size'];
    $data['tmp_name'] = $_FILES[$img]['tmp_name'];

    // get file extension
    $ext = strtolower(substr(strrchr($data['name'],'.'), 1));
    if (in_array($ext,$_valid_imgs)) {
      $file_name = $_upload_dir."/".$data['name'];

      if (!move_uploaded_file($data['tmp_name'], $file_name)) {
        echo('error_uploading');
        return false;
      } 
     $sql = "SELECT `sort_order` FROM `site_properties` ORDER BY `sort_order` DESC LIMIT 1;";
     $result = mysql_query($sql);
     if(mysql_num_rows($result) > 0){
       $row = mysql_fetch_array($result);
 	    $sql="INSERT INTO `site_properties` (`id` ,`prop_name` ,`prop_img`, `prop_desc`, `prop_url`, `sort_order`, `active`)
 	      VALUES (NULL, '".$_POST['prop_name']."' , '".$data['name']."', '".$_POST['prop_desc']."' , '".$_POST['prop_url']."' ,
 	      '".((int)$row['sort_order']+1)."' , '1')";
	    mysql_query($sql);
       return $data['name'];
     } else {
       echo('error_inserting');
       return false;
     }
    }
    else
    {
      echo('error_wrong_type');
    }
  }
  return false;
}

function deleteQuote($id)
{
  global $_upload_dir; 
  
  $sql="SELECT `prop_img` FROM `site_properties` WHERE `id` = ".$id." LIMIT 1";
  $result = mysql_query($sql);
  
  if(mysql_num_rows($result)>0)
  {
    $row=mysql_fetch_array($result);
	$img = $row['prop_img'];
  }
	
  $full_img_name = $_upload_dir."/".$img;

  if (@unlink($full_img_name)) {
    $sql = "DELETE FROM `site_properties` WHERE `id` = {$id} ";
	mysql_query($sql);
  	return true;
  }
  else
  {
  	echo('error_cant_delete');
	return false;
  }
}

include('page_start.php');

?>
</td>
<td>
<br>
<table border="0" width="100%">
  <tr>
    <td>
      <table width="100%">
        <tr>
          <td colspan="5" bgcolor="#b8b6b6">
          <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2"><strong>New Latest Project</font>
          </td>
        </tr>
        <tr>
          <form name="new_prop" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" > 
          <td bgcolor="#CCCCCC" valign="top">
            Name: <input type="text" name="prop_name" value="" size="30">
          </td>
          <td bgcolor="#CCCCCC" valign="top">
            Image: <input type="file" name="prop_img" value="" size="30"><br><br>
            <small><b>Note:</b> images should be 178 x 100 pixels</small>
          </td >
          <td bgcolor="#CCCCCC" valign="top" style="text-align:top;">
            Description:&nbsp;<textarea name="prop_desc" rows="8" cols="20"></textarea>
          </td>
          <td bgcolor="#CCCCCC" valign="top">
            Link: <select name="prop_url">
                    <? include('../_pages/_internal_links.php'); ?>
                  </seclect>
          </td>
          <td bgcolor="#CCCCCC" valign="top">
            <input type="submit" name="submit" value="Create">
          </td>
          </form>
        </tr>
      </table><br>
      <table width="100%">
        <tr>
          <td colspan="8" bgcolor="#b8b6b6">
            <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2"><strong>Latest Projects</strong></font>
          </td>
        </tr>
        <tr>
          <td  bgcolor="#b8b6b6">
            <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2">Name</font>
          </td>
          <td  bgcolor="#b8b6b6">
            <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2">Image</font>
          </td>
			 <td  bgcolor="#b8b6b6">
            <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2">Description</font>
          </td>
          <td  bgcolor="#b8b6b6">
            <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2">Link</font>
          </td>
          <td colspan="2" bgcolor="#b8b6b6">
            <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2">Order</font>
          </td>
          <td colspan="2"  bgcolor="#b8b6b6">&nbsp;</td>
          
        </tr>
      <?
        $sql = "SELECT * FROM site_properties ORDER BY sort_order ASC ";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) > 0 ) {
          while($row = mysql_fetch_array($result)){
       ?>
        <tr>
          <td bgcolor="#CCCCCC"><?=$row['prop_name']?></td>
          <td bgcolor="#CCCCCC"><img src="../images/projects/<?=$row['prop_img']?>" alt="<?=$row['prop_img']?>" ></td>
			 <td bgcolor="#CCCCCC"><?=$row['prop_desc']?></td>
			 <td bgcolor="#CCCCCC"><?=$row['prop_url']?></td>
			 <td align="center" bgcolor="#CCCCCC"><a href="<?=$_SERVER['PHP_SELF']?>?prop_action=ChangePageSortOrderDown&prop_id=<?=$row['id']?>&order=<?=$row['sort_order']?>" border="0"><img src="images/level1down.gif" alt="Move Down" width="15" height="20" border="0"></a></td>
          <td align="center" bgcolor="#CCCCCC"><a href="<?=$_SERVER['PHP_SELF']?>?prop_action=ChangePageSortOrderUp&prop_id=<?=$row['id']?>&order=<?=$row['sort_order']?>" border="0"><img src="images/level1up.gif" alt="Move Up" width="15" height="20" border="0"></a></td>
          <td align="center" bgcolor="#CCCCCC"><a href="<?=$_SERVER['PHP_SELF']?>?prop_action=ChangePageActivationStatus&prop_id=<?=$row['id']?>&stat=<?=$row['active']=='1'?'0':'1'?>" border="0"><img src="images/<?=$row['active']=='1'?'active.gif':'inactive.gif'?>" alt="Click to change" width="20" height="20" border="0"></td>
          <td align="center" bgcolor="#CCCCCC"><a href="<?=$_SERVER['PHP_SELF']?>?prop_action=DeletePage&prop_id=<?=$row['id']?>" border="0" onClick="return confirm('Are you sure you want to delete this property?');"><img src="images/delete.gif" alt="Delete" width="20" height="20" border="0"></a></td>
        </tr>
        <? }
          } else {
        ?>
        <tr>
          <td colspan="7" bgcolor="#b8b6b6">
            No Featured Properties
          </td>
        </tr>
        <? } ?>
      </table>
    </td>
  </tr>
</table>
</td>
<?

include('page_end.php');

?>