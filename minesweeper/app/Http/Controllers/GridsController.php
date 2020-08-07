<?php

namespace App\Http\Controllers;

use App\Grids;
use App\Squares;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GridsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->game_id){
            dd("create and go");
        } else {
            dd("load and cpntinue");
        }
        
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
     * @param  \App\grids  $grids
     * @return \Illuminate\Http\Response
     */
    public function show(grids $grids)
    {
        $grid = Grids::firstOrFail();
		return view('grid.show', compact('grid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\grids  $grids
     * @return \Illuminate\Http\Response
     */
    public function edit(grids $grids)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\grids  $grids
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, grids $grids)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\grids  $grids
     * @return \Illuminate\Http\Response
     */
    public function destroy(grids $grids)
    {
        //
    }

    /**
     * Genetate the grid properly
     * 
     * @param $bombs = amount of bombs
     * @param $width = Grid length
     * @param $height = Grid length
     * @param $grid_id = Grid to generate the squares
     * 
     */
    
}
