<?php
include("../config.php");
if (! empty($_POST["lid"]))
{
	$lid = $_POST["lid"];

	$delete = "DELETE FROM `labels` WHERE `l_id` = '$lid'";
	// echo $delete;
	$result = mysqli_query($con, $delete);

	if ($result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Record Status Deleted Successfully');
                window.location.href='labels.php'; 
              </script>
		";
	}
}
?>