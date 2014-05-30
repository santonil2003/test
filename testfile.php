<?
date_default_timezone_set('US/Central');
echo date_default_timezone_get();

echo date("Y-m-d H:i:s");
echo "<br />";
echo date("Y-m-d H:i:s",time() + 7200);
echo "<br />";
echo date("Y-m-d H:i:s",time() + 36000);

echo "<br />";
echo date("Y-m-d H:i:s",time() + 36000 + 21600);
?>
