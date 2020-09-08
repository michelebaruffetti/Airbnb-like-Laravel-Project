$(document).ready(function(){
//chiamata ajax
$('#ricerca').click(function(){

    $.ajax({
        url: 'api/allapartments',
        method: 'GET',
        query: 'xiao',
        success: function(data){
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            var raggio = $('#range').val();
            var servizi = $('#range').val();

            console.log(latitude);
            console.log(longitude);
            console.log(raggio);

        }

    })




})



})
