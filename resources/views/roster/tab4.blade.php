<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Players Details - Supplementary Defense</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <table class="mb-0 mt-4 table table-diff table-player" id="table4">
        <thead>
            <tr>
                <td>No</td>
                <td>Players</td>
                <td>Deflections</td>
                <td>Wall up</td>
                <td>Contest 2</td>
                <td>Contest 3</td>
                <td>Missed rotation</td>
                <td>Def. Paint touch</td>
            </tr>
        </thead>
        <tbody>
            @foreach($stats as $player)
            <tr>
                <td>{{$player->player->number}}</td>
                <td>{{$player->player->name}}</td>
                <td>{{$player->deflection}}</td>
                <td>{{$player->wall_up}}</td>
                <td>{{$player->contest_2}}</td>
                <td>{{$player->contest_3}}</td>
                <td>{{$player->missed_rotation}}</td>
                <td>{{$player->def_paint_touch}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>