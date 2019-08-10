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
        <div class="container">
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
          @php
            $user = auth()->user(); 
            $subscription  = $user->subscriptions->first();

          @endphp

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
                 @if($subscription)
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-3">
                    <h6>Card Details</h6>
                  </a>
                </li>
                @endif
              </ul>
            </div>


            <div class="col-8 col-md-8 align-self-center">
              <div class="tab-content text-center">
                <div class="tab-pane fade show active" id="tab-1">
                  <form action="">
                    <div class="form-group">
                      <input type="text" placeholder="Your name"  class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Your Email"  class="form-control">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary btn-block">Save Change</button>
                    </div>
                  </form>
                </div>

                <div class="tab-pane fade" id="tab-2">
                        <h5 class="text-center">Your Current Plan:
                          @if($subscription)
                             <span class="badge badge-success">{{ $subscription->stripe_plan }}</span></h5>
                          @else
                           <span class="badge badge-danger" >You have not any plan </span> &nbsp;&nbsp;   <a href="{{ route('subscribe.show') }}" class="">Please Subscribe to a plan </a>
                          @endif
                        
                        <br>
                        @if($subscription)
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
                        @endif
                </div>
                 @if($subscription)

                <div class="tab-pane fade" id="tab-3">

                      <h3>
                        Your current card: <span class="badge badge-primary">{{  $user->card_brand }} | {{  $user->card_last_four }}</span>
                      </h3>
                      <br>
                      <vue-update-card email="{{  $user->email }}"></vue-update-card>
                    
                </div>
                @endif
              </div>
            </div>


          </div>

        </div>
    </section>
@stop

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection
