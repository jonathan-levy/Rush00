<?php
session_start();
?>
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
		<div>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/vXIa5E0Ev8M?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
		 <?php body_style_loop($csv_bs); ?>
	</body>
</html>
