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

    $('#range').change(function(){
        $('#contenitore-appartamenti').empty();
        ricerca();
    });

    var servizi_selezionati = [];

    $('.servizi').on('click', function(){
        var servizio_selezionato = $(this).val();
        if (servizi_selezionati.includes(servizio_selezionato)) {
            var indice = servizi_selezionati.indexOf(servizio_selezionato);
            servizi_selezionati.splice(indice);
        } else {
            servizi_selezionati.push(servizio_selezionato);
        }
        console.log('servizio-selezionato: ' + servizio_selezionato);        
        
        console.log('Array servizi selezionati: ' + servizi_selezionati);
        ricerca();
    });



    function ricerca(){
        $('#contenitore-appartamenti').empty();
        var lat = $('#latitude').val();
        var lng = $('#longitude').val();
        var rag = $('#range').val();
        chiamata(lat, lng, rag);
    }

    function chiamata(latitude, longitude, raggio){

        $.ajax({
            'url': 'api/allapartments',
            'method': 'GET',
            'data': {
                'latitude': latitude,
                'longitude': longitude,
                'range': raggio
            },
            success: function(data){

                var source = $("#template-apartment").html();
                var template = Handlebars.compile(source);
                var sentinella = 0;
                for (var i = 0; i < data.response.length; i++) {
                    var servizi_appartamento = [];
                    // per ognuno di essi disegnare in pagina una card utilizzando handlebars.
                    var context = {
                        url_image: data.response[i].image_url,
                        title: data.response[i].title,
                        description: data.response[i].description,
                        services: data.response[i].services
                    };
                    
                    for (var j = 0; j < data.response[i].services.length; j++) {
                        // var servizio = data.response[i].services[j];
                        servizi_appartamento.push(data.response[i].services[j].id);
                    }
                    console.log(servizi_appartamento);
                    var html = template(context);
                    if (servizi_selezionati.length == 0) {
                        $('#contenitore-appartamenti').append(html);
                    };
                    
                    
                        for (var y = 0; y < servizi_selezionati.length; y++) {
                            console.log(servizi_selezionati[y]);
                            var pippo = Number(servizi_selezionati[y]);
                            if (servizi_appartamento.includes(pippo)){
                                sentinella = sentinella + 1;
                                console.log(sentinella);
                                $('#contenitore-appartamenti').append(html);
                            };
                        
                        
                        // console.log(sentinella);
                        // if (sentinella == servizi_selezionati.length){
                        //     $('#contenitore-appartamenti').append(html);
                        // }
                    };
                    // $('#contenitore-appartamenti').append(html);
                };
                console.log(data);


            }
        });
    }
});

