<?php
include("../config.php");
if (! empty($_POST["token"])  && ! empty($_POST["id"]) )
{
    $id = $_POST["id"];
	$token = $_POST["token"];

	$select = "SELECT `token` FROM `registered_document` WHERE `token` = '$token' AND `reg_id` = '$id'";
// 	echo $select; exit;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		echo '';
	}
}
if (! empty($_POST["token"]) )
{
    // $id = $_POST["id"];
	$token = $_POST["token"];

	$select = "SELECT `token` FROM `registered_document` WHERE `token` = '$token'";
// 	echo $select; exit;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		echo '
			<span class="text-danger">Token is already taken!</span>
		';
	}
}
?>