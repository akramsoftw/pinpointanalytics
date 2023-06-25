<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Stats - Supplementary Offense</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <table class="mb-0 mt-4 table table-diff table-player" id="table-player3">
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
            @foreach($statTrack as $player)
            <tr>
                <td>{{$player->number}}</td>
                <td>{{$player->name}}</td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="hockey_assist_extra_pass">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->hockey_assist_extra_pass}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="pass_leading_to_foul">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->pass_leading_to_foul}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="screen_assist">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->screen_assist}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="tap_back">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->tap_back}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="rim_run_sprint_the_floor">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->rim_run_sprint_the_floor}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="off_paint_touch">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->off_paint_touch}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>