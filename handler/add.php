<?php
    include '../dbb.php';
    include '../model/termin.php';
    include '../model/tretman.php';
 

    if(isset($_POST["idkozmeticara"]) && isset($_POST["datum"]) && isset($_POST["tretmani"]) ){
       
        
         $termin = new Termin(null,$_POST["datum"],$_POST["idkozmeticara"],$_POST["tretmani"]);
        
        $status= Termin::dodajTermin($termin,$conn);
        
        
          if($status){
             echo 'Success';
          }else{
              echo $status;
              echo 'Failed';
          }
    }


    if(isset($_POST['nazivNovogTretmana']) && isset($_POST['opisNovogTretmana'])  && isset($_POST['adresaNovogTretmana'])  && isset($_POST['cenaNovogTretmana'])   ){

        $tretman = new Tretman(null,$_POST['nazivNovogTretmana'],$_POST['opisNovogTretmana'],$_POST['adresaNovogTretmana'],$_POST['cenaNovogTretmana']);

        $status = Tretman::dodajNoviTretman($tretman,$conn);
        if($status){
            echo 'Success';
         }else{
             echo $status;
             echo 'Failed';
         }

    }
  

?>