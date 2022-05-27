<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session=$_SESSION[ 'patientSession'];
$res=mysqli_query($con, "SELECT d.*, a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.PatientCin = b.PatientCin
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	JOIN doctor d
	   ON d.DoctorCin = c.doctor
	WHERE b.PatientCin ='$session'");
	if (!$res) {
		die( "Error running $sql: " . mysqli_error($con));
	}
$userRow=mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Liste De Rendez Vous </title>
		<link href="assets/css/material.css" rel="stylesheet">
		
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		<style>
			.imp{
				align-items: center;
				font-size: 30px;
			}
		</style>

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
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo2.png" height="40px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['PatientCin']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>">Rendez Vous</a></li>
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
									<a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>"><i class="glyphicon glyphicon-file"></i> Rendez Vous</a>
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
<!-- display appoinment start -->
<?php


echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='page-header'>";
echo "<h1>La Liste Des Rendez Vous. </h1>";
echo "</div>";
echo "<div class='panel panel-primary'>";
echo "<div class='panel-heading' style='text-align: center;'>List de Rendez Vous</div>";
echo "<div class='panel-body'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Nom Doctor</th>";
echo "<th>Votre Nom</th>";
echo "<th>Votre Prenom </th>";
echo "<th>Jour de Rendez Vou </th>";
echo "<th>Date De Rendez Vous  </th>";
echo "<th>L'heur de Demmare </th>";
echo "<th>L'heure de fin </th>";
echo "<th>Imprimer </th>";
echo "</tr>";
echo "</thead>";
$res = mysqli_query($con, "SELECT d.*, a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.PatientCin = b.PatientCin
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	JOIN doctor d
	ON d.DoctorCin = c.doctor
	WHERE b.PatientCin ='$session'");

if (!$res) {
die("Error running $sql: " . mysqli_error($con));
}


while ($userRow = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $userRow['doctorFirstName']." ".$userRow['doctorFirstName']. "</td>";
echo "<td>" . $userRow['patientFirstName'] . "</td>";
echo "<td>" . $userRow['patientLastName'] . "</td>";
echo "<td>" . $userRow['scheduleDay'] . "</td>";
echo "<td>" . $userRow['scheduleDate'] . "</td>";
echo "<td>" . $userRow['startTime'] . "</td>";
echo "<td>" . $userRow['endTime'] . "</td>";
echo "<td><a href='invoice.php?appid=".$userRow['appId']."&doctor=".$userRow['DoctorCin']."' target='_blank'><ion-icon name='document-text-outline' claass='imp'></ion-icon></a> </td>";
}

echo "</tr>";
echo "</tbody>";
echo "</table>";

?>
	</div>
</div>
</div>
</div>
<!-- display appoinment end -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>