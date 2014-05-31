<?php

//require_once("database.php");
require_once("email.php");
require_once("error.php");
require_once("html.php");
require_once("date.php");
require_once("data.php");
require_once("identikid_functions.php");


/*// assert options.
if(DEV_SERVER == true)
{
	error_reporting(E_ALL);
	assert_options(ASSERT_ACTIVE, 1);
	assert_options(ASSERT_WARNING, 1);
}
else
{
	assert_options(ASSERT_ACTIVE, 1);
	assert_options(ASSERT_WARNING, 1);
	assert_options(ASSERT_QUIET_EVAL, 1);
}*/

assert_options(ASSERT_CALLBACK, 'assert_handler');

//db_connect();

?>