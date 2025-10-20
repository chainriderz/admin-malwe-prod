<?php
include("../config.php");
if (! empty($_POST["eid"]))
{
	$eid = $_POST["eid"];

	$delete = "DELETE FROM `enquiry` WHERE `eid` = '$eid'";
	// echo $delete;
	$result = mysqli_query($con, $delete);

	if ($result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Enquiry Deleted Successfully');
                window.location.href='enquiry.php'; 
              </script>
		";
	}
}
?>