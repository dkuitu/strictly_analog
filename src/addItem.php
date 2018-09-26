<?php

// this file displays a page with the cart.php element, and adds an album to the user's cart. 
//It is loaded when a user clicks the "add to cart" button from the viewAlbum.php file. 
//It calls the addItem function from the db_functions.php file,and passes it the product id, quantity, and user ID as parameters 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';


$error_message = '';

$quantity = filter_input(INPUT_GET, 'quantity', FILTER_VALIDATE_INT);

if (isset($quantity)) {
    if ($quantity === false) {
        $error_message .= 'invalid quantity.';
    } else {
        $_SESSION['quantity'] = $quantity;
    }
} else {
    if (isset($_SESSION['quantity'])) {
        $quantity = $_SESSION['quantity'];
    } else {
        $_SESSION['quantity'] = 1;
    }
}

$prod_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (isset($prod_id)) {
    if ($prod_id === false) {
        $error_message .= 'invalid id.';
    } else {
        $_SESSION['id'] = $prod_id;
    }
} else {
    if (isset($_SESSION['id'])) {
        $prod_id = $_SESSION['id'];
    }
}

$confirm = addItem($_SESSION['user_id'], $prod_id, $quantity);
if ($confirm == 1) { ?>
    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Nice Choice! You may also enjoy these albums:</h2>
    </div>

    <?php $suggestedItems = suggestedItems($prod_id); ?>
    <div class="cf pa1 center">
        <?php foreach ($suggestedItems as $current) { ?>
            <div class="fl w-30 w-10-m w-10-l pa1 tc">
                <a class="db link grow " href="viewAlbum.php?album=<?php echo $current['album_id']; ?>">
                    <img class="db ba b--black-10" src="album_art/400x400/<?php echo $current['album_image']; ?>.jpg"/>
                    <dl class="f7">
                        <dd class=" ml0 grey"><?php echo $current['album_artist']; ?></dd>
                    </dl>
                </a>
            </div>
        <?php } ?>
    </div>

<?php } else { ?>
    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Something went wrong, please retry</h2>
    </div> <?php }

require 'cart.php';
require 'view/footer.php';
?>