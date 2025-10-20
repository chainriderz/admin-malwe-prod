<?php
include("../config.php");
if (! empty($_POST["sid"]))
{
	$sid = $_POST["sid"];
	
	$select = "SELECT * FROM `staff` WHERE `sid` = '$sid'";
	$res = mysqli_query($con, $select);
	$row = mysqli_fetch_array($res);
	
	unlink('../Staff/assets/img/staff/'.$row["simg"]);
	
	unlink('../Staff/assets/img/staff/'.$row["mobile"].'/'.$row["upload_1"]);
	unlink('../Staff/assets/img/staff/'.$row["mobile"].'/'.$row["upload_2"]);
	unlink('../Staff/assets/img/staff/'.$row["mobile"].'/'.$row["upload_3"]);
	unlink('../Staff/assets/img/staff/'.$row["mobile"].'/'.$row["upload_4"]);
	unlink('../Staff/assets/img/staff/'.$row["mobile"].'/'.$row["upload_5"]);
	
	rmdir('../Staff/assets/img/staff/'.$row["mobile"]);

	$delete = "DELETE FROM `staff` WHERE `sid` = '$sid'";
	// echo $delete;
	$result = mysqli_query($con, $delete);

	if ($result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Staff Deleted Successfully');
                window.location.href='staff.php'; 
              </script>
		";
	}
}
?>