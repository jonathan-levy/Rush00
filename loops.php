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
			echo "<a href='/cart.php'>Cart";
			echo "<p id='car_quantity_header'>".$_SESSION['user_car_quantity']."</p>";
			echo "</a>";
			if ($_SESSION['admin'])
				echo "<a href='/admin.php'>Admin</a>";
			echo "<a href='/login.php'>Login</a>";
			echo "<a href='login_dir/handle_logout.php'>Logout</a>";
		echo "</div>";
}

function	body_style_loop($csv_bs)
{
	echo "<div class='col-12'>";
	foreach($csv_bs as $key=>$value)
	{
		if ($key > 0)
		{
			echo "<div class='col-3 card' id='car_index'>";
				echo "<div class='card-image'>";
					echo "<img class='card-img' src=".$value[1]." >";
				echo "</div>";
				echo "<div class='card-link'>";
					echo "<a href=''>".$value[0]."</a>";
				echo "</div>";
			echo "</div>";
		}

	}
	echo "</div>";
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
					echo "<input type='number' name='quantity' min='1' max='5' value='1' />";
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
					echo "<input type='number' name='quantity' min='1' max='5' value=".$value[12].">";
					echo "<input type='submit' class='button button2' value='Remove'/>";
				echo "</form>";
			echo "</div>";
		}
	}
	$_SESSION['user_car_quantity'] = $key;
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
	echo "<tr>";
		echo "<form action='add_inventory.php' method='post' class='col_buttons'>";
			echo "<td>";
					echo "<input type=text name='sku' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='ownership' value=''>";
			echo "</td>";
			echo "<td>";
					echo "<input type=text name='make' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='model' value=''>";
			echo "</td>";
			echo "<td>";
					echo "<input type=text name='year' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='color' value=''>";
			echo "</td>";
			echo "<td>";
					echo "<input type=text name='body_style' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='milage' value=''>";
			echo "</td>";
			echo "<td>";
					echo "<input type=text name='location' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='price' value=''>";
			echo "</td>";
			echo "<td>";
					echo "<input type=text name='f/d' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='image_url' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=hidden name='login' value=".$value['login'].">";
				echo "<input type='submit' class='button button2' value='Add'/>";
			echo "</td>";
		echo "</form>";
	echo "</tr>";

	echo "</table>";
}


function admin_users_loop()
{
	$users =  unserialize(file_get_contents('login_dir/private/passwd'));
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
				echo "<form action='edit_users.php' method='post' class='col_buttons'>";
					echo "<input type=hidden name='login' value=".$value['login'].">";
					echo "<input type='submit' class='button button2' value='Edit'/>";
				echo "</form>";
			echo "</td>";
		echo "</tr>";
	}
	echo "<tr>";
		echo "<form action='add_users.php' method='post' class='col_buttons'>";
			echo "<td>";
					echo "<input type=text name='login' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type=text name='passwd' value=''>";
			echo "</td>";
			echo "<td>";
				echo "<input type='submit' class='button button2' value='Add'/>";
			echo "</td>";
		echo "</form>";
	echo "</tr>";
	echo "</table>";
}

function admin_edit_users_loop($login)
{
	$users =  unserialize(file_get_contents('login_dir/private/passwd'));
	echo "<form action='save_edit_users.php' method='post' class='col_buttons'>";
	echo "<table id='inventory'>";
		echo "<tr>";
			echo "<th>User</td=h>";
			echo "<th>Password</th>";
			echo "<th>Delete</th>";
		echo "</tr>";
	foreach($users as $key=>$value)
	{
		if ($login ===  $value['login'])
		{
				echo "<tr>";
					echo "<td>";
						echo "<input type=hidden name='original_login' value=".$value['login'].">";
						echo "<input type=text id=".$value['login']." name='login' value=".$value['login'].">";
					echo "</td>";
					echo "<td>";
						echo "<input type=text name='passwd' value=".$value['passwd'].">";
					echo "</td>";
					echo "<td>";
						echo "<input type=checkbox name='delete' value='yes'>";
					echo "</td>";
				echo "</tr>";
		}
	}
	echo "</table>";
	echo "<input type='submit' class='button button2' value='Save'/>";
	echo "</form>";
}

function admin_edit_inventory_loop($car_id)
{
	$inventory = array_map('str_getcsv', file('database/data.csv'));
	echo "<table id='inventory'>";
	foreach($inventory as $key=>$value)
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
				echo "<th>Delete</th>";
			echo "</tr>";
		}
		if ($car_id ===  $value[0])
		{
			echo "<form action='save_edit_inventory.php' method='post' class='col_buttons'>";
				echo "<tr>";
					echo "<td>";
						echo $value[0];
							echo "<input type=hidden name='sku' value=".$value[0].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='ownership' value=".$value[1].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='make' value=".$value[2].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='model' value=".$value[3].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='year' value=".$value[4].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='color' value=".$value[5].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='body_style' value=".$value[6].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='milage' value=".$value[7].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='location' value=".$value[8].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='price' value=".$value[9].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='f/d' value=".$value[10].">";
					echo "</td>";
					echo "<td>";
							echo "<input type=text name='image_url' value=".$value[11].">";
					echo "</td>";
					echo "<td>";
						echo "<input type=checkbox name='delete' value='yes'>";
					echo "</td>";
				echo "</tr>";
		}
	}
	echo "</table>";
	echo "<input type='submit' class='button button2' value='Save'/>";
			echo "</form>";
}
?>
