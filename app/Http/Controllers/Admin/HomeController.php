<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class HomeController extends Controller
{
    public function index(){
        $appartamenti = Apartment::all();
        return view('admin.home', compact('appartamenti'));
    }
}
