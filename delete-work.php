<?php
include("../config.php");
if (! empty($_POST["wid"]))
{
	$wid = $_POST["wid"];

	$delete = "DELETE FROM `work_services` WHERE `w_id` = '$wid'";
	// echo $delete;
	$result = mysqli_query($con, $delete);

	if ($result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Work Service Deleted Successfully');
                window.location.href='work-service.php'; 
              </script>
		";
	}
}
?>