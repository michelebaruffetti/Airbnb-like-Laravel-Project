@extends('layouts.dashboard')
{{-- <div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        {{ __('You are logged in!') }}
    </div>
    <div class="card-body">
        <form action="/upload" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image">
            <input type="submit" value="upload">
        </form>
    </div>
</div>
<h1>Questa è la home dell'UPR/UPRA</h1> --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8  col-lg-10 text-center border border-color-grey rounded">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-4 d-flex p-3 justify-content-center">
                        {{-- mostra avatar solo se presente --}}
                        @if (Auth::user()->avatar)
                            <img class="rounded " src="{{asset('/storage/image/' . Auth::user()->avatar)}}" alt="avatar" >
                        {{-- altrimenti non mostra nulla --}}
                        @else
                            <img class="rounded " src="https://static.catsoncatnip.co/images/KznOtripTBMd_4551_700.jpg" alt="avatar" >
                        @endif
                    </div>
                    <div class="col-12 p-3 col-xl-8">
                        <div class="dati-anagrafici p-2 border-bottom border-color-grey">
                            <p>Nome: {{Auth::user()->name}}</p>
                            <p>Nome: {{Auth::user()->lastname}}</p>
                            <p>Nome: {{Auth::user()->birthday}}</p>
                            <p>Nome: {{Auth::user()->email}}</p>
                        </div>
                        <div class="inserimento-immagine">
                            <form class="p-4" action="/upload" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="image">
                                <input type="submit" value="upload">
                            </form>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>
@endsection
