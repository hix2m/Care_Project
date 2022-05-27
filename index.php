<?php
include_once 'assets/conn/dbconnect.php';
// include_once 'assets/conn/server.php';
?>


<!-- Se Connecter  -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
    header("Location: patient/patient.php");
}
if (isset($_POST['login']))
{
    $CIN = mysqli_real_escape_string($con,$_POST['PatientCin']);
    $password  = mysqli_real_escape_string($con,$_POST['password']);

    $res = mysqli_query($con,"SELECT * FROM patient WHERE PatientCin = '$CIN'");
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    if ($row['password'] == $password)
    {
        $_SESSION['patientSession'] = $row['PatientCin'];
        ?>
        <script type="text/javascript">
        alert('Login Success');
        </script>
        <?php
        header("Location: patient/patient.php");
    } else {
        ?>
        <script>
        alert('wrong input ');
        </script>
        <?php
    }
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
    $patientFirstName = mysqli_real_escape_string($con,$_POST['patientFirstName']);
    $patientLastName  = mysqli_real_escape_string($con,$_POST['patientLastName']);
    $patientEmail     = mysqli_real_escape_string($con,$_POST['patientEmail']);
    $CIN             = mysqli_real_escape_string($con,$_POST['PatientCin']);
    $password         = mysqli_real_escape_string($con,$_POST['password']);
    $month            = mysqli_real_escape_string($con,$_POST['month']);
    $day              = mysqli_real_escape_string($con,$_POST['day']);
    $year             = mysqli_real_escape_string($con,$_POST['year']);
    $patientDOB       = $year . "-" . $month . "-" . $day;
    $patientGender = mysqli_real_escape_string($con,$_POST['patientGender']);
    //INSERT
    $query = " INSERT INTO patient (  PatientCin, password, patientFirstName, patientLastName,  patientDOB, patientGender,   patientEmail )
    VALUES ( '$CIN', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patientEmail' ) ";
    $result = mysqli_query($con, $query);

    if( $result )
    {
        ?>
        <script type="text/javascript">
        alert('Register success. Please Login to make an appointment.');
        </script>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
        alert('Ce CIN est dèja éxiste!');
        </script>
        <?php
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Care Project</title>
    
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
  
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link href="assets/css/material.css" rel="stylesheet">
    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- toggle -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span id="logoCare">Care</span></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <li><a href="#" data-toggle="modal" data-target="#myModal">Créer un compte</a></li>
                   
                        <li>
                            <p class="navbar-text">Vous avez dèja un compte?</p>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Se connecter</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="PatientCin">Email</label>
                                                    <input type="text" class="form-control" name="PatientCin" placeholder="IC Number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Se connecter</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navigation -->

        <!-- modal container start -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Créer un compte</h3>
                    </div>
                    <!-- modal body start -->
                    <div class="modal-body">
                        
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                        <h4>Veuillez saisir vos informations pour créer votre compte</h4>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientFirstName" value="" class="form-control input-lg" placeholder="Prénom" required />
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientLastName" value="" class="form-control input-lg" placeholder="Nom" required />
                                            </div>
                                        </div>
                                        
                                        <input type="text" name="patientEmail" value="" class="form-control input-lg" placeholder="Adresse Email"  required/>
                                        <input type="number" name="PatientCin" value="" class="form-control input-lg" placeholder="Carte nationale d'identité"  required/>
                                        
                                        
                                        <input type="password" name="password" value="" class="form-control input-lg" placeholder="Mot de passe"  required/>
                                        
                                        <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirmer le mot de passe"  required/>
                                        <label>Date de naissance</label>
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Mois</option>
                                                    <?php
                                                    $months = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
                                                    for ($i=0; $i < 12; $i++) { ?>
                                                        <option value="<?php echo $months[$i] ?>"><?php echo $months[$i] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">Jour</option>
                                                    <?php for ($i=1; $i <= 31; $i++) { ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Année</option>
                                                    <?php for ($i=date("Y")-100; $i <= date("Y")-18; $i++) { ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <label>Gender : </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="patientGender" value="male" required/>Male
                                        </label>
                                        <label class="radio-inline" >
                                            <input type="radio" name="patientGender" value="female" required/>Female
                                        </label>
                                        <br />
                                        <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
                                        
                                        <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->
        <!-- modal container end -->

        <!-- 1st section start -->
        <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
            <style>
                .Header h1{
                    color: black;
                    text-align: center;
                    
                }
                .Header{
                    margin: auto auto;
                    text-align: center;
                }
            </style>
           <div class="Header">
               <h1>Care Project </h1>
                <p>Created By <i> Hichame Alloni </i>
                   and <i>Mohamed Ait Said</i> 
                </p>
                <section id="content-1-9" class="content-1-9 ">
                    <?php
                            include_once("home.php");
                     ?>
                </section>
           </div>
           <div class="container tb">
                
           </div>
        
                 
               
        </section>
       
        <div class="copyright-bar bg-black">
            <div class="container">
                <p class="pull-right small"><a href="doctorlogin.php">Doctor</a></p>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
    <!-- date start -->
  
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); 
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