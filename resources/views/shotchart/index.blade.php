@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="shot" initial="shot">
    <style>
        .switch-wrapper.switch-stats.right {
            visibility: hidden;
        }
        .player-stats .btn-primary {
            margin-top: 20px;
        }
        @media (min-width: 768px) {
            .player-stats .btn-primary {
                margin-top: 20px;
            }
        }
    </style>
@endsection

@section('content')

@include('layouts.parts.navbar')
@include('layouts.parts.nav')
@include('layouts.parts.nav-list')

<section class="py-main">
    <div class="container-fluid">
    <!-- <a href="" class="btn btn-border diff orange mb-3 d-flex d-md-none">Choose Activity</a> -->
        <div class="row">
            <div class="col-md-5">
                <div class="box-general shadow box-diff">
                    <div class="heading w-link">
                        <h3>On the Court</h3>
                        <button class="btn btn-primary btn-change-player hidden" data-toggle="modal" data-target="#modalPlayer" data-backdrop="static" data-keyboard="false">Change Player</button>
                    </div>

                    <div class="not-selected">
                        <p>{{$selectedPlayers->count() <= 0 ? 'No selected players at court' : ''}}</p>
                        <button class="btn btn-primary w-100 btn-select-player" data-toggle="modal" data-target="#modalPlayer" data-backdrop="static" data-keyboard="false">Select Players</button>
                    </div>

                    <div class="player-wrapper {{$selectedPlayers->count() > 0 ? '' : 'hidden'}}">
                        @foreach($selectedPlayers as $selectedPlayer)
                            <div class="player-list player-list-click" data-gpid="{{$selectedPlayer->id}}">
                                <img src="{{ asset('frontend/img/pinpoint/graphic/player.svg') }}" class="img-fluid" alt="Player">
                                <div class="player-name">
                                    <h5>{{$selectedPlayer->player->name}}</h5>
                                    <p>{{$selectedPlayer->player->tagline}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="col-md-7">
                <div class="shot-function">

                    <img src="{{ asset('frontend/img/pinpoint/shot/new-court.png') }}" class="img-fluid img-shot" alt="Lapang">

                    <div class="shot-detail top-mid-left" id="section_14" data-section="14">
                        <img src="{{ asset('frontend/img/pinpoint/shot/14/14-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/14/14-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-mid-right" id="section_15" data-section="15">
                        <img src="{{ asset('frontend/img/pinpoint/shot/15/15-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/15/15-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-mid" id="section_12" data-section="12">
                        <img src="{{ asset('frontend/img/pinpoint/shot/12/12-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/12/12-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-mid-2" id="section_8" data-section="8">
                        <img src="{{ asset('frontend/img/pinpoint/shot/8/8-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/8/8-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail bottom-mid" id="section_3" data-section="3">
                        <img src="{{ asset('frontend/img/pinpoint/shot/3/3-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/3/3-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-right-1" id="section_13" data-section="13">
                        <img src="{{ asset('frontend/img/pinpoint/shot/13/13-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/13/13-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-right-2" id="section_10" data-section="10">
                        <img src="{{ asset('frontend/img/pinpoint/shot/10/10-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/10/10-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-right-3" id="section_5" data-section="5">
                        <img src="{{ asset('frontend/img/pinpoint/shot/5/5-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/5/5-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-left-1" id="section_11" data-section="11">
                        <img src="{{ asset('frontend/img/pinpoint/shot/11/11-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/11/11-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-left-2" id="section_6" data-section="6">
                        <img src="{{ asset('frontend/img/pinpoint/shot/6/6-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/6/6-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail top-left-3" id="section_1" data-section="1">
                        <img src="{{ asset('frontend/img/pinpoint/shot/1/1-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/1/1-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail mid-right-1" id="section_9" data-section="9">
                        <img src="{{ asset('frontend/img/pinpoint/shot/9/9-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/9/9-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail mid-left-1" id="section_7" data-section="7">
                        <img src="{{ asset('frontend/img/pinpoint/shot/7/7-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/7/7-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail bottom-right" id="section_4" data-section="4">
                        <img src="{{ asset('frontend/img/pinpoint/shot/4/4-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/4/4-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="shot-detail bottom-left" id="section_2" data-section="2">
                        <img src="{{ asset('frontend/img/pinpoint/shot/2/2-click.png') }}" class="img-fluid shot-click" alt="Graphic">
                        <img src="{{ asset('frontend/img/pinpoint/shot/2/2-click.png') }}" class="img-fluid shot-hover" alt="Graphic">
                        <div class="shot-tooltip">
                            <div class="shot-angka">
                            <p class="shot-number">0/0</p>
                            <p class="shot-percent">0%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="box-general box-stat shadow box-diff" style="display: none">
                    <div class="heading">
                    <h3 class="mb-3">Stat Tracker</h3>
                    </div>
                    <div class="form-group form-add">
                    <p class="label">Point</p>
                    <div class="qty-wrapper">
                        <input type="button" value="-" class="qty-general qty-minus">
                        <input type="number" value="0" class="qty">
                        <input type="button" value="+" class="qty-general qty-plus">
                    </div>
                    </div>
                    <div class="form-group form-add">
                    <p class="label">Rebounds</p>
                    <div class="qty-wrapper">
                        <input type="button" value="-" class="qty-general qty-minus">
                        <input type="number" value="0" class="qty">
                        <input type="button" value="+" class="qty-general qty-plus">
                    </div>
                    </div>
                    <div class="form-group form-add">
                    <p class="label">Assissts</p>
                    <div class="qty-wrapper">
                        <input type="button" value="-" class="qty-general qty-minus">
                        <input type="number" value="0" class="qty">
                        <input type="button" value="+" class="qty-general qty-plus">
                    </div>
                    </div>
                    <div class="form-group form-add">
                    <p class="label">Steals</p>
                    <div class="qty-wrapper">
                        <input type="button" value="-" class="qty-general qty-minus">
                        <input type="number" value="0" class="qty">
                        <input type="button" value="+" class="qty-general qty-plus">
                    </div>
                    </div>
                    <div class="form-group form-add">
                    <p class="label">Blocks</p>
                    <div class="qty-wrapper">
                        <input type="button" value="-" class="qty-general qty-minus">
                        <input type="number" value="0" class="qty">
                        <input type="button" value="+" class="qty-general qty-plus">
                    </div>
                    </div>
                </div>
                -->
                <div class="switch-wrapper switch-stats right">
                    <span>Shots</span>
                    <label class="switch">
                    <input type="checkbox" id="switch-target">
                    <span class="slider round"></span>
                    </label>
                    <span>Stats</span>
                </div>
            </div>

            <div class="col-md-12 mt-4 player-stats hidden">
                <div class="box-general">
                    <div class="player-detail">
                        <div class="player-d-content">
                            <div class="player-list">
                                <img src="{{ asset('frontend/img/pinpoint/graphic/player.svg') }}" class="img-fluid" alt="Player">
                                <div class="player-name">
                                    <h5 class="activePlayerName">John Smith</h5>
                                    <p class="activePlayerTagline">Shooting Guard (SG)</p>
                                </div>
                            </div>
                            <!-- <div class="player-edit">
                                <img src="{{ asset('frontend/img/pinpoint/icon/ic-edit.svg') }}" class="img-fluid" alt="Icon">
                            </div> -->
                        </div>
                    <div>
                        <!-- <a href="" class="btn btn-icon">Next Players</a> -->
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="heading my-3">
                        <h3 class="">Shots Attempt</h3>
                    </div>
                    <!-- <div class="form-group form-add">
                        <p class="label">Attempted</p>
                        <div class="qty-wrapper">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="1" class="qty" id="attempted">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div> -->
                    <!-- <div class="form-group form-add">
                        <p class="label">Made</p>
                        <div class="qty-wrapper">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="1" class="qty" id="made">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div> -->

                    <div class="player-wrapper">
                        <div class="player-list btn-made-click" data-type="fg" data-made="1">
                            <div class="player-name">
                                <h5>FG Made</h5>
                            </div>
                        </div>
                        <div class="player-list btn-made-click" data-type="fg" data-made="0">
                            <div class="player-name">
                                <h5>FG Missed</h5>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="form-group form-add">
                        <p class="label">Points</p>
                        <div class="qty-wrapper">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="1" class="qty" id="points">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div> -->
                    <div class="percentage">
                        <!-- <p>Percentage</p>
                        <p class="number"><span>0</span>%</p> -->
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="heading my-3">
                        <h3 class="">Free Throws</h3>
                    </div>
                    <div class="player-wrapper">
                        <div class="player-list btn-made-click" data-type="ft" data-made="1">
                            <div class="player-name">
                                <h5>FT Made</h5>
                            </div>
                        </div>
                        <div class="player-list btn-made-click" data-type="ft" data-made="0">
                            <div class="player-name">
                                <h5>FT Missed</h5>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="mt-4 mt-md-0 form-group form-radio">
                            <p class="label">Dribbles</p>
                            <div class="radio-wrapper">
                                <div class="radio-list">
                                  <input type="radio" id="0" name="dribbles" value="0">
                                    <label for="0">0</label>
                                </div>
                                <div class="radio-list">
                                  <input type="radio" id="1" name="dribbles" value="1">
                                  <label for="1">1</label>
                                </div>
                                <div class="radio-list">
                                  <input type="radio" id="2" name="dribbles" value="2">
                                  <label for="2">2</label>
                                </div>
                                <div class="radio-list">
                                  <input type="radio" id="2+" name="dribbles" value="3">
                                  <label for="2+">2+</label>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <p class="label" for="#shotClock">Shot Clock</p>
                            <select class="form-control" id="shotClock">
                                <option>0-5</option>
                                <option>5-10</option>
                                <option>10-15</option>
                                <option>15-20</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <p class="label" for="#play">Play</p>
                            <select class="form-control" id="play">
                                @foreach($playList as $play)
                                    <option value="{{$play->name}}">{{$play->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" id="submitShot">Submit</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-12 mt-4 player-stats undo-btn-wrap {{$recordCount > 0 ? '' : 'd-none'}}">
        <div class="box-general">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-danger float-right" id="undoLastRec">Delete My Last Record</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
</section>

    <div class="modal fade bd-example-modal-lg" id="modalPlayer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="heading w-link">
                    <h3>Full Roster</h3>
                    <div class="form-group w-icon">
                        <input type="text" class="form-control" id="search-player" placeholder="Find player">
                        <img src="{{ asset('frontend/img/pinpoint/icon/ic-search.svg') }}" class="img-fluid" alt="Icon">
                    </div>
                </div>
                <div class="player-avail">
                    <p><span id="available-player"></span> available players <span class="dots"></span> 5 selected players on the court</p>
                </div>
                <input type="number" value="{{$selectedPlayers->count()}}" class="total-count hidden" id="total-count">
                <div class="row rooster">

                    @foreach($players as $player)
                        <div class="col-md-6 rooster-list">
                            <div class="player-list">
                            <img src="{{ asset('frontend/img/pinpoint/graphic/player.svg') }}" class="img-fluid" alt="Player">
                            <div class="player-name">
                                <div>
                                <h5>{{$player->player->name}}</h5>
                                <p>{{$player->player->tagline}}</p>
                                </div>
                                <button type="button" class="btn btn-border btn-add {{auth()->user()->id == $player->assigned_user ? 'btn-remove' : ''}}" data-gpid="{{$player->id}}" >{{auth()->user()->id == $player->assigned_user ? 'Remove from Court' : 'Add to Count'}}</button>
                            </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    @endsection

@section('footer_extra')
<script>
    var section = null;
    var dribbles = 0;
    var gpid = null;
    var attempt_type = null;
    var made = 0;
    var activeGameId = '{{$game->id}}';

    $('#myModal').modal({backdrop: 'static', keyboard: false})  

    $(".shot-hover").hide();
    $(".shot-tooltip").hide();
    $(".shot-click").hide();

    // shotchart section click set section number to window variable
    $(".shot-detail").click(function() {
        $(".shot-click").hide();
        setTimeout(() => {
            $(this).find(".shot-click").fadeIn();
        }, 1);

        window.section = $(this).data('section');
    });

    // dribbles on click set the value to window variable
    $('.radio-list').click(function(){
        window.dribbles = $(this).find('input').val();
    });

    $('.swith-shot').change(function() {
        if ($('.swith-shot').is(':checked')) {
            $(".shot-click").hide();

            updateAnalyticsDisplay();

            setTimeout(() => {
                $(".shot-hover").fadeIn();
                $(".shot-tooltip").fadeIn();
            }, 1);
        } else {
            $(".shot-tooltip").hide();
            $(".shot-hover").hide();
        }
    });

    $(".player-list-click").click(function() {
        $(".player-list-click").removeClass("active");
        $(this).addClass("active");
        $(".player-stats").removeClass("hidden");

        // Update active user display
        $('.activePlayerName').text($(this).find('h5').text());
        $('.activePlayerTagline').text($(this).find('p').text());

        window.gpid = $(this).data('gpid');
    });

    $(".btn-made-click").click(function() {
        $(".btn-made-click").removeClass("active");
        $(this).addClass("active");

        window.attempt_type = $(this).data('type');
        window.made = $(this).data('made');
    });

    /**
     * Assign players to user
     */
    $(".btn-add").click(function() {
        // Update interface
        $(this).toggleClass("btn-remove");
        if ($(this).hasClass("btn-remove")) {
            $(this).html("Remove from Court");
            $(".total-count").val(+$(".total-count").val()+1);
            // Update database
            updateAssignedUser($(this).data('gpid'), 'add');
        } else {
            $(this).html("Add to Court");
            $(".total-count").val(+$(".total-count").val()-1);
            // Update database
            updateAssignedUser($(this).data('gpid'), 'remove');
        }
        if($(".total-count").val() > 4) {
            $(".btn-border").prop('disabled', true);
            $(".btn-remove").prop('disabled', false);            
            $(".player-wrapper").removeClass("hidden");
            $(".btn-change-player").removeClass("hidden");
            $(".not-selected").addClass("hidden");

            // Hide modal
            setTimeout(function() {
                $('#modalPlayer').modal('hide');
            }, 1000);

            // Reload page
            setTimeout(function() {                
                location.reload();
            }, 1500);

        } else {
            $(".btn-border").prop('disabled', false);
            $('#modalPlayer').modal();
        }
    });

    $(document).ready(function(){
        $("#search-player").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".rooster .rooster-list").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $("#available-player").html($(".rooster-list").length)

    $('#modalPlayer').on('show.bs.modal', function (e) {
        $(".player-list-click").removeClass("active");
    })

    $('#switch-target').change(function() {
        if ($('#switch-target').is(':checked')) {
            $(".shot-function").hide();
            setTimeout(() => {
            $(".box-stat").fadeIn();
            }, 1);
        } else {
            $(".box-stat").hide();
            setTimeout(() => {
            $(".shot-function").fadeIn();
            }, 1);
        }
    });

    $(document).on('click', '.qty-plus', function () {
        var stat_id = $(this).closest('.qty-wrapper').data('stat_id');
        var stat_name = $(this).closest('.qty-wrapper').data('stat_name');
        var newVal = $(this).prev().val(+$(this).prev().val() + 1);
    });
    $(document).on('click', '.qty-minus', function () {
        if ($(this).next().val() > 0) {
            var stat_id = $(this).closest('.qty-wrapper').data('stat_id');
            var stat_name = $(this).closest('.qty-wrapper').data('stat_name');
            var newVal = $(this).next().val(+$(this).next().val() - 1);
        }
    });

    /**
     * Update assigned user
     */
    function updateAssignedUser(gpid, action)
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        return $.ajax({
            url: '{{route("update_assigned_user")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                gpid: gpid,
                action: action
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

    $('#submitShot').click(function(){
        var gpid = window.gpid;
        var chartSection = window.section;
        //var dribblesValue = window.dribbles;
        //var attempted = $('#attempted').val();
        //var made = $('#made').val();
        //var points = $('#points').val();
        //var shotClock = $('#shotClock').val();
        //var play = $('#play').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var newAttemptType = window.attempt_type;
        var newMade = window.made;

        // if(made > attempted || attempted == 0) {
        //     alert('Numner of attempts should be equel or greater than number of mades');
        // } else {
        //     $.ajax({
        //         url: '{{route("record_shot")}}',
        //         type: 'POST',
        //         data: {
        //             _token: CSRF_TOKEN,
        //             gpid: gpid,
        //             chartsection: chartSection,
        //             //dribbles: dribblesValue,
        //             //attempted: attempted,
        //             made: made,
        //             //points: points,
        //             //shotclock: shotClock,
        //             //play: play
        //         },
        //         dataType: 'JSON',
        //         beforeSend: function() {
        //             $("#ajaxLoader").show();
        //         },
        //         success: function (data) {
        //             if(data.msg == 'success') {
        //                 $('#alertSuccessMsg').text(data.data);
        //                 $('#alertSuccess').show();
        //                 setTimeout(() => {
        //                     $("#alertSuccess").hide();
        //                 }, 2000);
        //             }
        //             if(data.msg == 'error') {
        //                 $('#alertDangerMsg').text(data.data);
        //                 $('#alertDanger').show();
        //                 setTimeout(() => {
        //                     $("#alertDanger").hide();
        //                 }, 2000);
        //             }

        //             $("#ajaxLoader").hide();
        //         },
        //         error: function() {
        //             $("#ajaxLoader").hide();
        //             if(confirm("Something went wrong, Page will reload now")){
        //                 location.reload();
        //             }
        //             else{
        //                 location.reload();
        //             }
        //             return false;
        //         }
        //     });
        // }

        $.ajax({
            url: '{{route("record_shot")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                gpid: gpid,
                chartsection: chartSection,
                //dribbles: dribblesValue,
                //attempted: attempted,
                attempt_type: newAttemptType,
                made: newMade,
                //points: points,
                //shotclock: shotClock,
                //play: play
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#ajaxLoader").show();
            },
            success: function (data) {
                if(data.msg == 'success') {
                    $('#alertSuccessMsg').text(data.data);
                    $('#alertSuccess').show();
                    setTimeout(() => {
                        $("#alertSuccess").hide();
                    }, 2000);

                    if(data.recordCount > 0) {
                        $('.undo-btn-wrap').removeClass('d-none');
                    } else {
                        $('.undo-btn-wrap').addClass('d-none');
                    }

                    location.reload();
                }
                if(data.msg == 'error') {
                    $('#alertDangerMsg').text(data.data);
                    $('#alertDanger').show();
                    setTimeout(() => {
                        $("#alertDanger").hide();
                    }, 2000);
                }

                $("#ajaxLoader").hide();
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

    $("#undoLastRec").click(function(){        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var activeGameId = window.activeGameId;

        if(confirm("Are you sure you want to delete your last record?")){
            $.ajax({
                url: '{{route("undo_record_shot")}}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    activeGameId: activeGameId,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $("#ajaxLoader").show();
                },
                success: function (data) {
                    if(data.msg == 'success') {
                        $('#alertSuccessMsg').text(data.data);
                        $('#alertSuccess').show();
                        setTimeout(() => {
                            $("#alertSuccess").hide();
                        }, 2000);

                        if(data.recordCount > 0) {
                            $('.undo-btn-wrap').removeClass('d-none');
                        } else {
                            $('.undo-btn-wrap').addClass('d-none');
                        }
                    }
                    if(data.msg == 'error') {
                        $('#alertDangerMsg').text(data.data);
                        $('#alertDanger').show();
                        setTimeout(() => {
                            $("#alertDanger").hide();
                        }, 2000);
                    }

                    $("#ajaxLoader").hide();
                },
                error: function() {
                    $("#ajaxLoader").hide();
                    $('#alertDangerMsg').text("Something went wrong!");
                    $('#alertDanger').show();
                    setTimeout(() => {
                        $("#alertDanger").hide();
                    }, 2000);
                    return false;
                }
            });
        }
    });

    function updateAnalyticsDisplay()
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');        
        $.ajax({
            url: '{{route("get_shot_analytics")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#ajaxLoader").show();
            },
            success: function (data) {
                if(data.msg == 'success') {
                    for (let i = 0; i < 16; i++) {
                        var attempted = data.data[0][i];
                        var made = data.data[1][i];
                        var percentage = 0;
                        $('#section_' + i).find('.shot-number').text(made + '/' + attempted);
                        if(attempted > 0 && made > 0) {
                            percentage = (data.data[1][i] / data.data[0][i]) * 100;
                        }                        
                        $('#section_' + i).find('.shot-percent').text(percentage.toFixed(2) + '%');

                        //set area image color
                        //3PT
                        if(i == 1 || i == 2 || i == 3 || i == 4 || i == 5) {
                            if(percentage < 25 ) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-red.png");
                            }
                            if(percentage >= 25 && percentage < 40) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-yellow.png");
                            }
                            if(percentage >= 40) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-green.png");
                            }
                        }
                        //2PT
                        if(i == 6 || i == 7 || i == 8 || i == 9 || i == 10 || i == 11 || i == 12 || i == 13) {
                            if(percentage < 30 ) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-red.png");
                            }
                            if(percentage >= 30 && percentage < 50) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-yellow.png");
                            }
                            if(percentage >= 50) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-green.png");
                            }
                        }
                        //circle right around the rim
                        if(i == 14 || i == 15) {
                            if(percentage < 40) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-red.png");
                            }
                            if(percentage >= 40 && percentage < 60) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-yellow.png");
                            }
                            if(percentage >= 60) {
                                $('#section_' + i).find('img.shot-hover').attr("src", "{{url('/')}}" + "/frontend/img/pinpoint/shot/"+i+"/"+i+"-green.png");
                            }
                        }
                    }
                }
                $("#ajaxLoader").hide();
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
</script>
@endsection