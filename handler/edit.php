
<?php
    include '../dbb.php';
    include '../model/termin.php';
    
    if(isset($_POST["kozmeticarE"]) && isset($_POST["tretmaniE"]) && isset($_POST["datumE"]) && isset($_POST['tretmanZaIzmenu']) ){
         $termin = new Termin($_POST['tretmanZaIzmenu'],$_POST['datumE'],$_POST['kozmeticarE'],$_POST["tretmaniE"]);
         $status= Termin::promeniTermin($termin,$conn);
        
       
          if($status){
          
             echo 'Success';
          }else{
              echo $status;
              echo 'Failed';
          }
    }
    
?>