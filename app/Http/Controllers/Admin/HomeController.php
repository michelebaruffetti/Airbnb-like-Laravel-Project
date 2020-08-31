<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;


class HomeController extends Controller
{
    public function index(){
        $id = Auth::id();
        $appartamenti = Apartment::all()->where('user_id', $id);
        return view('admin.home', compact('appartamenti'));
    }
}
