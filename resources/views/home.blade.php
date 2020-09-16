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
                    <input type="hidden" name="range" class="form-control" id="range" value="20">
                </div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Cerca</button>
            </div>
        </div>

        </form>
    </div>


    <section class="carousel mb-3">
        <div class="container">
            <div class="row justify-items-center">
                <div class="col-12 col-md-8 offset-md-2">
                    <div id="carousel-sponsor" class="carousel slide" data-ride="carousel">

                        <!-- immagini carosello -->
                        <div class="carousel-inner text-center">
                            @foreach($apartments as $apartment)
                              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                  @if ($apartment->image_url)
                                      <img class="rounded img-fluid " src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                                  @else
                                      {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                                      <img class="img-fluid rounded" src="https://image.freepik.com/vettori-gratuito/banner-di-twitch-offline-carino-con-gatto_23-2148588262.jpg" alt="foto gatto">
                                  @endif
                                     <div class="carousel-caption d-none d-md-block">
                                        <h3>{{$apartment->title}}</h3>
                                        <p>{{$apartment->description }}</p>
                                     </div>
                              </div>
                            @endforeach
                        </div>

                        <!-- controlli carosello -->
                        <a class="carousel-control-prev" href="#carousel-sponsor" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-sponsor" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <div class="container lista-cards">
        <div class="row mb-2">
            <h1>SPONSORIZZATI</h1>
            @forelse ($apartments as $apartment)
            <div class="col-12 d-flex rounded border border-color-grey py-2 mt-1 mb-1">
                <div class="col-4  immagine d-flex align-items-center">
                    @if ($apartment->image_url)
                        <img class="rounded img-fluid " src="{{asset('storage/' . $apartment->image_url)}}" alt="foto-appartamento">
                    @else
                        {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
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
            <p>non ci sono Appartamenti sponsorizzati</p>
            @endforelse
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
