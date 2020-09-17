@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="h5">Account:</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12 text-center profile-wrapper">
            <div class="container ">
                <div class="row">
                    <div id="immagine-profilo" class="col-12 col-lg-4  p-3 justify-content-center">
                        {{-- mostra avatar solo se presente --}}
                        @if (Auth::user()->avatar)
                            <img class="img-fluid rounded" src="{{asset('/storage/image/' . Auth::user()->avatar)}}" alt="avatar" >
                        {{-- altrimenti non mostra nulla --}}
                        @else
                            <img class=" img-fluid rounded" src="https://static.catsoncatnip.co/images/KznOtripTBMd_4551_700.jpg" alt="avatar" >
                        @endif
                    </div>
                    <div class="col-12 p-3 col-lg-8 d-flex flex-column justify-content-center">
                        <div class="dati-anagrafici p-2 border-bottom border-color-grey">
                            <p>Nome: {{Auth::user()->name}}</p>
                            <p>Cognome: {{Auth::user()->lastname}}</p>
                            <p>Data di Nascita: {{Auth::user()->birthday}}</p>
                            <p>E-mail: {{Auth::user()->email}}</p>
                        </div>
                        <div class="inserimento-immagine d-flex justify-content-center">
                            <form class="p-4" action="/upload" method="post" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control-sm" type="file" name="image">
                                <input class="form-control-sm mt-2" type="submit" value="Upload">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
