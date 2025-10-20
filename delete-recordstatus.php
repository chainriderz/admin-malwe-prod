<?php
include("../config.php");
if (! empty($_POST["rsid"]))
{
	$rsid = $_POST["rsid"];

	$delete = "DELETE FROM `record_status` WHERE `rs_id` = '$rsid'";
	// echo $delete;
	$result = mysqli_query($con, $delete);

	if ($result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Record Status Deleted Successfully');
                window.location.href='record_status.php'; 
              </script>
		";
	}
}
?>