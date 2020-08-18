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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $games)
    {
        //dd($games);
        $thisGame = Games::where("id", "=", $games)->with('grid.squares')->get();
        dd($thisGame);
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
        $event = $request->input("event");
        
        switch ($event){
            case "reveal":
                $sqr = Squares::findOrFail( $request->input("sqareId") );     
                $resp = $this->_revealSquares($sqr);
            break;

            case "updateStatus":
                if($request->input("status") == "question"){
                    $sqr = Squares::findOrFail( $request->input("sqareId") );     
                    $this->_questionCell();
                } else {
                    $sqr = Squares::findOrFail( $request->input("sqareId") );     
                    $this->_flagCell();
                }
                
            break;

            case "revealAllBombs":                
                $sqr = Squares::findOrFail( $request->input("sqareId") );     
                $resp = $this->_revealBombs( $sqr );
            break;
        }
        return $resp;    
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

    private function _revealBombs( Squares $sqr ){
        
        $sq = Squares::where("content", "=", 10 )->where('grids_id','=',$sqr->grids_id)->get();
        return $sq;
    }

    private function _revealSquares( Squares $sqr)
    {
        $content = $sqr->content;
        if($content !== "10"){
            $surroundings = $this->_chechSurroundingSquares($sqr);
        } else {            
            $game = Games::where('grid_id', "=",$sqr->grids_id)->first();
            dd($game);
            return "Boom!";
        }
        return $surroundings;
    }

    /**
     * find the surrouding squares to th given
     * 
     * @param $sqr Square
     * @return $response array
     */

     private function _chechSurroundingSquares($sqr)
     {
        $reveal = [];
        $sq = Squares::where("id", "=", $sqr->id )->first();
        $sq->discover = 1;
        
        $sq->save();
        $reveal[0] = $sqr;        
        $grid = Grids::findOrFail($sqr->grids_id);
        
        // check if there's a square up
        if($sqr->x > 1){
            $up = Squares::where('x','=',($sqr->x - 1))->where("y","=", $sqr->y)->where('grids_id','=',$sqr->grids_id)->first();                  
            $up->discover = 1;
            $up->save();
        }
        // check if there's a square up left
        if($sqr->x > 1 && $sqr->y > 1 ){
            $upLeft = Squares::where('x','=',($sqr->x - 1))->where("y","=", ($sqr->y - 1))->where('grids_id','=',$sqr->grids_id)->first();
            $upLeft->discover = 1 ;
            $upLeft->save();
        }
        // check if there's a square left
        if($sqr->y > 1 ){
            $left = Squares::where('y','=',($sqr->y - 1))->where("x","=", $sqr->x)->where('grids_id','=',$sqr->grids_id)->first();
            $left->discover = 1 ;
            $left->save();
        }
        // check if there's a square down left
        if($sqr->x < $grid->height && $sqr->y > 1 ){            
            $downLeft = Squares::where('x','=',($sqr->x + 1))->where("y","=", ($sqr->y - 1))->where('grids_id','=',$sqr->grids_id)->first();            
            $downLeft->discover = 1 ;
            $downLeft->save();
        }
        //check if tere's a sqaure down
        if($sqr->x < $grid->height){
            $down = Squares::where('x','=',($sqr->x + 1))->where("y","=", $sqr->y)->where('grids_id','=',$sqr->grids_id)->first();                        
            $down->discover = 1 ;
            $down->save();
        }
        // check if there's a square down right
        if($sqr->x < $grid->height && $sqr->y < $grid->width ){            
            $downRight = Squares::where('x','=',($sqr->x + 1))->where("y","=", ($sqr->y + 1))->where('grids_id','=',$sqr->grids_id)->first();            
            $downRight->discover = 1 ;
            $downRight->save();
        }
        //check if tere's a sqaure right
        if($sqr->y < $grid->width){
            $right = Squares::where('y','=',($sqr->y + 1))->where("x","=", $sqr->x)->where('grids_id','=',$sqr->grids_id)->first();                        
            $right->discover = 1 ;
            $right->save();
        }
        // check if there's a square up right
        if($sqr->x > 1 && $sqr->y < $grid->width ){            
            $upRight = Squares::where('x','=',($sqr->x - 1))->where("y","=", ($sqr->y + 1))->where('grids_id','=',$sqr->grids_id)->first();            
            $upRight->discover = 1 ;
            $upRight->save();
        }
        
        if( true === ( isset($up)) && $up->content !== 10){
            $reveal[1] = $up;            
        } else {
            $reveal[1] = "BOMB";            
        }

        if(isset($down) && $down->content !== 10){
            $reveal[2] = $down;
        } else {
            $reveal[2] = "BOMB";            
        }
        
        if(isset($left) && $left->content !== 10){
            $reveal[3] = $left;
        } else {
            $reveal[3] = "BOMB";            
        }

        if(isset($right) && $right->content !== 10){
            $reveal[4] = $right;
        } else {
            $reveal[4] = "BOMB";            
        }
        
        if(isset($upLeft) && $upLeft->content !== 10){
            $reveal[5] = $upLeft;            
        } else {
            $reveal[5] = "BOMB";            
        }
        
        if(isset($downLeft) && $downLeft->content !== 10){
            $reveal[6] = $downLeft;
        } else {
            $reveal[6] = "BOMB";            
        }

        if(isset($upRight) && $upRight->content !== 10){
            $reveal[7] = $upRight;
        } else {
            $reveal[7] = "BOMB";            
        }

        if(isset($downRight) && $downRight->content !== 10){
            $reveal[8] = $downRight;
        } else {
            $reveal[8] = "BOMB";            
        }
                
        return($reveal);
     }
}
