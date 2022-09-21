<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Kozmetički salon</title>

    <!-- Za bootstrap preuzeto sa   https://getbootstrap.com/docs/4.3/getting-started/introduction/-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
    <link rel="stylesheet" href="css/style.css">
    <script src="js/autocomplete.js"></script>
    <script type="text/javascript">
        function place(ele){
            document.getElementById('email').value = ele.innerHTML;
            document.getElementById("livesearch").style.display = "none";
        }
</script>
<style type="text/css"> 
#livesearch{ 
color: white;
  margin:5px;
  width:220px;
  font: 600 16px/18px 'Open Sans', sans-serif
}
 
</style>

</head>
<body>
    <br><br><br><br><br><br>
    
 
    <!-- Login i signup -->
        <div class="row" >
            <div class="col-md-6 mx-auto p-0">
                <div class="card">
                    <div class="login-box">
                        <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                            <div class="login-space">
                                <div class="login">
                                    <form action="" method="post">
                                        <div class="group"> <label for="email" class="label">Email</label> <input id="email"  name="email" type="email" class="input" placeholder="Enter your email" required onkeyup="sugestija(this.value)"> </div> <div id="livesearch"></div>
                                        <div class="group"> <label for="pass" class="label">Password</label> <input id="pass"  name = "pass" type="password" class="input" data-type="password" placeholder="Enter your password" required>  </div>
                                        <br><br><br>
                                        <div class="group"> <input type="submit" class="button" value="Sign In" name="login" id="login"> </div>
                                        <div class="hr"></div>
                                    </form>
                                </div>
                                <div class="sign-up-form">
                                    <form action="" method="post">
                                        <div class="group"> <label for="ime" class="label">Ime</label> <input id="ime" name="ime" type="text" class="input" placeholder="Upisi ime" required> </div>
                                        <div class="group"> <label for="prezime" class="label">Prezime</label> <input id="prezime" name="prezime" type="text" class="input" placeholder="Upisi prezime" required> </div>

                                        <div class="group"> <label for="email" class="label">Email</label> <input id="emailR" name="emailR" type="email" class="input" placeholder="Upisi email"required> </div>
                                        <div class="group"> <label for="pass" class="label">Lozinka</label> <input id="passR"  name = "passR" type="password" class="input" data-type="password" placeholder="Upisi lozinku"required> </div>
                                        <div class="group"> <label for="pass" class="label">Potvrda lozinke</label> <input id="passR2"  name = "passR2" type="password" class="input" data-type="password" placeholder="Ponovo upisi lozinku"required> </div>
                                        
                                        <div class="group"> <input type="submit" class="button" name="register" value="Sign Up"> </div>
                                   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






           <!-- Za bootstrap preuzeto sa   https://getbootstrap.com/docs/4.3/getting-started/introduction/-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>