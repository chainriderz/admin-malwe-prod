<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>ADMIN LOGIN | MALWE ENTERPRISES PVT LTD.</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-panel w-100">
			<div class="container">
				<div class="row">
					<div class="col-md-5 m-auto">
						<div class="card mt-5 bg-dblue" style="border-radius: 25px;">
							<div class="card-header text-center">
								<img src="assets/img/logo.jpeg" style="height: 80px;" class="img-fluid">
								<div class="card-title text-light text-uppercase">Admin Login</div>
							</div>
							<div class="card-body">
								<form class="adminlogin-form">
									<div class="form-group">
										<label for="email" class="text-light">Name</label>
										<input type="text" class="form-control" id="adname" placeholder="Enter Name" value="Pramod Malwe" readonly required>
									</div>
									<div class="form-group">
										<label for="password" class="text-light">Mobile</label>
										<input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" id="admobile" placeholder="Enter Mobile" required>
									</div>
									
									<!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#otplogin">OTP Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#passlogin">Password Login</a>
                                        </li>
                                    </ul>
                                    
                                    <div class="tab-content">
                                        <div id="otplogin" class="tab-pane fade in active show">
                                            <button type="button" class="btn btn-success w-100 my-3 ad_verify_mobile">VERIFY MOBILE</button>

        									<div class="form-group ad_otp_field">
        										<label for="password" class="text-light">OTP</label>
        										<input type="number" class="form-control" id="adotp" placeholder="Enter OTP" required>
        										<span class="text-danger" id="otp_error"></span>
        										
        										<div class="text-right">
        							              <span class="p-2 text-light ad_count_time"></span><a href="#" class="btn btn-primary btn-sm disabled ad_resend">Resend OTP</a>
        							            </div>
        									</div>
        									<div class="form-group">
        										<button type="button" class="btn btn-success form-control ad_otp_btn">LOGIN</button>
        									</div>
                                        </div>
                                        
                                        <div id="passlogin" class="tab-pane fade">
                                            <div class="form-group">
        										<label for="email" class="text-light">Password</label>
        										<input type="password" class="form-control" id="adpass" placeholder="Enter Password" required>
        									</div>
        									
        									<div class="form-group">
        										<button type="button" class="btn btn-success form-control mb-3 ad_pass_btn">LOGIN</button>
        									</div>
                                        </div>
                                    </div>

									

									<!-- <div class="card-action text-center ad_otp_content">
										
									</div> -->
								</form>
								<div id="adotp_message"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="text-center">
				<p>Copyrights &copy; 2017 - <?php echo date('Y') ?> Malwe Enterprises Pvt Ltd. All Rights Reserved.</p>
			</div>
		</div>
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="assets/js/ready.min.js?version=1.0.1"></script>
<!-- <script src="assets/js/demo.js"></script> -->
</html>