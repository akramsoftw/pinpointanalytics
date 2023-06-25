<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Stats - Primary</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <table class="mb-0 mt-4 table table-diff table-player" id="table-player1">
        <thead>
            <tr>
                <td>No</td>
                <td>Players</td>
                <td>Points</td>
                <td>Def Reb</td>
                <td>Off Reb</td>
                <td>Assist</td>
                <td>Block</td>
                <td>Steal</td>
            </tr>
        </thead>
        <tbody>
            @foreach($statTrack as $player)
            <tr>
                <td>{{$player->number}}</td>
                <td>{{$player->name}}</td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="points">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->points}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="def_reb">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->def_reb}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="off_reb">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->off_reb}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="assist">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->assist}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="block">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->block}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="steal">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->steal}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>