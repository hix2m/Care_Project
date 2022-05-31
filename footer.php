<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer - Sagar Developer</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="footer_style.css">
</head>

<body>
    
    <footer class="footer-distributed">

        <div class="footer-left">
            <h3>Ca<span>re</span></h3>

            <p class="footer-links">
                <a href="#">Home</a>
                |
                <a href="#">About</a>
                |
                <a href="#">Contact</a>
                |
                <a href="#">Blog</a>
            </p>

            <p class="footer-company-name">Create By : <strong>Allouni Hicham Et Mohamed Ait Said</strong> Projet Fin Formation</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Marrakech</span>
                    ISGI</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>06.48.72.22.12</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">xyz@gmail.com</a></p>

            </div>
            <div>

            </div>

        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>À propos de projet </span>
                <strong>Care Projet</strong> est une application web qui 
                se soucie de tout ce qui concerne la prise de rendez-vous avec des médecins en ligne . 
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
        <?php 
        if(!isset($_SESSION['patientSession']))
        {
           ?>
            <p class="pull-right"><a href="doctorlogin.php">Doctor</a></p>

           <?php
        }
        ?>

    </footer>

</body>

</html>

        