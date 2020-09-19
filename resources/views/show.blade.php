@extends('layouts.app')
@section('content')

{{-- SHOW GUEST --}}

{{-- messaggio di conferma invio messaggio --}}
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-6 offset-lg-3 text-center">
                @if(session()->has('message'))
                {{-- <div class="alert alert-success"> --}}
                    <div id='alert-message' class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                        <button id='button-message' type="button" class="close d-block" data-dismiss="alert" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
            @endif
        </div>
    </div>
</div>

<div class="content-wrap">
    {{-- immagine --}}
    <div class="container immagine px-0 mt-3">
        <div class="row intestazione">
            <div class="col-10 offset-lg-1 col-lg-10">
                <h1 class="show-titolo d-block mb-0">{{$apartment->title}}</h1>
                <p class="h6 mt-2 mb-3 address show-paragraph">{{$apartment->address}}</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8">
                <div>
                    @if ($apartment->image_url)
                        <img class="img-fluid img-appartamento" src="{{asset('storage/' . $apartment->image_url)}}"  alt="foto appartamento">
                    @else
                        <img class="img-fluid img-appartamento" src="https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg"  alt="immagine mancante">
                    @endif
                </div>
            </div>
            {{-- dettagli --}}
            <div class="col-12 col-lg-2">
                <div class="dettagli-camera d-flex align-items-center flex-lg-column h-100 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="text-center show-dettagli mt-4 mb-4 d-none d-md-block">Dettagli</h2>
                    <ul class="list-unstyled d-flex flex-lg-column justify-content-around mb-0 h-75 w-100">
                        <li class="text-center">
                            <i class="fas fa-ruler fa-2x"></i>
                            <p class="mb-0">{{$apartment->square_meters . " m²"}}</p>
                        </li>
                        <li class="text-center">
                            <i class="fas fa-bed fa-2x"></i>
                            <p class="mb-0">{{$apartment->room . " stanze"}}</p>
                        </li>
                        <li class="text-center">
                            <i class="fas fa-bath fa-2x"></i>
                            <p class="mb-0">{{$apartment->bath . " bagni"}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- sezione descrizione --}}
    <div class="container px-0 mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="pt-4 mt-4 " id="descrizione-appartamento">
                    <p class="text-justify">{{$apartment->description}}</p>
                </div>
            </div>
            {{-- servizi --}}
            <div class="col-12 col-lg-2 mt-4 h-100">
                <div class="dettagli-servizi d-flex align-items-center align-items-lg-start flex-lg-column pl-4 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="mb-4 mt-3 show-dettagli d-none d-lg-block">Servizi</h2>
                    <div class="tags">
                        <ul class="list-unstyled d-flex flex-wrap flex-md-nowrap flex-lg-column mb-0 w-100">
                            @forelse ($apartment->services as $service)
                            <li class="mt-3">
                                <nobr class="tag-servizi mt-1">{{ $service->description }}</nobr>
                            </li>
                            @empty
                                -
                            @endforelse
                        </ul>
                    </div>
                </div>

            {{-- invia messaggio --}}
                <div id="invia-messaggio" class="mt-3 messaggio pt-5">
                    <h5 class="show-dettagli">Contattaci</h5>
                    <form class="pt-2 d-flex flex-column" action="{{route('storemessage', ['apartment' => $apartment->id])}}" method="post"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control form-control-messaggi" id="nome" placeholder="Nome" value="{{ old('name') }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastname" class="form-control form-control-messaggi" id="nome" placeholder="Cognome" value="{{ old('lastname') }}">
                            @error('lastname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @auth
                                <input type="email" name="email" class="form-control form-control-messaggi" id="mail" readonly placeholder="{{$user->email}}" value="{{$user->email}}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            @endauth

                            @guest
                                <input type="email" name="email" class="form-control form-control-messaggi my-email" id="mail" placeholder="E-mail" value="{{ old('email') }}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            @endguest

                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-messaggi my-text"  name="text" id="testo" placeholder="Messaggio..." rows="6" cols="36"></textarea>
                            @error('text')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="bottone-pieno mt-3">Invia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- sezione mappa --}}
    <div class="container px-0 mt-3 mb-5">
        <div class="row intestazione">
            <div class="col-12 offset-lg-1 col-lg-10 mt-5 mb-3">
                <h3 class="show-dettagli">Localizzazione appartamento</h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="promozione rounded border border-color-grey mt-1 mb-1 text-center">
                    <div id="map"></div>
                    <script>
                        var map = L.map('map').setView(['{{$apartment->latitude}}', '{{$apartment->longitude}}'], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        L.marker(['{{$apartment->latitude}}', '{{$apartment->longitude}}']).addTo(map)
                            .bindPopup('{{$apartment->address}}')
                            .openPopup();
                    </script>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection
{{-- @section('script')
    <script src="{{asset('js/leaflet.js')}}"></script>
@endsection --}}
