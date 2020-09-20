var $ = require('jquery');
$(document).ready(function() {
    var Chart = require('chart.js');
//grafico
    var messaggi = $('#messaggi_ricevuti').text();
    var visualizzazioni = $('#visualizzazioni').text();
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Messaggi e visualizzazioni ricevute'],
        datasets: [{
            label: ['Messaggi'],
            data: [messaggi],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        },
        {
            label: ['Visualizzazioni'],
            data: [visualizzazioni],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
});