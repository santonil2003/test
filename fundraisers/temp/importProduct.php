<?php

#!/usr/bin/php

/**
 * CLI script to import product from csv to mysql database
 * one time script
 * @author Sanil shrestha <santonil2003@hotmail.com>
 */
require '../models/Db.php';

// database details
Db::config('driver', 'mysql');
Db::config('host', 'localhost');
Db::config('database', 'ecommerce');
Db::config('user', 'root');
Db::config('password', '');

$Db = Db::instance();

// parse csv to array
$file = fopen("product-import.csv", "r");

while (!feof($file)) {
    $item = fgetcsv($file);

    $data = array(
        'name' => $item[0],
        'price' => $item[1],
        'weight' => $item[2]
    );

    // Insert data into product table
    $Db->create('product', $data);
}

fclose($file);
