@extends('layouts.app')
@section('header')
   <!-- Header -->
   <header class="header header-inverse" style="background-color:#9ac29d">
     <div class="container text-center">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <h1>{{ $lesson->title }}</h1>
                <p class="fs-20 opacity-70">{{ $series->title }}</p>
            </div>
        </div>
     </div>
   </header>
   <!-- END Header -->

@stop
@section('content')
   <div class="section bg-gray">
        <div class="container">        
            <div class="row gap-y">
                <div class="col-12 text-center">
                    <vue-player default_lesson="{{ $lesson }}"></vue-player>
                    
                    @if($lesson->getPreviousLesson())
                         <a href="{{ route('series.watch',['series'=> $series->slug, 'lesson'=>$lesson->getPreviousLesson()->id]) }}" class="btn btn-info pull-left">Previous Lesson</a>
                    @endif

                    @if($lesson->getNextLesson())
                        <a href="{{ route('series.watch',['series'=> $series->slug, 'lesson'=>$lesson->getNextLesson()->id]) }}" class="btn btn-info pull-right">Next Lesson</a>
                    @endif
       
                </div>

                <div class="col-12">
                    <ul class="list-group">
                        @foreach ($series->getOrderdedLessons() as $currentLesson)
                            <li class="list-group-item">
                                <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $currentLesson->id]) }}">{{ $currentLesson->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
       </div>
   </div>
@stop
