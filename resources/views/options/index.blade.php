@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="options" initial="options">
    <style>
        .switch-wrapper.switch-stats.practice-swtich {
            margin-top: 0 !important;
        }
    </style>
@endsection

@section('content')

@include('layouts.parts.nav-2')
@include('layouts.parts.navbar')

    <div class="py-main">
        <div class="container container-sm">
            <div class="heading my-3 my-lg-4">
                <h1>Options</h1>
            </div>

            <div class="box-general diff-so shadow">
                <div class="heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="d-inline">Session Details</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="switch-wrapper switch-stats practice-swtich">
                                <span>Game</span>
                                <label class="switch">
                                <input type="checkbox" id="switch-practice" {{$session && $session->setting_value == 'practice' ? 'checked' : ''}}>
                                <span class="slider round"></span>
                                </label>
                                <span>Practice</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('options_game')}}" class="list-setting diff-op {{!$session || $session->setting_value == 'game' ? '' : 'd-none'}}" id="gameSettings">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Game</h4>
                            <p>Game settings</p>
                        </div>
                    </div>
                    <img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon">
                </a>
                <a href="{{route('options_practice')}}" class="list-setting diff-op {{$session && $session->setting_value == 'practice' ? '' : 'd-none'}}" id="practiceSettings">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Practice</h4>
                            <p>Practice settings</p>
                        </div>
                    </div>
                    <img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon">
                </a>
                <!-- 
                <a href="/scouting" class="list-setting diff-op">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Scouting</h4>
                            <p>In a turpis sed risus convallis aliquam.</p>
                        </div>
                    </div>
                    <img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon">
                </a> -->
            </div>

            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3>Other Details</h3>
                </div>
                <a href="{{route('options_teams')}}" class="list-setting diff-op">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Teams</h4>
                            <p>Team and player details</p>
                        </div>
                    </div>
                    <img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon">
                </a>
                <a href="{{route('options_play_list')}}" class="list-setting diff-op">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Play List</h4>
                            <p>Play name list for shot chart</p>
                        </div>
                    </div>
                    <img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon">
                </a>
                <!-- <a href="{{route('options_play_list')}}" class="list-setting diff-op">
                    <div class="row">
                        <div class="col-7">
                            <div class="list-left">
                                <div class="heading">
                                    <h4>Display Dataset</h4>
                                    <p>Primary will display the minimum amount of data on roster</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="switch-wrapper switch-stats practice-swtich">
                                <span>Game</span>
                                <label class="switch">
                                <input type="checkbox" id="switch-practice" {{$session && $session->setting_value == 'practice' ? 'checked' : ''}}>
                                <span class="slider round"></span>
                                </label>
                                <span>Practice</span>
                            </div>
                        </div>
                    </div>
                </a> -->
                <a href="javascript:void(0);" class="list-setting diff-op">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="list-left">
                                <div class="heading">
                                    <h4>Display Dataset</h4>
                                    <p>Primary will display the minimum amount of data on stats page</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="switch-wrapper switch-stats practice-swtich">
                                <span>All</span>
                                <label class="switch">
                                <input type="checkbox" id="switch-dataset" {{$stats_dataset && $stats_dataset->setting_value == 'primary' ? 'checked' : ''}}>
                                <span class="slider round"></span>
                                </label>
                                <span>Primary</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection

@section('footer_extra')
    <script>
        $('#switch-practice').change(function() {
            if ($('#switch-practice').is(':checked')) {
                changeSession('practice');
                $('#practiceSettings').removeClass('d-none');
                $('#gameSettings').addClass('d-none');
            } else {
                changeSession('game');
                $('#practiceSettings').addClass('d-none');
                $('#gameSettings').removeClass('d-none');
            }
        });

        /**
         * set session
         * practice / game
         */
        function changeSession(session)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            return $.ajax({
                url: '{{route("options_set_session")}}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    session: session
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $("#ajaxLoader").show();
                },
                success: function (data) {
                    $("#ajaxLoader").hide();
                    return true;
                },
                error: function() {
                    $("#ajaxLoader").hide();
                    if(confirm("Something went wrong, Page will reload now")){
                        location.reload();
                    }
                    else{
                        location.reload();
                    }
                    return false;
                }
            });
        }

        /**
         * Dataset change
         */
        $('#switch-dataset').change(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var dataset = 'all';
            if ($('#switch-dataset').is(':checked')) {
                dataset = 'primary';
            }
            return $.ajax({
                url: '{{route("options_set_dataset")}}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    stats_dataset: dataset
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $("#ajaxLoader").show();
                },
                success: function (data) {
                    $("#ajaxLoader").hide();
                    return true;
                },
                error: function() {
                    $("#ajaxLoader").hide();
                    if(confirm("Something went wrong, Page will reload now")){
                        location.reload();
                    }
                    else{
                        location.reload();
                    }
                    return false;
                }
            });
        });
    </script>
@endsection
