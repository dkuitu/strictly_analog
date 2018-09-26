<?php
//This php File is loads the landing page components: randomAlbums
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';
?>
    <div class="flex items-center justify-center pa2 bg-gold hover-bg-green white ">
        <p class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Music for the aurally inclined</p>
    </div>

<?php
require 'randomAlbums.php';
require 'view/footer.php';