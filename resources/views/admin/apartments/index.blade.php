@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Elenco Articoli</h1>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Aggiungi Post</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>descrizione</th>
                        <th>servizi</th>
                        <th class="text-right">AZIONI</th>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td>{{$apartment->id}}</td>
                                <td>{{$apartment->title}}</td>
                                <td>{{$apartment->description}}</td>
                                <td>
                                    @forelse ($apartment->services as $service)
                                       {{ $service->description }}{{ $loop->last ? '' : ', '}}
                                    @empty
                                       -
                                    @endforelse
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-info"  href="{{route('admin.apartments.show', ['apartment'=> $apartment->id])}}">Dettagli</a>
                                    <a class="btn btn-info">Modifica</a>
                                    <form class="d-inline"  method="post">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
