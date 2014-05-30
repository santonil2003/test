<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Table cell properties dialog
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.1.0, 2003-04-01
// ================================================

// include wysiwyg config
require_once('../../../_common/_constants.php');
include '../config/spaw_control.config.php';
include $spaw_root.'class/lang.class.php';

$theme = empty($HTTP_GET_VARS['theme'])?$spaw_default_theme:$HTTP_GET_VARS['theme'];
$theme_path = $spaw_dir.'lib/themes/'.$theme.'/';

$l = new SPAW_Lang($HTTP_GET_VARS['lang']);
$l->setBlock('table_cell_prop');

$request_uri = urldecode(empty($HTTP_POST_VARS['request_uri'])?(empty($HTTP_GET_VARS['request_uri'])?'':$HTTP_GET_VARS['request_uri']):$HTTP_POST_VARS['request_uri']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<meta http-equiv="Pragma" content="no-cache">
  <title><?php echo $l->m('title')?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l->getCharset()?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $theme_path.'css/'?>dialog.css">
  <script language="javascript" src="utils.js"></script>
  <script language="javascript">
  <!--  
  function showColorPicker(curcolor) {
    var newcol = showModalDialog('colorpicker.php?theme=<?php echo $theme?>&lang=<?php echo $l->lang?>', curcolor, 
      'dialogHeight:250px; dialogWidth:366px; resizable:no; status:no');  
    try {
      td_prop.cbgcolor.value = newcol;
      td_prop.color_sample.style.backgroundColor = td_prop.cbgcolor.value;
    }
    catch (excp) {}
  }

  function showImgPicker()
  {
    var imgSrc = showModalDialog('<?php echo $spaw_dir?>dialogs/img_library.php?theme=<?php echo $theme?>&lang=<?php echo $l->lang?>&request_uri=<?php echo $request_uri?>', '', 
      'dialogHeight:420px; dialogWidth:420px; resizable:no; status:no');
    
    if(imgSrc != null)
	{
		td_prop.cbackground.value = imgSrc;
	}
  }
  
  function Init() {
    var cProps = window.dialogArguments;
    if (cProps)
    {
      // set attribute values
      td_prop.cbgcolor.value = cProps.bgColor;
      td_prop.color_sample.style.backgroundColor = td_prop.cbgcolor.value;
	  td_prop.cbackground.value = cProps.background;
      if (cProps.width) {
        if (!isNaN(cProps.width) || (cProps.width.substr(cProps.width.length-2,2).toLowerCase() == "px"))
        {
          // pixels
          if (!isNaN(cProps.width))
            td_prop.cwidth.value = cProps.width;
          else
            td_prop.cwidth.value = cProps.width.substr(0,cProps.width.length-2);
          td_prop.cwunits.options[0].selected = false;
          td_prop.cwunits.options[1].selected = true;
        }
        else
        {
          // percents
          td_prop.cwidth.value = cProps.width.substr(0,cProps.width.length-1);
          td_prop.cwunits.options[0].selected = true;
          td_prop.cwunits.options[1].selected = false;
        }
      }
      if (cProps.width) {
        if (!isNaN(cProps.height) || (cProps.height.substr(cProps.height.length-2,2).toLowerCase() == "px"))
        {
          // pixels
          if (!isNaN(cProps.height))
            td_prop.cheight.value = cProps.height;
          else
            td_prop.cheight.value = cProps.height.substr(0,cProps.height.length-2);
          td_prop.chunits.options[0].selected = false;
          td_prop.chunits.options[1].selected = true;
        }
        else
        {
          // percents
          td_prop.cheight.value = cProps.height.substr(0,cProps.height.length-1);
          td_prop.chunits.options[0].selected = true;
          td_prop.chunits.options[1].selected = false;
        }
      }
      
      setHAlign(cProps.align);
      setVAlign(cProps.vAlign);
      
      if (cProps.noWrap)
        td_prop.cnowrap.checked = true;
      
      
	  /* spec styles for td will be used
      if (cProps.styleOptions) {
        for (i=1; i<cProps.styleOptions.length; i++)
        {
          var oOption = document.createElement("OPTION");
          td_prop.ccssclass.add(oOption);
          oOption.innerText = cProps.styleOptions[i].innerText;
          oOption.value = cProps.styleOptions[i].value;
  
          if (cProps.className) {
            td_prop.ccssclass.value = cProps.className;
          }
        }
      }
	  */

      if (cProps.className) {
        td_prop.ccssclass.value = cProps.className;
		css_class_changed();
      }
    }
    resizeDialogToContent();
  }
  
  function validateParams()
  {
    // check width and height
    if (isNaN(parseInt(td_prop.cwidth.value)) && td_prop.cwidth.value != '')
    {
      alert('<?php echo $l->m('error').': '.$l->m('error_width_nan')?>');
      td_prop.cwidth.focus();
      return false;
    }
    if (isNaN(parseInt(td_prop.cheight.value)) && td_prop.cheight.value != '')
    {
      alert('<?php echo $l->m('error').': '.$l->m('error_height_nan')?>');
      td_prop.cheight.focus();
      return false;
    }
    
    return true;
  }
  
  function okClick() {
    // validate paramters
    if (validateParams())    
    {
      var cprops = {};
      cprops.className = (td_prop.ccssclass.value != 'default')?td_prop.ccssclass.value:'';
	  if (!td_prop.cwidth.disabled)
	  {
	      cprops.align = (td_prop.chalign.value)?(td_prop.chalign.value):'';
	      cprops.vAlign = (td_prop.cvalign.value)?(td_prop.cvalign.value):'';
	      cprops.width = (td_prop.cwidth.value)?(td_prop.cwidth.value + td_prop.cwunits.value):'';
	      cprops.height = (td_prop.cheight.value)?(td_prop.cheight.value + td_prop.chunits.value):'';
	      cprops.bgColor = td_prop.cbgcolor.value;
	      cprops.noWrap = (td_prop.cnowrap.checked)?true:false;
		  cprops.background = td_prop.cbackground.value;
	  }
      window.returnValue = cprops;
      window.close();
    }
  }

  function cancelClick() {
    window.close();
  }
  
  function setSample()
  {
    try {
      td_prop.color_sample.style.backgroundColor = td_prop.cbgcolor.value;
    }
    catch (excp) {}
  }
  
  function setHAlign(alignment)
  {
    switch (alignment) {
      case "left":
        td_prop.ha_left.className = "align_on";
        td_prop.ha_center.className = "align_off";
        td_prop.ha_right.className = "align_off";
        break;
      case "center":
        td_prop.ha_left.className = "align_off";
        td_prop.ha_center.className = "align_on";
        td_prop.ha_right.className = "align_off";
        break;
      case "right":
        td_prop.ha_left.className = "align_off";
        td_prop.ha_center.className = "align_off";
        td_prop.ha_right.className = "align_on";
        break;
    }
    td_prop.chalign.value = alignment;
  }

  function setVAlign(alignment)
  {
    switch (alignment) {
      case "middle":
        td_prop.ha_middle.className = "align_on";
        td_prop.ha_baseline.className = "align_off";
        td_prop.ha_bottom.className = "align_off";
        td_prop.ha_top.className = "align_off";
        break;
      case "baseline":
        td_prop.ha_middle.className = "align_off";
        td_prop.ha_baseline.className = "align_on";
        td_prop.ha_bottom.className = "align_off";
        td_prop.ha_top.className = "align_off";
        break;
      case "bottom":
        td_prop.ha_middle.className = "align_off";
        td_prop.ha_baseline.className = "align_off";
        td_prop.ha_bottom.className = "align_on";
        td_prop.ha_top.className = "align_off";
        break;
      case "top":
        td_prop.ha_middle.className = "align_off";
        td_prop.ha_baseline.className = "align_off";
        td_prop.ha_bottom.className = "align_off";
        td_prop.ha_top.className = "align_on";
        break;
    }
    td_prop.cvalign.value = alignment;
  }
  
  function css_class_changed()
  {
  	if (<?php echo (isset($spaw_disable_style_controls) && $spaw_disable_style_controls)?'true':'false'?>)
	{
	  	// disable/enable non-css class controls
		if (td_prop.ccssclass.value && td_prop.ccssclass.value!='default')
		{
			// disable all controls
			td_prop.cwidth.disabled = true;
			td_prop.cwunits.disabled = true;
			td_prop.cheight.disabled = true;
			td_prop.chunits.disabled = true;
			td_prop.cnowrap.disabled = true;
			td_prop.cbgcolor.disabled = true;
			td_prop.ha_left.src = '<?php echo $theme_path.'img/'?>tb_left_off.gif';
			td_prop.ha_left.disabled = true;
			td_prop.ha_center.src = '<?php echo $theme_path.'img/'?>tb_center_off.gif';
			td_prop.ha_center.disabled = true;
			td_prop.ha_right.src = '<?php echo $theme_path.'img/'?>tb_right_off.gif';
			td_prop.ha_right.disabled = true;
			td_prop.ha_top.src = '<?php echo $theme_path.'img/'?>tb_top_off.gif';
			td_prop.ha_top.disabled = true;
			td_prop.ha_middle.src = '<?php echo $theme_path.'img/'?>tb_middle_off.gif';
			td_prop.ha_middle.disabled = true;
			td_prop.ha_bottom.src = '<?php echo $theme_path.'img/'?>tb_bottom_off.gif';
			td_prop.ha_bottom.disabled = true;
			td_prop.ha_baseline.src = '<?php echo $theme_path.'img/'?>tb_baseline_off.gif';
			td_prop.ha_baseline.disabled = true;
			td_prop.ccolorpicker.src = '<?php echo $theme_path.'img/'?>tb_colorpicker_off.gif';
			td_prop.ccolorpicker.disabled = true;
			td_prop.cbackground.disabled = true;
			td_prop.cimg_picker.src = '<?php echo $theme_path.'img/'?>tb_image_insert_off.gif';
			td_prop.cimg_picker.disabled = true;
		}
		else
		{
			// enable all controls
			td_prop.cwidth.disabled = false;
			td_prop.cwunits.disabled = false;
			td_prop.cheight.disabled = false;
			td_prop.chunits.disabled = false;
			td_prop.cnowrap.disabled = false;
			td_prop.cbgcolor.disabled = false;
			td_prop.ha_left.src = '<?php echo $theme_path.'img/'?>tb_left.gif';
			td_prop.ha_left.disabled = false;
			td_prop.ha_center.src = '<?php echo $theme_path.'img/'?>tb_center.gif';
			td_prop.ha_center.disabled = false;
			td_prop.ha_right.src = '<?php echo $theme_path.'img/'?>tb_right.gif';
			td_prop.ha_right.disabled = false;
			td_prop.ha_top.src = '<?php echo $theme_path.'img/'?>tb_top.gif';
			td_prop.ha_top.disabled = false;
			td_prop.ha_middle.src = '<?php echo $theme_path.'img/'?>tb_middle.gif';
			td_prop.ha_middle.disabled = false;
			td_prop.ha_bottom.src = '<?php echo $theme_path.'img/'?>tb_bottom.gif';
			td_prop.ha_bottom.disabled = false;
			td_prop.ha_baseline.src = '<?php echo $theme_path.'img/'?>tb_baseline.gif';
			td_prop.ha_baseline.disabled = false;
			td_prop.ccolorpicker.src = '<?php echo $theme_path.'img/'?>tb_colorpicker.gif';
			td_prop.ccolorpicker.disabled = false;
			td_prop.cbackground.disabled = false;
			td_prop.cimg_picker.src = '<?php echo $theme_path.'img/'?>tb_image_insert.gif';
			td_prop.cimg_picker.disabled = false;
		}
	}
  }
  //-->
  </script>
</head>

<body onLoad="Init()" dir="<?php echo $l->getDir();?>">
<table border="0" cellspacing="0" cellpadding="2" width="336">
<form name="td_prop">
<tr>
  <td nowrap><?php echo $l->m('css_class')?>:</td>
  <td nowrap colspan="3">
    <select id="ccssclass" name="ccssclass" size="1" class="input" onchange="css_class_changed();">
	<?php
	foreach($spaw_dropdown_data["td_style"] as $key => $text)
	{
		echo '<option value="'.$key.'">'.$text.'</option>'."\n";
	}
	?>
    </select>
  </td>
</tr>
<tr>
  <td colspan="2"><?php echo $l->m('horizontal_align')?>:</td>
  <td colspan="2" align="right"><input type="hidden" name="chalign">
  <img id="ha_left" src="<?php echo $theme_path.'img/'?>tb_left.gif" class="align_off" onClick="setHAlign('left');" alt="<?php echo $l->m('left')?>">
  <img id="ha_center" src="<?php echo $theme_path.'img/'?>tb_center.gif" class="align_off" onClick="setHAlign('center');" alt="<?php echo $l->m('center')?>">
  <img id="ha_right" src="<?php echo $theme_path.'img/'?>tb_right.gif" class="align_off" onClick="setHAlign('right');" alt="<?php echo $l->m('right')?>">
  </td>
</tr>
<tr>
  <td colspan="2"><?php echo $l->m('vertical_align')?>:</td>
  <td colspan="2" align="right"><input type="hidden" name="cvalign">
  <img id="ha_top" src="<?php echo $theme_path.'img/'?>tb_top.gif" class="align_off" onClick="setVAlign('top');" alt="<?php echo $l->m('top')?>">
  <img id="ha_middle" src="<?php echo $theme_path.'img/'?>tb_middle.gif" class="align_off" onClick="setVAlign('middle');" alt="<?php echo $l->m('middle')?>">
  <img id="ha_bottom" src="<?php echo $theme_path.'img/'?>tb_bottom.gif" class="align_off" onClick="setVAlign('bottom');" alt="<?php echo $l->m('bottom')?>">
  <img id="ha_baseline" src="<?php echo $theme_path.'img/'?>tb_baseline.gif" class="align_off" onClick="setVAlign('baseline');" alt="<?php echo $l->m('baseline')?>">
  </td>
</tr>
<tr>
  <td><?php echo $l->m('width')?>:</td>
  <td nowrap>
    <input type="text" name="cwidth" size="3" maxlength="3" class="input_small">
    <select size="1" name="cwunits" class="input">
      <option value="%">%</option>
      <option value="px">px</option>
    </select>
  </td>
  <td><?php echo $l->m('height')?>:</td>
  <td nowrap>
    <input type="text" name="cheight" size="3" maxlength="3" class="input_small">
    <select size="1" name="chunits" class="input">
      <option value="%">%</option>
      <option value="px">px</option>
    </select>
  </td>
</tr>
<tr>
  <td nowrap><?php echo $l->m('no_wrap')?>:</td>
  <td nowrap>
    <input type="checkbox" name="cnowrap">
  </td>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td colspan="4"><?php echo $l->m('bg_color')?>: <img src="spacer.gif" id="color_sample" border="1" width="30" height="18" align="absbottom">&nbsp;<input type="text" name="cbgcolor" size="7" maxlength="7" class="input_color" onKeyUp="setSample()">&nbsp;
  <img id="ccolorpicker" src="<?php echo $theme_path.'img/'?>tb_colorpicker.gif" border="0" onClick="showColorPicker(cbgcolor.value)" align="absbottom">
  </td>
</tr>
<tr>
  <td colspan="4">
	<?php echo $l->m('background')?>: <input type="text" name="cbackground" size="20" class="input" >&nbsp;<img id="cimg_picker" src="<?php echo $theme_path.'img/'?>tb_image_insert.gif" border="0" onClick="showImgPicker();" align="absbottom">	
  </td>
</tr>
<tr>
<td colspan="4" nowrap>
<hr width="100%">
</td>
</tr>
<tr>
<td colspan="4" align="right" valign="bottom" nowrap>
<input type="button" value="<?php echo $l->m('ok')?>" onClick="okClick()" class="bt">
<input type="button" value="<?php echo $l->m('cancel')?>" onClick="cancelClick()" class="bt">
</td>
</tr>
</form>
</table>

</body>
</html>
