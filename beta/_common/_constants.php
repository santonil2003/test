<?php
require_once('_database.php');
require_once('_functions.php');

//document types - these relate to PDFs
define('DOC_TYPE_CONTRACTS', 0);
define('DOC_TYPE_FORMS', 1);
define('DOC_TYPE_BOOKLETS', 2);
define('DOC_TYPE_INFO_SHEETS', 3);

//for form upload of pdfs
define('PDF', 'application/pdf');	

//number of records to be shown by paging system
define('DOC_NUM_PER_PAGE', 10);

//file path constants
define('TEMP_DIR','beta/');
define('SITE_DIR','/var/www/html/'.TEMP_DIR);

define('SITE_URL', 'http://identikid.com.au/'.TEMP_DIR);
//define('SITE_URL', 'http://119.252.88.32/'.TEMP_DIR);

define('SPAW_DIR','admin/spaw/');

define('PDFPATH',SITE_DIR.'pdfdocs/');
define('IMAGES_LOCATION', SITE_DIR.'images/');
define('SPAW_STYLESHEET', SITE_URL.'css/style_spaw.css');

//page types, these are used by the CMS in page creation, particularly in the creation of section default pages 

define('PAGE_TYPE_PAGE',0); //Html Page
define('PAGE_TYPE_HYPERLINK',1); //Hyperlink
define('PAGE_TYPE_DOWNLOAD',2); //Download
define('PAGE_TYPE_IMAGE',3); //Image
define('PAGE_TYPE_UNLINKED',4); //Stand Alone page
define('PAGE_TYPE_SECTION',5); //Section header Only

/* 
//page types, these are used by the CMS in page creation, particularly in the creation of section default pages 
define('PAGE_TYPE_USER_CONTENT',0);
define('PAGE_TYPE_SYSTEM_GENERATED',1);
define('PAGE_TYPE_ASSIGNED',2);
define('PAGE_TYPE_SECTION_HEADER',3);
define('PAGE_TYPE_PAGES', 4); //noneditablepages
define('PAGE_TYPE_PAGES_NOT_DELETEABLE', 5); //PAGES_NOT_DELETEABLE
define('PAGE_TYPE_SECTION_HEADER_VOID', 6); //Section Header no link
*/

//types for Update (ie newsletter) Items
define('EMPLOYEE', 0);
define('ADMINISTRATOR', 1);

//Update Items status
define('INACTIVE', 0);
define('ACTIVE', 1);

//user types for permissions system
define('ANONYMOUS_USER', 0);
define('MEMBER_USER', 1);
define('ADMINISTRATOR_USER', 2);
define('MEMBER_ADMINISTRATOR_USER', 3);

define('SECTION_HOME', 1);
define('SECTION_COMPANY', 2);
define('SECTION_ELIGIBLE', 3);
define('SECTION_FB', 4);
define('SECTION_ADVISORS', 5);
define('SECTION_FEEDBACK', 6);
define('SECTION_CONTACT', 7);

//Bulk Email Settings
define('BULK_EMAIL_SEND_SIZE', 5);
define('BULK_EMAIL_TABLE', 'email_list');

// timeout for admin logins.
ini_set('session.gc_maxlifetime', 43200);

// constants
define("GST", 0.1);


	$_CONSTANTS['weblocation'] = SITE_DIR;
	$_CONSTANTS['weburl'] = SITE_URL;	
	$_CONSTANTS['emailAdmin']  = "anne@identikid.com.au";
	define('COMMON', $_CONSTANTS['weblocation'] . '_common/');
	define('DEV_SERVER', false);
	define('DEVEL', false);



define('SINGLE_COLOURS', 8);
define('ADMIN_EMAIL', 'anne@identikid.com.au');
define('ORDER_CONFIRMATION_EMAIL', 'confirmations@identikid.com.au');
define('INFO_EMAIL', 'info@identikid.com.au');

define('VINYL_OLD_DEFAULT_BACKGROUND_COLOUR', 3);
define('VINYL_OLD_DEFAULT_FONT_COLOUR', 1);

define('MINI_OLD_DEFAULT_BACKGROUND_COLOUR', 8);
define('MINI_OLD_DEFAULT_FONT_COLOUR', 1);

define('PENCIL_OLD_DEFAULT_BACKGROUND_COLOUR', 3);
define('PENCIL_OLD_DEFAULT_FONT_COLOUR', 1);


$_CONSTANTS['cards'] = array("Visa", "Mastercard", "BankCard", "Amex", "JCB");


$_CONSTANTS['colours'] = array();

//$_LINKS['secure'] = "https://echidnaweb.com.au/~identiki/secure/index.php";
//$_LINKS['secure'] = "https://sitepond.com/~identiki/secure/index.php";
//$_LINKS['secure'] = "https://echidnaweb.com.au/~identiki/secure/index.php";
//$_LINKS['secure'] = "https://jupiter.caserver1.com/~identiki/secure/index.php";
//$_LINKS['secure'] = "https://www.echidnaweb.net/~identiki/secure/index.php";


$_CONSTANTS['referer_urls'] = array("http://www.identikid.com.au/beta/submit_order_ps.php","https://www.identikid.com.au/beta/secure/index.php",);
//$_CONSTANTS['referer_urls'] = array("http://identikid.globaldial.com/submit_order_ps.php","https://identikid.globaldial.com/secure/index.php",);

$_CONSTANTS['newAbsImageUrl'] = "http://www.identikid.com.au/beta";
//$_CONSTANTS['newAbsImageUrl'] = "http://identikid.globaldial.com";

$_LINKS['secure'] = "https://www.identikid.com.au/beta/secure/index.php";
//$_LINKS['secure']= "https://identikid.globaldial.com/secure/index.php";

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
											"5" => array("desc" => "New Zealand Dollars", "currency" => "NZ\$", "code" => "NZD"),
);


require_once(COMMON."global.php");

?>
