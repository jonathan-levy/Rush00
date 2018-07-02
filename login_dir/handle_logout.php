<?php
include 'login_functions.php';

session_start();
$_SESSION['user'] = null;
$_SESSION['admin'] = null;
$_SESSION['cart_total'] = 0;
header('Location: ../index.php');
?>
