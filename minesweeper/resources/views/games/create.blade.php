@extends('layouts.site')

@section('content')            
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-12">New Game</div>
                </div>
                <form action="/games/" method="post" role="form" >
                    @csrf 
                    <div class="row">
                        <div class="col-md-3">Name:</div>
                        <div class="col-md-9  text-justify">
                            <input type="text" name="name" id="name" placeholder="Insert a Name for the game">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">Player:</div>
                        <div class="col-md-9  text-justify">                        
                            @if(count($players) > 0 )
                            <select name="playerId" id="playerId">
                                <option value="0" selected>Select a player</option>
                                @foreach($players as $player )
                                <option value="2">{{ $player->name }}</option>
                                @endforeach
                            </select>
                            @else
                            <input name="player" id="player" placeholder="create a new player"/>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">Size:</div>
                        <div class="col-md-9  text-justify">
                            <select name="size" id="size">
                                <option value="0" selected>Select a board size</option>
                                <option value="2">2 * 2</option>
                                <option value="4">4 * 4</option>
                                <option value="6">6 * 6</option>
                                <option value="8">8 * 8</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="text-center"><button type="submit">Create</button></div>
                </form>
                </div>
                <div class="col-md-3"></div>
            </div>

@endsection