<!-- this file displays a cart component, with details on all products held in the customer's cart
It is used in addItem.php, deleteItem.php, emptyCart.php, and viewCart.php
it calls the displayCart function and cartSums function from db_functions.php -->
<div class="pa4">
    <div class="overflow-auto">
        <table class="f6 w-100 mw8 center" cellspacing="0">
            <thead>
            <tr>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Cover</th>
                <th class="w-30 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Album</th>
                <th class="w-30 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Artist</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Format</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Condition</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Price</th>
                <th class="w-30 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Quantity</th>
                <th class="w-10 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Update Quantity</th>
                <th class="w-10 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white"> Remove Album</th>
                <th class="w-10 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Total</th>
            </tr>
            </thead>
            <tbody class="lh-copy">
            <?php
            $cartContents = displayCart($_SESSION['user_id']);
            foreach ($cartContents as $current) { ?>
                <tr class="striped--near-white">
                    <td class="pv3 pr3 bb b--black-20"><img alt="#" class="w-100 grow db outline black-10"
                                                            src="album_art/thumbs/<?php echo $current['album_image']; ?>.jpg">
                    </td>
                    <td class="fw3 pv3 pr3 bb b--black-20 avenir"><?php echo ucfirst($current['album_name']); ?></td>
                    <td class="fw3 pv3 pr3 bb b--black-20 avenir"><?php echo ucfirst($current['album_artist']); ?></td>
                    <td class="fw3 pv3 pr3 bb b--black-20 avenir"><?php echo ucfirst($current['format_type']); ?></td>
                    <td class="fw3 pv3 pr3 bb b--black-20 avenir"><?php echo ucfirst($current['condition_quality']); ?></td>
                    <td class="fw3 pv3 pr3 bb b--black-20 avenir"><?php echo "$" . $current['price']; ?></td>
                    <form action="updateItem.php" method="get">
                        <td class="fw3 pv3 pr3 bb b--black-20">
                            <input type="hidden" name="id" value="<?php echo $current['product_id']; ?>">
                            <input class="w-40 b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib"
                                   type="number" min="1" value="<?php echo $current['product_qty']; ?>" name="quantity">
                        </td>
                        <td class="fw6 pv3 pr3 bb b--black-20"><input class="link grow ph1  dib light-red avenir"
                                                                      type="submit" value="Update">
                        </td>
                    </form>
                    <form action="deleteItem.php" method="get">
                        <td class="fw6 pv3 pr3 bb b--black-20">
                            <input type="hidden" name="id" value="<?php echo $current['product_id']; ?>">
                            <input class="link grow ph1  dib light-red avenir" type="submit" value="Remove">
                        </td>
                    </form>
                    <td class="fw6 pv3 pr3 bb b--black-20"><?php echo "$" . $current['product_subtotal']; ?></td>
                </tr>
            <?php }
            $cartTotals = cartSums($_SESSION['user_id']);
            foreach ($cartTotals as $current) ?>
            <tr class="striped--near-white">
                <td class="tc avenir fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white" colspan="10">Your
                    subtotal:
                    <?php if ($current['cart_subtotal'] == 0) {
                        echo '$0';
                    } else {
                        echo "$ " . $current['cart_subtotal'];
                    } ?>
                </td>
            </tr>
            <tr>
                <td class="tc avenir fw6 bb b--black-20 tl pb3 pr3 bg-red avenir white" colspan="10">Your total with
                    tax:
                    <?php if ($current['cart_total'] == 0) {
                        echo '$0';
                    } else {
                        echo "$ " . $current['cart_total'];
                    } ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="flex items-center justify-center pa1 bg-gold">
    <a class="f5 fw9 ttu ph3 pv2 mb2 dib tracked lh-title mt0 mb3 avenir link blue grow" href="emptyCart.php">Empty
        Cart</a>
    <a class="f5 fw9 ttu ph3 pv2 mb2 dib tracked lh-title mt0 mb3 avenir link green grow" href="store.php">Continue
        Shopping</a>
    <?php require_once('./config.php'); ?>

    <form action="charge.php" method="post">
        <input hidden name="amount" value="<?= $current['cart_total'] * 100; ?>">
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $stripe['publishable_key']; ?>"
                data-description="Strictly Analog - Purchase"
                data-amount="<?= $current['cart_total'] * 100; ?>"
                data-locale="auto"
                data-currency="cad"></script>
    </form>
</div>