@extends('layouts.app')
@section('header')
   <!-- Header -->
   <header class="header header-inverse" style="background-color:#9ac29d">
     <div class="container text-center">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <h1>Mithun Halder</h1>
                <p class="fs-20 opacity-70">mithun-halder</p>
                <br>

                <h1>{{ $user->getTotalNumberOfCompletedLessons() }}</h1>
            </div>
        </div>
     </div>
   </header>
   <!-- END Header -->

@stop
@section('content')
   <section class="section" id="section-vtab">
        <header class="container">
            <header class="section-header">
                <h2>Series Being Watched</h2>
                <hr>
            </header>
            <div class="row gap-5">
                @forelse($series as $s)
                    <div class="card mb-30">
                        <div class="row align-items-center h-full">
                        <div class="col-12 col-md-4">
                            <a href="blog-single.html"><img src="{{ $s->image_path  }}" alt="..."></a>
                        </div>

                        <div class="col-12 col-md-8">
                            <div class="card-block">
                            <h4 class="card-title">{{ $s->title }}</h4>
                            <p class="card-text">{{ $s->description }}</p>
                            <a class="fw-600 fs-12" href="{{ route('series', $s->slug)  }}">Read more <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
       </div>
   </section>

   <section class="section bg-grey" id="section-vtab">
        <header class="container">
            <header class="section-header">
                <h2>Series Being Watched</h2>
                <hr>
            </header>
            <div class="row gap-5">

            </div>
       </div>
   </section>
@stop
