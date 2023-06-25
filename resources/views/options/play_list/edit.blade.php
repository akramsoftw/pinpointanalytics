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
                <h1>Edit Play</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3><a href="{{route('options_play_list')}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Play List</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box p-4">
                            {!! Form::open(array('route' => ['play_update', $play->id],'method'=>'POST')) !!}

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Name</label>
                                {!! Form::text('name', $play->name, array('placeholder' => 'Enter name', 'class' => 'form-control')) !!}
                                {!! $errors->first('name', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <button type="submit" class="btn btn-sm btn-success">
                                Update
                            </button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
