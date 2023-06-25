<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Players Details - Supplementary Offense</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <table class="mb-0 mt-4 table table-diff table-player" id="table3">
        <thead>
            <tr>
                <td>No</td>
                <td>Players</td>
                <td>Hockey assist/extra pass</td>
                <td>Pass leading to foul</td>
                <td>Screen assist</td>
                <td>Tap backs</td>
                <td>Rim run/sprint the floor</td>
                <td>Off. paint touch</td>
            </tr>
        </thead>
        <tbody>
            @foreach($stats as $player)
            <tr>
                <td>{{$player->player->number}}</td>
                <td>{{$player->player->name}}</td>
                <td>{{$player->hockey_assist_extra_pass}}</td>
                <td>{{$player->pass_leading_to_foul}}</td>
                <td>{{$player->screen_assist}}</td>
                <td>{{$player->tap_back}}</td>
                <td>{{$player->rim_run_sprint_the_floor}}</td>
                <td>{{$player->off_paint_touch}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>