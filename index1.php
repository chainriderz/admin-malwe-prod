<?php 
include("header.php");

function getAll($con, $query){
	$data = [];
	$res_reg = mysqli_query($con, $query);
	if(mysqli_num_rows($res_reg) > 0)
	{
		while ($row_reg = mysqli_fetch_assoc($res_reg))
		{
			$data[] = $row_reg;
		}
	}
	return $data;
}

$record_status_data = getAll($con, 'SELECT status FROM `record_status`');
$record_status_arr = array_column($record_status_data, 'status');

$labels_data = getAll($con, 'SELECT name FROM `labels`');
$labels_arr = array_column($labels_data, 'name');

$staff_data = getAll($con, 'SELECT name, sid FROM `staff`');
$staff_arr = array_column($staff_data, 'name', 'sid');
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Registered Documents</h4>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">Search
						<a class="close" aria-label="Close" title="Close" data-toggle="collapse" data-target="#card-body-index">
                            <span aria-hidden="true">&times;</span>
                        </a>
					</div>				
					<div class="card-body" id="card-body-index" class="collapse">
						<form action="" class="add-user-form" method="GET" enctype="multipart/form-data">
							<?php
							$startSearch = isset($_GET['startSearch']) ? $_GET['startSearch'] : '';
							$endSearch = isset($_GET['endSearch']) ? $_GET['endSearch'] : '';
							?>
							<input type="hidden" id="startSearch" name="startSearch" value="<?= $startSearch ?>">
							<input type="hidden" id="endSearch" name="endSearch" value="<?= $endSearch ?>">
						    <div class="form-row">
								<div class="form-group col-md-2">
									<label for="">Amount</label>
									<select class="form-control" id="amtSearch" name="amtSearch">
										<?php
										$selectedPaid = (isset($_GET['amtSearch']) && $_GET['amtSearch']=='Paid') ? ' selected="selected"' : '';
										$selectedBalance = (isset($_GET['amtSearch']) && $_GET['amtSearch']=='Balance') ? ' selected="selected"' : '';
										$selectedEstimate = (isset($_GET['amtSearch']) && $_GET['amtSearch']=='Estimate') ? ' selected="selected"' : '';
										?>
										<option value="">All</option>
										<option value="Paid" <?= $selectedPaid ?> >Paid</option>
										<option value="Balance" <?= $selectedBalance ?> >Balance</option>
										<option value="Estimate" <?= $selectedEstimate ?> >Estimate</option>
									</select>
								</div>

								
								<div class="form-group col-md-2">
									<label for="">Record Status</label>
									<select class="form-control" id="statusSearch" name="statusSearch">
										<option value=''>All</option>
										<?php
										foreach ($record_status_arr as $key => $value) {
											$selected = (isset($_GET['statusSearch']) && $_GET['statusSearch']==$value) ? ' selected="selected"' : '';
											echo "<option value='{$value}' {$selected}>{$value}</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group col-md-2">
									<label for="">Labels</label>
									<select class="form-control" id="labelsSearch" name="labelsSearch">
										<option value=''>All</option>
										<?php
										foreach ($labels_arr as $key => $value) {
											$selected = (isset($_GET['labelsSearch']) && $_GET['labelsSearch']==$value) ? ' selected="selected"' : '';
											echo "<option value='{$value}' {$selected}>{$value}</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group col-md-2">
									<label for="">Staff</label>
									<select class="form-control" id="staffSearch" name="staffSearch">
										<option value=''>All</option>
										<?php
										foreach ($staff_arr as $key => $value) {
											$selected = (isset($_GET['staffSearch']) && $_GET['staffSearch']==$key) ? ' selected="selected"' : '';
											echo "<option value='{$key}' {$selected}>{$value}</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group col-md-3">
									<label for="">Search by Date</label>
									<div id="reportrange" class="bg-light border btn btn-md" align="center">
			    						<i class="fa fa-calendar"></i>&nbsp;
			    						<span></span> <i class="fa fa-caret-down"></i>
			    					</div>
								</div>
							</div>

							<div class="form-row mb-4">
									<div class="col-auto">
										<button type="submit" class="btn btn-primary w-100 btnSearch">
										<span class="fa fa-search fa-lg" aria-hidden="true"></span> Search
										</button>
									</div>

									<?php
									if(isset($_GET) && !empty($_GET)){
									?>
										<div class="col-auto">
											<a href="index1.php" class="btn btn-danger w-100"><i class="fa fa-times-circle  fa-lg" aria-hidden="true"></i> Clear Search</a>
										</div>
									<?php
									}
									?>

									<div class="col-auto">
										<button class="btn btn-success" type="button" onclick="exporttoexceldata()" ><i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Download</button>
									</div>
									
									<div class="col-auto">
										<a href="add_register_document.php" class="btn btn-info w-100"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Add New</a>
									</div>
							</div>

							<div class="form-row">
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header font-weight-bold text-uppercase">REGISTERED DOCUMENT DETAILS</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="datatable_example" class="table table-bordered">
								<thead class="thead-light">
									<tr>
										<th>Sr. No.</th>
										<th>Entry Date</th>
										<th>Token</th>
										<th>Owner Name</th>
										<th>Owner Mobile</th>
										<th>Tenant Name</th>
										<th>Tenant Mobile</th>
										<th>Staff Name</th>
										<th>Agent Name</th>
										<th>Agreement Start Date</th>
										<th>Agreement End Date</th>
										<th>Location</th>
										<th>Amount</th>
										<th>Delivery Status</th>
										<th>Record Status</th>
										<th>Labels</th>
										<th class="d-none">Labels</th>
										<th class="d-none">Labels</th>
										<th class="d-none">Labels</th>
										<th class="d-none">Labels</th>
										<th class="d-none">Labels</th>
										<th>Actions</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<div class="clone_table d-none">
	<table id="datatable_example_copy" class="table table-bordered">
		<thead class="thead-light">
			<tr>
				<th>Sr. No.</th>
				<th>Entry Date</th>
				<th>Token</th>
				<th>Owner Name</th>
				<th>Owner Mobile</th>
				<th>Tenant Name</th>
				<th>Tenant Mobile</th>
				<th>Staff Name</th>
				<th>Agent Name</th>
				<th>Agreement Start Date</th>
				<th>Agreement End Date</th>
				<th>Location</th>
				<th>Amount</th>
				<th>Delivery Status</th>
				<th>Record Status</th>
				<th>Labels</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($_SESSION["registered_document_table_data"])){
				$excel_data = $_SESSION["registered_document_table_data"];
				foreach ($excel_data as $key => $row_reg) {
					$sr = $row_reg["sr_no"];
					$timestamp = $row_reg["timestamp"];
					$date_diff = $row_reg["date_diff"];
					$reg_id = $row_reg["reg_id"];
					$token = $row_reg["token"];
					$owner_name = $row_reg["owner_name"];
					$owner_mobile = $row_reg["owner_mobile"];
					$tenant_name = $row_reg["tenant_name"];
					$tenant_mobile = $row_reg["tenant_mobile"];
					$staff_name = $row_reg["sname"];
					$agent_name = $row_reg["aname"];
					$agreement_start_date = $row_reg["agreement_start_date"];
					$agreement_end_date = $row_reg["agreement_end_date"];
					$location = $row_reg["location"];
					$total_amt = $row_reg["total_amt"];
					$received_amt = $row_reg["received_amt"];
					$deli_status = $row_reg["delivery_status"];
					$record_status = $row_reg["record_status"];
					$labels = $row_reg["labels"];
					?>
					<tr>
					<td><?= $sr; ?></td>
				    <td><?php echo date_format(date_create($timestamp),"Y-m-d"); ?></td>			            	
					<td><?php echo $token; ?></td>				                
					<td><?php echo $owner_name; ?></td>
					<td>
					    <?php
					        if(!empty($owner_mobile))
					        {
					    ?>
					        <a href="tel:+91<?php echo $owner_mobile; ?>" class="">+91 <?php echo $owner_mobile; ?></a>
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
					    <?php
					        }
					    ?>
					</td>
					<td><?php echo $staff_name; ?></td>
					<td><?php echo $agent_name; ?></td>
					<td><?php echo $agreement_start_date; ?></td>
					<td><?php echo $agreement_end_date; ?></td>
					<td><?php echo $location; ?></td>
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
					<td><?php echo $labels; ?></td>
					</tr>
				<?php
				}
			}
			?>
		</tbody>
	</table>
</div>





<?php include("footer.php"); ?>
<?php
$getAmt = '';
$getStatus = '';
$getLabels = '';
$getStaff = '';
$getStart = '';
$getEnd = '';

if(isset($_GET['amtSearch']) && $_GET['amtSearch']!=''){
	$getAmt = $_GET['amtSearch'];
}

if(isset($_GET['statusSearch']) && $_GET['statusSearch']!=''){
	$getStatus = $_GET['statusSearch'];
}

if(isset($_GET['labelsSearch']) && $_GET['labelsSearch']!=''){
	$getLabels = $_GET['labelsSearch'];
}

if(isset($_GET['staffSearch']) && $_GET['staffSearch']!=''){
	$getStaff = $_GET['staffSearch'];
}

if(isset($_GET['startSearch']) && $_GET['startSearch']!='' && isset($_GET['endSearch']) && $_GET['endSearch']!=''){
	$getStart = $_GET['startSearch'];
	$getEnd = $_GET['endSearch'];
}

?>
<script>
	$(".sidebar .nav .dashboard").addClass("active");
	$(document).ready(function(){
		var amt = '<?php echo $getAmt;?>';
		var status = '<?php echo $getStatus;?>';
		var labels = '<?php echo $getLabels;?>';
		var staff = '<?php echo $getStaff;?>';
		var start = '<?php echo $getStart;?>';
		var end = '<?php echo $getEnd;?>';
		var url = 'data_process/registered_document_process.php?q=1';
		
		if(amt != ''){
			url = url + "&amt=" + amt;
		}

		if(status != ''){
			url = url + "&status=" + status;
		}

		if(labels != ''){
			url = url + "&labels=" + labels;
		}

		if(staff != ''){
			url = url + "&staff=" + staff;
		}

		if(start != '' && end != ''){
			url = url + "&start=" + start + "&end=" + end;
		}

		var table = $('#datatable_example').dataTable({
	            "bProcessing": true,
	            "sAjaxSource": url,
	            "bPaginate":true,
	            "sPaginationType":"full_numbers",
	            "iDisplayLength": 25,
	            "order":[],
	            "aoColumns": [
	              { mData: 'sr_no' },
	              { mData: 'timestamp' },
	              { mData: 'token' },
	              { mData: 'owner_name' },
	              { mData: 'owner_mobile' },
	              { mData: 'tenant_name' },
	              { mData: 'tenant_mobile' },
	              { mData: 'sname' },
	              { mData: 'aname' },
	              { mData: 'agreement_start_date' },
	              { mData: 'agreement_end_date' },
	              { mData: 'location' },
	              { mData: 'amount' },
	              { mData: 'delivery_status' },
	              { mData: 'record_status' },
	              { mData: 'labels' },
	              { mData: 'upload_1' },
	              { mData: 'upload_2' },
	              { mData: 'upload_3' },
	              { mData: 'upload_4' },
	              { mData: 'upload_5' },
	              { mData: 'actions' }
	            ],
	            'columnDefs' : [
        			//hide the second & fourth column
        			{ 'visible': false, 'targets': [16,17,18,19,20] }
        		]
	    });
	});
	var table_copy1 = $("#datatable_example_copy").DataTable({ paging: false });
	function exporttoexceldata()
    {
        // Clone the element to export
        let clone = $('#datatable_example_copy');
      
        $(clone).table2excel({
          exclude:".noExl",
          name:"Worksheet Name",
          filename:"RegisteredDocument",
          fileext:".xls",
          exclude_img:true,
          exclude_links:false,
          exclude_inputs:true
        });
    }
    /*$(".btnSearch").click(function(){
    	var a = $("#message span").text("hello world!");
    	alert(a);
    });*/
</script>

