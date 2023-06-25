<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\StatTrack;
use App\Models\ShotChart;
use App\Models\TeamPlayer;

class RosterController extends Controller
{
    public function index()
    {
        $game = Game::where('is_active', 1)->first();

        if(is_null($game) || empty($game)) {
            return redirect()->route('general_error')->with('error', 'Sorry, No active game! Please activate a game from options.');
        }

        $stats = StatTrack::with('player')->where('game_id', $game->id)->get();

        foreach($stats as $stat) {
            $stat['attempted'] = ShotChart::where('player_id', $stat->player_id)->where('game_id', $stat->game_id)->sum('attempted');
            $stat['made'] = ShotChart::where('player_id', $stat->player_id)->where('game_id', $stat->game_id)->sum('made');

            $stat['free_throw_attempted'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');
            $stat['free_throw_made'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');

            $stat['three_point_attempted'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');
            $stat['three_point_made'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->count('made');
        }

        //Get list of games for filter
        $game_list = Game::all();

        return view('roster.index', compact('stats', 'game_list'));
    }

    public function init(Request $request)
    {
        $game = Game::where('is_active', 1)->first();

        $stats = StatTrack::with('player')->where('game_id', $game->id)->get();

        foreach($stats as $stat) {
            $stat['attempted'] = ShotChart::where('player_id', $stat->player_id)->where('game_id', $stat->game_id)->sum('attempted');
            $stat['made'] = ShotChart::where('player_id', $stat->player_id)->where('game_id', $stat->game_id)->sum('made');

            $stat['free_throw_attempted'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');
            $stat['free_throw_made'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');

            $stat['three_point_attempted'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');
            $stat['three_point_made'] = ShotChart::where('player_id', $stat->player_id)
                                        ->where('game_id', $stat->game_id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->count('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => $stats
        );

        return response()->json($response);
    }

    public function filter_change(Request $request)
    {
        $min_date = new Carbon(request('min_date'));
        $max_date = new Carbon(request('max_date'));

        $game = Game::where('is_active', 1)->first();

        $players = TeamPlayer::with('player')->where('team_id', $game->home_team)->get();

        foreach($players as $player) {
            $player['points'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('points');

            $player['def_reb'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('def_reb');

            $player['off_reb'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('off_reb');

            $player['assist'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('assist');

            $player['turnover'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('turnover');

            $player['block'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('block');

            $player['steal'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('steal');

            $player['possession'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('possession');

            $player['foul'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('foul');

            $player['loose_ball'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('loose_ball');

            $player['charge'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('charge');

            $player['box_out'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('box_out');

            $player['hockey_assist_extra_pass'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('hockey_assist_extra_pass');

            $player['pass_leading_to_foul'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('pass_leading_to_foul');

            $player['screen_assist'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('screen_assist');

            $player['tap_back'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('tap_back');

            $player['rim_run_sprint_the_floor'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('rim_run_sprint_the_floor');

            $player['off_paint_touch'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('off_paint_touch');

            $player['deflection'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('deflection');

            $player['wall_up'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('wall_up');

            $player['contest_2'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('contest_2');

            $player['contest_3'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('contest_3');

            $player['missed_rotation'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('missed_rotation');

            $player['def_paint_touch'] = StatTrack::where('player_id', $player->player_id)
                                ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                ->sum('def_paint_touch');

            $player['attempted'] = ShotChart::where('player_id', $player->player_id)
                                    ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                    ->sum('attempted');

            $player['made'] = ShotChart::where('player_id', $player->player_id)
                               ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                               ->sum('made');

            $player['free_throw_attempted'] = ShotChart::where('player_id', $player->player_id)
                                        ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');
            $player['free_throw_made'] = ShotChart::where('player_id', $player->player_id)
                                        ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');

            $player['three_point_attempted'] = ShotChart::where('player_id', $player->player_id)
                                        ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');
            $player['three_point_made'] = ShotChart::where('player_id', $player->player_id)
                                        ->whereBetween('created_at', [$min_date->format('Y-m-d')." 00:00:00", $max_date->format('Y-m-d')." 23:59:59"])
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->count('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => $players
        );

        return response()->json($response);
    }

    /**
     * filter by game id
     */
    public function roster_filter_game(Request $request)
    {
        $gameId = request('game_id');

        $game = Game::where('id', $gameId)->first();

        $players = TeamPlayer::with('player')->where('team_id', $game->home_team)->get();

        foreach($players as $player) {
            $player['points'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('points');

            $player['def_reb'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('def_reb');

            $player['off_reb'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('off_reb');

            $player['assist'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('assist');

            $player['turnover'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('turnover');

            $player['block'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('block');

            $player['steal'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('steal');

            $player['possession'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('possession');

            $player['foul'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('foul');

            $player['loose_ball'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('loose_ball');

            $player['charge'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('charge');

            $player['box_out'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('box_out');

            $player['hockey_assist_extra_pass'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('hockey_assist_extra_pass');

            $player['pass_leading_to_foul'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('pass_leading_to_foul');

            $player['screen_assist'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('screen_assist');

            $player['tap_back'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('tap_back');

            $player['rim_run_sprint_the_floor'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('rim_run_sprint_the_floor');

            $player['off_paint_touch'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('off_paint_touch');

            $player['deflection'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('deflection');

            $player['wall_up'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('wall_up');

            $player['contest_2'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('contest_2');

            $player['contest_3'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('contest_3');

            $player['missed_rotation'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('missed_rotation');

            $player['def_paint_touch'] = StatTrack::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                                ->sum('def_paint_touch');

            $player['attempted'] = ShotChart::where('player_id', $player->player_id)
                                    ->where('game_id', $game->id)
                                    ->sum('attempted');

            $player['made'] = ShotChart::where('player_id', $player->player_id)
                                ->where('game_id', $game->id)
                               ->sum('made');

            $player['free_throw_attempted'] = ShotChart::where('player_id', $player->player_id)
                                        ->where('game_id', $game->id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');
            $player['free_throw_made'] = ShotChart::where('player_id', $player->player_id)
                                        ->where('game_id', $game->id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');

            $player['three_point_attempted'] = ShotChart::where('player_id', $player->player_id)
                                        ->where('game_id', $game->id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');
            $player['three_point_made'] = ShotChart::where('player_id', $player->player_id)
                                        ->where('game_id', $game->id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->count('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => $players
        );

        return response()->json($response);
    }
}
