<?php
include("../common_db.php");
linkme();
session_start();
$user_section_id = 3;
require_once("./security.php");
check_access($user_section_id);


	require_once('./spaw/spaw_control.class.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="admin_stylesheet.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
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
                      <td><a href="index.php" class="type1">Administration Home</a> | <a href="newsletter_home.php" class="type1">Newsletters</a> | <a class="type1">Edit</a></td>
                    </tr>
                </table></td>
              </tr>
              <tr> 
                <td valign="top" class="whitetext"><form name="form1" method="post" action="">
                    <table width="100%" border="0" cellpadding="5">
                      <tr bgcolor="#EE007B"> 
                        <td colspan="2"> 
<p align="left" ><strong><font color="#FFFFFF">Newletters Administration - Edit</font></strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td width="7%"> <p align="left" ><strong>Date</strong> 
                          </p></td>
                        <td width="93%"> <p align="left" > 
                            <select name="select" size="1">
                              <option selected>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>
                              <option>10</option>
                              <option>11</option>
                              <option>12</option>
                              <option>13</option>
                              <option>14</option>
                              <option>15</option>
                              <option>16</option>
                              <option>17</option>
                              <option>18</option>
                              <option>19</option>
                              <option>20</option>
                              <option>21</option>
                              <option>22</option>
                              <option>23</option>
                              <option>24</option>
                              <option>25</option>
                              <option>26</option>
                              <option>27</option>
                              <option>28</option>
                              <option>29</option>
                              <option>30</option>
                              <option>31</option>
                            </select>
                            <select name="select" size="1">
                              <option selected>January</option>
                              <option>February</option>
                              <option>March</option>
                              <option>April</option>
                              <option>May</option>
                              <option>June</option>
                              <option>July</option>
                              <option>August</option>
                              <option>September</option>
                              <option>October</option>
                              <option>November</option>
                              <option>December</option>
                            </select>
                            <select name="select">
                              <option selected>2004</option>
                              <option>2003</option>
                              <option>2002</option>
                            </select>
                          </p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td><p><strong>Title</strong></p></td>
                        <td><input name="textfield" type="text" size="60"></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td valign="top"> <p><strong>Content</strong></p></td>
                        <td>
						<?php
							// get contents of a file into a string 
							$filename = "../newsletter/vol1iss3.php"; 
							$handle = fopen ($filename, "r"); 
							$contents = fread ($handle, filesize ($filename)); 
							fclose ($handle); 

							$sw = new SPAW_Wysiwyg('spaw' /*name*/,$contents /*value*/, 'en' /*language*/, 'default' /*toolbar mode*/, 'default' /*theme*/, '100%' /*width*/, '600px' /*height*/, '', $spaw_dropdown_data /*Drop Down Data*/);
							$sw->show();
						?>
						</td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td>&nbsp;</td>
                        <td><input name="Submit" type="submit" onClick="MM_goToURL('parent','newsletter_home.php');return document.MM_returnValue" value="Update"> 
                        </td>
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
