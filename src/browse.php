<?php

// this file displays all albums in data base, plus a record of holdings of products associated with each album. 
//It is displayed when a user clicks the "browse" button in the store.php page. 
//It calls the browseAllAlbums functions from db_functions.php, and passes an orderBy variable for the query. 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';
?>

    <div class="flex items-center justify-center bg-gold pa3">
        <div class="nowrap overflow">
            <a class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Sort collection by: </a>
            <a class="avenir link grow white f5 f4-ns dib mr3 hover-light-red" href="?order=album_artist"
               title="Alphabetically by Artist">Artist</a>
            <a class="avenir link grow white f5 f4-ns dib mr3 hover-blue" href="?order=album_name"
               title="Alphabetically by Album">Album</a>
            <a class="avenir link grow white f5 f4-ns dib mr3 hover-green" href="?order=album_year"
               title="Ascending by Year">Year</a>
        </div>
    </div>
<?php
$error_message = '';

$orderBy = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($orderBy)) {
    if ($orderBy === false) {
        $error_message .= 'invalid ordering.';
    } else {
        $_SESSION['orderBy'] = $orderBy;
    }
} else {
    if (isset($_SESSION['orderBy'])) {
        $orderBy = $_SESSION['orderBy'];
    } else {
        $_SESSION['orderBy'] = 'album_artist';
        $orderBy = $_SESSION['orderBy'];
    }
}

$allAlbums = browseAllAlbums($orderBy); ?>
    <div class="cf pa2">
        <?php foreach ($allAlbums as $album) { ?>
            <div class="fl w-50 w-25-m w-20-l pa2">
                <a class="db link tc" href="viewAlbum.php?album=<?php echo $album['album_id']; ?>">
                    <img alt="#"
                         class="w-100 grow db outline black-10"
                         src="album_art/400x400/<?php echo $album['album_image']; ?>.jpg">
                    <dl class="mt2 f6 lh-copy">
                        <dt class="clip">Title</dt>
                        <dd class="ml0 black truncate w-100"><?php echo $album['album_name']; ?></dd>
                        <dt class="clip">Artist</dt>
                        <dd class="ml0 gray truncate w-100"><?php echo $album['album_artist']; ?></dd>
                    </dl>
                </a>
            </div>
        <?php } ?>
    </div>
<?php require 'view/footer.php' ?>