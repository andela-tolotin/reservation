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
        'date_scheduled',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'updated_at', 'created_at', 'updated_at'
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

    public function scopeIsReserved($query, $floor, $roomType, $dateScheduled, $timeScheduled)
    {
        return $query
            ->where('floor_id', $floor)
            ->where('room_type_id', $roomType)
            ->where('date_scheduled', $dateScheduled)
            ->where('time_scheduled', $timeScheduled)
            ->where('status', 1)
            ->first();
    }
}
