<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\Apartment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()


    {
        $services = Service::all();
        $oggi = date("Y/m/d");

        $apartment_service = DB::table('apartments')
        ->leftJoin('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
        ->leftJoin('services', 'apartment_service.service_id', '=', 'services.id')->get();


        $apartments = DB::table('apartments')
        ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where([
                ['status', '=', '1'],
                ['end_date', '>', $oggi],
                ])
            ->get();

        $data = [
            'services' => $services,
            'apartments' => $apartments,
            'apartment_service' => $apartment_service
        ];

        return view('home', $data);
    }

    public function search(Request $request){
        $request->validate([
            'address' => 'required'
        ]);
        $services = Service::all();
        $ricerca = $request->all();

        $oggi = date("Y/m/d");
        $apartments = Apartment::select(DB::raw('*'))
            ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where([
                ['status', '=', '1'],
                ['end_date', '>', $oggi],
                ])
            ->with('services')
            ->get();

            $data = [
                'services' => $services,
                'ricerca' => $ricerca,
                'apartments' => $apartments
            ];
            return view('search', $data);
        
    }

}
