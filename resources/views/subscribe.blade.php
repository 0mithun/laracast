@extends('layouts.app')
@section('header')
    <!-- Header -->
    <header class="header header-inverse h-fullscreen" style="background-image: url(assets/img/bg-gift.jpg)">
      <div class="header-overlay opacity-70" style="background-color: #563d7c"></div>

      <div class="container text-center">

        <div class="row h-full">
            <div class="col-12 col-lg-8 offset-lg-2">
                <h1>Subscribe to our awsome site</h1>
            </div>
        </div>

      </div>
    </header>

    
    <!-- END Header -->

@stop

@section('content')
    <!-- Main container -->
    <main class="main-content">
      <section class="section">
        <div class="container">
          <vue-stripe email="{{ auth()->user()->email }}"></vue-stripe>
        </div>
      </section>
    </main>
    <!-- END Main container -->
@stop

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection