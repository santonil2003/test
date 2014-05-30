<?php

/* require_once('_common/_constants.php');
define('FPDF_FONTPATH',SITE_DIR.'fonts/');
require('fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->GDImage(SITE_DIR.'images/Bracelet-website-graphic.gif');
$pdf->Output();
*/
//echo($pdf->buffer);
/*
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n"
   )
 );
 



$context = stream_context_create($opts);

$handle = fopen('giftvoucher_print.php?inv=1133&v_num=58978197973274','r',false,$context);
//$handle = fopen('http://www.google.com.au/search?hl=en&client=firefox-a&rls=com.ubuntu%3Aen-US%3Aunofficial&hs=MMN&q=php+fopen+with+get+variables&btnG=Search&meta=','r',false,$context);
$returnStr= '';
if($handle) {
  while(!feof($handle)){
    $returnStr.=fgets($handle,4096);
  }
 fclose($handle);
}

//header('Content-type: application/pdf');
echo($returnStr);
*/

$inv = '1133';
$v_num ='58978197973274';
include 'giftvoucher_print.php';
/*
$string = get_include_contents('http://www.identikid.com.au/temp/giftvoucher_print.php?inv=1133&v_num=58978197973274');

echo $string;

function get_include_contents($filename) {

    ob_start();
    include $filename;
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

}
*/
?>