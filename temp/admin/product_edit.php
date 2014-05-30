<?php
session_start();

require_once('../_common/_constants.php');
$spaw_root = SITE_DIR.SPAW_DIR;
require $spaw_root.'spaw_control.class.php';

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

//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
//end db setup

$action = $_POST['prod_action'];
if ("save" == $action)
{
	$id = $_POST['prod_id'];
	if ("" == $id) {$id = -1;}
	$name = $_POST['prod_name'];
	$type = $_POST['prod_type'];
	$qty = $_POST['unit_quant'];
	
	$record = array();
	$record['productName'] = $name;
	$record['productType'] = $type;
	$record['unitQuant'] = $qty;
	
	if (0 > $id)
	{
		$newid = 0;
		db_insert("product", $record, &$newid);
	}
	else
	{
		db_update("product", $record, "id=".$id);
	}
	
	if(isset($db))$db->closeDb();
	header("Location: products.php");
	exit;
}

header("Cache-control: private");
include("header_new.php"); 
//end header

$prod_id = $_GET['id'];

$sql = "SELECT * FROM product WHERE id = " . $prod_id;
$r = db_query($sql);
$prod = db_fetch_array($r);
?>

<strong><font color="#999999" size="2" face="'Trebuchet MS', Verdana, Arial">Edit Product</font></strong><br><br>
<form action="" method="POST">
<table>
	<tr>
		<td style="vertical-align: top; width: 100px;"><strong>ID:</strong></td><td style="vertical-align: top;">
		<?php if (-1 == $prod_id) {echo "[New Product]";} else {echo $prod['id'];} ?>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td style="vertical-align: top;"><strong>Product Name:</strong></td><td style="vertical-align: top;"><input type="text" name="prod_name" style="width: 640px;" value="<?php echo stripslashes($prod['productName']); ?>" /></td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>

	<tr>
		<td style="vertical-align: top;"><strong>Category:</strong></td><td style="vertical-align: top;">
		<select name="prod_type">
			<option value="Personalised"<?php if ("Personalised" == $prod['productType']) {echo " SELECTED";} ?>>Personalised (Products using Pop-Up)</option>
			<option value="Charms"<?php if ("Charms" == $prod['productType']) {echo " SELECTED";} ?>>Charms (Custom Charm Bracelets, Bands etc.)</option>
			<option value="Vouchers"<?php if ("Vouchers" == $prod['productType']) {echo " SELECTED";} ?>>Vouchers (Gift Voucher Products)</option>
			<option value="Custom"<?php if ("Custom" == $prod['productType']) {echo " SELECTED";} ?>>Custom (Label products and packs)</option>
		</select>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td style="vertical-align: top;"><strong>Unit Quantity:</strong></td><td style="vertical-align: top;"><input type="text" id="unit_quant" name="unit_quant" value="<?php echo stripslashes($prod['unitQuant']); ?>" />
		</td>
	</tr>

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td><td><input type="button" style="background: #336699; color: white; font-weight: bold; font-size: 14px; height: 32px;" value="Back To Product Manager" onClick="javascript:window.location='products.php'; return false;" />&nbsp;&nbsp;<input type="submit" style="background: #336699; color: white; font-weight: bold; font-size: 14px; height: 32px;" value="Update" /></td>
	</tr>
</table>
<input type="hidden" name="prod_action" value="save">
<input type="hidden" name="prod_id" value="<?php echo $prod['id']; ?>">
</form>
<?php
//close db
if(isset($db))$db->closeDb();
//end close db

//footer
include("footer_new.php"); 
//end footer
?>	