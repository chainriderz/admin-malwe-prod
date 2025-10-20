<?php
include("../config.php");
if (! empty($_POST["otp"]) )
{
	$otp = $_POST["otp"];

	$update = "SELECT * FROM `admin` WHERE `otp` = '$otp' AND `mobileno` = '9004708999'";
// 	echo $update; exit;
	$result = mysqli_query($con, $update);

	if (mysqli_num_rows($result) == 0)
	{
		echo 'Incorrect OTP';
	}
}
?>