@extends('layouts.dashboard')

@section('content')
<div id="main-cards" >
    <div class="container">
        <div class="row">
            <div class="titolo-wrap col-12 col col-md-10 offset-md-1 d-flex align-items-center justify-content-between">
                <h1 class="h4 mr-4">I tuoi appartamenti</h1>
                <a class="bottone d-flex align-items-center justify-content-around" href="
                {{ route('admin.apartments.create')}}
                "><i class="far fa-plus-square"></i> Inserisci annuncio
                </a>
            </div>
        </div>
    </div>
    <div class="container lista-cards">
        <div class="row justify-content-center mb-2">
            @forelse ($apartments as $apartment)
            <div class="col col-12 col-md-10 d-lg-flex mt-4 apartment-container">
                <div id="img-wrap" class="col-lg-4 col-12 img-wrap"
                    @if ($apartment->image_url)
                        style="background-image: url({{asset('storage/' . $apartment->image_url)}})"
                    @else
                        style="background-image: url(https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg)"
                    @endif
                    >
                </div>
                <div class="card-dx text-left col-12 col-lg-8 py-4 d-flex flex-column justify-content-around">
                    <div class="testo">
                        <a href="{{ route('admin.apartments.show',['apartment'=> $apartment->id])}}"
                            class="title h4 text-uppercase">{{$apartment->title}}</a>
                            {{-- per troncare c'è un comando da terminale da lanciare => composer require laravel/helpers poi riavviare l'artisan serve--}}
                        <p class="paragrafo">{{str_limit($apartment->description, $limit = 100, $end = '...')}}</p>
                        <div class="options d-flex justify-content-between align-items-center">
                            <div class="tags">
                                @forelse ($apartment->services as $service)
                                    <nobr class="tag-servizi mt-1">{{ $service->description }}</nobr>
                                    {{-- {{ $loop->last ? '' : ', '}} --}}
                                @empty
                                    -
                                @endforelse
                            </div>
                            <div class="dropdown d-inline mr-3">
                                <button class="mydrop btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a value="Visualizza" href="{{ route('admin.apartments.show',['apartment'=> $apartment->id])}}" class="dropdown-item" type="button">
                                        Visualizza
                                    </a>
                                    <a value="Modifica"  href="{{ route('admin.apartments.edit',['apartment'=> $apartment->id])}}" class="dropdown-item" type="button">
                                        Modifica
                                    </a>
                                    {{-- <button class="dropdown-item" type="button">Disattiva</button> --}}
                                    <form autocomplete="off" class="dropdown-item" type="button" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}"method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="myinput" type="submit" value="Elimina">
                                    </form>
                                </div>
                            </div>
                        </div>
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
