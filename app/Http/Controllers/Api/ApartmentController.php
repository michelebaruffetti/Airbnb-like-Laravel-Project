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


        $latitude= $request->latitude;
        $longitude= $request->longitude;
        $distance= $request->range;

        $results = Apartment::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos(
            radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS
            distance'))
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->with('services')
            ->where('status', '1')
            ->get();

        return response()->json($results);
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
