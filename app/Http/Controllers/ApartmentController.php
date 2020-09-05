<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Message;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //salva il messaggio
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:2000',
            'email' => 'required|email',
            'text' => 'required',
        ]);
        $dati = $request->all();
        $dati['apartment_id'] = $id;
        $message = new Message();
        $message->fill($dati);
        $message->save();
        return redirect()->back()->with('message', 'Messaggio inviato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::find($id);
        if($apartment){
            $data = [
                'apartment' => $apartment
            ];
            return view('show', $data);
        }else{
             return abort('404');
        }
    }

}
