/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/search.js":
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
/*! no static exports found */
<<<<<<< HEAD
/***/ (function(module, exports, __webpack_require__) {

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var Handlebars = __webpack_require__(/*! handlebars */ "./node_modules/handlebars/dist/cjs/handlebars.js");

$(document).ready(function () {
  //al caricamento della pagina recupero i dati negli input nascosti e faccio la chiamata ajax
  ricerca(); //al click di ricerca recupero i dati negli input nascosti e faccio la chiamata ajax

  $('#ricerca').click(function () {
    $('#contenitore-appartamenti').empty();
    ricerca();
  });
  $('#range').change(function () {
    $('#contenitore-appartamenti').empty();
    ricerca();
  });
  var servizi_selezionati = [];
  $('.servizi').on('click', function () {
    var servizio_selezionato = $(this).val();

    if (servizi_selezionati.includes(servizio_selezionato)) {
      var indice = servizi_selezionati.indexOf(servizio_selezionato);
      servizi_selezionati.splice(indice, 1);
    } else {
      servizi_selezionati.push(servizio_selezionato);
    }

    console.log('servizio-selezionato: ' + servizio_selezionato);
    console.log('Array servizi selezionati: ' + servizi_selezionati);
    ricerca();
  });

  function ricerca() {
    // $('#contenitore-appartamenti').empty();
    var lat = $('#latitude').val();
    var lng = $('#longitude').val();
    var rag = $('#range').val();
    chiamata(lat, lng, rag);
  }

  function chiamata(latitude, longitude, raggio) {
    $.ajax({
      'url': 'api/allapartments',
      'method': 'GET',
      'data': {
        'latitude': latitude,
        'longitude': longitude,
        'range': raggio
      },
      success: function success(data) {
        $('#contenitore-appartamenti').empty();
        var source = $("#template-apartment").html();
        var template = Handlebars.compile(source); // var sentinella = 0;

        for (var i = 0; i < data.response.length; i++) {
          var servizi_appartamento = []; // per ognuno di essi disegnare in pagina una card utilizzando handlebars.

          var context = {
            url_image: data.response[i].image_url,
            title: data.response[i].title,
            description: data.response[i].description,
            services: data.response[i].services
          };
          var sentinella = 0;

          for (var j = 0; j < data.response[i].services.length; j++) {
            // var servizio = data.response[i].services[j];
            servizi_appartamento.push(data.response[i].services[j].id);
          }

          console.log(servizi_appartamento);
          var html = template(context);

          if (servizi_selezionati.length == 0) {
            $('#contenitore-appartamenti').append(html);
          } else {
            for (var y = 0; y < servizi_selezionati.length; y++) {
              console.log(servizi_selezionati[y]);
              var pippo = Number(servizi_selezionati[y]);

              if (servizi_appartamento.includes(pippo)) {
                // $('#contenitore-appartamenti').empty();
                sentinella = sentinella + 1;
                console.log(sentinella); // $('#contenitore-appartamenti').append(html);
              }

              ;
            }

            if (sentinella == servizi_selezionati.length) {
              $('#contenitore-appartamenti').append(html);
            } // console.log(sentinella);
            // if (sentinella == servizi_selezionati.length){
            //     $('#contenitore-appartamenti').append(html);
            // }

          }

          ; // $('#contenitore-appartamenti').append(html);
        }
=======
/***/ (function(module, exports) {
>>>>>>> footer-francesca

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\resources\\js\\search.js: Unexpected token (43:0)\n\n\u001b[0m \u001b[90m 41 | \u001b[39m    }\u001b[0m\n\u001b[0m \u001b[90m 42 | \u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 43 | \u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<\u001b[39m \u001b[33mUpdated\u001b[39m upstream\u001b[0m\n\u001b[0m \u001b[90m    | \u001b[39m\u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 44 | \u001b[39m    \u001b[36mfunction\u001b[39m chiamata(latitude\u001b[33m,\u001b[39m longitude\u001b[33m,\u001b[39m raggio){\u001b[0m\n\u001b[0m \u001b[90m 45 | \u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 46 | \u001b[39m        $\u001b[33m.\u001b[39majax({\u001b[0m\n    at Parser._raise (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:766:17)\n    at Parser.raiseWithData (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:759:17)\n    at Parser.raise (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:753:17)\n    at Parser.unexpected (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:8966:16)\n    at Parser.parseExprAtom (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:10282:20)\n    at Parser.parseExprSubscripts (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9844:23)\n    at Parser.parseUpdate (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9824:21)\n    at Parser.parseMaybeUnary (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9813:17)\n    at Parser.parseExprOps (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9683:23)\n    at Parser.parseMaybeConditional (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9657:23)\n    at Parser.parseMaybeAssign (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9620:21)\n    at Parser.parseExpressionBase (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9564:23)\n    at C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9558:39\n    at Parser.allowInAnd (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11296:16)\n    at Parser.parseExpression (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9558:17)\n    at Parser.parseStatementContent (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11561:23)\n    at Parser.parseStatement (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11430:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:12012:25)\n    at Parser.parseBlockBody (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11998:10)\n    at Parser.parseBlock (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11982:10)\n    at Parser.parseFunctionBody (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:10962:24)\n    at Parser.parseFunctionBodyAndFinish (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:10945:10)\n    at C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:12152:12\n    at Parser.withTopicForbiddingContext (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11271:14)\n    at Parser.parseFunction (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:12151:10)\n    at Parser.parseFunctionOrFunctionSent (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:10377:17)\n    at Parser.parseExprAtom (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:10202:21)\n    at Parser.parseExprSubscripts (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9844:23)\n    at Parser.parseUpdate (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9824:21)\n    at Parser.parseMaybeUnary (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9813:17)\n    at Parser.parseExprOps (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9683:23)\n    at Parser.parseMaybeConditional (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9657:23)\n    at Parser.parseMaybeAssign (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9620:21)\n    at C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9586:39\n    at Parser.allowInAnd (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:11302:12)\n    at Parser.parseMaybeAssignAllowIn (C:\\MAMP\\htdocs\\consegne\\airbnb-gruppo-3\\node_modules\\@babel\\parser\\lib\\index.js:9586:17)");

/***/ }),

/***/ 3:
/*!**************************************!*\
  !*** multi ./resources/js/search.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

<<<<<<< HEAD
module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/boolean/progetto-finale/airbnb-gruppo-3/resources/js/search.js */"./resources/js/search.js");
=======
module.exports = __webpack_require__(/*! C:\MAMP\htdocs\consegne\airbnb-gruppo-3\resources\js\search.js */"./resources/js/search.js");
>>>>>>> footer-francesca


/***/ })

/******/ });