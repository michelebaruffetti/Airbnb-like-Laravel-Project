@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>I Tuoi Messaggi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Apartment ID</th>
                      <th scope="col">Client Name</th>
                      <th scope="col">Client Email</th>
                      <th scope="col">Mesasge</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($messages as $message)
                            <th scope="row">{{$message->apartment_id}}</th>
                            <td>{{$message->name}} {{$message->lastname}}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->text}}</td>
                          </tr>
                      @endforeach

                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
