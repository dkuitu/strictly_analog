<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';
require 'search.php';
$error_message = '';

$artist = filter_input(INPUT_GET, 'artist', FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($artist)) {
    if ($artist === false) {
        $error_message .= 'invalid artist.';
    } else {
        $_SESSION['artist'] = $artist;
    }
} else {
    if (isset($_SESSION['artist'])) {
        $artist = $_SESSION['artist'];
    } else {
        $_SESSION['artist'] = '';
        $artist = $_SESSION['artist'];
    }
}

$album = filter_input(INPUT_GET, 'album', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($album)) {
    if ($album === false) {
        $error_message .= 'invalid album.';
    } else {
        $_SESSION['album'] = $album;
    }
} else {
    if (isset($_SESSION['album'])) {
        $album = $_SESSION['album'];
    } else {
        $_SESSION['album'] = '';
        $album = $_SESSION['album'];
    }
}

$searchResults = customSearch($artist, $album);

if (count($searchResults) == 0) { ?>
    <div class="flex items-center justify-center bg-light-red white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Sorry, we don't have
            <i>"<?php echo $artist . " " . $album . " " ?>"</i>in stock</h2>
    </div>

<?php } else { ?>

    <div class="flex items-center justify-center bg-light-red white pa1">
        <h2 class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Results for:
            <i><?php echo $artist . " " . $album ?></i>
    </div>
    <?php
    ?>

    <div class="cf pa2">
        <?php foreach ($searchResults as $current) { ?>
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

<?php }

require 'view/footer.php'; ?>