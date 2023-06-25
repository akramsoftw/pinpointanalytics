<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayList;
use App\Models\Setting;

class OptionsController extends Controller
{
    /**
     * Options index
     */
    public function index()
    {
        $session = Setting::where('setting_name', 'session')->first();
        $stats_dataset = Setting::where('setting_name', 'stats_dataset')->first();

        return view('options.index', compact('session', 'stats_dataset'));
    }

    /**
     * Game index page
     */
    public function game()
    {
        $games = Game::where('is_practice', 0)->get();

        return view('options.game.index', compact('games'));
    }

    /**
     * Practice index page
     */
    public function practice()
    {
        $games = Game::where('is_practice', 1)->get();

        return view('options.practice.index', compact('games'));
    }

    /**
     * Teams index page
     */
    public function teams()
    {
        $teams = Team::all();

        return view('options.team.index', compact('teams'));
    }

    /**
     * Play list index page
     */
    public function play_list()
    {
        $playList = PlayList::all();

        return view('options.play_list.index', compact('playList'));
    }

    /**
     * Set session
     * practice / game
     */
    public function set_session(Request $request)
    {
        $this->validate($request, [
            'session' => 'required'
        ]);

        $session = Setting::updateOrCreate(
            ['setting_name'   => 'session'],
            ['setting_value'     => request('session')]
        );

        // Reset active status
        Game::where('is_active', 1)->update(['is_active' => 0]);

        $response = array(
            'msg' => 'success',
            'data' => $session,
        );
        return response()->json($response);
    }
}
