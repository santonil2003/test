<?php


  //system("ping -c 2 earth.australis.net.au");
  
  system('curl -k "https://earth.australis.net.au/epay/servlet/CardClearingServlet?Cust_Card=4242424242424242&Cust_Card_MM=10&Cust_Card_YY=10&SC_Merch=identikid-test&SC_Order=`date +%d%m%y%H%M%S%N`&SC_Amount=100&SC_Action=capture&W=true&ACTION=S" ');

 //echo $_SERVER['PATH_TRANSLATED'];
 
 
 ?><br />
