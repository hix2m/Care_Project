<?php
session_start();
// include_once '../connection/server.php';
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$res=mysqli_query($con,"SELECT * FROM patient WHERE PatientCin='".$_SESSION['patientSession']."'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
//variables
$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientMaritialStatus = $_POST['patientMaritialStatus'];
$patientDN = $_POST['patientDN'];
$patientGender = $_POST['patientGender'];
$patientAddress = $_POST['patientAddress'];
$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
$patientId = $_POST['patientId'];
// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
$res=mysqli_query($con,"UPDATE patient SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientMaritialStatus='$patientMaritialStatus', patientDN='$patientDN', patientGender='$patientGender', patientAddress='$patientAddress', patientPhone=$patientPhone, patientEmail='$patientEmail' WHERE PatientCin=".$_SESSION['patientSession']);
// $userRow=mysqli_fetch_array($res);
header( 'Location: profile.php' ) ;
}
?>
<?php
$homme="";
$femme="";
if ($userRow['patientGender']=='homme') {
$homme = "checked";
}elseif ($userRow['patientGender']=='femme') {
$femme = "checked";
}
$celibataire="";
$marie="";
$separe="";
$divorce="";
$veuf="";
if ($userRow['patientMaritialStatus']=='celibataire') {
$celibataire = "checked";
}elseif ($userRow['patientMaritialStatus']=='marie') {
$marie = "checked";
}elseif ($userRow['patientMaritialStatus']=='separe') {
$separe = "checked";
}elseif ($userRow['patientMaritialStatus']=='divorce') {
$divorce = "checked";
}elseif ($userRow['patientMaritialStatus']=='veuf') {
$veuf = "checked";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Patient Dashboard</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
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
					<a class="navbar-brand" href="patient.php" style="padding-top: 10px; text-align: center; color: rgb(0, 171, 88); font-family:'Times New Roman', Times, serif; font-size: 40px;"><span id="logoCare">Care</span></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['PatientCin']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['PatientCin']; ?>">Rendez vous</a></li>
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
		<!-- Menu -->
		
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
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">metre a jour Profile</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?> </h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" style="text-align: centrer;">
											<tbody>
												
												
												<tr>
													<td>Situation Familiale </td>
													<td><?php echo $userRow['patientMaritialStatus']; ?></td>
												</tr>
												<tr>
													<td>Date de Naissance </td>
													<td><?php echo $userRow['patientDN']; ?></td>
												</tr>
												<tr>
													<td>Sexe</td>
													<td><?php echo $userRow['patientGender']; ?></td>
												</tr>
												<tr>
													<td>Adresse </td>
													<td><?php echo $userRow['patientAddress']; ?>
													</td>
												</tr>
												<tr>
													<td>Numero Telephone</td>
													<td><?php echo $userRow['patientPhone']; ?>
													</td>
												</tr>
												<tr>
													<td>Email</td>
													<td><?php echo $userRow['patientEmail']; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" >
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td>CIN :</td>
														<td><?php echo $userRow['PatientCin']; ?></td>
													</tr>
													<tr>
														<td>Prénom:</td>
														<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
													</tr>
													<tr>
														<td>Nom :</td>
														<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
													</tr>
													
													<!-- radio button -->
													<tr>
														<td>Situation Familiale:</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="celibataire" <?php echo $celibataire; ?>>Célibateire</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="marie" <?php echo $marie; ?>>Marié</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="divorce" <?php echo $divorce; ?>>Divorcé</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="veuf" <?php echo $veuf; ?>>Veuf</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													<tr>
														<td>Date Naissance</td>
														<!-- <td><input type="text" class="form-control" name="patientDN" value="<?php echo $userRow['patientDN']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="patientDN" name="patientDN" placeholder="MM/DD/YYYY" type="text" value="<?php echo $userRow['patientDN']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<!-- radio button -->
													<tr>
														<td>Sexe</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="homme" <?php echo $homme; ?>>Homme</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="femme" <?php echo $femme; ?>>Femme</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													
													<tr>
														<td>Numero de Telephone</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td>Email</td>
														<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
													</tr>
													<tr>
														<td>Address</td>
														<td><textarea class="form-control" name="patientAddress"  ><?php echo $userRow['patientAddress']; ?></textarea></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Modifier Infos"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			
			<script type="text/javascript">
														$(function () {
														$('#patientDN').datetimepicker();
														});
														</script>
		</body>
	</html>