<?php

session_start();

function	calculate_cart_total($cart)
{
	$total = 0;
	foreach($cart as $key => $item)
	{
		if ($key > 0)
		{
			$item[9] = str_replace("$", "", $item[9]);
			$item[9] = str_replace(",", "", $item[9]);
			$_SESSION['str_val'] = $item[9];
			$total += intval($item[9]);
		}
	}
	return $total;
}

function	write_to_csv($array, $file_csv)
{
	$file = fopen($file_csv, "w+");
	foreach ($array as $line)
	{
		fputcsv($file, $line);
	}
	fclose($file);
}

function	load_n_modify_csv($file_path)
{
	$csv_user= array_map('str_getcsv', file($file_path));
	$_SESSION['item_name'] = $_POST['car_id'];
	$csv_cars= array_map('str_getcsv', file('database/data.csv'));
	foreach($csv_cars as $key=>$value)
	{
		if ($_POST['car_id'] === $value[0])
		{
			$csv_user[] = $value;
			write_to_csv($csv_user, $file_path);
		}
	}
	$_SESSION['cart_total'] = calculate_cart_total($csv_user);
	header('Location: shop.php');
}

function	delete_cart_item_csv($file_path)
{
	$csv_user= array_map('str_getcsv', file($file_path));
	foreach($csv_user as $key=>$value)
	{
		if ($_POST['car_id'] === $value[0])
		{
			unset($csv_user[$key]);
			write_to_csv($csv_user, $file_path);
		}
	}
	$_SESSION['cart_total'] = calculate_cart_total($csv_user);
	header('Location: cart.php');
}

?>
