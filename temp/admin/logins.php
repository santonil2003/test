<?PHP

include("required.php");
linkme();

session_start();
$user_section_id = 8;

require_once("./security.php");
check_access($user_section_id);

if($_POST['section'] == "save")
{
   $restrict = $_POST['user_restrict']=='true'?'true':'false';
   
	// save details
	if((int)$_POST['user_id'] > 0)
	{
		// update
		$string = "update user set user_name='{$_POST['user_name']}',
			user_password='{$_POST['user_password']}',
			user_email='{$_POST['user_email']}' , user_restrict = '{$restrict}'
			WHERE user_id=" . (int)$_POST['user_id'];
		$result = mysql_query($string);
		$delete_user_id = $_POST['user_id'];
	}
	else
	{
		// save
		$string = "INSERT INTO user (user_name, user_password, user_email, user_restrict)
			VALUES ('{$_POST['user_name']}', '{$_POST['user_password']}', '{$_POST['user_email']}', '{$restrict}')";
		$result = mysql_query($string);
		$delete_user_id = mysql_insert_id();
	}


	if((int)$delete_user_id > 0)
	{
		// update access
		$string = "DELETE FROM user_access WHERE user_id=" . (int)$_POST['user_id'];
		$result = mysql_query($string);
		$sections = array();
		foreach($_POST as $key => $value)
		{
			if(preg_match("/^section_(\d*)$/", $key, $matches))
			{
				$string = "INSERT INTO user_access VALUES ({$delete_user_id}, {$matches[1]})";
				$result = mysql_query($string);
			}
		}
	}
	else
	{
		?>
		ERROR: Invalid user_id
		<?
	}
}

if($_GET['section'] == "delete" && (int)$_GET['user_id']>0)
{
	$string = "DELETE FROM user WHERE user_id=" . (int)$_GET['user_id'];
	$result = mysql_query($string);
	$string = "DELETE FROM user_access WHERE user_id=" . (int)$_GET['user_id'];
	$result = mysql_query($string);
}


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">


<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>
</head>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

<table cellpadding="0" cellspacing="0" border="0" width="884" height="100%" align="center">
	<tr>
		<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" class="maintext" width="100%" align="center">
        <tr>
          <td colspan="6"><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td colspan="6"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>

<?
if($_GET['section'] == "edit")
{
	$user = array();


	if((int)$_GET['user_id'] > 0)
	{
		$string = "select * from user where user_id=" . (int)$_GET['user_id'];
		$result = mysql_query($string);
		if(mysql_num_rows($result)==1)
		{
			$user=mysql_fetch_array($result);
		}
		else
		{
			?>
			<tr>
				<td colspan=6 bgcolor="#FFFFFF" class="maintext">
					<p>Invalid User ID</p>
					<p><a href="javascript:history.back();">Back</a></p>
				</td>
			</tr>
			<?
			unset($user);
		}
	}

	if(isset($user))
	{

		?>
		<form name="users" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
		<input type=hidden name=section value="save">
		<input type=hidden name=user_id value="<?=$user['user_id'];?>">
		<tr>
			<td colspan=6 align=center><br />
				<strong>User Details</strong><br />
				<br /></td>
		</tr>
		<tr>
			<td colspan=3 align="right"><strong>User ID:</td>
			<td width=1%>&nbsp;&nbsp;</td>
			<td width=50%><?=($_GET['user_id']==-1)?"New":$user['user_id'];?></td>
		</tr>
		<tr>
			<td colspan=3 align="right"><strong>Username:</td>
			<td>&nbsp;&nbsp;</td>
			<td colspan=2><input type=text name="user_name" value="<?=$user['user_name']?>" size="30"></td>
		</tr>
		<tr>
			<td colspan=3 align="right" width=50%><strong>Password:</td>
			<td>&nbsp;&nbsp;</td>
			<td colspan=2><input type=text name="user_password" value="<?=$user['user_password']?>" size="30"></td>
		</tr>
		<tr>
			<td colspan=3 align="right" width=50%><strong>Email:</td>
			<td>&nbsp;&nbsp;</td>
			<td colspan=2><input type=text name="user_email" value="<?=$user['user_email']?>" size="30"></td>
		</tr>
		<tr>
			<td colspan=3 align="right" width=50%><strong>Restrict Login:</strong></td>
			<td>&nbsp;&nbsp;</td>
			<td colspan=2><input type=checkbox name="user_restrict" value="true" size="30" <?=$user['user_restrict']=='true'?'checked':'';?> ></td>
		</tr>
		<tr>
			<td colspan=6 align=center><br><strong>Sections</strong></td>
		</tr>
		<?
		$string = "select * from user_section order by user_section_name";
		$result = mysql_query($string);
		while($section = mysql_fetch_array($result))
		{

			$string = "select 1 from user_access where user_id=" . (int)$_GET['user_id'] . " AND user_section_id=" . (int)$section['user_section_id'];
			$result2= mysql_query($string);
			if(mysql_num_rows($result2)==1)
			{
				$checked = "checked";
			}
			else
			{
				$checked = "";
			}
			?>
			<tr>
				<td colspan=3 align="right" width=50%><?=$section['user_section_name']?></td>
				<td>&nbsp;&nbsp;</td>
				<td colspan=2><input type=checkbox name="section_<?=$section['user_section_id']?>" value="1" <?=$checked?>></td>
			</tr>
			<?
		}

		?>
		<tr>
			<td colspan=6 align=center><br /><input type="submit" name="save" value="Save"></td>
		</tr>
		<?



	}

}
else
{
	// display list of users.

	?>
	<form name="users" action="<?=$_SERVER['PHP_SELF']?>" method="GET">
	<input type="hidden" name="section" value="edit">
	<input type="hidden" name="user_id" value="-1">


	      <tr> 
  	      <td height="58" colspan="6" valign="middle" class="admintext" align="center"> 
							<input type="button" name="back" value="Back" onClick="location.href='index.php'">
	    	      <input type="submit" name="add_new" value="Add New User">
					</td>
				</tr>
				<tr>
					<td width="10%"><strong>User ID</td>
					<td width="20%"><strong>Username</td>
					<td width="20%"><strong>Password</td>
					<td width="30%"><strong>Email</td>
					<td width="10%"><strong>Edit</td>
					<td width="10%"><strong>Delete</td>
				</tr>
	<?

	$bgcolours = array("#CCCCCC", "#DDDDDD");
	$bgcolour = 0;

	$string = "select * from user order by user_name";
	$result = mysql_query($string);
	while($row=mysql_fetch_array($result))
	{
		?>
		<tr bgcolor="<?=$bgcolours[$bgcolour];?>">
			<td><?=$row['user_id']?></td>
			<td><?=$row['user_name']?></td>
			<td><?=$row['user_password']?></td>
			<td><a href="mailto:<?=$row['user_email'];?>"><?=$row['user_email']?></a></td>
			<td><a href="<?=$_SERVER['PHP_SELF']?>?section=edit&user_id=<?=$row['user_id']?>">Edit</a></td>
			<td><a href="<?=$_SERVER['PHP_SELF']?>?section=delete&user_id=<?=$row['user_id']?>" onClick="return confirm('Are you sure you want to delete this user?');">Delete</a></td>
		</tr>
		<?
		$bgcolour = ($bgcolour==1)?0:1;

	}
	?>						
	</form>
	<?


}

?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>