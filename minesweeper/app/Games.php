<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    public function player()
    {
        return $this->HasOne('App\Players');
    }
}
