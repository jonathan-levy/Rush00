<?php

session_start();

function	write_to_csv($array, $file_csv)
{
	$file = fopen($file_csv, "w+");
	foreach ($array as $line)
	{
		fputcsv($file, $line);
	}
	fclose($file);
}

$file_path ="database/data.csv";
$csv_inventory = array_map('str_getcsv', file($file_path));
$new_inventory = array($_POST['sku'],
					$_POST['ownership'],
					$_POST['make'],
					$_POST['model'],
					$_POST['year'],
					$_POST['color'],
					$_POST['body_style'],
					$_POST['millage'],
					$_POST['location'],
					$_POST['price'],
					$_POST['f/d'],
					$_POST['image_url']);
$csv_inventory[] = $new_inventory;
write_to_csv($csv_inventory, $file_path);
header('Location: admin.php');
?>


?>
