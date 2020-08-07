@extends('layouts.site')

@section('content')            
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-12">New Game</div>
                    </div>
                    <div class="row">
                        <div class="col-12 align-left">Available Games</div>
                    </div>
                    <div class="row row-data header-row">
                            <div class="col-md-3 col-data">Name</div>
                            <div class="col-md-3 col-data">Player</div>
                            <div class="col-md-3 col-data">Size</div>
                            <div class="col-md-3 col-data">Actions</div>
                        </div>
                    @if(count($games) > 0 )
                        @foreach($games as $game)
                        <div class="row row-data">
                            <div class="col-md-3 col-data text-justify">{{ $game->name }}</div>
                            <div class="col-md-3 col-data">{{ $game->player_id }}</div>
                            <div class="col-md-3 col-data">{{ $game->size }} * {{ $game->size }}</div>
                            <div class="col-md-3 col-data">
                                <a href="/games/{{ $game->id }}/play" class="btn btn-primary" role="button">Play</a>
                                <a href="/games/{{ $game->id }}/delete" class="btn btn-danger" role="button">Delete</a>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="row">
                            <div class="col-md-12">
                                There is no available games
                            </div>
                        </div>
                    @endif
                    </div>
                <div class="col-md-3"></div>
            </div>
            
@endsection                