<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grids extends Model
{
    // Allow users to set following fields
	protected $fillable = [
		'width',
		'height',
		'bombs'
	];

	public function squares()
	{
		return $this->hasMany('App\Squares');
    }
    
    public function games()
    {
        return $this->belongsTo('App\Games');
    }
}
