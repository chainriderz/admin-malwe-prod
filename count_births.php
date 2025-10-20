<?php

include "../config.php";
$select = "SELECT * FROM `staff` WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d')";
$res_2 = mysqli_query($con, $select);
$count_2 = mysqli_num_rows($res_2);
echo $count_2;

?>