<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShotChart extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'player_id',
        'chart_section',
        'attempted',
        'is_free_throw',
        'made',
        'points',
        'dribbles',
        'shot_clock',
        'play',
        'created_by'
    ];

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }

    public function player()
    {
        return $this->hasOne('App\Models\Player', 'id', 'player_id');
    }

    public function created_by()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
