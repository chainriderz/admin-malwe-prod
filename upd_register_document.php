<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Registered Document Data</h4>
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Update Details
						<a href="index1.php" class="close" aria-label="Close" title="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
					</div>				
					<div class="card-body">
						<?php
							if(isset($_GET['rid']))
							{
								$rid = $_GET['rid'];
								$select_reg = "SELECT * FROM `registered_document` WHERE `reg_id` = '$rid'";
								$res_reg = mysqli_query($con, $select_reg);								
								$row_reg = mysqli_fetch_array($res_reg);

								$reg_id = $row_reg["reg_id"];
								$token = $row_reg["token"];
								$owner_name = $row_reg["owner_name"];
								$owner_mobile = $row_reg["owner_mobile"];
								$owner_dob = $row_reg["owner_dob"];
								$alt_owner_name = $row_reg["alt_owner_name"];
								$alt_owner_mobile = $row_reg["alt_owner_mobile"];
								$alt_owner_dob = $row_reg["alt_owner_dob"];
								$tenant_name = $row_reg["tenant_name"];
								$tenant_mobile = $row_reg["tenant_mobile"];
								$tenant_dob = $row_reg["tenant_dob"];
								$alt_tenant_name = $row_reg["alt_tenant_name"];
								$alt_tenant_mobile = $row_reg["alt_tenant_mobile"];
								$alt_tenant_dob = $row_reg["alt_tenant_dob"];
								$staff_name = $row_reg["staff_name"];
								$agent_name = $row_reg["agent_name"];
								$agreement_start_date = $row_reg["agreement_start_date"];
								$agreement_end_date = $row_reg["agreement_end_date"];
								$flat_no = $row_reg["flat_no"];
								$floor_no = $row_reg["floor_no"];
								$plot_no = $row_reg["plot_no"];
								$bldg_nm = $row_reg["bldg_nm"];
								$sector_no = $row_reg["sector_no"];
								$location = $row_reg["location"];
								$upload_1 = $row_reg["upload_1"];
								$upload_2 = $row_reg["upload_2"];
								$upload_3 = $row_reg["upload_3"];
								$upload_4 = $row_reg["upload_4"];
								$upload_5 = $row_reg["upload_5"];
								$delivery_status = $row_reg["delivery_status"];
								$total_amt = $row_reg["total_amt"];
								$received_amt = $row_reg["received_amt"];
								$challan_amt = $row_reg["challan_amt"];
								$comments = $row_reg["comments"];
								$record_status = $row_reg["record_status"];
								$labels = $row_reg["labels"];
								$folder = $token;
								
								$date1 = '2022-04-01';
                                $date2 = '2023-02-28';
                                $d1=date_create($agreement_start_date); 
                                $d2=date_create($agreement_end_date);
                                $d3 = date_sub($d1,date_interval_create_from_date_string("10 days"));
                                $Months = $d2->diff($d3); 
                                $howeverManyMonths = (($Months->y) * 12) + ($Months->m);
                                
                                // echo $howeverManyMonths;

							?>
						<form class="form text-center" id="update_register" method="POST">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<th width="20%"></th>
										<th width="20%" class="text-center">Token</th>
										<td width="60%"><input type="tel" minlength="14" maxlength="14" id="token_no" onchange="CheckTokenLength(this.value)" onkeyup="CheckToken(this.value, <?php echo $rid; ?>)" onkeypress="return isNumber(event)" name="token" class="form-control border-0" placeholder="Enter Token" value="<?php echo $token; ?>"  required><p id="token_error" class="text-left"></p></td>
									</tr>
									<tr>
										<th rowspan="3" class="text-center">Owner</th>
										<th class="text-center">Name</th>
										<td><input type="text" name="owner_name" class="form-control border-0" placeholder="Enter Owner Name" value="<?php echo $owner_name; ?>" required></td>
									</tr>
									<tr >
										<th class="text-center">Mobile 
											<a target="_blank" href="https://wa.me/91<?php echo $owner_mobile; ?>" class="text-success align-middle" style=" text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
										</th>
										<td>
											<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="owner_mobile" class="form-control border-0" placeholder="Enter Owner Mobile" value="<?php echo $owner_mobile; ?>">
											
										</td>
									</tr>
									<tr>
										<th class="text-center">Date of Birth</th>
										<td><input type="date" name="owner_dob" id="owner_dob" class="form-control border-0" value="<?php echo $owner_dob; ?>"></td>
									</tr>
									<tr>
										<th rowspan="3" class="text-center">2nd Owner</th>
										<th class="text-center">Name</th>
										<td><input type="text" name="alt_owner_name" class="form-control border-0" placeholder="Enter Owner Name" value="<?php echo $alt_owner_name; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Mobile
										<a target="_blank" href="https://wa.me/91<?php echo $alt_owner_mobile; ?>" class="text-success align-middle" style=" text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
										</th>
										<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="alt_owner_mobile" class="form-control border-0" placeholder="Enter Owner Mobile" value="<?php echo $alt_owner_mobile; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Date of Birth</th>
										<td><input type="date" name="alt_owner_dob" id="alt_owner_dob" class="form-control border-0" value="<?php echo $alt_owner_dob; ?>"></td>
									</tr>
									<tr>
										<th rowspan="3" class="text-center">Tenant</th>
										<th class="text-center">Name</th>
										<td><input type="text" name="tenant_name" class="form-control border-0" placeholder="Enter Tenant Name" value="<?php echo $tenant_name; ?>" required></td>
									</tr>
									<tr>
										<th class="text-center">Mobile
											<a target="_blank" href="https://wa.me/91<?php echo $tenant_mobile; ?>" class="text-success align-middle" style=" text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
										</th>
										<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="tenant_mobile" class="form-control border-0" placeholder="Enter Tenant Mobile" value="<?php echo $tenant_mobile; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Date of Birth</th>
										<td><input type="date" name="tenant_dob" id="tenant_dob" class="form-control border-0" value="<?php echo $tenant_dob; ?>"></td>
									</tr>
									<tr>
										<th rowspan="3" class="text-center">2nd Tenant</th>
										<th class="text-center">Name</th>
										<td><input type="text" name="alt_tenant_name" class="form-control border-0" placeholder="Enter Tenant Name" value="<?php echo $alt_tenant_name; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Mobile
											<a target="_blank" href="https://wa.me/91<?php echo $alt_tenant_mobile; ?>" class="text-success align-middle" style=" text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
										</th>
										<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="alt_tenant_mobile" class="form-control border-0" placeholder="Enter Tenant Mobile" value="<?php echo $alt_tenant_mobile; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Date of Birth</th>
										<td><input type="date" name="alt_tenant_dob" id="alt_tenant_dob" class="form-control border-0" value="<?php echo $alt_tenant_dob; ?>"></td>
									</tr>
									<tr>
										<th rowspan="2" class="text-center">Name</th>
										<th class="text-center">Staff</th>
										<td>
										    <!--<input type="text" name="staff_name" class="form-control border-0" placeholder="Enter Staff Name" value="<?php echo $staff_name; ?>" required>-->
										    <select name="staff_name" class="form-control border-0" id="setStaff">
									        <?php
									            if(empty($staff_name))
									            {
									                $sel_staff = "SELECT * FROM `staff` WHERE `status` = '1'";
    									            $res_staff = mysqli_query($con, $sel_staff);
    									            
    									            if(mysqli_num_rows($res_staff) > 0)
    									            {
    									                while($row_staff = mysqli_fetch_array($res_staff))
    									                {
									        ?>
									            <option value="<?php echo $row_staff['sid']; ?>"><?php echo $row_staff['name']; ?></option>
									        <?php
    									                }
    									            }
									            }
									            else
									            {
    									            $sel_staff = "SELECT * FROM `staff` WHERE `status` = '1'";
    									            $res_staff = mysqli_query($con, $sel_staff);
    									            
    									            if(mysqli_num_rows($res_staff) > 0)
    									            {
    									                while($row_staff = mysqli_fetch_array($res_staff))
    									                {
									        ?>
									        <option value="<?php echo $row_staff['sid']; ?>" <?php if($staff_name == $row_staff['sid']){ echo 'selected'; } ?>><?php echo $row_staff['name']; ?></option>
									        <?php
    									                }
    									            }
									            }
									        ?>
									        </select>
										</td>
									</tr>
									<tr>
										<th class="text-center">Agent</th>
										<td>
										    <!--<input type="text" name="agent_name" class="form-control border-0" placeholder="Enter Agent Name" value="<?php echo $agent_name; ?>">-->
										    <select name="agent_name" class="form-control border-0" id="setAgent">
									        <?php
									            if(empty($agent_name))
									            {
									                $sel_agent = "SELECT * FROM `agent` WHERE `status` = '1'";
    									            $res_agent = mysqli_query($con, $sel_agent);
    									            
    									            if(mysqli_num_rows($res_agent) > 0)
    									            {
    									                while($row_agent = mysqli_fetch_array($res_agent))
    									                {
									        ?>
									            <option value="<?php echo $row_agent['agent_id']; ?>"><?php echo $row_agent['agent_name']; ?></option>
									        <?php
    									                }
    									            }
									            }
									            else
									            {
    									            $sel_agent = "SELECT * FROM `agent` WHERE `status` = '1'";
    									            $res_agent = mysqli_query($con, $sel_agent);
    									            
    									            if(mysqli_num_rows($res_agent) > 0)
    									            {
    									                while($row_agent = mysqli_fetch_array($res_agent))
    									                {
									        ?>
									        <option value="<?php echo $row_agent['agent_id']; ?>" <?php if($agent_name == $row_agent['agent_id']){ echo 'selected'; } ?>><?php echo $row_agent['agent_name']; ?></option>
									        <?php
    									                }
    									            }
									            }
									        ?>
									        </select>
										</td>
									</tr>
									<tr>
										<th rowspan="3" class="text-center">Agreement Date</th>
										<th class="text-center">Start Date</th>
										<td><input type="date" name="agreement_start_date" id="agreement_start_date" class="form-control border-0" value="<?php echo $agreement_start_date; ?>" required></td>
									</tr>
									<tr>
										<th class="text-center">Enter Months</th>
										<td><input type="number" min="1" placeholder="Enter Months" id="select_months" class="form-control border-0" value="<?php echo $howeverManyMonths; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">End Date</th>
										<td><input type="date" name="agreement_end_date" id="agreement_end_date" class="form-control border-0" value="<?php echo $agreement_end_date; ?>" required></td>
									</tr>
									<tr>
										<th rowspan="6" class="text-center">Address</th>
										<th class="text-center">Flat #</th>
										<td><input type="text" name="flat_no" class="form-control border-0" placeholder="Enter Flat No" value="<?php echo $flat_no; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Floor</th>
										<td><input type="text" name="floor_no" class="form-control border-0" placeholder="Enter Floor No" value="<?php echo $floor_no; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Plot</th>
										<td><input type="text" name="plot_no" class="form-control border-0" placeholder="Enter Plot No" value="<?php echo $plot_no; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Bldg Name.</th>
										<td><input type="text" name="bldg_nm" class="form-control border-0" placeholder="Enter Building No" value="<?php echo $bldg_nm; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Sector</th>
										<td><input type="text" name="sector_no" class="form-control border-0" placeholder="Enter Sector No" value="<?php echo $sector_no; ?>"></td>
									</tr>
									<tr>
										<th class="text-center">Location</th>
										<td><input type="text" name="location" class="form-control border-0" placeholder="Enter Location" value="<?php echo $location; ?>" required></td>
									</tr>
									<tr>
										<th class="text-center">Uploads</th>
										<th class="text-center">(5 PDF Docs Optional)</th>
										<td>
											<div class="mb-4 text-left">
												<?php
											        if(!empty($upload_1))
											        {
											    ?>
												<a href="../Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_1; ?>" target="_blank"><?php echo $upload_1; ?></a>
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
												<span>Add PDF File</span>
												<a href="#" data-toggle="modal" data-target="#modalUpload_1" class="btn-sm text-light mx-1 bg-success">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<?php
											        }
											    ?>
											</div>

											<div class="mb-4 text-left">
												<?php
											        if(!empty($upload_2))
											        {
											    ?>
												<a href="../Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_2; ?>" target="_blank"><?php echo $upload_2; ?></a>
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
												<span>Add PDF File</span>
												<a href="#" data-toggle="modal" data-target="#modalUpload_2" class="btn-sm text-light mx-1 bg-success">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<?php
											        }
											    ?>
											</div>

											<div class="mb-4 text-left">
												<?php
											        if(!empty($upload_3))
											        {
											    ?>
												<a href="../Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_3; ?>" target="_blank"><?php echo $upload_3; ?></a>
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
												<span>Add PDF File</span>
												<a href="#" data-toggle="modal" data-target="#modalUpload_3" class="btn-sm text-light mx-1 bg-success">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<?php
											        }
											    ?>
											</div>

											<div class="mb-4 text-left">
												<?php
											        if(!empty($upload_4))
											        {
											    ?>
												<a href="../Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_4; ?>" target="_blank"><?php echo $upload_4; ?></a>
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
												<span>Add PDF File</span>
												<a href="#" data-toggle="modal" data-target="#modalUpload_4" class="btn-sm text-light mx-1 bg-success">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<?php
											        }
											    ?>
											</div>

											<div class="mb-4 text-left">
											    <?php
											        if(!empty($upload_5))
											        {
											    ?>
												<a href="../Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_5; ?>" target="_blank"><?php echo $upload_5; ?></a>
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
												<span>Add PDF File</span>
												<a href="#" data-toggle="modal" data-target="#modalUpload_5" class="btn-sm text-light mx-1 bg-success">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<?php
											        }
											    ?>
											</div>
										</td>
									</tr>
									<tr>
            						    <th rowspan="3" class="text-center">Amount</th>
            							<th class="text-center">Quotation Amount</th>
            							<td><input type="tel" name="total_amt" onkeypress="return isNumber(event)" class="form-control border-0" placeholder="Enter Amount without ',' and '/-'" value="<?php if(!empty($total_amt)){ echo $total_amt; } ?>"></td>
            						</tr>
            						<tr>
            							<th class="text-center">Received Amount</th>
            							<td><input type="tel" name="received_amt" onkeypress="return isNumber(event)" class="form-control border-0" placeholder="Enter Amount without ',' and '/-'" value="<?php if(!empty($received_amt)){ echo $received_amt; } ?>"></td>
            						</tr>
    								<tr>
    									<th class="text-center">Challan Amount</th>
    									<td><input type="tel" name="challan_amt" onkeypress="return isNumber(event)" class="form-control border-0" placeholder="Enter Challan Amount without ',' and '/-'" value="<?php if(!empty($challan_amt)){ echo $challan_amt; } ?>"></td>
    								</tr>
									<tr>
										<th class="text-center">Comments</th>
										<td colspan="2"><textarea name="comments" class="form-control border-0" placeholder="Enter Comments"><?php echo $comments; ?></textarea></td>
									</tr>
									<tr>
										<th class="text-center">Delivery Status</th>
										<td colspan="2" class="text-left">
										    <select class="form-control border-0" name="deli_status">
										        <?php
										            $sel_deli = "SELECT * FROM `delivery_status`";
										            $res_deli = mysqli_query($con, $sel_deli);
										            if(mysqli_num_rows($res_deli) > 0)
										            {
										                while($row_deli = mysqli_fetch_array($res_deli))
										                {
										        ?>
										        <option value="<?php echo $row_deli['del_status']; ?>" <?php if($delivery_status == $row_deli['del_status']) { echo 'selected'; } ?>><?php echo $row_deli['del_status']; ?></option>
    											<?php
										                }
										            }
										        ?>
    										</select>
										</td>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<td colspan="2">
											<select class="form-control border-0" name="status">
											    <?php
    										        $sel_rec = "SELECT * FROM `record_status`";
    										        $res_rec = mysqli_query($con, $sel_rec);
    										        if(mysqli_num_rows($res_rec) > 0)
    										        {
    										            while($row_rec = mysqli_fetch_array($res_rec))
    										            {
    										    ?>
    											<option value="<?php echo $row_rec['status']; ?>" <?php if($record_status == $row_rec['status']) { echo 'selected';} ?> ><?php echo $row_rec['status']; ?></option>
    											<?php
    										            }
    										        }
    										    ?>
												
											</select>
										</td>
									</tr>
									<tr>
									<th class="text-center">Labels</th>
										<td colspan="2">
											<select class="form-control border-0" name="labels">
												<option value="">Select</option>
											    <?php
											        $sel_rec = "SELECT * FROM `labels`";
											        $res_rec = mysqli_query($con, $sel_rec);
											        if(mysqli_num_rows($res_rec) > 0)
											        {
											            while($row_rec = mysqli_fetch_array($res_rec))
											            {
											    ?>
												<option value="<?php echo $row_rec['name']; ?>" <?php if($labels == $row_rec['name']) { echo 'selected';} ?> ><?php echo $row_rec['name']; ?></option>
												<?php
											            }
											        }
											    ?>
											</select>
										</td>
									</tr>
								</table>
							</div>
							<button type="submit" name="upd_register" id="upd_register_btn" class="btn btn-success w-25 font-weight-bold">UPDATE</button>
						</form>
						<?php
							}
						?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php include("footer.php"); ?>
<script>
    $(document).ready(function()
    {
      // Initialize select2
      $("#setStaff").select2();
      $("#setAgent").select2();
    });
</script>
<!--UPDATE PDF DOCUMENTS-->

<!-- Modal -->
<div class="modal fade" id="modalUpload_1" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">Update PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadPDF_1" accept=".pdf" class="form-control" required>
					<span><?php echo $upload_1; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadPDF_1" class="btn btn-success">Upload</button>
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
				<h6 class="modal-title">Update PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadPDF_2" accept=".pdf" class="form-control" required>
					<span><?php echo $upload_2; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadPDF_2" class="btn btn-success">Upload</button>
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
				<h6 class="modal-title">Update PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadPDF_3" accept=".pdf" class="form-control" required>
					<span><?php echo $upload_3; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadPDF_3" class="btn btn-success">Upload</button>
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
				<h6 class="modal-title">Update PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadPDF_4" accept=".pdf" class="form-control" required>
					<span><?php echo $upload_4; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadPDF_4" class="btn btn-success">Upload</button>
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
				<h6 class="modal-title">Update PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">									
					<input type="file" name="uploadPDF_5" accept=".pdf" class="form-control" required>
					<span><?php echo $upload_5; ?></span>
				</div>
				<div class="modal-footer">
					<button type="submit" name="upd_uploadPDF_5" class="btn btn-success">Upload</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!--DELETE PDF DOCUMENTS-->

<div class="modal fade" id="modalDelete_1" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title">Delete PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $upload_1; ?></span> file ?</p>			
					<input type="hidden" name="deletePDF_1" value="<?php echo $upload_1; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadPDF_1" class="btn btn-danger">Delete</button>
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
				<h6 class="modal-title">Delete PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $upload_2; ?></span> file ?</p>			
					<input type="hidden" name="deletePDF_2" value="<?php echo $upload_2; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadPDF_2" class="btn btn-danger">Delete</button>
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
				<h6 class="modal-title">Delete PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $upload_3; ?></span> file ?</p>			
					<input type="hidden" name="deletePDF_3" value="<?php echo $upload_3; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadPDF_3" class="btn btn-danger">Delete</button>
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
				<h6 class="modal-title">Delete PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $upload_4; ?></span> file ?</p>			
					<input type="hidden" name="deletePDF_4" value="<?php echo $upload_4; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadPDF_4" class="btn btn-danger">Delete</button>
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
				<h6 class="modal-title">Delete PDF Document</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-light">&times;</span>
				</button>
			</div>
			<form class="form" method="POST" enctype="multipart/form-data">
				<div class="modal-body text-center">
				    <p>Are you sure you want to delete <span class="font-weight-bold"><?php echo $upload_5; ?></span> file ?</p>			
					<input type="hidden" name="deletePDF_5" value="<?php echo $upload_5; ?>" required>
					
				</div>
				<div class="modal-footer">
					<button type="submit" name="del_uploadPDF_5" class="btn btn-danger">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
if (isset($_POST['upd_register']))
{
	$token = mysqli_real_escape_string($con, $_POST['token']);
	$owner_name = mysqli_real_escape_string($con, $_POST['owner_name']);
	$owner_mobile = mysqli_real_escape_string($con, $_POST['owner_mobile']);
	$owner_dob = mysqli_real_escape_string($con, $_POST['owner_dob']);
	$alt_owner_name = mysqli_real_escape_string($con, $_POST['alt_owner_name']);
	$alt_owner_mobile = mysqli_real_escape_string($con, $_POST['alt_owner_mobile']);
	$alt_owner_dob = mysqli_real_escape_string($con, $_POST['alt_owner_dob']);
	$tenant_name = mysqli_real_escape_string($con, $_POST['tenant_name']);
	$tenant_mobile = mysqli_real_escape_string($con, $_POST['tenant_mobile']);
	$tenant_dob = mysqli_real_escape_string($con, $_POST['tenant_dob']);
	$alt_tenant_name = mysqli_real_escape_string($con, $_POST['alt_tenant_name']);
	$alt_tenant_mobile = mysqli_real_escape_string($con, $_POST['alt_tenant_mobile']);
	$alt_tenant_dob = mysqli_real_escape_string($con, $_POST['alt_tenant_dob']);
	$staff_name = mysqli_real_escape_string($con, $_POST['staff_name']);
	$agent_name = mysqli_real_escape_string($con, $_POST['agent_name']);
	$agreement_start_date = mysqli_real_escape_string($con, $_POST['agreement_start_date']);
	$agreement_end_date = mysqli_real_escape_string($con, $_POST['agreement_end_date']);
	$flat_no = mysqli_real_escape_string($con, $_POST['flat_no']);
	$floor_no = mysqli_real_escape_string($con, $_POST['floor_no']);
	$plot_no = mysqli_real_escape_string($con, $_POST['plot_no']);
	$bldg_nm = mysqli_real_escape_string($con, $_POST['bldg_nm']);
	$sector_no = mysqli_real_escape_string($con, $_POST['sector_no']);
	$location = mysqli_real_escape_string($con, $_POST['location']);
	$deli_status = mysqli_real_escape_string($con, $_POST['deli_status']);
	$total_amt = mysqli_real_escape_string($con, $_POST['total_amt']);
	$received_amt = mysqli_real_escape_string($con, $_POST['received_amt']);
	$challan_amt = mysqli_real_escape_string($con, $_POST['challan_amt']);
	$comments = mysqli_real_escape_string($con, $_POST['comments']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	$labels = mysqli_real_escape_string($con, $_POST['labels']);
	$timestamp = date('Y-m-d');

    if(empty($deli_status))
    {
    	$update = "UPDATE `registered_document` SET `token`='$token',`owner_name`='$owner_name',`owner_mobile`='$owner_mobile',`owner_dob`='$owner_dob',`alt_owner_name`='$alt_owner_name',`alt_owner_mobile`='$alt_owner_mobile',`alt_owner_dob`='$alt_owner_dob',`tenant_name`='$tenant_name',`tenant_mobile`='$tenant_mobile',`tenant_dob`='$tenant_dob',`alt_tenant_name`='$alt_tenant_name',`alt_tenant_mobile`='$alt_tenant_mobile',`alt_tenant_dob`='$alt_tenant_dob',`staff_name`='$staff_name',`agent_name`='$agent_name',`agreement_start_date`='$agreement_start_date',`agreement_end_date`='$agreement_end_date',`flat_no`='$flat_no',`floor_no`='$floor_no',`plot_no`='$plot_no',`bldg_nm`='$bldg_nm',`sector_no`='$sector_no',`location`='$location',`total_amt`='$total_amt',`received_amt`='$received_amt',`challan_amt`='$challan_amt',`comments`='$comments',`record_status`='$status',`labels`='$labels' WHERE `reg_id` = '$_GET[rid]'";
    	// echo $update; exit;
    
    	$res_upd = mysqli_query($con, $update);
    
    	if ($res_upd)
       {
        //   $upd_usrs = "UPDATE `users` SET `entry_date` = '$timestamp', `fname` = '$owner_name', `mobile` = '$owner_mobile' ";
        //   $res_usrs = mysqli_query($con_dp, $upd_usrs);
          echo "<script language='javascript'>
              window.alert('Details have been updated successfully');
               window.location.href='index1.php'; 
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
    else
    {
        $update = "UPDATE `registered_document` SET `token`='$token',`owner_name`='$owner_name',`owner_mobile`='$owner_mobile',`owner_dob`='$owner_dob',`alt_owner_name`='$alt_owner_name',`alt_owner_mobile`='$alt_owner_mobile',`alt_owner_dob`='$alt_owner_dob',`tenant_name`='$tenant_name',`tenant_mobile`='$tenant_mobile',`tenant_dob`='$tenant_dob',`alt_tenant_name`='$alt_tenant_name',`alt_tenant_mobile`='$alt_tenant_mobile',`alt_tenant_dob`='$alt_tenant_dob',`staff_name`='$staff_name',`agent_name`='$agent_name',`agreement_start_date`='$agreement_start_date',`agreement_end_date`='$agreement_end_date',`flat_no`='$flat_no',`floor_no`='$floor_no',`plot_no`='$plot_no',`bldg_nm`='$bldg_nm',`sector_no`='$sector_no',`location`='$location',`delivery_status`='$deli_status',`total_amt`='$total_amt',`received_amt`='$received_amt',`challan_amt`='$challan_amt',`comments`='$comments',`record_status`='$status',`labels`='$labels' WHERE `reg_id` = '$_GET[rid]'";
    
    	// echo $update; exit;
    
    	$res_upd = mysqli_query($con, $update);
    
    	if ($res_upd)
       {
        //   $upd_usrs = "UPDATE `users` SET `entry_date` = '$timestamp', `fname` = '$owner_name', `mobile` = '$owner_mobile' ";
        //   $res_usrs = mysqli_query($con_dp, $upd_usrs);
          echo "<script language='javascript'>
              window.alert('Details have been updated successfully');
               window.location.href='index1.php'; 
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
}

// UPDATE PDF DOCUMENTS

if (isset($_POST['upd_uploadPDF_1']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$uploadPDF_1 = $_FILES['uploadPDF_1']['name'];
	$target_file_1 = $target_dir . basename($uploadPDF_1);

	// File upload
	if (move_uploaded_file($_FILES["uploadPDF_1"]["tmp_name"], $target_file_1))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_1` FROM `registered_document` WHERE `reg_id` = '$_GET[rid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_1"]);
	}

	$update = "UPDATE `registered_document` SET `upload_1`='$uploadPDF_1' WHERE `reg_id` = '$_GET[rid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('PDF Document updated successfully');
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

if (isset($_POST['upd_uploadPDF_2']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$uploadPDF_2 = $_FILES['uploadPDF_2']['name'];
	$target_file_2 = $target_dir . basename($uploadPDF_2);

	// File upload
	if (move_uploaded_file($_FILES["uploadPDF_2"]["tmp_name"], $target_file_2))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_2` FROM `registered_document` WHERE `reg_id` = '$_GET[rid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_2"]);
	}

	$update = "UPDATE `registered_document` SET `upload_2`='$uploadPDF_2' WHERE `reg_id` = '$_GET[rid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('PDF Document updated successfully');
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

if (isset($_POST['upd_uploadPDF_3']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$uploadPDF_3 = $_FILES['uploadPDF_3']['name'];
	$target_file_3 = $target_dir . basename($uploadPDF_3);

	// File upload
	if (move_uploaded_file($_FILES["uploadPDF_3"]["tmp_name"], $target_file_3))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_3` FROM `registered_document` WHERE `reg_id` = '$_GET[rid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_3"]);
	}

	$update = "UPDATE `registered_document` SET `upload_3`='$uploadPDF_3' WHERE `reg_id` = '$_GET[rid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('PDF Document updated successfully');
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

if (isset($_POST['upd_uploadPDF_4']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$uploadPDF_4 = $_FILES['uploadPDF_4']['name'];
	$target_file_4 = $target_dir . basename($uploadPDF_4);

	// File upload
	if (move_uploaded_file($_FILES["uploadPDF_4"]["tmp_name"], $target_file_4))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_4` FROM `registered_document` WHERE `reg_id` = '$_GET[rid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_4"]);
	}

	$update = "UPDATE `registered_document` SET `upload_4`='$uploadPDF_4' WHERE `reg_id` = '$_GET[rid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('PDF Document updated successfully');
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

if (isset($_POST['upd_uploadPDF_5']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$uploadPDF_5 = $_FILES['uploadPDF_5']['name'];
	$target_file_5 = $target_dir . basename($uploadPDF_5);

	// File upload
	if (move_uploaded_file($_FILES["uploadPDF_5"]["tmp_name"], $target_file_5))
	{
	  	// echo "The file ". htmlspecialchars( basename($simg) ). " has been uploaded.";
	  	$select = "SELECT `upload_5` FROM `registered_document` WHERE `reg_id` = '$_GET[rid]'";
	  	$result = mysqli_query($con, $select);
	  	$row = mysqli_fetch_array($result);

	  	unlink($target_dir.$row["upload_5"]);
	}

	$update = "UPDATE `registered_document` SET `upload_5`='$uploadPDF_5' WHERE `reg_id` = '$_GET[rid]'";

	// echo $update; exit;

	$res_upd = mysqli_query($con, $update);

	if ($res_upd)
   {
      echo "<script language='javascript'>
          window.alert('PDF Document updated successfully');
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

// DELETE PDF DOCUMENTS

if (isset($_POST['del_uploadPDF_1']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$deletePDF_1 = mysqli_real_escape_string($con, $_POST['deletePDF_1']);
	$target_file_1 = $target_dir . $deletePDF_1;

	$delete = "UPDATE `registered_document` SET `upload_1`='' WHERE `reg_id` = '$_GET[rid]'";

// 	echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_1);
      echo "<script language='javascript'>
          window.alert('PDF Document deleted successfully');
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

if (isset($_POST['del_uploadPDF_2']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$deletePDF_2 = mysqli_real_escape_string($con, $_POST['deletePDF_2']);
	$target_file_2 = $target_dir . $deletePDF_2;

	$delete = "UPDATE `registered_document` SET `upload_2`='' WHERE `reg_id` = '$_GET[rid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_2);
      echo "<script language='javascript'>
          window.alert('PDF Document deleted successfully');
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

if (isset($_POST['del_uploadPDF_3']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$deletePDF_3 = mysqli_real_escape_string($con, $_POST['deletePDF_3']);
	$target_file_3 = $target_dir . $deletePDF_3;

	$delete = "UPDATE `registered_document` SET `upload_3`='' WHERE `reg_id` = '$_GET[rid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_3);
      echo "<script language='javascript'>
          window.alert('PDF Document deleted successfully');
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

if (isset($_POST['del_uploadPDF_4']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$deletePDF_4 = mysqli_real_escape_string($con, $_POST['deletePDF_4']);
	$target_file_4 = $target_dir . $deletePDF_4;

	$delete = "UPDATE `registered_document` SET `upload_4`='' WHERE `reg_id` = '$_GET[rid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_4);
      echo "<script language='javascript'>
          window.alert('PDF Document deleted successfully');
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

if (isset($_POST['del_uploadPDF_5']))
{
	$target_dir = '../Staff/PDF/'.$token.'/';
	
	$deletePDF_5 = mysqli_real_escape_string($con, $_POST['deletePDF_5']);
	$target_file_5 = $target_dir . $deletePDF_5;

	$delete = "UPDATE `registered_document` SET `upload_5`='' WHERE `reg_id` = '$_GET[rid]'";

	// echo $delete; exit;

	$res_del = mysqli_query($con, $delete);

	if ($res_del)
   {
       unlink($target_file_5);
      echo "<script language='javascript'>
          window.alert('PDF Document deleted successfully');
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