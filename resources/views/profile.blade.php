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
   <section class="section">
        <div class="container">
          <header class="section-header">
            <small>Features</small>
            <h2>Header variations</h2>
            <hr>
            <p class="lead">We waited until we could do it right. Then we did! Instead of creating a carbon copy.</p>
          </header>


          <div class="row">
            

            <div class="col-4 col-md-4">
              <ul class="nav nav-vertical">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tab-1">
                    <h6>Personal Details</h6>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-2">
                    <h6>Payment & Subscriptions</h6>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-3">
                    <h6>Settings</h6>
                  </a>
                </li>
              </ul>
            </div>


            <div class="col-8 col-md-8 align-self-center">
              <div class="tab-content text-center">
                <div class="tab-pane fade show active" id="tab-1">
                tab 1 content
                  <img class="shadow-3" src="assets/img/header-color.jpg" alt="...">
                </div>

                <div class="tab-pane fade" id="tab-2">
                        <h5 class="text-center">Your Current Plan: <span class="badge badge-success">{{ auth()->user()->subscriptions->first()->stripe_plan }}</span></h5>
                        <br>
                        <form action="{{ route('subscriptions.change') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <select name="plan" id="plan" class="form-control">
                                    <option value="">Change Plan</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <button class="btn btn-info btn-block">Change Plan</button>
                            </div>
                        </form>
                </div>

                <div class="tab-pane fade" id="tab-3">
                tab 3 content
                  <img class="shadow-3" src="assets/img/header-image.jpg" alt="...">
                </div>

              </div>
            </div>


          </div>

        </div>
      </section>

   <section class="section bg-grey" id="section-vtab">
        <header 
@stop
