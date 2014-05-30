<?php
	require_once("required.php");
	
	// get ID of record to delete
	$id = $_GET['id'];
	
	// delete past winner query
	$sql = "UPDATE competition_winners SET deleted = 1 WHERE id='$id'";
	$result = mysql_query($sql) or die("SQL error: ".mysql_error());

	header("Location: http://identikid.com.au/admin/competition.php");
?>