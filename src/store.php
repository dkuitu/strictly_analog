<?php
//This php File is loads the store components: search, browse, sort, randomAlbums, and is linked to from the nav "store" element -->
session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';
require 'search.php';
require 'randomAlbums.php';
require 'view/footer.php';