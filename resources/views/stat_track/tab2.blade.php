<div class="box-general box-diff-2">
    <div class="heading w-link">
        <h3>Stats - Other</h3>
        <!-- <div class="dropdown">
            <a class="btn btn-primary" href="#">
                Change Player
            </a>
        </div> -->
    </div>
    <table class="mb-0 mt-4 table table-diff table-player" id="table-player2">
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
            @foreach($statTrack as $player)
            <tr>
                <td>{{$player->number}}</td>
                <td>{{$player->name}}</td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="possession">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->possession}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="turnover">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->turnover}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="foul">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->foul}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="loose_ball">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->loose_ball}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="charge">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->charge}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group form-add add-diff">
                        <div class="qty-wrapper" data-stat_id="{{$player->id}}" data-stat_name="box_out">
                            <input type="button" value="-" class="qty-general qty-minus">
                            <input type="number" value="{{$player->box_out}}" class="qty">
                            <input type="button" value="+" class="qty-general qty-plus">
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>