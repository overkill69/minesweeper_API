<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function grid()
    {
        return $this->hasOne('App\Grids', "id");
    }
}
