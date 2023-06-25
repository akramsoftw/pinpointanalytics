@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="game" initial="game">

@endsection
@section('content')

@include('layouts.parts.navbar')
@include('layouts.parts.nav')
@include('layouts.parts.nav-list')

<section class="py-main section-choose">
  <div class="container-fluid">
    <div class="heading mb-5">
      <h2>Choose Activity</h2>
    </div>

    <div class="row">
      <div class="col-md-6">
        <a href="{{route('roster')}}" class="card-choose">
          <img src="{{ asset('frontend/img/pinpoint/graphic/basketball-svgrepo-com.svg') }}" alt="Image">
          <h3>Box Score</h3>
        </a>
      </div>
      <div class="col-md-6">
        <a href="{{route('stats')}}" class="card-choose">
          <img src="{{ asset('frontend/img/pinpoint/graphic/bar-chart-svgrepo-com.svg') }}" alt="Image">
          <h3>Statistics </h3>
        </a>
      </div>
      <div class="col-md-6">
        <a href="#" class="card-choose">
          <img src="{{ asset('frontend/img/pinpoint/graphic/bar-chart-svgrepo-com.svg') }}" alt="Image">
          <h3>Graphs </h3>
        </a>
      </div>
      <div class="col-md-6">
        <a href="#" class="card-choose">
          <img src="{{ asset('frontend/img/pinpoint/graphic/basketball-svgrepo-com.svg') }}" alt="Image">
          <h3>Advanced Analytics</h3>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
