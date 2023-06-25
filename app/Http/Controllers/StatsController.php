<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\StatTrack;
use App\Models\GamePlayer;
use App\Models\ShotChart;
use App\Models\Setting;

class StatsController extends Controller
{
    public function index()
    {
        $game = Game::where('is_active', 1)->first();

        if(is_null($game) || empty($game)) {
            return redirect()->route('general_error')->with('error', 'Sorry, No active game! Please activate a game from options.');
        }

        $players = GamePlayer::with('player')->where('game_id', $game->id)->where('is_home_team', 1)->get();

        $stats_dataset = Setting::where('setting_name', 'stats_dataset')->first();

        return view('stats.index', compact('players', 'stats_dataset'));
    }

    public function live_data()
    {
        $game = Game::where('is_active', 1)->first();

        $statData = StatTrack::where('game_id', $game->id)->get();

        // $points = StatTrack::where('game_id', $game->id)->sum('points');
        // $rebounds = StatTrack::where('game_id', $game->id)->sum('def_reb') + StatTrack::where('game_id', $game->id)->sum('off_reb');
        // $assissts = StatTrack::where('game_id', $game->id)->sum('assist');
        // $steals = StatTrack::where('game_id', $game->id)->sum('steal');
        // $blocks = StatTrack::where('game_id', $game->id)->sum('block');

        $points = $statData->sum('points');
        $rebounds = $statData->sum('def_reb') + $statData->sum('off_reb');
        $assissts = $statData->sum('assist');
        $steals = $statData->sum('steal');
        $blocks = $statData->sum('block');

        // FG
        $attempted = ShotChart::where('game_id', $game->id)->sum('attempted');
        $made = ShotChart::where('game_id', $game->id)->sum('made');
        $fg = $made . "-" . $attempted;
        $fg_percent = number_format($attempted > 0 ? ($made / $attempted) * 100 : 0, 2);

        // 3PT
        $three_point_attempted = ShotChart::where('game_id', $game->id)
                                    ->whereIn('chart_section', [1,2,3,4,5])
                                    ->sum('attempted');
        $three_point_made = ShotChart::where('game_id', $game->id)
                                    ->whereIn('chart_section', [1,2,3,4,5])
                                    ->sum('made');
        $pt3 = $three_point_made . "-" . $three_point_attempted;
        $pt3_percent = number_format($three_point_attempted > 0 ? ($three_point_made / $three_point_attempted) * 100 : 0, 2);

        // FT
        $free_throw_attempted = ShotChart::where('game_id', $game->id)
                                    ->whereIn('chart_section', [0])
                                    ->where('is_free_throw', 1)
                                    ->sum('attempted');
        $free_throw_made = ShotChart::where('game_id', $game->id)
                                    ->whereIn('chart_section', [0])
                                    ->where('is_free_throw', 1)
                                    ->sum('made');
        $ft = $free_throw_made . "-" . $free_throw_attempted;
        $ft_percent = number_format($free_throw_attempted > 0 ? ($free_throw_made / $free_throw_attempted) * 100 : 0, 2);

        $response = array(
            'msg' => 'success',
            'data' => [
                'points' => $points,
                'rebounds' => $rebounds,
                'assissts' => $assissts,
                'steals' => $steals,
                'blocks' => $blocks,
                'fg' => $fg,
                'fg_percent' => $fg_percent,
                '3pt' => $pt3,
                '3pt_percent' => $pt3_percent,
                'ft' => $ft,
                'ft_percent' => $ft_percent,
                'possession' => $points = $statData->sum('possession'),
                'foul' => $points = $statData->sum('foul'),
                'loose_ball' => $points = $statData->sum('loose_ball'),
                'charge' => $points = $statData->sum('charge'),
                'box_out' => $points = $statData->sum('box_out'),
                'hockey_assist_extra_pass' => $points = $statData->sum('hockey_assist_extra_pass'),
                'pass_leading_to_foul' => $points = $statData->sum('pass_leading_to_foul'),
                'screen_assist' => $points = $statData->sum('screen_assist'),
                'tap_back' => $points = $statData->sum('tap_back'),
                'rim_run_sprint_the_floor' => $points = $statData->sum('rim_run_sprint_the_floor'),
                'off_paint_touch' => $points = $statData->sum('off_paint_touch'),
                'deflection' => $points = $statData->sum('deflection'),
                'wall_up' => $points = $statData->sum('wall_up'),
                'contest_2' => $points = $statData->sum('contest_2'),
                'contest_3' => $points = $statData->sum('contest_3'),
                'missed_rotation' => $points = $statData->sum('missed_rotation'),
                'def_paint_touch' => $points = $statData->sum('def_paint_touch')
            ]
        );

        return response()->json($response);
    }

    public function all_data()
    {
        $game = Game::where('is_active', 1)->first();

        $players = GamePlayer::where('game_id', $game->id)->where('is_home_team', 1)->get();

        $points = 0;
        $rebounds = 0;
        $assissts = 0;
        $steals = 0;
        $blocks = 0;
        $attempted = 0;
        $made = 0;
        $three_point_attempted = 0;
        $three_point_made = 0;
        $free_throw_attempted = 0;
        $free_throw_made = 0;
        $possession = 0;
        $foul = 0;
        $loose_ball = 0;
        $charge = 0;
        $box_out = 0;
        $hockey_assist_extra_pass = 0;
        $pass_leading_to_foul = 0;
        $screen_assist = 0;
        $tap_back = 0;
        $rim_run_sprint_the_floor = 0;
        $off_paint_touch = 0;
        $deflection = 0;
        $wall_up = 0;
        $contest_2 = 0;
        $contest_3 = 0;
        $missed_rotation = 0;
        $def_paint_touch = 0;

        foreach($players as $player) {
            $points += StatTrack::where('player_id', $player->player_id)->sum('points');
            $rebounds += StatTrack::where('player_id', $player->player_id)->sum('def_reb') + StatTrack::where('player_id', $player->player_id)->sum('off_reb');
            $assissts += StatTrack::where('player_id', $player->player_id)->sum('assist');
            $steals += StatTrack::where('player_id', $player->player_id)->sum('steal');
            $blocks += StatTrack::where('player_id', $player->player_id)->sum('block');
            $possession += StatTrack::where('player_id', $player->player_id)->sum('possession');
            $foul += StatTrack::where('player_id', $player->player_id)->sum('foul');
            $loose_ball += StatTrack::where('player_id', $player->player_id)->sum('loose_ball');
            $charge += StatTrack::where('player_id', $player->player_id)->sum('charge');
            $box_out += StatTrack::where('player_id', $player->player_id)->sum('box_out');
            $hockey_assist_extra_pass += StatTrack::where('player_id', $player->player_id)->sum('hockey_assist_extra_pass');
            $pass_leading_to_foul += StatTrack::where('player_id', $player->player_id)->sum('pass_leading_to_foul');
            $screen_assist += StatTrack::where('player_id', $player->player_id)->sum('screen_assist');
            $tap_back += StatTrack::where('player_id', $player->player_id)->sum('tap_back');
            $rim_run_sprint_the_floor += StatTrack::where('player_id', $player->player_id)->sum('rim_run_sprint_the_floor');
            $off_paint_touch += StatTrack::where('player_id', $player->player_id)->sum('off_paint_touch');
            $deflection += StatTrack::where('player_id', $player->player_id)->sum('deflection');
            $wall_up += StatTrack::where('player_id', $player->player_id)->sum('wall_up');
            $contest_2 += StatTrack::where('player_id', $player->player_id)->sum('contest_2');
            $contest_3 += StatTrack::where('player_id', $player->player_id)->sum('contest_3');
            $missed_rotation += StatTrack::where('player_id', $player->player_id)->sum('missed_rotation');
            $def_paint_touch += StatTrack::where('player_id', $player->player_id)->sum('def_paint_touch');

            // FG
            $attempted += ShotChart::where('player_id', $player->player_id)->sum('attempted');
            $made += ShotChart::where('player_id', $player->player_id)->sum('made');

            // 3PT
            $three_point_attempted += ShotChart::where('player_id', $player->player_id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');
            $three_point_made += ShotChart::where('player_id', $player->player_id)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('made');

            // FT
            $free_throw_attempted += ShotChart::where('player_id', $player->player_id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');
            $free_throw_made += ShotChart::where('player_id', $player->player_id)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');
        }

        $fg = $made . "-" . $attempted;
        $fg_percent = number_format($attempted > 0 ? ($made / $attempted) * 100 : 0, 2);

        $pt3 = $three_point_made . "-" . $three_point_attempted;
        $pt3_percent = number_format($three_point_attempted > 0 ? ($three_point_made / $three_point_attempted) * 100 : 0, 2);

        $ft = $free_throw_made . "-" . $free_throw_attempted;
        $ft_percent = number_format($free_throw_attempted > 0 ? ($free_throw_made / $free_throw_attempted) * 100 : 0, 2);

        $response = array(
            'msg' => 'success',
            'data' => [
                'points' => $points,
                'rebounds' => $rebounds,
                'assissts' => $assissts,
                'steals' => $steals,
                'blocks' => $blocks,
                'fg' => $fg,
                'fg_percent' => $fg_percent,
                '3pt' => $pt3,
                '3pt_percent' => $pt3_percent,
                'ft' => $ft,
                'ft_percent' => $ft_percent,
                'possession' => $possession,
                'foul' => $foul,
                'loose_ball' => $loose_ball,
                'charge' => $charge,
                'box_out' => $box_out,
                'hockey_assist_extra_pass' => $hockey_assist_extra_pass,
                'pass_leading_to_foul' => $pass_leading_to_foul,
                'screen_assist' => $screen_assist,
                'tap_back' => $tap_back,
                'rim_run_sprint_the_floor' => $rim_run_sprint_the_floor,
                'off_paint_touch' => $off_paint_touch,
                'deflection' => $deflection,
                'wall_up' => $wall_up,
                'contest_2' => $contest_2,
                'contest_3' => $contest_3,
                'missed_rotation' => $missed_rotation,
                'def_paint_touch' => $def_paint_touch
            ]
        );

        return response()->json($response);
    }

    public function filter_change(Request $request)
    {
        $min_date = new Carbon(request('min_date'));
        $max_date = new Carbon(request('max_date'));

        $game = Game::where('is_active', 1)->first();

        $players = GamePlayer::where('game_id', $game->id)->where('is_home_team', 1)->get();

        // Get list of game IDs
        $game_ids = Game::where('home_team', $game->home_team)
                            ->whereBetween('game_time', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])->pluck('id');

        $points = 0;
        $rebounds = 0;
        $assissts = 0;
        $steals = 0;
        $blocks = 0;
        $attempted = 0;
        $made = 0;
        $three_point_attempted = 0;
        $three_point_made = 0;
        $free_throw_attempted = 0;
        $free_throw_made = 0;
        $possession = 0;
        $foul = 0;
        $loose_ball = 0;
        $charge = 0;
        $box_out = 0;
        $hockey_assist_extra_pass = 0;
        $pass_leading_to_foul = 0;
        $screen_assist = 0;
        $tap_back = 0;
        $rim_run_sprint_the_floor = 0;
        $off_paint_touch = 0;
        $deflection = 0;
        $wall_up = 0;
        $contest_2 = 0;
        $contest_3 = 0;
        $missed_rotation = 0;
        $def_paint_touch = 0;

        foreach($players as $player) {
            $points += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('points');

            $rebounds += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('def_reb') + StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('off_reb');

            $assissts += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('assist');

            $steals += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('steal');

            $blocks += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('block');

            // FG
            $attempted += ShotChart::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('attempted');

            $made += ShotChart::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('made');

            // 3PT
            $three_point_attempted += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');

            $three_point_made += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('made');

            // FT
            $free_throw_attempted += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');

            $free_throw_made += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');

            // Stats new additions
            $possession += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('possession');

            $foul += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('foul');

            $loose_ball += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('loose_ball');

            $charge += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('charge');

            $box_out += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('box_out');

            $hockey_assist_extra_pass += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('hockey_assist_extra_pass');

            $pass_leading_to_foul += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('pass_leading_to_foul');

            $screen_assist += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('screen_assist');

            $tap_back += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('tap_back');

            $rim_run_sprint_the_floor += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('rim_run_sprint_the_floor');

            $off_paint_touch += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('off_paint_touch');

            $deflection += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('deflection');

            $wall_up += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('wall_up');

            $contest_2 += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('contest_2');

            $contest_3 += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('contest_3');

            $missed_rotation += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('missed_rotation');

            $def_paint_touch += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('def_paint_touch');
        }

        $fg = $made . "-" . $attempted;
        $fg_percent = number_format($attempted > 0 ? ($made / $attempted) * 100 : 0, 2);

        $pt3 = $three_point_made . "-" . $three_point_attempted;
        $pt3_percent = number_format($three_point_attempted > 0 ? ($three_point_made / $three_point_attempted) * 100 : 0, 2);

        $ft = $free_throw_made . "-" . $free_throw_attempted;
        $ft_percent = number_format($free_throw_attempted > 0 ? ($free_throw_made / $free_throw_attempted) * 100 : 0, 2);

        // Shot data
        $attemptedArr = array();
        $madeArr = array();

        for ($x = 1; $x <= 16; $x++) {
            $attemptedArr[$x] = ShotChart::where('chart_section', $x)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('attempted');
            $madeArr[$x] = ShotChart::where('chart_section', $x)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => [
                'points' => $points,
                'rebounds' => $rebounds,
                'assissts' => $assissts,
                'steals' => $steals,
                'blocks' => $blocks,
                'fg' => $fg,
                'fg_percent' => $fg_percent,
                '3pt' => $pt3,
                '3pt_percent' => $pt3_percent,
                'ft' => $ft,
                'ft_percent' => $ft_percent,
                'attemptedArr' => $attemptedArr,
                'madeArr' => $madeArr,
                'possession' => $possession,
                'foul' => $foul,
                'loose_ball' => $loose_ball,
                'charge' => $charge,
                'box_out' => $box_out,
                'hockey_assist_extra_pass' => $hockey_assist_extra_pass,
                'pass_leading_to_foul' => $pass_leading_to_foul,
                'screen_assist' => $screen_assist,
                'tap_back' => $tap_back,
                'rim_run_sprint_the_floor' => $rim_run_sprint_the_floor,
                'off_paint_touch' => $off_paint_touch,
                'deflection' => $deflection,
                'wall_up' => $wall_up,
                'contest_2' => $contest_2,
                'contest_3' => $contest_3,
                'missed_rotation' => $missed_rotation,
                'def_paint_touch' => $def_paint_touch
            ]
        );

        return response()->json($response);
    }

    /**
     * Advanced search
     */
    public function advanced_search(Request $request)
    {
        $min_date = new Carbon(request('min_date'));
        $max_date = new Carbon(request('max_date'));
        $filterType = request('filter_type');
        $gamePlayers = request('game_players');

        $game = Game::where('is_active', 1)->first();

        if($filterType == 'team') {
            $players = GamePlayer::where('game_id', $game->id)->where('is_home_team', 1)->get();
        } else {
            $players = GamePlayer::whereIn('id', $gamePlayers)->get();
        }

        // Get list of game IDs
        $game_ids = Game::where('home_team', $game->home_team)
                            ->whereBetween('game_time', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])->pluck('id');

        $points = 0;
        $rebounds = 0;
        $assissts = 0;
        $steals = 0;
        $blocks = 0;
        $attempted = 0;
        $made = 0;
        $three_point_attempted = 0;
        $three_point_made = 0;
        $free_throw_attempted = 0;
        $free_throw_made = 0;
        $possession = 0;
        $foul = 0;
        $loose_ball = 0;
        $charge = 0;
        $box_out = 0;
        $hockey_assist_extra_pass = 0;
        $pass_leading_to_foul = 0;
        $screen_assist = 0;
        $tap_back = 0;
        $rim_run_sprint_the_floor = 0;
        $off_paint_touch = 0;
        $deflection = 0;
        $wall_up = 0;
        $contest_2 = 0;
        $contest_3 = 0;
        $missed_rotation = 0;
        $def_paint_touch = 0;

        $playerIdsArr = array();

        foreach($players as $player) {

            $playerIdsArr[] = $player->player_id;

            $points += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('points');

            $rebounds += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('def_reb') + StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('off_reb');

            $assissts += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('assist');

            $steals += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('steal');

            $blocks += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('block');

            // FG
            $attempted += ShotChart::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('attempted');

            $made += ShotChart::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('made');

            // 3PT
            $three_point_attempted += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('attempted');

            $three_point_made += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [1,2,3,4,5])
                                        ->sum('made');

            // FT
            $free_throw_attempted += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('attempted');

            $free_throw_made += ShotChart::where('player_id', $player->player_id)
                                        //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                        ->whereIn('game_id', $game_ids)
                                        ->whereIn('chart_section', [0])
                                        ->where('is_free_throw', 1)
                                        ->sum('made');

            // Stats new additions
            $possession += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('possession');

            $foul += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('foul');

            $loose_ball += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('loose_ball');

            $charge += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('charge');

            $box_out += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('box_out');

            $hockey_assist_extra_pass += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('hockey_assist_extra_pass');

            $pass_leading_to_foul += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('pass_leading_to_foul');

            $screen_assist += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('screen_assist');

            $tap_back += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('tap_back');

            $rim_run_sprint_the_floor += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('rim_run_sprint_the_floor');

            $off_paint_touch += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('off_paint_touch');

            $deflection += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('deflection');

            $wall_up += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('wall_up');

            $contest_2 += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('contest_2');

            $contest_3 += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('contest_3');

            $missed_rotation += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('missed_rotation');

            $def_paint_touch += StatTrack::where('player_id', $player->player_id)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('def_paint_touch');
        }

        $fg = $made . "-" . $attempted;
        $fg_percent = number_format($attempted > 0 ? ($made / $attempted) * 100 : 0, 2);

        $pt3 = $three_point_made . "-" . $three_point_attempted;
        $pt3_percent = number_format($three_point_attempted > 0 ? ($three_point_made / $three_point_attempted) * 100 : 0, 2);

        $ft = $free_throw_made . "-" . $free_throw_attempted;
        $ft_percent = number_format($free_throw_attempted > 0 ? ($free_throw_made / $free_throw_attempted) * 100 : 0, 2);

        // Shot data
        $attemptedArr = array();
        $madeArr = array();

        for ($x = 1; $x <= 16; $x++) {
            $attemptedArr[$x] = ShotChart::where('chart_section', $x)
                                //->where('game_id', $game->id)
                                ->whereIn('player_id', $playerIdsArr)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('attempted');
            $madeArr[$x] = ShotChart::where('chart_section', $x)
                                //->where('game_id', $game->id)
                                ->whereIn('player_id', $playerIdsArr)
                                //->whereBetween('created_at', [$min_date->format('Y-m-d 00:00:00'), $max_date->format('Y-m-d 23:59:59')])
                                ->whereIn('game_id', $game_ids)
                                ->sum('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => [
                'points' => $points,
                'rebounds' => $rebounds,
                'assissts' => $assissts,
                'steals' => $steals,
                'blocks' => $blocks,
                'fg' => $fg,
                'fg_percent' => $fg_percent,
                '3pt' => $pt3,
                '3pt_percent' => $pt3_percent,
                'ft' => $ft,
                'ft_percent' => $ft_percent,
                'attemptedArr' => $attemptedArr,
                'madeArr' => $madeArr,
                'possession' => $possession,
                'foul' => $foul,
                'loose_ball' => $loose_ball,
                'charge' => $charge,
                'box_out' => $box_out,
                'hockey_assist_extra_pass' => $hockey_assist_extra_pass,
                'pass_leading_to_foul' => $pass_leading_to_foul,
                'screen_assist' => $screen_assist,
                'tap_back' => $tap_back,
                'rim_run_sprint_the_floor' => $rim_run_sprint_the_floor,
                'off_paint_touch' => $off_paint_touch,
                'deflection' => $deflection,
                'wall_up' => $wall_up,
                'contest_2' => $contest_2,
                'contest_3' => $contest_3,
                'missed_rotation' => $missed_rotation,
                'def_paint_touch' => $def_paint_touch
            ]
        );

        return response()->json($response);
    }

    /**
     * Live data
     */
    public function shot_live_data()
    {
        $game = Game::where('is_active', 1)->first();

        $attemptedArr = array();
        $madeArr = array();

        for ($x = 1; $x <= 16; $x++) {
            $attemptedArr[$x] = ShotChart::where('chart_section', $x)->where('game_id', $game->id)->sum('attempted');
            $madeArr[$x] = ShotChart::where('chart_section', $x)->where('game_id', $game->id)->sum('made');
        }

        $response = array(
            'msg' => 'success',
            'data' => [$attemptedArr, $madeArr]
        );

        return response()->json($response);
    }

    /**
     * All data
     */
    public function shot_all_data()
    {
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
