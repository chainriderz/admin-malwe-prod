<?php

include("../config.php");

$adname = $_POST['name'];
$admobile = $_POST['mobile'];
$rndno=rand(100000, 999999);

$select = "SELECT * FROM `admin` WHERE `aname` = '$adname' AND `mobileno` = '$admobile'";
// echo $select;
// exit;
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0)
{
    $curl = curl_init();
    
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.msg91.com/api/v5/otp/retry?authkey=386535AieSz8yz6395c2ceP1&retrytype=text&mobile=91".$admobile,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
else
{
    echo 'false';
}

?>