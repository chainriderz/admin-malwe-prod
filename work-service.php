<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Work Details</h4>
<?php
if(isset($_GET['wid']))
{
?>
        <div class="row">
			<div class="col-md-4">
			    <div class="card">
					<div class="card-header font-weight-bold text-uppercase">EDIT WORK DETAILS</div>				
					<div class="card-body">
					    <?php
							$sel_w = "SELECT * FROM `work_services` WHERE `w_id` = '$_GET[wid]'";
							$res_w = mysqli_query($con, $sel_w);

							if (mysqli_num_rows($res_w) > 0)
							{
							    $row_w = mysqli_fetch_array($res_w);
						?>
						<form class="add-user-form" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Service Name</label>
								<input type="text" class="form-control" name="w_name" value="<?php echo $row_w['w_name']; ?>" placeholder="Enter Service Name" required>
							</div>

							<div class="form-group">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1" <?php if($row_w['status'] == '1') { echo 'selected'; } ?>>Active</option>
									<option value="2" <?php if($row_w['status'] == '2') { echo 'selected'; } ?>>Inactive</option>
								</select>
							</div>
							
							<div class="form-group">
							    <button type="submit" name="upd_work" class="btn btn-success">SUBMIT</button>
							</div>

						</form>
						<?php
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
			<div class="col-md-4">
			    <div class="card">
					<div class="card-header font-weight-bold text-uppercase">ADD WORK DETAILS</div>				
					<div class="card-body">
						<form class="add-user-form" method="POST" enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="">Service Name</label>
								<input type="text" class="form-control" name="w_name" placeholder="Enter Service Name" required>
							</div>

							<div class="form-group">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							
							<div class="form-group">
							    <button type="submit" name="add_work" class="btn btn-success">SUBMIT</button>
							</div>

						</form>
					</div>
				</div>
			</div>
			
			<div class="col-md-8">
			    <div class="card">
					<div class="card-header font-weight-bold text-uppercase">WORK DETAILS</div>				
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Service Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_w = "SELECT * FROM `work_services`";
										$res_w = mysqli_query($con, $sel_w);

										if (mysqli_num_rows($res_w) > 0)
										{
											$wsr = 1;
											while($row_w = mysqli_fetch_array($res_w))
											{
									?>
									<tr>
										<td><?php echo $wsr; ?></td>
										<td><?php echo $row_w["w_name"]; ?></td>
										<td>
											<?php
											if ($row_w["status"] == '1') { echo 'Active'; }
											else { echo 'Inactive'; }
											?>
											<!-- <select class="form-control" onchange="updateSTStatus(this.value, <?php echo $row_ag["uid"] ?>)">
												<option value="1" <?php if ($row_ag["status"] == '1') { echo 'selected'; } ?> >Active</option>
												<option value="2" <?php if ($row_ag["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
											</select> -->
											
										</td>
										<td>
											<a href="work-service.php?wid=<?php echo $row_w["w_id"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a w_id="<?php echo $row_w["w_id"]; ?>" href="#" onclick="deletework($(this).attr('w_id'));" class="btn btn-sm btn-danger">
						                		<i class="fa fa-trash" aria-hidden="true"></i>
						                	</a>
										</td>
									</tr>
									<?php
											$wsr++;
									?>
									<?php
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
	$(".sidebar .nav .add_work").addClass("active");
</script>

<?php
if (isset($_POST['add_work']))
{
    $wname = mysqli_real_escape_string($con, $_POST['w_name']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $insert = "INSERT INTO `work_services`(`w_name`, `status`) VALUES ('$wname','$status')";
    $res_ins = mysqli_query($con, $insert);
    
    if ($res_ins)
    {
        echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Work Created Successfully');
                window.location.href='work-service.php'; 
              </script>
		";
    }
    else
    {
        echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='work-service.php'; 
        </script>");
    }
}

if (isset($_POST['upd_work']))
{
    $wname = mysqli_real_escape_string($con, $_POST['w_name']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $update = "UPDATE `work_services` SET `w_name`='$wname',`status`='$status' WHERE `w_id`='$_GET[wid]'";
    $res_upd = mysqli_query($con, $update);
    
    if ($res_upd)
    {
        echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Work Updated Successfully');
                window.location.href='work-service.php'; 
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
?>