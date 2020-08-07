<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    public function players()
    {
        return $this->BelongsTo('App\Players');
    }

    public function grid()
    {
        return $this->HasOne('App\Grids');
    }
}
