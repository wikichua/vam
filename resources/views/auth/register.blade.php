@extends('vam::layouts.app')
@section('content')
<div class="card-header">
    <h3 class="text-center font-weight-light my-4">Register</h3>
</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name" class="small mb-1">Name</label>
            <input id="name" type="text" class="form-control py-4 @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="small mb-1">E-Mail Address</label>

            <input id="email" type="email" class="form-control py-4 @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="small mb-1">Password</label>

            <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm" class="small mb-1">Confirm Password</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
            <button type="submit" class="btn btn-secondary">
                Register
            </button>
        </div>
    </form>
</div>
@endsection
