@extends('backsite.layouts.login')

@section('content')
<div class="login-container">
    <h1 class="login-title">REGISTER</h1>
    <div class="login-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="login-field">
                <i class="fa-solid fa-user login-icon"></i>
                <input id="name" type="text" name="name"
                    class="login-input form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="login-field">
                <i class="fa-regular fa-envelope login-icon"></i>
                <input id="email" type="email" name="email" class="login-input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" placeholder="Email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="login-field">
                <i class="fa-solid fa-lock login-icon"></i>
                <input id="password" type="password" name="password"
                    class="login-input form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="new-password" placeholder="Password" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="login-button">
                {{ __('Register') }}
            </button>
            {{-- <input type="submit" value="Log In" class="login-button" /> --}}
        </form>
        <p class="login-link">Already have an Account?<a href="{{ route('login') }}">{{ __('Login') }}</a></p>
    </div>
</div>
<script src="https://kit.fontawesome.com/f1fd297175.js" crossorigin="anonymous"></script>
@endsection
