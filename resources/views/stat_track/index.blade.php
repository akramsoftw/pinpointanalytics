@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="tracker" initial="tracker">
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
        /* table.table-player {
            width: 100%;
        } */

        thead tr td {
            text-align: center;
        }
    </style>
@endsection

@section('content')

@include('layouts.parts.navbar')
@include('layouts.parts.nav')
@include('layouts.parts.nav-list')

    <section class="py-main section-stats">
      <div class="container-fluid">
        <!-- <a href="" class="btn btn-border diff orange mb-3 d-flex d-md-none">Choose Activity</a> -->

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="switch-wrapper switch-stats players-swtich m-auto">
                    <span>Team</span>
                    <label class="switch">
                    <input type="checkbox" id="switch-players" {{$teamSelect && $teamSelect->setting_value == 'selected' ? 'checked' : ''}}>
                    <span class="slider round"></span>
                    </label>
                    <span>Selected</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="btn-tab-section my-4">
                    <ul class="nav justify-content-center nav-tabs">
                        <li class="active"><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab1">Stats - Primary</a></li>
                        <li><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab2">Stats - Other</a></li>
                        <li><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab3">Stats - Supplementary Offense</a></li>
                        <li><a class="btn btn-worning btn-tab" data-toggle="tab" href="#tab4">Stats - Supplementary Defense</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">            
            <div class="col-md-12">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active show">
                        @include('stat_track.tab1')
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        @include('stat_track.tab2')
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        @include('stat_track.tab3')
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        @include('stat_track.tab4')
                    </div>
                </div>
            </div>
        </div>
        
        

        
      </div>
    </section>

@endsection

@section('footer_extra')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>

    <script>
        $(function() {
            var table = $("table.table-player").DataTable({
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
                paging:         false,
                fixedColumns:   {
                    left: 2
                }
            });
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
        $(window).resize( function() {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
      
      $(document).on('click', '.qty-plus', function () {
        var stat_id = $(this).closest('.qty-wrapper').data('stat_id');
        var stat_name = $(this).closest('.qty-wrapper').data('stat_name');
        var newVal = $(this).prev().val(+$(this).prev().val() + 1);
        setStatData(stat_id, stat_name, newVal.val());
      });
      $(document).on('click', '.qty-minus', function () {
        if ($(this).next().val() > 0) {
            var stat_id = $(this).closest('.qty-wrapper').data('stat_id');
            var stat_name = $(this).closest('.qty-wrapper').data('stat_name');
            var newVal = $(this).next().val(+$(this).next().val() - 1);
            setStatData(stat_id, stat_name, newVal.val());
        }
      });


      function setStatData(stat_id, stat_name, value)
      {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        return $.ajax({
            url: '{{route("update_stat")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                stat_id: stat_id,
                stat_name: stat_name,
                value: value
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#ajaxLoader").show();
            },
            success: function (data) {
                // Show success alert
                $('#alertSuccessMsg').text(data.data);
                $('#alertSuccess').show();
                setTimeout(() => {
                    $("#alertSuccess").hide();
                }, 2000);

                // Hide ajax loader
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
       * Team display change
       */
      $('#switch-players').change(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var teamSelect = 'team';
        if ($('#switch-players').is(':checked')) {
            teamSelect = 'selected';
        }

        console.log(teamSelect);
        return $.ajax({
            url: '{{route("options_set_stat_tracker_team")}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                team_select: teamSelect
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#ajaxLoader").show();
            },
            success: function (data) {
                $("#ajaxLoader").hide();
                location.reload();
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