<?php

$usedNumbers = array();
$curr = 0;
?>
<div class="cf pa2">
    <?php
    while ($curr < 10) {
        $nextInt = rand(1, 60);
        while (in_array($nextInt, $usedNumbers)) {
            $nextInt = rand(1, 60);
        }
        array_push($usedNumbers, $nextInt);
        $nextAlbum = getRandomAlbums($nextInt);
        foreach ($nextAlbum as $album) { ?>
            <div class="fl w-50 w-25-m w-20-l pa2">
                <a class="db link tc" href="viewAlbum.php?album=<?php echo $album['album_id']; ?>">
                    <img
                            alt="<?php echo ucfirst($album['album_name']); ?>" class="w-100 grow db outline black-10"
                            src="album_art/400x400/<?php echo $album['album_image']; ?>.jpg">
                    <dl class="mt2 f6 lh-copy">
                        <dt class="clip">Title</dt>
                        <dd class="ml0 black truncate w-100"><?php echo ucfirst($album['album_name']); ?></dd>
                        <dt class="clip">Artist</dt>
                        <dd class="ml0 gray truncate w-100"><?php echo ucfirst($album['album_artist']); ?></dd>
                    </dl>
                </a>
            </div>
        <?php }
        $curr += 1;
    } ?>
</div>