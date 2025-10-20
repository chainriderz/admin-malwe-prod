<?php

include "../config.php";

$query="SELECT * FROM `agent` WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(convert_tz(now(),'+00:00','+05:30'), '%m-%d') LIMIT 2";
// echo $query;
$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) > 0)
{
	$data= array();
	while($row = mysqli_fetch_array($result))
	{
		$data[] = array(
            "name"   => $row['agent_name']
		);
	}
	echo json_encode($data);
}

?>