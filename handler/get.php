<?php

    require "../dbb.php";
    require "../model/termin.php";
     
    if(isset($_POST['id'])){
         
        $myArray = Termin::prikaziTerminpoID($_POST['id'],$conn);
        
        echo json_encode($myArray);
    }


?>