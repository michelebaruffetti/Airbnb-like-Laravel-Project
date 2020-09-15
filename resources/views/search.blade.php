@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="form-address">Indirizzo</label>
                <input type="text" class="form-control" id="form-address" name="address" value="{{old('address', $ricerca['address'])}}" placeholder="Inserisci il tuo indirizzo">
            </div>
            <div class="form-group">
                <input type="hidden" name="latitude" class="form-control" id="latitude" value="{{old('latitude', $ricerca['latitude'])}}">
                <input type="hidden" name="longitude" class="form-control" id="longitude" value="{{old('longitude', $ricerca['longitude'])}}">
            </div>
        </div>
        <div class="form-group col-4">
            <label for="range">Raggio</label>
            <select class="form-control" name="range" id="range">
                <option {{$ricerca['range'] == '20' ? 'selected' : '' }} value="20">20</option>
                <option {{$ricerca['range'] == '50' ? 'selected' : '' }} value="50">50</option>
                <option {{$ricerca['range'] == '100' ? 'selected' : '' }} value="100">100</option>
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

                        @isset($ricerca['services'])
                            {{in_array($service->id, $ricerca['services']) ? 'checked' : '' }}
                        @endisset

                                class="form-check-input servizi "
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
            <button id="ricerca" type="" class="btn btn-primary">Cerca</button>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>appartamenti ricercati</h1>
            <div id="contenitore-appartamenti-sponsorizzati">
                @foreach ($apartments as $apartment)
                <div class="col col-12 col-md-10 d-lg-flex mt-4 apartment-container">
                    <div id="img-wrap" class="col-lg-4 col-12 img-wrap"
                        @if ($apartment->image_url)
                            style="background-image: url({{asset('storage/' . $apartment->image_url)}})"
                        @else
                            {{-- <img class="rounded img-fluid" src="{{asset('storage/not-found/not-found.png')}}" alt="foto-appartamento"> --}}
                            style="background-image: url(https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg"
                        @endif
                        >
                    </div>
                    <div class="card-dx text-left col-12 col-lg-8 py-4 d-flex flex-column justify-content-around">
                        <div class="testo">
                            <a href="{{ route('admin.apartments.show',['apartment'=> $apartment->id])}}"
                                class="title h4 text-uppercase">{{$apartment->title}}</a>
                                {{-- per troncare c'è un comando da terminale da lanciare => composer require laravel/helpers poi riavviare l'artisan serve--}}
                            <p class="paragrafo">{{str_limit($apartment->description, $limit = 100, $end = '...')}}</p>
                            <div class="options d-flex justify-content-between align-items-center">
                                <div class="tags">
                                    @forelse ($apartment->services as $service)
                                        <nobr class="tag-servizi mt-1">{{ $service->description }}</nobr>
                                        {{-- {{ $loop->last ? '' : ', '}} --}}
                                    @empty
                                        -
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div id="contenitore-appartamenti">

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
        <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
        <script src="{{ asset('js/search.js') }}" charset="utf-8"></script>
        <script id="template-apartment" type="text/x-handlebars-template">
            <div class="col col-12 col-md-10 d-lg-flex mt-4 apartment-container">
                <div id="img-wrap" class="col-lg-4 col-12 img-wrap"
                     @{{#if url_image}}
                        style="background-image: url({{asset('storage')}}/@{{url_image}})"
                    @{{else}}
                        
                        style="background-image: url(https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg"
                    @{{/if}}
                    >
                </div>
                <div class="card-dx text-left col-12 col-lg-8 py-4 d-flex flex-column justify-content-around">
                    <div class="testo">
                        @{{title}}
                        <p class="paragrafo">@{{description}}</p>
                        <div class="options d-flex justify-content-between align-items-center">
                            <div class="tags">
                                @{{#each services}}
                                    <nobr class="tag-servizi mt-1">@{{description}}</nobr>
                                @{{/each}}
                            </div>
                
                        </div>
                    </div>
                </div>
            </div>
        </script>
@endsection
