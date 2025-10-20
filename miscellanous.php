<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Miscellanous</h4>

		<div class="row">
			<?php
				$select_misc = "SELECT * FROM `miscellanous`";
				$res_misc = mysqli_query($con, $select_misc);
				$row_misc = mysqli_fetch_array($res_misc);
			?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Edit Section</div>				
					<div class="card-body">
						<form class="form" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Logo</label>
										<input type="file" class="form-control form-control-sm" name="logo">
										<img src="../images/<?php echo $row_misc['logo']; ?>" width="200">
									</div>

									<div class="form-group">
										<label for="">Home Banner</label>
										<input type="file" class="form-control form-control-sm" name="home_banner">
										<img src="../images/<?php echo $row_misc['home_banner']; ?>" width="200">
									</div>

									<div class="form-group">
										<label for="">Facebook URL</label>
										<input type="url" class="form-control" name="fb_url" placeholder="Enter URL including 'http://' or 'https://'" value="<?php echo $row_misc['fb_url']; ?>" required>
									</div>

									<div class="form-group">
										<label for="">Instagram URL</label>
										<input type="url" class="form-control" name="insta_url" placeholder="Enter URL including 'http://' or 'https://'" value="<?php echo $row_misc['insta_url']; ?>" required>
									</div>

									<div class="form-group">
										<label for="">Twitter URL</label>
										<input type="url" class="form-control" name="twitter_url" placeholder="Enter URL including 'http://' or 'https://'" value="<?php echo $row_misc['twitter_url']; ?>" required>
									</div>

									<div class="form-group">
										<label for="">WhatsApp URL</label>
										<input type="url" class="form-control" name="whatsapp_url" placeholder="Enter URL including 'http://' or 'https://'" value="<?php echo $row_misc['whatsapp_url']; ?>" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="">About Content</label>
										<textarea rows="7" class="form-control about_content" name="about_content" required><?php echo $row_misc['about_content']; ?></textarea>
									</div>

									<div class="form-group">
										<label for="">Address</label>
										<textarea rows="3" class="form-control form-control-sm" name="address" placeholder="Enter Address" required><?php echo $row_misc['address']; ?></textarea>
									</div>

									<div class="form-group">
										<label for="">Location Map</label>
										<textarea rows="3" class="form-control" name="location_map" placeholder="Enter <iframe> embed map" required><?php echo $row_misc['location_map']; ?></textarea>
									</div>

									<button type="submit" name="update_misc" class="btn btn-success w-100">SUBMIT</button>
								</div>
							</div>						

						</form>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
	$(".sidebar .nav .miscellanous").addClass("active");
	// tinymce.init({selector:'.about_content'});
	ClassicEditor
        .create( document.querySelector( '.about_content' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>

<?php

if (isset($_POST['update_misc']))
{
	$target_dir = "../images/";

	$logo = $_FILES['logo']['name'];
	$target_file_1 = $target_dir . basename($logo);

	$home_banner = $_FILES['home_banner']['name'];
	$target_file_2 = $target_dir . basename($home_banner);

	$about_content = mysqli_real_escape_string($con, $_POST['about_content']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$fb_url = mysqli_real_escape_string($con, $_POST['fb_url']);
	$twitter_url = mysqli_real_escape_string($con, $_POST['twitter_url']);
	$insta_url = mysqli_real_escape_string($con, $_POST['insta_url']);
	$whatsapp_url = mysqli_real_escape_string($con, $_POST['whatsapp_url']);
	$location_map = mysqli_real_escape_string($con, $_POST['location_map']);

	// File upload
	if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file_1))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	// $select = "SELECT `logo` FROM `miscellanous` WHERE `mid` = '1'";
	  	// $result = mysqli_query($con, $select);
	  	// $row = mysqli_fetch_array($result);

	  	// unlink("../img/".$row["logo"]);
	}

	// File upload
	if (move_uploaded_file($_FILES["home_banner"]["tmp_name"], $target_file_2))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	// $select = "SELECT `home_banner` FROM `miscellanous` WHERE `mid` = '1'";
	  	// $result = mysqli_query($con, $select);
	  	// $row = mysqli_fetch_array($result);

	  	// unlink("../img/".$row["home_banner"]);
	}

	if (!empty($logo))
	{
		$update = "UPDATE `miscellanous` SET `logo`='$logo',`about_content`='$about_content',`address`='$address',`fb_url`='$fb_url',`twitter_url`='$twitter_url',`insta_url`='$insta_url',`whatsapp_url`='$whatsapp_url',`location_map`='$location_map' WHERE `mid` = '1'";

		$res_upd = mysqli_query($con, $update);

		if ($res_upd)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Header Updated Successfully');
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
	if (!empty($home_banner))
	{
		$update = "UPDATE `miscellanous` SET `home_banner`='$home_banner',`about_content`='$about_content',`address`='$address',`fb_url`='$fb_url',`twitter_url`='$twitter_url',`insta_url`='$insta_url',`whatsapp_url`='$whatsapp_url',`location_map`='$location_map' WHERE `mid` = '1'";

		$res_upd = mysqli_query($con, $update);

		if ($res_upd)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Header Updated Successfully');
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
	if (!empty($home_banner) && !empty($logo))
	{
		$update = "UPDATE `miscellanous` SET `logo`='$logo',`home_banner`='$home_banner',`about_content`='$about_content',`address`='$address',`fb_url`='$fb_url',`twitter_url`='$twitter_url',`insta_url`='$insta_url',`whatsapp_url`='$whatsapp_url',`location_map`='$location_map' WHERE `mid` = '1'";

		$res_upd = mysqli_query($con, $update);

		if ($res_upd)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Header Updated Successfully');
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

		$update = "UPDATE `miscellanous` SET `about_content`='$about_content',`address`='$address',`fb_url`='$fb_url',`twitter_url`='$twitter_url',`insta_url`='$insta_url',`whatsapp_url`='$whatsapp_url',`location_map`='$location_map' WHERE `mid` = '1'";

		$res_upd = mysqli_query($con, $update);

		if ($res_upd)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Header Updated Successfully');
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