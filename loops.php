<?php

session_start();

$csv_bs= array_map('str_getcsv', file('database/body_style.csv'));
$csv_cars= array_map('str_getcsv', file('database/data.csv'));

function	display_top_navbar()
{
		echo "<p>Welcome ".$_SESSION['user']."</p>";
		echo "<div class='topnav'>";
			echo "<a class='active' href='/index.php'>Home</a>";
			echo "<a href='/shop.php'>Inventory</a>";
			echo "<a href='/cart.php'>Cart</a>";
			if ($_SESSION['admin'])
				echo "<a href='/admin.php'>Admin</a>";
			echo "<a href='/login.php'>Login</a>";
			echo "<a href='login/handle_logout.php'>Logout</a>";
		echo "</div>";
}

function	body_style_loop($csv_bs)
{
	foreach($csv_bs as $key=>$value)
	{
		if ($key > 0)
		{
			echo "<div class='body_styles'>";
				echo "<div class='body_styles'>";
					echo "<img src=".$value[1].">";
					echo "<a href=''>".$value[0]."</a>";
				echo "</div>";
			echo "</div>";
		}
	}
}

function	inventory_loop($csv_cars)
{
	foreach($csv_cars as $key=>$value)
	{
		if ($key > 0)
		{
			echo "<div class='car_listing' id=".$value[0].">";
				echo "<div class='col_car'>";
					echo "<img class='listing_img' src=".$value[11]." '/>";
				echo "</div>";
				echo "<div class='col_tet'>";
					echo "<p>".$value[1]."</p>";
					echo "<p>".$value[9]."</p>";
					echo "<p>".$value[4]." ".$value[2]." ".$value[3]."</p>";
					echo "<p> Millage: ".$value[7]."</p>";
				echo "</div>";
				echo "<form  action='add_to_cart.php' method='post' class='col_buttons'>";
					echo "<input type=hidden name='car_id' value=".$value[0].">";
					echo "<input type='submit' class='button button2' value='Add to Cart'/>";
				echo "</form>";
			echo "</div>";
		}
	}
}

function	display_cart_loop()
{
	if (empty($_SESSION['user']))
		$file_path = 'carts/no_user.csv';
	else
		$file_path = "carts/".$_SESSION['user'].".csv";
	$csv_cart= array_map('str_getcsv', file($file_path));
	foreach($csv_cart as $key=>$value)
	{
		if ($key > 0)
		{
			echo "<div class='car_listing' id=".$value[0].">";
				echo "<div class='col_car'>";
					echo "<img class='listing_img' src=".$value[11]." '/>";
				echo "</div>";
				echo "<div class='col_tet'>";
					echo "<p>".$value[9]."</p>";
					echo "<p>".$value[4]." ".$value[2]." ".$value[3]."</p>";
				echo "</div>";
				echo "<form  action='remove_from_cart.php' method='post' class='col_buttons'>";
					echo "<input type=hidden name='car_id' value=".$value[0].">";
					echo "<input type='submit' class='button button2' value='Remove'/>";
				echo "</form>";
			echo "</div>";
		}
	}
}


function admin_inventory_loop($csv_cars)
{
	echo "<table id='inventory'>";
	foreach($csv_cars as $key=>$value)
	{
		if ($key == 0)
		{	
			echo "<tr>";
				echo "<th>".$value[0]."</th>";
				echo "<th>".$value[1]."</th>";
				echo "<th>".$value[2]."</th>";
				echo "<th>".$value[3]."</th>";
				echo "<th>".$value[4]."</th>";
				echo "<th>".$value[5]."</th>";
				echo "<th>".$value[6]."</th>";
				echo "<th>".$value[7]."</th>";
				echo "<th>".$value[8]."</th>";
				echo "<th>".$value[9]."</th>";
				echo "<th>".$value[10]."</th>";
				echo "<th>".$value[11]."</th>";
				echo "<th>Edit</th>";
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
				echo "<td>".$value[0]."</td>";
				echo "<td>".$value[1]."</td>";
				echo "<td>".$value[2]."</td>";
				echo "<td>".$value[3]."</td>";
				echo "<td>".$value[4]."</td>";
				echo "<td>".$value[5]."</td>";
				echo "<td>".$value[6]."</td>";
				echo "<td>".$value[7]."</td>";
				echo "<td>".$value[8]."</td>";
				echo "<td>".$value[9]."</td>";
				echo "<td>".$value[10]."</td>";
				echo "<td>".$value[11]."</td>";
				echo "<td>";
					echo "<form action='edit_inventory.php' method='post' class='col_buttons'>";
					echo "<input type=hidden name='car_id' value=".$value[0].">";
					echo "<input type='submit' class='button button2' value='Edit'/>";
				echo "</form>";
				echo "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
}


function admin_users_loop()
{
	$users =  unserialize(file_get_contents('login/private/passwd'));
	echo "<table id='inventory'>";
		echo "<tr>";
			echo "<th>User</td=h>";
			echo "<th>Password</th>";
			echo "<th>Edit</th>";
		echo "</tr>";
	foreach($users as $key=>$value)
	{
		echo "<tr>";
			echo "<td>".$value['login']."</td>";
			echo "<td>".$value['passwd']."</td>";
			echo "<td>";
				echo "<form action='delete_users.php' method='post' class='col_buttons'>";
					echo "<input type=hidden name='car_id' value=".$value[0].">";
					echo "<input type='submit' class='button button2' value='Delete'/>";
				echo "</form>";
			echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
