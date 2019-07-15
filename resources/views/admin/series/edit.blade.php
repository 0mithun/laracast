 @extends('layouts.app')
@section('header')
  <header class="header header-inverse" style="background-color:#c2b2cd">
  
  
    <div class="container text-center">
      <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
          <h1>Edit {{ $series->title }}</h1>
          <p class="fs-20 opacity-70">Let's make the world better place</p>
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


              <form action="{{ route('series.update', $series->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="alert alert-success">We received your message and will contact you back soon.</div>

                <div class="form-group">
                  <input class="form-control form-control-lg" value="{{ old('title', $series->title) }}" type="text" name="title" placeholder="Series Title">
                </div>

                <div class="form-group">
                  <input class="form-control form-control-lg" type="file" name="image">
                </div>

                <div class="form-group">
                  <textarea class="form-control form-control-lg" name="description" rows="4" placeholder="Series Description">{{ old('description', $series->description) }}</textarea>
                </div>


                <button class="btn btn-lg btn-primary btn-block" type="submit">Save Series</button>
              </form>

            </div>
          </div>


        </div>
      </div>

@stop