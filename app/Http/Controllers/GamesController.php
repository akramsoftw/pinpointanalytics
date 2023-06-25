<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use App\Models\StatTrack;
use App\Models\GamePlayer;
use App\Models\Team;
use App\Models\TeamPlayer;

class GamesController extends Controller
{
    public function enable_game($id)
    {
        // Reset active status
        Game::where('is_active', 1)->update(['is_active' => 0]);

        // Set new active game
        $game = Game::find($id);
        $game->is_active = 1;
        $game->save();

        // Update stat_tracks table
        $statTrackCount = StatTrack::where('game_id', $id)->count();
        
        if($statTrackCount <= 0) {
            $gamePlayer = GamePlayer::where('game_id', $id)->where('is_home_team', true)->get();

            foreach($gamePlayer as $player) {
                StatTrack::create([
                    'game_id' => $id,
                    'player_id' => $player->player_id
                ]);
            }
        }

        return redirect()->route('options_game');
    }

    public function create()
    {
        $teams = Team::pluck('name', 'id');

        return view('options.game.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'home_team' => 'required',
            'opponent' => 'required',
            'location' => 'required',
            'game_time' => 'required'
        ]);

        $newGame = Game::create([
            'home_team' => request('home_team'),
            'opponent' => request('opponent'),
            'location' => request('location'),
            'game_time' => request('game_time'),
            'is_active' => 0,
            'is_practice' => 0
        ]);

        // Create game player relations
        $homeTeam = TeamPlayer::where('team_id', $newGame->home_team)->get();
        $opponentTeam = TeamPlayer::where('team_id', $newGame->opponent)->get();

        foreach($homeTeam as $player) {
            GamePlayer::create([
                'game_id' => $newGame->id,
                'player_id' => $player->id,
                'is_home_team' => 1,
                'track_user' => null
            ]);
        }

        foreach($opponentTeam as $player) {
            GamePlayer::create([
                'game_id' => $newGame->id,
                'player_id' => $player->id,
                'is_home_team' => 0,
                'track_user' => null
            ]);
        }

        return redirect()->route('options_game');
    }
}
