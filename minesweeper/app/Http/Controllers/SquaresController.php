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
    public function valildateClick( $game,Request $request)
    {   
        $sqr = Squares::findOrFail( $request->input("sqareId") );     
        $event = $request->input("event");
        switch ($event){
            case "reveal":
                $resp = $this->_revealSquares($sqr);
            break;

            case "question":
                $this->_questionCell();
            break;

            case "flag";
                $this->_flagCell();
            break;
        }

        //$resp= array($sqr->content,$sqr->id);
        return $resp;
                 
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
        
        // si tiene superior, si tiene inferior, si siene a la derecha, si tiene a la izq ....
        if($sqr->x > 1){
            $up = Squares::where('x','=',($sqr->x - 1))->where("y","=", $sqr->y)->get();      
            $upLeft = Squares::where('x','=',($sqr->x - 1))->where("y","=", ($sqr->y - 1))->get();            
            $upRight = Squares::where('x','=',($sqr->x - 1))->where("y","=", ($sqr->y + 1))->get();            
        }

        if($sqr->x < $grid->height){
            $down = Squares::where('x','=',($sqr->x + 1))->where("y","=", $sqr->y)->get();            
            $downLeft = Squares::where('x','=',($sqr->x + 1))->where("y","=", ($sqr->y - 1))->get();            
            $downRight = Squares::where('x','=',($sqr->x + 1))->where("y","=", ($sqr->y + 1))->get();                            
        }
        
        if($sqr->y > 1){
            $left = Squares::where('y','=',($sqr->y - 1))->where("x","=", $sqr->x)->get();
        } elseif() {

        }
        
        if($sqr->y < $grid->width){
            $right = Squares::where('y','=',($sqr->y + 1))->where("x","=", $sqr->x)->get();
        }
        
            dd($up);
            if( isset($up->content) && $up->content !== 10){
                $reveal[1] = $up;            
            } else {
                $reveal[1] = $up->id ." BOMB";            
            }
            
            if(isset($down->content) && $down->content !== 10){
                $reveal[2] = $down;
            } else {
                $reveal[2] = $down->id ." BOMB";            
            }

            if(isset($left->content) && $left->content !== 10){
                $reveal[3] = $left;
            } else {
                $reveal[3] = $left->id ." BOMB";            
            }

            if(isset($right->content) && $right->content !== 10){
                $reveal[4] = $right;
            } else {
                $reveal[4] = $right->id ." BOMB";            
            }
            
            if(isset($upLeft->content) && $upLeft->content !== 10){
                $reveal[5] = $upLeft;            
            } else {
                $reveal[5] = $upLeft->id ." BOMB";            
            }
            
            if(isset($downLeft->content) && $downLeft->content !== 10){
                $reveal[6] = $downLeft;
            } else {
                $reveal[6] = $downLeft->id ." BOMB";            
            }

            if(isset($upRight->content) && $upRight->content !== 10){
                $reveal[7] = $upRight;
            } else {
                $reveal[7] = $upRight->id ." BOMB";            
            }

            if(isset($downRight->content) && $downRight->content !== 10){
                $reveal[8] = $downRight;
            } else {
                $reveal[8] = $downRight->id ." BOMB";            
            }


        return($reveal);
     }
}
