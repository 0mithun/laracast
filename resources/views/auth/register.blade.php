@extends('layouts.app')

@section('content')
<div class="card card-shadowed p-50 w-400 mb-0 register-page" style="max-width: 100%; margin:0 auto">
      <h5 class="text-uppercase text-center">Register</h5>
      <br><br>

      <form class="form-type-material" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" name="name">
          @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <input type="text"  value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email">
           @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
          @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password (confirm)" name="password_confirmation">
        </div>

        <div class="form-group">
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">I agree to all <a class="text-primary" href="#">terms</a></span>
          </label>
        </div>

        <br>
        <button class="btn btn-bold btn-block btn-primary" type="submit">Register</button>
      </form>

      <hr class="w-30">

      <p class="text-center text-muted fs-13 mt-20">Already have an account? <a href="page-login.html">Sign in</a></p>
    </div>
@stop
