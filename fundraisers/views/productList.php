<form action="index.php?controller=order&action=order" method="post">
    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Weight</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
            foreach ($this->productList as $product):
                ?>
                <tr>
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->price; ?></td>
                    <td><?php echo $product->weight; ?></td>
                    <td><input type="checkbox" name="item[]" value="<?php echo $product->id; ?>"/></td>
                </tr>
                <?php
            endforeach;
            ?>

        </tbody>
    </table>
    <br/>
    <input type="hidden" name="token" value="<?php echo $this->token; ?>"/>
    <input type="submit" value="Place Order" class="pure-button pure-button-primary"/>
</form>