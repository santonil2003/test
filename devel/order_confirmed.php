<?
session_start();

include("useractions.php");
include("vieworderlist.php");
$id = $_GET["orderid"];

if($id==false){
	header("location:products_home.php");
	exit;
}

linkme();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - View Order</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="740" valign="top"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="http://www.identikid.com.au/index.php"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au/index.php"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au/index.php"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
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
                            <td colspan="3">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="3"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p>Thanks! 
                                      Your order has been received.</p></td>
                                </tr>
                                <tr> 
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><p>Your invoice 
                                      number is <strong><? echo 1000+$id;?>.</strong></p></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td><img src="images/spacer_trans.gif" width="1" height="10"></td>
                          </tr>
                          <tr> 
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%"><img src="images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="96%" class="maintext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td colspan="3" valign="top" class="maintext">identi 
                                          Kid offices are located:</td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3" valign="top"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                      </tr>
                                      <tr> 
                                        <td width="190" valign="top"> <div class="maintext"><strong> 
                                            NSW<img src="images/spacer_trans.gif" width="10" height="10">OFFICE</strong></div></td>
                                        <td width="10" rowspan="4" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        <td width="165" valign="top"> <div class="maintext"><strong> 
                                            WA<img src="images/spacer_trans.gif" width="10" height="10">OFFICE</strong></div></td>
                                      </tr>
                                      <tr> 
                                        <td valign="top"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                        <td valign="top"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                      </tr>
                                      <tr>
                                        <td valign="top" class="smalltext">PO 
                                          Box 8775</td>
                                        <td valign="top" class="smalltext"> PO 
                                          Box 10 </td>
                                      </tr>
                                      <tr>
                                        <td valign="top" class="smalltext"> WAGGA 
                                          WAGGA NSW 2650</td>
                                        <td valign="top" class="smalltext"> Scarborough 
                                          WA 6922</td>
                                      </tr>
                                      <tr>
                                        <td valign="top" class="smalltext">Australia</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top" class="smalltext">Australia</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="top" colspan="3"> 
                            <td align="right">&nbsp;</td>
                          </tr>
                          <tr valign="top" colspan="3"> 
                            <td align="right"><a href="http://www.identikid.com.au/products_home.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image21','','images/button_viewproducts_long_mo.gif',1)"><img src="images/button_viewproducts_long.gif" alt="View Products" name="Image21" width="100" height="22" border="0"></a></td>
                          </tr>
                        </table>
                      </td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
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
                        <?php
						$secure=true;
						include "navigation.php"; ?>
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

<? 

// we're done - delete the sess id from the order.
deleteOrderId($id);

?>
