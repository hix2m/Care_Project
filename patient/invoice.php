<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (isset($_GET['appid'])) {
$appid=$_GET['appid'];
}
$doctor=$_GET['doctor'];
$res=mysqli_query($con, "SELECT d.*, a.*, b.*,c.* FROM patient a
JOIN appointment b
On a.PatientCin = b.PatientCin
JOIN doctorschedule c
On b.scheduleId=c.scheduleId
JOIN doctor d
  On d.DoctorCin = c.doctor
WHERE b.appId  =".$appid." and c.doctor = '".$doctor."'");

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Imprimer</title>
        
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="assets/img/logo2.png" style="width:100%; max-width:300px;">
                                </td>
                                
                                <td>
                                    Nimiro de rendez vous : <?php echo $userRow['appId'];?><br>
                                    Date de prendre Rendez vous : <?php echo date("d-m-Y");?><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                <?php echo 'Nom et Prénom : '.$userRow['patientFirstName'];?> <?php echo $userRow['patientLastName'];?><br>
                                </td>
                                
                                <td><?php echo 'CNE : '.$userRow['PatientCin'];?><br>
                                    <?php echo 'Adress : '.$userRow['patientAddress'];?>
                                    <?php echo 'Emeil : '.$userRow['patientEmail'];?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Rendez Vous Information
                    </td>
                    
                    <td>
                        
                    </td>
                </tr>
                <tr class="item">
                    <td>
                       Nom Doctor 
                    </td>
                    <td>
                       <?php echo $userRow['doctorFirstName']." ".$userRow['doctorLastName'];?>
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                       Adress Doctor 
                    </td>
                    
                    <td>
                        <?php echo $userRow['doctorAddress'];?>
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        joure de rendez vous
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDay'];?>
                    </td>
                </tr>
                

                 <tr class="item">
                    <td>
                        Date de rendez vous
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDate'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                       l'heure de rendez vous
                    </td>
                    
                    <td>
                        <?php echo $userRow['startTime'];?> a <?php echo $userRow['endTime'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Patient Symptome
                    </td>
                    
                    <td>
                        <?php echo $userRow['appSymptom'];?> 
                    </td>
                </tr>
                
                
                
            </table>
        </div>
        <div class="print_non">
            <button onclick="print()">Imprimer <ion-icon name="document-text-outline"></ion-icon></button>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
/*function myFunction() {
    window.print();
}*/
</script>
<style>
    @media print{
        .print_non{
            display: none;
        }
    }
    .print_non {
        margin: auto;
        width: 500px;
        height: 100px;
        align-items: center;
       margin-top: 20px;
    }
    .print_non button{
        background-color: white;
        font-size: x-large;
        border-radius: 8px;
        border: 2px white solid;
        cursor: pointer;
        box-shadow: black 4px 4px 0px;
        transition: transform 200ms , box-shadow 200ms;

    }.print_non button :active{
        transform: translateY(4px) translateX(4px);
        box-shadow: black 0px 0px 0px;
        
    }
    
</style>
    </body>
</html>