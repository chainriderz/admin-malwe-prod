<?php
include("../config.php");
if (! empty($_POST["rid"]))
{
	$rid = $_POST["rid"];
	
	$select = "SELECT * FROM `registered_document` WHERE `reg_id` = '$rid'";
	// echo $select;
	$sresult = mysqli_query($con, $select);
	$row = mysqli_fetch_array($sresult);
	
	if(!empty($row['upload_1']))
	{
	    unlink("../Staff/PDF/".$row['token']."/".$row['upload_1']);
	}
	
	if(!empty($row['upload_2']))
	{
	    unlink("../Staff/PDF/".$row['token']."/".$row['upload_2']);
	}
	
	if(!empty($row['upload_3']))
	{
	    unlink("../Staff/PDF/".$row['token']."/".$row['upload_3']);
	}
	
	if(!empty($row['upload_4']))
	{
	    unlink("../Staff/PDF/".$row['token']."/".$row['upload_4']);
	}
	
	if(!empty($row['upload_5']))
	{
	    unlink("../Staff/PDF/".$row['token']."/".$row['upload_5']);
	}
	rmdir("../Staff/PDF/".$row['token']);
	
	if ($sresult)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Data Deleted Successfully');
                window.location.href='index.php'; 
              </script>
		";
	}
	
	$delete = "DELETE FROM `registered_document` WHERE `reg_id` = '$rid'";
// 	echo $delete; exit;
	$dresult = mysqli_query($con, $delete);

	if ($dresult)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Data Deleted Successfully');
                window.location.href='index.php'; 
              </script>
		";
	}
}
?>