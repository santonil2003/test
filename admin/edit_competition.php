<?PHP
	require_once('../_common/_connection.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();

	if (isset($_POST["update"]))
	{
		$title = addslashes($_POST["title"]);
		$description = addslashes($_POST["details"]);
		
		$sql = "UPDATE competition SET title = '$title', description = '$description' WHERE id = 1";
		$result = mysql_query($sql); 
		if (!$result) {
 		  die('Invalid query: ' . mysql_error());
		}
		else
		{
		 echo "Updated! <BR />";
		}
		
	unset ($_POST["update"]);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Bubbaroo Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../includes/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<?PHP
	$sql = "SELECT * FROM competition WHERE id = 1";
	$result = mysql_query($sql); 
	if (!$result) {
 	 die('Invalid query: ' . mysql_error());
	}
	$row = mysql_fetch_assoc($result);
?>
<form name="form1" method="post" action="">
  <table width="60%" border="0" cellspacing="5">
    <tr> 
      <td><font color="75CDFD" size="4"><strong>Update Competition Details</strong></font></td>
    </tr>
    <tr> 
      <td><strong><font size="2">Competition title</font></strong></td>
    </tr>
    <tr> 
      <td><input name="title" type="text" size="50" value="<?php echo $row["title"];?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><strong><font size="2">Competition Details </font></strong></td>
    </tr>
    <tr> 
      <td><textarea name="details" cols="40" rows="10"><?PHP echo $row["description"]; ?></textarea></td>
    </tr>
    <tr> 
      <td><input type="submit" name="update" value="Update"></td>
    </tr>
  </table>
</form>


