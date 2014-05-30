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
// $Rev. 1.8 08/31/03 by the_sandking@hotmail.com
//	Added delete feature for image handler
// ================================================

// changed to Files library dialog
// ================================================
// 07/13/04 Mindaugas Griunas, info@salonas.lt
// ================================================

// include wysiwyg config
require_once('../../../_common/_constants.php');
include '../config/spaw_control.config.php';
include $spaw_root.'class/lang.class.php';

$js_action = $_POST['js_action'];
$js_docdir = $_POST['js_docdir'];
$js_docfile = $_POST['js_docfile'];

//remove dir from link

if (empty($_POST['short_link']) && ($link!='undefined' && !empty($link))) {
$short_link = substr(strrchr($link,'/'), 1); 
$short_doc = ereg_replace($spaw_base_url,"",ereg_replace($short_link,"",$link));
}


$theme = empty($_POST['theme'])?(empty($_GET['theme'])?$spaw_default_theme:$_GET['theme']):$_POST['theme'];
$theme_path = $spaw_dir.'lib/themes/'.$theme.'/';

$l = new SPAW_Lang(empty($_POST['lang'])?$_GET['lang']:$_POST['lang']);
$l->setBlock('doc');
?>

<?php 
$doclib = $_POST['lib'];
if (empty($doclib)) $doclib = $_GET['lib'];
if (!empty($short_doc)) $doclib = $short_doc;
$value_found = false;
// callback function for preventing listing of non-library directory
function is_array_value($value, $key, $_doclib)
{
  global $value_found;
  // echo $value.'-'.$_imglib.'<br>';
  if (is_array($value)) array_walk($value, 'is_array_value',$_doclib);
  if ($value == $_doclib){
    $value_found=true;
  }
}
array_walk($spaw_doclibs, 'is_array_value',$doclib);

if (!$value_found || empty($doclib))
{
  $doclib = $spaw_doclibs[0]['value'];
}
$lib_options = liboptions($spaw_doclibs,'',$doclib);


//$doc = $_POST['doclist'];

$preview = '';

$errors = array();
if ($_FILES['doc_file']['size']>0)
{
  if ($doc = uploadDocs('doc_file'))
  {
    $preview = $spaw_base_url.$doclib.$doc;
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
  <title><?php echo $l->m('title')?></title>
	<meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l->getCharset()?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/dialog.css">
  <script language="javascript" src="<?php echo $theme_path?>../../../dialogs/utils.js"></script>
  
  <script language="javascript">
  <!--
    function selectClick()
    {
      if (document.libbrowser.lib.selectedIndex>=0 && document.libbrowser.doclist.selectedIndex>=0)
      {
	  
	  	var lProps = {};
		lProps.actions="InsertLink";
		lProps.link='<?php echo $spaw_base_url?>'+document.libbrowser.lib.options[document.libbrowser.lib.selectedIndex].value + document.libbrowser.doclist.options[document.libbrowser.doclist.selectedIndex].value;
//		lProps.target=document.linkForm.targetSelect.value;
		lProps.target="_self";
		window.returnValue = lProps;
        window.close();
      }
      else
      {
        alert('<?php echo $l->m('error').': '.$l->m('error_no_file')?>');
      }
    }
	
  function confirmDeleteDoc()
	{

		if (document.libbrowser.lib.selectedIndex>=0 && document.libbrowser.doclist.selectedIndex>=0)
		{
			var ok_to_delete ='<?php echo $spaw_doc_delete_allowed ?>'
			if (!ok_to_delete)
			{
				alert('<?php echo $l->m('error').': '.$l->m('alert_delete_auth')?>');
			}
				else
				{
			
					var agree=confirm('<?php echo $l->m('alert_delete_confirm')?>');

					if (agree)
					{
						var js_docdir = document.libbrowser.lib.options[document.libbrowser.lib.selectedIndex].value;
						var js_docfile = document.libbrowser.doclist.options[document.libbrowser.doclist.selectedIndex].value;
						var js_action = 'delete';
				
						document.libbrowser.js_docdir.value = js_docdir;
						document.libbrowser.js_docfile.value = js_docfile;
						document.libbrowser.js_action.value = js_action;
						libbrowser.submit(); 

					} //end if (agree)
				}// end else
		} //end if  (document....
		
		 else
      	{
        	alert('<?php echo $l->m('error').': '.$l->m('error_no_file')?>');
      	} //end else
   } //end confirmDeleteImage()  

	function RemoveDoc() {

	var lProps = {};
	lProps.actions="RemoveLink";
	window.returnValue = lProps;
    window.close();
	}
	
    function Init()
    {

//      resizeDialogToContent();
    }
  //-->
  </script>
</head>

<body onLoad="Init()" dir="<?php echo $l->getDir();?>">
  <script language="javascript">
  <!--
    window.name = 'doclibrary';
  //-->
  </script>

  <script>
  	function UploadMessage(sAction) {
  		if (sAction == 'start') {
  			if (document.forms.libbrowser.doc_file.value != '') {
	  			document.forms.libbrowser.upload_message.value = 'The file is being uploaded please wait...';
  			}
  		}else{
  			document.forms.libbrowser.upload_message.value = '';  			
  		}
  	}
  </script>

<form name="libbrowser" method="post" action="<?php echo $theme_path?>../../../dialogs/doc_library.php" enctype="multipart/form-data" target="doclibrary">
<input type="hidden" name="theme" value="<?php echo $theme?>">
<input type="hidden" name="lang" value="<?php echo $l->lang?>">
<input type="hidden" name="js_docdir" value="<?php echo $js_docdir?>">
<input type="hidden" name="js_docfile" value="<?php echo $js_docfile?>">
<input type="hidden" name="js_action" value="<?php echo $js_action?>">

<div style="border: 1 solid Black; padding: 5 5 5 5;">
<table border="0" cellpadding="2" cellspacing="0">
<tr>
  <td valign="top" align="left"><b><?php echo $l->m('library')?>:</b></td>
</tr>
<tr>
  <td valign="top" align="left">
  <select name="lib" size="1" class="input" style="width: 150px;" onChange="libbrowser.submit();">
    <?php echo $lib_options?>
  </select>
  </td>
</tr>
<tr>
  <td valign="top" align="left"><b><?php echo $l->m('docs')?>:</b> </td>
</tr>
<tr>
  <td valign="top" align="left">
  <?php 
   /* if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
      $_root = $_SERVER['DOCUMENT_ROOT'].'/';
    else
      $_root = $_SERVER['DOCUMENT_ROOT'];*/
    
	$_root = SITE_DIR;
    $d = @dir($_root.$doclib);
  ?>
  <select name="doclist" size="15" class="input" style="width: 300px;" ondblclick="selectClick();">
  <?php 
    if ($d) 
    {
      while (false !== ($entry = $d->read())) {
        if (is_file($_root.$doclib.$entry))
        {
          ?>
          <option value="<?php echo $entry?>" <?php echo ($entry == $short_link)?'selected':''?>><?php echo $entry?></option>
          <?php 
        }
      }
      $d->close();
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

<?php

if ($js_action == "delete") 
	{
		// assemble the target for killing the file
		$goner = $_root . $js_docdir . $js_docfile;

		if (file_exists($goner)) 
		{
			//delete it	
			echo "$goner";
			unlink($goner);
			
			
			//display the tombstone (passes by very quickly.. perhaps someone on a dial-up will see the msg)
			//echo "$js_action --> $file";
			
			/// zero out all the variables so we don't go into a loop
   			$js_action = "";
			$js_docdir = "";
			$js_docfile = "";
?>
			<input type="hidden" name="js_docdir" value="">
			<input type="hidden" name="js_docfile" value="">
			<input type="hidden" name="js_action" value="">
			
			<script language="javascript">
  			<!--
   			 libbrowser.submit(); 
  			//-->
  			</script>
<?php	
		} //end if (file_exists($goner)) 
		
		else echo $l->m('error_delete_file');
//		return false;
	} // end if ($js_action == "delete")

?>

  <td valign="top" align="left" colspan="3">
<input type="hidden" name="short_link" value="<?php echo $short_link?>">
  <input type="button" value="<?php echo $l->m('select')?>" class="bt" onClick="selectClick();">
  &nbsp;<input type="button" value="<?php echo $l->m('delete')?>" class="bt" onClick="confirmDeleteDoc();">
  &nbsp;<input type="button" value="<?php echo $l->m('cancel')?>" class="bt" onClick="window.close();">
  &nbsp;<input type="button" value="<?php echo $l->m('remove')?>" class="bt" onClick="RemoveDoc();">
  </td>
</tr>
</table>
</div>

<?php  if ($spaw_doc_upload_allowed) { ?>
<div style="border: 1 solid Black; padding: 5 5 5 5;">
<table border="0" cellpadding="2" cellspacing="0">
<tr>
  <td valign="top" align="left" nowrap>
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
    <b><?php echo $l->m('upload')?>:</b>&nbsp;<input type="file" name="doc_file" class="input" size="19"><br>
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

function uploadDocs($doc) {

  global $_FILES;
  global $_SERVER;
  global $spaw_valid_docs;
  global $doclib;
  global $errors;
  global $l;
  global $spaw_doc_upload_allowed;
  
  if (!$spaw_doc_upload_allowed) return false;

/*  if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
    $_root = $_SERVER['DOCUMENT_ROOT'].'/';
  else
    $_root = $_SERVER['DOCUMENT_ROOT'];*/
  $_root = SITE_DIR;
  
  if ($_FILES[$doc]['size']>0) {
    $data['type'] = $_FILES[$doc]['type'];
    $data['name'] = $_FILES[$doc]['name'];
    $data['size'] = $_FILES[$doc]['size'];
    $data['tmp_name'] = $_FILES[$doc]['tmp_name'];

    // get file extension
    $ext = strtolower(substr(strrchr($data['name'],'.'), 1));
    if (in_array($ext,$spaw_valid_docs)) {
      $dir_name = $_root.$doclib;

      $doc_name = $data['name'];
      $i = 1;
      while (file_exists($dir_name.$doc_name)) {
        $doc_name = ereg_replace('(.*)(\.[a-zA-Z]+)$', '\1_'.$i.'\2', $data['name']);
        $i++;
      }
      if (!move_uploaded_file($data['tmp_name'], $dir_name.$doc_name)) {
        $errors[] = $l->m('error_uploading');
        return false;
      }
  chmod($dir_name.$doc_name, 0644);
      return $doc_name;
    }
    else
    {
      $errors[] = $l->m('error_wrong_type');
    }
  }
  return false;
}
?>