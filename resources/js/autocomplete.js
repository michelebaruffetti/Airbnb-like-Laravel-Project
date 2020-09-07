var places = require('places.js');
(function() {

    var placesAutocomplete = places({
      appId: process.env.$MIX_APP_ID,
      apiKey: process.env.$MIX_API_KEY,
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
      var latitude = e.suggestion.latlng.lat || '';
      var longitude = e.suggestion.latlng.lng || '';
      console.log(latitude);
      console.log(longitude);
    });
  })();
