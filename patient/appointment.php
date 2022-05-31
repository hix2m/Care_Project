<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session= $_SESSION['patientSession'];

if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['scheduleDate'];
	$appid = $_GET['appid'];
}
// on b.icPatient = a.icPatient
$res = mysqli_query($con,"SELECT d.*, a.*, b.* FROM DOCTOR d , doctorschedule a INNER JOIN patient b
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND b.PatientCin='$session' and a.doctor = '".$_SESSION['doctor_cne']."'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


	
//INSERT
if (isset($_POST['appointment'])) {
	$patientcne = mysqli_real_escape_string($con,$userRow['PatientCin']);
	$scheduleid = mysqli_real_escape_string($con,$appid);
	$symptom = mysqli_real_escape_string($con,$_POST['symptom']);
	$comment = mysqli_real_escape_string($con,$_POST['comment']);
	$avail = "notavail";


	$query = "INSERT INTO appointment (  PatientCin , scheduleId , appSymptom , appComment  )
	VALUES ( '$patientcne',$scheduleid, '$symptom', '$comment') ";

	$result = mysqli_query($con,$query);
	//update table appointment schedule
	$sql1 = "SELECT COUNT($scheduleid) as nombre  from appointment where  scheduleId = $scheduleid";
	$sql2 = "SELECT nombre_patient from doctorschedule  where  scheduleId = $scheduleid";
	$count = mysqli_query($con,$sql1);
	$res_count = mysqli_fetch_array($count,MYSQLI_ASSOC);

	$nomber_patient = mysqli_query($con,$sql2);
	$res_nombrepatient = mysqli_fetch_array($nomber_patient,MYSQLI_ASSOC);
	if($res_count['nombre'] >= $res_nombrepatient['nombre_patient']){
		$sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
		$scheduleres=mysqli_query($con,$sql);
		if ($scheduleres) {
			$btn= "disable";
		} 
	}
	if( $result )
	{
	?>
	<script>
	alert('Appointment made successfully.');
	</script>
	<?php
	header("Location: patientapplist.php");
	}
	else
	{
		echo mysqli_error($con);
	?>
	<script>
	alert('Appointment booking fail. Please try again.');
	</script>
	<?php
	header("Location: patient/patient.php");
	}
//dapat dari generator end
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<title>Make Appoinment</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">


		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

	</head>
	<body>
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php" style="padding-top: 10px; text-align: center; color: rgb(0, 171, 88); font-family:'Times New Roman', Times, serif; font-size: 40px;"><span id="logoCare">Care</span></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['PatientCin']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>">Rendez-Vous</a></li>
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
									<a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>"><i class="glyphicon glyphicon-file"></i> Rendez-Vous</a>
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
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<?php 
								if($userRow['image_profile'] == null){
									?>
									<img src="assets/Image_Profil/profile_not_found_homme.png" class="img-responsive" />
									<?php
								}else{
									?>
									<img src="assets/Image_Profil/<?php echo $userRow['image_profile'] ;?>" class="img-responsive" />
									<?php
								}
								?>
								
								<div class="description">
									<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
									<h5> <strong> Date de Naissace : <?php echo $userRow['patientDN']; ?> </strong></h5>
									<h5> <strong> Email : <?php echo $userRow['patientEmail']; ?> </strong></h5>
									<hr />
									<!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">mettre a jour Profile</button-->
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<form class="form" role="form" method="POST" accept-charset="UTF-8">
											<div class="panel panel-default">
												<div class="panel-heading">Information Personnel</div>
												<div class="panel-body">
													
													Nom est Prenom: <?php echo $userRow['patientFirstName'] ?> <?php echo $userRow['patientLastName'] ?><br>
													CNE : <?php echo $userRow['PatientCin'] ?><br>
													Numero telephone: <?php echo $userRow['patientPhone'] ?><br>
													Address : <?php echo $userRow['patientAddress'] ?>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading"> Information de Rendez Vous</div>
												<div class="panel-body">
													doctor : <?php echo $userRow['doctorFirstName']." ".$userRow['doctorFirstName'] ?><br>
													jour: <?php echo $userRow['scheduleDay'] ?><br>
													Date: <?php echo $userRow['scheduleDate'] ?><br>
													Heur: <?php echo $userRow['startTime'] ?> - <?php echo $userRow['endTime'] ?><br>
													Adress :<?php echo $userRow['doctorAddress'] ?><br>
													Specialité : <?php echo $userRow['Specialite'] ?><br>
													Numero Telephone Doctor : <?php echo $userRow['doctorPhone'] ?><br>
												</div>
											</div>
											
											<div class="form-group">
												<label for="recipient-name" class="control-label">Symptome:</label>
												<input type="text" class="form-control" name="symptom" required>
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Commenter:</label>
												<textarea class="form-control" name="comment" required></textarea>
											</div>
											<div class="form-group">
												<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Prendre Rendez-vous">
											</div>
										</form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
				</body>
			</html>