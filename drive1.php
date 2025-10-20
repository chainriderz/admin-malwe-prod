<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Drive</h4>
<?php
if( isset($_GET['id']) )
{
    $id = $_GET['id'];
?>
        <div class="row">
			<div class="col-md-12">
			    <div class="card">
					<div class="card-header font-weight-bold text-uppercase">EDIT DRIVE</div>				
					<div class="card-body">
					    <?php
							$sel_d = "SELECT * FROM `drive` WHERE `drive_id` = '$id'";
							$res_d = mysqli_query($con, $sel_d);

							if (mysqli_num_rows($res_d) > 0)
							{
							    $row_d = mysqli_fetch_array($res_d);
						?>
						<form class="form-row" method="POST" enctype="multipart/form-data">
        							
							<div class="form-group col-lg-4">
								<label for="" class="d-block">Select Token</label>
								<select id="setToken" class="form-control" name="token" style="width:100%">
								    <option>Select Token</option>
								    <?php
								        $sel_token = "SELECT DISTINCT `token` FROM `registered_document`";
								        $res_token = mysqli_query($con, $sel_token);
								        if(mysqli_num_rows($res_token) > 0)
								        {
								            while($row_token = mysqli_fetch_array($res_token))
								            {
								    ?>
									<option value="<?php echo $row_token['token']; ?>" <?php if($row_d['token'] == $row_token['token']) echo 'selected'; ?> ><?php echo $row_token['token']; ?></option>
									<?php
								            }
								        }
								    ?>
								</select>
							</div>
							
							<div class="form-group col-lg-4">
								<label for="">Update File</label>
								<input type="file" class="form-control-file" name="UploadFile">
								<a href="Drive/<?php echo $row_d['token']; ?>/<?php echo $row_d['files']; ?>" target="_blank"><?php echo $row_d['files']; ?></a>
							</div>

							<div class="form-group col-lg-4">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1" <?php if($row_d['status'] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row_d['status'] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							
							<div class="form-group">
							    <button type="submit" name="upd_drive" class="btn btn-success">SUBMIT</button>
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
			<div class="col-md-12">
			    <div class="card">
					<div class="card-header font-weight-bold text-uppercase">
					    <span class="d-block float-left mt-1">DRIVE</span>
					    <a href="#"  data-toggle="modal" data-target="#modalUploadNew" class="btn-sm btn-success float-right">
					        <i class="la la-arrow-up"></i> Upload
					    </a>
					</div>				
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Token</th>
										<th>Files</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_d = "SELECT * FROM `drive`";
										$res_d = mysqli_query($con, $sel_d);

										if (mysqli_num_rows($res_d) > 0)
										{
											$dsr = 1;
											while($row_d = mysqli_fetch_array($res_d))
											{
									?>
									<tr>
										<td><?php echo $dsr; ?></td>
										<td><?php echo $row_d["token"]; ?></td>
										<td>
										    <?php //echo $row_d["files"]; ?>
										    <a href="Drive/<?php echo $row_d["token"]; ?>/<?php echo $row_d["files"]; ?>" target="_blank" class="btn-sm btn-primary btn-border btn-round">
										        <i class="fa fa-eye" aria-hidden="true"></i> View File
										    </a>
										</td>
										<td>
											<?php
											if ($row_d["status"] == '1') { echo 'Active'; }
											else { echo 'Inactive'; }
											?>
										</td>
										<td>
											<a href="drive.php?id=<?php echo $row_d["drive_id"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a d_id="<?php echo $row_d["drive_id"]; ?>" href="drive.php?did=<?php echo $row_d["drive_id"]; ?>&token=<?php echo $row_d["token"]; ?>&file=<?php echo $row_d["files"]; ?>" onclick="deletedrive(this.href, event);" class="btn btn-sm btn-danger">
						                		<i class="fa fa-trash" aria-hidden="true"></i>
						                	</a>
										</td>
									</tr>
									<?php
									        $dsr++;
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

<!-- Modal -->
<div class="modal fade" id="modalUploadNew" role="dialog" aria-labelledby="modalUploadNew" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">									
				<div class="row">
				    <div class="col-md-12">
        				<div class="card">
        					<div class="card-header font-weight-bold text-uppercase">ADD FILES</div>				
        					<div class="card-body">
        						<form class="form-row" method="POST" enctype="multipart/form-data">
        							
        							<div class="form-group col-lg-4">
        								<label for="" class="d-block">Select Token</label>
        								<select id="setToken" class="form-control" name="token" style="width:100%">
        								    <option>Select Token</option>
        								    <?php
        								        $sel_token = "SELECT DISTINCT `token` FROM `registered_document`";
        								        $res_token = mysqli_query($con, $sel_token);
        								        if(mysqli_num_rows($res_token) > 0)
        								        {
        								            while($row_token = mysqli_fetch_array($res_token))
        								            {
        								    ?>
        									<option value="<?php echo $row_token['token']; ?>"><?php echo $row_token['token']; ?></option>
        									<?php
        								            }
        								        }
        								    ?>
        								</select>
        							</div>
        							
        							<div class="form-group col-lg-4">
        								<label for="">Upload File(s)</label>
        								<input type="file" class="form-control-file" name="UploadFiles[]" multiple required>
        							</div>
        
        							<div class="form-group col-lg-4">
        								<label for="">Status</label>
        								<select class="form-control" name="status">
        									<option value="1">Active</option>
        									<option value="2">Inactive</option>
        								</select>
        							</div>
        							
        							<div class="form-group">
        							    <button type="submit" name="add_drive" class="btn btn-success">SUBMIT</button>
        							</div>
        
        						</form>
        					</div>
        				</div>
        			</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>
<script type="text/javascript">
	$(".sidebar .nav .add_drive").addClass("active");
	
	function deletedrive(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
	
	$(document).ready(function()
    {
      // Initialize select2
      $("#setToken").select2();
    });
</script>

<?php
if (isset($_POST['add_drive']))
{
    $token = mysqli_real_escape_string($con, $_POST['token']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    if (!file_exists('Drive/'.$token.'/'))
    {
        mkdir('Drive/'.$token.'/');
    }
    
    $target_dir = "Drive/".$token."/";
	$UploadFiles = implode(",", $_FILES['UploadFiles']['name']);
	$UploadFiles_tmp = implode(",", $_FILES['UploadFiles']['tmp_name']);
	$UpF_img_tmp = explode(",", $UploadFiles_tmp);

	$target_file = $target_dir . basename($UploadFiles);
	
	foreach ($UpF_img_tmp as $key => $value)
	{		
		$file_tmpname = $_FILES["UploadFiles"]["tmp_name"][$key];
		$file_name = $_FILES['UploadFiles']["name"][$key];

		// $pdffiles[] = $_FILES['uploadPDF']["name"][$key];
		// Set upload file path
		$filepath = $target_dir . basename($file_name);

		if(file_exists($filepath))
		{
			// $filepath1 = $target_dir.time()."_".$file_name;
			// if( move_uploaded_file($file_tmpname, $filepath1))
			// {
				echo "
					<script LANGUAGE='JavaScript'>;
		        		window.alert('{$UploadFiles} Already Exists!');
		        		window.location.href='';
	              </script>
				";
				exit();
			// }
			
		}
		else
		{
			if (move_uploaded_file($file_tmpname, $filepath))
			{
        
                $insert = "INSERT INTO `drive`(`token`, `files`, `status`) VALUES ('$token', '$file_name', '$status')";
                // echo $insert; exit;
                $res_ins = mysqli_query($con, $insert);
                
                if ($res_ins)
                {
                    echo "
            			<script LANGUAGE='JavaScript'>;
                    		window.alert('File Uploaded Successfully');
                            window.location.href='drive.php'; 
                          </script>
            		";
                }
                else
                {
                    echo ("<script LANGUAGE='JavaScript'>
                          window.alert('There was an error please try again later');
                          window.location.href='drive.php'; 
                    </script>");
                }
			}
		}
	}
}

if (isset($_POST['upd_drive']))
{
    $token = mysqli_real_escape_string($con, $_POST['token']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $target_dir = "Drive/".$token."/";
    $UploadFile = $_FILES['UploadFile']['name'];
    $target_file = $target_dir . basename($UploadFile);
    
    if (move_uploaded_file($_FILES["UploadFile"]["tmp_name"], $target_file))
	{
		$sel_file = "SELECT * FROM `drive` WHERE `drive_id` = '$id'";
		$res_file = mysqli_query($con, $sel_file);
		$row_file = mysqli_fetch_array($res_file);
		unlink("Drive/".$token."/".$row_file['files']);
		
        $update = "UPDATE `drive` SET `token` = '$token', `files` = '$UploadFile', `status` = '$status' WHERE `drive_id` = '$id'";
        // echo $update; exit;
        $res_upd = mysqli_query($con, $update);
        
        if ($res_upd)
        {
            echo "
    			<script LANGUAGE='JavaScript'>;
            		window.alert('File Updated Successfully');
                    window.location.href='drive.php'; 
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
	    $update = "UPDATE `drive` SET `token` = '$token', `status` = '$status' WHERE `drive_id` = '$id'
	    ";
	   // echo $update; exit;
        $res_upd = mysqli_query($con, $update);
        
        if ($res_upd)
        {
            echo "
    			<script LANGUAGE='JavaScript'>;
            		window.alert('File Data Updated Successfully');
                    window.location.href='drive.php'; 
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

if ( isset($_GET['did']) && isset($_GET['token']) && isset($_GET['file']) )
{
	$id = $_GET['did'];
	$token = $_GET['token'];
	$file = $_GET['file'];

	$delete = "DELETE FROM `drive` WHERE `drive_id` = '$id'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink("Drive/".$token."/".$file);
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('{$file} Deleted Successfully');
            window.location.href='drive.php'; 
          </script>
		";
	}
}
?>