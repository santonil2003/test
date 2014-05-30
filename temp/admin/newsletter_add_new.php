<?

include("../common_db.php");
linkme();
session_start();
$user_section_id = 3;
require_once("./security.php");
check_access($user_section_id);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi%20kid.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body topmargin="0">
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
  <tr>
    <td valign="top">
<table cellpadding="0" cellspacing="0" border="0">
        <tr bgcolor="#FFFFFF"> 
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr> 
          <td class="maintext"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td valign="top" class="maintext"> <form name="form1" method="post" action="">
              <table width="100%" height="100%" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="1%" rowspan="49" valign="top"><img src="../images/spacer_trans.gif" width="20" height="20"></td>
                  <td valign="top" class="maintext"><p><a href="admin_home_new.php" class="type1">Administration 
                      home</a> - <a href="javascript:;" class="type1" onClick="MM_openBrWindow('character_insert.html','','width=420,height=430')">Click 
                      here to format text</a></p>
                    <p><strong>Welcome to Add New Newsletter. </strong><br>
                      <br>
                      Please enter the text into the box provided and upload your 
                      picture, with the dimensions of either 100x130 or 130x100. 
                      <br>
                      You must upload the image before you submit the newsletter 
                      otherwise the image will be left out.</p></td>
                </tr>
                <tr> 
                  <td valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td width="100%" valign="top" class="maintext"> 
                    <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td width="19%" class="maintext">&nbsp;</td>
                        <td width="81%" class="maintext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td class="maintext">Date Of Newsleter</td>
                        <td class="maintext"><input name="textfield" type="text" class="ordertext" size="30">
                          (eg. 1st January 2004)</td>
                      </tr>
                      <tr> 
                        <td class="maintext">&nbsp;</td>
                        <td class="maintext">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td class="maintext">Volume &amp; Issue</td>
                        <td class="maintext"><input name="textfield" type="text" class="ordertext" size="30">
                          (eg. Volume 1 Issue 1)</td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 1</strong></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr>
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit58" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 2</strong></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea2" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField2" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file2" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit582" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 3</strong></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea3" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField3" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file3" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit583" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 4</strong></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea4" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField4" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file4" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit584" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 5</strong></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea6" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField5" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file6" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit585" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 6</strong></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea7" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField5" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file7" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit586" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 7</strong></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea8" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField5" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file8" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit587" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td><strong>Story 8</strong></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                            <tr> 
                              <td width="48%"><input name="textfield" type="text" class="ordertext" size="71"></td>
                              <td width="52%">Please enter the story title</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="48%"> <textarea name="textarea8" cols="70" rows="8" class="ordertext"></textarea></td>
                              <td width="52%">Please copy and paste the text of 
                                your story into the box provided.</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                            <tr valign="top"> 
                              <td width="15%"> <input name="imageField5" type="image" src="../images/newsletter_home_page.gif" width="100" height="130" border="0"></td>
                              <td width="85%" valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                  <tr> 
                                    <td valign="top">The image file must be (100x130 
                                      pixels or 130x100 pixels).<br>
                                      NB. You must upload the image before you 
                                      submit the newsletter otherwise the image 
                                      will be left out.</td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                                        <tr> 
                                          <td width="37%"><input name="file8" type="file" class="ordertext" size="30"></td>
                                          <td width="63%"><input name="Submit587" type="submit" class="ordertext" value="Upload"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/spacer_trans.gif" width="20" height="10"> 
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><img src="../images/bg_blue_line.gif" width="100%" height="1"></td>
                </tr>
                <tr> 
                  <td valign="top" class="whitetext"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                </tr>
                <tr> 
                  <td valign="top"> <table width="100%" cellpadding="0" cellspacing="0" class="maintext">
                      <tr> 
                        <td width="20%"><input name="Submit6" type="submit" class="ordertext" value="Preview"> 
                          <a href="newsletter_preview.php" class="type1">preview</a></td>
                        <td width="80%"><p>&nbsp;</p></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td valign="top">&nbsp;</td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>

</body>
</html>
