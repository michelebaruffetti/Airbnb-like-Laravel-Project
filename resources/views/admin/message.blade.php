@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h6">I Tuoi Messaggi:</h1>
            </div>
        </div>
        <div class="row">
            @forelse ($messages as $message)
                <div class="col-12 border rounded text-center my-2 p-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-5 d-flex flex-column justify-content-center">
                                <h3 class="h5">ID dell'appartamento: {{$message->apartment_id}}</h3>
                                <p class="mb-0"><strong>Mittente:</strong> {{$message->name}} {{$message->lastname}}</p>
                                <p class="mb-0"><strong>Email:</strong> {{$message->email}}</p>
                            </div>
                            <div class="col-7 d-flex flex-column justify-content-center">
                                <p><strong>Richiesta:</strong> {{$message->text}}</p>
                            </div>

                        </div>

                    </div>



                </div>
            @empty
                <div class="col-12 border rounded text-center ">
                    <p class="p-2">Non hai messaggi da visualizzare.</p>

                </div>
            @endforelse
        </div>
    </div>
@endsection
