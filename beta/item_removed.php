<?
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Item Removed</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_view_order_long_mo.gif','images/button_viewproducts_long_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="740" valign="top"> 
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
          <td width="418" valign="top" bgcolor="#6FFF6F"> 
            <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304" bgcolor="5d7eb9"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="418" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_view_order.gif" alt="View Order" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top" bgcolor="#66FF66"> 
                <td colspan="3" bgcolor="#6FFF6F"> 
                  <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="393" valign="top" bgcolor="#FFFFFF"> 
                        <table width="393" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="97%">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%"><h1><span class="headings"> 
                                    The item has been removed from your order...
                                      
                                    </td>
                                </tr>
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td class="headings">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                      </td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="47%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back" name="back" width="94" height="22" border="0"></a></td>
                            <td width="5%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="10%"><a href="view_order.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image20','','images/button_view_order_long_mo.gif',1)"><img src="images/button_view_order_long.gif" alt="View Order" name="Image20" width="94" height="22" border="0"></a></td>
                            <td width="5%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="33%"><a href="products_home.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image21','','images/button_viewproducts_long_mo.gif',1)"><img src="images/button_viewproducts_long.gif" alt="View Products" name="Image21" width="100" height="22" border="0"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="FF9900"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top"> 
                        <?php include("navigation.php"); ?>
                      </td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php" ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </td>
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
