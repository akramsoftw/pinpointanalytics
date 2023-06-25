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
                <h1>Add Player</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3><a href="{{route('team_show', $team->id)}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Team: {{$team->name}}</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box p-4">
                            {!! Form::open(array('route' => ['player_store'],'method'=>'POST')) !!}

                            {!! Form::hidden('team_id', $team->id, array()) !!}

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Number</label>
                                {!! Form::text('number', null, array('placeholder' => 'Enter number', 'class' => 'form-control')) !!}
                                {!! $errors->first('name', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Name</label>
                                {!! Form::text('name', null, array('placeholder' => 'Enter name', 'class' => 'form-control')) !!}
                                {!! $errors->first('name', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="position" class="text-sm">Position</label>
                                @php $position_arr = ['PG','SG','SF','PF','C','G','F'] @endphp
                                <select name="position" id="position" class="form-control">
                                    <option value="">Select position</option>
                                    @foreach($position_arr as $position)
                                        <option value="{{$position}}">{{$position}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('position', '<small id="positionHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Tagline</label>
                                {!! Form::text('tagline', null, array('placeholder' => 'Enter tagline', 'class' => 'form-control')) !!}
                                {!! $errors->first('tagline', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
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
