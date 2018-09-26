<?php
session_start();
?>
<!DOCTYPE html>
<html class="overflow-y-scroll">
<head>
    <title>Strictly Analog</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="/css/tachyons.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
</head>
<body>
<header>
    <nav class="mw8  bw2 ma3 center mt4">
        <div class="db dtc-l v-mid link dim w-100 w-20-l tc tl-l mb2 mb0-l">
            <a href="index.php" title="Home"><img alt="Strictly Analog" src="/view/StrictlyLogo.png"></a>
        </div>
        <div class="db dtc-l v-mid w-100 w-75-l tc tr-l">
            <?php
            if ($_SERVER['PHP_SELF'] == '/index.php') {
                ?>
                <a class="avenir f5 fw9 link grow light-red dib pa3 ph4-l fw10"
                   href="index.php" title="Home">Home</a>
            <?php } else { ?>
                <a class="avenir f5 fw9 link  bg-animate black-80 hover-light-red dib pa3 ph4-l fw10"
                   href="index.php" title="Home">Home</a>
            <?php }
            if ($_SERVER['PHP_SELF'] == '/store.php' || $_SERVER['PHP_SELF'] == '/viewAlbum.php' || $_SERVER['PHP_SELF'] == '/browse.php' || $_SERVER['PHP_SELF'] == '/searchResult.php') { ?>
                <a class="avenir f5 fw9 link grow green dib pa3 ph4-l fw10"
                   href="store.php" title="Browse our Collection">Store</a>
            <?php } else { ?>
                <a class="avenir f5 fw9 link  bg-animate black-80 hover-green dib pa3 ph4-l fw10"
                   href="store.php" title="Browse our Collection">Store</a>
            <?php }
            if ($_SERVER['PHP_SELF'] == '/about.php') { ?>
                <a class="avenir f5 fw9 link grow blue dib pa3 ph4-l fw10"
                   href="about.php" title="About Strictly Analog">About</a>
            <?php } else { ?>
                <a class="avenir f5 fw9 link  bg-animate black-80 hover-blue dib pa3 ph4-l fw10"
                   href="about.php" title="About Strictly Analog">About</a>
            <?php }
            if ($_SERVER['PHP_SELF'] == '/viewCart.php' || $_SERVER['PHP_SELF'] == '/addItem.php' || $_SERVER['PHP_SELF'] == '/updateItem.php' || $_SERVER['PHP_SELF'] == '/deleteItem.php' || $_SERVER['PHP_SELF'] == '/emptyCart.php') { ?>
                <a class="avenir f5 fw9 link grow gold dib pa3 ph4-l fw10"
                   href="viewCart.php" title="View your Cart">Cart</a>
            <?php } else { ?>
                <a class="avenir f5 fw9 link bg-animate black-80 hover-gold dib pa3 ph4-l fw10"
                   href="viewCart.php" title="View your Cart">Cart</a>
            <?php }
            if (!isset($_SESSION['user_id'])) echo '
                  <form action="/login.php" method="post">
                      <input class="avenir mt1 w-25" type="text" name="email" placeholder="email">
                      <input class="avenir mt1 w-20" type="password" name="password" placeholder="password">
                      <input class="avenir f5 fw9 bg-white hover-bg-light-red w-10" type="submit" value="Login">
                  </form>
                  
                  <form action="/signUp.php" method="post">
                      <input class="avenir f5 fw9 bg-white hover-bg-light-purple w-10" type="submit" value="Signup">
                  </form>';
            else echo '
    
                  <form action = "/logout.php" method = "post">
                      Welcome ' . $_SESSION['first_name'] . ' <input class="avenir f5 fw9 b--solid bg-white hover-bg-light-red w-10" type = "submit" value = "Logout">
                  </form>';
            ?>
        </div>
    </nav>
</header>