<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Image library dialog
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// $Revision: 1.12 $, $Date: 2004/07/26 05:45:25 $
// ================================================

//error_reporting(E_ALL & ~E_NOTICE);

// unset $spaw_imglib_include
unset($spaw_imglib_include);

// include wysiwyg config
require_once('../../../_common/_constants.php');
include '../config/spaw_control.config.php';
include $spaw_root.'class/lang.class.php';
$theme = empty($_POST['theme'])?(empty($_GET['theme'])?$spaw_default_theme:$_GET['theme']):$_POST['theme'];
$theme_path = $spaw_dir.'lib/themes/'.$theme.'/';

$l = new SPAW_Lang(empty($_POST['lang'])?$_GET['lang']:$_POST['lang']);
$l->setBlock('image_insert');

$request_uri = urldecode(empty($_POST['request_uri'])?(empty($_GET['request_uri'])?'':$_GET['request_uri']):$_POST['request_uri']);

// if set include file specified in $spaw_imglib_include
if (!empty($spaw_imglib_include))
{
  include $spaw_imglib_include;
}
?>

<?php 
$imglib = isset($_POST['lib'])?$_POST['lib']:'';
if (empty($imglib) && isset($_GET['lib'])) $imglib = $_GET['lib'];

$value_found = false;
// callback function for preventing listing of non-library directory
function is_array_value($value, $key, $_imglib)
{
  global $value_found;
  // echo $value.'-'.$_imglib.'<br>';
  if (is_array($value)) array_walk($value, 'is_array_value',$_imglib);
  if ($value == $_imglib){
    $value_found=true;
  }
}
array_walk($spaw_imglibs, 'is_array_value',$imglib);

if (!$value_found || empty($imglib))
{
  $imglib = $spaw_imglibs[0]['value'];
}
$lib_options = liboptions($spaw_imglibs,'',$imglib);


$img = isset($_POST['imglist'])?$_POST['imglist']:'';

$preview = '';

$errors = array();

if (isset($_FILES['img_file']['size']) && $_FILES['img_file']['size']>0)
{
  if ($img = uploadImg('img_file'))
  {
    $preview = $spaw_base_url.$imglib.$img;
  }
}
// delete
if ($spaw_img_delete_allowed && isset($_POST['lib_action']) 
	&& ($_POST['lib_action']=='delete') && !empty($img)) {
  deleteImg();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
  <title><?php echo $l->m('title')?></title>
	<meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l->getCharset()?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $theme_path.'css/'?>dialog.css">
  <script language="javascript" src="utils.js"></script>
  
  <script language="javascript">
  <!--
    function selectClick()
    {
      if (document.libbrowser.lib.selectedIndex>=0 && document.libbrowser.imglist.selectedIndex>=0)
      {
        window.returnValue = '<?php echo $spaw_base_url?>'+document.libbrowser.lib.options[document.libbrowser.lib.selectedIndex].value + document.libbrowser.imglist.options[document.libbrowser.imglist.selectedIndex].value;
        window.close();
      }
      else
      {
        alert('<?php echo $l->m('error').': '.$l->m('error_no_image')?>');
      }
    }

	function deleteClick()
	{
	  if (document.libbrowser.imglist.selectedIndex>=0)
	  {
	  	document.libbrowser.lib_action.value = 'delete';
		document.libbrowser.submit();
	  }
	}

    function Init()
    {
      resizeDialogToContent();
    }
  //-->
  </script>
</head>

<body onLoad="Init()" dir="<?php echo $l->getDir();?>">
  <script language="javascript">
  <!--
    window.name = 'imglibrary';
  //-->
  </script>

  <script>
  	function UploadMessage(sAction) {
  		if (sAction == 'start') {
  			if (document.forms.libbrowser.img_file.value != '') {
	  			document.forms.libbrowser.upload_message.value = 'The file is being uploaded please wait...';
  			}
  		}else{
  			document.forms.libbrowser.upload_message.value = '';  			
  		}
  	}
  </script>
<form name="libbrowser" method="post" action="img_library.php?request_uri=<?php echo $_GET['request_uri']?>" enctype="multipart/form-data" target="imglibrary">
<input type="hidden" name="theme" value="<?php echo $theme?>">
<input type="hidden" name="request_uri" value="<?php echo urlencode($request_uri)?>">
<input type="hidden" name="lang" value="<?php echo $l->lang?>">
<input type="hidden" name="lib_action" value="">
<div style="border: 1 solid Black; padding: 5 5 5 5;">
<table border="0" cellpadding="2" cellspacing="0">
<tr>
  <td valign="top" align="left"><b><?php echo $l->m('library')?>:</b></td>
  <td valign="top" align="left">&nbsp;</td>
  <td valign="top" align="left"><b><?php echo $l->m('preview')?>:</b></td>
</tr>
<tr>
  <td valign="top" align="left">
  <select name="lib" size="1" class="input" style="width: 150px;" onChange="libbrowser.submit();">
    <?php echo $lib_options?>
  </select>
  </td>
  <td valign="top" align="left" rowspan="3">&nbsp;</td>
  <td valign="top" align="left" rowspan="3">
  <iframe name="imgpreview" src="<?php echo $preview?>" style="width: 200px; height: 100%;" scrolling="Auto" marginheight="0" marginwidth="0" frameborder="0"></iframe>
  </td>
</tr>
<tr>
  <td valign="top" align="left"><b><?php echo $l->m('images')?>:</b></td>
</tr>
<tr>
  <td valign="top" align="left">
  <?php 
   /* if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
      $_root = $_SERVER['DOCUMENT_ROOT'].'/';
    else
      $_root = $_SERVER['DOCUMENT_ROOT'];*/
    
	//$_root = '/home/echidna/public_html/minearc/';
	$_root = SITE_DIR;
    $d = @dir($_root.$imglib);
	$listing = array();
	if ($d)
	{
		while (false !== ($entry = $d->read()))
		{
			if (is_file($_root.$imglib.$entry))
			{
				$listing[] = $entry;
			}
		}
		$d->close();
		sort($listing);
	}
  ?>
  <select name="imglist" size="15" class="input" style="width: 150px;" 
    onchange="if (this.selectedIndex &gt;=0) imgpreview.location.href = '<?php echo $spaw_base_url.$imglib?>' + this.options[this.selectedIndex].value;" ondblclick="selectClick();">
<?php 
	if (0 < count($listing))
	{
		foreach ($listing as $entry)
		{
?>
          <option value="<?php echo $entry?>" <?php echo ($entry == $img)?'selected':''?>><?php echo $entry?></option>
<?php 
		}
	}
    else
    {
      $errors[] = $l->m('error_no_dir');
    }
?>

  </select>
  </td>
</tr>
<tr>
  <td valign="top" align="left" colspan="3">
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 0 0;">
  <tr>
    <td align="left" valign="middle" width="70%">
      <input type="button" value="<?php echo $l->m('select')?>" class="bt" onClick="selectClick();">
	  <?php if ($spaw_img_delete_allowed) { ?>
      <input type="button" value="<?php echo $l->m('delete')?>" class="bt" onClick="deleteClick();">
	  <?php } ?>
	</td>
	<td align="right" valign="middle" width="30%">
	  <input type="button" value="<?php echo $l->m('cancel')?>" class="bt" onClick="window.close();">
	</td>
  </tr>
  </table>
  </td>
</tr>
</table>
</div>

<?php  if ($spaw_upload_allowed) { ?>
<div style="border: 1 solid Black; padding: 5 5 5 5;">
<table border="0" cellpadding="2" cellspacing="0">
<tr>
  <td valign="top" align="left">
    <?php  
    if (!empty($errors))
    {
      echo '<span class="error">';
      foreach ($errors as $err)
      {
        echo $err.'<br>';
      }
      echo '</span>';
    }
    ?>

  <?php 
  if ($d) {
  ?>
    <b><?php echo $l->m('upload')?>:</b> <input type="file" name="img_file" class="input"><br>
    <input type="submit" name="btnupload" class="bt" value="<?php echo $l->m('upload_button')?>" onClick="javascript: UploadMessage('start')">&nbsp;<input type="text" name="upload_message" value="" style="border: 0; background-color: #FCFCFC; width: 250" readonly="true">
  <?php 
  }
  ?>
  </td>
</tr>
</table>
</div>
<?php  } ?>
</form>
</body>
</html>

<?php 
function liboptions($arr, $prefix = '', $sel = '')
{
  $buf = '';
  foreach($arr as $lib) {
    $buf .= '<option value="'.$lib['value'].'"'.(($lib['value'] == $sel)?' selected':'').'>'.$prefix.$lib['text'].'</option>'."\n";
  }
  return $buf;
}

function uploadImg($img) {
  global $_FILES;
  global $_SERVER;
  global $spaw_valid_imgs;
  global $imglib;
  global $errors;
  global $l;
  global $spaw_upload_allowed;
  
  if (!$spaw_upload_allowed) return false;
/*
  if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
    $_root = $_SERVER['DOCUMENT_ROOT'].'/';
  else
    $_root = $_SERVER['DOCUMENT_ROOT'];*/
	
 //$_root = '/home/echidna/public_html/minearc/';
 $_root = SITE_DIR;
  
  if ($_FILES[$img]['size']>0) {
    $data['type'] = $_FILES[$img]['type'];
    $data['name'] = $_FILES[$img]['name'];
    $data['size'] = $_FILES[$img]['size'];
    $data['tmp_name'] = $_FILES[$img]['tmp_name'];

    // get file extension
    $ext = strtolower(substr(strrchr($data['name'],'.'), 1));
    if (in_array($ext,$spaw_valid_imgs)) {
   	  $dir_name = $_root.$imglib;
      $img_name = $data['name'];
      $i = 1;
      while (file_exists($dir_name.$img_name)) {
        $img_name = ereg_replace('(.*)(\.[a-zA-Z]+)$', '\1_'.$i.'\2', $data['name']);
        $i++;
      }

      if (!move_uploaded_file($data['tmp_name'], $dir_name.$img_name)) {
        $errors[] = $l->m('error_uploading');

        return false;
      }
//      chmod($dir_name.$img_name, 0644);
      return $img_name;
    }
    else
    {
    	$errors[] = $l->m('error_wrong_type');
    }
  }
  return false;
}

function deleteImg()
{
  global $_SERVER;
  global $imglib;
  global $img;
  global $spaw_img_delete_allowed;
  global $errors;
  global $l;
  
  if (!$spaw_img_delete_allowed) return false;

  /*if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
    $_root = $_SERVER['DOCUMENT_ROOT'].'/';
  else
    $_root = $_SERVER['DOCUMENT_ROOT'];*/
	
 // $_root = '/home/echidna/public_html/minearc/';
 $_root = SITE_DIR;
	
  $full_img_name = $_root.$imglib.$img;

  if (@unlink($full_img_name)) {
  	return true;
  }
  else
  {
  	$errors[] = $l->m('error_cant_delete');
	return false;
  }
}
?>