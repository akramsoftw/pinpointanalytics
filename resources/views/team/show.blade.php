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
                <h1>Team Details</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <div class="row">
                        <div class="col-6">
                            <h3><a href="{{route('options_teams')}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Teams</h3>
                        </div>
                        <div class="col-6">
                            <a href="{{route('player_create', $team->id)}}" class="btn btn-sm btn-success float-right">Add Player</a>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box p-4">
                            <p><strong>Team: {{$team->name}}</strong></p>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-option">
                                    <thead>
                                        <tr>
                                            <th scope="col">Player #</th>
                                            <th scope="col">Player Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teamPlayer as $player)
                                            <tr>
                                                <td>{{ $player->player->number }}</td>
                                                <td>{{ $player->player->name }}</td>
                                                <td>{{ $player->player->position }}</td>
                                                <td>
                                                    <a href="{{route('player_edit', $player->player->id)}}" class="btn btn-sm btn-warning btn-action">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
