<?php
include 'auth.php';
session_start();

function	login($get)
{
	if (auth($get['login'], $get['passwd']))
	{
		$_SESSION['user'] =  $get['login'];
		return true;
	}
	else
	{
		$_SESSION['user'] = null;
		return false;
	}
}

function	does_user_exist($get)
{
	$users =  unserialize(file_get_contents('private/passwd'));
	foreach($users as $user)
	{
		if ($user['login'] == $get['login'])
			return true;
	}
	return false;
}
?>
