<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\GamePlayer;
use App\Models\PlayList;
use App\Models\ShotChart;

class ShotChartController extends Controller
{
    /**
     * ShotChart index
     */
    public function index()
    {
        $game = Game::with('get_home_team', 'get_opponent_team')->where('is_active', 1)->first();

        if(is_null($game) || empty($game)) {
            return redirect()->route('general_error')->with('error', 'Sorry, No active game! Please activate a game from options.');
        }

        $players = GamePlayer::with('player')->where('game_id', $game->id)->where('is_home_team', 1)->get();

        $selectedPlayers = GamePlayer::with('player')->where('game_id', $game->id)->where('is_home_team', 1)->where('assigned_user', Auth::id())->get();

        $playList = PlayList::all();

        $recordCount = ShotChart::where('created_by', Auth::id())->where('game_id', $game->id)->count();

        return view('shotchart.index', compact('game', 'players', 'selectedPlayers', 'playList', 'recordCount'));
    }

    /**
     * Assign user to players
     */
    public function updateAssignedUser(Request $request)
    {
        $this->validate($request, [
            'gpid' => 'required',
            'action' => 'required'
        ]);

        $gamePlayer = GamePlayer::find(request('gpid'));

        if(request('action') == 'add') {
            $gamePlayer->assigned_user = Auth::id();
            $gamePlayer->touch();
        }

        if(request('action') == 'remove') {
            $gamePlayer->assigned_user = null;
            $gamePlayer->touch();
        }

        $response = array(
            'msg' => 'success',
        );
        return response()->json($response);
    }

    public function recordShot(Request $request)
    {

        $this->validate($request, [
          'gpid' => 'required',
          'chartsection' => 'required_if:attempt_type,fg',
          //'dribbles' => 'required',
          //'attempted' => 'required',
          'attempt_type' => 'required',
          'made' => 'required',
          //'points' => 'required',
          //'shotclock' => 'required',
          //'play' => 'required'
        ]);

        $chartsection = request('chartsection');
        $gamePlayer = GamePlayer::find(request('gpid'));

        // $oldRecords = ShotChart::where('game_id', $gamePlayer->game_id)
        //                         ->where('player_id', $gamePlayer->player_id)
        //                         ->where('chart_section', request('chartsection'))
        //                         ->where('attempted', request('attempted'))
        //                         ->where('made', request('made'))
        //                         ->where('points', request('points'))
        //                         ->where('dribbles', request('dribbles'))
        //                         ->where('shot_clock', request('shotclock'))
        //                         ->where('play', request('play'))
        //                         ->count();

        // if($oldRecords <= 0) {
        //     $newShot = ShotChart::create([
        //         'game_id' => $gamePlayer->game_id,
        //         'player_id' => $gamePlayer->player_id,
        //         'chart_section' => request('chartsection'),
        //         'attempted' => request('attempted'),
        //         'made' => request('made'),
        //         'points' => request('points'),
        //         'dribbles' => request('dribbles'),
        //         'shot_clock' => request('shotclock'),
        //         'play' => request('play'),
        //         'created_by' => Auth::id()
        //     ]);

        //     $response = array(
        //         'msg' => 'success',
        //         'data' => 'Data saved!'
        //     );
        // } else {
        //     $response = array(
        //         'msg' => 'error',
        //         'data' => 'Data already exists!'
        //     );
        // }

        if(request('attempt_type') == "ft") {
            $freeThrow    = 1;
            $chartsection = 0;
        }
        if(request('attempt_type') == "fg") {
            $freeThrow = 0;
        }

        $newShot = ShotChart::create([
            'game_id' => $gamePlayer->game_id,
            'player_id' => $gamePlayer->player_id,
            'chart_section' => $chartsection,
            //'attempted' => request('attempted'),
            'attempted' => 1,
            'is_free_throw' => $freeThrow,
            'made' => request('made'),
            //'points' => request('points'),
            //'dribbles' => request('dribbles'),
            //'shot_clock' => request('shotclock'),
            //'play' => request('play'),
            'created_by' => Auth::id()
        ]);

        $recordCount = ShotChart::where('created_by', Auth::id())->where('game_id', $newShot->game_id)->count();

        $response = array(
            'msg' => 'success',
            'data' => 'Data saved!',
            'recordCount' => $recordCount
        );

        return response()->json($response);
    }

    /**
     * remove last user's record
     */
    public function recordShotUndo(Request $request)
    {
        $this->validate($request, [
            'activeGameId' => 'required'
        ]);

        ShotChart::where('created_by', Auth::id())->where('game_id', request('activeGameId'))->orderBy('id', 'desc')->limit(1)->delete();

        $recordCount = ShotChart::where('created_by', Auth::id())->where('game_id', request('activeGameId'))->count();

        $response = array(
            'msg' => 'success',
            'data' => 'Data removed!',
            'recordCount' => $recordCount
        );

        return response()->json($response);
    }

    /**
     * All data analytics
     */
    public function getAnalytics()
    {
        $game = Game::where('is_active', 1)->first();

        $attemptedArr = array();
        $madeArr = array();

        for ($x = 1; $x <= 16; $x++) {
            $attemptedArr[$x] = ShotChart::where('chart_section', $x)->sum('attempted');
            $madeArr[$x] = ShotChart::where('chart_section', $x)->sum('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => [$attemptedArr, $madeArr]
        );

        return response()->json($response);
    }
}
