@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>lista appartamenti inseriti
                    oppure crea un annuncio</h1>
            </div>
        </div>
    </div>
    <div class="container lista-cards">
        <div class="row">
            <div class="col-12 d-flex rounded border border-color-grey py-2">
                <div class="col-4  immagine">
                    <img class="rounded" src="https://placekitten.com/300/300" alt="foto-appartamento">
                </div>
                <div class="text-left col-8 py-4 d-flex flex-column justify-content-between">
                    <div class="testo">
                        <h3>nome appartamento</h3>
                        <p>descrizione appartamento</p>
                    </div>

                    <div class="buttons">
                        <a class="btn btn-small btn-info" href="#">Dettagli</a>
                        <a class="btn btn-small btn-warning" href="#">Modifica</a>
                        <a class="btn btn-small btn-danger" href="#">Cancella</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
