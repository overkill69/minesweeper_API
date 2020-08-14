<?php

namespace App\Http\Controllers;

use App\Games;
use App\User;
use App\Grids;
use App\Squares;
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
        
        $games = Games::with('users')->get();      
        return response()->json($games,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if is new player creates and then create the game

        if(!$request->input("playerId")){
            $player = new Players();
            $player->name = $request->input("player");
            $player->save();
        }
        $grid = new Grids();
        $grid->width = $grid->height = $request->input("size");
        $grid->bombs = $request->input("num-bombs");
        $grid->save();
        /* Set the bombs*/
        $bombs = array();

		$max_square = $request->input('size') * $request->input('size');
		$array_squares = range(1, $max_square);
		shuffle($array_squares);
		$bombs = array_slice($array_squares, 0, $request->input("num-bombs"));
        /* */
        $this->setSquares($bombs, $request->input("size"), $grid->id);
        /*** */
        $game = new Games();
        $game->name = $request->input("name");
        $game->user_id = ($request->input("playerId") > 0 ? $request->input("playerId") : $player->id);
        $game->size = $request->input("size");
        $game->grid_id = $grid->id;
        $game->save();

        return redirect("/boards");
        return response()->json([
            "message" => "game record created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $game)
    {
        $thisGame = Games::findOrFail($game->id)->with('grid.squares')->get();
        
        return response()->json([
            "game" => $thisGame
        ], 200);
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

    

    private function setSquares( $bombs, $size, $grid_id )
	{
		for ($i=1; $i <= $size; $i++) { 
			for ($j=1; $j <= $size; $j++) { 

				$number = in_array( ((($i-1)*$size) + $j) , $bombs) ? 10 : 0;

				$square = new Squares;
				$square->grids_id = $grid_id;
				$square->x = $j;
				$square->y = $i;
				$square->discover = false;
				$square->content = $number;
				$square->save();
			}
		}
    }

}
