<?

/* 
//European Central Bank Ex Feed
//Read eurofxref-daily.xml file in memory 
$XMLContent= file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
//the file is updated daily between 14:15 and 15:00 CET

foreach ($XMLContent as $line) {
        if (ereg("currency='([[:alpha:]]+)'",$line,$currencyCode)) {
            if (ereg("rate='([[:graph:]]+)'",$line,$rate)) {
              echo '1 &euro; = '.$rate[1].' '.$currencyCode[1].'<br />';
                   
            }
 
      }
}
*/

require_once("currencymanager_functions.php");

get_ex_rate();

?>