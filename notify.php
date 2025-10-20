<?php

include "../config.php";

$query="SELECT *,DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) AS `date_diff` from `registered_document` WHERE DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) <= 10 OR DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) <= 30 AND `record_status` = 'Active' HAVING `date_diff` > 0 LIMIT 2";
// echo $query;
$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) > 0)
{
	$data= array();
	while($row = mysqli_fetch_array($result))
	{
		$data[] = array(
			"token" => $row['token'],
            "tenant_name"   => $row['tenant_name'],
            "tenant_mobile"   => $row['tenant_mobile'],
            "agreement_end_date"   => $row['agreement_end_date']
		);
	}
	echo json_encode($data);
}

?>