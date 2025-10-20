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
	$update = "UPDATE `admin` SET `otp` = '$rndno', `otp_status` = '0' WHERE `mobileno` = '$admobile'";
	// echo $update;
	$ures = mysqli_query($con, $update);
	
	if($ures)
	{
        $curl = curl_init();

        curl_setopt_array($curl, [
			CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=63bfe022d6fc05799e0f3012&mobile=91" . $admobile . "&authkey=386535AieSz8yz6395c2ceP1",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "{\n  \"otp\": \"$rndno\"\n}",
			CURLOPT_HTTPHEADER => [
			"Content-Type: application/JSON"
			],
		]);

        $response = curl_exec($curl);
		$err = curl_error($curl);

		if ($err)
		{
			echo "cURL Error #:" . $err;
		}
		else
		{
			echo $response;
			$_SESSION['otp']=$rndno;
			curl_close($curl);
		}
	}
}
else
{
    echo 'false';
}

?>