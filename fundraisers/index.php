<?php

/**
 * Entry point
 * boot strap the system
 * @package custom mvc pattern inplementation
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
require 'bootStrap.php';

/**
 * get controller and action from from url
 */
$controller = isset($_GET['controller']) ? $_GET['controller'] : DEFAULT_CONTROLLER;
$action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

/**
 * prepare controller class and path according to convention
 */
$controllerClass = $controller . 'Controller';
$controllerPath = 'controllers/' . $controllerClass . '.php';

/**
 * check if requested controller file and class exists
 * @todo use error controller and action to display errors
 */
if (file_exists($controllerPath)) {
    if (class_exists($controllerClass)) {
        $Controller = new $controllerClass;
    } else {
        $msg = $controllerClass . ' class not found!';
        exit($msg);
    }
} else {
    $msg = $controllerPath . ' not found!';
    exit($msg);
}

/**
 * prepare method
 */
$methodName = $action . 'Action';

if (!method_exists($Controller, $methodName)) {
    $msg = " Method $methodName not found on $controllerClass Class ";
    exit($msg);
}

/**
 * execute appropriate contoller's action method
 */
try {
    $Controller->{$methodName}();
} catch (Exception $exc) {
    // write exeception log into 
    debug::l($exc->getTraceAsString(), 'system-error.html');
}
