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
                <h1>Add User</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3><a href="{{route('users.index')}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Users</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-box p-4">
                            {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Name</label>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                {!! $errors->first('name', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Email</label>
                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                {!! $errors->first('email', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Password</label>
                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                {!! $errors->first('password', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Confirm Password</label>
                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                {!! $errors->first('confirm-password', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group sidebar-form my-3">
                                <label for="title" class="text-sm">Roles</label>
                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                {!! $errors->first('roles', '<small id="titleHelp" class="form-text text-danger">:message</small>') !!}
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
