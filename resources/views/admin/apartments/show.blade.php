@extends('layouts.dashboard')

@section('content')
<div class="container intestazione">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Dettagli appartamento</h1>
        </div>
    </div>
</div>
<div class="container-fluid immagine">
    <div class="row justify-content-center">
        <div class="col-12">
            @if ($apartment->image_url)
                <img class="img-fluid rounded" src="{{asset('storage/' . $apartment->image_url)}}"  alt="foto appartamento">
            @else
                <img class="img-fluid rounded" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg"  alt="foto gatto">
            @endif

        </div>
    </div>
</div>
<div class="container descrizione">
    <div class="row justify-content-center">
        <div class="col-8 testo-descrizione text-left mt-3">
            <h3>{{$apartment->title}}</h3>
            <p>{{$apartment->description}}</p>
        </div>
        <div class="col-3 offset-1 caratteristiche text-left mt-3">
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
    </div>
</div>
<div class="container promozioni">
    <div class="row justify-content-center">
        <div class="col-10 offset-1">

        </div>

    </div>
</div>
@endsection
