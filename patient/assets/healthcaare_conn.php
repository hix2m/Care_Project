<?php

$hostname_healthcaare_conn = "localhost";
$database_healthcaare_conn = "db_healthcare";
$username_healthcaare_conn = "root";
$password_healthcaare_conn = "";
$healthcaare_conn = mysqli_connect($hostname_healthcaare_conn, $username_healthcaare_conn, $password_healthcaare_conn) or trigger_error(mysqli_error($healthcaare_conn ),E_USER_ERROR); 
?>