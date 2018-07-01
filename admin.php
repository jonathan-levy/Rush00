
<!doctype html>

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
		<?php admin_inventory_loop($csv_cars) ?>
		<br />
		<?php admin_users_loop() ?>
	</body>
</html>
