<?php //kill_long_query.php
//################ //
include("../useractions.php"); // this includes common_db.php
set_time_limit(100);

$result=mysql_query("show processlist");

while ($row=mysql_fetch_array($result))
{
	$process_id=$row["Id"];
if (($row["Time"] > 100 ) || ($row["Command"]=="Sleep") )
{
	print $row["Id"];
	$sql="kill $process_id";
	mysql_query($sql);
}

}
//###################//
?>