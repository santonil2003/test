<?

if(!isset($useractions)){
include("useractions.php");
}


if(isset($securesite) && $securesite == true){
$id = $_POST["orderid"];
}else{
$id = checkOrderId(false);
}

$bgcolor = "#5b7fbb";
?>
<table width="137px" border="0" cellpadding="0" cellspacing="0">
    <tr bgcolor="<?= $bgcolor; ?>" > 
        <td bgcolor="<?= $bgcolor; ?>" ><img src="images/shopping/spacer_trans.gif" width="10" height="20"></td>
        <td rowspan="2" bgcolor="<?= $bgcolor; ?>" ><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
    </tr>
    <tr bgcolor="<?= $bgcolor; ?>" > 
        <td class="maintext" bgcolor="<?= $bgcolor; ?>" ><div align="center"> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <?
                    $runningtotal=0;
                    if($id!=false){
                    ?>
                    <tr> 
                        <td><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr>
                        <td align=center class="shoppingCartText" >Order ID: <?= $id + 1000 ?></td>
                    </tr>
                    <?



                    $query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
                    $result = mysql_query($query);
                    if(!$result) error_message(sql_error());
                    if(mysql_num_rows($result)>0){
                    while($qdata = mysql_fetch_array($result)){
                    ?>
                    <tr> 
                        <td><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                        <td> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                    <td width="10" class="maintext"><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                                    <td width="740" class="maintext"> 
                                        <div align="left"><img src="images/shopping/seperator_black_line.gif" width="100%" height="1"></div></td>
                                </tr>
                            </table>
                            <div align="center"></div></td>
                    </tr>
                    <tr> 
                        <td><div align="center"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr> 
                                        <td width="10" rowspan="3" class="maintext"><img src="images/shopping/spacer_trans.gif" width="13" height="10"></td>
                                        <td class="shoppingCartText"> 
                                            <div align="left"><strong>
                                                    <?
                                                    echo getLabelType($qdata["type"]);
                                                    ?>
                                                </strong></div></td>
                                    </tr>
                                    <tr> 
                                        <td class="shoppingCartText"> 
                                            <div align="left"><? echo $qdata["quantdesc"];?></div></td>
                                    </tr>
                                </table>
                            </div></td>
                    </tr>
                    <?
                    $runningtotal += $qdata["price"];
                    }?>
                    <tr> 
                        <td><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                        <td> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                    <td width="10" class="maintext"><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                                    <td width="740" class="maintext"> 
                                        <div align="left"><img src="images/shopping/seperator_black_line.gif" width="100%" height="1"></div></td>
                                </tr>
                            </table>
                            <div align="center"></div></td>
                    </tr>
                    <tr> 
                        <td><div align="center"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="10" class="maintext"><img src="images/shopping/spacer_trans.gif" width="13" height="10"></td>
                                        <td class="shoppingCartText"> <div align="left"><strong>TOTAL:</strong></div></td>
                                        <td class="shoppingCartText"><div align="right"><strong><? echo $cur['symbol'].toDollarsAndCents($runningtotal);?></strong></div></td>
                                    </tr>
                                </table>
                            </div></td>
                    </tr>
                    <?
                    }
                    }
                    if($id==false || mysql_num_rows($result)==0 ){?>
                    <tr> 
                        <td><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                        <td class="shoppingCartText"><div align="center">No items yet!</div></td>
                    </tr>
                    <tr> 
                        <td><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr> 
                        <td align="center"><img src="images/shopping/image_noorder_boy.gif" width="75" height="95"></td>
                    </tr>
                    <? }?>
                </table>
            </div></td>
    </tr>
    <tr bgcolor="<?= $bgcolor; ?>" > 
        <td bgcolor="<?= $bgcolor; ?>" ><img src="images/shopping/spacer_trans.gif" width="10" height="20"></td>
        <td bgcolor="<?= $bgcolor; ?>" >&nbsp;</td>
    </tr>
    <tr bgcolor="<?= $bgcolor; ?>" > 
        <td bgcolor="<?= $bgcolor; ?>" ><div align="center">
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                        <td width="10" class="maintext"><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                        <td class="maintext"> 
                            <div align="center"><a href="my_order.php"><img src="images/shopping/button_view_order.gif" alt="View Order" name="view_order" width="81" height="22" border="0"></a></div></td>
                    </tr>
                    <tr> 
                        <td width="10" class="maintext"><img src="images/shopping/spacer_trans.gif" width="10" height="10"></td>
                        <td class="maintext"> 
                            <br>
                            <div align="center">
                                <form action="order_form_ps.php" method="post" name="toorderform">
							<input type="hidden" value="<?php echo $id;?>" name="orderid">
							<input type="hidden" value="" name="postageamount">
                                                        <input type="submit" value="Pay Now" name="submit" class="round-bottom"/>
				</form>
                            </div></td>
                    </tr>
                </table>

            </div></td>
        <td bgcolor="<?= $bgcolor; ?>">&nbsp;</td>
    </tr>
    <tr bgcolor="<?= $bgcolor; ?>" > 
        <td bgcolor="<?= $bgcolor; ?>" ><img src="images/shopping/spacer_trans.gif" width="10" height="20"></td>
        <td bgcolor="<?= $bgcolor; ?>" >&nbsp;</td>
    </tr>
    <tr height="6"> 
        <td colspan="2" height="6">
            <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0"> 
                <tr>
                    <td align="left" width="6" height="6" ><img src="images/shopping/bot_left.gif" width="6" height="6"></td>
                    <td bgcolor="<?= $bgcolor; ?>" ><img src="images/shopping/spacer_trans.gif" width="1" height="6"></td>
                    <td align="right" width="6" height="6" ><img src="images/shopping/bot_right.gif" width="6" height="6"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>