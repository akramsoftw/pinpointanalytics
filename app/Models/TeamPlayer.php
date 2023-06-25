<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'player_id'
    ];

    public function team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_id');
    }

    public function player()
    {
        return $this->hasOne('App\Models\Player', 'id', 'player_id');
    }
}
