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
        <div class="col-9">

        </div>
        <div class="col-3">

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
