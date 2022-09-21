

//za profile modal
$('#prikazi').click(function () {
    const checked = $('input[name=checked-donut]:checked'); //kupimo koji red iz tabele je korisnik selektovao
    console.log(checked.val());
    request = $.ajax({
        url: 'handler/get.php',  //pozivamo get metodu koju smo napisali
        type: 'post',
        data: { 'id': checked.val() }, //prosledjujemo joj id koji smo pokupili iz cekiranog kruga
        dataType: 'json'
    });
   
    //console.log(request);
    request.done(function (response, textStatus, jqXHR) {
    
       //popunjavamo polja u modalu za profil
        $('#modelPreview').text(response[0]['naziv']);
        console.log(response[0]['naziv']);

        $('#cena').text("      "+response[0]['cena'].trim());
        console.log(response[0]['cena'].trim());

        $('#opis').text("      "+response[0]['opis']);
        console.log(response[0]['opis'] );

        $('#kozmeticar').text("      "+response[0]['ime']+" "+response[0]['prezime']);
        console.log(response[0]['ime']+" "+response[0]['prezime']);
  
        //na osnovu neke kljucne reci biramo koja slika ce se prikazati za odabrani termin u profil modalu
         if (response[0]['naziv'].toUpperCase().includes("LICE") ||response[0]['naziv'].toUpperCase().includes("LICA")  || response[0]['naziv'].toUpperCase().includes("LICU") ) {
            document.getElementById("Img").src = 'slike/lice.jpg';
         } else if (response[0]['naziv'].toUpperCase().includes("MASAZA")) {
             document.getElementById("Img").src = 'slike/masaza.jpg';
          } else if (response[0]['naziv'].toUpperCase().includes("CELULIT")) {
            document.getElementById("Img").src = 'slike/celulit.jpg';
       }
         else {
            document.getElementById("Img").src = 'http://placehold.it/100x100';
        }

      
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

});



//za dodaj novu rezervaciju modal
//
$('#rezervisi').submit(function () {
  
    event.preventDefault(); //zaustavi refresovanje na stranici
   
    const $form = $(this);//this se odnosi na formu #rezervisi
    const $input = $form.find('input,select,button,textarea');
    const serijalizacija = $form.serialize(); //serijalizujemo podatke iz forme i saljemo ih nasem postu

    
  
    $input.prop('disabled', true); //na sve inpute postavljamo property da onemogucimo da korisnik menja ono sto je uneo dok se ne zavrsi ubacivanje u tabelu


    request = $.ajax({  
        url: 'handler/add.php',  
        type: 'post',
        data: serijalizacija
    });

    request.done(function (response, textStatus, jqXHR) {
       
        if (response === "Success") {
            alert("Uspesno rezervisano");
            console.log("Uspesno rezervisano");
            location.reload(true);
        }
        else {
       
            console.log("Rezervacija nije dodata" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska: ' + textStatus, errorThrown);
    });
});




//funkcija za otkazivanje (brisanje termina iz tabele rezervacija)

$('#otkaziTermin').click(function () { 

    const checked = $('input[name=checked-donut]:checked');

    req = $.ajax({
        url: 'handler/remove.php',
        type: 'post',
        data: { 'id': checked.val() }
    });

    req.done(function (res, textStatus, jqXHR) {
        if (res == "Success") {
            checked.closest('tr').remove();
            alert('Uspesno obrisano iz baze!');
            
        } else {
            console.log("neuspesno brisanje " + res);
            alert("neuspesno brisanje ");

        }
         
    });



});




//kada hocemo neki vec postojeci termin da editujemo, kada korisnik klikne na glavno dugme
//treba da se otvori modal koji ce biti popunjen podacima koji se nalaze u tabeli 
$('#promeni').click(function () {
    const checked = $('input[name=checked-donut]:checked');
     
    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: { 'id': checked.val() },
        dataType: 'json'
    });


    request.done(function (response, textStatus, jqXHR) {
 


       $('#tretmanZaIzmenu').val(response[0]["idT"]); //skriveno polje 
 
        
       $('#kozmeticarE').val("      "+response[0]['ime']+" "+response[0]['prezime']);
       $('#idkozmeticaraEhidden').val(response[0]["idK"]);
 

       $('#tretmaniE').val(response[0]["idT"]);
 

        $('#datumE').val(response[0]['datumVreme'].trim());   
 
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

});


//sada kada korisnik unese neke izmene hocemo da klikom na dugme potvrdi te izmene zaista unesemo u bazu
$('#promeniTermin').submit(function () { //kada korisnik klikne dugme unutar modala
        
    event.preventDefault();

    const $form =  $(this);
   
    const $inputs = $form.find('input, select, button, textarea');
    
    const serializedData = $form.serialize();
   
    $inputs.prop('disabled', true);

  
    request = $.ajax({
        url: 'handler/edit.php',
        type: 'post',
        data: serializedData
    })

    request.done(function (response, textStatus, jqXHR) {
        console.log(response);
        $('#editModal').modal('hide');
        location.reload(true);
        $('#promeniTermin').reset;

    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
});



});






//kada hocemo da dodamo novi tretman u tabelu tretmana
$('#dodajnovitretmanform').submit(function () {
    event.preventDefault();  
    const $form = $(this); 
    const $input = $form.find('input,select,button,textarea');
    const serijalizacija = $form.serialize(); 

    $input.prop('disabled', true);   


    request = $.ajax({  
        url: 'handler/add.php',  
        type: 'post',
        data: serijalizacija
    });
    console.log(request);
    request.done(function (response, textStatus, jqXHR) {
      
        if (response === "Success") {
            alert("Tretman dodat");
            console.log("Uspesno dodavanje");
            location.reload(true);
        }
        else {
       
            console.log("Tretman nije dodat" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska: ' + textStatus, errorThrown);
    });
});





//pretrazivanje tretmana po nazivu ili opisu tretmana 
$(document).ready(function() {
    $("#searchbar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabelaTretmana tr").filter(function() {
            $(this).toggle($(this).text()
            .toLowerCase().indexOf(value) > -1)
        });
      
    });
});


//funkcija za soritranje tretmana po ceni 
function sortirajPoCeni() {
    var table=$('#tabelaTretmana');
    var tbody =$('#teloTabele');

    tbody.find('tr').sort(function(a, b)  {
        if($('#poredak').val()=='asc') 
        {
            return $('td:last', a).text().localeCompare($('td:last', b).text());
        } else  {
            return $('td:last', b).text().localeCompare($('td:last', a).text());
        }

    }).appendTo(tbody);
	
    var sort_order=$('#poredak').val();
    if(sort_order=="asc")  { //ako smo malopre sortirali rastuce
        document.getElementById("poredak").value="desc"; //sledeci put treba da soritiramo opadajuce
    }
    if(sort_order=="desc") {
        document.getElementById("poredak").value="asc";
    }
}
