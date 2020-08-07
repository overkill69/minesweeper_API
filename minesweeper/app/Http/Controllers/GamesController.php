<?php

namespace App\Http\Controllers;

use App\Games;
use App\Players;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::all();
        return view('games.index', ['games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players = Players::all();
        return view('games.create', ["players" =>$players]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if is nrew player creates and then create the game
        if(!$request->input("playerId")){
            $player = new Players();
            $player->name = $request->input("player");
            $player->save();
        }
        $game = new Games();
        $game->name = $request->input("name");
        $game->player_id = ($request->input("playerId") > 0 ? $request->input("playerId") : $player->id);
        $game->size = $request->input("size");
        $game->save();

        return redirect("/games/".$gama->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $games)
    {
        $game = Games::find($games);
        dd($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit(Games $games)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Games $games)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(Games $games)
    {
        //
    }
}
