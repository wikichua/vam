@extends('vam::layouts.app')
@section('content')
<div class="card-header">
    <h3 class="text-center font-weight-light my-4">Login</h3>
</div>
<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="small mb-1" for="email">Email</label>
            <input id="email" type="email" class="form-control py-4 @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="small mb-1" for="password">Password</label>
            <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" id="remember" name="remember" type="checkbox"
                    {{ old('remember') ? 'checked' : '' }} />
                <label class="custom-control-label" for="remember">Remember password</label>
            </div>
        </div>
        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
            @if (Route::has('password.request'))
            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
            <button type="submit" class="btn btn-secondary">Login</button>
        </div>
    </form>
</div>
<div class="card-footer text-center">
    @if (Route::has('register'))
    <div class="small">
        <a href="{{ route('register') }}">Need an account? Sign up!</a>
    </div>
    @endif
</div>
@endsection
