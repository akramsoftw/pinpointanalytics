<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'player_id',
        'points',
        'def_reb',
        'off_reb',
        'assist',
        'turnover',
        'block',
        'steal',
        'possession',
        'foul',
        'loose_ball',
        'charge',
        'box_out',
        'hockey_assist_extra_pass',
        'pass_leading_to_foul',
        'screen_assist',
        'tap_back',
        'rim_run_sprint_the_floor',
        'off_paint_touch',
        'deflection',
        'wall_up',
        'contest_2',
        'contest_3',
        'missed_rotation',
        'def_paint_touch'
    ];

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }

    public function player()
    {
        return $this->hasOne('App\Models\Player', 'id', 'player_id');
    }
}
