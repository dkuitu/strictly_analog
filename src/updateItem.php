<?php
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

$confirm = updateItem($_SESSION['user_id'], $quantity, $product_id);

if ($confirm == 1) {
    ?>

    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Quantity updated</h2>
    </div>

    <?php
} else { ?>

    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Something went wrong please try again</h2>
    </div>

<?php }
require 'cart.php';
require 'view/footer.php';
?>