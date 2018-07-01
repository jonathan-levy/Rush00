<?php

session_start();

$csv_bs= array_map('str_getcsv', file('database/body_style.csv'));
$csv_cars= array_map('str_getcsv', file('database/data.csv'));
#print_r($csv);

function	display_top_navbar()
{
		echo "<div class='topnav'>";
			echo "<a class='active' href='/index.php'>Home</a>";
			echo "<a href='/shop.php'>Inventory</a>";
			echo "<a href='#contact'>Contact</a>";
			echo "<a href='#about'>About</a>";
			if ($_SESSION['admin'] = 'yes')
				echo "<a href='/admin.php'>Admin</a>";
			echo "<a href='/login/'>Login</a>";
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
				echo "<div class='col_buttons'>";	
					echo "<button class='button button1'>Compare</button>";
					echo "<br />";
					echo "<button class='button button2'>Add to Cart</button>";
				echo "</div>";
			echo "</div>";
		}
	}
}


function admin_inventory_loop($csv_cars)
{
	echo "<table>";
	foreach($csv_cars as $key=>$value)
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
		echo "</tr>";
	}
	echo "</table>";
}


function admin_users_loop()
{
	$users =  unserialize(file_get_contents('login/private/passwd'));
	echo "<table>";
	echo "<tr>";
		echo "<td>User</td>";
		echo "<td>Password</td>";
	echo "</tr>";

	foreach($users as $key=>$value)
	{
		echo "<tr>";
			echo "<td>".$value['login']."</td>";
			echo "<td>".$value['passwd']."</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
