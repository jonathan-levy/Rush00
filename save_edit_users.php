<?php

session_start();

$users =  unserialize(file_get_contents('login_dir/private/passwd'));
foreach($users as $key=>$value)
{
	if ($_POST['original_login'] ===  $value['login'])
	{
		if (strlen($_POST['passwd']) < 15)
			$passwd = hash('whirlpool', $_POST['passwd']);
		else
			$passwd = $_POST['passwd'];
		if ($_POST['delete'] !== 'yes')
		{
			$users[$key]['login'] = $_POST['login'];
			$users[$key]['passwd'] = $passwd; 
		}
		else
			unset($users[$key]);
	}
}

file_put_contents('login_dir/private/passwd', serialize($users));
header('Location: /admin.php');

?>
