<a href="index.php?controller=order&action=flushOrder" class="pure-button pure-button-primary">Clear Orders</a>

<?php
if (is_array($this->order)):
    $order = $this->order;
    ?>
    <table class="pure-table pure-table-bordered" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Items</th>
                <th>Price</th>
                <th>Weight</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item): ?>
                <tr>
                    <td><?php echo $item->id; ?></td>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->price; ?></td>
                    <td><?php echo $item->weight; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <br/>
    Total : $ <?php echo $order['totalPrice']; ?>
    <?php
endif;
?>

<h2>Package distribution</h2>
<?php debug::r($this->packageList); ?>



