<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Labels</h4>
<?php
if (isset($_GET['lid']))
{
?>
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Edit Labels</div>				
					<div class="card-body">
						<?php
							$sel_rs = "SELECT * FROM `labels` WHERE `l_id` = '$_GET[lid]'";
							$res_rs = mysqli_query($con, $sel_rs);

							if (mysqli_num_rows($res_rs) > 0)
							{
								while($row_rs = mysqli_fetch_array($res_rs))
								{
						?>
						<form class="form" method="POST">
							<div class="form-group">
								<label for="">Label</label>
								<input type="text" class="form-control" name="name" placeholder="Enter label name" value="<?php echo $row_rs["name"]; ?>" required>
							</div>

							<button type="submit" name="upd_name" class="btn btn-success w-100">SUBMIT</button>

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
					<div class="card-header font-weight-bold text-uppercase">ADD Labels</div>				
					<div class="card-body">
						<form class="add-user-form" method="POST">
							<div class="form-group">
								<label for="">Label</label>
								<input type="text" class="form-control" name="name" placeholder="Enter Label Name" required>
							</div>

							<button type="submit" name="add_name" class="btn btn-success w-100">SUBMIT</button>

						</form>
					</div>
				</div>
			</div>

			<div class="col-md-7">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">LABELS DETAILS</div>				
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Label</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_rs = "SELECT * FROM `labels`";
										$res_rs = mysqli_query($con, $sel_rs);

										if (mysqli_num_rows($res_rs) > 0)
										{
											$rssr = 1;
											while($row_rs = mysqli_fetch_array($res_rs))
											{
									?>
									<tr>
										<td><?php echo $rssr; ?></td>
										<td><?php echo $row_rs["name"] ?></td>
										<td>
											<a href="labels.php?lid=<?php echo $row_rs["l_id"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a lid="<?php echo $row_rs["l_id"]; ?>" href="#" onclick="deletelabels($(this).attr('lid'));" class="btn btn-sm btn-danger">
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
	$(".sidebar .nav .labels").addClass("active");
</script>

<?php
if (isset($_POST['add_name']))
{
	$name = mysqli_real_escape_string($con, $_POST['name']);

	$insert = "INSERT INTO `labels` (`name`) VALUES ('$name')";
	$res_ins = mysqli_query($con, $insert);

	if ($res_ins)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Labels Successfully');
                window.location.href='labels.php'; 
              </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='labels.php'; 
        </script>");
	}

}

if (isset($_POST['upd_name']))
{
	$name = mysqli_real_escape_string($con, $_POST['name']);

    $update = "UPDATE `labels` SET `name` = '$name' WHERE `l_id` = '$_GET[lid]'";
    // echo $update; exit;
	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Labels Updated Successfully');
                window.location.href='labels.php'; 
              </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='labels.php?lid=".$_GET['lid']."'; 
        </script>");
	}

}
?>
