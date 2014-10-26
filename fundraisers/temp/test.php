<?php

/**
 * test script to distribute packate into multiple package
 */
$items = array();

$items[] = array('name' => 'item1', 'price' => 10, 'weight' => 200);

$items[] = array('name' => 'item2', 'price' => 100, 'weight' => 20);

$items[] = array('name' => 'item3', 'price' => 30, 'weight' => 300);

$items[] = array('name' => 'item4', 'price' => 20, 'weight' => 500);

$items[] = array('name' => 'item6', 'price' => 40, 'weight' => 10);

$items[] = array('name' => 'item7', 'price' => 200, 'weight' => 10);


$totalPrice = 0;
$totalWeight = 0;

foreach ($items as $item) {
    $totalPrice+= $item['price'];
    $totalWeight+= $item['weight'];
}

$noOfPackage = ceil($totalPrice / 250);
echo "<br> no of price :" . $totalPrice;
echo "<br> no of weight :" . $totalWeight;
echo "<br>  no of package :" . $noOfPackage;



