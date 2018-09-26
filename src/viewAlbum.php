<?php
// this file displays a page with the album and product details associated with a specific album id. It is called when a user clicks on an album when browsing the store, currently linked as an href on browse.php, randomAlbums.php, searchResults.php. It uses the getAlbumDetails functions from the db_functions.php file.  
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';

$error_message = '';

$album_id = filter_input(INPUT_GET, 'album', FILTER_VALIDATE_INT);

if (isset($album_id)) {
    if ($album_id === false) {
        $error_message .= 'invalid album.';
    } else {
        $_SESSION['album_id'] = $album_id;
    }
} else {
    if (isset($_SESSION['album_id'])) {
        $album_id = $_SESSION['album_id'];
    } else {
        $_SESSION['album_id'] = 1;
    }
}

$albumDetails = getAlbumDetails($album_id);
foreach ($albumDetails as $current) { ?>
    <a class="db center mw5 tc black link dim pa3">
        <img class="db ba b--black-10" src="album_art/400x400/<?php echo $current['album_image']; ?>.jpg"/>
        <dl class="mt2 f6 lh-copy">
            <dt class="clip">Title</dt>
            <dd class="ml0 fw9"><?php echo ucfirst($current['album_name']); ?></dd>
            <dt class="clip">Artist</dt>
            <dd class="ml0 gray"><?php echo ucfirst($current['album_artist']); ?></dd>
            <dd class="ml0 gray truncate w-100"><?php echo $current['album_year']; ?></dd>
        </dl>
        <hr>
    </a>
<?php } ?>
<div class="pa4">
    <div class="overflow-auto">
        <table class="f6 w-80 mw8 center" cellspacing="0">
            <thead>
            <tr>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Format</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Condition</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Price</th>
                <th class="w-20 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Quantity</th>
                <th class="w-20 fw6 bb b--black-20 tl pb3 pr3 bg-light-red avenir white">Add to Cart</th>
            </tr>
            </thead>
            <tbody class="lh-copy">
            <?php
            $inventoryRecords = getProductInventory($album_id);
            foreach ($inventoryRecords as $current) { ?>
                <tr class="striped--near-white">
                    <td class="pv3 pr3 bb b--black-20"><?php echo ucfirst($current['format_type']); ?></td>
                    <td class="pv3 pr3 bb b--black-20"><?php echo ucfirst($current['condition_quality']); ?></td>
                    <td class="pv3 pr3 bb b--black-20"><?php echo "$" . $current['price']; ?></td>
                    <form action="addItem.php" method="get">
                        <td class="pv3 pr3 bb b--black-20">
                            <input type="hidden" name="id" value="<?php echo $current['product_id']; ?>">
                            <input class="w-40 b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib"
                                   type="number" min="1" value="1" name="quantity">
                        </td>
                        <td>
                            <?php if (!isset($_SESSION['user_id'])) {
                                print('Please sign in to shop');
                            } else { ?>
                            <input class="link grow ph1  dib light-red avenir" type="submit"
                                   value="Add Item">
                        </td>
                        <?php } ?>
                    </form>


                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require 'view/footer.php'; ?>
