 @extends('layouts.app')
 @section('header')
    <!-- Header -->
    <header class="header header-inverse h-fullscreen" style="background-image: url({{ asset('assets/img/bg-gift.jpg') }})">
      <div class="header-overlay opacity-70" style="background-color: #563d7c"></div>

      <div class="container text-center">

        <div class="row h-full">
          <div class="col-12 col-lg-8 offset-lg-2 align-self-center">
                 <h1>{{ $series->title }}</h1>
                <p class="fs-20 opacity-70">Customize your series lessons</p>
          </div>
        </div>

      </div>
    </header>
    <!-- END Header -->

 @stop
 @section('content')
  <div class="section">
        <div class="container">

          <div class="row gap-y">
            <div class="col-12 col-md-12">
                <vue-lesson default_lessons="{{ $series->lessons }}" series_id = {{ $series->id }}></vue-lesson>
            </div>
          </div>


        </div>
      </div>

@stop