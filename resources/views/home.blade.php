@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Questa è la home generale</h1>
            </div>
        </div>
        <form class="" action="{{Route('search')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="form-address">Indirizzo</label>
                    <input type="text" class="form-control" id="form-address" name="address" value="{{old('address')}}" placeholder="Inserisci il tuo indirizzo">
                </div>
                <div class="form-group">
                    <input type="hidden" name="latitude" class="form-control" id="latitude" value="{{old('latitude')}}">
                    <input type="hidden" name="longitude" class="form-control" id="longitude" value="{{old('longitude')}}">
                </div>
            </div>
            <div class="form-group col-4">
                <label for="range">Raggio</label>
                <select class="form-control" name="range" id="range">
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-10">
                Servizi:
                <div class="d-flex ">
                    @foreach ($services as $service)
                        <div class="form-check">
                            <label class="form-check-label">
                            <input
                                    class="form-check-input"
                                    name="services[]"
                                    type="checkbox"
                                    value="{{ $service->id }}">
                                {{ $service->description }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Cerca</button>
            </div>
        </div>
        </form>
    </div>

    {{-- <div class="container lista-cards">
        <div class="row mb-2">
            <h1>SPONSORIZZATI</h1>
            @forelse ($apartments as $apartment)
            <div class="col-12 d-flex rounded border border-color-grey py-2 mt-1 mb-1">
                <div class="col-4  immagine d-flex align-items-center">
                    @if ($apartment->image_url)
                        <img class="rounded img-fluid " src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                    @else
                        {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                        {{-- <img class="img-fluid rounded" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg"  alt="foto gatto">
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
            <p>non ci sono Appartamenti sponsorizzati</p>
         @endforelse
        </div> --}}
    {{-- </div>  --}}




    <p class="text-center text-uppercase" id="paragrafo" >Appartamenti sponsorizzati</p>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @forelse ($apartments as $apartment)
                <div class="carousel-item {{ $loop->first ? 'active' : "" }} ">
                    <div class="col-md-4 col-sm-6 col-xs-12 rounded">
                        <div class="hovereffects">
                        @if ($apartment->image_url)
                            <img src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                        @else
                            {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                                <img class="" src="https://picsum.photos/200/200" height="300px" width="100%" alt="images">
                        @endif

                            <div class="overlay">
                                <h3 class="h-25">{{$apartment->title}}</h3>
                                <p class="h-50">{{$apartment->description}}</p>
                                <a class="info h-25" href="#">more info</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 d-flex flex-wrap">
                        <div class="hovereffects">
                        @if ($apartment->image_url)
                            <img class="rounded img-fluid d-flex flex-wrap" src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                        @else
                            {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                                <img class="" src="https://picsum.photos/200/200" height="300px" width="100%" alt="images">
                        @endif

                            <div class="overlay">
                                <h3 class="h-25" >{{$apartment->title}}</h3>
                                <p class="h-50" >{{$apartment->description}}</p>
                                <a class="info h-25" href="#">more info</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="hovereffects">
                        @if ($apartment->image_url)
                            <img class="rounded img-fluid d-flex flex-wrap" src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                        @else
                            {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                            <div class="hovereffects">
                                <img src="https://picsum.photos/200/200" height="300px" width="100%" alt="images">
                            </div>
                        @endif
                            <div class="overlay">
                                <h3 class="h-25" >{{$apartment->title}}</h3>
                                <p class="h-50" >{{$apartment->description}}</p>
                                <a class="info h-25" href="#">more info</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" id="control-larghezza" href="#myCarousel" data-slide="prev" style="background: transparent;color: #3255e3;">
                   <span class="glyphicon glyphicon-chevron-left" ></span>
                   <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" id="control-larghezza" href="#myCarousel" data-slide="next" style="background: transparent;color: #3255e3;">
                   <span class="glyphicon glyphicon-chevron-right" ></span>
                   <span class="sr-only">Next</span>
                </a>

            @empty
            <p>non ci sono Appartamenti sponsorizzati</p>
        </div>
        @endforelse
    </div>

@endsection
@section('script')
    <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
