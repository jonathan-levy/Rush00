<?php

session_start();
$_SESSION['user'];

if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	$user = 'no_user';
$file_path = "carts/".$user.".csv";
copy($file_path, 'admin/') ;
header('Location: index.php');

?>
