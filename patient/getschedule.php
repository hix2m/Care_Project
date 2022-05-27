<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$q = $_GET['q'];
$res_doctor = mysqli_query($con,"SELECT * FROM doctor WHERE DoctorCin ='".$_SESSION['doctor_cne']."'");
$res = mysqli_query($con,"SELECT * FROM doctorschedule WHERE scheduleDate='$q' and doctor ='".$_SESSION['doctor_cne']."'");
if (!$res) {
die("Error running $sql: " . mysqli_error($con));
}
$doct = mysqli_fetch_array($res_doctor,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-danger' role='alert'>Doctor is not available at the moment. Please try again later.</div>";
        
        } else {
        echo "   <table class='table table-hover'>";
            echo " <thead>";
                echo " <tr>";
                    echo " <th>Doctor</th>";
                    echo " <th>Jour</th>";
                    echo " <th>Date</th>";
                    echo "  <th>L'heure de d'emarrer</th>";
                    echo "  <th>L'heure de fin</th>";
                    echo " <th>Disponiblité</th>";
                    echo "  <th>Prenez Rendez Vous</th>";
                echo " </tr>";
            echo "  </thead>";
            echo "  <tbody>";
                while($row = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <?php
                    // $avail=null;
                    // $btnclick="";
                    if ($row['bookAvail']!='available') {
                    $avail="danger";
                    $btnstate="disabled";
                    $btnclick="danger";
                    } else {
                    $avail="primary";
                    $btnstate="";
                    $btnclick="primary";
                    }

                   
                    
                    echo "<td>" . $doct['doctorFirstName']." ".$doct['doctorLastName'] . "</td>";
                    echo "<td>" . $row['scheduleDay'] . "</td>";
                    echo "<td>" . $row['scheduleDate'] . "</td>";
                    echo "<td>" . $row['startTime'] . "</td>";
                    echo "<td>" . $row['endTime'] . "</td>";
                    echo "<td> <span class='label label-".$avail."'>". $row['bookAvail'] ."</span></td>";
                    echo "<td><a href='appointment.php?&appid=" . $row['scheduleId'] . "&scheduleDate=".$q."' class='btn btn-".$btnclick." btn-xs' role='button' ".$btnstate.">Prener Rendez vous</a></td>";
                    
                    ?>
                    
                    
                    
                </tr>
                
                <?php
                }
                }
                ?>
            </tbody>
            <!-- modal start -->
            
            
            
            
            
        </body>
    </html>