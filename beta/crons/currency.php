<?PHP

require_once("../common_db.php");

linkme();

/*
s converts Dollars and Euros into British Pounds Sterling.
The array type stores the currency symbol for output
the variable money contains an url from which the currency amount will be extracted.
You can change the value to be converted and the currencys to convert from and to in here
We then parse the results and output the values at the bottom.

To convert from euro to dollars all you have to do is change one of the urls, for example:
$money[0]=file('http://quote.yahoo.com/m5?a=1.99&t=USD&s=EUR');


*/

$type = array( "EUD", "USD"); 

$AUDtoEUR = $AUDtoUSD = $EURtoUSD = $EURtoAUD = $USDtoAUD = $USDtoEUR = 0;

// 1 AUD = ? EUR
$money[0]=file('http://quote.yahoo.com/m5?a=1&t=EUR&s=AUD'); // set the value in the url (a=1)

// 1 AUD = ? USD
$money[1]=file('http://quote.yahoo.com/m5?a=1&t=USD&s=AUD'); // set the value in the url (a=1)

// 1 USD = ? EUR
$money[2]=file('http://quote.yahoo.com/m5?a=1&t=EUR&s=USD'); // set the value in the url (a=1)

for($i=0; $i<sizeof($money); $i++)
{ 
   $money[$i] = join("",$money[$i]); 
   $money[$i] = ereg_replace(".*<table border=1 cellpadding=2 cellspacing=0>",'',$money[$i]); 
   $money[$i] = ereg_replace("</table>.*",'',$money[$i]); 
   $money[$i] = ereg_replace("</b>.*",'',$money[$i]); 
   $money[$i] = ereg_replace(".*<b>",'',$money[$i]); 

  if(empty($money[$i])){
    // email error
    mail_error("Money came up blank for number {$i}");

  }
  else {
    // insert into database.
		if($i==0){
			$AUDtoEUR = $money[$i];
			$EURtoAUD = 1/$money[$i];
		}
		elseif($i==1){
			$AUDtoUSD = $money[$i];
      $USDtoAUD = 1/$money[$i];
		}
		elseif($i==2){
			$USDtoEUR = $money[$i];
			$EURtoUSD = 1/$money[$i];
		}

  }
}

$string = "update currency_table set 
	AUDtoEUR='{$AUDtoEUR}', EURtoAUD='{$EURtoAUD}',
	AUDtoUSD='{$AUDtoUSD}', USDtoAUD='{$USDtoAUD}',
	USDtoEUR='{$USDtoEUR}', EURtoUSD='{$EURtoUSD}'";


if(empty($AUDtoEUR) || empty($EURtoAUD) || empty($AUDtoUSD) || empty($USDtoAUD) || empty($USDtoEUR) || empty($EURtoUSD)){
	mail_error("One of the currencies is empty\n\n$string\n\n");
}
else {
	$result = mysql_query($string) or mail_error(mysql_error());
}


function mail_error($error_msg){
  $message = "The following error occured on the IdentiKid currency converter script\n\n$error_msg";

  mail("shaun@echidnaweb.com.au", "Identikid Currency Error", $message);

} 
?> 
