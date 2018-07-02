<?php

session_start();

include 'cart_functions.php';

$quantity_cars = $_POST["quantity"]; 



if (empty($_SESSION['user']))
{
	$file_path = "carts/no_user.csv";
	//add to cart in no user is logged in
	load_n_modify_csv($file_path, $_POST["quantity"]);
}
else
{
	//add to logged in usesr's accoutn
	$file_path = "carts/".$_SESSION['user'].".csv";
	if (file_exists($file_path))
		load_n_modify_csv($file_path, $_POST["quantity"]);
	else
	{
		copy('carts/user.csv', $file_path);
		load_n_modify_csv($file_path, $_POST["quantity"]);
	}
}



?>
