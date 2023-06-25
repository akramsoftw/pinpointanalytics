@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="error" initial="error">
@endsection

@section('content')

@include('layouts.parts.navbar')
@include('layouts.parts.nav')
@include('layouts.parts.nav-list')

    <section class="py-main section-stats">
      <div class="container-fluid">
        <a href="" class="btn btn-border diff orange mb-3 d-flex d-md-none">Choose Activity</a>
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif 

            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
      </div>
    </section>

@endsection
