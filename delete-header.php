<?php
include("../config.php");
if (! empty($_POST["hid"]))
{
	$hid = $_POST["hid"];

	$delete = "DELETE FROM `header_section` WHERE `hid` = '$hid'";
	// echo $delete;
	$result = mysqli_query($con, $delete);

	if ($result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Header Deleted Successfully');
                window.location.href='header-section.php'; 
              </script>
		";
	}
}
?>