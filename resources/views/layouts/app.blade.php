<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap &middot; The world's most popular mobile-first and responsive front-end framework.</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/thesaas.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
  </head>

  <body>

    <div id="app">

    <!-- Topbar -->
    <nav class="topbar  topbar-expand-sm topbar-sticky">
      <div class="container">
        
        <div class="topbar-left">
          <button class="topbar-toggler">&#9776;</button>
          <span class="topbar-brand fs-18 fw-400">
            <a class="logo-default" href="{{ url('/') }}" style="color: #563d7c">{{ config('app.name')}}</a>
            <a class="logo-inverse text-white" href="#">{{ config('app.name') }}</a>
          </span>
        </div>

        <div class="topbar-right">
          <ul class="topbar-nav nav">

            @if(auth()->check())


              <li class="nav-item"> <a class="nav-link" href="{{ route('series.create')}}">Create Series</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('series.index')}}">All Series</a> </li>


              <li class="nav-item">Hey, {{ auth()->user()->name }}</li>
              <li class="nav-item">  <a class="nav-link" href="{{ route('profile', auth()->user()->username) }}">Profile</a> </li>
              <li class="nav-item" > <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> Log Out </a></li>
              {{-- <li class="nav-item"><a class="nav-link" href="#" >Log Out</a></li> --}}
              <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                @csrf
              </form>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
              <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#LoginModal">Login</a></li>
            @endif
          </ul>
        </div>

      </div>
    </nav>
    <!-- END Topbar -->


   
 <!----Header -->
    @yield('header')
 <!----END Header -->




    <!-- Main container -->
    <main class="main-content">


        <!---- Content -->
            @yield('content')
        <!----END Content -->

    </main>
    <!-- END Main container -->
      <vue-noty></vue-noty>
    @guest
      <vue-login></vue-login>
    @endguest
    

  <!-- Footer -->
    <footer class="site-footer">
      <div class="container">
        <div class="row gap-y justify-content-center">
          <div class="col-12 col-lg-6">
            <ul class="nav nav-primary nav-hero">
              <li class="nav-item hidden-sm-down">
                <a class="nav-link" href="/">Laracast</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>


    <!-- Scripts -->
    <script src="{{ asset('assets/js/core.min.js') }}"></script>
    <script src="{{ asset('assets/js/thesaas.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

  </body>
</html>
