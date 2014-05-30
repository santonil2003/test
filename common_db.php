<?php


//$dbhost = "localhost";
$dbhost = "localhost";
//$dhhost =  "";
$dbport = "";


if(preg_match('/\/devel\//', $_SERVER['SCRIPT_FILENAME'])){ 
	//DEVELOPMENT
	$dbusername = "identiki";
	$dbuserpassword = 'id4$cTe';
	$default_dbname = "identikid";
	//echo "<font color=\"red\"><b>DEVELOPMENT ".date("d/m/Y H:i:s")."</b></font>";
} else {
	// LIVE
	$dbusername = "identiki";
	$dbuserpassword = 'id4$cTe';
	$default_dbname = "identikid";
}

$default_sortby = "id";
$default_order = "ASC";

$MYSQL_ERRNO = "";
$MYSQL_ERROR = "";

function db_connect($dbname="") {
	global $dbhost, $dbport, $dbusername, $dbuserpassword, $default_dbname;
	global $MYSQL_ERRNO, $MYSQL_ERROR;
	
	$link_id = mysql_connect($dbhost . $dbport, $dbusername, $dbuserpassword);
	if (!$link_id) {
		$MYSQL_ERRNO = mysql_errno();
		$MYSQL_ERROR = "Connection failed to the host $dbhost.";
		return 0;
	}
	else if(empty($dbname) && !mysql_select_db($default_dbname)) {
		$MYSQL_ERRNO = mysql_errno();
		$MYSQL_ERROR = mysql_error();
		return 0;
	}
	else if(!empty($dbname) && !mysql_select_db($dbname)) {
		$MYSQL_ERRNO = mysql_errno();
		$MYSQL_ERROR = mysql_error();
		return 0;
	}
	else return $link_id;
}

function sql_error() {
	global $MYSQL_ERRNO, $MYSQL_ERROR;

	if (empty($MYSQL_ERROR)) {
		$MYSQL_ERRNO = mysql_errno();
		$MYSQL_ERROR = mysql_error();
	}
	return "$MYSQL_ERRNO: $MYSQL_ERROR";
}

function error_message($msg) {
	echo "Error: $msg";
	exit;
}

function linkme(){
	global $default_dbname, $link_id;
	$link_id = db_connect($default_dbname);
	if (!$link_id) error_message(sql_error());
}


function setsession($varname, $defaultvalue){
	if(!isset($_SESSION[$varname])){
		$_SESSION[$varname] = $defaultvalue;
	}
	if(isset($_GET["set_".$varname])){
		$_SESSION[$varname] = $_GET["set_".$varname];
	}else if(isset($_POST["set_".$varname])){		
		$_SESSION[$varname] = $_POST["set_".$varname];
	}
	return $_SESSION[$varname];
}

/*

if (get_magic_quotes_gpc()){
	remove_magic_quotes("_GET");
	remove_magic_quotes("_POST");
	remove_magic_quotes("_SESSION");
	remove_magic_quotes("_COOKIE");
	ini_set("magic_quotes_gpc",0);
}

set_magic_quotes_runtime(0);

function remove_magic_quotes($vars,$suffix = '') {
	eval("\$vars_val =& \$GLOBALS[$vars]$suffix;");
	if(is_array($vars_val)){
	  reset($vars_val);
	  while (list($key,$val) = each($vars_val))
		remove_magic_quotes($vars,$suffix."[$key]");
	}else{
	  $vars_val = stripslashes($vars_val);
	  eval("\$GLOBALS$suffix = \$vars_val;");
	}
}
*/
?>
