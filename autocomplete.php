<?php
    if (!isset ($_GET["unos"])){
        echo "Parametar Unos nije prosleđen!";
    } else {
        $pomocna=$_GET["unos"];
        include "dbb.php";
        $sql="SELECT idK,email FROM kozmeticar WHERE email LIKE '$pomocna%'ORDER BY email";
        $rezultat = $conn->query($sql);
        if (mysqli_num_rows($rezultat)==0){
            echo "U bazi ne postoji email koji počinje na " . $pomocna;
        } else {
            while($red = $rezultat->fetch_object()){
            ?>
            <a href="#" onclick="place(this)"><?php  echo $red->email;?></a>
            <br/><br/>
<?php
}
}
 
}
?>
