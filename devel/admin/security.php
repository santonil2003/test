<?PHP

// security file.

function check_access($user_section_id, $function=false)
{

	if((int)$_SESSION['user_id'] > 0)
	{
		$string = "select user_id from user_access WHERE user_section_id=" . (int)$user_section_id . " AND user_id=" . (int)$_SESSION['user_id'];
		$result = mysql_query($string) or die('sql error: '.mysql_error());
		
		if(mysql_num_rows($result)==1)
		{
			return true;
		}
		else
		{
			if($function==true)
			{
				return false;
			}
			else
			{

				?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">

<script language="JavaScript">

<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

<table cellpadding="0" cellspacing="0" border="0" width="884" height="100%" align="center">
	<tr>
		<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" class="maintext" width=100%>
        <tr>
          <td colspan="6"><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td colspan="6"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
				<tr>
					<td colspan="6" bgcolor="#FFFFFF">
						<p>&nbsp;</p>
						<p>You do not have permission to access this section, please contact <a href="mailto:anne@identikid.com.au">anne@identikid.com.au</a> if you believe this is an error.</p>
						<p><a href="javascript:history.back();">Back</a></p>	
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
			<?
				exit();
				return false;
			}
		}
	}
	else
	{
		Header("Location: index.php");
	}
}




?>