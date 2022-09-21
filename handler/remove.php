<?php
    include '../dbb.php';
    include '../model/termin.php';

if(isset($_POST['id'])){
    $status=Termin::otkaziTermin($_POST['id'],$conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>