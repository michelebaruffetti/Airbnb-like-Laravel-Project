<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

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
        // $oggi = date("Y/m/d");
        // $apartments = DB::table('apartments')
        //     ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
        //     ->where([
        //         ['status', '=', '1'],
        //         ['end_date', '>', $oggi],
        //         ])
        //     ->get();

        return view('home', compact('services'));
    }

    public function search(Request $request){
        $request->validate([
            'address' => 'required'
        ]);
        $services = Service::all();
        $ricerca = $request->all();

        $data = [
            'services' => $services,
            'ricerca' => $ricerca
        ];
        return view('search', $data);
    }

}
