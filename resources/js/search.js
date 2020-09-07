$(document).ready(function(){
//chiamata ajax

    $.ajax({
        url: 'api/allapartments',
        method: 'GET',
        success: function(data){
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            var raggio = $('#range').val();
            console.log(latitude);
            console.log(longitude);
            console.log(raggio);
        }
        
    })


})
