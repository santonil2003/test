<?php
function debug_log_add($script_name, $notes)
{
	$sess_id = session_id();
	
	$sql = "INSERT INTO debug_log (session_id, script_name, notes) VALUES ('" . $sess_id . "','" . $script_name . "','" . $notes . "')";
	//print $sql;
	mysql_query($sql);
}
?>