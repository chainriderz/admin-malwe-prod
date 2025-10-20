<?php include("header.php");  ?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Enquiry</h4>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<span class="float-left font-weight-bold" style="font-size: 20px;">HOME LOAN SERVICE</span>
						<button class="btn btn-success float-right" type="button" onclick="exporttoexcelHomeLoan()" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download</button>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="HomeLoandataTable" class="table table-bordered table-head-bg-default table-bordered-bd-default table-hover bg-white homeloan_data" style="width:100%">
						        <thead>
						            <tr>				                
						                <th>Sr No.</th>
						                <th>Name</th>
						                <th>Mobile</th>
						            </tr>
						        </thead>
						        <tbody>
						            <?php
						            	$select_reg = "SELECT * FROM `homeloan_service` ORDER BY `hl_id` DESC";
						            	$res_reg = mysqli_query($con, $select_reg);
						            	if(mysqli_num_rows($res_reg) > 0)
						            	{
						            		$hlsr = 1;
						            		while ($row_reg = mysqli_fetch_array($res_reg))
						            		{
						            			$hl_mobile = $row_reg["hl_mobile"];
						            			$hl_name = $row_reg["hl_name"];
						            ?>
						            <tr>				                
						                <td><?php echo $hlsr; ?></td>
						                <td><?php echo $hl_name; ?></td>
						                <td><a href="tel:+91<?php echo $hl_mobile; ?>">+91 <?php echo $hl_mobile; ?></a></td>
						            </tr>
						            <?php
						            		$hlsr++;
							            	}
							            }
						            ?>
						        </tbody>
						    </table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<span class="float-left font-weight-bold" style="font-size: 20px;">RENT AGREEMENT</span>
						<button class="btn btn-success float-right" type="button" onclick="exporttoexcelRentAgreement()" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download</button>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="RentAgmtdataTable" class="table table-bordered table-head-bg-default table-bordered-bd-default table-hover bg-white rentagmt_data" style="width:100%">
						        <thead>
						            <tr>				                
						                <th>Sr No.</th>
						                <th>Name</th>
						                <th>Mobile</th>
						            </tr>
						        </thead>
						        <tbody>
						            <?php
						            	$select_ra = "SELECT * FROM `rent_agreement` ORDER BY `r_id` DESC";
						            	$res_ra = mysqli_query($con, $select_ra);
						            	if(mysqli_num_rows($res_ra) > 0)
						            	{
						            		$rasr = 1;
						            		while ($row_ra = mysqli_fetch_array($res_ra))
						            		{
						            			$ra_mobile = $row_ra["r_mobile"];
						            			$ra_name = $row_ra["r_name"];
						            ?>
						            <tr>				                
						                <td><?php echo $rasr; ?></td>
						                <td><?php echo $ra_name; ?></td>
						                <td><a href="tel:+91<?php echo $ra_mobile; ?>">+91 <?php echo $ra_mobile; ?></a></td>
						            </tr>
						            <?php
						            		$rasr++;
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
	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
	$(".sidebar .nav .enquiry").addClass("active");
</script>