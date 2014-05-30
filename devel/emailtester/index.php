<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>M&amp;C Saatchi emailer tool</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<style type="text/css">
	td {
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
		color:#000000;
	}
</style>

<body>
	<table cellpadding="0" cellspacing="0" border="0">
	<form name="emailer" action="sendem.php" method="post">
		<tr>
			<td width="200"><strong>From email address:</strong></td>
			<td>&nbsp;</td>
			<td><input type="text" size="25" name="fromemail"></td>
		</tr>
		<tr>
			<td><strong>From name:</strong></td>
			<td>&nbsp;</td>
			<td><input type="text" size="25" name="fromname"></td>
		</tr>
		<tr>
			<td><strong>Email title:</strong></td>
			<td>&nbsp;</td>
			<td><input type="text" size="25" name="title"></td>
		</tr>
		<tr>
			<td valign="top"><strong>To addresses:</strong><br>(delimit multiple addresses with a<br>comma eg. 'mark@example.com,<br>emily@example.com')</td>
			<td>&nbsp;</td>
			<td><textarea name="to" rows="10" cols="25"></textarea></td>
		</tr>
		<tr>
			<td valign="top"><strong>HTML version:</strong><br>(copy and paste html here)</td>
			<td>&nbsp;</td>
			<td><textarea name="htmlv" rows="10" cols="25"></textarea></td>
		</tr>
		<tr>
			<td valign="top"><strong>Text version:</strong><br>(copy and paste text here)</td>
			<td>&nbsp;</td>
			<td><textarea name="textv" rows="10" cols="25"></textarea></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td><input type="submit" value="send >>"></td>
		</tr>
		</form>
	</table>

</body>
</html>
