<?php

include "../config.php";

$query="SELECT *,DATEDIFF(`agreement_end_date`, CURDATE()) AS `date_diff` from `registered_document` WHERE DATEDIFF(`agreement_end_date`, CURDATE()) <= 10 OR DATEDIFF(`agreement_end_date`, CURDATE()) <= 30 AND `record_status` = 'Active' HAVING `date_diff` > 0";
$res_1 = mysqli_query($con,$query);
$count_1 = mysqli_num_rows($res_1);
echo $count_1;

?>