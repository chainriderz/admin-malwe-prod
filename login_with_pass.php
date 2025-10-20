<?php


include("../config.php");

$adname = $_POST['name'];
$admobile = $_POST['mobile'];
$adpassword = $_POST['pass'];
$adpass = md5($adpassword);

$select = "SELECT * FROM `admin` WHERE `aname` = '$adname' AND `mobileno` = '$admobile' AND `password` = '$adpass'";
// echo $select; exit;
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_array($result);
    
	session_start();
	$_SESSION['admin_login'] = $adname;
	$_SESSION['admin_aid'] = $row['aid'];
	$_SESSION["login_time_stamp"] = time();

	echo "
		<script LANGUAGE='JavaScript'>;
    		window.alert('Login successful');
              window.location.href='index1.php'; 
          </script>
	";
}
else
{
    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Incorrect Password </strong></div>';
}

?>
