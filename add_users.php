<?php

session_start();

$users =  unserialize(file_get_contents('login_dir/private/passwd'));

$users[] = array('login' => $_POST['login'], 'passwd' => hash('whirlpool', $_POST['passwd']));
print_r($_POST);
file_put_contents('login_dir/private/passwd', serialize($users));
header('Location: /admin.php');

?>
