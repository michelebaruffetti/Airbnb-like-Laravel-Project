var $ = require('jquery');
const Handlebars = require("handlebars");
$(document).ready(function(){
//al caricamento della pagina recupero i dati negli input nascosti e faccio la chiamata ajax
    ricerca();
    //al click di ricerca recupero i dati negli input nascosti e faccio la chiamata ajax
    $('#ricerca').click(function(){
        $('#contenitore-appartamenti').empty();
        ricerca();
    });
    //al change delle select recupero i dati negli input nascosti e faccio la chiamata ajax

    $('.filtri-select').change(function(){
        $('#contenitore-appartamenti').empty();
        ricerca();
    });
    // Genero un array dei servizi selezionati dall'utente vuoto
    var servizi_selezionati = [];
    // al click dei servizi 
    $('.servizi').on('click', function(){
        // recupero l'id del servizio selezionato
        var servizio_selezionato = $(this).val();
        // se non è incluso nell'array servizi selezionati lo pusho altrimenti lo tolgo
        if (servizi_selezionati.includes(servizio_selezionato)) {
            var indice = servizi_selezionati.indexOf(servizio_selezionato);
            servizi_selezionati.splice(indice,1);
        } else {
            servizi_selezionati.push(servizio_selezionato);
        }
        
        ricerca();
    });



    function ricerca(){
        // recupero tutti i dati dagli input
        var lat = $('#latitude').val();
        var lng = $('#longitude').val();
        var rag = $('#range').val();
        var rom = $('#room').val();
        var bat = $('#bath').val();
        chiamata(lat, lng, rag, rom, bat);
    }

    function chiamata(latitude, longitude, raggio, stanze, bagni){

        $.ajax({
            'url': 'api/allapartments',
            'method': 'GET',
            'data': {
                'latitude': latitude,
                'longitude': longitude,
                'range': raggio,
                'room': stanze,
                'bath': bagni
            },
            success: function(data){
                $('#contenitore-appartamenti').empty();
                var source = $("#template-apartment").html();
                var template = Handlebars.compile(source);
                // ciclo i dati della risposta
                for (var i = 0; i < data.response.length; i++) {
                    // creo un array per i servizi di ogni appartamento
                    var servizi_appartamento = [];
                    // se la descrizione è lunga la tronco
                    var descr = data.response[i].description;
                    if (descr.length > 450) {
                        var descr = descr.substring(0,450)+'...';
                    }
                    // per ognuno di essi disegnare in pagina una card utilizzando handlebars.
                    var context = {
                        url_image: data.response[i].image_url,
                        title: data.response[i].title,
                        description: descr,
                        services: data.response[i].services,
                        id_apartment: data.response[i].id
                    };
                    // creo una variabile sentinella
                    var sentinella = 0;
                    // ciclo i servizi di ogni appartamento
                    for (var j = 0; j < data.response[i].services.length; j++) {
                        // li pusho all'interno dell'array creato in precedenza
                        servizi_appartamento.push(data.response[i].services[j].id);
                    }
                    
                    var html = template(context);
                    // se i servizi selezionati sono 0 disegno la card 
                    if (servizi_selezionati.length == 0) {
                        $('#contenitore-appartamenti').append(html);
                        // altrimenti ciclo i servizi selezionati dall'utente
                    } else {
                        for (var y = 0; y < servizi_selezionati.length; y++) {
                            // transformo in numeri i valori
                            var servizi_selezionati_utente = Number(servizi_selezionati[y]);
                            // se i servizi selezionati sono inclusi nell'array dei servizi dell'appartamento
                            if (servizi_appartamento.includes(servizi_selezionati_utente)){
                                // aumento la sentinella di 1
                                sentinella = sentinella + 1;
                            };

                    }
                    // se la sentinella è uguale al numero dei servizi selezionati dall'utente disegno la card
                    if (sentinella == servizi_selezionati.length){
                        $('#contenitore-appartamenti').append(html);
                    }

                    };
                    
                };

            }
        });
    }
});
