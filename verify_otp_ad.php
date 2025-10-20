<?php

include("../config.php");

$adname = $_POST['name'];
$admobile = $_POST['mobile'];
$adotp = $_POST['otp'];

$select = "SELECT * FROM `admin` WHERE `aname` = '$adname' AND `mobileno` = '$admobile' And `otp` = '$adotp'";

$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0)
{
	$curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.msg91.com/api/v5/otp/verify?otp=".$adotp."&authkey=386535AieSz8yz6395c2ceP1&mobile=".$admobile,
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
    
    if ($err)
    {
        echo "cURL Error #:" . $err;
    }
    else
    {
        echo $response;
        
        $update = "UPDATE `admin` SET `otp_status` = '1', `otp` = '0' WHERE `otp` = '$adotp' AND `mobileno` = '$admobile'";
		// echo $update;
		// exit;
		$ures = mysqli_query($con, $update);

		if($ures)
		{
			// echo '
			// 	<div class="alert alert-success alert-dismissible">
			// 	  <button type="button" class="close" data-dismiss="alert">&times;</button>
			// 	  <strong>Success!</strong> Your OTP is verified! Our staff will get back to you soon! 
			// 	</div>
			// ';

			$row = mysqli_fetch_array($result);
	    
        	session_start();
        	$_SESSION['admin_login'] = $adname;
        	$_SESSION['admin_aid'] = $row['aid'];
        	$_SESSION["login_time_stamp"] = time();
    		echo "
    			<script LANGUAGE='JavaScript'>;
            		window.alert('Login successful');
                      window.location.href='index.php'; 
                  </script>
    		";
		}
		else
		{
			echo ("<script LANGUAGE='JavaScript'>
	              window.alert('There was an error loging in. Please check your mobile number & OTP!');
	              </script>");
		}
    }
}
else
{
    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Incorrect OTP</strong></div>';
}

?>
