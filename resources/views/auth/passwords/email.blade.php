@extends('vam::layouts.app')
@section('content')
<div class="card-header">Reset Password</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="small mb-1">E-Mail Address</label>
            <input id="email" type="email" class="form-control py-4 @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
            <button type="submit" class="btn btn-secondary">
                Send Password Reset Link
            </button>
        </div>
    </form>
</div>
@endsection
