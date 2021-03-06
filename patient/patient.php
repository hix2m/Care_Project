<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}

$usersession = $_SESSION['patientSession'];


$res=mysqli_query($con,"SELECT * FROM patient WHERE PatientCin='".$usersession."'");

if ($res===false) {
	echo mysqli_error($con);
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home</title>
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link rel="stylesheet" href="loding.css">
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<link rel="stylesheet" href="../footer_style.css">
		<link href="style.css" rel="stylesheet">
		<link rel="stylesheet" href="scrol.css">
           
		<script src="https://kit.fontawesome.com/0e926b2980.js" crossorigin="anonymous"></script>

	</head>
	<body>
		
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
			
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php" style="padding-top: 15px; text-align: center; color: rgb(0, 171, 88); font-family:'Times New Roman', Times, serif; font-size: 40px;"><span id="logoCare">Care</span></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							 <li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['PatientCin']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>">Rendez vous </a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['PatientCin']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>
								<li>
									<a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>"><i class="fa fa-list-alt" aria-hidden="true"> Rendez-vous</i>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i>Deconnecter</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="head">
			<h2 class="text" style="color: #00ff72" data-text="Care">Care</h2>
			<h5 class="text" style="font-size: 35px; margin-top: -200px;">Votre sant?? est notre priorit??</h5>
		</div>
		<div class="lod">
			<div class="loader">
				<svg width="200" height="150" viewBox="0 0 818 498" fill="none" xmlns="http://www.w3.org/2000/svg">
						<defs>
						<linearGradient id="strokeGradient">
							<stop offset="5%" stop-color="#191919" />
							<stop offset="60%" stop-color="#ff0000" />
							<stop offset="100%" stop-color="#920000" />
						</linearGradient>
						</defs>
						<path class="pulse" d="M0 305.5H266L295.5 229.5L384 496L460 1.5L502.5 377.5L553 305.5H818" stroke-width="8" />
					</svg>
				
		    </div>
		</div>
		<!-- navigation -->
		<?php include_once("liste_doctor.php"); ?>
		<?php include("../footer.php"); ?>	
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
	</body>
</html>