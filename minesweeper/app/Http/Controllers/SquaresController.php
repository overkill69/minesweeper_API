<?php

namespace App\Http\Controllers;

use App\Squares;
use App\Grids;
use Illuminate\Http\Request;

class SquaresController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Squares  $squares
     * @return \Illuminate\Http\Response
     */
    public function show(Squares $squares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Squares  $squares
     * @return \Illuminate\Http\Response
     */
    public function edit(Squares $squares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Squares  $squares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Squares $squares)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Squares  $squares
     * @return \Illuminate\Http\Response
     */
    public function destroy(Squares $squares)
    {
        //
    }

    /**
     * Validate if the square is a Bomb or not
     * 
     * @param $square
     * @return \Illuminate\Http\Response
     */
    public function valildateClick( $game, Request $request)
    {   
        
        $event = $request->input("event");
        switch ($event){
            case "reveal":
                $sqr = Squares::findOrFail( $request->input("sqareId") );     
                $resp = $this->_revealSquares($sqr);
            break;

            case "question":
                $sqr = Squares::findOrFail( $request->input("sqareId") );     
                $this->_questionCell();
            break;

            case "flag";
                $sqr = Squares::findOrFail( $request->input("sqareId") );     
                $this->_flagCell();
            break;

            case "revealAllBombs":                
                $resp = $this->_revealBombs();
            break;
        }
        return $resp;                 
    }

    private function _revealBombs(){
        $sqr = Squares::where("content", "=", 10 )->get();
        return $sqr;
    }

    private function _revealSquares( Squares $sqr)
    {
        $content = $sqr->content;
        if($content !== "10"){
            $surroundings = $this->chechSurroundingSquares($sqr);
        } else {
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

     private function chechSurroundingSquares($sqr)
     {
        $reveal = [];
        $reveal[0] = $sqr;
        $grid = Grids::findOrFail($sqr->grids_id);
        
        // check if there's a square up
        if($sqr->x > 1){
            $up = Squares::where('x','=',($sqr->x - 1))->where("y","=", $sqr->y)->get();                  
        }
        // check if there's a square up left
        if($sqr->x > 1 && $sqr->y > 1 ){
            $upLeft = Squares::where('x','=',($sqr->x - 1))->where("y","=", ($sqr->y - 1))->get();
        }
        // check if there's a square left
        if($sqr->y > 1 ){
            $left = Squares::where('y','=',($sqr->y - 1))->where("x","=", $sqr->x)->get();
        }
        // check if there's a square down left
        if($sqr->x < $grid->height && $sqr->y > 1 ){            
            $downLeft = Squares::where('x','=',($sqr->x + 1))->where("y","=", ($sqr->y - 1))->get();            
        }
        //check if tere's a sqaure down
        if($sqr->x < $grid->height){
            $down = Squares::where('x','=',($sqr->x + 1))->where("y","=", $sqr->y)->get();                        
        }
        // check if there's a square down right
        if($sqr->x < $grid->height && $sqr->y < $grid->width ){            
            $downRight = Squares::where('x','=',($sqr->x + 1))->where("y","=", ($sqr->y + 1))->get();            
        }
        //check if tere's a sqaure right
        if($sqr->y < $grid->width){
            $right = Squares::where('y','=',($sqr->y + 1))->where("x","=", $sqr->x)->get();                        
        }
        // check if there's a square up right
        if($sqr->x > 1 && $sqr->y < $grid->width ){            
            $upRight = Squares::where('x','=',($sqr->x - 1))->where("y","=", ($sqr->y + 1))->get();            
        }
        
        if( true === ( isset($up)) && $up[0]->content !== 10){
            $reveal[1] = $up[0];            
        } else {
            $reveal[1] = "BOMB";            
        }

        if(isset($down) && $down[0]->content !== 10){
            $reveal[2] = $down[0];
        } else {
            $reveal[2] = "BOMB";            
        }
        
        if(isset($left) && $left[0]->content !== 10){
            $reveal[3] = $left[0];
        } else {
            $reveal[3] = "BOMB";            
        }

        if(isset($right) && $right[0]->content !== 10){
            $reveal[4] = $right[0];
        } else {
            $reveal[4] = "BOMB";            
        }
        
        if(isset($upLeft) && $upLeft[0]->content !== 10){
            $reveal[5] = $upLeft[0];            
        } else {
            $reveal[5] = "BOMB";            
        }
        
        if(isset($downLeft) && $downLeft[0]->content !== 10){
            $reveal[6] = $downLeft[0];
        } else {
            $reveal[6] = "BOMB";            
        }

        if(isset($upRight) && $upRight[0]->content !== 10){
            $reveal[7] = $upRight[0];
        } else {
            $reveal[7] = "BOMB";            
        }

        if(isset($downRight) && $downRight[0]->content !== 10){
            $reveal[8] = $downRight[0];
        } else {
            $reveal[8] = "BOMB";            
        }

        return($reveal);
     }
}
