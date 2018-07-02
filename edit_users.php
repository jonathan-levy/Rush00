<!doctype html>
<style>
#inventory {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#inventory td, #inventory th {
    border: 1px solid #ddd;
    padding: 8px;
}

#inventory tr:nth-child(even){background-color: #f2f2f2;}

#inventory tr:hover {background-color: #ddd;}

#inventory th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
}
tr:nth-child(even) {background-color: #f2f2f2;}
</style>

<html>
	<head>
		<link rel="stylesheet" href="index.css">
		<?php include 'loops.php';?>
		<title>Basics</title>
	</head>
	<body>
		<h1>🚗 Cars R US  🚗</h1>
		<?php display_top_navbar(); ?>
		<br />
		<p>Leave fields black to delete user</p>
		<?php admin_edit_users_loop($_POST['login']); ?>
	</body>
</html>
