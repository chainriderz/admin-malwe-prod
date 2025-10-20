<?php

include "../config.php";
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$currdate = date('Y-m-d H:i:s');

$query="SELECT *,DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) AS `date_diff` from `registered_document` WHERE DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) <= 10 OR DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) <= 30 AND `record_status` = 'Active' HAVING `date_diff` > 0";

$res_1 = mysqli_query($con,$query);
$count_1 = mysqli_num_rows($res_1);

$sel_2 = "SELECT * FROM `staff` WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(convert_tz(now(),'+00:00','+05:30'), '%m-%d')";
$res_2 = mysqli_query($con, $sel_2);
$count_2 = mysqli_num_rows($res_2);

$sel_3 = "SELECT * FROM `agent` WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(convert_tz(now(),'+00:00','+05:30'), '%m-%d')";
$res_3 = mysqli_query($con, $sel_3);
$count_3 = mysqli_num_rows($res_3);

$sel_4 = "SELECT * FROM `enquiry` WHERE DATE(datetime_schedule) = DATE_FORMAT('$currdate', '%Y-%m-%d')";
$res_4 = mysqli_query($con, $sel_4);
$count_4 = mysqli_num_rows($res_4);

echo $count_1 + $count_2 + $count_3 + $count_4;

?>