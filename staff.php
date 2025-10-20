<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Staff Credentials</h4>
<?php
if (isset($_GET['sid']))
{
?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Edit Staff Credentials</div>				
					<div class="card-body">
						<?php
							$sel_st = "SELECT * FROM `staff` WHERE `sid` = '$_GET[sid]'";
							$res_st = mysqli_query($con, $sel_st);

							if (mysqli_num_rows($res_st) > 0)
							{
							    $row_st = mysqli_fetch_array($res_st);
								// while($row_st = mysqli_fetch_array($res_st))
								// {
						?>
						<form class="form-row" method="POST" enctype="multipart/form-data">
						    <div class="form-group">
								<label for="">Photo</label>
								<input type="file" class="form-control" name="simg" accept=".png, .jpg, .jpeg">
								<?php
								    if(!empty($row_st["simg"]))
								    {
								  ?>
								        <img src="../Staff/assets/img/staff/<?php echo $row_st["simg"]; ?>" class="img-fluid" width="100">
								  <?php
								    }
								  ?>
							</div>
							<div class="form-group col-md-4">
								<label for="">Name</label>
								<input type="text" class="form-control" name="fname" placeholder="Enter Name" value="<?php echo $row_st["name"]; ?>" required>
							</div>
							<div class="form-group col-md-4">
								<label for="">Date of Birth</label>
								<input type="date" class="form-control" name="dob" value="<?php echo $row_st["dob"]; ?>" required>
							</div>
							<div class="form-group col-md-3">
								<label for="">Mobile</label>
								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" placeholder="Enter Mobile" value="<?php echo $row_st["mobile"]; ?>" required>
							</div>
							<div class="form-group col-md-3">
								<label for="">Username</label>
								<input type="text" class="form-control" name="uname" placeholder="Enter Username" value="<?php echo $row_st["uname"]; ?>" required>
							</div>
							<!--<div class="form-group">-->
							<!--	<label for="">Old Password</label>-->
							<!--	<input type="password" class="form-control"  onblur="CheckOldPass(this.value, <?php echo $row_st['sid']; ?>)" name="" placeholder="Enter Old Password" value="" required>-->
							<!--	<div id="old_error"></div>-->
							<!--</div>-->
							<div class="form-group col-md-3">
								<label for="" class="d-block">Password</label>
								<div class="btn-group btn-block">
								    <input type="password" class="form-control" id="input_generate" name="password" placeholder="Enter New Password">
								    <button type="button" onclick="ShowPassword()" class="btn btn-basic eye_btn"><i class="fa fa-eye" aria-hidden="true"></i></button>
								    <!-- <button type="button" onclick="GeneratePassword()" class="btn btn-primary">Generate</button> -->
								</div>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1" <?php if ($row_st["status"] == '1') { echo 'selected'; } ?> >Active</option>
									<option value="2" <?php if ($row_st["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
								</select>
							</div>
							
							<div class="form-group col-md-12">
								<label for="">Upload Document</label>
								<div class="row">
    								<div class="mb-4 text-left col-12">
    									<?php
    								        if(!empty($row_st['upload_1']))
    								        {
    								    ?>
    									<a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_1']; ?>" target="_blank"><?php echo $row_st['upload_1']; ?></a>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_1" class="btn-sm text-light mx-1 bg-primary">
    										<i class="fa fa-pencil" aria-hidden="true"></i>
    									</a>
    									<a href="#" data-toggle="modal" data-target="#modalDelete_1" class="btn-sm text-light mx-1 bg-danger">
    										<i class="fa fa-trash" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								        else
    								        {
    								    ?>
    									<span>Add File</span>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_1" class="btn-sm text-light mx-1 bg-success">
    										<i class="fa fa-plus" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								    ?>
    								</div>
    
    								<div class="mb-4 text-left col-12">
    									<?php
    								        if(!empty($row_st['upload_2']))
    								        {
    								    ?>
    									<a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_2']; ?>" target="_blank"><?php echo $row_st['upload_2']; ?></a>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_2" class="btn-sm text-light mx-1 bg-primary">
    										<i class="fa fa-pencil" aria-hidden="true"></i>
    									</a>
    									<a href="#" data-toggle="modal" data-target="#modalDelete_2" class="btn-sm text-light mx-1 bg-danger">
    										<i class="fa fa-trash" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								        else
    								        {
    								    ?>
    									<span>Add File</span>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_2" class="btn-sm text-light mx-1 bg-success">
    										<i class="fa fa-plus" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								    ?>
    								</div>
    
    								<div class="mb-4 text-left col-12">
    									<?php
    								        if(!empty($row_st['upload_3']))
    								        {
    								    ?>
    									<a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_3']; ?>" target="_blank"><?php echo $row_st['upload_3']; ?></a>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_3" class="btn-sm text-light mx-1 bg-primary">
    										<i class="fa fa-pencil" aria-hidden="true"></i>
    									</a>
    									<a href="#" data-toggle="modal" data-target="#modalDelete_3" class="btn-sm text-light mx-1 bg-danger">
    										<i class="fa fa-trash" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								        else
    								        {
    								    ?>
    									<span>Add File</span>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_3" class="btn-sm text-light mx-1 bg-success">
    										<i class="fa fa-plus" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								    ?>
    								</div>
    
    								<div class="mb-4 text-left col-12">
    									<?php
    								        if(!empty($row_st['upload_4']))
    								        {
    								    ?>
    									<a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_4']; ?>" target="_blank"><?php echo $row_st['upload_4']; ?></a>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_4" class="btn-sm text-light mx-1 bg-primary">
    										<i class="fa fa-pencil" aria-hidden="true"></i>
    									</a>
    									<a href="#" data-toggle="modal" data-target="#modalDelete_4" class="btn-sm text-light mx-1 bg-danger">
    										<i class="fa fa-trash" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								        else
    								        {
    								    ?>
    									<span>Add File</span>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_4" class="btn-sm text-light mx-1 bg-success">
    										<i class="fa fa-plus" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								    ?>
    								</div>
    
    								<div class="mb-4 text-left col-12">
    								    <?php
    								        if(!empty($row_st['upload_5']))
    								        {
    								    ?>
    									<a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_5']; ?>" target="_blank"><?php echo $row_st['upload_5']; ?></a>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_5" class="btn-sm text-light mx-1 bg-primary">
    										<i class="fa fa-pencil" aria-hidden="true"></i>
    									</a>
    									<a href="#" data-toggle="modal" data-target="#modalDelete_5" class="btn-sm text-light mx-1 bg-danger">
    										<i class="fa fa-trash" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								        else
    								        {
    								    ?>
    									<span>Add File</span>
    									<a href="#" data-toggle="modal" data-target="#modalUpload_5" class="btn-sm text-light mx-1 bg-success">
    										<i class="fa fa-plus" aria-hidden="true"></i>
    									</a>
    									<?php
    								        }
    								    ?>
    								</div>
    						    </div>
							</div>

                            <div class="form-group">
							    <button type="submit" name="upd_staff" class="btn btn-success w-100">SUBMIT</button>
							</div>

						</form>
						
<!--UPDATE DOCUMENTS-->

<!-- Modal -->
<div class="modal fade" id="modalUpload_1" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Update Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadFile_1" class="form-control" required>
					<span><?php echo $row_st['upload_1']; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadFile_1" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUpload_2" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Update Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadFile_2" class="form-control" required>
					<span><?php echo $row_st['upload_2']; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadFile_2" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUpload_3" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Update Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadFile_3" class="form-control" required>
					<span><?php echo $row_st['upload_3']; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadFile_3" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUpload_4" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Update Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadFile_4" class="form-control" required>
					<span><?php echo $row_st['upload_4']; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadFile_4" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUpload_5" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Update Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadFile_5" class="form-control" required>
					<span><?php echo $row_st['upload_5']; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadFile_5" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!--DELETE DOCUMENTS-->

<div class="modal fade" id="modalDelete_1" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title">Delete Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $row_st['upload_1']; ?></span> file ?</p>			
					<input type="hidden" name="deleteFile_1" value="<?php echo $row_st['upload_1']; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadFile_1" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDelete_2" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title">Delete Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $row_st['upload_2']; ?></span> file ?</p>			
					<input type="hidden" name="deleteFile_2" value="<?php echo $row_st['upload_2']; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadFile_2" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDelete_3" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title">Delete Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $row_st['upload_3']; ?></span> file ?</p>			
					<input type="hidden" name="deleteFile_3" value="<?php echo $row_st['upload_3']; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadFile_3" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDelete_4" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title">Delete Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $row_st['upload_4']; ?></span> file ?</p>			
					<input type="hidden" name="deleteFile_4" value="<?php echo $row_st['upload_4']; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadFile_4" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDelete_5" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title">Delete Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $row_st['upload_5']; ?></span> file ?</p>			
					<input type="hidden" name="deleteFile_5" value="<?php echo $row_st['upload_5']; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadFile_5" class="btn btn-success">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
						<?php
								// }
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
			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">ADD STAFF CREDENTIALS</div>				
					<div class="card-body">
						<form class="add-user-form form-row" method="POST" enctype="multipart/form-data">
						    <div class="form-group col-md-3">
								<label for="">Photo</label>
								<input type="file" class="form-control" name="simg" accept=".png, .jpg, .jpeg">
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Name</label>
								<input type="text" class="form-control" name="fname" placeholder="Enter Name" required>
							</div>

							<div class="form-group col-md-3">
								<label for="">Mobile</label>
								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" placeholder="Enter Mobile" required>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Date of Birth</label>
								<input type="date" class="form-control" name="dob" required>
							</div>

							<div class="form-group col-md-3">
								<label for="">Username</label>
								<input type="text" class="form-control" name="uname" placeholder="Enter Username" required>
							</div>

							<div class="form-group col-md-3">
								<label for="" class="d-block">Password</label>
								<div class="btn-group btn-block">
								    <input type="password" class="form-control" id="input_generate" name="password" placeholder="Enter Password" required>
								    <button type="button" onclick="ShowPassword()" class="btn btn-basic eye_btn"><i class="fa fa-eye" aria-hidden="true"></i></button>
								    <!-- <button type="button" onclick="GeneratePassword()" class="btn btn-primary">Generate</button> -->
								</div>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Upload Document</label>
								<input type="file" name="uploadFiles[]" id="" multiple class="form-control">
							</div>

							<div class="form-group col-md-3">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="smsg"></div>
							<div class="form-group">
							    <button type="submit" name="add_staff" class="btn btn-success w-100">SUBMIT</button>
							</div>

						</form>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">STAFF DETAILS</div>				
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Photo</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>DOB</th>
										<th>Username</th>
										<th>Password</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_st = "SELECT * FROM `staff`";
										$res_st = mysqli_query($con, $sel_st);

										if (mysqli_num_rows($res_st) > 0)
										{
											$stsr = 1;
											while($row_st = mysqli_fetch_array($res_st))
											{
									?>
									<tr>
										<td><?php echo $stsr; ?></td>
										<td>
										  <?php
										    if(!empty($row_st["simg"]))
										    {
										  ?>
										        <img src="../Staff/assets/img/staff/<?php echo $row_st["simg"]; ?>" width="50">
										  <?php
										    }
										  ?>
										</td>
										<td><?php echo $row_st["name"]; ?></td>
										<td><a href="tel:+91<?php echo $row_st["mobile"] ?>">+91 <?php echo $row_st["mobile"]; ?></a></td>
										<td>
										    <?php 
										        if( $row_st["dob"] != 0)
										        {
										            echo $row_st["dob"];
										        }
										    ?>
										</td>
										<td><?php echo $row_st["uname"]; ?></td>
										<td><?php echo $row_st["password"]; ?></td>
										<td>
											<?php
											if ($row_st["status"] == '1') { echo 'Active'; }
											else { echo 'Inactive'; }
											?>
											<!-- <select class="form-control" onchange="updateSTStatus(this.value, <?php echo $row_st["uid"] ?>)">
												<option value="1" <?php if ($row_st["status"] == '1') { echo 'selected'; } ?> >Active</option>
												<option value="2" <?php if ($row_st["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
											</select> -->
											
										</td>
										<td>
										    <a href="#" data-toggle="modal" data-target="#modalView_<?php echo $row_st["sid"]; ?>" class="btn-sm text-light mx-1 bg-info">
        										<i class="fa fa-eye" aria-hidden="true"></i>
        									</a>
											<a href="staff.php?sid=<?php echo $row_st["sid"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a sid="<?php echo $row_st["sid"]; ?>" href="#" onclick="deletestaff($(this).attr('sid'));" class="btn btn-sm btn-danger">
						                		<i class="fa fa-trash" aria-hidden="true"></i>
						                	</a>
										</td>
									</tr>
									<?php
											$stsr++;
									?>
									<div class="modal fade" id="modalView_<?php echo $row_st["sid"]; ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
                                    	<div class="modal-dialog modal-dialog-centered" role="document">
                                    		<div class="modal-content">
                                    			<div class="modal-header bg-primary">
                                    				<h6 class="modal-title">View Document</h6>
                                    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    					<span aria-hidden="true" class="text-light">&times;</span>
                                    				</button>
                                    			</div>
                                    			<div class="modal-body">
                                        			<p>
                                        			    <?php
                    								        if(!empty($row_st['upload_1']))
                    								        {
                    								    ?>
                                        			    <a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_1']; ?>" target="_blank">
                                        			        <?php echo $row_st['upload_1']; ?>
                                        			    </a>
                                        			    <?php
                    								        }
                    								    ?>
                                        			</p>
                                        			<p>
                                        			    <?php
                    								        if(!empty($row_st['upload_2']))
                    								        {
                    								    ?>
                                        			    <a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_2']; ?>" target="_blank">
                                        			        <?php echo $row_st['upload_2']; ?>
                                        			    </a>
                                        			    <?php
                    								        }
                    								    ?>
                                        			</p>
                                        			<p>
                                        			    <?php
                    								        if(!empty($row_st['upload_3']))
                    								        {
                    								    ?>
                                        			    <a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_3']; ?>" target="_blank">
                                        			        <?php echo $row_st['upload_3']; ?>
                                        			    </a>
                                        			    <?php
                    								        }
                    								    ?>
                                        			</p>
                                        			<p>
                                        			    <?php
                    								        if(!empty($row_st['upload_4']))
                    								        {
                    								    ?>
                                        			    <a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_4']; ?>" target="_blank">
                                        			        <?php echo $row_st['upload_4']; ?>
                                        			    </a>
                                        			    <?php
                    								        }
                    								    ?>
                                        			</p>
                                        			<p>
                                        			    <?php
                    								        if(!empty($row_st['upload_5']))
                    								        {
                    								    ?>
                                        			    <a href="../Staff/assets/img/staff/<?php echo $row_st["mobile"]; ?>/<?php echo $row_st['upload_5']; ?>" target="_blank">
                                        			        <?php echo $row_st['upload_5']; ?>
                                        			    </a>
                                        			    <?php
                    								        }
                    								    ?>
                                        			</p>
                                        			
                                        			<p class="text-center">
                                        			<?php
                                        			    if( empty($row_st['upload_1']) && empty($row_st['upload_2']) && empty($row_st['upload_3']) && empty($row_st['upload_4']) && empty($row_st['upload_5']) )
                                        			    {
                                        			        echo "Upload files to view.";
                                        			    }
                                        			?>
                                        			</p>
                                        		</div>
                                    		</div>
                                    	</div>
                                    </div>
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
	$(".sidebar .nav .add_staff").addClass("active");
</script>

<?php
if (isset($_POST['add_staff']))
{
	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	$uname = mysqli_real_escape_string($con, $_POST['uname']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$pass = md5($password);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	
	$simg = $_FILES['simg']['name'];
	$target_dir = '../Staff/assets/img/staff/'.$simg;
	
	$uploadFiles = implode(",", $_FILES['uploadFiles']['name']);
	$uploadFiles_tmp = implode(",", $_FILES['uploadFiles']['tmp_name']);
	$up_Files_tmp = explode(",", $uploadFiles_tmp);

	mkdir('../Staff/assets/img/staff/'.$mobile.'/');
	$target_dir = '../Staff/assets/img/staff/'.$mobile.'/';

	$docfiles = array();

	foreach ($up_Files_tmp as $key => $value)
	{		
		$file_tmpname = $_FILES["uploadFiles"]["tmp_name"][$key];
		$file_name = $_FILES['uploadFiles']["name"][$key];

		$docfiles[] = $_FILES['uploadFiles']["name"][$key];
		// Set upload file path
		$filepath = $target_dir . basename($file_name);

		if(file_exists($filepath))
		{
			$filepath1 = $target_dir.time()."_".$file_name;
			if( move_uploaded_file($file_tmpname, $filepath1)) {
			// echo "{$file_name} successfully uploaded <br />";
			} 
			else {                     
			// echo "Error uploading {$file_name} <br />"; 
			}
		}
		else
		{
			if (move_uploaded_file($file_tmpname, $filepath))
			{
			// echo "<script language='javascript'>
			//     window.alert('Executed');
			// </script>
			// ";
			}
			else
			{
			// echo "<script language='javascript'>
			//     window.alert('Not Executed');
			// </script>
			// ";
			}
		}  
	}

	$select = "SELECT * FROM `staff` WHERE `uname` = '$uname' OR `mobile` = '$mobile'";
	// echo $select;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Staff Already Exists!');
        		window.location.href=''; 
              </script>
		";
	}
	else
	{
        if( move_uploaded_file($_FILES['simg']['tmp_name'], $target_dir) ) {
		    // echo "{$file_name} successfully uploaded <br />";
		}
		
		$insert = "INSERT INTO `staff` (`simg`, `name`, `mobile`, `upload_1`, `upload_2`, `upload_3`, `upload_4`, `upload_5`, `dob`, `uname`, `password`, `status`) VALUES ('$simg', '$fname', '$mobile','$docfiles[0]','$docfiles[1]','$docfiles[2]','$docfiles[3]','$docfiles[4]', '$dob', '$uname', '$pass', '$status')";
		$res_ins = mysqli_query($con, $insert);

		if ($res_ins)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Staff Created Successfully');
	                window.location.href='staff.php'; 
	              </script>
			";
		}
		else
		{
			echo ("<script LANGUAGE='JavaScript'>
	              window.alert('There was an error please try again later');
	              window.location.href='staff.php'; 
	        </script>");
		}
	}
}

if (isset($_POST['upd_staff']))
{
	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	$uname = mysqli_real_escape_string($con, $_POST['uname']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$pass = md5($password);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	
	$simg = $_FILES['simg']['name'];
	$target_dir = '../Staff/assets/img/staff/'.$simg;

	$select = "SELECT * FROM `staff` WHERE (`uname` = '$uname' OR `mobile` = '$mobile') AND (`sid` != '$_GET[sid]')";
// 	echo $select; exit;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Staff Username or Mobile Already Exists!');
        		window.location.href=''; 
              </script>
		";
	}
	else
	{
	    if( move_uploaded_file($_FILES['simg']['tmp_name'], $target_dir) ) {
		    // echo "{$file_name} successfully uploaded <br />";
		}
		
		if( (empty($password)) && (empty($simg)) )
	    {
	        $update = "UPDATE `staff` SET `name` = '$fname', `mobile` = '$mobile', `dob` = '$dob', `uname` = '$uname', `status` = '$status' WHERE `sid` = '$_GET[sid]'";
            // echo $update; exit;
    		$res_upd = mysqli_query($con, $update);
    
    		if ($res_upd)
    		{
    			echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Staff Credentials Updated Successfully');
    	                window.location.href='staff.php'; 
    	              </script>
    			";
    		}
    		else
    		{
    			echo ("<script LANGUAGE='JavaScript'>
    	              window.alert('There was an error please try again later');
    	              window.location.href='staff.php?sid=".$_GET['sid']."'; 
    	        </script>");
    		}
	    }
	    elseif(empty($password))
	    {
	        $update = "UPDATE `staff` SET `simg` = '$simg', `name` = '$fname', `mobile` = '$mobile', `dob` = '$dob', `uname` = '$uname', `status` = '$status' WHERE `sid` = '$_GET[sid]'";
            // echo $update; exit;
    		$res_upd = mysqli_query($con, $update);
    
    		if ($res_upd)
    		{
    			echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Staff Credentials Updated Successfully');
    	                window.location.href='staff.php'; 
    	              </script>
    			";
    		}
    		else
    		{
    			echo ("<script LANGUAGE='JavaScript'>
    	              window.alert('There was an error please try again later');
    	              window.location.href='staff.php?sid=".$_GET['sid']."'; 
    	        </script>");
    		}
	    }
	    elseif(empty($simg))
	    {
	        $update = "UPDATE `staff` SET `name` = '$fname', `mobile` = '$mobile', `dob` = '$dob', `uname` = '$uname', `password` = '$pass', `status` = '$status' WHERE `sid` = '$_GET[sid]'";
            // echo $update; exit;
    		$res_upd = mysqli_query($con, $update);
    
    		if ($res_upd)
    		{
    			echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Staff Credentials Updated Successfully');
    	                window.location.href='staff.php'; 
    	              </script>
    			";
    		}
    		else
    		{
    			echo ("<script LANGUAGE='JavaScript'>
    	              window.alert('There was an error please try again later');
    	              window.location.href='staff.php?sid=".$_GET['sid']."'; 
    	        </script>");
    		}
	    }
	    else
	    {
    		$update = "UPDATE `staff` SET `simg` = '$simg', `name` = '$fname', `mobile` = '$mobile', `dob` = '$dob', `uname` = '$uname', `password` = '$pass', `status` = '$status' WHERE `sid` = '$_GET[sid]'";
            // echo $update; exit;
    		$res_upd = mysqli_query($con, $update);
    
    		if ($res_upd)
    		{
    			echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Staff Credentials Updated Successfully');
    	                window.location.href='staff.php'; 
    	              </script>
    			";
    		}
    		else
    		{
    			echo ("<script LANGUAGE='JavaScript'>
    	              window.alert('There was an error please try again later');
    	              window.location.href='staff.php?sid=".$_GET['sid']."'; 
    	        </script>");
    		}
	    }
	    
	}
}

// UPDATE DOCUMENTS

if (isset($_POST['upd_uploadFile_1']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$uploadFile_1 = $_FILES['uploadFile_1']['name'];
	$target_file_1 = $target_dir . basename($uploadFile_1);

	// File upload
	if (move_uploaded_file($_FILES["uploadFile_1"]["tmp_name"], $target_file_1))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_1` FROM `staff` WHERE `sid` = '$_GET[sid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_1"]);
	}

	$update = "UPDATE `staff` SET `upload_1`='$uploadFile_1' WHERE `sid` = '$_GET[sid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('Document updated successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['upd_uploadFile_2']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$uploadFile_2 = $_FILES['uploadFile_2']['name'];
	$target_file_2 = $target_dir . basename($uploadFile_2);

	// File upload
	if (move_uploaded_file($_FILES["uploadFile_2"]["tmp_name"], $target_file_2))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_2` FROM `staff` WHERE `sid` = '$_GET[sid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_2"]);
	}

	$update = "UPDATE `staff` SET `upload_2`='$uploadFile_2' WHERE `sid` = '$_GET[sid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('Document updated successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['upd_uploadFile_3']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$uploadFile_3 = $_FILES['uploadFile_3']['name'];
	$target_file_3 = $target_dir . basename($uploadFile_3);

	// File upload
	if (move_uploaded_file($_FILES["uploadFile_3"]["tmp_name"], $target_file_3))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_3` FROM `staff` WHERE `sid` = '$_GET[sid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_3"]);
	}

	$update = "UPDATE `staff` SET `upload_3`='$uploadFile_3' WHERE `sid` = '$_GET[sid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('Document updated successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['upd_uploadFile_4']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$uploadFile_4 = $_FILES['uploadFile_4']['name'];
	$target_file_4 = $target_dir . basename($uploadFile_4);

	// File upload
	if (move_uploaded_file($_FILES["uploadFile_4"]["tmp_name"], $target_file_4))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_4` FROM `staff` WHERE `sid` = '$_GET[sid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_4"]);
	}

	$update = "UPDATE `staff` SET `upload_4`='$uploadFile_4' WHERE `sid` = '$_GET[sid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('Document updated successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['upd_uploadFile_5']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$uploadFile_5 = $_FILES['uploadFile_5']['name'];
	$target_file_5 = $target_dir . basename($uploadFile_5);

	// File upload
	if (move_uploaded_file($_FILES["uploadFile_5"]["tmp_name"], $target_file_5))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_5` FROM `staff` WHERE `sid` = '$_GET[sid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_5"]);
	}

	$update = "UPDATE `staff` SET `upload_5`='$uploadFile_5' WHERE `sid` = '$_GET[sid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('Document updated successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

// DELETE DOCUMENTS

if (isset($_POST['del_uploadFile_1']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$deleteFile_1 = mysqli_real_escape_string($con, $_POST['deleteFile_1']);
	$target_file_1 = $target_dir . $deleteFile_1;

	$delete = "UPDATE `staff` SET `upload_1`='' WHERE `sid` = '$_GET[sid]'";

// 	echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_1);
      echo "<script language='javascript'>
          window.alert('Document deleted successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['del_uploadFile_2']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$deleteFile_2 = mysqli_real_escape_string($con, $_POST['deleteFile_2']);
	$target_file_2 = $target_dir . $deleteFile_2;

	$delete = "UPDATE `staff` SET `upload_2`='' WHERE `sid` = '$_GET[sid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_2);
      echo "<script language='javascript'>
          window.alert('Document deleted successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['del_uploadFile_3']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$deleteFile_3 = mysqli_real_escape_string($con, $_POST['deleteFile_3']);
	$target_file_3 = $target_dir . $deleteFile_3;

	$delete = "UPDATE `staff` SET `upload_3`='' WHERE `sid` = '$_GET[sid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_3);
      echo "<script language='javascript'>
          window.alert('Document deleted successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['del_uploadFile_4']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$deleteFile_4 = mysqli_real_escape_string($con, $_POST['deleteFile_4']);
	$target_file_4 = $target_dir . $deleteFile_4;

	$delete = "UPDATE `staff` SET `upload_4`='' WHERE `sid` = '$_GET[sid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_4);
      echo "<script language='javascript'>
          window.alert('Document deleted successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}

if (isset($_POST['del_uploadFile_5']))
{
	$target_dir = '../Staff/assets/img/staff/'.$row_st["mobile"].'/';
	
	$deleteFile_5 = mysqli_real_escape_string($con, $_POST['deleteFile_5']);
	$target_file_5 = $target_dir . $deleteFile_5;

	$delete = "UPDATE `staff` SET `upload_5`='' WHERE `sid` = '$_GET[sid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_5);
      echo "<script language='javascript'>
          window.alert('Document deleted successfully');
           window.location.href=''; 
      </script>
      ";
   }
   else
   {
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
   }
}
?>
