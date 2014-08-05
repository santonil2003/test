<?php
if (!isset($useractions)) {
    include("useractions.php");
}


if (isset($securesite) && $securesite == true) {
    $id = $_POST["orderid"];
} else {
    $id = checkOrderId(false);
}

if ($id) {
    $query = "SELECT * FROM basket_items WHERE ordernumber=" . $id;
    $result = mysql_query($query);
    if (!$result) {
        error_message(sql_error());
    }
} else {
    $id = false;
}
?>
<div class="adv-cart-wrapper" style="display:none;">
    <div class="adv-cart-body">
        <table border="0" cellpadding="0" cellspacing="0" width="140" align="center">
            <?php
            $runningtotal = 0;
            if ($id != false) {
                ?>
                <tr>
                    <td colspan="2" align="center"> <strong> Order ID: <?= $id + 1000 ?></strong></td>
                </tr>
                <?php
                if (mysql_num_rows($result) > 0) {
                    while ($qdata = mysql_fetch_array($result)) {
                        ?>
                        <tr>
                            <td valign="top"> <strong>Title</strong></td>
                            <td>:<em><?php echo getLabelType($qdata["type"]); ?></em></td>
                        </tr>
                        <tr>
                            <td valign="top" class="last"> <strong> Qty</strong></td>
                            <td class="last">:<em><?php echo $qdata["quantdesc"]; ?></em></td>
                        </tr>
                        <?php
                        $runningtotal += $qdata["price"];
                    }
                    ?>
                    <tr>
                        <td valign="top" class="last"> <strong> Total</strong></td>
                        <td class="last">:<strong><?php echo $cur['symbol'] . toDollarsAndCents($runningtotal); ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center">
                            <Br/>
                            <form action="order_form_ps.php" method="post">
                                <input type="hidden" value="<?php echo $id; ?>" name="orderid">
                                <input type="hidden" value="" name="postageamount">
                                <input type="submit" value="Checkout" name="submit" class="round-bottom"/>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="text-align: center;">
                            <a href="Products" class="round-bottom">Continue Ordering</a>
                        </td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td colspan="2" align="center"> <strong> No items on Cart</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="text-align: center;">
                            <a href="Products" class="round-bottom">Start Ordering</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="2" align="center"> <strong> No items on Cart</strong></td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="text-align: center;">
                        <a href="Products" class="round-bottom">Start Ordering</a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2" align="center"></strong></td>
            </tr>
        </table>
    </div>
</div>