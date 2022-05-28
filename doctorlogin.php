<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['doctorSession']) != "") {
header("Location: doctor/doctordashboard.php");
}
if (isset($_POST['login']))
{
$DoctorCin = mysqli_real_escape_string($con,$_POST['DoctorCin']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM doctor WHERE DoctorCin = '$DoctorCin'");

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

if ($row['password'] == $password)
{
    $_SESSION['doctorSession'] = $row['DoctorCin'];

    header("Location: doctor/doctordashboard.php");
} else {
    ?>
    <script type="text/javascript">
        alert("CIN ou Mot de passe incorrect!");
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
        <title>Login Doctor</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <!-- start -->
            <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <input name="DoctorCin" type="text" placeholder="Doctor Cin" required>
                            <input name="password" type="password" placeholder="Mot de passe" required>
                            <button class="btn btn-info btn-block login" type="submit" name="login">Se connecter</button>
                        </form>
                    </div>
                </div>
            <!-- end -->
        </div>

        <script src="assets/js/jquery.js"></script>

    </body>
</html>