<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function uploadAvatar(Request $request) {
        if ($request->hasFile('image')) {
            //upload avatar
            $filename = $request->image->getClientOriginalName();
            //richiamo la funzione che cancella gli avatar precedenti
            //se l'avatar è già presente, cancellalo
            $this->deleteOldImage();
            //carica l'avatar (se è presente lo cancella e carica la nuova foto, se non è presente carica la foto e basta)
            $request->image->storeAs('image', $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);
            //fine upload avatar

            //mostro messaggio di ok se l'immagine è caricata con successo
            //metodo 2 stackoverflow
            return redirect()->back()->with('success', 'Hai caricato la tua immagine'); //messaggio ok
        }

        return redirect()->back()->with('error', 'Qualcosa è andato storto'); // messaggio errore


    }

    // funzione per sovrascrivere i vecchi avatar
    // se avatar già presente, cancellalo
    protected function deleteOldImage() {
        if (auth()->user()->avatar){
            Storage::delete('/public/image/' . auth()->user()->avatar);
        }
    }
}
