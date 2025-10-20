<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Header Section</h4>
<?php
if (isset($_GET['hid']))
{
?>
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Edit Header Section</div>				
					<div class="card-body">
						<?php
							$sel_hs = "SELECT * FROM `header_section` WHERE `hid` = '$_GET[hid]'";
							$res_hs = mysqli_query($con, $sel_hs);

							if (mysqli_num_rows($res_hs) > 0)
							{
								while($row_hs = mysqli_fetch_array($res_hs))
								{
						?>
						<form class="form" method="POST">
							<div class="form-group">
								<label for="">Header Text</label>
								<input type="text" class="form-control" name="h_text" placeholder="Enter Header Text" value="<?php echo $row_hs["header_text"]; ?>" required>
							</div>
							<div class="form-group">
								<label for="">Header URL</label>								
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">tel:+91</span>
									</div>
									<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="h_url" placeholder="Enter Header URL" value="<?php echo $row_hs["header_url"]; ?>" required>
								</div>
							</div>

							<div class="form-group">
								<label for="">Status</label>
								<!-- <select class="form-control" name="h_status">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select> -->
								<select class="form-control" name="h_status">
									<option value="1" <?php if ($row_hs["status"] == '1') { echo 'selected'; } ?> >Active</option>
									<option value="2" <?php if ($row_hs["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
								</select>
							</div>

							<button type="submit" name="upd_header" class="btn btn-success w-100">SUBMIT</button>

						</form>
						<?php
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
<?php
}
else
{
?>
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Add Header Section</div>				
					<div class="card-body">
						<form class="form" method="POST">
							<div class="form-group">
								<label for="">Header Text</label>
								<input type="text" class="form-control" name="h_text" placeholder="Enter Header Text" required>
							</div>
							<div class="form-group">
								<label for="">Header URL</label>								
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">tel:+91</span>
									</div>
									<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="h_url" placeholder="Enter Header URL" required>
								</div>
							</div>

							<div class="form-group">
								<label for="">Status</label>
								<select class="form-control" name="h_status">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>

							<button type="submit" name="add_header" class="btn btn-success w-100">SUBMIT</button>

						</form>
					</div>
				</div>
			</div>

			<div class="col-md-7">
				<div class="card">					
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Header Text</th>
										<th>Header URL</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_hs = "SELECT * FROM `header_section`";
										$res_hs = mysqli_query($con, $sel_hs);

										if (mysqli_num_rows($res_hs) > 0)
										{
											$hssr = 1;
											while($row_hs = mysqli_fetch_array($res_hs))
											{
									?>
									<tr>
										<td><?php echo $hssr; ?></td>
										<td>+91 <?php echo $row_hs["header_text"] ?></td>
										<td>tel:+91<?php echo $row_hs["header_url"] ?></td>
										<td>
											<?php
												if ($row_hs["status"] == '1') { echo 'Active'; }
												else { echo 'Inactive'; }
											?>
											<!-- <select class="form-control" onchange="updateHStatus(this.value, <?php echo $row_hs["hid"] ?>)">
												<option value="1" <?php if ($row_hs["status"] == '1') { echo 'selected'; } ?> >Active</option>
												<option value="2" <?php if ($row_hs["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
											</select> -->
											
										</td>
										<td>
											<a href="header-section.php?hid=<?php echo $row_hs["hid"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a hid="<?php echo $row_hs["hid"]; ?>" href="#" onclick="deleteheader($(this).attr('hid'));" class="btn btn-sm btn-danger">
						                		<i class="fa fa-trash" aria-hidden="true"></i>
						                	</a>
										</td>
									</tr>
									<?php
											$hssr++;
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
}
?>
	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
	$(".sidebar .nav .header_section").addClass("active");
</script>

<?php
if (isset($_POST['add_header']))
{
	$h_text = mysqli_real_escape_string($con, $_POST['h_text']);
	$h_url = mysqli_real_escape_string($con, $_POST['h_url']);
	$h_status = mysqli_real_escape_string($con, $_POST['h_status']);

	$insert = "INSERT INTO `header_section` (`header_text`, `header_url`, `status`) VALUES ('$h_text', '$h_url', '$h_status')";
	$res_ins = mysqli_query($con, $insert);

	if ($res_ins)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Header Added Successfully');
                window.location.href='header-section.php'; 
              </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='header-section.php'; 
        </script>");
	}
}

if (isset($_POST['upd_header']))
{
	$h_text = mysqli_real_escape_string($con, $_POST['h_text']);
	$h_url = mysqli_real_escape_string($con, $_POST['h_url']);
	$h_status = mysqli_real_escape_string($con, $_POST['h_status']);

	$update = "UPDATE `header_section` SET `header_text` = '$h_text', `header_url` = '$h_url', `status` = '$h_status' WHERE `hid` = '$_GET[hid]'";

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Header Updated Successfully');
                window.location.href='header-section.php'; 
              </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='header-section.php?hid=".$_GET['hid']."'; 
        </script>");
	}
}
?>