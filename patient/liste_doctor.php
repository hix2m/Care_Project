
        

        <?php
        //require("assets/conn/dbconnect.php");
        $con =  mysqli_connect("localhost","root","","db_healthcare");

        $query = null;
        $vi = "null";
        $spec = "null";
        if(isset($_POST["rechercher"])){
            if($_POST["ville"] != "null" && $_POST["specialite"] != "null" ){
                $query = "select * from doctor where Ville like '".$_POST["ville"]."' and Specialite like '".$_POST["specialite"]."'";
                $res1=mysqli_query($con,$query);
                $vi = $_POST["ville"];
                $spec =$_POST["specialite"];
            }elseif($_POST["ville"] != "null" && $_POST["specialite"] == "null"){
                $query = "select * from doctor where Ville like '".$_POST["ville"]."'";
                $res1=mysqli_query($con,$query);
                $vi = $_POST["ville"];
            }
            elseif($_POST["ville"] == "null" && $_POST["specialite"] != "null"){
                $query = "select * from doctor where  Specialite like '".$_POST["specialite"]."'";
                $res1=mysqli_query($con,$query);
                $spec =$_POST["specialite"];
            }elseif($_POST["ville"] == "null" && $_POST["specialite"] == "null"){
                $query = "select * from doctor";
                $res1=mysqli_query($con,$query);
                
            }
        }
        $query_ville = "select distinct(Ville) from doctor";
        $query_specialete = "select distinct(Specialite) from doctor";
        $Ville = mysqli_query($con,$query_ville);
        $res_specialite = mysqli_query($con,$query_specialete);
        
        ?>
            
                
                    
<div class="container py-5">
    
    <div class="row mt-4">
        <form class="form-inline" action="" method="POST">
            <fieldset>
                <legend>Recherche</legend>
                
                <select class="select mt-3" name="ville" id="sel-ville">
                    <option value="null" <?php if($vi == "null"){echo "selected";} ?>>Select Ville</option>
                    <?php
                    while($ville_row = mysqli_fetch_assoc($Ville)){
                        ?>
                        <option value="<?php echo $ville_row["Ville"]; ?>"<?php if($vi ==$ville_row["Ville"] ){echo "selected";} ?>><?php echo $ville_row["Ville"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select class="select" name="specialite" id="sel-specialite">
                    <option value="null"  <?php if($spec =="null" ){echo "selected";} ?>>Select Speciality</option>
                    <?php
                    while($row_specialite = mysqli_fetch_assoc($res_specialite)){
                        ?>
                    <option value="<?php echo $row_specialite["Specialite"];?>"<?php if($spec ==$row_specialite["Specialite"] ){echo "selected";} ?>><?php echo $row_specialite["Specialite"];?></option>

                    <?php
                    }
                    ?>
                </select>
                <button type="submit" name="rechercher" class="button" >
                    <span class="button_text" >Rechercher</span>
                    <span class="button_icon" ><ion-icon name="search-outline"></ion-icon></span>
                </button>
            </fieldset>
        </form>
        
        <div class="content1">
            <?php
                if($query != null) {
                    if(mysqli_num_rows($res1) != 0){
                        while($row = mysqli_fetch_assoc($res1)){
                            ?>
                                <div class="card1">
                                   <form action="take_appointment.php" method="POST">
                                        <div class="img-wrapper">
                                            <?php 
                                                if($row['image_profile'] != null){
                                            ?>
                                                <img  src="./assets/Image_Profil/<?php echo $row['image_profile'] ;?>"alt="" class="card_img_top" >
                                            <?php 
                                            }
                                            if($row['image_profile'] == null){ 
                                            ?>
                                                <img
                                                    src="./assets/Image_Profil/profile_not_found_homme.png" alt="" class="card_img_top"
                                                    alt=" <?php
                                                            echo $row['doctorFirstName']." ".$row['doctorLastName']; ?>"
                                                /> 
                                            <?php
                                                }
                                            ?>
                                            <div class="overlay">
                                                <h3 class="card-title">
                                                    <?php
                                                        echo $row['doctorFirstName']." ".$row['doctorLastName']; 
                                                    ?>
                                                </h3>
                                                <p class="card-text"><?php echo $row['Specialite'] ?></p>
                                            </div>
                                        </div>
                                        <div class="information">
                                            <div class="adress">
                                            <ion-icon name="location-sharp"></ion-icon> : <?php
                                                echo $row['doctorAddress'] ?>
                                           
                                           
                                            </div>
                                            <div class="phone">
                                            <ion-icon name="call-outline"></ion-icon> : <?php
                                                echo $row['doctorPhone'] ?>
                                                
                                            </div>
                                            <div>
                                            <ion-icon name="fitness-sharp"></ion-icon>  : <?php
                                                echo $row['Specialite'] ?>
                                           
                                            </div>
                                            <button type="submit" class="btn" name="rendez_vous" value="<?php echo $row['DoctorCin']  ?>"> Prenez Rendez Vous <ion-icon name="checkbox-sharp"></ion-icon></button>
                                        </div>
                                    </form>
                                            
                                       
                                </div>
                        
                        <?php
                        }

                    }else{
                        ?>
                        <h1 style="text-align: centrer;">Aucun Doctor Trouver</h1>
                        <?php
                    }
                   
                } 
                else{
                    ?>
                    <h1> Search For Doctors </h1>
                    <?php 
                }
                ?>
        </div>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>




