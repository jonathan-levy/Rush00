<?php
session_start();
?>

<!doctype html>
<style>
hr {
    display: block;
    height: 4px;
    border: 0;
    border-top: 4px solid white;
    margin: 1em 0;
    padding: 0;
}
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
		<div class="listings">
			<?php inventory_loop($csv_cars) ?>
		</div>
		<hr>
	</body>
</html>
