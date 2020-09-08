<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{

    public function all(Request $request){

        $apartments = Apartment::all()->where('status', '1');

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
