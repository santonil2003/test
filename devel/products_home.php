<?
//session_cache_limiter('must-revalidate');
session_start();
//session_destroy();
//unset($_SESSION);
//$_SESSION = array();

/*
$sess1 = session_id();
session_destroy();
$sess2 = session_id();
if (session_id() == ""){
	//session_destroy();
	session_regenerate_id(); // if no active session we start a new one
	session_start();
	$sess3 = session_id();
}

if (!function_exists("session_regenerate_id")) { 
   echo "NO";
} else { 
   echo "YES";
}
*/

	// if currency chosen
	//if(isset($_GET['posted']))
	//{	
		//$chosencurrency = $_POST['thecurrency'];
		//setcookie("currency", $chosencurrency);
		
		// if user tried to goto page without selecting currency first

		
	//}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Childrens Labels</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta name="keywords" content="vinyl labels, iron-on, mini vinyls, shoe label  ">
<meta name="description" content="Our complete range of school & childrens labels. Great vinyl & iron-on labels with bright colours and fonts">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/image_view_poducts_mo.gif')">
<? //echo "<br>1=".$sess1."<br>2=".$sess2."<br>3=".$sess3; ?>
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="index.php"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="6FFF6F">
<table width="418" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_our_products.gif" alt="Our Products" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top" bgcolor="6FFF6F"> 
                <td colspan="3"> 
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="10" rowspan="4" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="397" valign="top" bgcolor="#FFFFFF"><? include("products_include.php"); ?></td>
                      <td width="10" rowspan="4" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td>&nbsp;</td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="33%">&nbsp;</td>
                            <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="63%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back" name="back" width="94" height="22" border="0"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#66FF66"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top">
					 <?php include "navigation.php"; ?>
					  </td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php" ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
