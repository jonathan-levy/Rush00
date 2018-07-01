<?php

session_start();

include 'cart_functions.php';

if (empty($_SESSION['user']))
{
	$file_path = "carts/no_user.csv";
	delete_cart_item_csv($file_path);
}
else
{
	$file_path = "carts/".$_SESSION['user'].".csv";
	delete_cart_item_csv($file_path);
}
?>
