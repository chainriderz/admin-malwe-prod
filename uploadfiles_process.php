<?php
// var_dump($_POST['source'])."<br>";
// print_r($_FILES['file']);

if (isset($_POST['source']) && isset($_FILES['file']))
{
	$target_dir = $_POST['source'];
	$image = implode(",", array_filter($_FILES['file']['name']));
	$image_tmp = implode(",", array_filter($_FILES['file']['tmp_name']));

	$img_tmp = explode(",", $image_tmp);

	foreach ($img_tmp as $key => $value)
	{	
		$file_tmpname = $_FILES["file"]["tmp_name"][$key];
		$file_name = $_FILES['file']["name"][$key];

		// Set upload file path
		$filepath = $target_dir . basename($file_name);

		if(file_exists($filepath))
		{
			echo 'file_exists';
		}
		else
		{
			if( move_uploaded_file($file_tmpname, $filepath))
			{
				echo 'file_uploaded';
			}
		}
	}
}
?>