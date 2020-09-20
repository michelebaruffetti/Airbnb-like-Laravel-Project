<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
    public function all(Request $request){
        // Creo un array di dati per la risposta
        $results = [
            'number_records' => 0,
            'response' => []
        ];
        // recupero tutti i dati dal form di richiesta dell'utente
        $latitude= $request->latitude + 0.001;
        $longitude= $request->longitude + 0.001;
        $distance= $request->range;
        $min_room = $request->room;
        $min_bath = $request->bath;
        // Recupero tutti gli appartamenti attivi entro il raggio definito dall'utente, con il minimo di bagni e stanze
        $response = Apartment::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos(
            radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS
            distance'))
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->with('services')
            ->where([
                ['status', '=', '1'],
                ['room', '>=', $min_room],
                ['bath', '>=', $min_bath]
            ])
            ->get();

        $results['response'] = $response;
        $results['number_records'] = count($response);

        return response()->json($results);
    }


    // Api che restituisce appartamenti sponsorizzati ( non usata in questo progetto)

    // public function sponsored(){
    //     $oggi = date("Y/m/d");
    //     $apartments = Apartment::select(DB::raw('*'))
    //         ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
    //         ->where([
    //             ['status', '=', '1'],
    //             ['end_date', '>', $oggi],
    //             ])
    //         ->with('services')
    //         ->get();
    //         return response()->json($apartments);
    // }
}
