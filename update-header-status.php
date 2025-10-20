<?php
include("../config.php");
if (! empty($_POST["status"]) && ! empty($_POST["hid"]))
{
	$status = $_POST["status"];
	$hid = $_POST["hid"];

	$update = "UPDATE `header_section` SET `status` = '$status' WHERE `hid` = '$hid'";
	// echo $update;
	$result = mysqli_query($con, $update);
}
?>