<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Registered Document Data</h4>
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Add Details
						<a href="index1.php" class="close" aria-label="Close" title="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
					</div>				
					<div class="card-body">
						<form class="form text-center" id="add_register" method="POST" enctype="multipart/form-data">
							<table class="table table-bordered bg-">
								<tr>
									<th width="20%"></th>
									<th width="20%" class="text-center">Token</th>
									<td width="60%"><input type="tel" minlength="14" maxlength="14" id="token_no" onchange="CheckTokenLength(this.value)" onkeyup="CheckToken(this.value, undefined)" onkeypress="return isNumber(event)" name="token" class="form-control border-0" placeholder="Enter Token" required><p id="token_error" class="text-left"></p></td>
								</tr>
								<tr>
									<th rowspan="2" class="text-center">Owner</th>
									<th class="text-center">Name</th>
									<td><input type="text" name="owner_name" class="form-control border-0" placeholder="Enter Owner Name" required></td>
								</tr>
								<tr>
									<th class="text-center">Mobile</th>
									<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="owner_mobile" class="form-control border-0" placeholder="Enter Owner Mobile"></td>
								</tr>
								<!-- <tr>
									<th class="text-center">Date of Birth</th>
									<td><input type="date" name="owner_dob" id="owner_dob" class="form-control border-0"></td>
								</tr> -->
								<tr>
									<th rowspan="2" class="text-center">2nd Owner</th>
									<th class="text-center">Name</th>
									<td><input type="text" name="alt_owner_name" class="form-control border-0" placeholder="Enter Owner Name"></td>
								</tr>
								<tr>
									<th class="text-center">Mobile</th>
									<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="alt_owner_mobile" class="form-control border-0" placeholder="Enter Owner Mobile"></td>
								</tr>
								<!-- <tr>
									<th class="text-center">Date of Birth</th>
									<td><input type="date" name="alt_owner_dob" id="alt_owner_dob" class="form-control border-0"></td>
								</tr> -->
								<tr>
									<th rowspan="2" class="text-center">Tenant</th>
									<th class="text-center">Name</th>
									<td><input type="text" name="tenant_name" class="form-control border-0" placeholder="Enter Tenant Name" required></td>
								</tr>
								<tr>
									<th class="text-center">Mobile</th>
									<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="tenant_mobile" class="form-control border-0" placeholder="Enter Tenant Mobile"></td>
								</tr>
								<!-- <tr>
									<th class="text-center">Date of Birth</th>
									<td><input type="date" name="tenant_dob" id="tenant_dob" class="form-control border-0"></td>
								</tr> -->
								<tr>
									<th rowspan="2" class="text-center">2nd Tenant</th>
									<th class="text-center">Name</th>
									<td><input type="text" name="alt_tenant_name" class="form-control border-0" placeholder="Enter Tenant Name"></td>
								</tr>
								<tr>
									<th class="text-center">Mobile</th>
									<td><input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" name="alt_tenant_mobile" class="form-control border-0" placeholder="Enter Tenant Mobile"></td>
								</tr>
								<!-- <tr>
									<th class="text-center">Date of Birth</th>
									<td><input type="date" name="alt_tenant_dob" id="alt_tenant_dob" class="form-control border-0"></td>
								</tr> -->
								<tr>
									<th rowspan="2" class="text-center">Name</th>
									<th class="text-center">Staff</th>
									<td>
									    <!--<input type="text" name="staff_name" class="form-control border-0" placeholder="Enter Staff Name" required>-->
									    <select name="staff_name" class="form-control border-0" id="setStaff">
									        <?php
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
									        ?>
									    </select>
									</td>
								</tr>
								<tr>
									<th class="text-center">Agent</th>
									<td>
									    <!--<input type="text" name="agent_name" class="form-control border-0" placeholder="Enter Agent Name">-->
									    <select name="agent_name" class="form-control border-0" id="setAgent">
									        <?php
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
									        ?>
									    </select>
									</td>
								</tr>
								<tr>
									<th rowspan="3" class="text-center">Agreement Date</th>
									<th class="text-center">Start Date</th>
									<td><input type="date" name="agreement_start_date" id="agreement_start_date" class="form-control border-0" required></td>
								</tr>
								<tr>
									<th class="text-center">End Months</th>
									<td><input type="number" min="1" placeholder="Enter Months" id="select_months" class="form-control border-0"></td>
								</tr>
								<tr>
									<th class="text-center">End Date</th>
									<td><input type="date" name="agreement_end_date" id="agreement_end_date" class="form-control border-0" required></td>
								</tr>
								<tr>
									<th rowspan="2" class="text-center">Address</th>
									<th class="text-center">Address</th>
									<td><input type="text" name="bldg_nm" class="form-control border-0" placeholder="Enter Flat, Floor, Bldg Name, Plot, sector"></td>
								</tr>
								<tr>
									<th class="text-center">Location</th>
									<td><input type="text" name="location" class="form-control border-0" placeholder="Enter Location" required></td>
								</tr>
								<tr>
									<th class="text-center">Uploads</th>
									<th class="text-center">(5 PDF Docs Optional)</th>
									<td>
									    <input type="file" name="uploadPDF[]" id="" multiple accept=".pdf" class="form-control border-0">
									</td>
								</tr>
								<tr>
        						    <th rowspan="11" class="text-center">Amount</th>
									<th class="text-center">Stamp Duty</th>
									<td><input type="tel" name="stamp_duty" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter Stamp Duty without ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">Reg + DHC</th>
									<td><input type="tel" name="reg_dhc" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter Reg + DHC without ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">NOC</th>
									<td><input type="tel" name="noc" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter NOC ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">Staff Incentive</th>
									<td><input type="tel" name="staff_incentive" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter Staff Incentive without ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">Agent Paid</th>
									<td><input type="tel" name="agent_paid" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter Agent Paid without ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">Outside Visit</th>
									<td><input type="tel" name="outside_visit" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter Outside Visit without ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">Urgent Doc</th>
									<td><input type="tel" name="urgent_doc" onkeypress="return isNumber(event)" class="form-control border-0 calc-field" placeholder="Enter Urgent Doc without ',' and '/-'"></td>
								</tr>
								<tr>
        							<th class="text-center">Total Amount</th>
        							<td><input type="tel" name="total_amt_disply" onkeypress="return isNumber(event)" class="form-control border-0" value="0" disabled></td>
        							<input type="hidden" name="total_amt"value="0">
        						</tr>
        						<tr>
        							<th class="text-center">Received Amount</th>
        							<td><input type="tel" name="received_amt" onkeypress="return isNumber(event)" class="form-control border-0" placeholder="Enter Amount without ',' and '/-'"></td>
        						</tr>
        						<tr>
        							<th class="text-center">Profit / Balance</th>
        							<td><input type="tel" name="balance_amt" onkeypress="return isNumber(event)" class="form-control border-0" value="0" disabled></td>
        						</tr>
								<tr>
									<th class="text-center">Challan Amount</th>
									<td><input type="tel" name="challan_amt" onkeypress="return isNumber(event)" class="form-control border-0" placeholder="Enter Challan Amount without ',' and '/-'"></td>
								</tr>
								<tr>
									<th class="text-center">Comments</th>
									<td colspan="2"><textarea name="comments" class="form-control border-0" placeholder="Enter Comments"></textarea></td>
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
									        <option value="<?php echo $row_deli['del_status']; ?>"><?php echo $row_deli['del_status']; ?></option>
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
											<option value="<?php echo $row_rec['status']; ?>"><?php echo $row_rec['status']; ?></option>
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
											<option value="<?php echo $row_rec['name']; ?>"><?php echo $row_rec['name']; ?></option>
											<?php
										            }
										        }
										    ?>
										</select>
									</td>
								</tr>
							</table>
							<button type="submit" name="add_register" id="add_register_btn" class="btn btn-success w-25 font-weight-bold">SUBMIT</button>
						</form>
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
<?php
if (isset($_POST['add_register']))
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

	$stamp_duty = (float)($_POST['stamp_duty'] ?? 0);
	$reg_dhc = (float)($_POST['reg_dhc'] ?? 0);
	$noc = (float)($_POST['noc'] ?? 0);
	$staff_incentive = (float)($_POST['staff_incentive'] ?? 0);
	$agent_paid = (float)($_POST['agent_paid'] ?? 0);
	$outside_visit = (float)($_POST['outside_visit'] ?? 0);
	$urgent_doc = (float)($_POST['urgent_doc'] ?? 0);
	$total_amt = (float)($_POST['total_amt'] ?? 0);
	$received_amt = (float)($_POST['received_amt'] ?? 0);
	$challan_amt =(float)($_POST['challan_amt'] ?? 0);
	
	$comments = mysqli_real_escape_string($con, $_POST['comments']);
	$deli_status = mysqli_real_escape_string($con, $_POST['deli_status']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	$labels = mysqli_real_escape_string($con, $_POST['labels']);
	$timestamp = date("Y-m-d");
	
	$uploadPDF = implode(",", $_FILES['uploadPDF']['name']);
	$uploadPDF_tmp = implode(",", $_FILES['uploadPDF']['tmp_name']);
	$up_PDF_tmp = explode(",", $uploadPDF_tmp);

	mkdir('../Staff/PDF/'.$token.'/');
	$target_dir = '../Staff/PDF/'.$token.'/';

	$pdffiles = array();

	foreach ($up_PDF_tmp as $key => $value)
	{		
		$file_tmpname = $_FILES["uploadPDF"]["tmp_name"][$key];
		$file_name = $_FILES['uploadPDF']["name"][$key];

		$pdffiles[] = $_FILES['uploadPDF']["name"][$key];
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

	$insert = "INSERT INTO `registered_document`(`token`, `owner_name`, `owner_mobile`, `owner_dob`, `alt_owner_name`, `alt_owner_mobile`, `alt_owner_dob`, `tenant_name`, `tenant_mobile`, `tenant_dob`, `alt_tenant_name`, `alt_tenant_mobile`, `alt_tenant_dob`, `staff_name`, `agent_name`, `agreement_start_date`, `agreement_end_date`, `flat_no`, `floor_no`, `plot_no`, `bldg_nm`, `sector_no`, `location`, `stamp_duty`, `reg_dhc`, `noc`, `staff_incentive`, `agent_paid`, `outside_visit`, `urgent_doc`, `total_amt`, `received_amt`, `challan_amt`, `upload_1`, `upload_2`, `upload_3`, `upload_4`, `upload_5`, `comments`, `delivery_status`, `record_status`,`labels`,  `timestamp`) VALUES ('$token','$owner_name','$owner_mobile','$owner_dob','$alt_owner_name','$alt_owner_mobile','$alt_owner_dob','$tenant_name','$tenant_mobile','$tenant_dob','$alt_tenant_name','$alt_tenant_mobile','$alt_tenant_dob','$staff_name','$agent_name','$agreement_start_date','$agreement_end_date','$flat_no','$floor_no','$plot_no','$bldg_nm','$sector_no','$location', '$stamp_duty','$reg_dhc','$noc','$staff_incentive','$agent_paid','$outside_visit','$urgent_doc','$total_amt','$received_amt','$challan_amt','$pdffiles[0]','$pdffiles[1]','$pdffiles[2]','$pdffiles[3]','$pdffiles[4]','$comments','$deli_status','$status','$labels','$timestamp')";
	
	// echo $insert; exit;

	$res_ins = mysqli_query($con, $insert);

	if ($res_ins)
    {
        $sel_users = "SELECT * FROM `users` WHERE (`mobile` = '$owner_mobile' OR `alt_mobile` = '$owner_mobile')";
	    $res_users = mysqli_query($con_dp, $sel_users);
        if(mysqli_num_rows($res_users) === 0)
        {
            $ins_usrs = "INSERT INTO `users`(`entry_date`, `fname`, `mobile`) VALUES ('$timestamp','$owner_name','$owner_mobile')";
            $res_usrs = mysqli_query($con_dp, $ins_usrs);
        }

      echo "<script language='javascript'>
          window.alert('Details have been added successfully');
           window.location.href='index1.php'; 
      </script>
      ";
    }
    else
    {
    	echo "<pre>";print_r($con->error);die();
      echo "<script language='javascript'>
          window.alert('There may be a technical problem, please try again later!');
           window.location.href=''; 
      </script>
      ";
    }
}
?>