<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($team_id)
    {
        $team = Team::find($team_id);

        return view('player.create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'team_id' => 'required',
            'number' => 'required',
            'name' => 'required'
        ]);

        $newPlayer = Player::create([
            'number' => request('number'),
            'name' => request('name'),
            'position' => request('position'),
            'tagline' => request('tagline')
        ]);

        // create team player relation
        TeamPlayer::create([
            'team_id' => request('team_id'),
            'player_id' => $newPlayer->id,
        ]);

        return redirect()->route('team_show', request('team_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::find($id);

        return view('player.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'number' => 'required',
            'name' => 'required'
        ]);

        $player = Player::find($id);

        $player->number = request('number');
        $player->name = request('name');
        $player->position = request('position');
        $player->tagline = request('tagline');

        $player->save();

        return redirect()->route('options_teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }
}
