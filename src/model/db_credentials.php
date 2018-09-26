<?php
// These are pulled from the .env file or CI/CD environment variables.
// Nothing here needs to be modified.
$dbname = getenv('MYSQL_DATABASE');
$password = getenv('MYSQL_ROOT_PASSWORD');

$host = 'mysql';
$username = 'root';
