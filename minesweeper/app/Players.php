<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $table = "players";

    public function games()
    {
        return $this->hasMany('App\Games');
    }
}
