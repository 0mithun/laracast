@extends('layouts.app')
@section('header')
   <!-- Header -->
   <header class="header header-inverse h-fullscreen" style="background-image: url({{ $series->image_path }})">
     <div class="header-overlay opacity-70" style="background-color: #563d7c"></div>

     <div class="container text-center">

       <div class="row h-full">
         <div class="col-12 col-lg-8 offset-lg-2 align-self-center">
                <h1 class="display-4 hidden-sm-down">{{ $series->title }}</h1>
                <h1 class="hidden-md-up">{{ $series->title }}</h1>
                <br>
               <p class="fs-20 opacity-70">Customize your series lessons</p>
               <br>
               <br>
               <br>
               @auth
                   @hasStartedSeries($series))
                       <a href="{{ route('series.learning', $series->slug) }}" class="btn btn-primary mr-16 btn-round">CONTINUE LEARNING</a>
                   @else
                       <a href="{{ route('series.learning', $series->slug) }}" class="btn btn-primary mr-16 btn-round">START LEARNING</a>
                   @endhasStartedSeries
               @else
                   <a href="" class="btn btn-primary mr-16 btn-round">START LEARNING</a>
               @endauth

         </div>

         <div class="col-12 align-self-end text-center">
           <a href="" class="scroll-down-1 scroll-down-inverse"></a>
         </div>
       </div>

     </div>
   </header>
   <!-- END Header -->

@stop
@section('content')
 <div class="section">
       <div class="container">

         <header class="section-header">
           <small><strong>COURSE DESCRIPTION</strong></small>
           <h2>What's this course about ?</h2>
           <hr>
         </header>

           <div class="row gap-y">
               <div class="col-12 col-md-8 mb-30 offset-md-2">
                  <p class="text-center">
                       {{ $series->description}}
                  </p>
               </div>
           </div>

       </div>
   </div>
   <section class="bg-gray">
       <div class="container">
           <div class="section-header">
               <h2>Video Lessons</h2>
           </div>

           <hr>

           <p class="lead"></p>
       </div>
   </section>

@stop
