<?php
session_start();
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';

global $dbc;

if (isset($_SESSION['user_id'])) {
    $message = 'already logged in';
}

if (!isset($_POST['email'], $_POST['password'])) {
    $message = 'enter valid email and password';
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$sql = 'SELECT user_id, first_name, email, password FROM customers WHERE email = :email';

$stmt = $dbc->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

//$user_id = $stmt->fetchColumn(0);
//$first_name = $stmt->fetchColumn(1);

$results = $stmt->fetch();
$stmt->closeCursor();

$hash = $results['password'];
$user_id = $results['user_id'];
$first_name = $results['first_name'];

if ($user_id == false) {
    $message = 'login failed';
} elseif (password_verify($password, $hash) == false) {
    $message = 'bad password';
} else {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['first_name'] = $first_name;
    $message = 'welcome';
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
