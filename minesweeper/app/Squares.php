<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Squares extends Model
{
    // Allow users to set following fields
	protected $fillable = [
		'x',
		'y',
		'content',
		'discover'
	];

	public function grids()
	{
		return $this->belongsTo('App\Grids', 'grid_id');
	}

}
