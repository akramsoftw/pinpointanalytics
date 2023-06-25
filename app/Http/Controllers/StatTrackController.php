<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use App\Models\StatTrack;
use App\Models\GamePlayer;
use App\Models\Setting;
use DB;
use Illuminate\Support\Facades\Auth;

class StatTrackController extends Controller
{
    public function index()
    {
        $activeGame = Game::where('is_active', 1)->first();

        if(is_null($activeGame) || empty($activeGame)) {
            return redirect()->route('general_error')->with('error', 'Sorry, No active game! Please activate a game from options.');
        }

        //$statTrack = StatTrack::with('player')->where('game_id', $activeGame->id)->get();

        $teamSelectSetting = Setting::where('setting_name', 'stat_tracker_team_select')->first();

        if($teamSelectSetting && $teamSelectSetting->setting_value == 'selected') {
            $statTrack = DB::table('game_players')
            ->join('players', 'players.id', '=', 'game_players.player_id')
            ->join('stat_tracks', 'stat_tracks.player_id', '=', 'game_players.player_id')
            ->where('stat_tracks.game_id', $activeGame->id)
            ->where('game_players.game_id', $activeGame->id)
            ->where('game_players.is_home_team', 1)
            ->where('game_players.assigned_user', Auth::id())
            ->select('players.name', 'players.number', 'stat_tracks.*')
            ->get();
        } else {
            $statTrack = DB::table('stat_tracks')
            ->join('players', 'players.id', '=', 'stat_tracks.player_id')
            ->where('stat_tracks.game_id', $activeGame->id)
            ->select('players.name', 'players.number', 'stat_tracks.*')
            ->get();
        }
        

            //dd($statTrack);

        $teamSelect = Setting::where('setting_name', 'stat_tracker_team_select')->first();

        return view('stat_track.index', compact('statTrack', 'teamSelect'));
    }

    public function update_stat(Request $request)
    {
        $this->validate($request, [
            'stat_id' => 'required',
            'stat_name' => 'required',
            'value' => 'required'
        ]);

        $updateStat = DB::table('stat_tracks')
              ->where('id', request('stat_id'))
              ->update([request('stat_name') => request('value')]);

        $response = array(
            'msg' => $updateStat,
            'data' => 'Data saved!',
        );
        return response()->json($response); 
    }
}
