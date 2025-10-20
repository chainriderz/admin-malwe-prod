<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
  include("../config.php");
  
  session_start();
  if(!empty($_SESSION["admin_login"]))
  {
    $admin = $_SESSION["admin_login"];
    if(time()-$_SESSION["login_time_stamp"] > 14400) 
    {
        session_unset();
        session_destroy();
        echo ("<script LANGUAGE='JavaScript'>
          window.location.href='login.php';
    	</script>");
    }
  }
  else
  {
      echo ("<script LANGUAGE='JavaScript'>
      window.location.href='login.php';
      </script>");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>ADMIN | MALWE ENTERPRISES PVT LTD.</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/filemanager.css?v=1">
	<link rel="stylesheet" href="assets/css/ready.css?version=2.0.2">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header bg-dblue">
			<div class="logo-header">
				<a href="index.php" class="logo">
					<img src="assets/img/logo.jpeg" alt="Avatar Logo" class="w-100 h-100">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">

					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						 <li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-bell"></i>
								<span class="notification count_notify"></span>
							</a>
							<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
								<li>
									<div class="dropdown-title">Renewal Notifications</div>
								</li>
								<li>
									<div class="notif-center renewal_notifications"></div>
								</li>
								<li>
									<div class="dropdown-title">Schedule Work Notifications</div>
								</li>
								<li>
								    <div class="notif-center schedule_notifications"></div>
								</li>
								<li>
									<div class="dropdown-title">Birthday Notifications</div>
								</li>
								<li>
								    <div class="notif-center birthday_notifications"></div>
								</li>
								<li>
									<a class="see-all" href="#" data-toggle="modal" data-target="#modalViewAllNotify">
									    <strong>See all notifications</strong>
									    <i class="la la-angle-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="assets/img/admin.png" alt="user-img" width="36" class="img-circle"><span >Welcome, <?php echo $admin; ?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="assets/img/admin.png" alt="user"></div>
										<div class="u-text">
											<h4><?php echo $admin; ?></h4>
											<p class="text-muted">Administrator</p>
											 <a href="profile.php" class="btn btn-rounded btn-primary btn-sm"><i class="fa fa-user"></i></a> 
											<a data-toggle="modal" data-target="#modalLogout" class="btn-rounded btn-danger btn-sm" href="#"><i class="fa fa-power-off"></i></a>
										</div>
										</div>
									</li>
									<!-- <div class="dropdown-divider"></div> -->
									<!-- <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
									<a class="dropdown-item" href="#"></i> My Balance</a>
									<a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
									<div class="dropdown-divider"></div> -->
									<!-- <a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a> -->
									<!-- <div class="dropdown-divider"></div> -->
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
				</div>
			</nav>
			</div>
			<div class="sidebar bg-dblue">
				<div class="scrollbar-inner sidebar-wrapper">
					<ul class="nav">
						<li class="nav-item dashboard">
							<a href="index1.php">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>
						<li class="nav-item registered_document">
							<a href="index.php">
								<i class="la la-files-o"></i>
								<p>Documents</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>
						<li class="nav-item registered_document_expiry">
							<a href="index1_expiry.php">
								<i class="fa fa-calendar-times-o"></i>
								<p>Upcoming Expiry</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>
						<li class="nav-item enquiry">
							<a href="enquiry.php">
								<i class="fa fa-file-text-o"></i>
								<p>Schedule Work</p>
								<!-- <span class="badge badge-count">50</span> -->
							</a>
						</li>
						<li class="nav-item add_agent">
							<a href="agent.php">
								<i class="la la-users"></i>
								<p>Agent</p>
								<!-- <span class="badge badge-success">3</span> -->
							</a>
						</li>
						<li class="nav-item drive">
							<a href="drive.php">
								<i class="fa fa-hdd-o" aria-hidden="true"></i>
								<p>Drive</p>
							</a>
						</li>
						<li class="nav-item profile">
							<a href="profile.php">
								<i class="la la-user"></i>
								<p>Edit Profile</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>
						<li class="nav-item record_status">
							<a href="record_status.php">
								<i class="la la-pencil-square"></i>
								<p>Record Status</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>
						<li class="nav-item labels">
							<a href="labels.php">
								<i class="la la-tag"></i>
								<p>Labels</p>
								<!-- <span class="badge badge-count">5</span> -->
							</a>
						</li>
						<li class="nav-item add_staff">
							<a href="staff.php">
								<i class="la la-users"></i>
								<p>Create Staff</p>
								<!-- <span class="badge badge-success">3</span> -->
							</a>
						</li>
						<li class="nav-item add_work">
							<a href="work-service.php">
								<i class="la la-gear"></i>
								<p>Add Work</p>
								<!-- <span class="badge badge-success">3</span> -->
							</a>
						</li>
						<li class="nav-item header_section">
							<a href="header-section.php">
								<i class="la la-header"></i>
								<p>Header Section</p>
								<!-- <span class="badge badge-count">14</span> -->
							</a>
						</li>
						
						<li class="nav-item miscellanous">
							<a href="miscellanous.php">
								<i class="la la-random"></i>
								<p>Miscellanous</p>
								<!-- <span class="badge badge-count">6</span> -->
							</a>
						</li>
						
						<!-- <li class="nav-item">
							<a href="typography.html">
								<i class="la la-font"></i>
								<p>Typography</p>
								<span class="badge badge-danger">25</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="icons.html">
								<i class="la la-fonticons"></i>
								<p>Icons</p>
							</a>
						</li> -->
					</ul>
				</div>
			</div>
			<div class="main-panel">