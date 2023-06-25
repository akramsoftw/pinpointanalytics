@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="game" initial="game">

    <style>
      .form-add .qty-wrapper .qty {
          display: flex;
          min-width: 30px;
          -webkit-box-pack: center;
          justify-content: center;
      }
      .nav-tabs {
          border-bottom: 0;
      }
      .btn-tab {
          border: 1px solid #f99110;
          color: #f99110;
          text-align: center;
          text-align: center;
          display: inline-block;
          font-weight: 600;
          font-size: 14px;
          padding: 7px 15px;
          min-width: 100px;
          margin: 5px 15px;
      }
      table.table-player {
          width: 100%;
      }

      /* thead tr td {
          text-align: center;
      } */
      #rosterTable {
        width: 100%;
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
      @media print {
        .no-print {
            display:none;
        }
      }
    </style>
@endsection

@section('content')

@include('layouts.parts.navbar')
@include('layouts.parts.nav')
@include('layouts.parts.nav-list')

  <section class="py-main section-stats">
    <div class="container-fluid">

      <a href="" class="btn btn-border diff orange mb-3 d-flex d-md-none">Choose Activity</a>
      <div class="btn-tab-section my-4 no-print">
          <ul class="nav justify-content-center nav-tabs">
              <li class="active"><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab1">Stats - Primary</a></li>
              <li><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab2">Stats - Other</a></li>
              <li><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab3">Stats - Supplementary Offense</a></li>
              <li><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab4">Stats - Supplementary Defense</a></li>
          </ul>
      </div>
      <div class="box-general box-diff-2 no-print">
        <div class="heading w-link">
          <h3>Filters</h3>
          <div class="dropdown">
            <button class="btn btn-border dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Export All Data
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">PDF</a>
              <a class="dropdown-item" href="#" id="printTable">PRINT</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="filter-stats diff">
              <div class="form-group form-group-w-icon">
                <label for="">Date From - Until</label>
                <input type="text" class="form-control" placeholder="Select Date" id="daterange">
                <img src="{{ asset('frontend/img/pinpoint/icon/ic-calendar.svg') }}" class="img-fluid" alt="Icon">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="filter-stats diff">
              <div class="form-group form-group-w-icon">
                <label for="">Game</label>
                <select name="game" id="gameFilter" class="form-control" placeholder="Select Game">
                  <option value="">Select game</option>
                  @foreach($game_list as $game)
                    <option value="{{$game->id}}">{{$game->get_home_team->name}} vs {{$game->get_opponent_team->name}} on {{ \Carbon\Carbon::parse($game->game_time)->format('l, F d') }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-content">
          <div id="tab1" class="tab-pane fade in active show">
              @include('roster.tab1')
          </div>
          <div id="tab2" class="tab-pane fade">
              @include('roster.tab2')
          </div>
          <div id="tab3" class="tab-pane fade">
              @include('roster.tab3')
          </div>
          <div id="tab4" class="tab-pane fade">
              @include('roster.tab4')
          </div>
      </div>

    </div>
  </section>
@endsection

@section('footer_extra')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
      $(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var table1 = $("#table1").DataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bInfo": false,
          "bAutoWidth": false,
          "searching": false,
          "autoWidth": false,
          scrollY:        true,
          scrollX:        true,
          scrollCollapse: true,
          paging:         false
        });
        var table2 = $("#table2").DataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bInfo": false,
          "bAutoWidth": false,
          "searching": false,
          "autoWidth": false,
          scrollY:        true,
          scrollX:        true,
          scrollCollapse: true,
          paging:         false
        });
        var table3 = $("#table3").DataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bInfo": false,
          "bAutoWidth": false,
          "searching": false,
          "autoWidth": false,
          scrollY:        true,
          scrollX:        true,
          scrollCollapse: true,
          paging:         false
        });
        var table4 = $("#table4").DataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bInfo": false,
          "bAutoWidth": false,
          "searching": false,
          "autoWidth": false,
          scrollY:        true,
          scrollX:        true,
          scrollCollapse: true,
          paging:         false
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
        $(window).resize( function() {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });

        // Date range vars
        minDateFilter = "";
        maxDateFilter = "";

      $("#daterange").daterangepicker();
      $('#daterange').val('');
      $('#daterange').attr("placeholder","Select Date");
      $("#daterange").on("apply.daterangepicker", function(ev, picker) {
        minDateFilter = picker.startDate.format('YYYY-MM-DD');
        maxDateFilter = picker.endDate.format('YYYY-MM-DD');

        $.ajax({
            url: '{{route("roster_filter_change")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                'min_date': minDateFilter,
                'max_date': maxDateFilter
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#ajaxLoader").show();
            },
            success: function (data) {
                if(data.msg == 'success') {
                    //table.destroy();
                    table1.clear();
                    table2.clear();
                    table3.clear();
                    table4.clear();
                    for (let i = 0; i < data.data.length; i++) {
                      var player = data.data[i];
                      table1.row.add({
                        "0": player.player_id,
                        "1": player.player.name,
                        "2": "Date Range",
                        "3": parseFloat(player.attempted > 0 ? (player.made / player.attempted) * 100 : 0).toFixed(2),
                        "4": parseFloat(player.three_point_attempted > 0 ? (player.three_point_made / player.three_point_attempted) * 100 : 0).toFixed(2),
                        "5": parseFloat(player.free_throw_attempted > 0 ? (player.free_throw_made / player.free_throw_attempted) * 100 : 0).toFixed(2),
                        "6": player.points,
                        "7": player.def_reb,
                        "8": player.off_reb,
                        "9": player.assist,
                        "10": player.block,
                        "11": player.steal
                      });
                      table2.row.add({
                        "0": player.player_id,
                        "1": player.player.name,
                        "2": player.possession,
                        "3": player.turnover,
                        "4": player.foul,
                        "5": player.loose_ball,
                        "6": player.charge,
                        "7": player.box_out
                      });
                      table3.row.add({
                        "0": player.player_id,
                        "1": player.player.name,
                        "2": player.hockey_assist_extra_pass,
                        "3": player.pass_leading_to_foul,
                        "4": player.screen_assist,
                        "5": player.tap_back,
                        "6": player.rim_run_sprint_the_floor,
                        "7": player.off_paint_touch
                      });
                      table4.row.add({
                        "0": player.player_id,
                        "1": player.player.name,
                        "2": player.deflection,
                        "3": player.wall_up,
                        "4": player.contest_2,
                        "5": player.contest_3,
                        "6": player.missed_rotation,
                        "7": player.def_paint_touch
                      });
                    }
                }
                table1.draw();
                table2.draw();
                table3.draw();
                table4.draw();
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

      $('#gameFilter').change(function(){
        $.ajax({
            url: '{{route("roster_filter_game")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                'game_id': $(this).val()
            },
            dataType: 'JSON',
            success: function (data) {
              if(data.msg == 'success') {
                  //table.destroy();
                  table1.clear();
                  table2.clear();
                  table3.clear();
                  table4.clear();
                  for (let i = 0; i < data.data.length; i++) {
                    var player = data.data[i];
                    table1.row.add({
                      "0": player.player_id,
                      "1": player.player.name,
                      "2": "Date Range",
                      "3": parseFloat(player.attempted > 0 ? (player.made / player.attempted) * 100 : 0).toFixed(2),
                      "4": parseFloat(player.three_point_attempted > 0 ? (player.three_point_made / player.three_point_attempted) * 100 : 0).toFixed(2),
                      "5": parseFloat(player.free_throw_attempted > 0 ? (player.free_throw_made / player.free_throw_attempted) * 100 : 0).toFixed(2),
                      "6": player.points,
                      "7": player.def_reb,
                      "8": player.off_reb,
                      "9": player.assist,
                      "10": player.block,
                      "11": player.steal
                    });
                    table2.row.add({
                      "0": player.player_id,
                      "1": player.player.name,
                      "2": player.possession,
                      "3": player.turnover,
                      "4": player.foul,
                      "5": player.loose_ball,
                      "6": player.charge,
                      "7": player.box_out
                    });
                    table3.row.add({
                      "0": player.player_id,
                      "1": player.player.name,
                      "2": player.hockey_assist_extra_pass,
                      "3": player.pass_leading_to_foul,
                      "4": player.screen_assist,
                      "5": player.tap_back,
                      "6": player.rim_run_sprint_the_floor,
                      "7": player.off_paint_touch
                    });
                    table4.row.add({
                      "0": player.player_id,
                      "1": player.player.name,
                      "2": player.deflection,
                      "3": player.wall_up,
                      "4": player.contest_2,
                      "5": player.contest_3,
                      "6": player.missed_rotation,
                      "7": player.def_paint_touch
                    });
                  }
                }
                table1.draw();
                table2.draw();
                table3.draw();
                table4.draw();
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
        
    });

      $('#printTable').click(function(){
          window.print();
      });
    </script>
@endsection