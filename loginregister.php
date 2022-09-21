<?php
    include 'dbb.php'; //$conn
    include 'model/kozmeticar.php';

    session_start();
    if(isset($_POST['login']) ){ //kada korisnik klikne dugme login
        //preuzimamo podatke iz forme 
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $kozmeticar = new Kozmeticar(null,null,null,$email,$pass);

        $status = Kozmeticar::login($kozmeticar,$conn);

        if($status){
            echo "ULOGOVAN KORISNIK";
            $_SESSION['ulogovaniKozmeticar'] = Kozmeticar::vratiKozmeticaraPoEmailu($email,$conn);
            header('Location: pocetna.php'); //ako je korisnik ulogovan mozemo da ga posaljemo na glavnu stranicu
        }else{
            echo "GRESKA";
        }


    }

    if(isset($_POST['register']) ){ //kada korisnik klikne dugme register
        //preuzimamo podatke iz forme 
        $email = $_POST['emailR'];
        $pass = $_POST['passR'];
        $pass2 = $_POST['passR2'];
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];


        if($pass===$pass2){
            $kozmeticar = new Kozmeticar(null,$ime,$prezime,$email,$pass);

            $status = Kozmeticar::register($kozmeticar,$conn);
    
            if($status){
                echo "Registrovan korisnik";
                $_SESSION['ulogovaniKozmeticar'] = Kozmeticar::vratiKozmeticaraPoEmailu($email,$conn);
                header('Location: pocetna.php'); //ako je korisnik ulogovan mozemo da ga posaljemo na glavnu stranicu
            }else{
                echo "GRESKA";
            }
        }else{
            echo ` <script>alert("Lozinke moraju da se poklapaju")</script>`;
        }

       
    }


?>