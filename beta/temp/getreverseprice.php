<?
header("Cache-control: private");
include("_common/_connection.php");
include("useractions.php");
linkme();

$query = "SELECT * FROM prices_reverse_text a, currencies b, product c WHERE a.prod_id='".$_GET["productId"]."' AND a.prod_id=c.id AND b.id='".$_COOKIE["currency"]."'";

//print $query;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
		
while($qdata = mysql_fetch_array($result)){

  if($_COOKIE["currency"]=='1') {
    $price = $qdata["reverse_text_price"];  
  } else {
    $price = number_format(round(toDollarsAndCents($qdata["reverse_text_price"]*$qdata['rate']),1), 2, '.', '');
  }
  
  echo "&reverseid=".$qdata["id"]."&reverseprice=".$price."&reversedescription=".$qdata["productName"]."&reversesymbol=".str_replace("","EURO", $qdata["symbol"])."&reverseunitQuant=".$qdata["unitQuant"];
  //echo "&id=".$qdata["id"]."&price=".$qdata["reverse_text_price"]*$qdata["rate"]."&description=".$qdata["productName"]."&symbol=".str_replace("","EURO", $qdata["symbol"])."&unitQuant=".$qdata["unitQuant"];
}
