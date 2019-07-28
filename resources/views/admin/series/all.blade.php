@extends('layouts.app')
 @section('header')
    <!-- Header -->
    <header class="header header-inverse">
      <div class="header-overlay opacity-70" style="background-color: #563d7c"></div>

      <div class="container text-center">

        <div class="row h-full">
          <div class="col-12 col-lg-8 offset-lg-2 align-self-center">
                 <h1>All Series</h1>
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
                <table class="table table-bordered table-striped table-sm  table-hover">
                    <thead>
                        <tr>
                            <th style="width:80%">Title</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($series as $s )
                        <tr>
                            <td>{{ $s->title }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('series.edit', $s->slug) }}">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('series.destroy', $s->slug) }}">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No Series Yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
          </div>


        </div>
      </div>

@stop