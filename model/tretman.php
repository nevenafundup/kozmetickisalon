<?php

    class Tretman{
        private $id;
        private $naziv;
        private $opis;
        private $adresa;
        private $cena; 



        public function __construct($id=null, $naziv=null,$opis=null, $adresa=null, $cena=null ){
            $this->id=$id;
            $this->naziv=$naziv;
            $this->adresa=$adresa;
            $this->cena=$cena;  
            $this->opis=$opis; 

        }
 

        public static function vratiSveTretmane($conn){
            $upit ="select * from tretman";

            return $conn->query($upit);
        }
       



        public static function vratiSveTretmane2($conn){
            $upit ="select * from tretman";

            $myArray = array();
            $result = $conn->query($upit);
            
            if($result){
                while($row = $result->fetch_array()){
    
                    $myArray[] = $row;
                }
            }
            
            return  $myArray ;

        }

        public static function dodajNoviTretman($tretman, $conn){
            $upit = "insert into tretman(naziv,opis,adresa, cena) values('$tretman->naziv','$tretman->opis','$tretman->adresa',$tretman->cena)";

            return $conn->query($upit); 


        }


    }

?>