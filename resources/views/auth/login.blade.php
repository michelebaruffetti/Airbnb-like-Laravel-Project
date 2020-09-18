@extends('layouts.app')

@section('content')
<div class="container" id="login">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div id="testo-login" class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form class="text-center" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mt-3">
						    <div class="col-12 form-group">
                                <div class="contenitore-label">
                                    <label for="email" class="no-outline col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                </div>
                                <div class="contenitore-input">
                                    <input id="email" type="email" class="w3-input w3-border-0" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                    <label for="password" class="no-outline col-form-label text-md-right">{{ __('Password') }}</label>
                                </div>
                                <div class="contenitore-input">
                                <input id="password" type="password" class="w3-input w3-border-0 w-75" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-5 mb-5">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" id="bottone-login" class="btn btn-primary href="{{ route('admin.home') }}"">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
