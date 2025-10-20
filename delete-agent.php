<?php
include("../config.php");
if (! empty($_POST["aid"]))
{
	$aid = $_POST["aid"];
	
	$select = "SELECT * FROM `agent` WHERE `agent_id` = '$aid'";
	$res = mysqli_query($con, $select);
	$row = mysqli_fetch_array($res);

    $sel_kyc = "SELECT * FROM `kyc_upload` WHERE `agent_id` = '$aid'";
    $res_sel_kyc = mysqli_query($con, $sel_kyc);
    
    if(mysqli_num_rows($res_sel_kyc) > 0)
    {
        while($row_kyc = mysqli_fetch_array($res_sel_kyc))
        {
            unlink ('assets/img/agent/'.$row["email"].'/'.$row_kyc["kyc_doc"]);
        }
    }
    rmdir('assets/img/agent/'.$row["email"]);
    // exit;

	$delete = "DELETE FROM `agent` WHERE `agent_id` = '$aid'";
	$result = mysqli_query($con, $delete);

	if ($result)
	{
	    $del_kyc = "DELETE FROM `kyc_upload` WHERE `agent_id` = '$aid'";
    	$res_kyc = mysqli_query($con, $del_kyc);
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Agent Deleted Successfully');
                window.location.href='agent.php'; 
              </script>
		";
	}
}
?>