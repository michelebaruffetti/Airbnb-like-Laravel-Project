var $ = require('jquery');
$(document).ready(function(){
//al caricamento della pagina recupero i dati negli input nascosti e faccio la chiamata ajax
    ricerca();
//recupero gli appartamneti sponsorizzati tramite api
    chiamata_sponsored();
    //al click di ricerca recupero i dati negli input nascosti e faccio la chiamata ajax
    $('#ricerca').click(function(){
        ricerca();
    });

    $('#range').change(function(){
        ricerca();
    });

    // $(document).on('change','#range', function(){
    //     var lat = $('#latitude').val();
    //     var lng = $('#longitude').val();
    //     var rag = $('select').val();
    //     ricerca(lat, lng, rag);
    // });

    // $(document).on(‘change’, ‘select’, function() {
    //     var genreSelected = $(‘select’).val();
    //     console.log(genreSelected);
    //     $(‘.cd’).hide();
    //     if (genreSelected == ‘All’) {
    //         $(‘.cd’).show();
    //     } else {
    //         $(“.cd[data-genre=” + genreSelected + “]”).show();
    //     }
    // });
});

function ricerca(){
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

            console.log(data);

        }
    });
}

function chiamata_sponsored(){

    $.ajax({
        'url': 'api/sponsored',
        'method': 'GET',
        success: function(data){

            console.log(data);

        }
    });
}
