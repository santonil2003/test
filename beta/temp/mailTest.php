<?

require_once('_common/_constants.php');
require_once(SITE_DIR.'useractions.php');

//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');$cfg = new Config();$db = new DbConnect($cfg);$db->connectDb();//end db setup

$_SESSION["currency"] = '1';

sendNewOrder('130', 'peter', "peter@echidnaweb.com.au", 0);

exit;