@extends('vam::layouts.app')
@section('content')
<div class="card-header">Confirm Password</div>

<div class="card-body">
    Please confirm your password before continuing.

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password" class="small mb-1">Password</label>

            <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
            <button type="submit" class="btn btn-primary">
                {{ __('Confirm Password') }}
            </button>
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </form>
</div>
@endsection
