<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Record Status</h4>
<?php
if (isset($_GET['rsid']))
{
?>
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Edit Record Status</div>				
					<div class="card-body">
						<?php
							$sel_rs = "SELECT * FROM `record_status` WHERE `rs_id` = '$_GET[rsid]'";
							$res_rs = mysqli_query($con, $sel_rs);

							if (mysqli_num_rows($res_rs) > 0)
							{
								while($row_rs = mysqli_fetch_array($res_rs))
								{
						?>
						<form class="form" method="POST">
							<div class="form-group">
								<label for="">Status</label>
								<input type="text" class="form-control" name="status" placeholder="Enter Status" value="<?php echo $row_rs["status"]; ?>" required>
							</div>

							<button type="submit" name="upd_status" class="btn btn-success w-100">SUBMIT</button>

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
					<div class="card-header font-weight-bold text-uppercase">ADD RECORD STATUS</div>				
					<div class="card-body">
						<form class="add-user-form" method="POST">
							<div class="form-group">
								<label for="">Status</label>
								<input type="text" class="form-control" name="status" placeholder="Enter Status" required>
							</div>

							<button type="submit" name="add_status" class="btn btn-success w-100">SUBMIT</button>

						</form>
					</div>
				</div>
			</div>

			<div class="col-md-7">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">RECORD STATUS DETAILS</div>				
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_rs = "SELECT * FROM `record_status`";
										$res_rs = mysqli_query($con, $sel_rs);

										if (mysqli_num_rows($res_rs) > 0)
										{
											$rssr = 1;
											while($row_rs = mysqli_fetch_array($res_rs))
											{
									?>
									<tr>
										<td><?php echo $rssr; ?></td>
										<td><?php echo $row_rs["status"] ?></td>
										<td>
											<a href="record_status.php?rsid=<?php echo $row_rs["rs_id"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a rsid="<?php echo $row_rs["rs_id"]; ?>" href="#" onclick="deleterecordstatus($(this).attr('rsid'));" class="btn btn-sm btn-danger">
						                		<i class="fa fa-trash" aria-hidden="true"></i>
						                	</a>
										</td>
									</tr>
									<?php
											$rssr++;
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
	$(".sidebar .nav .record_status").addClass("active");
</script>

<?php
if (isset($_POST['add_status']))
{
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$insert = "INSERT INTO `record_status` (`status`) VALUES ('$status')";
	$res_ins = mysqli_query($con, $insert);

	if ($res_ins)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Record Status Successfully');
                window.location.href='record_status.php'; 
              </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='record_status.php'; 
        </script>");
	}

}

if (isset($_POST['upd_status']))
{
	$status = mysqli_real_escape_string($con, $_POST['status']);

    $update = "UPDATE `record_status` SET `status` = '$status' WHERE `rs_id` = '$_GET[rsid]'";
    // echo $update; exit;
	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Record Status Updated Successfully');
                window.location.href='record_status.php'; 
              </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='record_status.php?rsid=".$_GET['rsid']."'; 
        </script>");
	}

}
?>
