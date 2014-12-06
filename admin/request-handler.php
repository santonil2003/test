<?php

define('ADMIN_BASE_PATH', dirname(__FILE__));

define('SITE_BASE_PATH', ADMIN_BASE_PATH . '/..');

$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';

ini_set('display_error', '1');

$res = false;

switch ($action) {
    case 'make-live':
        $res = copy(SITE_BASE_PATH . '/' . '.htaccess-live', SITE_BASE_PATH . '/' . '.htaccess');
        break;
    case 'under-construction':
        $res = copy(SITE_BASE_PATH . '/' . '.htaccess-underconstruction', SITE_BASE_PATH . '/' . '.htaccess');
        break;
    default:
        break;
}

