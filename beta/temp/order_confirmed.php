<?php
session_start();
include("useractions.php");
include("vieworderlist.php");


if($_REQUEST["custom"] != ''){
	$id = $_REQUEST["custom"];
}
else
{
	$id = $_GET["orderid"];
}
if($id==false){
	header("location:/temp/products_home.php");
	exit;
}

linkme();

if($_REQUEST['payment_status'] == 'Completed')
{
	$query = "UPDATE orders SET status='payment arrived' WHERE id=".$id;
	$result = mysql_query($query);
}
include("header.php");
?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                  </table>
<?php
include("footer.php");
// we're done - delete the sess id from the order.
deleteOrderId($id);
killSession();
?>