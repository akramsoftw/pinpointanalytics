<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Players Details - Other</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <div class="table-responsive">
    <table class="mb-0 mt-4 table table-diff table-player" id="table2">
        <thead>
            <tr>
                <td>No</td>
                <td>Players</td>
                <td>Possessions</td>
                <td>Turnover</td>
                <td>Fouls</td>
                <td>Loose Balls</td>
                <td>Charges</td>
                <td>Box Outs</td>
            </tr>
        </thead>
        <tbody>
            @foreach($stats as $player)
            <tr>
                <td>{{$player->player->number}}</td>
                <td>{{$player->player->name}}</td>
                <td>{{$player->possession}}</td>
                <td>{{$player->turnover}}</td>
                <td>{{$player->foul}}</td>
                <td>{{$player->loose_ball}}</td>
                <td>{{$player->charge}}</td>
                <td>{{$player->box_out}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>