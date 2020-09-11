$(document).ready(function(){
//al caricamento della pagina recupero i dati negli input nascosti e faccio la chiamata ajax
    var lat = $('#latitude').val();
    var lng = $('#longitude').val();
    var rag = $('#range').val();
    ricerca(lat, lng, rag);

    //al click di ricerca recupero i dati negli input nascosti e faccio la chiamata ajax
    $('#ricerca').click(function(){
        var lat = $('#latitude').val();
        var lng = $('#longitude').val();
        var rag = $('#range').val();
        console.log(lat);
        console.log(lng);
        console.log(rag);
        ricerca(lat, lng, rag);
    });


});



function ricerca(latitude, longitude, raggio){

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
