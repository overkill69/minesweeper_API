<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use App\Games;

class HomeController extends Controller
{
    
    private $_client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->_client = new \GuzzleHttp\Client(['base_uri' => 'http://test.deviget.net/api/']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = $this->_client->request('GET', "users");        
        $body = $response->getBody();        
        $players = json_decode($body);
        
        return view('games.create', ["players" => $players]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function boards()
    {
        
        $response = $this->_client->request('GET', "games");        
        $body = $response->getBody();    
        
        return view('games.index', ["games" => json_decode($body)]);
    }

    /**
     * Display the specified game Grid.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show( $game, request $request)
    {        
        $response = $this->_client->request('GET', "games/".$game);        
        $t = json_decode($response->getBody());                  
        
        return view('grid.show', ["gameP"=>$t]);
    }
}
