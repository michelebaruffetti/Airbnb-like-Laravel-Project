<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
    public function all(Request $request)
    {

        $latitude= 45.4335;
        $longitude= 9.1159;
        $distance= 20000000000;

        $results = Apartment::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos(
            radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS
            distance'))
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->where('status', '1')
            // ->rightJoin('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
            // ->rightJoin('services', 'apartment_service.service_id', '=', 'services.id')
            ->get();
        $results=$results->services;
        return response()->json($results);
    }



}
