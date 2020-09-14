@extends('layouts.dashboard')

@section('content')

{{-- DETTAGLI APPARTAMENTO ADMIN --}}


<div class="content-wrap">
    {{-- sezione immagine --}}
    <div class="container immagine px-0 mt-3">
        <div class="row intestazione">
            <div class="offset-1 col-10">
                <h1 class="h2 d-block mb-0">{{$apartment->title}}</h1>
                <p class="h6 mt-2 mb-3 address">{{$apartment->address}}</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                @if ($apartment->image_url)
                    <img class="img-fluid img-appartamento" src="{{asset('storage/' . $apartment->image_url)}}"  alt="foto appartamento">
                @else
                    <img class="img-fluid img-appartamento" src="https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg"  alt="immagine mancante">
                @endif
            </div>
            <div class="col-2 dettagli-camera d-flex flex-column">
                <h2 class="text-center h5 mt-4 mb-4">Dettagli</h2>
                <ul class="list-unstyled d-flex flex-column justify-content-around mb-0 h-75">
                    <li class="text-center">
                        <i class="fas fa-ruler fa-2x"></i>
                        <p class="">{{$apartment->square_meters . " m²"}}</p>
                    </li>
                    <li class="text-center">
                        <i class="fas fa-bed fa-2x"></i>
                        <p>{{$apartment->room . " stanze"}}</p>
                    </li>
                    <li class="text-center">
                        <i class="fas fa-bath fa-2x"></i>
                        <p>{{$apartment->bath . " bagni"}}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- sezione testuale --}}
    <div class="container descrizione">
        <div class="row justify-content-center mb-3">

            {{-- sezione sinistra titolo + descrizione + promozioni --}}
            <div class="col-12 col-lg-9 testo-descrizione text-left pt-4">
                {{-- <h3>{{$apartment->title}}</h3> --}}
                <div id="descrizione-appartamento">
                    <p class="text-justify">{{$apartment->description}}</p>
                </div>

                {{-- promozioni --}}
                <div class="container promozioni py-3">
                    <div class="row">
                        <div class=" col-12 col-lg-10 offset-lg-1">
                            <h3 class="h4 text-center">Sponsorizza il tuo appartamento</h3>
                        </div>
                    </div>

                    @foreach ($sponsors as $sponsor)
                        <div class="row ">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="promozione rounded border border-color-grey py-2 mt-1 mb-1 text-center bg-info">
                                    <h5>Prezzo: {{$sponsor->price}}</h5>
                                    <span>Metti in evidenza il tuo appartamento per {{$sponsor->description}} ore</span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- sezione destra dettagli + servizi + statistiche --}}
            <div class="col-12 col-lg-3 caratteristiche text-left mt-3">
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

                <div class="statistiche mt-3 text-center">

                    <img class="img-fluid rounded border border-color-grey" src="https://d1whtlypfis84e.cloudfront.net/guides/wp-content/uploads/2018/12/24160114/LOSDOS1-1024x767.png" alt="grafici">
                    <button class="btn btn-success color-white mt-2 w-100" type="button" name="button">
                        <a href="{{Route('admin.statistics', ['apartment' => $apartment->id])}}">Le tue statistiche</a>
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
