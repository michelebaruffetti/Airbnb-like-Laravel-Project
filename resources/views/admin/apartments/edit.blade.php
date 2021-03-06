@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <h1 class="mt-3 mb-3">Nuova inserzione</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id] )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="titolo">Titolo</label>
                    <input type="text" name="title" required class="form-control" id="titolo" placeholder="Titolo inserzione" value="{{ old('title', $apartment->title) }}">
                </div>
                <div class="form-group">
                    <label for="testo">Descrizione</label>
                    <textarea type="text" name="description" class="form-control" id="testo" placeholder="Inserisci descrizione dell'appartamento...">{{ old('description', $apartment->description) }}</textarea>
                </div>

                <!-- form indirizzo -->
                <div class="form-group">
                    <label for="form-address">Indirizzo</label>
                    <input type="search" required class="form-control" id="form-address" name="address" value="{{old('address', $apartment->address)}}" placeholder="Inserisci il tuo indirizzo">
                </div>
                <div class="form-group">
                    <input type="hidden" name="latitude" class="form-control" id="latitude" value="{{old('latitude')}}">
                    <input type="hidden" name="longitude" class="form-control" id="longitude" value="{{old('longitude')}}">
                </div>

                <div class="form-group">
                    <label for="numero-stanze">Numero di stanze:</label>
                    <select class="form-control" name="room" id="numero-stanze">
                        {{-- <option value="">Seleziona il numero di stanze</option> --}}
                        @for ($i = 1; $i <= 10; $i++)

                            <option value='{{$i}}' {{ old('room',$apartment->room)==$i ? 'selected' : ''  }}>{{$i}}</option>

                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="numero-bagni">Numero di bagni:</label>
                    <select class="form-control" name="bath" id="numero-bagni">
                        {{-- <option value="">Seleziona il numero di bagni</option> --}}
                        @for ($i = 1; $i <= 10; $i++)

                            <option value='{{$i}}' {{ old('bath',$apartment->bath)==$i ? 'selected' : ''  }}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="mq">Dimensioni</label>
                    <input type="number" required min="0" name="square_meters" class="form-control" id="mq" placeholder="Inserisci le dimensioni in mq dell'appartamento..." value="{{ old('square_meters', $apartment->square_meters) }}">
                </div>
                <div class="form-group">
                    <label for="immagine">Immagine</label>
                    <input type="file" name="image" id="immagine" class="form-control-file">
                    @if ($apartment->image_url)
                    <p>Immagine presente </p>
                    <img src="{{ asset('storage/' . $apartment->image_url )}}" class="img-preview-apartment">
                @else
                    <p>Immagine non presente</p>
                @endif
                </div>

                {{-- <div class="">
                        <img src="{{asset('storage/' . $apartment->image_url)}}" alt="foto appartamento">
                </div> --}}

                <div class="form-group">
                    <div class="col-12 col-lg-6 px-0 d-sm-inline">
                        <input class="radio" type="radio" name="status" id="is_active_yes" value="1" @if($apartment->status==1)
                checked
                @endif>
                <label class="radio-label-form" for="is_active_yes">
                    <i class="far fa-eye"></i><span> Visibile nelle ricerche</span>
                </label>
                    </div>
                <div class="col-12 col-lg-6 px-0 d-sm-inline ml-sm-3">
                    <input class="radio" type="radio" name="status" id="is_active_no" value="0" @if(!$apartment->status==1)
                checked
                @endif>
                <label class="radio-label-form" for="is_active_no">
                    <i class="far fa-eye-slash"></i><span> Non visibile nelle ricerche</span>
                </label>
                </div>
                
                </div>




                <div class="form-group">
                    Servizi:
                    @foreach ($services as $service)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input
                                    @if ($errors->any())
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                    @else
                                        {{ $apartment->services->contains($service) ? 'checked' : '' }}
                                    @endif
                                    class="form-check-input"
                                    name="services[]"
                                    type="checkbox"
                                    value="{{ $service->id }}">
                                {{ $service->description }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn bottone-pieno">Salva</button>
                <a value="Visualizza" href="{{ route('admin.apartments.show',['apartment'=> $apartment->id])}}" id="my-btn" class="btn btn-outline-danger" type="button">
                    Annulla
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
