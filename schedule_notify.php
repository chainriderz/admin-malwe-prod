<?php

include "../config.php";
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$currdate = date('Y-m-d H:i:s');

$query="SELECT * FROM `enquiry` WHERE DATE(datetime_schedule) = DATE_FORMAT('$currdate', '%Y-%m-%d') LIMIT 2";
// echo $query;
$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) > 0)
{
	$data= array();
	while($row = mysqli_fetch_array($result))
	{
		$data[] = array(
            "name"   => $row['name'],
            "schedule"   => $row['datetime_schedule']
		);
	}
	echo json_encode($data);
}

?>