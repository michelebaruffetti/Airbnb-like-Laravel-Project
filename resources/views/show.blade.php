@extends('layouts.app')
@section('content')
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
    {{-- sezione immagine --}}
    <div class="container immagine px-0 mt-3">
        <div class="row intestazione">
            <div class="col-10 offset-lg-1 col-lg-10">
                <h1 class="h2 d-block mb-0">{{$apartment->title}}</h1>
                <p class="h6 mt-2 mb-3 address">{{$apartment->address}}</p>
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
            <div class="col-12 col-lg-2">
                <div class="dettagli-camera d-flex align-items-center flex-lg-column h-100 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="text-center h5 mt-4 mb-4 d-none d-md-block">Dettagli</h2>
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
                <div class="pt-4 mt-4" id="descrizione-appartamento">
                    <p class="text-justify">{{$apartment->description}}</p>
                </div>
            </div>
            <div class="col-12 col-lg-2 mt-4">
                <div class="dettagli-servizi d-flex align-items-center align-items-lg-start flex-lg-column pl-4 h-50 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="h4 mb-4 mt-3 d-none d-lg-block">Servizi</h2>
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
                <div class="statistiche d-flex align-items-center flex-lg-column pl-4 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="h4 mb-4 mt-3 d-none d-lg-block">Statistiche</h2>
                    <div class="">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="https://static.html.it/app/uploads/2014/11/chart_pie.png" alt="grafici">
                        </div>
                        <a class="bottone" href="{{Route('admin.statistics', ['apartment' => $apartment->id])}}">Le tue statistiche</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-0 mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-10">
                <h3 class="h4 mt-3">Incrementa le visite sponsorizzando il tuo appartamento</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 offset-lg-1 col-lg-10">
                <div class="d-flex justify-content-between w-100 mt-3 mb-5">
                    @foreach ($sponsors as $sponsor)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center  py-5">
                            <h5 class="card-title">Pacchetto promo {{$sponsor->id}}:</h5>
                            <p class="card-text py-2">Mettilo in evidenza per {{$sponsor->description}} ore</p>
                            <a href="#" class="bottone-pieno mt-3">Paga {{$sponsor->price}} €</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- sezione testuale --}}
<div class="container descrizione">
    <div class="row justify-content-center mb-3">


            {{-- SEZIONE MAPPA APPARTAMENTO --}}
            <div class="container promozioni py-3">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <h3 class="h4 text-center">Localizzazione appartamento</h3>
                    </div>
                </div>


                <div class="row  mt-2">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <div class="promozione rounded border border-color-grey py-2 mt-1 mb-1 text-center bg-info">
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

        {{-- sezione destra dettagli + servizi + statistiche --}}
        <div class="col-12 col-lg-3 caratteristiche text-left py-4">
            <div class="dettagli">
                <h6 class="text-center ">Dettagli</h6>
                <ul class="list-group">
                    <li class="list-group-item d-flex text-center align-items-center">
                        <div class="w-25">
                            <i class="fas fa-ruler "></i>
                        </div>
                        <div class="w-50">
                            <span class="badge">area</span>
                        </div>
                        <div class="w-25">
                            <span class="badge">{{$apartment->square_meters}}</span>
                        </div>

                    </li>
                    <li class="list-group-item d-flex text-center align-items-center">
                        <div class="w-25">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="w-50">
                            <span class="badge">stanze</span>
                        </div>
                        <div class="w-25">
                            <span class="badge">{{$apartment->room}}</span>
                        </div>

                    </li>
                    <li class="list-group-item d-flex text-center align-items-center">
                        <div class="w-25">
                            <i class="fas fa-bath"></i>
                        </div>
                        <div class="w-50">
                            <span class="badge">bagni</span>
                        </div>
                        <div class="w-25">
                            <span class="badge">{{$apartment->bath}}</span>
                        </div>

                    </li>

                </ul>
            </div>


            <div class="servizi">
                <h6 class="text-center mt-3">Servizi Aggiuntivi</h6>

                    <ul class="list-group servizi">
                        @forelse($apartment->services as $service)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="w-25 text-center">
                                        <i class="fas fa-check-circle"></i><span>
                                    </div>
                                    <div class="w-50">

                                    </div>
                                    <div class="w-25 text-center">
                                        <span class="badge ">{{$service->description}}</span>
                                    </div>
                                </li>
                            </ul>
                        @empty
                                <li class="list-group-item d-flex text-center align-items-center">
                                    <div class="w-25">
                                        <i class="far fa-check-circle"></i><span>
                                    </div>
                                    <div class="w-50">

                                    </div>
                                    <div class="w-25">
                                        <span class="badge ">Nessuno</span>
                                    </div>
                                </li>
                        @endforelse
                    </ul>
            </div>

            {{-- form invio messaggio --}}
            <div class="mt-3 text-center messaggio pt-5">
                <h5>Invia messaggio</h5>
                <form class="pt-2" action="{{route('storemessage', ['apartment' => $apartment->id])}}" method="post"enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="nome" placeholder="Inserisci il tuo nome" value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" id="nome" placeholder="Inserisci il tuo Cognome" value="{{ old('lastname') }}">
                        @error('lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        @auth
                            <input type="email" name="email" class="form-control" id="mail" readonly placeholder="{{$user->email}}" value="{{$user->email}}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endauth

                        @guest
                            <input type="email" name="email" class="form-control" id="mail" placeholder="Inserisci la tua email" value="{{ old('email') }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endguest

                    </div>
                    <div class="form-group">
                        <textarea class="form-control"  name="text" id="testo" placeholder="Inserisci qui il tuo messaggio..." rows="6" cols="36"></textarea>
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
{{-- @section('script')
    <script src="{{asset('js/leaflet.js')}}"></script>
@endsection --}}
