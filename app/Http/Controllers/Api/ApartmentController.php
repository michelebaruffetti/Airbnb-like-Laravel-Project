<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{

    public function all(){
        $apartments = Apartment::all()->where('status', '1');
        // $apartments = DB::table('apartments')
        // ->leftJoin('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
        // ->leftJoin('services', 'apartment_service.service_id', '=', 'services.id')->where('status', '1')->get();
        // $data = [];
        // foreach ($apartments as $apartment) {
        //
        // }
        return response()->json($apartments);
    }

    public function sponsored(){
        $oggi = date("Y/m/d");
        $apartments = DB::table('apartments')
            ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where([
                ['status', '=', '1'],
                ['end_date', '>', $oggi],
                ])
            ->get();
            return response()->json($apartments);
    }
}
