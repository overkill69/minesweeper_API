<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $table = "players";

    public function game()
    {
        return $this->belongsTo('App\Games');
    }
}
