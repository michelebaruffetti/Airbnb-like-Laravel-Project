@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <form action="{{Route('search')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12 col-md-10 mb-2">
                            {{-- <label for="form-address" class="col-form-label label-ricerca">Ricerca il tuo appartamento: </label> --}}
                            <input class="testo-ricerca" type="text"  id="form-address" name="address" value="{{old('address')}}" placeholder="In quale città vuoi andare?">
                        </div>
                        <div class="col-6 offset-3 offset-md-0 col-md-2 d-flex mb-2">
                            <button id="btn-cerca" type="submit" class="btn w-100 ">Cerca</button>
                        </div>
                    </div>
                        {{-- form nascosto --}}
                        <div class="form-group">
                            <input type="hidden" name="latitude" class="form-control" id="latitude" value="{{old('latitude')}}">
                            <input type="hidden" name="longitude" class="form-control" id="longitude" value="{{old('longitude')}}">
                            <input type="hidden" name="range" class="form-control" id="range" value="20">
                        </div>
                </form>
            </div>
    </div>

    <div class="container lista-cards mb-3 ">
        <div class="row mb-2">
            @forelse ($apartments as $apartment)
                <div class="col-10 offset-1 offset-md-0 col-md-4 mt-5 text-center">
                    <div class="card card-appartamento h-100 mt-3">
                        <a href="{{ route('show',['apartment'=> $apartment->id])}}">
                            @if ($apartment->image_url)
                                <img class="card-img-top" src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                            @else
                                <img class="card-img-top" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg" alt="No picture">
                            @endif

                          <div class="card-body">
                            <h3 class="card-title h3 text-uppercase mt-0">{{$apartment->title}}</h3>
                            <p class="card-text">{{str_limit($apartment->description, $limit = 200, $end = '...')}}</p>
                          </div>
                          <small class="sponsorizzato">IN VETRINA</small>
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

    </div>


@endsection
@section('script')
    <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
