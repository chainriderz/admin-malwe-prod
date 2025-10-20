<?php
include("header.php");
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$currdate = date('Y-m-d H:i:s');
// echo $currdate;
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Enquiry</h4>
<?php
if(isset($_GET['eid']))
{
    $sel_e = "SELECT * FROM `enquiry` WHERE `eid` = '$_GET[eid]'";
	$res_e = mysqli_query($con, $sel_e);
    $row_e = mysqli_fetch_array($res_e);
?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">EDIT ENQUIRY DETAILS</div>
					<div class="card-body">
						<form class="add-user-form form-row" method="POST" enctype="multipart/form-data">
							
							<div class="form-group col-md-3">
								<label for="">Name</label>
								<input type="text" class="form-control" name="name" value="<?php echo $row_e['name']; ?>" placeholder="Enter Name" required>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Mobile</label>
								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" value="<?php echo $row_e['mobile']; ?>" placeholder="Enter Mobile" required>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Work</label>
								<select class="form-control" name="work">
								    <?php
								        $sel_work = "SELECT * FROM `work_services` WHERE `status` = '1'";
								        $res_work = mysqli_query($con, $sel_work);
								        if(mysqli_num_rows($res_work) > 0)
								        {
								            while($row_work = mysqli_fetch_array($res_work))
								            {
								    ?>
									<option value="<?php echo $row_work['w_id']; ?>" <?php if( $row_work['w_id'] == $row_e['work'] ){ echo 'selected'; } ?> ><?php echo $row_work['w_name']; ?></option>
									<?php
								            }
								        }
								    ?>
								</select>
							</div>
							
							<div class="form-group col-md-3">
								<label for="">Date Time Schedule</label>
								<input type="datetime-local" class="form-control" name="datetime_schedule" value="<?php echo date('Y-m-d\TH:i', strtotime($row_e['datetime_schedule']) ); ?>" placeholder="Enter Name">
							</div>
							
							<div class="form-group col-md-8">
								<label for="">Remarks</label>
								<textarea class="form-control" name="remarks" placeholder="Enter Remarks"><?php echo $row_e['remarks']; ?></textarea>
							</div>
							
							<div class="form-group col-md-4">
								<label for="">Status</label>
								<select class="form-control" name="status">
									<option value="1" <?php if($row_e['status'] == '1') { echo 'selected'; } ?>>Completed</option>
									<option value="2" <?php if($row_e['status'] == '2') { echo 'selected'; } ?>>Pending</option>
								</select>
							</div>
							
							<div class="form-group col-md-12">
							    <button type="submit" name="upd_enquiry" class="btn btn-success">SUBMIT</button>
							</div>

						</form>
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
					<div class="card-header">
						<button class="btn btn-success float-left" data-toggle="modal" data-target="#modalAddNew">Add New</button>
						<button class="btn btn-success float-right" type="button" onclick="exporttoexcelEnquiry()" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download</button>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="EnquirydataTable" class="table table-bordered table-head-bg-default table-bordered-bd-default table-hover bg-white" style="width:100%">
						        <thead>
						            <tr>				                
						                <th>Sr No.</th>
						                <th>Entry Date</th>
						                <th>Name</th>
						                <th>Mobile</th>
						                <th>Work</th>
						                <th>Date Time Schedule</th>
						                <th style="white-space:break-spaces;">Remarks</th>
						                <th>Status<br></th>
						                <th class="noExl">Action</th>
						            </tr>
						        </thead>
						        <tbody>
						            <?php
						            	/*$select_en = "SELECT * FROM `enquiry`
                                                    	ORDER BY
                                                        	   
                                                        DATE(datetime_schedule) = DATE_FORMAT('$currdate', '%Y-%m-%d') DESC,
                                                        DATE(datetime_schedule) < DATE_FORMAT('$currdate', '%Y-%m-%d') DESC,   
                                                        DATE(datetime_schedule) > DATE_FORMAT('$currdate', '%Y-%m-%d') ASC,
                                                        DATE_FORMAT(datetime_schedule, '%H:%i:%s') ASC";*/
                                        // FIELD(`status`,'1','2'),
                                        
                                        $select_en = "SELECT * FROM `enquiry`
                                            ORDER BY
                                            DATE(datetime_schedule) = DATE('$currdate') DESC,
                                            DATE(datetime_schedule) ASC,
                                            TIME(datetime_schedule) ASC";
                                        // echo $select_en;
						            	$res_en = mysqli_query($con, $select_en);
						            	if(mysqli_num_rows($res_en) > 0)
						            	{
						            		$ensr = 1;
						            		while ($row_en = mysqli_fetch_array($res_en))
						            		{
						            		    $en_id = $row_en["eid"];
						            		    $en_name = $row_en["name"];
						            			$en_mobile = $row_en["mobile"];
						            			$en_work = $row_en["work"];
						            			$en_datetime_schedule = $row_en["datetime_schedule"];
						            			$en_remarks = $row_en["remarks"];
						            			$en_status = $row_en["status"];
						            			$entry_date = $row_en["entry_date"];
						            			if(date('Y-m-d', strtotime($en_datetime_schedule)) == date('Y-m-d', strtotime($currdate)))
							                    {
							                        $cls = "text-success font-weight-bold";
							                    }
							                    else if(date('Y-m-d', strtotime($en_datetime_schedule)) > date('Y-m-d', strtotime($currdate)))
							                    {
							                        $cls = "text-primary font-weight-bold";
							                    }
							                    else if(date('Y-m-d', strtotime($en_datetime_schedule)) < date('Y-m-d', strtotime($currdate)))
							                    {
							                        $cls = "text-danger font-weight-bold";
							                    } else {
							                    	$cls = "";
							                    }

						            			?>
						            			<tr class="<?php echo $cls ?>">				                
									                <td><?php echo $ensr; ?></td>
									                <td><?php echo $entry_date; ?></td>
									                <td><?php echo $en_name; ?></td>
									                <td><a href="tel:+91<?php echo $en_mobile; ?>" class="<?php echo $cls ?>" >+91 <?php echo $en_mobile; ?></a></td>
									                <td>
									                    <?php
									                        $select_w = "SELECT * FROM `work_services` WHERE `w_id` = '$en_work'";
									            	        $res_w = mysqli_query($con, $select_w);
									            	        $row_w = mysqli_fetch_array($res_w);
									            	        echo $row_w['w_name'];
									                    ?>
									                </td>
									                <td><?php echo date( 'Y-m-d h:i A', strtotime($en_datetime_schedule) ); ?></td>
									                <td style="white-space:break-spaces;"><?php echo $en_remarks; ?></td>
									                <td>
														<?php
														if ($en_status == '1') { echo 'Completed'; }
														else { echo 'Pending'; }
														?>
													</td>
									                <td>
									                    <a href="enquiry.php?eid=<?php echo $en_id; ?>" class="btn btn-sm btn-success">
									                		<i class="fa fa-pencil" aria-hidden="true"></i>
									                	</a>
									                    <a href="#" eid="<?php echo $en_id; ?>" onclick="delete_enquiry($(this).attr('eid'));" class="btn btn-sm btn-danger">
									                		<i class="fa fa-trash" aria-hidden="true"></i>
									                	</a>
									                </td>
									            </tr>
						            			<?php
						            		$ensr++;
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
		<div class="table-responsive d-none">
    		<table class="table table-bordered table-head-bg-default table-bordered-bd-default table-hover bg-white enquiry_data" style="width:100%">
    	        <thead>
    	            <tr>				                
    	                <th>Sr No.</th>
    	                <th>Entry Date</th>
    	                <th>Name</th>
    	                <th>Mobile</th>
    	                <th>Work</th>
    	                <th>Date Time Schedule</th>
    	                <th style="white-space:break-spaces;">Remarks</th>
    	                <th>Status<br></th>
    	                <th class="noExl">Action</th>
    	            </tr>
    	        </thead>
    	        <tbody>
    	            <?php
    	            	$select_en = "SELECT * FROM `enquiry`
                                    	ORDER BY
                                        	   
                                        DATE(datetime_schedule) = DATE_FORMAT('$currdate', '%Y-%m-%d') DESC,
                                        DATE(datetime_schedule) < DATE_FORMAT('$currdate', '%Y-%m-%d') DESC,   
                                        DATE(datetime_schedule) > DATE_FORMAT('$currdate', '%Y-%m-%d') ASC,
                                        DATE_FORMAT(datetime_schedule, '%H:%i:%s') ASC";
                        // FIELD(`status`,'1','2'),
                        // echo $select_en;
    	            	$res_en = mysqli_query($con, $select_en);
    	            	if(mysqli_num_rows($res_en) > 0)
    	            	{
    	            		$ensr = 1;
    	            		while ($row_en = mysqli_fetch_array($res_en))
    	            		{
    	            		    $en_id = $row_en["eid"];
    	            		    $en_name = $row_en["name"];
    	            			$en_mobile = $row_en["mobile"];
    	            			$en_work = $row_en["work"];
    	            			$en_datetime_schedule = $row_en["datetime_schedule"];
    	            			$en_remarks = $row_en["remarks"];
    	            			$en_status = $row_en["status"];
    	            			$entry_date = $row_en["entry_date"];
    	            			if(date('Y-m-d', strtotime($en_datetime_schedule)) == date('Y-m-d', strtotime($currdate)))
    	            			{
    	            ?>
    	            <tr class="text-primary font-weight-bold">				                
    	                <td><?php echo $ensr; ?></td>
    	                <td><?php echo $entry_date; ?></td>
    	                <td><?php echo $en_name; ?></td>
    	                <td><a href="tel:+91<?php echo $en_mobile; ?>">+91 <?php echo $en_mobile; ?></a></td>
    	                <td>
    	                    <?php
    	                        $select_w = "SELECT * FROM `work_services` WHERE `w_id` = '$en_work'";
    	            	        $res_w = mysqli_query($con, $select_w);
    	            	        $row_w = mysqli_fetch_array($res_w);
    	            	        echo $row_w['w_name'];
    	                    ?>
    	                </td>
    	                <td><?php echo date( 'Y-m-d h:i A', strtotime($en_datetime_schedule) ); ?></td>
    	                <td style="white-space:break-spaces;"><?php echo $en_remarks; ?></td>
    	                <td>
    						<?php
    						if ($en_status == '1') { echo 'Completed'; }
    						else { echo 'Pending'; }
    						?>
    					</td>
    	                <td>
    	                    <a href="enquiry.php?eid=<?php echo $en_id; ?>" class="btn btn-sm btn-success">
    	                		<i class="fa fa-pencil" aria-hidden="true"></i>
    	                	</a>
    	                    <a href="#" eid="<?php echo $en_id; ?>" onclick="delete_enquiry($(this).attr('eid'));" class="btn btn-sm btn-danger">
    	                		<i class="fa fa-trash" aria-hidden="true"></i>
    	                	</a>
    	                </td>
    	            </tr>
    	            <?php
    	            			}
    	            			else
    	            			{
    	            ?>
    	            <tr class="">				                
    	                <td><?php echo $ensr; ?></td>
    	                <td><?php echo $entry_date; ?></td>
    	                <td><?php echo $en_name; ?></td>
    	                <td><a href="tel:+91<?php echo $en_mobile; ?>">+91 <?php echo $en_mobile; ?></a></td>
    	                <td>
    	                    <?php
    	                        $select_w = "SELECT * FROM `work_services` WHERE `w_id` = '$en_work'";
    	            	        $res_w = mysqli_query($con, $select_w);
    	            	        $row_w = mysqli_fetch_array($res_w);
    	            	        echo $row_w['w_name'];
    	                    ?>
    	                </td>
    	                <td><?php echo date( 'Y-m-d h:i A', strtotime($en_datetime_schedule) ); ?></td>
    	                <td style="white-space:break-spaces;"><?php echo $en_remarks; ?></td>
    	                <td>
    						<?php
    						if ($en_status == '1') { echo 'Completed'; }
    						else { echo 'Pending'; }
    						?>
    					</td>
    	                <td>
    	                    <a href="enquiry.php?eid=<?php echo $en_id; ?>" class="btn btn-sm btn-success">
    	                		<i class="fa fa-pencil" aria-hidden="true"></i>
    	                	</a>
    	                    <a href="#" eid="<?php echo $en_id; ?>" onclick="delete_enquiry($(this).attr('eid'));" class="btn btn-sm btn-danger">
    	                		<i class="fa fa-trash" aria-hidden="true"></i>
    	                	</a>
    	                </td>
    	            </tr>
    	            <?php
    	            			}
    	            		$ensr++;
    		            	}
    		            }
    	            ?>
    	        </tbody>
    	    </table>
    	</div>
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
        				<div class="card">
        					<div class="card-header font-weight-bold text-uppercase">ADD ENQUIRY DETAILS</div>
        					<div class="card-body">
        						<form class="add-user-form form-row" method="POST" enctype="multipart/form-data">
        							
        							<div class="form-group col-md-6">
        								<label for="">Name</label>
        								<input type="text" class="form-control" name="name" placeholder="Enter Name" required>
        							</div>
        							
        							<div class="form-group col-md-6">
        								<label for="">Mobile</label>
        								<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" placeholder="Enter Mobile" required>
        							</div>
        							
        							<div class="form-group col-md-6">
        								<label for="">Work</label>
        								<select class="form-control" name="work">
        								    <?php
        								        $sel_work = "SELECT * FROM `work_services` WHERE `status` = '1'";
        								        $res_work = mysqli_query($con, $sel_work);
        								        if(mysqli_num_rows($res_work) > 0)
        								        {
        								            while($row_work = mysqli_fetch_array($res_work))
        								            {
        								    ?>
        									<option value="<?php echo $row_work['w_id']; ?>"><?php echo $row_work['w_name']; ?></option>
        									<?php
        								            }
        								        }
        								    ?>
        								</select>
        							</div>
        							
        							<div class="form-group col-md-6">
        								<label for="">Date Time Schedule</label>
        								<input type="datetime-local" class="form-control" name="datetime_schedule" placeholder="Enter Name" >
        							</div>
        							
        							<div class="form-group col-md-8">
        								<label for="">Remarks</label>
        								<textarea class="form-control" name="remarks" placeholder="Enter Remarks"></textarea>
        							</div>
        							
        							<div class="form-group col-md-4">
        								<label for="">Status</label>
        								<select class="form-control" name="status">
        									<option value="1">Completed</option>
        									<option value="2">Pending</option>
        								</select>
        							</div>
        							
        							<div class="form-group col-md-12">
        							    <button type="submit" name="add_enquiry" class="btn btn-success">SUBMIT</button>
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
	$(".sidebar .nav .enquiry").addClass("active");
</script>

<?php
if (isset($_POST['add_enquiry']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $work = mysqli_real_escape_string($con, $_POST['work']);
    $datetime_schedule = mysqli_real_escape_string($con, $_POST['datetime_schedule']);
    $remarks = mysqli_real_escape_string($con, $_POST['remarks']);
    $entry_date = date('Y-m-d');
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $insert = "INSERT INTO `enquiry`(`entry_date`, `name`, `mobile`, `work`, `datetime_schedule`, `remarks`, `status`) VALUES ('$entry_date','$name','$mobile','$work','$datetime_schedule','$remarks','$status')";
    // echo $insert; exit;
    $res_ins = mysqli_query($con, $insert);
    
    if ($res_ins)
    {
        echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Enquiry Added Successfully');
                window.location.href='enquiry.php'; 
              </script>
		";
    }
    else
    {
        echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='enquiry.php'; 
        </script>");
    }
}

if (isset($_POST['upd_enquiry']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $work = mysqli_real_escape_string($con, $_POST['work']);
    $datetime_schedule = mysqli_real_escape_string($con, $_POST['datetime_schedule']);
    $remarks = mysqli_real_escape_string($con, $_POST['remarks']);
    $entry_date = date('Y-m-d');
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $update = "UPDATE `enquiry` SET `entry_date`='$entry_date',`name`='$name',`mobile`='$mobile',`work`='$work',`datetime_schedule`='$datetime_schedule',`remarks`='$remarks',`status` = '$status' WHERE `eid`='$_GET[eid]'";
    // echo $update; exit;
    $res_upd = mysqli_query($con, $update);
    
    if ($res_upd)
    {
        echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Enquiry Updated Successfully');
                window.location.href='enquiry.php'; 
              </script>
		";
    }
    else
    {
        echo ("<script LANGUAGE='JavaScript'>
              window.alert('There was an error please try again later');
              window.location.href='enquiry.php'; 
        </script>");
    }
}
?>