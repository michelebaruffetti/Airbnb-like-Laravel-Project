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
Route::post('/show/{apartment}', 'ApartmentController@sendmessage')->name('storemessage');
Route::post('/search', 'HomeController@search')->name('search');

//Rotta che mappa la home page dell'amministratore
Route::prefix('admin')
->namespace('Admin')
->name('admin.')
->middleware('auth')
->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/message', 'HomeController@readmessage')->name('message');
    Route::resource('/apartments', 'ApartmentController');
    Route::get('/payment', function(){
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $token = $gateway->ClientToken()->generate();

        return view('admin.apartments.payment', ['token' => $token]);
    });
    Route::post('/checkout', function(Request $request){
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
            return back()->with('succes_message', 'pagamento andato a buon fine, ID transazione:' . $transaction->id );
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: " . $baseUrl . "index.php");
            return back()->withErrors('transazione negata per il seguente errore:' . $result->message );
        }
    })->name('checkout');
    Route::get('/statistics/{apartment}', 'ApartmentController@statistics')->name('statistics');
});


//avatar
Route::post('/upload', 'UserController@uploadAvatar');

// //image
// Route::post('/uploads', 'ApartmentController@uploadImage');
