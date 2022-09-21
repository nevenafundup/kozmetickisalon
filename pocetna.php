<?php
    include 'dbb.php';
    include 'model/termin.php';
    include 'loginregister.php';
    include 'model/tretman.php';
    //ovde cemo prvo ucitati sve podatke o terminima da bismo mogli da ih prikazemo u tabeli 

    $termini = Termin::vratiSveTermine($conn);
    
    if(!isset($_SESSION['ulogovaniKozmeticar'])){ //ako korisnik nije ulogovan na sistem mora prvo da se uloguje
        header('Location: index.php'); 
    }
    $kozmeticar = Kozmeticar::vratiKozmeticaraPoIDSviPodaci($_SESSION['ulogovaniKozmeticar'],$conn);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervacije</title>

        
    <!-- Za bootstrap preuzeto sa   https://getbootstrap.com/docs/4.3/getting-started/introduction/-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
 
 
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> 
     
   
     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body style="   background-image: url('slike/bg01.jpg');    background-repeat: no-repeat;   background-attachment: fixed;  background-size: cover;  "> 
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                        
                      
                            <li class="nav-item dropdown">
                                

                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>   <?php echo $kozmeticar['ime']. " ".$kozmeticar['prezime']  ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 

                                <a class="dropdown-item" href="#" id="emailKozmeticara"><?php echo $kozmeticar['email']    ?> </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="odjava.php">Odjavi se</a>
                                </div>
                            </li> 
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchbar">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
        </nav>


        <br><br><br>

   
    

        <div class="container" style="background-color: rgb(200,200,200,0.8);">

            <br>
            <button type="button" class="btn btn-primary" onclick="sortirajPoCeni() " style="float:right"> <i class="fa fa-sort" aria-hidden="true"></i>   Sortiraj tretmane po ceni</button>
            
            <h2>Tretmani iz naše ponude</h2>
            <table class="table" name = "tabelaTretmana" id="tabelaTretmana">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Naziv</th>  
                <th scope="col">Opis</th>

                <th scope="col">Adresa</th>
                <th scope="col">Cena</th> 

                </tr>
            </thead>
            <tbody id="teloTabele">

                     <?php
                        $tretmani = Tretman::vratiSveTretmane($conn);  
                        while($red = $tretmani->fetch_array()): ?>

                    <tr>
                        <th scope="row"><?php echo $red['idT'];   ?></th>
                        <td><?php echo $red['naziv'];   ?></td>  
                        <td><?php echo $red['opis'];   ?></td>  
                        <td><?php echo $red['adresa']  ?></td>
                        <td><?php echo $red['cena']  ?></td> 

                    </tr>

                <?php    
                        endwhile;
                ?>

            </tbody>
            </table>
            <!-- Sledeca linija koda nam treba da bismo cuvali podatak da li treba da soritamo rastuce ili opadajuce -->
            <input type="hidden" id="poredak" value="asc"> 
            <div>
                <button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#dodajTretmanModal" id="dodajT"><i class="fa fa-plus" aria-hidden="true"></i>  Dodaj novi tretman</button>
 
            </div>
                        <br>

            </div>



<br><br><br>

<!-- Tabela svih rezervacija -->
    <div class="container" style="background-color: rgb(200,200,200,0.8);">

                        <br>

      <h2>Rezervacije</h2>
        <table class="table" name = "tabelaRezeracija" id = "tabelaRezeracija">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Naziv</th>
            <th scope="col">Kozmeticar</th>
            <th scope="col">Datum i vreme</th>
            <th scope="col">Adresa</th>
            <th scope="col">Cena</th>
            <th scope="col"> Oznaci</th>

            </tr>
        </thead>
        <tbody>

            <?php    
                  while($red = $termini->fetch_array()):
            ?>

                <tr>
                    <th scope="row"><?php echo $red['id'];   ?></th>
                    <td><?php echo $red['naziv'];   ?></td>
                    <td><?php echo $red['ime']." ".$red['prezime'];   ?></td>
                    <td><?php echo $red['datumVreme']  ?></td>
                    <td><?php echo $red['adresa']  ?></td>
                    <td><?php echo $red['cena']  ?></td>
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $red["id"]?>>
                            <span class="checkmark"></span>
                        </label>
                    </td>

                </tr>

            <?php    
                  endwhile;
            ?>
 
        </tbody>
        </table>

        <div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal" id="prikazi">Prikaži</button>
            <button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#addModal" id="dodaj"     ><i class="fa fa-plus" aria-hidden="true"></i>  Dodaj novi termin</button>
            <button type="button" class="btn btn-danger" id="otkaziTermin"> <i class="fa fa-trash" aria-hidden="true"></i>   Obriši termin</button>
            <button type="button" class="btn btn-light" id="promeni" data-toggle="modal" data-target="#editModal" > <i class="fa fa-pencil" aria-hidden="true"></i>  Izmeni</button>
        </div>

                  <br>
    </div>


        <!-- profile modal start -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tretman <i class="fas fa-spa"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="http://placehold.it/100x100" id="Img" alt="" class="rounded responsive" style="width: 100px;height: auto;" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 id="modelPreview" class="text-primary"></h4>
                                    <p class="text-secondary">
                                        <input type="hidden" name="hiddenData"   value="">
                                        <i id="opis" class="fa fa-pencil" aria-hidden="true"> </i>
                                        <!-- <i id="Email" class="fa fa-envelope-o" aria-hidden="true"></i> -->
                                        <br />
                                        <i id="cena" class="fa fa-tag"  aria-hidden="true"></i>
                                        <br>
                                        <i id="kozmeticar" class="fas fa-user"  aria-hidden="true"></i>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- profile modal end -->


 <!-- Modal za rezervisanje novog termina -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rezerviši novi termin </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="rezervisi" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                                   

                                <div class="form-group">
                                    <label for="kozmeticar" class="col-form-label">Kozmetičar</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"   aria-hidden="true"></i>
                                        </div>
                                        <input type="text" class="form-control" id="kozmeticar" name="kozmeticar"
                                              value=<?php echo( Kozmeticar::vratiKozmeticaraPoID( $_SESSION['ulogovaniKozmeticar'],$conn)) ?> readonly>
                                        <input type="hidden" class="form-control" id="idkozmeticara" name="idkozmeticara"
                                              value=<?php echo $_SESSION['ulogovaniKozmeticar']  ?> readonly>
                                    </div>
                              </div>


                              <div class="form-group">
                                      <label for="tretmani">Izaberi tretman</label><br>
                                      <select name="tretmani" id="tretmani">
                                      <?php
                                         $tretmani = Tretman::vratiSveTretmane($conn);  
                                        while($red = $tretmani->fetch_array()):
                                          $nazivTretmana=$red["naziv"];
                                           // echo  $nazivTretmana;
                                      ?>
                                      
                                        <option value=<?php echo $red["idT"]?>><?php echo $red["naziv"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
                                </div>


 
                           
                             
                            
                            
                                <div class="form-group">
                                        <label for="message-text" class="col-form-label">Datum rezervacije</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="date" id="datum" name="datum" class="form-control"  required="required" />
                                            </div>
                                        </div>
                                </div>
  
         

                       
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Odustani</button>
                            <button type="submit" class="btn btn-success" id="addButton">Potvrdi</button>
                        </div>



                    </form>
                    </div>
              
           
                </div>
            </div>

 <!-- kraj Modala za rezervisanje novog termina -->


     

 <!-- Modal za izmenu termina -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Izmeni termin </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="promeniTermin" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                                   <input type="hidden" id="tretmanZaIzmenu" name="tretmanZaIzmenu">

                                <div class="form-group">
                                    <label for="kozmeticarE" class="col-form-label">Kozmetičar</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"   aria-hidden="true"></i>
                                        </div>
                                        <input type="text" class="form-control" id="kozmeticarE" name="kozmeticarE"
                                              value=<?php echo( Kozmeticar::vratiKozmeticaraPoID( $_SESSION['ulogovaniKozmeticar'],$conn)) ?> readonly>
                                        <input type="hidden" class="form-control" id="idkozmeticaraEhidden" name="idkozmeticaraEhidden"
                                              value=<?php echo $_SESSION['ulogovaniKozmeticar']  ?> readonly>
                                    </div>
                              </div>


                              <div class="form-group">
                                      <label for="tretmaniE">Izaberi tretman</label><br>
                                      <select name="tretmaniE" id="tretmaniE">
                                      <?php
                                         $tretmani = Tretman::vratiSveTretmane($conn);  
                                        while($red = $tretmani->fetch_array()):
                                          $nazivTretmana=$red["naziv"];
                                            echo  $nazivTretmana;
                                      ?>
                                      
                                        <option value=<?php echo $red["idT"]?>><?php echo $red["naziv"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
                                </div>


 
                           
                             
                            
                            
                                <div class="form-group">
                                        <label for="message-text" class="col-form-label">Datum rezervacije</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="date" id="datumE" name="datumE" class="form-control"  required="required" />
                                            </div>
                                        </div>
                                </div>
  
         

                       
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Odustani</button>
                            <button type="submit" class="btn btn-success" id="editButton">Potvrdi</button>
                        </div>



                    </form>
                    </div>
              
           
                </div>
            </div>

 <!-- kraj Modala za izmenu termina -->





<!-- Modal za dodavanje novog tretmana -->




<div class="modal fade" id="dodajTretmanModal" tabindex="-1" role="dialog" aria-labelledby="dodajTretmanModalLabel"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Dodaj novi tretman  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="dodajnovitretmanform" method="POST" enctype="multipart/form-data">
                        <div class="modal-body"> 



                              <div class="form-group">
                                    <label for="nazivNovogTretmana" class="col-form-label">Naziv</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-spa"></i>
                                        </div>
                                        <input type="text" class="form-control" id="nazivNovogTretmana" name="nazivNovogTretmana"  required="required">
                                    </div>
                              </div>
                               
                            

                              <div class="form-group">
                                    <label for="opisNovogTretmana" class="col-form-label">Opis</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-picture-o" aria-hidden="true"></i></i>
                                        </div>
                                        <input type="text" class="form-control" id="opisNovogTretmana" name="opisNovogTretmana"  required="required">
                                    </div>
                              </div>
                              

                              <div class="form-group">
                                    <label for="adresaNovogTretmana" class="col-form-label">Adresa salona</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-home" aria-hidden="true"></i></i>
                                        </div>
                                        <input type="text" class="form-control" id="adresaNovogTretmana" name="adresaNovogTretmana"  required="required">
                                    </div>
                              </div>
         
                              
                              <div class="form-group">
                                    <label for="cenaNovogTretmana" class="col-form-label">Cena</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-tag" aria-hidden="true"></i></i>
                                        </div>
                                        <input type="text" class="form-control" id="cenaNovogTretmana" name="cenaNovogTretmana"  required="required">
                                    </div>
                              </div>

                       
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Odustani</button>
                            <button type="submit" class="btn btn-success" id="dodajNoviTretmanButton">Potvrdi</button>
                        </div>



                    </form>
                    </div>
              
           
    </div>
 </div>
<!-- kraj Modala za dodavanje novog tretmana -->
                      <br><br><br>                        



     <script src="js/main.js"></script>

</body>
</html>