var places = require('places.js');
(function() {

    var placesAutocomplete = places({
      appId: 'plQJ0AF39XJK',
      apiKey: '5c9f0d58aab1f0a7cb9f847a8786b412',
      container: document.querySelector('#form-address'),
      templates: {
        value: function(suggestion) {
          return suggestion.name;
        }
      }
    }).configure({
      type: 'address'
    });
    placesAutocomplete.on('change', function resultSelected(e) {
      document.querySelector('#latitude').value = e.suggestion.latlng.lat || '';
      document.querySelector('#longitude').value = e.suggestion.latlng.lng || '';
    });
  })();
