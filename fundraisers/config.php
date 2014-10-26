<?php

/* * *
 * System configuration
 */

// Define base path
define('BASE_PATH', __DIR__);

// Define base url
define('BASE_URL', 'http://www.anne.com/fundraisers');

//Define run time enviornment
$env = ($_SERVER['SERVER_ADDR'] != '127.0.0.1') ? 'PRODUCTION' : 'DEVELOPMENT';
define('ENV', $env);

// Define log path
define('LOG_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR);

// System configuration
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_LAYOUT', 'index');

/**
 * enviornment based configuration
 * @todo set appropriate error reporting label and other configuration
 */
switch (ENV) {
    case 'PRODUCTION':
        define('DB_HOST', 'localhost');
        define('DB_USER', 'identiki');
        define('DB_PASSWORD', 'id4$cTe');
        define('DB_NAME', 'identikid');
        break;
    case 'TEST':
    case 'DEVELOPMENT':
    default:
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'identikid');
        break;
}
