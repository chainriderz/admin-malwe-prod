<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Agent Details</h4>
<?php
if(isset($_GET['aid']))
{
?>
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">EDIT AGENT DETAILS</div>				
					<div class="card-body">
					    <?php
							$sel_ag = "SELECT * FROM `agent` WHERE `agent_id` = '$_GET[aid]'";
							$res_ag = mysqli_query($con, $sel_ag);

							if (mysqli_num_rows($res_ag) > 0)
							{
							    $row_ag = mysqli_fetch_array($res_ag);
						?>
						<form class="add-user-form form-row" method="POST" enctype="multipart/form-data">
							
							<div class="form-group col-md-3">
								<label for="">Name</label>
								<input type="text" class="form-control" name="fname" placeholder="Enter Name" value="<?php echo $row_ag['agent_name']; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label for="">Mobile</label>
								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" value="<?php echo $row_ag['mobile_no']; ?>" placeholder="Enter Mobile" required>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Email</label>
								<input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $row_ag['email']; ?>">
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Date of Birth</label>
								<input type="date" class="form-control" name="dob" value="<?php echo $row_ag['dob']; ?>">
							</div>

							<div class="form-group col-md-1">
								<label for="">Sector</label>
								<input type="text" class="form-control" name="sector" placeholder="Enter Sector" value="<?php echo $row_ag['sector']; ?>">
							</div>

							<div class="form-group col-md-2">
								<label for="">Location</label>
								<input type="text" class="form-control" name="location" placeholder="Enter Location" value="<?php echo $row_ag['location']; ?>">
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Address</label>
								<input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php echo $row_ag['address']; ?>">
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Map</label>
								<!--<input type="text" class="form-control" name="address" placeholder="Enter Address" required>-->
								<textarea class="form-control" name="map" placeholder="Enter <iframe> embed code from Google Maps"><?php echo $row_ag['map']; ?></textarea>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1" <?php if($row_ag['status'] == '1') { echo 'selected'; } ?>>Active</option>
									<option value="2" <?php if($row_ag['status'] == '2') { echo 'selected'; } ?>>Inactive</option>
								</select>
							</div>
							
							
							<?php
							    if(empty($row_ag['kyc_docs']))
							    {
							?>
							<div class="form-group col-md-4">
								<label for="">Upload Document</label>
								<input type="file" name="uploadFiles[]" id="" multiple class="form-control">
							</div>
                            <?php
							    }
							?>
							
							<?php
							    if(!empty($row_ag['kyc_docs']))
							    {
							?>
							<div class="form-group col-md-12">
							    <p><b>KYC Documents:</b></p>
							    <?php
						            $kyc_docs = explode(',', $row_ag['kyc_docs']);
						            foreach ($kyc_docs as $key => $value)
						            {
                                    	$select_kyc = "SELECT * FROM `kyc_upload` WHERE `kyc_id` = '$value' AND `agent_id` = '$_GET[aid]'";
                                    	$res_kyc = mysqli_query($con, $select_kyc);
                                    	
                                    	if(mysqli_num_rows($res_kyc) > 0)
                                    	{
                                    	    $row_kyc = mysqli_fetch_array($res_kyc);
						    ?>
						    <p>
						        <a href="assets/img/agent/<?php echo $row_ag['email']; ?>/<?php echo $row_kyc['kyc_doc']; ?>" class="mr-2" target="_blank">
						            <?php echo $row_kyc['kyc_doc']; ?>
						        </a>
						        <a href="agent.php?aid=<?php echo $row_ag['agent_id']; ?>&delete_kyc=<?php echo $row_kyc['kyc_id']; ?>" class="btn-sm btn-danger" onclick="confirmdelete(this.href, event)"><i class="fa fa-trash text-white" aria-hidden="true"></i></a>
						    </p>
						    <?php
                                    	}
                                    }
                                ?>
                                    <p>
    							        Add More Files
    							        <a href="#" class="btn-sm btn-success" id="get_file">
    							            <i class="fa fa-plus text-white" aria-hidden="true"></i>
    							        </a>
    							        <input type="file" name="uploadFiles[]" id="my_file" multiple style="visibility:hidden;">
    							    </p>
							</div>
							<?php
						        }
						    ?>
							
							<div class="form-group col-md-12">
							    <button type="submit" name="upd_agent" class="btn btn-success">SUBMIT</button>
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
					    <div class="text-center">
					        <div class="float-left">
					            <button class="btn btn-success" data-toggle="modal" data-target="#modalAddNew">Add New</button>
					        </div>
					    
    					    <div class="float-right">
    					        <button class="btn btn-success" type="button" onclick="exporttoexcelAgent()" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download</button>
    					    </div>
    					</div>
					</div>				
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>DOB</th>
										<th>Sector</th>
										<th>Location</th>
										<th>Address</th>
										<th>Map</th>
										<th class="d-none">Uploads</th>
										<th>Status</th>
										<th class="noExl">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sel_ag = "SELECT * FROM `agent` ORDER BY `agent_id` DESC";
										$res_ag = mysqli_query($con, $sel_ag);

										if (mysqli_num_rows($res_ag) > 0)
										{
											$stsr = 1;
											while($row_ag = mysqli_fetch_array($res_ag))
											{
									?>
									<tr>
										<td><?php echo $stsr; ?></td>
										<td><?php echo $row_ag["agent_name"]; ?></td>
										<td><a href="tel:+91<?php echo $row_ag["mobile_no"] ?>">+91 <?php echo $row_ag["mobile_no"]; ?></a></td>
										<td><a href="mailto:<?php echo $row_ag["email"] ?>"><?php echo $row_ag["email"]; ?></a></td>
										<td>
										    <?php 
										        if( $row_ag["dob"] != 0)
										        {
										            echo $row_ag["dob"];
										        }
										    ?>
										</td>
										<td><?php echo $row_ag["sector"]; ?></td>
										<td><?php echo $row_ag["location"]; ?></td>
										<td><?php echo $row_ag["address"]; ?></td>
										<td><?php echo $row_ag["map"]; ?></td>
										<td class="d-none">
										    <?php
                            			        $kyc_docs = explode(',', $row_ag['kyc_docs']);
                            			        
                            			        foreach ($kyc_docs as $key => $value)
                            			        {
                                                	$select_file = "SELECT * FROM `kyc_upload` WHERE `kyc_id` = '$value'";
                                                	$result_file = mysqli_query($con, $select_file);
                                                	
                                                	if(mysqli_num_rows($result_file) > 0)
                                                	{
                                                	    while($row_file = mysqli_fetch_array($result_file))
                                                	    {
                                                	        ?>
                                			                <p><a href="http://malwe.online/Admin/assets/img/agent/<?php echo $row_ag['email'] ?>/<?php echo $row_file['kyc_doc']; ?>" target="_blank"><?php echo $row_file['kyc_doc']; ?></a></p>
                                			                <?php
                                                	    }
                                                	}
                                                }
                            			    ?>
										</td>
										<td>
											<?php
											if ($row_ag["status"] == '1') { echo 'Active'; }
											else { echo 'Inactive'; }
											?>
											<!-- <select class="form-control" onchange="updateSTStatus(this.value, <?php echo $row_ag["uid"] ?>)">
												<option value="1" <?php if ($row_ag["status"] == '1') { echo 'selected'; } ?> >Active</option>
												<option value="2" <?php if ($row_ag["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
											</select> -->
											
										</td>
										<td class="noExl">
										    <a href="#" data-toggle="modal" data-target="#modalView_<?php echo $row_ag["agent_id"]; ?>" class="btn-sm text-light mx-1 bg-info">
        										<i class="fa fa-eye" aria-hidden="true"></i>
        									</a>
											<a href="agent.php?aid=<?php echo $row_ag["agent_id"]; ?>" class="btn btn-sm btn-success">
						                		<i class="fa fa-pencil" aria-hidden="true"></i>
						                	</a>
						                	<a agent_id="<?php echo $row_ag["agent_id"]; ?>" href="#" onclick="deleteagent($(this).attr('agent_id'));" class="btn btn-sm btn-danger">
						                		<i class="fa fa-trash" aria-hidden="true"></i>
						                	</a>
										</td>
									</tr>
									<?php
											$stsr++;
									?>
									<div class="modal fade" id="modalView_<?php echo $row_ag["agent_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
                                    	<div class="modal-dialog modal-dialog-centered" role="document">
                                    		<div class="modal-content">
                                    			<div class="modal-header bg-primary">
                                    				<h6 class="modal-title">View Document</h6>
                                    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    					<span aria-hidden="true" class="text-light">&times;</span>
                                    				</button>
                                    			</div>
                                    			<div class="modal-body">
                                    			    <?php
                                    			        $kyc_docs = explode(',', $row_ag['kyc_docs']);
                                    			        
                                    			        foreach ($kyc_docs as $key => $value)
                                    			        {
                                                        	$select_file = "SELECT * FROM `kyc_upload` WHERE `kyc_id` = '$value'";
                                                        	$result_file = mysqli_query($con, $select_file);
                                                        	
                                                        	if(mysqli_num_rows($result_file) > 0)
                                                        	{
                                                        	    while($row_file = mysqli_fetch_array($result_file))
                                                        	    {
                                                        	        ?>
                                        			                <p><a href="assets/img/agent/<?php echo $row_ag['email'] ?>/<?php echo $row_file['kyc_doc']; ?>" target="_blank"><?php echo $row_file['kyc_doc']; ?></a></p>
                                        			                <?php
                                                        	    }
                                                        	}
                                                        }
                                    			    ?>
                                        			
                                        			<p class="text-center">
                                        			<?php
                                        			    if( empty($row_ag['kyc_docs']) )
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
		
		<table class="table table-bordered agent_data d-none">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Name</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>DOB</th>
					<th>Sector</th>
					<th>Location</th>
					<th>Address</th>
					<th>Map</th>
					<th class="d-none">Uploads</th>
					<th>Status</th>
					<th class="noExl">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sel_ag = "SELECT * FROM `agent`";
					$res_ag = mysqli_query($con, $sel_ag);

					if (mysqli_num_rows($res_ag) > 0)
					{
						$stsr = 1;
						while($row_ag = mysqli_fetch_array($res_ag))
						{
				?>
				<tr>
					<td><?php echo $stsr; ?></td>
					<td><?php echo $row_ag["agent_name"]; ?></td>
					<td><a href="tel:+91<?php echo $row_ag["mobile_no"] ?>">+91 <?php echo $row_ag["mobile_no"]; ?></a></td>
					<td><a href="mailto:<?php echo $row_ag["email"] ?>"><?php echo $row_ag["email"]; ?></a></td>
					<td>
					    <?php 
					        if( $row_ag["dob"] != 0)
					        {
					            echo $row_ag["dob"];
					        }
					    ?>
					</td>
					<td><?php echo $row_ag["sector"]; ?></td>
					<td><?php echo $row_ag["location"]; ?></td>
					<td><?php echo $row_ag["address"]; ?></td>
					<td><?php echo $row_ag["map"]; ?></td>
					<td class="d-none">
					    <?php
        			        $kyc_docs = explode(',', $row_ag['kyc_docs']);
        			        
        			        foreach ($kyc_docs as $key => $value)
        			        {
                            	$select_file = "SELECT * FROM `kyc_upload` WHERE `kyc_id` = '$value'";
                            	$result_file = mysqli_query($con, $select_file);
                            	
                            	if(mysqli_num_rows($result_file) > 0)
                            	{
                            	    while($row_file = mysqli_fetch_array($result_file))
                            	    {
                            	        ?>
            			                <p><a href="http://malwe.online/Admin/assets/img/agent/<?php echo $row_ag['email'] ?>/<?php echo $row_file['kyc_doc']; ?>" target="_blank"><?php echo $row_file['kyc_doc']; ?></a></p>
            			                <?php
                            	    }
                            	}
                            }
        			    ?>
					</td>
					<td>
						<?php
						if ($row_ag["status"] == '1') { echo 'Active'; }
						else { echo 'Inactive'; }
						?>
						<!-- <select class="form-control" onchange="updateSTStatus(this.value, <?php echo $row_ag["uid"] ?>)">
							<option value="1" <?php if ($row_ag["status"] == '1') { echo 'selected'; } ?> >Active</option>
							<option value="2" <?php if ($row_ag["status"] == '2') { echo 'selected'; } ?> >Inactive</option>
						</select> -->
						
					</td>
					<td class="noExl">
					    <a href="#" data-toggle="modal" data-target="#modalView_<?php echo $row_ag["agent_id"]; ?>" class="btn-sm text-light mx-1 bg-info">
							<i class="fa fa-eye" aria-hidden="true"></i>
						</a>
						<a href="agent.php?aid=<?php echo $row_ag["agent_id"]; ?>" class="btn btn-sm btn-success">
	                		<i class="fa fa-pencil" aria-hidden="true"></i>
	                	</a>
	                	<a agent_id="<?php echo $row_ag["agent_id"]; ?>" href="#" onclick="deleteagent($(this).attr('agent_id'));" class="btn btn-sm btn-danger">
	                		<i class="fa fa-trash" aria-hidden="true"></i>
	                	</a>
					</td>
				</tr>
				<?php
						$stsr++;
				?>
				<div class="modal fade" id="modalView_<?php echo $row_ag["agent_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
                	<div class="modal-dialog modal-dialog-centered" role="document">
                		<div class="modal-content">
                			<div class="modal-header bg-primary">
                				<h6 class="modal-title">View Document</h6>
                				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                					<span aria-hidden="true" class="text-light">&times;</span>
                				</button>
                			</div>
                			<div class="modal-body">
                			    <?php
                			        $kyc_docs = explode(',', $row_ag['kyc_docs']);
                			        
                			        foreach ($kyc_docs as $key => $value)
                			        {
                                    	$select_file = "SELECT * FROM `kyc_upload` WHERE `kyc_id` = '$value'";
                                    	$result_file = mysqli_query($con, $select_file);
                                    	
                                    	if(mysqli_num_rows($result_file) > 0)
                                    	{
                                    	    while($row_file = mysqli_fetch_array($result_file))
                                    	    {
                                    	        ?>
                    			                <p><a href="assets/img/agent/<?php echo $row_ag['email'] ?>/<?php echo $row_file['kyc_doc']; ?>" target="_blank"><?php echo $row_file['kyc_doc']; ?></a></p>
                    			                <?php
                                    	    }
                                    	}
                                    }
                			    ?>
                    			
                    			<p class="text-center">
                    			<?php
                    			    if( empty($row_ag['kyc_docs']) )
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
<?php
}
?>		
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAddNew" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<!--<h6 class="modal-title"><i class="la la-frown-o"></i>Logout Message</h6>-->
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">									
				<div class="row">
				    <div class="col-md-12">
        				<div class="card mb-2">
        					<div class="card-header font-weight-bold text-uppercase">ADD AGENT DETAILS</div>				
        					<div class="card-body">
        						<form class="add-user-form form-row" method="POST" enctype="multipart/form-data">
        							
        							<div class="form-group col-md-3">
        								<label for="">Name</label>
        								<input type="text" class="form-control" name="fname" placeholder="Enter Name" required>
        							</div>
        
        							<div class="form-group col-md-3">
        								<label for="">Mobile</label>
        								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" placeholder="Enter Mobile" required>
        							</div>
        							
        							<div class="form-group col-md-3">
        								<label for="">Email</label>
        								<input type="email" class="form-control" name="email" placeholder="Enter Email">
        							</div>
        							
        							<div class="form-group col-md-3">
        								<label for="">Date of Birth</label>
        								<input type="date" class="form-control" name="dob">
        							</div>
        
        							<div class="form-group col-md-4">
        								<label for="">Sector</label>
        								<input type="text" class="form-control" name="sector" placeholder="Enter Sector">
        							</div>
        
        							<div class="form-group col-md-4">
        								<label for="">Location</label>
        								<input type="text" class="form-control" name="location" placeholder="Enter Location">
        							</div>
        							
        							<div class="form-group col-md-4">
        								<label for="">Address</label>
        								<input type="text" class="form-control" name="address" placeholder="Enter Address">
        							</div>
        							
        							<div class="form-group col-md-12">
        								<label for="">Map</label>
        								<!--<input type="text" class="form-control" name="address" placeholder="Enter Address" required>-->
        								<textarea class="form-control" name="map" placeholder="Enter <iframe> embed code from Google Maps"></textarea>
        							</div>
        							
        							<div class="form-group col-md-6">
        								<label for="">Upload Document</label>
        								<input type="file" name="uploadFiles[]" id="" multiple class="form-control">
        							</div>
        
        							<div class="form-group col-md-6">
        								<label for="">Status</label>
        								<select class="form-control" name="status">
        									<option value="1">Active</option>
        									<option value="2">Inactive</option>
        								</select>
        							</div>
        							<div class="smsg"></div>
        							<div class="form-group">
        							    <button type="submit" name="add_agent" class="btn btn-success w-100">SUBMIT</button>
        							</div>
        
        						</form>
        					</div>
        				</div>
        			</div>
				</div>
			</div>
			<!--<div class="modal-footer">-->
			<!--	<a href="?logout" class="btn btn-success">OK</a>-->
			<!--	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
			<!--</div>-->
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
	$(".sidebar .nav .add_agent").addClass("active");
	
	document.getElementById('get_file').onclick = function(e)
	{
	    e.preventDefault();
        document.getElementById('my_file').click();
    };
    
    function confirmdelete(url, event)
    {
        event.preventDefault();
        if (confirm('Are you sure you want to delete ?') === true)
        {
            window.location.href = url;
        }
        
    }
</script>

<?php
if (isset($_POST['add_agent']))
{
	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	$sector = mysqli_real_escape_string($con, $_POST['sector']);
	$location = mysqli_real_escape_string($con, $_POST['location']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$map = mysqli_real_escape_string($con, $_POST['map']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	
	$uploadFiles = implode(",", $_FILES['uploadFiles']['name']);
	$uploadFiles_tmp = implode(",", $_FILES['uploadFiles']['tmp_name']);
	$up_Files_tmp = explode(",", $uploadFiles_tmp);

	mkdir('assets/img/agent/'.$email.'/');
	$target_dir = 'assets/img/agent/'.$email.'/';

	$docfiles = array();
	$upload_last_id = array();

	$select = "SELECT * FROM `agent` WHERE (`email` = '$email' AND `email` != '') OR `mobile_no` = '$mobile'";
// 	echo $select; exit;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Agent Already Exists!');
        		window.location.href=''; 
              </script>
		";
	}
	else
	{
	    if(!empty($uploadFiles))
	    {
    	   // $docs = implode(',',$docfiles);
    		$insert = "INSERT INTO `agent` (`agent_name`, `mobile_no`, `email`, `sector`, `location`, `address`, `map`, `dob`, `status`) VALUES ('$fname', '$mobile', '$email','$sector','$location','$address','$map', '$dob', '$status')";
    		$res_ins = mysqli_query($con, $insert);
    
    		if ($res_ins)
    		{
    		    $last_id = mysqli_insert_id($con);
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
                	$ins_file = "INSERT INTO `kyc_upload`(`agent_id`, `agent_name`, `kyc_doc`) VALUES ('$last_id', '$fname', '$file_name')";
                	$res_ins_file = mysqli_query($con, $ins_file);
                	if ($res_ins_file)
                	{
                	    $upload_last_id[] = mysqli_insert_id($con);
                	}
                }
                
                $docs = implode(',',$upload_last_id);
                $upd_agent = "UPDATE `agent` SET `kyc_docs` = '$docs' WHERE `agent_id` = '$last_id'";
        	    $res_upd = mysqli_query($con, $upd_agent);
        	    if($res_upd)
        	    {
        			echo "
        				<script LANGUAGE='JavaScript'>;
        	        		window.alert('Agent Created Successfully');
        	                window.location.href='agent.php'; 
        	              </script>
        			";
        	    }
    		}
    		else
    		{
    			echo ("<script LANGUAGE='JavaScript'>
    	              window.alert('There was an error please try again later');
    	              window.location.href='agent.php'; 
    	        </script>");
    		}
	    }
	    else
	    {
	        $insert = "INSERT INTO `agent` (`agent_name`, `mobile_no`, `email`, `sector`, `location`, `address`, `map`, `dob`, `status`) VALUES ('$fname', '$mobile', '$email','$sector','$location','$address','$map', '$dob', '$status')";
    		$res_ins = mysqli_query($con, $insert);
    		
    		if ($res_ins)
    		{
    		    echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Agent Created Successfully');
    	                window.location.href='agent.php'; 
    	              </script>
    			";
    		}
    		else
    		{
    			echo ("<script LANGUAGE='JavaScript'>
    	              window.alert('There was an error please try again later');
    	              window.location.href='agent.php'; 
    	        </script>");
    		}
	    }
	}
}

if (isset($_POST['upd_agent']))
{
	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	$sector = mysqli_real_escape_string($con, $_POST['sector']);
	$location = mysqli_real_escape_string($con, $_POST['location']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$map = mysqli_real_escape_string($con, $_POST['map']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	
	$uploadFiles = implode(",", $_FILES['uploadFiles']['name']);
	$uploadFiles_tmp = implode(",", $_FILES['uploadFiles']['tmp_name']);
	$up_Files_tmp = explode(",", $uploadFiles_tmp);
	
	$target_dir = 'assets/img/agent/'.$email.'/';
	
	if(!empty($email))
	{
	    $select = "SELECT * FROM `agent` WHERE (`email` = '$email' OR `mobile_no` = '$mobile') AND (`agent_id` != '$_GET[aid]')";
	}
	else
	{
	    $select = "SELECT * FROM `agent` WHERE (`mobile_no` = '$mobile') AND (`agent_id` != '$_GET[aid]')";
	}

// 	$select = "SELECT * FROM `agent` WHERE (`email` = '$email' OR `mobile_no` = '$mobile') AND (`agent_id` != '$_GET[aid]')";
// 	echo $select; exit;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Agent Email or Mobile Already Exists!');
        		window.location.href=''; 
              </script>
		";
	}
	else
	{
	    if(empty($uploadFiles))
	    {
	        $upd_agent = "UPDATE `agent` SET `agent_name`='$fname',`mobile_no`='$mobile',`email`='$email',`sector`='$sector',`location`='$location',`address`='$address',`map`='$map',`dob`='$dob',`status`='$status' WHERE `agent_id` = '$_GET[aid]'";
	        $res_upd_agent = mysqli_query($con, $upd_agent);
	        if($res_upd_agent)
    	    {
    			echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Agent Updated Successfully');
    	                window.location.href='agent.php'; 
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
	       // $upd_agent = "UPDATE `agent` SET `agent_name`='$fname',`mobile_no`='$mobile',`email`='$email',`sector`='$sector',`location`='$location',`address`='$address',`map`='$map',`dob`='$dob',`kyc_docs`='$status',`status`='$status' WHERE `agent_id` = '$_GET[aid]'";
	       // $res_upd_agent = mysqli_query($con, $upd_agent);
	       //echo $upd_agent;

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
        		      //  echo "{$file_name} successfully uploaded <br />";
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
            	$ins_file = "INSERT INTO `kyc_upload`(`agent_id`, `agent_name`, `kyc_doc`) VALUES ('$_GET[aid]', '$fname', '$file_name')";
            	$res_ins_file = mysqli_query($con, $ins_file);
            	if ($res_ins_file)
            	{
            	    $upload_last_id[] = mysqli_insert_id($con);
            	}
            }
            
            $docs = implode(',',$upload_last_id);
            $upd_agent = "UPDATE `agent` SET `kyc_docs` = IF(`kyc_docs` = '', CONCAT( `kyc_docs`, '$docs' ), CONCAT( `kyc_docs`, ',', '$docs' )) WHERE `agent_id` = '$_GET[aid]'";
            // echo $upd_agent;exit;
    	    $res_upd = mysqli_query($con, $upd_agent);
    	    if($res_upd)
    	    {
    			echo "
    				<script LANGUAGE='JavaScript'>;
    	        		window.alert('Agent Updated Successfully');
    	                window.location.href='agent.php'; 
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
}

if ( isset($_GET['delete_kyc']) && isset($_GET['aid']) )
{
    $aid = $_GET['aid'];
    $did = $_GET['delete_kyc'];
    
    $del_kyc = "UPDATE `agent` SET `kyc_docs` = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', `kyc_docs`, ','), ',$did,', ',')) WHERE FIND_IN_SET('$did', `kyc_docs`) AND `agent_id` = '$aid'";
    // echo $del_kyc;exit;
    $res_del_kyc = mysqli_query($con, $del_kyc);
    
    if($res_del_kyc)
    {
        $sel_agent = "SELECT * FROM `agent` WHERE `agent_id` = '$aid'";
        $res_sel_agent = mysqli_query($con, $sel_agent);
        $row_sel_agent = mysqli_fetch_array($res_sel_agent);
        
        $sel_kyc_d = "SELECT * FROM `kyc_upload` WHERE `kyc_id` = '$did'";
        $res_sel_kyc_d = mysqli_query($con, $sel_kyc_d);
        $row_sel_kyc_d = mysqli_fetch_array($res_sel_kyc_d);
        
        $del_kyc_d = "DELETE FROM `kyc_upload` WHERE `kyc_id` = '$did'";
        $res_del_kyc_d = mysqli_query($con, $del_kyc_d);
        
        unlink('assets/img/agent/'.$row_sel_agent['email'].'/'.$row_sel_kyc_d['kyc_doc']);

        echo ("<script LANGUAGE='JavaScript'>
              window.alert('File Deleted Successfully');
              window.location.href='agent.php?aid=".$aid."'; 
        </script>");
        exit;
    }
    else
	{
		echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='agent.php?aid=".$aid."'; 
        </script>");
	}
}
?>