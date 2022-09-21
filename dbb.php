<?php
 
     //databasebroker
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "kozmetickisalon";
        
        $conn = mysqli_connect($hostname,$username,$password,$database) or die("Database connection failed");
     

?>