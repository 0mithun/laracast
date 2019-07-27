@extends('layouts.app')
@section('header')
    <!-- Header -->
    <header class="header header-inverse h-fullscreen" style="background-image: url(assets/img/bg-gift.jpg)">
      <div class="header-overlay opacity-70" style="background-color: #563d7c"></div>

      <div class="container text-center">

        <div class="row h-full">
          <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

            <p><img src="assets/img/demo/bootstrap/logo.png" alt="..."></p>
            <br>
            <h1 class="display-4">LARACAST</h1>
            <br>
            <p class="fs-22"><b>Laracast</b> is an awsome web development learning subscription based SaaS Application powered by Vuejs and Laravel</p>

            <hr class="w-80">

            <p>
              <a class="btn btn-xl btn-round  btn-primary w-250" href="#">DEMOS</a>
              <a class="btn btn-xl btn-round btn-outline btn-white w-250" href="#">FEATURES</a>
            </p>
                 <div class="col-12 align-self-end text-center">
        <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
        </div>
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
          <header class="section-header">
            <small>Lessopn</small>
            <h2>Featured Screencasts</h2>
            <hr>
            <p class="lead"></p>
          </header>
        </div>
      </section>
    </main>
    <!-- END Main container -->
@stop
