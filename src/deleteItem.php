<?php

//this file deletes an item from a customer's cart, and is called when a user clicks the delete button from the cart.php component.
//it calls the deleteItem function from db_functions.php and passes the user_id and product_id as parameters

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';


$error_message = '';

$product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (isset($product_id)) {
    if ($product_id === false) {
        $error_message .= 'invalid product_id.';
    } else {
        $_SESSION['product_id'] = $product_id;
    }
} else {
    if (isset($_SESSION['product_id'])) {
        $product_id = $_SESSION['product_id'];
    } else {
        $_SESSION['product_id'] = 1;
    }
}

$confirm = deleteItem($_SESSION['user_id'], $product_id);

if ($confirm == 1) {
    ?>
    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Item removed</h2>
    </div>


    <?php
} else { ?>
    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Something went wrong please try again.</h2>
    </div>
<?php }
require 'cart.php';
require 'view/footer.php';
?>