<?php


include("../common_db.php");

	$query = "SELECT o.id,c.surname,c.firstname FROM orders o left join customers c on (o.Customer=c.id) WHERE payment_received=1 and graphics_processed is null";


	if(!$SQLresult) error_message(sql_error());
	while($qdata = mysql_fetch_array($SQLresult)){
		echo $qdata["id"];
	}
?>
