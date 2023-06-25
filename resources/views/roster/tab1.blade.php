<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Players Details - Primary</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <div class="table-responsive">
        <table class="mb-0 mt-4 table table-diff table-player" id="table1">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Players</td>
                    <td>Date</td>
                    <td>FG(%)</td>
                    <td>3PT(%)</td>
                    <td>FT(%)</td>
                    <td>Points</td>
                    <td>Def Reb</td>
                    <td>Off Reb</td>
                    <td>Assist</td>
                    <td>Block</td>
                    <td>Steal</td>
                </tr>
            </thead>
            <tbody>
                @foreach($stats as $player)
                <tr>
                    <td>{{$player->player->number}}</td>
                    <td>{{$player->player->name}}</td>
                    <td>{{ Carbon\Carbon::parse($player->created_at)->format('m/d/Y') }}</td>
                    <td>{{number_format($player->attempted > 0 ? ($player->made / $player->attempted) * 100 : 0, 2)}}</td>
                    <td>{{number_format($player->three_point_attempted > 0 ? ($player->three_point_made / $player->three_point_attempted) * 100 : 0, 2)}}</td>
                    <td>{{number_format($player->free_throw_attempted > 0 ? ($player->free_throw_made / $player->free_throw_attempted) * 100 : 0, 2)}}</td>
                    <td>{{$player->points}}</td>
                    <td>{{$player->def_reb}}</td>
                    <td>{{$player->off_reb}}</td>
                    <td>{{$player->assist}}</td>
                    <td>{{$player->block}}</td>
                    <td>{{$player->steal}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>