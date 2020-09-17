@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h5">I Tuoi Messaggi:</h1>
            </div>
        </div>
        <div class="row">
            @forelse ($messages as $message)
                <div class="col-12  text-center my-2 p-0 messaggio">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 d-flex flex-column justify-content-center messaggio-left p-3 ">
                                <h3 class="h5">ID dell'appartamento: {{$message->apartment_id}}</h3>
                                <div class="dati-mittente">
                                    <p class="mb-0"><i class="fas fa-user"></i> {{$message->name}} {{$message->lastname}}</p>
                                    <p class="mb-0"><i class="fas fa-envelope"></i> {{$message->email}}</p>
                                </div>
                            </div>
                            <div class="col-lg-7 d-flex flex-column justify-content-center messaggio-right p-3">
                                <p>{{$message->text}}</p>
                            </div>

                        </div>

                    </div>



                </div>
            @empty
                <div class="col-12 border rounded text-center card ">
                    <p class="p-4">Non hai messaggi da visualizzare.</p>

                </div>
            @endforelse
        </div>
    </div>
@endsection
