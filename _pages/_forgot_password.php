<?php
$mode =  $_GET['mode'];

if($mode=='member')
{
?>
  <tr> 
    <td height="100%" colspan="2" valign="top" > <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="149" rowspan="3" valign="top"><?php include("testimonials_include.php"); ?></td>
          <td rowspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="20">
			<tr>
                <td><h1>Forgotten Password</h1>
                  <p>As many STeP Members do not have email addresses we cannot email passwords directly to you. Instead please contact 
                    STeP to be told your password</p>
                  <p><a href="index.php?page=22">Contact Us</a></p>
                  </td>
              </tr>
            </table></td>
<? } elseif($mode=='admin') { ?>
  <tr> 
    <td height="100%" colspan="2" valign="top" > <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="149" rowspan="3" valign="top"><?php include("testimonials_include.php"); ?></td>
          <td rowspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="20">
			<tr>
                <td><h1>Forgotten Password</h1>
                  <p>Please enter your Agency Number below. Your password will be emailed to the administrator's email account for that agency:</p><form action="index.php?page=f20&mode=mailed" method="get" name="forgotPwd"><input name="form_action" type="hidden" value="MailForgottenPassword"><input name="id" type="text"><input name="submit" type="submit" value="Submit"></form>
                  <p><a href="index.php?page=22">Contact Us</a></p>
                  </td>
              </tr>
            </table></td>
<? } elseif($mode=='mailed') { ?>
  <tr> 
    <td height="100%" colspan="2" valign="top" > <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="149" rowspan="3" valign="top"><?php include("testimonials_include.php"); ?></td>
          <td rowspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="20">
			<tr>
                <td><h1>Forgotten Password</h1>
                  <p>Your password has been emailed. If you have any further problems or questions please <a href="index.php?page=22">contact us</a></p>
                  </td>
              </tr>
            </table></td>
<? } ?>