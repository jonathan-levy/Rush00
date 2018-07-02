<?php
session_start();
include 'loops.php';
include 'cart_functions.php';
#$_SESSION['cart_total'] = calculate_cart( 
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="index.css">
		<title>Basics</title>
	</head>
	<body>
		<h1>🚗 Cars R US  🚗</h1>
		<?php display_top_navbar(); ?>
		<div>
			<?php display_cart_loop() ?>
		</div>
		<hr>
		<h2>Quantity: <?php echo "<p>".$_SESSION['user_car_quantity']."</p>" ?> Total: <?php echo "$".number_format($_SESSION['cart_total']) ?> </h2>
		<form  action='purchase.php' method='post' class='col_buttons'>
			<input type=hidden name='car_id' value=".$value[0].">
			<input type='submit' class='button button2' value='Purchase'/>
		</form>
	</body> 
</html>
