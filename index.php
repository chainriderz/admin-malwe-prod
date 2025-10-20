<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Registered Document Data</h4>
		<div class="row">
			<div class="col-md-12">
			    <div class="text-center">
			        <div class="float-left"><a href="add_register_document.php" class="btn btn-info">Add New </a> </div>
			        
			        <div class="float-right">
    					<label>Search by Date:&nbsp;&nbsp;</label>
    					<div id="reportrange" class="bg-light border btn btn-md" align="center">
    						<i class="fa fa-calendar"></i>&nbsp;
    						<span></span> <i class="fa fa-caret-down"></i>
    					</div>
    					<button class="btn btn-success" type="button" onclick="exporttoexcel()" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download</button>
    				</div>
				</div>
				<div class="table-responsive">
					
					<!-- <a href="add_register_document.php" class="btn btn-info">Add New</a> -->
					<table id="RegisteredDataTable" class="table table-bordered table-head-bg-default table-bordered-bd-default table-hover bg-white registered_data" style="width:100%">
						<thead>
							<tr>
							    <th rowspan="2">Sr. No.</th>
								<th rowspan="2">Entry Date</th>
								<th rowspan="2">Token</th>
								<th colspan="2" class="text-center">Owner</th>
								<th colspan="2" class="text-center">Tenant</th>
								<th colspan="2" class="text-center">Name</th>
								<th colspan="2" class="text-center">Agreement</th>
								<th colspan="6" class="text-center d-none">Address</th>
								<th rowspan="2" class="text-center noExl">Location</th>
								<th rowspan="2" class="d-none">Uploads (5 PDFs)</th>
								<th rowspan="2">Amount(in Rs.)<br></th>
								<th rowspan="2">Delivery Status</th>
								<th rowspan="2">Records Status<br></th>
								<th rowspan="2" class="d-none">Comments</th> 
								<th rowspan="2" class="noExl">Action</th>
							</tr>
							<tr>
								<th>Name</th>
								<th>Mobile</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Staff</th>
								<th>Agent</th>
								<th>Start</th>
								<th>End</th>
								<th class="d-none">Flat #</th>
								<th class="d-none">Floor</th>
								<th class="d-none">Plot</th>
								<th class="d-none">Bldg Name</th>
								<th class="d-none">Sector</th>
								<th class="d-none" style="border-right-width: 1px;">Location</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$select_reg = "SELECT *, DATEDIFF(`agreement_end_date`, CURDATE()) AS `date_diff` FROM `registered_document` ORDER BY `date_diff` ASC, FIELD(`record_status`, 'Active', 'Inactive'), `agreement_end_date` ASC";
								$res_reg = mysqli_query($con, $select_reg);
								if(mysqli_num_rows($res_reg) > 0)
								{
									$sr = 1;
									while ($row_reg = mysqli_fetch_array($res_reg))
									{
										$date_diff = $row_reg["date_diff"];
										$reg_id = $row_reg["reg_id"];
										$token = $row_reg["token"];
										$owner_name = $row_reg["owner_name"];
										$owner_mobile = $row_reg["owner_mobile"];
										$tenant_name = $row_reg["tenant_name"];
										$tenant_mobile = $row_reg["tenant_mobile"];
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
										$comments = $row_reg["comments"];
										$total_amt = $row_reg["total_amt"];
										$received_amt = $row_reg["received_amt"];
										$deli_status = $row_reg["delivery_status"];
										$record_status = $row_reg["record_status"];
										$timestamp = $row_reg["timestamp"];
										
										$sel_staff = "SELECT * FROM `staff` WHERE `sid` = '$staff_name' AND `status` = '1'";
							            $res_staff = mysqli_query($con, $sel_staff);
							            $row_staff = mysqli_fetch_array($res_staff);
										
										$sel_agent = "SELECT * FROM `agent` WHERE `agent_id` = '$agent_name' AND `status` = '1'";
							            $res_agent = mysqli_query($con, $sel_agent);
							            $row_agent = mysqli_fetch_array($res_agent);

										$folder = $token;

										if ( ( $date_diff <= '30' || $date_diff <= '10' ) && ( $record_status == 'Active' ) && ( $date_diff > 0 ) )
										{
																			
							?>
							<tr class="text-success font-weight-bold">
							    <td><?php echo $sr; ?></td>
							    <td><?php echo date_format(date_create($timestamp),"Y-m-d"); ?></td>			            	
								<td><?php echo $token; ?></td>				                
								<td><?php echo $owner_name; ?></td>
								<td>
								    <?php
								        if(!empty($owner_mobile))
								        {
								    ?>
								        <a href="tel:+91<?php echo $owner_mobile; ?>" class="">+91 <?php echo $owner_mobile; ?></a>
								        
								        <a target="_blank" href="https://wa.me/91<?php echo $owner_mobile; ?>" class="text-success" style="vertical-align:middle; text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
								    <?php
								        }
								    ?>
								</td>
								<td><?php echo $tenant_name; ?></td>
								<td><?php
								        if(!empty($tenant_mobile))
								        {
								    ?>
								        <a href="tel:+91<?php echo $tenant_mobile; ?>" class="">+91 <?php echo $tenant_mobile; ?></a>
								        
								        <a target="_blank" href="https://wa.me/91<?php echo $tenant_mobile; ?>" class="text-success" style="vertical-align:middle; text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
								    <?php
								        }
								    ?>
								</td>
								<td><?php echo $row_staff['name']; ?></td>
								<td><?php echo $row_agent['agent_name']; ?></td>
								<td><?php echo $agreement_start_date; ?></td>
								<td><?php echo $agreement_end_date; ?></td>
								<td class="d-none"><?php echo $flat_no; ?></td>
								<td class="d-none"><?php echo $floor_no; ?></td>
								<td class="d-none"><?php echo $plot_no; ?></td>
								<td class="d-none"><?php echo $bldg_nm; ?></td>
								<td class="d-none"><?php echo $sector_no; ?></td>
								<td class="d-none"><?php echo $location; ?></td>
								<td class="d-none">
									<ul>										
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_1; ?>" target="_blank"><?php echo $upload_1; ?></a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_2; ?>" target="_blank"><?php echo $upload_2; ?> </a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_3; ?>" target="_blank"><?php echo $upload_3; ?></a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_4; ?>" target="_blank"><?php echo $upload_4; ?></a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_5; ?>" target="_blank"><?php echo $upload_5; ?></a>
										</li>
									</ul>				                	              		
								</td>
								<td class="noExl"><?php echo $location; ?></td>
								<td>
								    <?php
								        if(!empty($total_amt) || !empty($received_amt))
								        {
    								        $amt = $total_amt - $received_amt;
    								        
    								        if($amt == '0')
    								        {
								    ?>
								            <b class="d-none">Paid</b>
								            <span class="badge badge-success" style="font-size: 14px;"><?php echo $total_amt; ?></span>
								    <?php
    								        }
    								        elseif($received_amt <= $total_amt && !($received_amt <= '0'))
    								        {
								    ?>
								            <b class="d-none">Balance</b>
								            <span class="badge badge-danger" style="font-size: 14px;">-<?php echo $amt; ?></span>
								    <?php 
    								        }
    								        else
    								        {
								    ?>
								            <b class="d-none">Estimate</b>
								            <span class="badge badge-primary" style="font-size: 14px;"><span class="d-none"></span><?php echo $amt; ?></span>
								    <?php
								            }
										}
								    ?>
								</td>
								<td><?php echo $deli_status; ?></td>
								<td><?php echo $record_status; ?></td>		                
								<td class="d-none"><?php echo $comments; ?></td>
								<td>
									<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalView<?php echo $reg_id; ?>">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
									<a href="upd_register_document.php?rid=<?php echo $reg_id; ?>" class="btn btn-sm btn-success">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</a>
									<a href="#" rid="<?php echo $reg_id; ?>" onclick="deleteregister($(this).attr('rid'));" class="btn btn-sm btn-danger">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							<?php
										}
										else
										{
							?>
							<tr>
							    <td><?php echo $sr; ?></td>
							    <td><?php echo date_format(date_create($timestamp),"Y-m-d"); ?></td>	            	
								<td><?php echo $token; ?></td>				                
								<td><?php echo $owner_name; ?></td>
								<td>
								    <?php
								        if(!empty($owner_mobile))
								        {
								    ?>
								        <a href="tel:+91<?php echo $owner_mobile; ?>" class="">+91 <?php echo $owner_mobile; ?></a>
								        
								        <a target="_blank" href="https://wa.me/91<?php echo $owner_mobile; ?>" class="text-success" style="vertical-align:middle; text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
								    <?php
								        }
								    ?>
								</td>
								<td><?php echo $tenant_name; ?></td>
								<td><?php
								        if(!empty($tenant_mobile))
								        {
								    ?>
								        <a href="tel:+91<?php echo $tenant_mobile; ?>" class="">+91 <?php echo $tenant_mobile; ?></a>
								        
								        <a target="_blank" href="https://wa.me/91<?php echo $tenant_mobile; ?>" class="text-success" style="vertical-align:middle; text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
								    <?php
								        }
								    ?>
								</td>
								<td><?php echo $row_staff['name']; ?></td>
								<td><?php echo $row_agent['agent_name']; ?></td>
								<td><?php echo $agreement_start_date; ?></td>
								<td><?php echo $agreement_end_date; ?></td>
								<td class="d-none"><?php echo $flat_no; ?></td>
								<td class="d-none"><?php echo $floor_no; ?></td>
								<td class="d-none"><?php echo $plot_no; ?></td>
								<td class="d-none"><?php echo $bldg_nm; ?></td>
								<td class="d-none"><?php echo $sector_no; ?></td>
								<td class="d-none"><?php echo $location; ?></td>
								<td class="d-none">
									<ul>										
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_1; ?>" target="_blank"><?php echo $upload_1; ?></a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_2; ?>" target="_blank"><?php echo $upload_2; ?> </a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_3; ?>" target="_blank"><?php echo $upload_3; ?></a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_4; ?>" target="_blank"><?php echo $upload_4; ?></a>
										</li>
										<li>
											<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_5; ?>" target="_blank"><?php echo $upload_5; ?></a>
										</li>
									</ul>				                	              		
								</td>
								<td class="noExl"><?php echo $location; ?></td>
								<td>
								    <?php
								        if(!empty($total_amt) || !empty($received_amt))
								        {
    								        $amt = $total_amt - $received_amt;
    								        
    								        if($amt == '0')
    								        {
								    ?>
								            <b class="d-none">Paid</b>
								            <span class="badge badge-success" style="font-size: 14px;"><?php echo $total_amt; ?></span>
								    <?php
    								        }
    								        elseif($received_amt <= $total_amt && !($received_amt <= '0'))
    								        {
								    ?>
								            <b class="d-none">Balance</b>
								            <span class="badge badge-danger" style="font-size: 14px;">-<?php echo $amt; ?></span>
								    <?php 
    								        }
    								        else
    								        {
								    ?>
								            <b class="d-none">Estimate</b>
								            <span class="badge badge-primary" style="font-size: 14px;"><span class="d-none"></span><?php echo $amt; ?></span>
								    <?php
								            }
										}
								    ?>
								</td>
								<td><?php echo $deli_status; ?></td>
								<td><?php echo $record_status; ?></td>			                
								<td class="d-none"><?php echo $comments; ?></td>
								<td>
									<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalView<?php echo $reg_id; ?>">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
									<a href="upd_register_document.php?rid=<?php echo $reg_id; ?>" class="btn btn-sm btn-success">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</a>
									<a href="#" rid="<?php echo $reg_id; ?>" onclick="deleteregister($(this).attr('rid'));" class="btn btn-sm btn-danger">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							<?php
										}
									$sr++;
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
	$select_reg = "SELECT *, DATEDIFF(`agreement_end_date`, CURDATE()) AS `date_diff` FROM `registered_document` ORDER BY `date_diff` ASC, FIELD(`record_status`, 'Active', 'Inactive'), `agreement_end_date` ASC";
	$res_reg = mysqli_query($con, $select_reg);
	if(mysqli_num_rows($res_reg) > 0)
	{
		$sr = 1;
		while ($row_reg = mysqli_fetch_array($res_reg))
		{
			$date_diff = $row_reg["date_diff"];
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
			$total_amt = $row_reg["total_amt"];
			$received_amt = $row_reg["received_amt"];
			$challan_amt = $row_reg["challan_amt"];
			$comments = $row_reg["comments"];
			$deli_status = $row_reg["delivery_status"];
			$record_status = $row_reg["record_status"];
			$labels = $row_reg["labels"];
			$timestamp = $row_reg["timestamp"];

			$folder = $token;
?>
<!-- Modal -->
<div class="modal fade" id="modalView<?php echo $reg_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalView<?php echo $reg_id; ?>" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title">View Data</h6>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center table-responsive">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="20%"></th>
							<th width="20%" class="text-center">Token</th>
							<td width="60%"><?php echo $token; ?></td>
						</tr>
						<tr>
							<th rowspan="3" class="text-center">Owner</th>
							<th class="text-center">Name</th>
							<td><?php echo $owner_name; ?></td>
						</tr>
						<tr>
							<th class="text-center">Mobile</th>
							<td><?php echo $owner_mobile; ?></td>
						</tr>
						<tr>
							<th class="text-center">Date of Birth</th>
							<td><?php echo $owner_dob; ?></td>
						</tr>
						<tr>
							<th rowspan="3" class="text-center">Alternate Owner</th>
							<th class="text-center">Name</th>
							<td><?php echo $alt_owner_name; ?></td>
						</tr>
						<tr>
							<th class="text-center">Mobile</th>
							<td><?php echo $alt_owner_mobile; ?></td>
						</tr>
						<tr>
							<th class="text-center">Date of Birth</th>
							<td><?php echo $alt_owner_dob; ?></td>
						</tr>
						<tr>
							<th rowspan="3" class="text-center">Tenant</th>
							<th class="text-center">Name</th>
							<td><?php echo $tenant_name; ?></td>
						</tr>
						<tr>
							<th class="text-center">Mobile</th>
							<td><?php echo $tenant_mobile; ?></td>
						</tr>
						<tr>
							<th class="text-center">Date of Birth</th>
							<td><?php echo $tenant_dob; ?></td>
						</tr>
						<tr>
							<th rowspan="3" class="text-center">Alternate Tenant</th>
							<th class="text-center">Name</th>
							<td><?php echo $tenant_name; ?></td>
						</tr>
						<tr>
							<th class="text-center">Mobile</th>
							<td><?php echo $tenant_mobile; ?></td>
						</tr>
						<tr>
							<th class="text-center">Date of Birth</th>
							<td><?php echo $tenant_dob; ?></td>
						</tr>
						<tr>
							<th rowspan="2" class="text-center">Name</th>
							<th class="text-center">Staff</th>
							<td>
							    <?php
							        $select_staff = "SELECT * FROM `staff` WHERE `sid` = '$staff_name'";
							        $res_staff = mysqli_query($con, $select_staff);
							        $row_staff = mysqli_fetch_array($res_staff);
							        echo $row_staff['name'];
							    ?>
							</td>
						</tr>
						<tr>
							<th class="text-center">Agent</th>
							<td>
							    <?php
							        $select_agent = "SELECT * FROM `agent` WHERE `agent_id` = '$agent_name'";
							        $res_agent = mysqli_query($con, $select_agent);
							        $row_agent = mysqli_fetch_array($res_agent);
							        echo $row_agent['agent_name'];
							    ?>
							</td>
						</tr>
						<tr>
							<th rowspan="2" class="text-center">Agreement Date</th>
							<th class="text-center">Start Date</th>
							<td><?php echo $agreement_start_date; ?></td>
						</tr>
						<tr>
							<th class="text-center">End Date</th>
							<td><?php echo $agreement_end_date; ?></td>
						</tr>
						<tr>
							<th rowspan="6" class="text-center">Address</th>
							<th class="text-center">Flat #</th>
							<td><?php echo $flat_no; ?></td>
							<!--<th class="text-center">Bldg Name</th>-->
							<!--<td><?php echo $bldg_nm; ?></td>-->
						</tr>
						<tr>
							<th class="text-center">Floor</th>
							<td><?php echo $floor_no; ?></td>
						</tr>
						<tr>
							<th class="text-center">Plot</th>
							<td><?php echo $plot_no; ?></td>
						</tr>
						<tr>
							<th class="text-center">Bldg Name</th>
							<td><?php echo $bldg_nm; ?></td>
						</tr>
						<tr>
							<th class="text-center">Sector</th>
							<td><?php echo $sector_no; ?></td>
						</tr>
						<tr>
							<th class="text-center">Location</th>
							<td><?php echo $location; ?></td>
						</tr>
						<tr>
							<th class="text-center">Uploads</th>
							<th class="text-center">(5 PDF Docs)</th>
							<td>
								<div class="mb-2 text-left">
									<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder.'/'.$upload_1; ?>" target="_blank"><?php echo $upload_1; ?></a>
								</div>

								<div class="mb-2 text-left">
									<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder.'/'.$upload_2; ?>" target="_blank"><?php echo $upload_2; ?></a>
								</div>

								<div class="mb-2 text-left">
									<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder.'/'.$upload_3; ?>" target="_blank"><?php echo $upload_3; ?></a>
								</div>

								<div class="mb-2 text-left">
									<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder.'/'.$upload_4; ?>" target="_blank"><?php echo $upload_4; ?></a>
								</div>

								<div class="mb-2 text-left">
									<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder.'/'.$upload_5; ?>" target="_blank"><?php echo $upload_5; ?></a>
								</div>
							</td>
						</tr>
						<tr>
						    <th rowspan="4" class="text-center">Amount</th>
							<th class="text-center">Quotation Amount</th>
							<td><?php if(!empty($total_amt)){ echo $total_amt; } ?></td>
						</tr>
						<tr>
							<th class="text-center">Received Amount</th>
							<td><?php if(!empty($received_amt)){ echo $received_amt; } ?></td>
						</tr>
						<tr>
							<th class="text-center">Amount</th>
							<td>
							<?php 
							    if(!empty($total_amt) || !empty($received_amt))
							    {
							     //   echo $received_amt;
							        $amt = $total_amt - $received_amt;
    								        
							        if($amt == '0')
							        {
						    ?>
						            <span class="badge badge-success" style="font-size: 14px;"><?php echo $total_amt; ?></span>
						    <?php
							        }
							        elseif($received_amt <= $total_amt && !($received_amt <= '0'))
							        {
						    ?>
						            <span class="badge badge-danger" style="font-size: 14px;">-<?php echo $amt; ?></span>
						    <?php 
							        }
							        else
							        {
						    ?>
						            <span class="badge badge-primary" style="font-size: 14px;"><span class="d-none"></span><?php echo $amt; ?></span>
						    <?php
						            }
							    }
							?>
							</td>
						</tr>
						<tr>
							<th class="text-center">Challan Amount</th>
							<td><?php if(!empty($challan_amt)){ echo $challan_amt; } ?></td>
						</tr>
						<tr>
							<th class="text-center">Comments</th>
							<td colspan="2"><?php echo $comments; ?></td>
						</tr>
						<tr>
							<th class="text-center">Delivery Status</th>
							<td colspan="2">
							    <p><?php echo $deli_status; ?></p>
							    <?php
							     //   if(!empty($deli_status))
							     //   {
    							 //       if($deli_status == 'Delivered')
    							 //       {
							    ?>
    							            <!--<i class="la la-2x la-check-circle text-success"></i>-->
    							            <!--<p><?php echo $deli_status; ?></p>-->
							    <?php
    							     //   }
    							     //   else
    							     //   {
							    ?>
    							            <!--<i class="la la-2x la-times-circle text-danger"></i>-->
    							            <!--<p><?php echo $deli_status; ?></p>-->
							    <?php 
							     //       }
							     //   }
							    ?>
							</td>
						</tr>
						<tr>
							<th class="text-center">Status</th>
							<td colspan="2"><?php echo $record_status; ?></td>
						</tr>
						<tr>
							<th class="text-center">Labels</th>
							<td colspan="2"><?php echo $labels; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				 <!--<a href="?logout" class="btn btn-success">OK</a> -->
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php
		}
	}
?>
<div class="clone_table d-none">
    <table id="RegisteredDataTable_copy" class="table table-bordered table-head-bg-default table-bordered-bd-default table-hover bg-white registered_data" style="width:100%">
		<thead>
			<tr>
			    <th rowspan="2">Sr. No.</th>
				<th rowspan="2">Entry Date</th>
				<th rowspan="2">Token</th>
				<th colspan="2" class="text-center">Owner</th>
				<th colspan="2" class="text-center">Tenant</th>
				<th colspan="2" class="text-center">Name</th>
				<th colspan="2" class="text-center">Agreement</th>
				<th colspan="6" class="text-center d-none">Address</th>
				<th rowspan="2" class="text-center noExl">Location</th>
				<th rowspan="2" class="d-none">Uploads (5 PDFs)</th>
				<th rowspan="2">Amount(in Rs.)</th>
				<th rowspan="2">Delivery Status</th>
				<th rowspan="2">Records Status<br></th>
				<th rowspan="2" class="d-none">Comments</th> 
				<th rowspan="2" class="noExl">Action</th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Mobile</th>
				<th>Name</th>
				<th>Mobile</th>
				<th>Staff</th>
				<th>Agent</th>
				<th>Start</th>
				<th>End</th>
				<th class="d-none">Flat #</th>
				<th class="d-none">Floor</th>
				<th class="d-none">Plot</th>
				<th class="d-none">Bldg Name</th>
				<th class="d-none">Sector</th>
				<th class="d-none" style="border-right-width: 1px;">Location</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$select_reg = "SELECT *, DATEDIFF(`agreement_end_date`, CURDATE()) AS `date_diff` FROM `registered_document` ORDER BY `date_diff` ASC, FIELD(`record_status`, 'Active', 'Inactive'), `agreement_end_date` ASC";
				$res_reg = mysqli_query($con, $select_reg);
				if(mysqli_num_rows($res_reg) > 0)
				{
					$sr = 1;
					while ($row_reg = mysqli_fetch_array($res_reg))
					{
						$date_diff = $row_reg["date_diff"];
						$reg_id = $row_reg["reg_id"];
						$token = $row_reg["token"];
						$owner_name = $row_reg["owner_name"];
						$owner_mobile = $row_reg["owner_mobile"];
						$tenant_name = $row_reg["tenant_name"];
						$tenant_mobile = $row_reg["tenant_mobile"];
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
						$comments = $row_reg["comments"];
						$total_amt = $row_reg["total_amt"];
						$received_amt = $row_reg["received_amt"];
						$deli_status = $row_reg["delivery_status"];
						$record_status = $row_reg["record_status"];
						$timestamp = $row_reg["timestamp"];
						
						$sel_staff = "SELECT * FROM `staff` WHERE `sid` = '$staff_name' AND `status` = '1'";
			            $res_staff = mysqli_query($con, $sel_staff);
			            $row_staff = mysqli_fetch_array($res_staff);
						
						$sel_agent = "SELECT * FROM `agent` WHERE `agent_id` = '$agent_name' AND `status` = '1'";
			            $res_agent = mysqli_query($con, $sel_agent);
			            $row_agent = mysqli_fetch_array($res_agent);

						$folder = $token;
															
			?>
			<tr>
			    <td><?php echo $sr; ?></td>
			    <td><?php echo date_format(date_create($timestamp),"Y-m-d"); ?></td>			            	
				<td><?php echo $token; ?></td>				                
				<td><?php echo $owner_name; ?></td>
				<td>
				    <?php
				        if(!empty($owner_mobile))
				        {
				    ?>
				        <a href="tel:+91<?php echo $owner_mobile; ?>" class="">+91 <?php echo $owner_mobile; ?></a>
				        
				        <a target="_blank" href="https://wa.me/91<?php echo $owner_mobile; ?>" class="text-success" style="vertical-align:middle; text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
				    <?php
				        }
				    ?>
				</td>
				<td><?php echo $tenant_name; ?></td>
				<td><?php
				        if(!empty($tenant_mobile))
				        {
				    ?>
				        <a href="tel:+91<?php echo $tenant_mobile; ?>" class="">+91 <?php echo $tenant_mobile; ?></a>
				        
				        <a target="_blank" href="https://wa.me/91<?php echo $tenant_mobile; ?>" class="text-success" style="vertical-align:middle; text-decoration:none;"><i class="la la-2x la-whatsapp"></i></a>
				    <?php
				        }
				    ?>
				</td>
				<td><?php echo $row_staff['name']; ?></td>
				<td><?php echo $row_agent['agent_name']; ?></td>
				<td><?php echo $agreement_start_date; ?></td>
				<td><?php echo $agreement_end_date; ?></td>
				<td class="d-none"><?php echo $flat_no; ?></td>
				<td class="d-none"><?php echo $floor_no; ?></td>
				<td class="d-none"><?php echo $plot_no; ?></td>
				<td class="d-none"><?php echo $bldg_nm; ?></td>
				<td class="d-none"><?php echo $sector_no; ?></td>
				<td class="d-none"><?php echo $location; ?></td>
				<td class="d-none">
					<ul>										
						<li>
							<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_1; ?>" target="_blank"><?php echo $upload_1; ?></a>
						</li>
						<li>
							<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_2; ?>" target="_blank"><?php echo $upload_2; ?> </a>
						</li>
						<li>
							<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_3; ?>" target="_blank"><?php echo $upload_3; ?></a>
						</li>
						<li>
							<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_4; ?>" target="_blank"><?php echo $upload_4; ?></a>
						</li>
						<li>
							<a href="http://onebroker.co.in/malwe.online/Staff/PDF/<?php echo $folder; ?>/<?php echo $upload_5; ?>" target="_blank"><?php echo $upload_5; ?></a>
						</li>
					</ul>				                	              		
				</td>
				<td class="noExl"><?php echo $location; ?></td>
				<td>
				    <?php
				        if(!empty($total_amt) || !empty($received_amt))
				        {
					        $amt = $total_amt - $received_amt;
					        
					        if($amt == '0')
					        {
				    ?>
				            <span class="badge badge-success" style="font-size: 14px;"><?php echo $total_amt; ?></span>
				    <?php
					        }
					        elseif($received_amt <= $total_amt && !($received_amt <= '0'))
					        {
				    ?>
				            <span class="badge badge-danger" style="font-size: 14px;">-<?php echo $amt; ?></span>
				    <?php 
					        }
					        else
					        {
				    ?>
				            <span class="badge badge-primary" style="font-size: 14px;"><span class="d-none"></span><?php echo $amt; ?></span>
				    <?php
				            }
						}
				    ?>
				</td>
				<td><?php echo $deli_status; ?></td>
				<td><?php echo $record_status; ?></td>		                
				<td class="d-none"><?php echo $comments; ?></td>
				<td>
					<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalView<?php echo $reg_id; ?>">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
					<a href="upd_register_document.php?rid=<?php echo $reg_id; ?>" class="btn btn-sm btn-success">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</a>
					<a href="#" rid="<?php echo $reg_id; ?>" onclick="deleteregister($(this).attr('rid'));" class="btn btn-sm btn-danger">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
			<?php
					$sr++;
					}
				}
			?>
		</tbody>
	</table>
</div>
<?php include("footer.php"); ?>

<script type="text/javascript">
	$(".sidebar .nav .registered_document").addClass("active");
</script>