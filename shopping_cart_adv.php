<?php
if (!isset($useractions)) {
    include("useractions.php");
}


if (isset($securesite) && $securesite == true) {
    $id = $_POST["orderid"];
} else {
    $id = checkOrderId(false);
}

$bgcolor = "#5b7fbb";
?>
<script>
    $('document').ready(function() {
        var cart_open = false;
        $('.cart-title').click(function() {

            if (cart_open) {
                $('.cart-arrow').attr('src', 'css/images/right.png');
                cart_open = false;
            } else {
                $('.cart-arrow').attr('src', 'css/images/down.png');
                cart_open = true;
            }


            $('.cart-body').slideToggle('fast');
        });
    });
</script>
<?php
if($id){
    $query = "SELECT * FROM basket_items WHERE ordernumber=" . $id;
    $result = mysql_query($query);
    if (!$result) {
        error_message(sql_error());
    }
} else {
    $id = false;
}
?>
<ul class="cart">
    <li class="cart-title">
        <table border="0" width="100%">
            <tr>
                <td align="left" valign="middle"><span class="sp-left"><img src="css/images/scart.png" height="28px"/></span></td>
                <td align="center" valign="middle"><strong style="font-size:10px;">My Order (<?php echo mysql_num_rows($result); ?>)</strong></td>
                <td align="right" valign="middle">
                    <span class="sp-right">
                        <img src="css/images/right.png" class="cart-arrow"/>
                    </span>
                </td>
            </tr>
        </table>


    </li>
    <li style="display:none;" class="cart-body">
        <table border="0" cellpadding="0" cellspacing="0">
            <?php
            $runningtotal = 0;
            if ($id != false) {
                ?>
                <tr>
                    <td colspan="2" class="hr-solid-top"><strong> Order ID: <?= $id + 1000 ?></strong></td>
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
                    <?php
                }
            }
            if ($id == false || mysql_num_rows($result) == 0) {
                ?>
                <tr>
                    <td colspan="2"> <strong> No items on Cart</strong></td>
                </tr>
                <?php
            }
             if (mysql_num_rows($result) > 0) {
            ?>
            <tr>
                <td colspan="2" align="center">
                    <form action="order_form_ps.php" method="post" name="toorderform">
                        <input type="hidden" value="<?php echo $id; ?>" name="orderid">
                        <input type="hidden" value="" name="postageamount">
                        <input type="submit" value="Checkout" name="submit" class="round-bottom"/>
                    </form>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </li>
</ul>
