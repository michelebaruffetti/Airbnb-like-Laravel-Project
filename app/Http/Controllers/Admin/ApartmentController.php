<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Apartment;
use App\Service;
use App\Sponsor;
use App\Message;
use App\User;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */


     public function index()
    {
        // Recupero id utente autenticato
        $id = Auth::id();
        // recupero appartamenti dell'utente loggato
        $apartments = Apartment::all()->where('user_id', $id);
        // Salviamo i dati recuperati in data
        $data = [
            'apartments' => $apartments,
        ];
        // restituisco la view index passando i dati
        return view('admin.apartments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recupero tutti i servizi
        $services = Service::all();
        // restituisco la view con i dati relativi ai servizi
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione dei dati inseriti nel form creazione appartamento
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:2000',
            'room' => 'numeric|max:10',
            'bath' => 'required|numeric|max:10',
            'square_meters' => 'required|numeric|max:1000',
            'image' => 'image|dimensions:min_width=800,min_height=600'
        ]);
        // recupero l'id dell'utente loggato
        $id = Auth::id();
        // salvo i dati del form
        $dati = $request->all();
        // Inserisco l'id dell'utente loggato nello user id dell'appartamento in questione
        $dati['user_id'] = $id;
        // Verifico se l'immagine dell'appartamento è stata caricata
        if(isset($dati['image'])) {
            //carico immagine
            $img_path = Storage::put('uploads', $dati['image']);
            $dati['image_url'] = $img_path;
        }
        // creo un nuovo appartamento
        $apartment = new Apartment();
        $apartment->fill($dati);
        $apartment->save();
        // se i servizi non sono vuoti li sincronizzo
        if(!empty($dati['services'])) {
         $apartment->services()->sync($dati['services']);
        }
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Recupero l'id dell'utente loggato
        $id_user = Auth::id();
        // Recupero tutti i dati relativi alle sponsorizzazioni
        $sponsors = Sponsor::all();
        // recupero l'appartamento dell'utente loggato
        $apartment = Apartment::find($id);
        // se l'utente è il proprietario e l'appartamento esiste
        if($apartment && ($apartment->user_id == $id_user)){
            // recupero i dati
            $data = [
                'apartment' => $apartment,
                'sponsors' => $sponsors
            ];
            return view('admin.apartments.show', $data);
            // altrimenti restituisco pagina 404
        }else{
             return abort('404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
           $services = Service::all();
           $data = [
               'apartment' => $apartment,
               'services' => $services
           ];
           return view('admin.apartments.edit', $data);
        } else {
           return abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:2000',
            'room' => 'required|numeric|max:10',
            'bath' => 'required|numeric|max:10',
            'square_meters' => 'required|numeric|max:1000',
            'image' => 'image|dimensions:min_width=800,min_height=600'
        ]);

        $dati = $request->all();
        if(isset($dati['image'])) {
            //carico immagine
            $img_path = Storage::put('uploads', $dati['image']);
            $dati['image_url'] = $img_path;
        }

        $apartment = Apartment::find($id);
        $apartment->update($dati);
        if(!empty($dati['services'])) {
            $apartment->services()->sync($dati['services']);
        }else{
            $apartment->services()->detach();
        }
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
            $apartment->messages()->delete();
            $apartment->delete();
            return redirect()->route('admin.apartments.index');
        } else {
            return abort('404');
        }
    }


    public function statistics($id){
        // recupero dati per creare dati statistici
        $apartment = Apartment::find($id);
        $messaggi_appartamento_corrente = DB::table('messages')->where('apartment_id', $id)->count();

        $messaggi = DB::table('messages')
             ->select('apartment_id', DB::raw('count(*) as total'))
             ->groupBy('apartment_id')
             ->get();


        $data = [
            'apartment' => $apartment,
            'messaggi' => $messaggi,
            'messaggi_appartamento_corrente'=> $messaggi_appartamento_corrente
        ];
        if($apartment) {
            return view('admin.apartments.chart', $data );
        } else {
            return abort('404');
        }
    }


    public function formPagamento(Request $request){
        // recupero la data odierna con l'orario
        $oggi = Carbon::now();
        // verifico se l'appartamento è sponsorizzato
        $apartment = DB::table('apartments')
            ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where([
                ['end_date', '>', $oggi],
                ['apartment_id', '=', $request->apartment]
            ])->get();
        // se l'appartamento è gia sponsorizzato
        if(!$apartment->isEmpty()){
            return back()->with('message_sponsor_esistente', 'appartamento già sponsorizzato');
        // altrimenti procedo alla sponsorizzazione
        }else{
            // recuperiamo i dati dell'appartamento
            $apartment = Apartment::find($request->apartment);
            // recupero il proprietario
            $user = User::find($apartment->user_id);
            // recupero la sponsorizzazione scelta
            $sponsor = Sponsor::find($request->sponsor);
            // apro il gateway per braintree
            $gateway = new \Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
            // genero  il token
            $token = $gateway->ClientToken()->generate();
            // Gli passiamo i dati
            $data = [
                'token' => $token,
                'apartment' => $apartment,
                'user' => $user,
                'sponsor' => $sponsor,
            ];

            return view('admin.apartments.payment', $data);

        }

    }


    // funzione processo di pagamento
    public function transazione(Request $request){
        // Recuperiamo l'appartamento
        $apartment = Apartment::find($request->apartment);
        // Recupero la sponsorizzazione scelta
        $sponsor = Sponsor::find($request->sponsor);
        // apro il gateway braintree
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        // Recupero la cifra da pagare
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
        // Trasmetto i dati di pagamento a braintree
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => Auth::user()->name,
                'lastName' => Auth::user()->lastname,
                'email' => Auth::user()->email
            ],
            'options' => [
            'submitForSettlement' => true
            ],
        ]);
            // Se la transazione è andata a buon fine
        if ($result->success) {
            $transaction = $result->transaction;
            // Calcolo la end date della sponsorizzazione
            $endDate = Carbon::now()->addDays($sponsor->duration);
            $now = Carbon::now();
            Apartment::find($apartment->id)->sponsors()->attach($sponsor->id, [
                'created_at' => $now,
                'end_date' => $endDate
            ]);
            // restituisco l'id della transazione
            return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id])->with('succes_message', 'pagamento andato a buon fine, ID transazione:' . $transaction->id );
            // altrimenti restituisco l'errore
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('transazione negata per il seguente errore:' . $result->message );
        }

    }

}
