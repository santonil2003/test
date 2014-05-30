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
  <p class="maintext"> 
    <textarea name="textfield" cols="25" rows="6" wrap="VIRTUAL" class="maintext"><? echo "<a href=\"mailto:".$address."\">".$display."</a>"; ?></textarea>
    <br>
    Cut and paste the text into the administration form. <br>
    <a href="javascript:history.go(-1)" class="type1">< back</a> </p>
</div>
<?
break;
case '2';
?>
<br>
<br>
<div align="center"> 
  <p class="maintext"> 
    <textarea name="textarea" cols="25" rows="6" wrap="VIRTUAL" class="maintext"><? echo "<a href=\"http://".$address."\" target=\"_blank\">".$display."</a>"; ?></textarea>
    <br>
    Cut and paste the text into the administration form. <br>
    <a href="javascript:history.go(-1)" class="maintext">< back</a></p>
</div> 
<?
break;
default;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="77%" valign="top"> 
      <h1 align="left" class="headings">Help to create a link</h1>
    </td>
    <td width="23%" align="right" valign="top" class="maintext"> <table width="100" border="0" cellpadding="0" cellspacing="0" class="maintext">
        <tr>
          <td><a href="javascript:history.go(-1)" class="type1">< back</a></td>
        </tr>
        <tr>
          <td><a href="javascript:close();" class="type1">close</a> </td>
        </tr>
      </table>
      <div align="right"></div>
    </td>
  </tr>
  <tr valign="top"> 
    <td colspan="2"> 
      <form action="" method="post" name="form1" class="maintext">
        <div align="center"> 
          <p class="maintext">Display as <br>
            <input name="display" type="text" class="maintext" value="" size="30">
            <br>
            (this is what it will read as in the document)<br>
            <br>
          </p>
          <p class="maintext">The email address or website address <br>
            <input name="address" type="text" class="maintext" value="" size="30">
            <br>
            (eg. www.echidnaweb.com.au<br>
            or<br>
            info@echidnaweb.com.au)<br>
          </p>
          <p>Select the type of link 
            <select name="type" class="maintext">
              <option value="1" selected>email</option>
              <option value="2">Web site</option>
            </select>
            <br>
            <input type="submit" name="Submit" value="Submit">
            <br>
            <br>
            <br>
            <a href="javascript:close();" class="type1">close</a> </p>
        </div>
      </form>
    </td>
  </tr>
</table>

<?}?>
</body>
</html>