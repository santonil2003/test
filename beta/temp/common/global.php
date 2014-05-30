<?

require_once(COMMON . "database.php");
require_once(COMMON . "email.php");
require_once(COMMON . "error.php");
require_once(COMMON . "html.php");
require_once(COMMON . "date.php");
require_once(COMMON . "data.php");
require_once(COMMON . "identikid_functions.php");


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

db_connect();

?>