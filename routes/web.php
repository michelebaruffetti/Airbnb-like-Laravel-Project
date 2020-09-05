<?php

use Illuminate\Support\Facades\Route;
//aggiungo per sfruttare la funzione request facade di laravel
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//rotte pubbliche
Route::get('/', 'HomeController@index')->name('home');
Route::get('/show/{apartment}', 'ApartmentController@show')->name('show');
Route::post('/show/{apartment}', 'ApartmentController@store')->name('storemessage');

//Rotta che mappa la home page dell'amministratore
Route::prefix('admin')
->namespace('Admin')
->name('admin.')
->middleware('auth')
->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/apartments', 'ApartmentController');
});


//avatar
Route::post('/upload', 'UserController@uploadAvatar');

// //image
// Route::post('/uploads', 'ApartmentController@uploadImage');
