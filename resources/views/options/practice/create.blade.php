@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="options" initial="options">
    <style>
        .btn-action {
            font-weight: 500 !important;
        }
        .btn-action:hover {
            color: #fff !important;
        }
    </style>
@endsection

@section('content')

    @include('layouts.parts.nav-2')
    @include('layouts.parts.navbar')

    <div class="py-main">
        <div class="container container-sm">
            <div class="heading my-3 my-lg-4">
                <h1>Add Practice Game</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3><a href="{{route('options_game')}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Practice</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box p-4">
                            {!! Form::open(array('route' => 'practice_store','method'=>'POST')) !!}

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Home Team</label>
                                {!! Form::select('home_team', $teams,'', array('class' => 'form-control')) !!}
                                {!! $errors->first('home_team', '<small id="item_typeHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Opponent</label>
                                {!! Form::select('opponent', $teams,'', array('class' => 'form-control')) !!}
                                {!! $errors->first('opponent', '<small id="item_typeHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Location</label>
                                {!! Form::text('location', null, array('placeholder' => 'Enter location', 'class' => 'form-control')) !!}
                                {!! $errors->first('location', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Date</label>
                                {!! Form::date('time', null, array('class' => 'form-control')) !!}
                                {!! $errors->first('time', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <button type="submit" class="btn btn-sm btn-success">
                                Add
                            </button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
