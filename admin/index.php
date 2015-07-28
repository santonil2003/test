<?PHP
session_start();
error_reporting(E_ERROR | E_PARSE);
/*
require_once("../_common/_constants.php");
require_once("../_common/_connection.php");
require_once("../useractions.php");
*/
require_once("required.php");
require_once("./security.php");
linkme();


if(isset($_GET['logout']))
{
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
}

$error_message = "";
if(isset($_POST['user_name']) && isset($_POST['user_password']))
{

	$string = "SELECT user_id, user_name, user_restrict FROM user WHERE user_name = '" . addslashes(stripslashes($_POST['user_name'])) . "' AND user_password = '" . addslashes(stripslashes($_POST['user_password'])) . "'";

	$result = mysql_query($string);
	if(mysql_num_rows($result)==1)
	{
		list($user_id, $user_name, $user_restrict) = mysql_fetch_row($result);
		if($user_restrict=='false' || ($user_restrict=='true' && $_SERVER['REMOTE_ADDR']=="59.167.161.181")) {
		  $_SESSION['user_id'] = $user_id; 
		  $_SESSION['user_name'] = $user_name;
		} else {
		  $error_message = "You are unable to login from this terminal - IP: ".$_SERVER['REMOTE_ADDR'];
      }

	}
	else
	{
		$error_message = "Invalid Username or Password";
	}

}

try {
    include_once 'request-handler.php';
} catch (Exception $exc) {
    echo $exc->getTraceAsString();   
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi%20kid.css" rel="stylesheet" type="text/css">
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"> 

<table cellpadding="0" cellspacing="0" border="0" width="884" height="100%" align="center">
	<tr>
		<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9" class="maintext" width=100%>
        <tr>
          <td><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr>
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
				<tr> 
					<td valign="top" class="whitetext"> 
						<p align="center"><strong><br> 
										<img src="../images/spacer_trans.gif" width="20" height="20">ADMINISTRATION - Secure Area for IK Staff.</strong><br> 
										<br> 
						</p> 
					</td> 
				</tr> 
<?

if((int)$_SESSION['user_id'] > 0)
{
	?>
				<tr bgcolor="#FFFFFF"> 
					<td valign="top" bgcolor="#FFFFFF" class="whitetext" align="center"><br />
									<font color="#000000"><strong>Welcome <?=$_SESSION['user_name'];?> [<a href="<?=$_SERVER['PHP_SELF']?>?logout">logout</a>]<br>
									<br />

									<table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#CCCCCC"> 
<?
if(check_access(1, true))
{
	?>
	<tr class="maintext"> 
		<td width="21%" bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./orders_admin.php" class="type1">View Orders</a></strong></font></td> 
		<td width="79%"><font color="#000000" size="2">view/edit/add/delete orders</font></td> 
	</tr> 
	<?
}
if(check_access(9, true) && (1==2))
{
	?>
	<tr class="maintext"> 
		        <td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="daily_report.php" target="_self" class="type1" target="_blank">Daily 
                  Transaction Report</a></strong></font></td> 
		        <td><font color="#000000" size="2">view transaction reports by 
                  date and time</font></td> 
	</tr> 
	<?
}

if(check_access(9, true) && (1==2))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="https://earth.australis.net.au/epay" class="type1" target="_blank">MultiBase Admin </a></strong></font></td> 
		<td><font color="#000000" size="2">log in to MultiBase to view/edit payment info</font></td> 
	</tr> 
	<?
}

if(check_access(10, true) && (1==2))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="https://client.eterminal.com.au/eterminal/admin" class="type1">PayStream Admin </a></strong></font></td> 
		<td><font color="#000000" size="2">log in to PayStream to view/edit payment info (<strong>OLD</strong>)</font></td> 
	</tr> 
	<?
}

if(check_access(2, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="index.php?download=1" class="type1">Download customer</a></strong></font></td> 
		<td><font color="#000000" size="2">calculate all commissions for a given period, or produce commission summary for individual</font> <font color="#000000" size="2">fundraisers </font></td> 
	</tr> 
	<?
}

if(check_access(2, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./fundraisers.php" class="type1">Fundraiser Commissions <br> (<b>old</b>)</a></strong></font></td> 
		<td><font color="#000000" size="2">(<b>**Prior to July 2008**</b>) calculate all commissions for a given period, or produce commission summary for individual</font> <font color="#000000" size="2">fundraisers </font></td> 
	</tr> 
	<?
}


if(check_access(2, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./addresslabels_fundraiser.php" target="_blank" class="type1">Fundraiser Address Labels</a></strong></font></td> 
		<td><font color="#000000" size="2">print out fundraiser address labels</font></td> 
	</tr> 
	<?
}

if(false)
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="#" class="type1">Reports</a></strong></font></td> 
		<td><font color="#000000" size="2">not created yet</font></td> 
	</tr> 
	<?
}

if(check_access(3, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./newsletter.php" class="type1">Newsletters</a></strong></font></td> 
		<td><font color="#000000" size="2">create identi Kid newsletter using the template design and email to the mailing list.</font></td> 
	</tr>
	<?
}

if(check_access(4, true))
{
	?>
	<tr>
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./subscriber.php" class="type1">Newsletter
	          Subscribers</a></strong></font></td> 
		<td><font color="#000000" size="2">edit the list of newsletter subscribers.</font></td> 
	</tr> 
	<?
}

if(check_access(11, true) && (1==2))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="http://www.identikid.com.au/awstats/awstats.pl?config=www.identikid.com.au" target="_blank" class="type1">CPanel</a></strong></font></td> 
		<td><font color="#000000" size="2">log in to IdentiKid's control panel to view stats, administer email accounts + much more</font></td> 
	</tr> 
	<?
}

if(check_access(5, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./addresslabels.php" target="_blank" class="type1">Address Labels</a></strong></font></td> 
		<td><font color="#000000" size="2">print out address labels for any period</font></td> 
	</tr> 
	<?
}


if(check_access(6, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./products.php" class="type1">Product Manager</a></strong></font></td> 
		<td><font color="#000000" size="2">add/edit main product details</font></td> 
	</tr>
	<?
}

if(check_access(6, true))
{
	?>
	<tr class="maintext"> 
		<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./currencymanager.php" class="type1">Currency Manager</a></strong></font></td> 
		<td><font color="#000000" size="2">manage prices and postage costs for each currency</font></td> 
	</tr>
	<?
}

if(check_access(7, true))
{
	?>
										<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./vouchers.php" class="type1">Gift Vouchers</a></strong></font></td> 
											<td><font color="#000000" size="2">manage each gift voucher</font></td> 
										</tr>
	<?
}
if(1==2){
?>
										<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="http://www.identikid.com.au/logos.htm" class="type1">identiKid Logos</a></strong></font></td> 
											<td><font color="#000000" size="2">identiKid Logos</font></td> 
										</tr>
<?
}
if(check_access(12, true))
{
	?>
	
	<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./content_pages.php" class="type1">Edit Content</a></strong></font></td> 
											<td><font color="#000000" size="2">Update the content of the identikid site</font></td> 
	</tr>
	
	
<?
	
}

if(check_access(8, true))
{
	?>
										<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="./logins.php" class="type1">identiKid Logins</a></strong></font></td> 
											<td><font color="#000000" size="2">Logins</font></td> 
										</tr>
										
										<!--<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="competition_2007.php" class="type1">Competition</a></strong></font></td> 
											<td><font color="#000000" size="2">$50 Voucher Winner 2007</font></td> 
										</tr>-->
<?
}
if(check_access(13, true))
{
	?>
										<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="competition.php" class="type1">Competitions</a></strong></font></td> 
											<td><font color="#000000" size="2">Competitions</font></td> 
										</tr>
										<!--<tr class="maintext"> 
											<td bgcolor="#F3F3F3"><font color="#000000" size="2"><strong><a href="competition_dvd.php" class="type1">Competition</a></strong></font></td> 
											<td><font color="#000000" size="2">Win a Portable DVD Player!!</font></td> 
										</tr>-->
	<?
}

?>
								</table> 
					</td> 
				</tr> 
	<?
}
else
{
	?>
	<tr bgcolor="#FFFFFF"> 
		<td valign="top" bgcolor="#FFFFFF" class="whitetext"> 
			<p>&nbsp;</p>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td>
			<table cellpadding=0 cellspacing=0 border=0 align=center>
	<?
	if(!empty($error_message))
	{
		?>

				<tr>
					<td align=center colspan=3><span style="color: red; font-weight: bold;"><?=$error_message;?></td>
				</tr>
		<?
	}

	?>
		
	<form name="login" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
				<tr>
					<td align=right>username</td>
					<td>&nbsp;</td>
					<td><input type="text" name="user_name" value="<?=$_POST['user_name']?>"></td>
				</tr>
				<tr>
					<td align=right>password</td>
					<td>&nbsp;</td>
					<td><input type="password" name="user_password" value=""></td>
				</tr>
				<tr>
					<td align=center colspan=3><input type=submit name=submit value="Login"></td>
				</tr>
			</table>
		</tr>
	</form>

	<?						
}

?>
			</table> 
		</td> 
	</tr>                                                                        
</table> 
    
    <br/>
    <style>
        .live{
            padding: 5px 10px;
            background:#009933;
            text-decoration: none;
        }
        
        .under-construction{
            padding: 5px 10px;
            background: #CC0000;
            text-decoration: none;
        }
    </style>
    <table cellpadding="0" cellspacing="0" border="0" width="884" align="center">
        <tr>
            <td align="left">
            <a href="index.php?action=make-live" class="live">
                Go Live
            </a>
            </td>
            <td align="right">
            <a href="index.php?action=under-construction" class="under-construction">
                Under Construction
            </a>
            </td>
        </tr>
    </table>
</body>
</html>
