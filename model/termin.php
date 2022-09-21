<?php


    class Termin{
        private $id;
        private $datumVreme;
        private $kozmeticar;
        private $tretman;


        public function __construct($id=null,$datumVreme=null,$kozmeticar=null,$tretman=null ){
            $this->id=$id;
            $this->datumVreme=$datumVreme;  
            $this->kozmeticar=$kozmeticar;            
            $this->tretman=$tretman;            
        }


        public static function vratiSveTermine($conn){
            $upit = "select * from termin t inner join kozmeticar k on t.kozmeticar=k.idK inner join tretman tr on tr.idT = t.tretman";

            return $conn->query($upit); 
        }


        public static function dodajTermin($termin, $conn){
            $upit = "insert into termin(datumVreme,kozmeticar,tretman) values('$termin->datumVreme','$termin->kozmeticar','$termin->tretman')";

            return $conn->query($upit); 
        }

        public static function otkaziTermin($id, $conn){
            $upit = "delete from termin where id=$id";

            return $conn->query($upit); 

        }

        public static function promeniTermin($termin,$conn){
            $upit = "update termin set datumVreme='$termin->datumVreme', tretman=$termin->tretman where id=$termin->id";

            return $conn->query($upit); 
        }

        public static function prikaziTerminpoID($id, $conn){
            $upit = "select * from termin t inner join kozmeticar k on t.kozmeticar=k.idK inner join tretman tr on tr.idT = t.tretman where t.id=$id";
            $myArray = array();
            $result = $conn->query($upit);
            
            if($result){
                while($row = $result->fetch_array()){
    
                    $myArray[] = $row;
                }
            }
            
            return  $myArray ;

        }


    }


?>