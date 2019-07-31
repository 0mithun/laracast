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
            @php
                $next_lesson = $lesson->getNextLesson();
                $previous_lesson = $lesson->getPreviousLesson();

            @endphp

            <div class="row gap-y">
                <div class="col-12 text-center">
                    <vue-player default_lesson="{{ $lesson }}"

                        @if($next_lesson->id !== $lesson->id)
                            next_lesson_url="{{ route('series.watch',['series'=> $series->slug, 'lesson'=>$next_lesson]) }}"
                        @endif
                    
                    ></vue-player>
                    
                    @if($previous_lesson->id !== $lesson->id)
                         <a href="{{ route('series.watch',['series'=> $series->slug, 'lesson'=>$previous_lesson->id]) }}" class="btn btn-info pull-left">Previous Lesson</a>
                    @endif

                    @if($next_lesson ->id !== $lesson->id)
                        <a href="{{ route('series.watch',['series'=> $series->slug, 'lesson'=>$next_lesson->id]) }}" class="btn btn-info pull-right">Next Lesson</a>
                    @endif
       
                </div>

                <div class="col-12">
                    <ul class="list-group">
                        @foreach ($series->getOrderdedLessons() as $currentLesson)
                            <li class="list-group-item 
                                @if($lesson->id == $currentLesson->id)
                                    list-group-item-info
                                @endif
                            ">
                                @if(auth()->user()->hasCompletedLesson($currentLesson))
                                    <b><small>Completed</small></b>
                                @endif
                                <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $currentLesson->id]) }}">{{ $currentLesson->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
       </div>
   </div>
@stop
