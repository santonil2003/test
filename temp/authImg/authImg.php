<?php
session_start();

function imagelinethick($image, $x1, $y1, $x2, $y2, $color, $thick = 1)
{
    /* this way it works well only for orthogonal lines
    imagesetthickness($image, $thick);
    return imageline($image, $x1, $y1, $x2, $y2, $color);
    */
    if ($thick == 1) {
        return imageline($image, $x1, $y1, $x2, $y2, $color);
    }
    $t = $thick / 2 - 0.5;
    if ($x1 == $x2 || $y1 == $y2) {
        return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
    }
    $k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
    $a = $t / sqrt(1 + pow($k, 2));
    $points = array(
        round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
        round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
        round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
        round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
    );
    imagefilledpolygon($image, $points, 4, $color);
    return imagepolygon($image, $points, 4, $color);
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


$lines = rand(3,4);
$lineWidthMax = 2;
$dots = rand(15,25);
$dotWidthMax = 2;
$letters = 5;

$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

// generate the verication code
$rand = substr(str_shuffle($alphanum), 0, $letters);

$fonts = '';

if ($handle = opendir('fonts/')) {

    while (false !== ($file = readdir($handle))) {
        $fonts[] = $file;
    }
    closedir($handle);
}


$bgs = '';

if ($handle = opendir('bg/')) {

    while (false !== ($file = readdir($handle))) {
        $bgs[] = $file;
    }
    closedir($handle);
}


//Choose a random font
$fontNum = rand(2, sizeof($fonts)-1);
$size = "20";
$font = "fonts/$fonts[$fontNum]";

$fontVars = calculateTextBox($rand,$font,$size,0);
$im = imagecreatetruecolor($fontVars['width'], $fontVars['height']);
imagealphablending($im, true);

//$textColor = imagecolorallocate ($im, rand(0,rand(0,254)), rand(0,rand(0,254)), rand(0,rand(0,254)));
$textColor = imagecolorallocate ($im, 0, 0, 0);
$backgroundColour = imagecolorallocate ($im, 255, 255, 255);
imagecolortransparent($im, $backgroundColour);

imagefilledrectangle($im, 0, 0, ($fontVars['width']-1), ($fontVars['height']-1), $backgroundColour);

imagettftext($im, $size, 0, $fontVars['left'], $fontVars['top'], $textColor, $font, $rand);

/*
$bg = "bg/$bgs[$bgNum]";
$bg2 = "bg/$bgs[$bg2Num]";
$image = imagecreatefromgif($bg);
$bgwidth = imagesx($image);
$bgheight = imagesy($image);

$image2 = imagecreatefromgif($bg2);

imagecopy($image, $im,  floor(($bgwidth-$fontVars['width'])/2), floor(($bgheight-$fontVars['height'])/2), 0, 0, $fontVars['width'], $fontVars['height']);
imagecopy($image, $image2,  0, 0, 0, 0, $bgwidth, $bgheight);
*/

for($i=1;$i<$lines;$i++){
  imagelinethick($im , rand(0,$fontVars['width']), rand(0,$fontVars['height']),rand(0,$fontVars['width']),rand(0,$fontVars['height']),$textColor,rand(1,$lineWidthMax)); 
}

for($i=1;$i<$dots;$i++){
  $dotX = rand(0,$fontVars['width']);
  $dotY = rand(0,$fontVars['height']);
  imagelinethick($im , $dotX, $dotY, $dotX+rand(0,1),$dotY+rand(0,1),$textColor,rand(1,$dotWidthMax)); 
}

// send several headers to make sure the image is not cached
// taken directly from the PHP Manual

// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// always modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP/1.0
header("Pragma: no-cache");

// send the content type header so the image is displayed properly
header('Content-type: image/jpeg');

// send the image to the browser
imagegif($im);

// destroy the image to free up the memory
imagedestroy($im);
?>