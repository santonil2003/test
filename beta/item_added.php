<?
require_once("debug_log.php");

include('header.php'); 

$id = checkOrderId(false);
$order_id = $id+1000;
debug_log_add("item_added.php", "Order ID: " . $order_id);

?>
 <table width="898" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="50" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/gen/spacer.gif" width="50" height="10"></td>
                      <td width="798" valign="top" bgcolor="#FFFFFF"> 
                        <table width="798" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="97%">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="4%"><img src="images/gen/spacer.gif" width="25" height="10"></td>
                                  <td width="96%"><h1><span class="headings">The item has 
                                    been added to your order... </span></h1></td>
                                </tr>
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td class="headings">&nbsp;</td>
                                </tr>
																<tr>
																	<td>&nbsp;</td>
																	<td class=maintext>Your Order ID is <?=$id+1000?></td>
																</tr>
                                <tr> 
                                  <td colspan=2>&nbsp;</td>
                                </tr>

                              </table></td>
                          </tr>
                        </table>
                      </td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/gen/spacer.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/gen/spacer.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF" align="center" >
                        <table width="198" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="47%"><a href="javascript:history.go(-1)" ><img src="images/nav/n_back.gif" alt="Back" name="back" width="58" height="22" border="0"></a></td>
                            <td width="5%"><img src="images/gen/spacer.gif" width="5" height="10"></td>
                            <td width="10%"><a href="<?php print SITE_URL; ?>my_order.php" ><img src="images/shopping/button_view_order.gif" alt="View My Order" name="Image20" width="81" height="22" border="0"></a></td>
                            <td width="5%"><img src="images/gen/spacer.gif" width="5" height="10"></td>
                            <td width="33%"><a href="<?php print SITE_URL; ?>Products" ><img src="images/nav/n_buy_more.gif" alt="Buy/View more products" name="Image24" width="83" height="22" border="0"></a></td>
                            <td width="33%"><img src="images/gen/spacer.gif" width="5" height="10"></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/gen/spacer.gif" width="50" height="10"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
                <? include('footer.php') ?>