@extends('layouts.dashboard')

@section('content')
<div id="main-cards" >
    <div class="container">
        <div class="row">
            <div class="titolo-wrap col-12 d-flex align-items-center">
                <h1 class="h4 mr-4">I tuoi appartamenti</h1>
                <a class="bottone d-flex align-items-center justify-content-around" href="
                {{ route('admin.apartments.create')}}
                "><i class="far fa-plus-square"></i> Inserisci annuncio
                </a>
            </div>
            {{-- <div class="col-2 d-flex align-items-center justify-content-end plus-wrap">
                <a class="" href="
                {{ route('admin.apartments.create')}}
                "><i class="fas fa-plus"></i>
                </a>
            </div> --}}
        </div>
    </div>
    <div class="container lista-cards">
        <div class="row mb-2">
            @forelse ($apartments as $apartment)
            <div class="col-12 d-lg-flex mt-4 apartment-container">
                {{-- @if ($apartment->status==0)
                    <div class="inactive">
                            <i class="far fa-eye-slash"></i><span>Non visibile</span>
                    </div>
                @endif --}}
                <div id="img-wrap" class="col-lg-4 col-12 img-wrap">
                    @if ($apartment->image_url)
                        <img class="img-fluid img-appartamento" src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                    @else
                        {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                        <img class="img-fluid img-appartamento" src="https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg"  alt="immagine mancante">
                    @endif
                </div>
                <div class="text-left col-12 col-lg-8 py-4 d-flex flex-column justify-content-between">
                    <div class="testo">
                        <h2 class="title h4 text-uppercase">{{$apartment->title}}</h3>
                            {{-- per troncare c'è un comando da terminale da lanciare => composer require laravel/helpers poi riavviare l'artisan serve--}}
                        <p class="paragrafo">{{str_limit($apartment->description, $limit = 150, $end = '...')}}</p>
                        @forelse ($apartment->services as $service)
                             <span class="tag-servizi">{{ $service->description }}</span>
                             {{-- {{ $loop->last ? '' : ', '}} --}}
                        @empty
                           -
                        @endforelse
                    </div>
                        <div class="buttons">
                            <a class=" btn btn-outline-primary" value="Dettagli" href="
                            {{ route('admin.apartments.show',['apartment'=> $apartment->id])}}
                            "><i class="fas fa-search"></i></a>

                            <a class="btn btn-outline-success" value="Modifica"  href="
                            {{ route('admin.apartments.edit',['apartment'=> $apartment->id])}}
                            "
                            ><i class="fas fa-pencil-alt"></i></a>

                            <form class="d-inline" action="
                            {{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}
                            "
                            method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-outline-danger" type="submit" value="&#xf12d;">

                            </form>
                        </div>
                </div>
            </div>
         @empty
            <p>AGGIUNGI IL TUO PRIMO APPARTAMENTO</p>
         @endforelse
        </div>
    </div>
</div>

@endsection
