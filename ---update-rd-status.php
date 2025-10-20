<?php
include("../config.php");
if (! empty($_POST["status"]) && ! empty($_POST["rid"]))
{
	$status = $_POST["status"];
	$rid = $_POST["rid"];

	$update = "UPDATE `registered_document` SET `record_status` = '$status' WHERE `reg_id` = '$rid'";
	// echo $update;
	$result = mysqli_query($con, $update);
}
?>.