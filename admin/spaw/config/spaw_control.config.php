<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Configuration file
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.1.0, 2003-03-27
// ================================================
 
// directory where spaw files are located
//$spaw_dir = '/temp/admin/spaw/';
$spaw_dir = '/'.TEMP_DIR.SPAW_DIR;

// base url for images
//$spaw_base_url = 'http://www.tectonic.com.au/temp/';
$spaw_base_url = SITE_URL;


//$spaw_root = '/home/tectonicftp/www/temp/admin/spaw/';
$spaw_root = SITE_DIR.SPAW_DIR;

$spaw_default_toolbars = 'default';
$spaw_default_theme = 'default';
$spaw_default_lang = 'en';
$spaw_default_css_stylesheet = $spaw_dir.'wysiwyg.css';

// add javascript inline or via separate file
$spaw_inline_js = false;

// use active toolbar (reflecting current style) or static
$spaw_active_toolbar = true;

// default dropdown content
$spaw_dropdown_data['style']['default'] = 'Normal';

$spaw_dropdown_data['table_style']['default'] = 'Normal';

$spaw_dropdown_data['td_style']['default'] = 'Normal';

$spaw_dropdown_data['font']['Arial'] = 'Arial';
$spaw_dropdown_data['font']['Courier'] = 'Courier';
$spaw_dropdown_data['font']['Tahoma'] = 'Tahoma';
$spaw_dropdown_data['font']['Times New Roman'] = 'Times';
$spaw_dropdown_data['font']['Verdana'] = 'Verdana';

$spaw_dropdown_data['fontsize']['1'] = '1';
$spaw_dropdown_data['fontsize']['2'] = '2';
$spaw_dropdown_data['fontsize']['3'] = '3';
$spaw_dropdown_data['fontsize']['4'] = '4';
$spaw_dropdown_data['fontsize']['5'] = '5';
$spaw_dropdown_data['fontsize']['6'] = '6';

$spaw_dropdown_data['paragraph']['Normal'] = 'Normal';
$spaw_dropdown_data['paragraph']['Heading 1'] = 'Heading 1';
$spaw_dropdown_data['paragraph']['Heading 2'] = 'Heading 2';
$spaw_dropdown_data['paragraph']['Heading 3'] = 'Heading 3';
$spaw_dropdown_data['paragraph']['Heading 4'] = 'Heading 4';
$spaw_dropdown_data['paragraph']['Heading 5'] = 'Heading 5';
$spaw_dropdown_data['paragraph']['Heading 6'] = 'Heading 6';

// image library related config

// allowed extentions for uploaded image files
$spaw_valid_imgs = array('gif', 'jpg', 'jpeg', 'png');

// allow upload in image library
$spaw_upload_allowed = true;

// allow delete in image library
$spaw_img_delete_allowed = true;

// image libraries
$spaw_imglibs = array(
  array(
    'value'   => 'images/bg/',
    'text'    => 'Backgrounds',
  ),
   array(
    'value'   => 'images/gen/',
    'text'    => 'Images',
  ),
   array(
    'value'   => 'images/heads/',
    'text'    => 'Headers',
  ),array(
    'value'   => 'images/products/',
    'text'    => 'Products',
  ),
  
);
// file to include in img_library.php (useful for setting $spaw_imglibs dynamically
$spaw_imglib_include = '';//$spaw_base_url.'cpawa_images';

// allowed hyperlink targets
$spaw_a_targets['_self'] = 'Self';
$spaw_a_targets['_blank'] = 'Blank';
$spaw_a_targets['_top'] = 'Top';
$spaw_a_targets['_parent'] = 'Parent';

// image popup script url
$spaw_img_popup_url = $spaw_dir.'img_popup.php';

// internal link script url
$spaw_internal_link_script = 'url to your internal link selection script';

$internal_link_file = "{$spaw_root}/../../_pages/_internal_links.php";

// disables style related controls in dialogs when css class is selected
$spaw_disable_style_controls = true;

// allowed extentions for uploaded files
$spaw_valid_docs = array('zip', 'doc', 'xls', 'rar', 'pdf', 'xls', 'rar', 'pdf', 'wmv', 'mp4', 'mpg', 'mpeg', 'avi', 'mov', 'ppt', 'm4v');

// allow upload in files library
$spaw_doc_upload_allowed = true;
$spaw_doc_delete_allowed = true;

// docs libraries
$spaw_doclibs = array(
  array(
    'value'   => 'pdf/',
    'text'    => 'Documents',
  ),
);

?>