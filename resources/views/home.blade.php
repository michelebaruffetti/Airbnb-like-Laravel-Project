@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Questa è la home generale</h1>
            </div>
        </div>
        <form class="" action="index.html" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="form-address">Indirizzo</label>
                    <input type="search" class="form-control" id="form-address" name="address" value="{{old('address')}}" placeholder="Inserisci il tuo indirizzo">
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
@endsection
@section('script')
    <script src="{{ asset('js/search.js') }}" charset="utf-8"></script>
@endsection
