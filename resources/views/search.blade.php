@extends('layouts.app')
@section('content')
    {{-- {{$ricerca['address']}}
    {{$ricerca['latitude']}}
    {{$ricerca['longitude']}}
    {{$ricerca['range']}} --}}



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

                                class="form-check-input "
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
            <div id="contenitore-appartamenti">

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
        <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
