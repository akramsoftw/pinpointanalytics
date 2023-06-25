<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team',
        'opponent',
        'location',
        'game_time',
        'is_active',
        'is_practice'
    ];

    public function get_home_team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'home_team');
    }

    public function get_opponent_team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'opponent');
    }
}
