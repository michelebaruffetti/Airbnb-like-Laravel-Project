@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
                @if(session()->has('message'))
                <div class="alert alert-success">
                {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>
</div>


{{-- DETTAGLI APPARTAMENTO GUEST --}}

{{-- sezione immagine --}}
<div class="container-fluid immagine mt-3">

    <div class="row">
        <div class="col-9 text-center ">
            @if ($apartment->image_url)
                <img class="img-fluid rounded img-appartamento" src="{{asset('storage/' . $apartment->image_url)}}"  alt="foto appartamento">
            @else
                <img class="img-fluid rounded img-appartamento" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg"  alt="foto gatto">
            @endif

        </div>
    </div>
</div>

{{-- sezione testuale --}}
<div class="container descrizione">
    <div class="row justify-content-center mb-3">

        {{-- sezione sinistra titolo + descrizione + promozioni --}}
        <div class="col-9 testo-descrizione text-left mt-3">
            <h3>{{$apartment->title}}</h3>
            <div id="descrizione_appartamento">
                <p>{{$apartment->description}}</p>
            </div>

            {{-- SEZIONE MAPPA APPARTAMENTO --}}
            <div class="container promozioni mb-4">
                <div class="row">
                    <div class="col-10 offset-1">
                        <h3 class="text-center">Localizzazione appartamento</h3>
                    </div>
                </div>


                <div class="row  mt-2">
                    <div class="col-10 offset-1">
                        <div class="promozione rounded border border-color-grey py-2 mt-1 mb-1 text-center bg-info">
                            <h1>MAPPA</h1>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- sezione destra dettagli + servizi + statistiche --}}
        <div class="col-3 caratteristiche text-left mt-3">
            <div class="dettagli">
                <h6 class="text-center ">Dettagli</h6>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-50">
                            <i class="fas fa-ruler "></i><span class="badge">area</span>
                        </div>
                        <span class="badge ">{{$apartment->square_meters}}</span>

                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-50">
                            <i class="fas fa-bed"></i> <span class="badge">stanze</span>
                        </div>
                        <span class="badge ">{{$apartment->room}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-50" >
                            <i class="fas fa-bath"></i><span class="badge">bagni</span>
                        </div>
                        <span class="badge ">{{$apartment->bath}}</span>
                    </li>
                </ul>
            </div>

            <div class="servizi">
                <h6 class="text-center mt-3">Servizi Aggiuntivi</h6>

                    <ul class="list-group servizi">
                        @forelse($apartment->services as $service)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <i class="fas fa-check-circle"></i><span>
                                <span class="badge ">{{$service->description}}</span>
                                </li>
                            </ul>
                        @empty
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <i class="far fa-check-circle"></i><span>
                                <span class="badge ">Nessun servizio aggiuntivo</span>
                                </li>
                        @endforelse
                    </ul>
            </div>

            {{-- form invio messaggio --}}
            <div class="mt-3 text-center">
                <h1>INVIA MESSAGGIO</h1>
                <form class="" action="{{route('storemessage', ['apartment' => $apartment->id])}}" method="post"enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="name" class="form-control" id="nome" placeholder="Inserisci il tuo nome" value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        <input type="text" name="lastname" class="form-control" id="nome" placeholder="Inserisci il tuo Cognome" value="{{ old('lastname') }}">
                        @error('lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mail">mail</label>
                        <input type="email" name="email" class="form-control" id="mail" placeholder="Inserisci la tua email" value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="testo">testo</label>
                        <textarea name="text" id="testo" rows="8" cols="32"></textarea>
                        @error('text')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Invia</button>
                </form>
            </div>


        </div>
    </div>
</div>

@endsection
