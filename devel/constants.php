<?PHP

// CONSTANTS FILE.



// timeout for admin logins.
ini_set('session.gc_maxlifetime', 43200);

// constants
define("GST", 0.1);

if(strcmp($_SERVER['HTTP_HOST'], 'identikid') == 0)
{
	$_CONSTANTS['weblocation'] = "/var/www/html/";
	
	//$_CONSTANTS['weburl'] = 'http://identikid/';
	//$_CONSTANTS['weburl'] = 'http://echidnaweb.net.au/~identiki/';
	$_CONSTANTS['weburl'] = 'http://www.identikid.com.au/';
	
	$_CONSTANTS['emailAdmin'] = "peter@echidnaweb.com.au";
	define('COMMON', $_CONSTANTS['weblocation'] . 'common/');
	define('DEV_SERVER', true);
	define('DEVEL', true);
}
elseif(preg_match('/devel/', $_SERVER['SCRIPT_FILENAME']))
{
	$_CONSTANTS['weblocation'] = "/var/www/html/devel/";
	$_CONSTANTS['weburl'] = 'http://www.identikid.com.au/devel/';	
	$_CONSTANTS['emailAdmin'] = "peter@echidnaweb.com.au";
	define('COMMON', $_CONSTANTS['weblocation'] . 'common/');
	define('DEV_SERVER', true);
	define('DEVEL', true);
}
else {
	
	$_CONSTANTS['weblocation'] = "/var/www/html/devel/";	
	//$_CONSTANTS['weburl'] = 'http://www.identikid.com.au/';
	//$_CONSTANTS['weburl'] = 'http://echidnaweb.net.au/~identiki/';
	$_CONSTANTS['weburl'] = 'http://www.identikid.com.au/';	
	$_CONSTANTS['emailAdmin']  = "info@identikid.com.au";
	define('COMMON', $_CONSTANTS['weblocation'] . 'common/');
	define('DEV_SERVER', false);
	define('DEVEL', false);

}

define('SINGLE_COLOURS', 8);
define('ADMIN_EMAIL', 'peter@echidnaweb.com.au');
define('ORDER_CONFIRMATION_EMAIL', 'confirmations@identikid.com.au');

define('VINYL_OLD_DEFAULT_BACKGROUND_COLOUR', 3);
define('VINYL_OLD_DEFAULT_FONT_COLOUR', 1);

define('MINI_OLD_DEFAULT_BACKGROUND_COLOUR', 8);
define('MINI_OLD_DEFAULT_FONT_COLOUR', 1);

define('PENCIL_OLD_DEFAULT_BACKGROUND_COLOUR', 3);
define('PENCIL_OLD_DEFAULT_FONT_COLOUR', 1);




// secure constants
/*$_CONSTANTS['referer_urls'] = array("http://www.identikid.com.au/submit_order_ps.php",
	"https://echidnaweb.com.au/~identiki/secure/index.php",
);*/
//$_CONSTANTS['referer_urls'] = array("http://echidnaweb.net.au/~identiki/submit_order_ps.php","https://echidnaweb.com.au/~identiki/secure/index.php",);
$_CONSTANTS['referer_urls'] = array("http://www.identikid.com.au/submit_order_ps.php","https://www.echidnaweb.net/~identiki/secure/index.php",);

$_CONSTANTS['cards'] = array("Visa", "Mastercard", "BankCard", "Amex", "JCB");


$_CONSTANTS['colours'] = array();

//$_CONSTANTS['newAbsImageUrl'] = "https://sitepond.com/~identiki";
$_CONSTANTS['newAbsImageUrl'] = "http://www.identikid.com.au";


//$_LINKS['secure'] = "https://echidnaweb.com.au/~identiki/secure/index.php";
//$_LINKS['secure'] = "https://sitepond.com/~identiki/secure/index.php";

//$_LINKS['secure'] = "https://echidnaweb.com.au/~identiki/secure/index.php";
//$_LINKS['secure'] = "https://jupiter.caserver1.com/~identiki/secure/index.php";
$_LINKS['secure'] = "https://www.identikid.com.au/devel/secure/index.php";

//$referer_url2= "http://www.labsearch.com.au/new/confirmation.php";
//$secure_form = "echidnaweb.com.au/~labsearc/new/secure.php";

// ePAY constants.
$_EPAY['url'] = "https://earth.australis.net.au/epay/servlet/CardClearingServlet";

// design
//$_EPAY['SC_Merch'] = "identikid-test";

// live merchant ID
$_EPAY['SC_Merch'] = "identikid";

$_EPAY['SC_Order'] = "ls".time();
$_EPAY['ACTION']   = "S";
$_EPAY['W']        = "true";

$_EPAY['ERROR_CODES'] = $_CONSTANTS['weblocation'].'/secure/CAMTECH_ERROR_CODES.csv';

$_EPAY['LIVE_TIMESTAMP'] = 1108997738;

// currency

$_CURRENCIES = array("1" => array("desc" => "Australian Dollars", "currency" => "AU\$", "code" => "AUD"),
											"2" => array("desc" => "United States Dollars", "currency" => "US\$", "code" => "USD"),
											"3" => array("desc" => "Euros", "currency" => "EU\$", "code" => "EUR"),
											"5" => array("desc" => "Australian Dollars (New Zealand Residents)", "currency" => "AU\$", "code" => "AUD"),
	);

$_PAYMENT_METHOD = array("1"=>"Credit Card","2" => "Money Order","3" => "Phone Order",
							    "4"=>"Direct debit Online", "5"=>"Phone with CC",
							    "6"=>"Gift Voucher","7"=>"Paypal", "8"=>"Direct debit other");
							    
require_once($_CONSTANTS['weblocation']  . "common_db.php");
require_once($_CONSTANTS['weblocation']  . "common/global.php");
						    
?>