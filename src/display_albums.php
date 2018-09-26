<?php
session_start();

require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';
?>

<?php
// Get Names from DB
$albums = getAllAlbums(); ?>

<div class="pa4">
    <div class="overflow-auto">

        <table class="f6 w-100 mw8 center" cellspacing="0">
            <thead>
            <tr>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-white">Album Art</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-white">Album Name</th>
                <th class="fw6 bb b--black-20 tl pb3 pr3 bg-white">Album Artist</th>
            </tr>
            </thead>
            <tbody class="lh-copy">
            <!-- use foreach loop to fetch contents of each row -->
            <?php foreach ($albums as $album) { ?>
                <tr class="striped--near-white">
                    <td class="pv3 pr3 bb b--black-20">
                        <img src="album_art/thumbs/<?php echo $album['album_image']; ?>.jpg"></td>
                    <td class="pv3 pr3 bb b--black-20"><?php echo $album['album_name']; ?></td>
                    <td class="pv3 pr3 bb b--black-20"><?php echo $album['album_artist']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'view/footer.php' ?>
