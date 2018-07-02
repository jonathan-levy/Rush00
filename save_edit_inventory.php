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
$csv_user= array_map('str_getcsv', file($file_path));
foreach($csv_user as $key=>$value)
{
	if ($_POST['sku'] === $value[0])
	{
		if ($_POST['delete'] !== 'yes')
		{
			$csv_user[$key][1] = $_POST['ownership'];
			$csv_user[$key][2] = $_POST['make'];
			$csv_user[$key][3] = $_POST['model'];
			$csv_user[$key][4] = $_POST['year'];
			$csv_user[$key][5] = $_POST['color'];
			$csv_user[$key][6] = $_POST['body_style'];
			$csv_user[$key][7] = $_POST['millage'];
			$csv_user[$key][8] = $_POST['location'];
			$csv_user[$key][9] = $_POST['price'];
			$csv_user[$key][10] = $_POST['f/d'];
			$csv_user[$key][11] = $_POST['image_url'];
		}
		else
			unset($csv_user[$key]);
	}
}
write_to_csv($csv_user, $file_path);
header('Location: admin.php');
?>
