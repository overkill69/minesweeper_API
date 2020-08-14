@extends('layouts.site')

@section('content')            


            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">                    
                    <div class="row justify-content-center">
                        <div class="col-12 align-left">Available Games</div>
                    </div>
                    <div class="row row-data header-row">
                            <div class="col-md-3 col-data">Name</div>
                            <div class="col-md-3 col-data">Player</div>
                            <div class="col-md-3 col-data">Size</div>
                            <div class="col-md-3 col-data">Actions</div>
                        </div>
                        @foreach($games as $game)
                        <div class="row row-data">
                            <div class="col-md-3 col-data text-justify">{{ $game->name }}</div>
                            <div class="col-md-3 col-data">{{ $game->users->name }}</div>
                            <div class="col-md-3 col-data">{{ $game->size }} * {{ $game->size }}</div>
                            <div class="col-md-3 col-data">
                                <a href="/boards/{{ $game->id }}" class="btn btn-primary" role="button">Play</a>
                                <a href="/boards/{{ $game->id }}/delete" class="btn btn-danger" role="button">Delete</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                <div class="col-md-3"></div>
            </div>
            
@endsection                