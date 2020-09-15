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

            var source = $("#template-apartment").html();
            var template = Handlebars.compile(source);
            for (var i = 0; i < data.response.length; i++) {
                
                // per ognuno di essi disegnare in pagina una card utilizzando handlebars.
                var context = {
                    url_image: data.response[i].image_url,
                    title: data.response[i].title,
                    description: data.response[i].description,
                    services: data.response[i].services
                };
                var html = template(context);
    
                $('#contenitore-appartamenti').append(html);
            }
            console.log(data);


        }
    });
}


