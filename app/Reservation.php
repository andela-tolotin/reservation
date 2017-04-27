<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'floor_id', 
        'room_type_id', 
        'time_scheduled',
        'status',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function floor()
    {
    	return $this->belongsTo('App\Floor');
    }

    public function roomType()
    {
    	return $this->belongsTo('App\RoomType');
    }
}
