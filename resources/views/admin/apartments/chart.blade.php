@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <h1>messaggi ricevuti per questo appartamento</h1>
                    <p id="messaggi_ricevuti">{{$messaggi_appartamento_corrente}}</p>

                    <p>elenco messaggi per appartamento di questo utente (da usare per fare il grafico)</p>
                @foreach ($messaggi as $msmp)
                    l'appartamento: {{$msmp->apartment_id}} ha {{$msmp->total}} messaggi <br>
                @endforeach

            </div>
            <div class="col-sm-12 col-lg-6">
                <h1>visualizzazioni per questo appartamento</h1>
                <p id="visualizzazioni">{{$apartment->views}}</p>


            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="grafico">
                      <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>



@endsection
