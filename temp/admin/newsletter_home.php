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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
<link href="admin_stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><table cellpadding="0" cellspacing="0" border="0">
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
          <td valign="top" class="maintext"> <table width="100%" height="100%" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="99%" height="22" valign="top" class="maintext"><table width="100%" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><a href="index.php" class="type1">Administration Home</a> | <a class="type1">Newsletters</a></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td valign="top" class="whitetext"><form name="form1" method="post" action="">
                    <table width="100%" border="0" cellpadding="5">
                      <tr bgcolor="#EE007B"> 
                        <td colspan="6"> <p><strong><font color="#FFFFFF"> Newsletters
                                 Administration - Newsletters</font></strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td colspan="6"> <div align="left"> 
                            <input name="Submit" type="submit" onClick="MM_goToURL('parent','newsletter_edit.php');return document.MM_returnValue" value="Add New Newsletter">
                          </div></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> 
<p align="left" ><strong><a class="grey"href="#">Date</a></strong> <a class="grey" href="#"><img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></p></td>
                        <td> 
                          <p align="left" ><strong><a class="grey" href="#">Title 
                            <img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                        <td> 
                          <p align="center"><strong><a class="grey" href="#">Active 
                            <img src="images/sort_arrow.gif" alt="Sort" width="10" height="9" border="0"></a></strong></p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td> 
                          <p align="center">&nbsp;</p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p align="left">15 April 2004</p></td>
                        <td> <p>Volume 1 Issue 3</p></td>
                        <td> <p align="center">Yes</p></td>
                        <td><a href="newsletter_edit.php">Edit</a></td>
                        <td><a href="newsletter.php" target="_top">View</a></td>
                        <td> <p><a href='javascript:onClick=alert("Place Your message here... \n Click OK to contine.")'> 
                            </a><a href="#" onClick="MM_popupMsg('Are you sure you want to delete this ?\r\rYes            No\r')">Delete</a></p></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>

</body>
</html>
