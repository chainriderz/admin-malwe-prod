<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$currdate = date('Y-m-d H:i:s');
?>
<footer class="bg-lblue footer text-center text-light">
					<div class="container-fluid">						
						<div class="copyright m-auto">
							Copyrights &copy; 2017 - <?php echo date('Y') ?> Malwe Enterprises Pvt Ltd. All Rights Reserved.
						</div>				
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i>Logout Message</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Are you sure to logout ?</p>
				</div>
				<div class="modal-footer">
					<a href="?logout" class="btn btn-success">OK</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal modal-fullscreen fade" id="modalViewAllNotify" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered" role="document">
    		<div class="modal-content">
    			<div class="modal-header bg-default">
    				<h6 class="modal-title">View Notifications</h6>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true" class="text-light">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
        			<div class="row">
        			    <div class="col-md-6">
        			        <div class="card">
        			            <div class="card-header font-weight-bold text-center text-uppercase">
        			                Renewal
        			            </div>
        			            <div class="card-body">
        			                <div class="table-responsive">
                			            <table id="renewal_dataTable" class="table table-bordered table-hover" data-page-length='5'>
                			                <thead>
                			                    <tr>
                			                        <th>Sr.No.</th>
                			                        <th>Token No.</th>
                			                        <th>Name</th>
                			                        <th>End Date</th>
                			                    </tr>
                			                </thead>
                			                <tbody>
                			                    <?php
                			                        $sel_renewal = "SELECT *,DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) AS `date_diff` from `registered_document` WHERE DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) <= 10 OR DATEDIFF(`agreement_end_date`, convert_tz(now(),'+00:00','+05:30')) <= 30 AND `record_status` = 'Active' HAVING `date_diff` > 0";
                			                        $res_renewal = mysqli_query($con, $sel_renewal);
                			                        if(mysqli_num_rows($res_renewal) > 0)
                			                        {
                			                            $srno = 1;
                			                            while($row_renewal = mysqli_fetch_array($res_renewal))
                			                            {
                			                    ?>
                			                    <tr>
                			                        <td><?php echo $srno; ?></td>
                			                        <td><?php echo $row_renewal['token']; ?></td>
                			                        <td><?php echo $row_renewal['tenant_name']; ?></td>
                			                        <td><?php echo $row_renewal['agreement_end_date']; ?></td>
                			                    </tr>
                			                    <?php
                			                            $srno++;
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
        			            <div class="card-header font-weight-bold text-center text-uppercase">
        			                Schedule Work
        			            </div>
        			            <div class="card-body">
                			        <div class="table-responsive">
                			            <table id="schedule_dataTable" class="table table-bordered table-hover" data-page-length='5'>
                			                <thead>
                			                    <tr>
                			                        <th>Sr.No.</th>
                			                        <th>Name</th>
                			                        <th>Work</th>
                			                        <th>DateTime Schedule</th>
                			                    </tr>
                			                </thead>
                			                <tbody>
                			                    <?php
                			                        $sel_schedule = "SELECT * FROM `enquiry` WHERE DATE(datetime_schedule) = DATE_FORMAT('$currdate', '%Y-%m-%d')";
                			                        $res_schedule = mysqli_query($con, $sel_schedule);
                			                        if(mysqli_num_rows($res_schedule) > 0)
                			                        {
                			                            $srno = 1;
                			                            while($row_schedule = mysqli_fetch_array($res_schedule))
                			                            {
                			                    ?>
                			                    <tr>
                			                        <td><?php echo $srno; ?></td>
                			                        <td><?php echo $row_schedule['name']; ?></td>
                			                        <td>
                			                            <?php
                			                                $sel_work = "SELECT * FROM `work_services` WHERE `w_id` = '$row_schedule[work]'";
                			                                $res_work = mysqli_query($con, $sel_work);
                			                                $row_work = mysqli_fetch_array($res_work);
                			                                echo $row_work['w_name'];
                			                            ?>
                			                        </td>
                			                        <td><?php echo date('Y-m-d h:i a', strtotime($row_schedule['datetime_schedule'])); ?></td>
                			                    </tr>
                			                    <?php
                			                            $srno++;
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
        			            <div class="card-header font-weight-bold text-center text-uppercase">
        			                Agent Birthdays
        			            </div>
        			            <div class="card-body">
                			        <div class="table-responsive">
                			            <table id="agent_birthday_dataTable" class="table table-bordered table-hover" data-page-length='5'>
                			                <thead>
                			                    <tr>
                			                        <th width="10%">Sr.No.</th>
                			                        <th width="90%">Name</th>
                			                    </tr>
                			                </thead>
                			                <tbody>
                			                    <?php
                			                        $sel_agentb = "SELECT * FROM `agent` WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT('$currdate', '%m-%d')";
                			                        $res_agentb = mysqli_query($con, $sel_agentb);
                			                        if(mysqli_num_rows($res_agentb) > 0)
                			                        {
                			                            $srno = 1;
                			                            while($row_agentb = mysqli_fetch_array($res_agentb))
                			                            {
                			                    ?>
                			                    <tr>
                			                        <td><?php echo $srno; ?></td>
                			                        <td><?php echo $row_agentb['agent_name']; ?></td>
                			                    </tr>
                			                    <?php
                			                            $srno++;
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
        			            <div class="card-header font-weight-bold text-center text-uppercase">
        			                Staff Birthdays
        			            </div>
        			            <div class="card-body">
                			        <div class="table-responsive">
                			            <table id="staff_birthday_dataTable" class="table table-bordered table-hover" data-page-length='5'>
                			                <thead>
                			                    <tr>
                			                        <th width="10%">Sr.No.</th>
                			                        <th width="90%">Name</th>
                			                    </tr>
                			                </thead>
                			                <tbody>
                			                    <?php
                			                        $sel_staffb = "SELECT * FROM `staff` WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT('$currdate', '%m-%d')";
                			                        $res_staffb = mysqli_query($con, $sel_staffb);
                			                        if(mysqli_num_rows($res_staffb) > 0)
                			                        {
                			                            $srno = 1;
                			                            while($row_staffb = mysqli_fetch_array($res_staffb))
                			                            {
                			                    ?>
                			                    <tr>
                			                        <td><?php echo $srno; ?></td>
                			                        <td><?php echo $row_staffb['name']; ?></td>
                			                    </tr>
                			                    <?php
                			                            $srno++;
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
    	</div>
    </div>
</body>
<?php

if(isset($_GET['logout']))
{
	session_start();
   // remove all session variables
   session_unset(); 
   // destroy the session 
   session_destroy(); 
   echo ("<script LANGUAGE='JavaScript'>
       window.location.href='login.php';
       </script>");
}

?>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
<script src="assets/datatables/jquery.dataTables.js"></script>
<script src="assets/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="assets/js/jquery.tabletoCSV.js" type="text/javascript"></script>
<script src="assets/js/jquery.table2excel.js" type="text/javascript"></script>
<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="assets/js/main.js?v=14"></script>
<script src="assets/js/ready.min.js?version=3.0.6"></script>
<script src="assets/js/demo.js?version=1.0.4"></script>

<script src="assets/js/sb-admin-datatables.min.js?version=1.0.24"></script>
</html>