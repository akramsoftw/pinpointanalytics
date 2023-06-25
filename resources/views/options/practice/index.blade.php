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
                <h1>Options</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <div class="row">
                        <div class="col-6">
                            <h3><a href="{{route('options_index')}}" class="back"><img src="{{ asset('frontend/img/pinpoint/icon/ic-left.svg')}}" class="img-fluid img-icon" alt="Icon"></a> Practice</h3>
                        </div>
                        <div class="col-6">
                            <a href="{{route('practice_create')}}" class="btn btn-sm btn-success float-right">Add Practice Game</a>
                        </div>
                    </div>                    
                </div>
                <!-- <div class="options-filter">
                    <form action="">
                        <div class="row">
                            <div class="col-6 col-md-5">
                                <div class="form-group">
                                    <p class="label" for="#opponents">Opponents</p>
                                    <select class="form-control" id="opponents">
                                        <option>All</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-5">
                                <div class="form-group">
                                    <p class="label" for="#date">Date</p>
                                    <select class="form-control" id="date">
                                        <option>All</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="table-responsive">
                    <table class="table table-option">
                        <thead>
                            <tr>
                                <th scope="col">Time</th>
                                <th scope="col">Opponent</th>
                                <th scope="col">Location</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($games as $game)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($game->time)->format('l, F d') }}</td>
                                    <td>{{$game->opponent_team->name}}</td>
                                    <td>{{$game->location}}</td>
                                    <td>
                                        @if($game->is_active != 1)
                                            <a href="{{route('enable_practice', $game->id)}}" class="btn btn-sm btn-warning btn-action">Activate</a>
                                        @else
                                            
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_extra')
    <script>
        var numShown = 4; // Initial rows shown & index
        var numMore = 4;  // Increment

        var $table = $('table').find('tbody');  // tbody containing all the rows
        var numRows = $table.find('tr').length; // Total # rows

        $(function () {
            // Hide rows and add clickable div
            $table.find('tr:gt(' + (numShown - 1) + ')').hide().end()
                .after('<tbody id="more" class="text-center border-0"><tr><td colspan="' +
                    $table.find('tr:first td').length + '"><div class="btn btn-border green">Load More Data</div</tbody></td></tr>');

            $('#more').click(function() {
                numShown = numShown + numMore;
                // no more "show more" if done
                if (numShown >= numRows) {
                    $('#more').remove();
                }
                // change rows remaining if less than increment
                if (numRows - numShown < numMore) {
                    $('#more span').html(numRows - numShown);
                }
                $table.find('tr:lt(' + numShown + ')').show();
            });

        });
    </script>
@endsection