<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Edit Profile</h4>
<?php
    $aid = $_SESSION['admin_aid'];
    
    $select = "SELECT * FROM `admin` WHERE `aid` = '$aid'";
    $result = mysqli_query($con, $select);
    
    $row = mysqli_fetch_array($result);
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">EDIT ADMIN CREDENTIALS</div>				
					<div class="card-body">
						<form class="add-user-form" method="POST">
							<div class="form-group">
								<label for="">Name</label>
								<input type="text" class="form-control" name="fname" placeholder="Enter Name" value="<?php echo $row['aname']; ?>" disabled>
							</div>

							<div class="form-group">
								<label for="">Mobile</label>
								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobileno" placeholder="Enter Mobile" value="<?php echo $row['mobileno']; ?>" required>
							</div>

							<div class="form-group">
								<label for="" class="d-block">Password</label>
								<div class="btn-group btn-block">
								    <input type="password" class="form-control" id="input_generate" name="password" placeholder="Enter Password">
								    <button type="button" onclick="ShowPassword()" class="btn btn-basic eye_btn"><i class="fa fa-eye" aria-hidden="true"></i></button>
								    <!-- <button type="button" onclick="GeneratePassword()" class="btn btn-primary">Generate</button> -->
								</div>
							</div>

							<div class="smsg"></div>
							<button type="submit" name="edit_admin" class="btn btn-success w-100">SUBMIT</button>

						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
	$(".sidebar .nav .profile").addClass("active");
</script>

<?php
if (isset($_POST['edit_admin']))
{
	$mobile = mysqli_real_escape_string($con, $_POST['mobileno']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$pass = md5($password);

    if(empty($password))
    {
    	$update = "UPDATE `admin` SET `mobileno` = '$mobile' WHERE `aid` = '$aid'";
        //echo $update; exit;
    	$res_upd = mysqli_query($con, $update);
    
    	if ($res_upd)
    	{
    		echo "
    			<script LANGUAGE='JavaScript'>;
            		window.alert('Admin Credentials Updated Successfully');
                    window.location.href=''; 
                  </script>
    		";
    	}
    	else
    	{
    		echo ("<script LANGUAGE='JavaScript'>
                  window.alert('There was an error please try again later');
                  window.location.href=''; 
            </script>");
    	}
    }
    else
    {
        $update = "UPDATE `admin` SET `mobileno` = '$mobile', `password` = '$pass' WHERE `aid` = '$aid'";
        //echo $update; exit;
    	$res_upd = mysqli_query($con, $update);
    
    	if ($res_upd)
    	{
    		echo "
    			<script LANGUAGE='JavaScript'>;
            		window.alert('Admin Credentials Updated Successfully');
                    window.location.href=''; 
                  </script>
    		";
    	}
    	else
    	{
    		echo ("<script LANGUAGE='JavaScript'>
                  window.alert('There was an error please try again later');
                  window.location.href=''; 
            </script>");
    	}
    }
}

?>
