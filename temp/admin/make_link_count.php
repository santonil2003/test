<?
//By pass all Starwons good security work
while(list($key,$value) = each($HTTP_POST_VARS)){
		${$key} = $value;
}
while(list($key,$value) = each($HTTP_COOKIE_VARS)){
		${$key} = $value;
}

?><html>
<head>
<title>Character help</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../style.css" type="text/css">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?
switch ($type){
case '1'
?>
<br>
<br>
<div align="center">
  <textarea name="textfield" wrap="VIRTUAL" cols="25" rows="6"><? echo "<a href=\"javascript:openWindow('./sending_to_url.php?client=".$client."&type=link&url=mailto:".$address."')\">".$display."</a>"; ?></textarea>
  <br>
Cut and paste the text into the administration form. <br><a href="javascript:history.go(-1)">< 
back</a> </div>
<?
break;
case '2';
?>
<br>
<br>
<div align="center"> <textarea name="textarea" wrap="VIRTUAL" cols="25" rows="6"><? echo "<a href=\"./sending_to_url.php?client=".$client."&type=link&url=http://".$address."\" target=\"_blank\">".$display."</a>"; ?></textarea><br>
Cut and paste the text into the administration form. <br><a href="javascript:history.go(-1)">< 
back</a></div> 
<?
break;
default;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="77%" valign="top"> 
      <h1 align="left" class="headings">Help to create a link that is counted</h1>
    </td>
    <td width="23%" align="right" valign="top"> 
       <a href="javascript:history.go(-1)">< 
back</a>&nbsp;<div align="right"><a href="javascript:close();">close</a> </div>
    </td>
  </tr>
  <tr valign="top"> 
    <td colspan="2"> 
      <form name="form1" method="post" action="">
        <div align="center"> 
          <p>Display as <br>
            <input type="text" name="display" size="30" value="">
            <br>
            (this is what it will read as in the document)<br>
            <br>
          </p>
          <p>The email address or website address <br>
            <input type="text" name="address" size="30" value="">
          </p>
          <p>enter client (lowercase no spaces, can use '_')<br>
            <input type="text" name="client" size="30" value="">
            <br>
            (leave out - http:// or mailto:)<br>
          </p>
          <p>Select the type of link 
            <select name="type">
              <option value="1" selected>email</option>
              <option value="2">Web site</option>
            </select>
            <br>
            <input type="submit" name="Submit" value="Submit">
            <br>
            <br>
            <br>
            <a href="javascript:close();">close</a> </p>
        </div>
      </form>
    </td>
  </tr>
</table>

<?}?>
</body>
</html>