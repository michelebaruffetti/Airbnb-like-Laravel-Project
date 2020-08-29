@extends('layouts.app')
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
                        <th>SLUG</th>
                        <th class="text-right">AZIONI</th>
                    </thead>
                    <tbody>
                        @foreach ($appartamenti as $appartemento)
                            <tr>
                                <td>{{$appartemento->id}}</td>
                                <td>{{$appartemento->title}}</td>
                                <td>{{$appartemento->slug}}</td>
                                <td class="text-right">
                                    <a class="btn btn-info">Dettagli</a>
                                    <a class="btn btn-info">Modifica</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
