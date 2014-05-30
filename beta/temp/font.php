<?php

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

if(isset($_GET['text']) && $_GET['text'] != '') {
  $text = urldecode(stripslashes($_GET['text']));
  $queryString = urldecode(stripslashes($_SERVER['QUERY_STRING']));
  $strCutStart=strpos($queryString, '{' );
  $strCutEnd=strrpos($queryString, '}' );
  if($strCutStart!==false && $strCutEnd!==false) {
    $text = substr( $queryString , ($strCutStart+1), ($strCutEnd-$strCutStart-1) );
  }
} else {
  $text = "Testing...";
}

if(isset($_GET['size']) && $_GET['size'] != '') {
  $size = $_GET['size'];
} else {
  $size = 20;
}

//text colour
if(isset($_GET['textColour']) && $_GET['textColour'] != '') {
  if($_GET['textColour']!="trans") {
     $txtColour = Hex2RGB($_GET['textColour']);
   } else {
     $txtColour = "trans";
   }
} else {
  $txtColour[0] = 0;
  $txtColour[1] = 0;
  $txtColour[2] = 0; 
}

// background colour
if(isset($_GET['bgColour']) && $_GET['bgColour'] != '') {
  $bgColour = Hex2RGB($_GET['bgColour']);
} else {
  $bgColour[0] = 255;
  $bgColour[1] = 255;
  $bgColour[2] = 255; 
}

// Font path
$font = '/var/www/html/temp/fonts/SoupBone-Bold.ttf';

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

// Set the content-type
header('Content-type: image/png');

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>
