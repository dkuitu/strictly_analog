<!-- This php File is responsible for rendering the search form -->
<?php
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php'
?>

<!--        <fieldset id="genre"
      class="bn">
      <legend class="fw7 mb2">Genre</legend>

      <?php $genres = getGenres();
foreach ($genres as $genre) { ?>
      <div class="flex items-center mb2 fl w-20">
        <input class="mr2"
               type="radio" id="<?php echo $genre['genre_name']; ?>"
               value="<?php echo $genre['genre_name']; ?>"
        >
        <label for="<?php echo $genre['genre_name']; ?>"
               class="lh-copy"><?php echo $genre['genre_name']; ?>
        </label>
      </div>
      <?php } ?>
      </fieldset>

      <fieldset id="condition"
      class="bn">
      <legend class="fw7 mb2">Condition</legend>

      <?php $conditions = getConditions(); ?>
      <?php foreach ($conditions as $condition) { ?>
      <div class="flex items-center mb2 fl w-20">
        <input class="mr2"
               type="radio"
               id="<?php echo $condition['condition_quality']; ?>"
               value="<?php echo $condition['condition_quality']; ?>"
        >
        <label for="<?php echo $condition['condition_quality']; ?>"
               class="lh-copy"><?php echo $condition['condition_quality']; ?>
        </label>
      </div>

      <?php } ?> -->


<div class="dt dt--fixed">
    <div class="dt-row">

        <div class="dtc tc">
            <form action="browse.php" method="get" accept-charset="utf-8">
                <input class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir input-reset link hover-bg-light-red white bg-gold w-100"
                       type="submit" value="Browse">
            </form>
        </div>

        <div class="dtc tc">
            <form action="searchResult.php" method="get" accept-charset="utf-8">
                <input class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir input-reset link hover-bg-blue white bg-gold w-100"
                       type="submit" value="Search">
                <div class="dtc tc">
                    <input class="input-reset ba b--black-20 mb2 db" placeholder="artist search" type="text"
                           name="artist">
                </div>
                <div class="dtc tc">
                    <input class="input-reset ba b--black-20 mb2 db" placeholder="album search" type="text"
                           name="album">
                </div>

            </form>
        </div>

    </div>
</div>
	
  

