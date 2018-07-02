<?php
include 'login_functions.php';

session_start(); 

function	write_to_csv($array, $file_csv)
{
	$file = fopen($file_csv, "w+");
	foreach ($array as $line)
	{
		fputcsv($file, $line);
	}
	fclose($file);
}

function	merge_carts($login, $new)
{
	$file_path = "../carts/no_user.csv";
    $existing_cart= array_map('str_getcsv', file($file_path));
	if ($new)
	{
		copy($file_path, "../carts/".$login.".csv");
	}
	else
	{
		$path = "../carts/".$login.".csv";
		if (file_exists($path))
		{
			$users_cart = array_map('str_getcsv', file($path));
			unset($users_cart[0]);
			array_push($existing_cart, $users_cart);
		}
		write_to_csv($existing_cart, $path);
	}
	foreach($existing_cart as $key => $item)
	{
		if ($key > 0)
		{
			unset($existing_path[$key]);
		}
	}
	write_to_csv($existing_path, $file_path);
}


if (isset($_POST['submit']))
{
	$users =  unserialize(file_get_contents('private/passwd'));
	if ($_POST['user'] == 'yes')
	{
		foreach($users as $user)
		{
			if ($user['login'] == $_POST['login'])
			{
				$_SESSION['user'] = $_POST['login'];
				echo "user alreaday exists\n";
				header('Location: .');
			}
		}
		$users[] = array("login" => $_POST['login'], "passwd" => hash('whirlpool', $_POST['passwd']));
		$_SESSION['user'] = $_POST['login'];
		file_put_contents('private/passwd', serialize($users));
		merge_carts($_SESSION['user'], 1);
		header('Location: ../index.php');
	}
	else
	{
		if (auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION['user'] = $_POST['login'];
			if ($_POST['login'] === 'admin')
				$_SESSION['admin'] = 1;
			header('Location: ../index.php');
		}
		else
		{
			$_SESSION['user'] = $_POST['login'];
			echo "invalid username or password\n";
			header('Location: ../login.php');
		}
	}
}
?>
