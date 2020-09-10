@extends('layouts.dashboard')

@section('content')
<div id="main-cards" >
    <div class="container">
        <div class="row">
            <div class=" col-10">
                <h1 class="h4">Lista Appartamenti</h1>

            </div>
            <div class="col-2 d-flex align-items-center justify-content-end">
                <a class="" href="
                {{ route('admin.apartments.create')}}
                "><i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container lista-cards">
        <div class="row mb-2">
            @forelse ($apartments as $apartment)
            <div class="col-12 d-lg-flex mt-4 apartment-container">
                <div id="img-wrap" class="col-lg-4 col-12 img-wrap">
                    @if ($apartment->image_url)
                        <img class="img-fluid " src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                    @else
                        {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                        <img class="img-fluid img-appartamento" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg"  alt="foto gatto">
                    @endif
                </div>
                <div class="text-left col-12 col-lg-8 py-4 d-flex flex-column justify-content-between">
                    <div class="testo">
                        <h3>{{$apartment->title}}</h3>
                        <p>{{$apartment->description}}</p>
                        @forelse ($apartment->services as $service)
                             {{ $service->description }}{{ $loop->last ? '' : ', '}}
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
