require('./bootstrap');


var $ = require('jquery');
import 'bootstrap';

// cliccando sull'hamburger menu, mostriamo gli elementi della navbar
$('#panino').click(
    function(){
        $('.hamburger-menu').show();
        $('.close').show();
        $('#panino').hide();
        $('#main-cards').hide();
});

$('#close').click(
    function(){
        $('.hamburger-menu').hide();
        $('.close').hide();
        $('#panino').show();
        $('#main-cards').show();
});
