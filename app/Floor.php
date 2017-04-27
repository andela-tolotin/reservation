<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'code', 
        'description',
    ];

    public function reservation()
    {
    	return $this->hasMany('App\Reservation');
    }
}
