
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
		<div class="listings">
			<?php inventory_loop($csv_cars) ?>
		</div>
	</body>
</html>
