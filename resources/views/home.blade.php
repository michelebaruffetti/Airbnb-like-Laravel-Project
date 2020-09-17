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

    </div>

    <div class="container lista-cards mb-3 ">
        <div class="row mb-2">

            @forelse ($apartments as $apartment)

                <div class="col-10 offset-1 offset-md-0 col-md-4 mt-5">
                    <div class="card card-appartamento h-100 mt-3">
                        @if ($apartment->image_url)
                            <img class="card-img-top" src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                        @else
                            <img class="card-img-top" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg" alt="No picture">
                        @endif
                      <div class="card-body">
                        <h5 class="card-title">{{$apartment->title}}</h5>
                        <p class="card-text">{{str_limit($apartment->description, $limit = 200, $end = '...')}}</p>
                      </div>
                    </div>
                </div>

            @empty

            @endforelse

                {{-- <h1>SPONSORIZZATI</h1>
                @forelse ($apartments as $apartment)
                <div class="col-12 d-flex rounded border border-color-grey py-2 mt-1 mb-1">
                    <div class="col-4  immagine d-flex align-items-center">
                        @if ($apartment->image_url)
                            <img class="rounded img-fluid " src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                        @else

                            <img class="img-fluid rounded" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg" alt="foto gatto">
                        @endif
                    </div>
                    <div class="text-left col-8 py-4 d-flex flex-column justify-content-between">
                        <div class="testo">
                            <h3>{{$apartment->title}}</h3>
                            <p>{{$apartment->description}}</p>
                            @foreach ($apartment_service as $ser)
                                @if($apartment->id == $ser->apartment_id)
                                 {{$ser->description }}
                                @endif
                            @endforeach
                        </div>
                            <div class="buttons">
                                <a class=" btn btn-outline-primary" value="Dettagli" href="
                                {{ route('show',['apartment'=> $apartment->id])}}
                                "><i class="fas fa-search"></i></a>
                            </div>
                    </div>
                </div>
                @empty
                <p>Non ci sono appartamenti sponsorizzati</p>
                @endforelse --}}
        </div>

    </div>


@endsection
@section('script')
    <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
