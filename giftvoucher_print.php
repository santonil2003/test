<?php

function rotate_right90($im)
{
 $wid = imagesx($im);
 $hei = imagesy($im);
 $im2 = imagecreatetruecolor($hei,$wid);

 for($i = 0;$i < $wid; $i++)
 {
  for($j = 0;$j < $hei; $j++)
  {
   $ref = imagecolorat($im,$i,$j);
   imagesetpixel($im2,$hei - $j,$i,$ref);
  }
 }
 return $im2;
}

function rotate_left90($im)
{
 $wid = imagesx($im);
 $hei = imagesy($im);
 $im2 = imagecreatetruecolor($hei,$wid);

 for($i = 0;$i < $wid; $i++)
 {
  for($j = 0;$j < $hei; $j++)
  {
   $ref = imagecolorat($im,$i,$j);
   imagesetpixel($im2,$j, ($wid - $i) - 1,$ref);
  }
 }
 return $im2;
}

function mirror($im)
{
 $wid = imagesx($im);
 $hei = imagesy($im);
 $im2 = imagecreatetruecolor($wid,$hei);

 for($i = 0;$i < $wid; $i++)
 {
  for($j = 0;$j < $hei; $j++)
  {
   $ref = imagecolorat($im,$i,$j);
   imagesetpixel($im2,$wid - $i,$j,$ref);
  }
 }
 return $im2;
}

function flip($im)
{
 $wid = imagesx($im);
 $hei = imagesy($im);
 $im2 = imagecreatetruecolor($wid,$hei);

 for($i = 0;$i < $wid; $i++)
 {
  for($j = 0;$j < $hei; $j++)
  {
   $ref = imagecolorat($im,$i,$j);
   imagesetpixel($im2,$i,$hei - $j,$ref);
  }
 }
 return $im2;
}

function createTextImage($text,$size,$font,$txtColour,$bgColour) {

  $fontVars = calculateTextBox($text,$font,$size,0);

  // Create the image
  $im = imagecreatetruecolor($fontVars['width'], $fontVars['height']);

  // Background Colour
  $backgroundColour = imagecolorallocate($im, $bgColour[0], $bgColour[1], $bgColour[2]);

  if($txtColour=="trans"){
    imagealphablending($im, true);
   $trans = imagecolorallocatealpha($im, ($bgColour[0]-1), ($bgColour[1]-1), ($bgColour[2]-1), 50);
    imagecolortransparent($im, $trans);
    $textColour = imagecolorallocate($im, ($bgColour[0]-1), ($bgColour[1]-1), ($bgColour[2]-1));
  } else {
    $textColour = imagecolorallocate($im, $txtColour[0], $txtColour[1], $txtColour[2]);
  }

  imagefilledrectangle($im, 0, 0, ($fontVars['width']-1), ($fontVars['height']-1), $backgroundColour);

  // Add the text
  imagettftext($im, $size, 0, $fontVars['left'], $fontVars['top'], $textColour, $font, $text);
  
  return($im);

}

function Hex2RGB($color){
  $color = str_replace('#', '', $color);
  if (strlen($color) != 6){ return array(0,0,0); }
  $rgb = array();
  for ($x=0;$x<3;$x++){
    $rgb[$x] = hexdec(substr($color,(2*$x),2));
  }
  return $rgb;
}

function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) {
  $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text);
 
  $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6]));
  $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6]));
  $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7]));
  $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7]));

  return array(
    "left"   => abs($minX),
    "top"    => abs($minY),
    "width"  => $maxX - $minX,
    "height" => $maxY - $minY,
    "box"    => $rect
  );
}



//Testing method
/*
//voucher=gv_bee_good.png&amountSize=16&amountX=265&amountY=153&amount=$265&amountTextColour=f68712&codeSize=10&codeX=130&codeY=250&code=CODE: 123-456-789-012&codeTextColour=000000

if(isset($_GET['amount']) && $_GET['amount'] != '') {
  $amount = $_GET['amount'];
} else {
  $amount = "$0";
}

if(isset($_GET['amountX']) && $_GET['amountX'] != '') {
  $amountX = $_GET['amountX'];
} else {
  $amountX = "10";
}

if(isset($_GET['amountY']) && $_GET['amountY'] != '') {
  $amountY = $_GET['amountY'];
} else {
  $amountY = "10";
}

if(isset($_GET['amountSize']) && $_GET['amountSize'] != '') {
  $amountSize = $_GET['amountSize'];
} else {
  $amountSize = 20;
}

//text colour
if(isset($_GET['amountTextColour']) && $_GET['amountTextColour'] != '') {
  if($_GET['amountTextColour']!="trans") {
     $amountTextColour = Hex2RGB($_GET['amountTextColour']);
   } else {
     $amountTextColour = "trans";
   }
} else {
  $amountTextColour[0] = 0;
  $amountTextColour[1] = 0;
  $amountTextColour[2] = 0; 
}


if(isset($_GET['code']) && $_GET['code'] != '') {
  $code = $_GET['code'];
} else {
  $code = "XXX-XXX-XXX-XXX";
}

if(isset($_GET['codeX']) && $_GET['codeX'] != '') {
  $codeX = $_GET['codeX'];
} else {
  $codeX = "10";
}

if(isset($_GET['codeY']) && $_GET['codeY'] != '') {
  $codeY = $_GET['codeY'];
} else {
  $codeY = "10";
}

if(isset($_GET['codeSize']) && $_GET['codeSize'] != '') {
  $codeSize = $_GET['codeSize'];
} else {
  $codeSize = 20;
}

//text colour
if(isset($_GET['codeTextColour']) && $_GET['codeTextColour'] != '') {
  if($_GET['codeTextColour']!="trans") {
     $codeTextColour = Hex2RGB($_GET['codeTextColour']);
   } else {
     $codeTextColour = "trans";
   }
} else {
  $codeTextColour[0] = 0;
  $codeTextColour[1] = 0;
  $codeTextColour[2] = 0; 
}

*/
require_once('_common/_constants.php');
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();

// background colour
$defaultBgColour[0] = 255;
$defaultBgColour[1] = 255;
$defaultBgColour[2] = 255;

if(isset($_REQUEST['inv']) && $_REQUEST['inv'] != '') {
  $custID = $_REQUEST['inv']; 
  $custID-=1000;
} else {
  if($inv!=''){
    $custID=$inv-1000; 
  } else {
    print("Invaild Invoice Number");
    exit;
  }
}


if(isset($_REQUEST['v_num']) && $_REQUEST['v_num'] != '') {
  $voucher_id = $_REQUEST['v_num'];
} else {
  if($v_num!=''){
    $voucher_id  = $v_num;
  } else {
    print("Invaild Voucher Number");
    exit;
  }
 
}


$sql = "SELECT giftvoucher.*, voucher.number, voucher.value, currencies.symbol
 FROM voucher , giftvoucher, currencies
 WHERE voucher.number = '$voucher_id' AND voucher.customer_id = '$custID' 
   AND voucher.online_id = giftvoucher.id AND voucher.currency = currencies.id ";
$result = mysql_query($sql);
if(mysql_num_rows($result)>0){
  $row = mysql_fetch_array($result);
}  else {
  print("Unable to locate voucher");
  exit;  
}
//Live method

$voucher = $row['img'];
$amountSize = 16;
$amountX=$row['text_x'];
$amountY=$row['text_y'];
$amount=$row['value'];
$amountTextColour= Hex2RGB($row['text_colour']);

$codeSize=12; 
$codeX=115;
$codeY=975;
$full_code = $row['number'];
$code="CODE: ".substr($full_code,0,3)."-".substr($full_code,3,3)."-".substr($full_code,6,3)."-".substr($full_code,9,3);
$codeTextColour= Hex2RGB("000000");

$curr_symbol = $row['symbol'];

$amount = $curr_symbol.$amount;

//Testing 
if(isset($_REQUEST['voucher']) && $_REQUEST['voucher'] != '') {
  $test_voucher_id = $_REQUEST['voucher'];
  $sql2 = "SELECT * FROM giftvoucher WHERE id = '$test_voucher_id' LIMIT 1";
  $result2 = mysql_query($sql2);
  if(mysql_num_rows($result2) == 1) {
    $row2 = mysql_fetch_array($result2);
    $voucher = $row2['img'];
    $amountX=$row2['text_x'];
    $amountY=$row2['text_y'];
    $amountTextColour= Hex2RGB($row2['text_colour']);
  } 
}

// Font path
$fontPath = '/var/www/html/fonts/SoupBone-Bold.ttf';

//Base Giftvoucher Image
$imagesource =  '/var/www/html/images/giftvouchers/'.$voucher;
$filetype = substr($imagesource,strlen($imagesource)-4,4);
$filetype = strtolower($filetype);
if($filetype == ".gif")  $image = @imagecreatefromgif($imagesource);  
if($filetype == ".jpg")  $image = @imagecreatefromjpeg($imagesource);  
if($filetype == ".png")  $image = @imagecreatefrompng($imagesource);  
if (!$image) { print("Voucher Error"); die(); }
$imagewidth = imagesx($image);
$imageheight = imagesy($image);  

//Amount Text
$amountImage = createTextImage($amount,$amountSize,$fontPath,$amountTextColour,$defaultBgColour);
$amountImagewidth =  imagesx($amountImage);
$amountImageheight =  imagesy($amountImage);

imagecopy($image, rotate_left90(rotate_left90($amountImage)),  $amountX-$amountImagewidth, $amountY, 0, 0, $amountImagewidth, $amountImageheight);

//Code Text
$codeImage = createTextImage($code,$codeSize,$fontPath,$codeTextColour,$defaultBgColour);
$codeImagewidth =  imagesx($codeImage);
$codeImageheight =  imagesy($codeImage);

imagecopy($image, $codeImage,  $codeX, $codeY, 0, 0, $codeImagewidth, $codeImageheight);

 
// Set the content-type
//header('Content-type: image/gif');
//header('Content-type: application/pdf');

// Using imagepng() results in clearer text compared with imagejpeg()
//imagepng(rotate_left90($image));

require_once('_common/_constants.php');

imagepng($image, SITE_DIR.'images/tmp/'.$full_code.'.png');

define('FPDF_FONTPATH',SITE_DIR.'fonts/');
require_once('fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image(SITE_DIR.'images/tmp/'.$full_code.'.png',0,0,'205','293');
if((isset($_REQUEST['inv']) && $_REQUEST['inv']!='')&&(isset($_REQUEST['v_num']) && $_REQUEST['v_num']!='')){
  $pdf->Output($full_code.'.pdf','D');
} else {
  $pdf->Output(SITE_DIR.'images/tmp/'.$full_code.'.pdf','F');
}

imagedestroy($image);
imagedestroy($amountImage); 
imagedestroy($codeImage);
unlink(SITE_DIR.'images/tmp/'.$full_code.'.png');
 
//imagedestroy($im);


?>
