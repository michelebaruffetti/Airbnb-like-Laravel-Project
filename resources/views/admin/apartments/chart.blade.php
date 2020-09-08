@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <h1>messaggi ricevuti per questo appartamento</h1>
                    <p>{{$messaggi_appartamento_corrente}}</p>

                    <p>elenco messaggi per appartamento di questo utente (da usare per fare il grafico)</p>
                @foreach ($messaggi as $msmp)
                    l'appartamento: {{$msmp->apartment_id}} ha {{$msmp->total}} messaggi <br>
                @endforeach
                <div class="grafico">
                      <canvas id="myChart-message"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <h1>visualizzazioni per questo appartamento</h1>
                {{$apartment->views}}
                <div class="grafico">
                      <canvas id="myChart-views"></canvas>
                </div>
            </div>
        </div>

    </div>



@endsection
