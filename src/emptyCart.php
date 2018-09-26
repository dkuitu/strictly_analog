<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';

emptyCart($_SESSION['user_id']);
?>
    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Your cart is Empty</h2>
    </div>
<?php
require 'cart.php';