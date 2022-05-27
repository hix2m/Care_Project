<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}if(!isset($_POST['rendez_vous'])){
	header("Location: patient.php");
}
$_SESSION['doctor_cne'] = $_POST['rendez_vous'];
$usersession = $_SESSION['patientSession'];
$query = "select * from doctor where DoctorCin LIKE '".$_POST['rendez_vous']."'";
$res_doctor = mysqli_query($con,$query);
$res=mysqli_query($con,"SELECT * FROM patient WHERE PatientCin='".$usersession."'");

if ($res===false) {
	echo mysqli_error($con);
} //if($res_doctor == false){echo mysqli_error($con);}

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
$doctorRow = mysqli_fetch_array($res_doctor,MYSQLI_ASSOC);
$doctor =$doctorRow['doctorFirstName']." ".$doctorRow['doctorLastName'];

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Prendez rendez vous </title>

		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
       <script src="https://kit.fontawesome.com/0e926b2980.js" crossorigin="anonymous"></script>

	</head>
	<body>
		
		<!-- Menu -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo2.png" height="40px"></a>
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
									<a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>"><i class="glyphicon glyphicon-file"></i> Rendez vous </a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		
		<!-- 1st section start -->
		<section id="promo-1" class="content">
			<div class="content1">
				<div class="row">
					<div class="col-xs-12 col-md-8">
						<?php if ($userRow['patientMaritialStatus']=="") {
						// <!-- / notification start -->
						echo "<div class='row'>";
							echo "<div class='col-lg-12'>";
								echo "<div class='alert alert-danger alert-dismissable'>";
									echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
									echo " <i class='fa fa-info-circle'></i>  <strong>Please complete your profile.</strong>" ;
								echo "  </div>";
							echo "</div>";
							// <!-- notification end -->
							
							} else {
							}
							?>
							<!-- notification end -->
							<h3>Salut  <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?>. Prenez rendez vous maitenant! avec <?php echo $doctor; ?></h3>
							<br><br>
							<h4>Selectionner la date De rendez Vous </h4>
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
							</div>
						</div>
						<!-- date textbox end -->
						<!-- script start -->
						<script>
						function showUser(str) {
						
						if (str == "") {
						document.getElementById("txtHint").innerHTML = "No data to be shown";
						return;
						} else {
						if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						 }
						};
						xmlhttp.open("GET","getschedule.php?q="+str,true);
						console.log(str);
						xmlhttp.send();
						 }
						}
						</script>
						
						<!-- script start end -->
						
						<!-- table appointment start -->
						<!-- <div class="container"> -->
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div id="txtHint"></div>
								</div>
							</div>
						</div>
						<!-- </div> -->
						<!-- table appointment end -->
					</div>
				</div>
				<!-- /.row -->
			</div>
		
			<div class="content2" >
			
				<div class="img_profile"> 
					<?php 
						if($doctorRow['image_profile'] != null){
							?>
								<img style="width: 100%;" src="assets/Image_Profil/<?php echo $doctorRow['image_profile']; ?>" alt="" srcset="">	
							<?php
						}else{?>
								<img style="width: 100%;" src="assets/Image_Profil/profile_not_found_homme.png" alt="" srcset="">	
	
						<?php
						}
					?>

				</div>
				<div class="contenu_profile">
					<h3>Bienvenu chez le Doctor : <?php echo $doctorRow['doctorFirstName']." ".$doctorRow['doctorLastName']; ?></h3>
					<i>Specialité : <?php echo $doctorRow['Specialite']; ?> </i><br>
					<i>Telephone :<ion-icon name="call-outline"></ion-icon> <?php echo $doctorRow['doctorPhone']; ?></i><br>
					<i>Adress : <?php echo $doctorRow['doctorAddress']; ?></i><br>
					<i>About me : <?php echo $doctorRow['description']; ?></i><br>
					<h4>Réseaux Sociaux :</h4>
					<a class="rs" href="" ><ion-icon name="logo-facebook"></ion-icon></a>
					<a class="rs" href=""><ion-icon name="logo-instagram"></ion-icon></a>
					<a class="rs" href=""><ion-icon name="logo-linkedin"></ion-icon></a>
				</div>
			</div>
		</section>
		<section class="commentaire">
				<div>
				     
				</div>
		</section>
		
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

		
		<!-- date start -->
		<script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script>
		<!-- date end -->
		
		
	</body>
</html>