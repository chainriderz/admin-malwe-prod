<?php
include("../config.php");
if (! empty($_POST["status"]) && ! empty($_POST["sid"]))
{
	$status = $_POST["status"];
	$sid = $_POST["sid"];

	$update = "UPDATE `staff` SET `status` = '$status' WHERE `sid` = '$sid'";
	// echo $update;
	$result = mysqli_query($con, $update);
}
?>.