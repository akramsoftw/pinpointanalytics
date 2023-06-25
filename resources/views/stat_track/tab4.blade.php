<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Stats - Supplementary Defense</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <table class="mb-0 mt-4 table table-diff table-player" id="table-player4">
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
            @foreach($statTrack as $player)
            <tr>
                <td>{{$player->number}}</td>
                <td>{{$player->name}}</td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="deflection">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->deflection}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="wall_up">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->wall_up}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="contest_2">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->contest_2}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="contest_3">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->contest_3}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="missed_rotation">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->missed_rotation}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="def_paint_touch">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->def_paint_touch}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>