<?

  if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){

    include_once('_common/_constants.php');

    include_once('useractions.php');

    //db setup - configure & set up db connection
    require_once(SITE_DIR.'_common/_connection.php');
    $cfg = new Config();
    $db = new DbConnect($cfg);
    $db->connectDb();
    //end db setup

    $result = product_details($_REQUEST['id'], $_COOKIE['currency'], $product);

    header('Content-type: text/xml');
    print('<?xml version="1.0" encoding="UTF-8"?>');
    print("<product>");
    print("<productId>".$product['productId']."</productId>");
    print("<currencyInt>".$product['currencyInt']."</currencyInt>");
    print("<price>".$product['price']."</price>");
    print("<currName>".$product['currName']."</currName>");
    print("<symbol>".$product['symbol']."</symbol>");
    print("<rate>".$product['rate']."</rate>");
    print("<postage>".$product['postage']."</postage>");
    print("<expresspost>".$product['expresspost']."</expresspost>");
    print("<freeGift>".$product['freeGift']."</freeGift>");
    print("<minimumOrder>".$product['minimumOrder']."</minimumOrder>");
    print("<fundraisers>".$product['fundraisers']."</fundraisers>");
    print("<productName>".$product['productName']."</productName>");
    print("<unitQuant>".$product['unitQuant']."</unitQuant>");
    print("</product>");



  } 
  
  exit;



?>