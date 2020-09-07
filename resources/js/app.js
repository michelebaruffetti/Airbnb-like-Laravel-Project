require('./bootstrap');

var $ = require('jquery');
import 'bootstrap';

// cliccando sull'hamburger menu, mostriamo gli elementi della navbar
$('#toggle').click(
    function(){
        $('.hamburger-menu').show();
});
