@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="stats" initial="stats">

    <style>
        #advancedFilter {
            min-width: 150px;
        }
        #advancedFilter option {
            font-size: 14px;
        }
        .filter-stats .btn.btn-search {
            border: 1px solid #f99110;
            color: #f99110;
            text-align: center;
            text-align: center;
            display: inline-block;
            font-weight: 600;
            font-size: 14px;
            padding: 7px 15px;
            min-width: 100px;
        }
        .filter-stats .btn.btn-search:hover {
            border: 1px solid #f99110;
            color: #f99110;
        }
        .filter-stats .btn.btn-clear {
            text-align: center;
            text-align: center;
            display: inline-block;
            font-weight: 600;
            font-size: 14px;
            padding: 7px 15px;
            width: 80px;
        }
        .btn-print {
            border: 1px solid #f99110;
            color: #f99110;
            text-align: center;
            text-align: center;
            display: inline-block;
            border-radius: 4px;
            font-size: .85rem;
            font-weight: 600;
            padding: 7px 15px;
            min-width: 100px;
        }
        .btn-print:hover {
            border: 1px solid #f99110;
            color: #f99110;
        }
        .section-stats .shot-function img.img-shot {
            height: auto;
        }
        .filter-data span {
            border: 0.3px solid #e4e4e4;
            font-size: 13px;
            border-radius: 4px;
            font-weight: 600;
            padding: 5px 10px;
            display: inline-block;
            margin: 5px;
            min-width: 80px;
            text-align: center;
        }
        @media screen and (max-width: 768px) {
            .filter-stats {
                display: block;
            }
            .filter-stats .form-group {
                margin-bottom: 15px;
                margin-right: 0;
            }
            .filter-stats .btn.btn-search,
            .filter-stats .btn.btn-clear {
                display: block;
                width: 100%;                
            }
            .search-label,
            .clear-label {
                display: none;
            }
        }
    </style>
@endsection

@section('content')

@include('layouts.parts.navbar')
@include('layouts.parts.nav')
@include('layouts.parts.nav-list')

    <section class="py-main section-stats">
      <div class="container container-sm">
        <a href="" class="btn btn-border diff orange mb-3 d-flex d-md-none">Choose Activity</a>
         <div class="switch-wrapper switch-stats center mb-4">
            <span>Shots</span>
            <label class="switch">
            <input type="checkbox" id="switch-target">
            <span class="slider round"></span>
            </label>
            <span>Stats</span>
        </div>
        <div class="box-general mb-3">
            <div class="heading w-link">
                <div class="heading">
                    <h3>Stats Filter</h3>
                </div>
                <div class="dropdown">
                    <button class="btn btn-print dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export All Data
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item" href="#" id="printData">PRINT</a>
                    </div>
                </div>
            </div>
            <div class="filter-stats mt-3">
                <div class="form-group form-group-w-icon">
                    <label for="">Date From - Until</label>
                    <input type="text" class="form-control daterange" placeholder="Select Date">
                    <img src="{{ asset('frontend/img/pinpoint/icon/ic-calendar.svg') }}" class="img-fluid" alt="Icon">
                </div>
                <div class="form-group form-filter">
                    <label for="">Filters</label>
                    <select name="advanced-filter" id="advancedFilter" class="form-control">
                        <option value="team">Team</option>
                        <option value="individual">Individual</option>
                        <option value="5man">5 Man set</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="search-label">&nbsp;</label>
                    <button class="btn btn-warning btn-search" id="advancedFilterSearch">Search</button>
                </div>
                <div class="form-group">
                    <label for="" class="clear-label">&nbsp;</label>
                    <button class="btn btn-warning btn-clear" id="advancedFilterClear">Clear</button>
                </div>
            </div>
        </div>
        <div class="box-general mb-3 d-none" id="filterDataDisplay">
            <div class="heading w-link">
                <div class="heading">
                    <h3>Filter Data</h3>
                </div>
            </div>
            <div class="mt-3 filter-data">
                
            </div>
        </div>
        <div class="box-general stat-box" style="display: none;">
            <div class="heading">
                <h3>Statistics</h3>
            </div>
            <div class="row result-stats-wrapper">
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="fg">0</h4>
                        <p>FG</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="3pt">0</h4>
                        <p>3PT</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="ft">0</h4>
                        <p>FT</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="fg_percent">0</h4>
                        <p>Field Goal (%)</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="3pt_percent">0</h4>
                        <p>Three Point (%)</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="ft_percent">0</h4>
                        <p>Free Throw (%)</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="points">0</h4>
                        <p>Points</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="rebounds">0</h4>
                        <p>Rebounds</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="assissts">0</h4>
                        <p>Assists</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="steals">0</h4>
                        <p>Steals</p>
                    </div>
                </div>
                <div class="col-4 result-s-list">
                    <div class="result-s-content">
                        <h4 id="blocks">0</h4>
                        <p>Blocks</p>
                    </div>
                </div>

                <?php if($stats_dataset == null || $stats_dataset->setting_value == 'all'): ?>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="possession">0</h4>
                            <p>Possession</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="foul">0</h4>
                            <p>Foul</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="loose_ball">0</h4>
                            <p>Loose Ball</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="charge">0</h4>
                            <p>Charge</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="box_out">0</h4>
                            <p>Box Out</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="hockey_assist_extra_pass">0</h4>
                            <p>Hockey Assist Extra Pass</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="pass_leading_to_foul">0</h4>
                            <p>Pass Leading to Foul</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="screen_assist">0</h4>
                            <p>Screen Assist</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="tap_back">0</h4>
                            <p>Tap Back</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="rim_run_sprint_the_floor">0</h4>
                            <p>Rim Run Sprint the Floor</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="off_paint_touch">0</h4>
                            <p>Off Paint Touch</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="deflection">0</h4>
                            <p>Deflection</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="wall_up">0</h4>
                            <p>Wall Up</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="contest_2">0</h4>
                            <p>Contest 2</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="contest_3">0</h4>
                            <p>Contest 3</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="missed_rotation">0</h4>
                            <p>Missed Rotation</p>
                        </div>
                    </div>
                    <div class="col-4 result-s-list">
                        <div class="result-s-content">
                            <h4 id="def_paint_touch">0</h4>
                            <p>Def Paint Touch</p>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="shot-general position-relative">
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
                <input type="number" value="0" class="total-count hidden" id="total-count">
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
                                <button type="button" class="btn btn-border btn-add {{'player-'.$player->player->id}}" data-player="{{$player->player->id}}" data-gpid="{{$player->id}}" >Add to Count</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        var filterPlayers = [];
        //var filterPlayersDisplay = [];
        var filterType = 'team';
        var minDateFilter = null;
        var maxDateFilter = null;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#switch-target').change(function() {
            if ($('#switch-target').is(':checked')) {
                $(".shot-general").hide();
                setTimeout(()=> {
                    $(".stat-box").fadeIn();
                }, 1)
            } else {
                $(".stat-box").hide();
                setTimeout(()=> {
                    $(".shot-general").fadeIn();
                }, 1)
            }
        });

        $(".shot-hover").fadeIn();
        $(".shot-tooltip").fadeIn();
        $(".shot-click").hide();

        // populate data onload
        $(document).ready(function(){
            getStatData("live");
            getShotData("live");
        });

        $('.swith-shot').change(function() {
            if ($('.swith-shot').is(':checked')) {
                getStatData("all");
                getShotData("all");
            } else {
                getStatData("live");
                getShotData("live");
            }
        });

        $('#switch-target').change(function() {
            if ($('#switch-target').is(':checked')) {
                $(".img-shot").hide();
                setTimeout(() => {
                    $(".box-stat").fadeIn();
                }, 1);
            } else {
                $(".box-stat").hide();
                setTimeout(() => {
                    $(".img-shot").fadeIn();
                }, 1);
            }
        });

      $(function() {
        // var table = $("#table-player").DataTable({
        //     "bPaginate": false,
        //     "bLengthChange": false,
        //     "bFilter": true,
        //     "bInfo": false,
        //     "bAutoWidth": false 
        // });

        // Date range vars
        //var minDateFilter = "";
        //var maxDateFilter = "";

        $(".daterange").daterangepicker();
        $('.daterange').val('');
        $('.daterange').attr("placeholder","Select Date");
        $(".daterange").on("apply.daterangepicker", function(ev, picker) {
            // minDateFilter = Date.parse(picker.startDate);
            // maxDateFilter = Date.parse(picker.endDate);

            window.minDateFilter = picker.startDate.format('YYYY-MM-DD');
            window.maxDateFilter = picker.endDate.format('YYYY-MM-DD');

            // $.ajax({
            //     url: "{{route('stats_filter_change')}}",
            //     type: 'POST',
            //     data: {
            //         _token: CSRF_TOKEN,
            //         'min_date': minDateFilter,
            //         'max_date': maxDateFilter
            //     },
            //     dataType: 'JSON',
            //     beforeSend: function() {
            //         $("#ajaxLoader").show();
            //     },
            //     success: function (data) {
            //         if(data.msg == 'success') {
            //             $.each(data.data, function(key, val){
            //                 $('#'+key).text(val);
            //             });
            //         }
            //         for (let i = 0; i < 16; i++) {
            //             var attempted = data.data['attemptedArr'][i];
            //             var made = data.data['madeArr'][i];
            //             var percentage = 0;
            //             $('#section_' + i).find('.shot-number').text(made + '/' + attempted);
            //             if(attempted > 0 && made > 0) {
            //                 percentage = (data.data['madeArr'][i] / data.data['attemptedArr'][i]) * 100;
            //             }                        
            //             $('#section_' + i).find('.shot-percent').text(percentage.toFixed(2) + '%');
            //         }
            //         $("#ajaxLoader").hide();
            //     },
            //     error: function() {
            //         $("#ajaxLoader").hide();
            //         // if(confirm("Something went wrong, Page will reload")){
            //         //     location.reload();
            //         // }
            //         // else{
            //         //     location.reload();
            //         // }
            //         return false;
            //     }
            // });
            
            // $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            // var date = Date.parse(data[2]);

            // if (
            // (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
            // (isNaN(minDateFilter) && date <= maxDateFilter) ||
            // (minDateFilter <= date && isNaN(maxDateFilter)) ||
            // (minDateFilter <= date && date <= maxDateFilter)
            // ) {
            // return true;
            // }
            // return false;
        // });
        //table.draw();
        });
      });

      /**
       * get stat data
       */
      function getStatData(type)
      {
        var url = '{{route("stats_live_data")}}';
        if(type == "all") {
            url = '{{route("stats_all_data")}}';
        }

        $.ajax({
            url: url,
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
                    $.each(data.data, function(key, val){
                        $('#'+key).text(val);
                    });
                }
                $("#ajaxLoader").hide();
            },
            error: function() {
                $("#ajaxLoader").hide();
                // if(confirm("Something went wrong, Page will reload")){
                //     location.reload();
                // }
                // else{
                //     location.reload();
                // }
                return false;
            }
        });
      }

      /**
       * get shot data
       */
      function getShotData(type)
      {
        var url = '{{route("shot_live_data")}}';
        if(type == "all") {
            url = '{{route("shot_all_data")}}';
        }

        $.ajax({
            url: url,
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
                            if(data.data[1][i] == 0 && data.data[0][i] == 0) {
                                $('#section_' + i).find('img.shot-hover').remove();
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
                            if(data.data[1][i] == 0 && data.data[0][i] == 0) {
                                $('#section_' + i).find('img.shot-hover').remove();
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
                            if(data.data[1][i] == 0 && data.data[0][i] == 0) {
                                $('#section_' + i).find('img.shot-hover').remove();
                            }
                        }
                    }
                }
                $("#ajaxLoader").hide();
            },
            error: function() {
                $("#ajaxLoader").hide();
                // if(confirm("Something went wrong, Page will reload")){
                //     location.reload();
                // }
                // else{
                //     location.reload();
                // }
                return false;
            }
        });
      }

    $('#printData').click(function(){
        window.print();
    });

    /**
     * Advanced search
     */
    $('#advancedFilterSearch').click(function(){
        // Date range vars
        var selectedMinDate = window.minDateFilter;
        var selectedMaxDate = window.maxDateFilter;
        var selectedPlayers = window.filterPlayers;
        var selectedFilterType = window.filterType;

        $.ajax({
            url: "{{route('stats_advanced_search')}}",
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                'min_date': selectedMinDate,
                'max_date': selectedMaxDate,
                'filter_type': selectedFilterType,
                'game_players': selectedPlayers
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#ajaxLoader").show();
            },
            success: function (data) {
                if(data.msg == 'success') {
                    $.each(data.data, function(key, val){
                        $('#'+key).text(val);
                    });
                }
                for (let i = 0; i < 16; i++) {
                    var attempted = data.data['attemptedArr'][i];
                    var made = data.data['madeArr'][i];
                    var percentage = 0;
                    $('#section_' + i).find('.shot-number').text(made + '/' + attempted);
                    if(attempted > 0 && made > 0) {
                        percentage = (data.data['madeArr'][i] / data.data['attemptedArr'][i]) * 100;
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
                        if(data.data['madeArr'][i] == 0 && data.data['attemptedArr'][i] == 0) {
                            $('#section_' + i).find('img.shot-hover').remove();
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
                        if(data.data['madeArr'][i] == 0 && data.data['attemptedArr'][i] == 0) {
                            $('#section_' + i).find('img.shot-hover').remove();
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
                        if(data.data['madeArr'][i] == 0 && data.data['attemptedArr'][i] == 0) {
                            $('#section_' + i).find('img.shot-hover').remove();
                        }
                    }
                }
                $("#ajaxLoader").hide();
            },
            error: function() {
                $("#ajaxLoader").hide();
                if(confirm("Something went wrong, Page will reload")){
                    location.reload();
                }
                else{
                    location.reload();
                }
                return false;
            }
        });
    });

    /**
     * Filter clear
     */
    $('#advancedFilterClear').click(function(){
        location.reload();
    });

    $('#advancedFilter').change(function(){
        window.filterType = $(this).val();
        window.filterPlayers = [];
        $('#filterDataDisplay').addClass('d-none');
        $('.filter-data').html('');
        $(".btn-border").prop('disabled', false).removeClass('btn-remove').html("Add to Court");
        if($(this).val() != 'team') {
            $('#modalPlayer').modal('show');
        }
    });
    

    $(".btn-add").click(function() {
        window.filterPlayers.push($(this).data('gpid'));
        // Update interface
        $(this).toggleClass("btn-remove");
        if ($(this).hasClass("btn-remove")) {
            $(this).html("Remove from Court");
            //$("#total-count").val(+$("#total-count").val()+1);
        } else {
            $(this).html("Add to Court");            
            //$("#total-count").val(+$("#total-count").val()-1);
        }

        $('.filter-data').append('<span>'+$(this).closest('.player-name').find('h5').text()+'</span>');

        if(window.filterType == 'individual') {
            if(window.filterPlayers.length == 1) {
                $(".btn-border").prop('disabled', true);
                $(".btn-remove").prop('disabled', false);            
                $(".player-wrapper").removeClass("hidden");
                $(".btn-change-player").removeClass("hidden");
                $(".not-selected").addClass("hidden");

                // Hide modal
                $('#modalPlayer').modal('hide');

                $('#filterDataDisplay').removeClass('d-none');

            } else {
                $(".btn-border").prop('disabled', false);
                $('#modalPlayer').modal();
            }
        }
        if(window.filterType == '5man') {
            if(window.filterPlayers.length == 5) {
                $(".btn-border").prop('disabled', true);
                $(".btn-remove").prop('disabled', false);            
                $(".player-wrapper").removeClass("hidden");
                $(".btn-change-player").removeClass("hidden");
                $(".not-selected").addClass("hidden");

                // Hide modal
                $('#modalPlayer').modal('hide');

                $('#filterDataDisplay').removeClass('d-none');

            } else {
                $(".btn-border").prop('disabled', false);
                $('#modalPlayer').modal();
            }
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
</script>
@endsection