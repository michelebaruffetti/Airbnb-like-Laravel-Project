@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <h1>messaggi ricevuti:</h1>
                    <h3 id="messaggi_ricevuti" class="">{{$messaggi_appartamento_corrente}}</h3>


            </div>
            <div class="col-sm-12 col-lg-6">
                <h1>visualizzazioni:</h1>
                <h3 id="visualizzazioni">{{$apartment->views}}</h3>


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
@section('script')
        <script src="{{ asset('js/grafici.js') }}" charset="utf-8"></script>
@endsection
