<?php
$includeabove=true;
include("../useractions.php");
include("currencymanager_functions.php");
linkme();

session_start();

$user_section_id = 6;
require_once("./security.php");
check_access($user_section_id);

header("Cache-control: private");

require_once('../_common/_constants.php');

//this is the error handler for all errors that occur anywhere. It will render the warning
function default_error_handler($errno, $errstr, $errfile, $errline)
{
	if($errno == E_USER_ERROR || $errno == E_ERROR)
	{
		if(isset($db))$db->closeDb();	
		include(SITE_DIR.'_pages/_error.php');
		include('footer_new.php');
		exit;
	}
	elseif($errno == E_USER_NOTICE)
	{
		if(isset($db))$db->closeDb();
		include(SITE_DIR.'_pages/_notice.php');
		include('footer_new.php');
		exit;
	}
}
set_error_handler('default_error_handler');
//end error handler setup

include("header_new.php"); 
//end header

//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
//end db setup

$curr = getCurrencies();
?>

<strong><font color="#999999" size="2" face="'Trebuchet MS', Verdana, Arial">Manage Products</font></strong> - <a href="product_edit.php?id=-1">Add Product</a><br><br>
<center>
<table width="800">
	<tr>
		<th style="text-align: left;" width="9%">ID</th>
		<th style="text-align: left;" width="61%">Name</th>
		<th style="text-align: left;" width="20%">Category</th>
		<th style="text-align: left;" width="10%">&nbsp;</th>
	</tr>
	
<?php
	$sql = "SELECT * FROM product ORDER BY id";
	$r = db_query($sql);
	$prod = db_fetch_array($r);
	$bgcolor = "#ffffff";
	while ($prod)
	{
		if ("#ffffff" == $bgcolor)
		{
			$bgcolor = "#eeeeee";
		}
		else
		{
			$bgcolor = "#ffffff";
		}
?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $prod['id']; ?></td>
		<td><?php echo $prod['productName']; ?></td>
		<td><?php echo $prod['productType']; ?></td>
		<td>
		<a href="product_edit.php?id=<?php echo $prod['id']; ?>"><img src="images/b_edit.png" style="border: 0px;" alt="Edit Product" title="Edit Product" /></a>
		</td>
	</tr>
<?php
		$prod = db_fetch_array($r);
	}
?>

</table>
</center>
<?php
//close db
if(isset($db))$db->closeDb();
//end close db

//footer
include("footer_new.php"); 
//end footer
?>