@extends('layouts.app')

@section('content')
<div class="container" id="register">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div id="testo-register" class="card-header text-center text-uppercase font-weight-bold py-4">{{ __('Register') }}</div>

                <div class="card-body">
                    <form class="text-center" method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- first name --}}
                        <div class="row mt-3">
						    <div class="col-6 form-group">
                                <div class="contenitore-label">
                                    <label for="name" class="no-outline col-form-label text-md-right">{{ __('Name') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="name" type="text" class="w3-input w3-border-0 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
						    <div class="col-6 form-group">
                                <div class="contenitore-label">
                                    <label for="lastname" class="no-outline col-form-label text-md-right">{{ __('Lastname') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="lastname" type="text" class="w3-input w3-border-0 form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="form-group col-12">
                                <div class="contenitore-label">
                                    <label for="birthday" class="w3-input w3-border-0 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="birthday" type="date" class="w3-input w3-border-0 form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>

                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="form-group col-12">
                                <div class="contenitore-label">
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="email" type="email" class="w3-input w3-border-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="form-group col-12">
                                <div class="contenitore-label">
                                    <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="password" type="password" class="w3-input w3-border-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="form-group col-12">
                                <div class="contenitore-label">
                                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="password-confirm" type="password" class="w3-input w3-border-0 form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-5 mb-5">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" id="bottone-register">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
