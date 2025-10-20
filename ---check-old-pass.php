<?php
include("../config.php");
if (! empty($_POST["sid"]) && ! empty($_POST["pass"]))
{
	$sid = $_POST["sid"];
	$pass = $_POST["pass"];
	$p = md5($pass);

	$update = "SELECT * FROM `staff` WHERE `sid` = '$sid' AND `password` = '$p'";
	// echo $update; exit;
	$result = mysqli_query($con, $update);

	if (mysqli_num_rows($result) == 0)
	{
		echo '
			<span class="text-danger">Incorrect Password</span>
		';
	}
}
?>