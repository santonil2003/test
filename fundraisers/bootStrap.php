<?php

require 'config.php';

/**
 * auto include the class from controllers, models and class directory
 * @param type $className
 */
function __autoload($className) {
    if (file_exists('controllers/' . $className . '.php')) {
        include 'controllers/' . $className . '.php';
    } elseif (file_exists('models/' . $className . '.php')) {
        include 'models/' . $className . '.php';
    } elseif (file_exists('class/' . $className . '.php')) {
        include 'class/' . $className . '.php';
    }
}

/**
 * database configuration
 */
Db::config('driver', 'mysql');
Db::config('host', DB_HOST);
Db::config('database', DB_NAME);
Db::config('user', DB_USER);
Db::config('password', DB_PASSWORD);
