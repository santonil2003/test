<?php


/*
if($_POST["showperpage"]){
	setcookie("showperpage", $_POST["showperpage"], time()+36000);
}

$includeabove = true;

include("../useractions.php"); // this includes common_db.php

linkme();

session_start();

$orders_search = 29332;
$query = "SELECT * FROM orders WHERE id=".($orders_search-1000);
echo $query."<br />";
$result = mysql_query($query) or die("error ".mysql_error());

//http://www.identikid.com.au/admin/changesearch.php?orders_search=29332&label_search=0&phone_search=&name_search=&showperpage=50&startrecord=0
*/

// Print an individual cookie
echo $_COOKIE["TestCookie"];
echo $HTTP_COOKIE_VARS["TestCookie"];

// Another way to debug/test is to view all cookies
print_r($_COOKIE);
?> 

