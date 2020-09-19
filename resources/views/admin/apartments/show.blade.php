@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-6 offset-lg-3 text-center">
                @if(session()->has('message_sponsor_esistente'))
                {{-- <div class="alert alert-success"> --}}
                    <div id='alert-message' class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('message_sponsor_esistente') }}
                        <button id='button-message' type="button" class="close d-block" data-dismiss="alert" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('succes_message'))
                {{-- <div class="alert alert-success"> --}}
                    <div id='alert-message' class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('succes_message') }}
                        <button id='button-message' type="button" class="close d-block" data-dismiss="alert" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
        </div>
    </div>
</div>

{{-- DETTAGLI APPARTAMENTO ADMIN --}}


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
                        <img class="img-fluid img-appartamento" src="{{asset('storage/' . $apartment->image_url)}}" alt="foto appartamento">
                    @else
                        <img class="img-fluid img-appartamento" src="https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg" alt="immagine mancante">
                    @endif
                </div>
                <div class="d-flex pt-3">
                    <a value="Modifica"  href="{{ route('admin.apartments.edit',['apartment'=> $apartment->id])}}" class="bottone-pieno btn-crud" type="button">
                        Modifica
                    </a>
                    <form autocomplete="off" class="bottone-pieno btn-crud ml-3" type="button" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}"method="post">
                        @csrf
                        @method('DELETE')
                        <input class="myinput text-white" type="submit" value="Elimina">
                    </form>
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
    <div class="container px-0 mt-2">
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

    {{-- nuove card --}}
    <div class="container px-0 mt-5">
        @if ($apartment->status == 1)
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-10">
                <h3 class="h4 mt-3">Incrementa le visite sponsorizzando il tuo appartamento</h3>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-lg-10 offset-lg-1 d-flex justify-content-between">
            @foreach ($sponsors as $sponsor)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pacchetto: {{$sponsor->id}}</h5>
                    <p class="card-text">Metti in evidenza il tuo appartamento per {{$sponsor->description}} ore</p>
                    <a href="{{Route('admin.payment', ['apartment' => $apartment->id, 'sponsor' => $sponsor->id])}}" class="btn bottone-pieno">{{$sponsor->price}} €</a>
                </div>
            </div>
            @endforeach
            </div>
        </div>
        @else
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-10">
                    <h3 class="h4 mt-3">Attiva il tuo appartamento per poterlo sponsorizzare</h3>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-lg-10 offset-lg-1 d-flex justify-content-between ">
                @foreach ($sponsors as $sponsor)
                <div class="card sponsor-inattivo" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Pacchetto: {{$sponsor->id}}</h5>
                        <p class="card-text">Metti in evidenza il tuo appartamento per {{$sponsor->description}} ore</p>
                        <a href="#" class="btn bottone-pieno" disabled>{{$sponsor->price}} €</a>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
