<?php

//this file displays the web page that is linked to from the nav element in view/header.php. It checks if a user is logged into the site, and if so will display the cart.php file. 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';

if (!isset($_SESSION['user_id'])) {
    ?>
    <div class="flex items-center justify-center bg-yellow blue pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir"> Please sign in to see your cart.</h2></div>
    </div>
<?php } else { ?>
    <div class="flex items-center justify-center bg-gold white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir"> Let's see what you found...</h2>
    </div>

    <?php require 'cart.php';
}
require 'view/footer.php';
?>