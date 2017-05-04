<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function update(Request $request, $id)
    {
        if ($request->has('user_id') &&
            $request->has('floor_id') &&
            $request->has('room_type_id') && 
            $request->has('time_scheduled') && 
            $request->has('date_scheduled')
        ) {
            $reservation = Reservation::findOneById($id);

            if (! $reservation instanceof Reservation) {
                return response()->json(['status' => false, 'message' => 'Reservation does not exist']);
            }

            $reservation->update([
                'user_id' => $request->user_id,
                'floor_id' => $request->floor_id,
                'room_type_id' => $request->room_type_id, 
                'time_scheduled' => $request->time_scheduled,
                'date_scheduled' => $request->date_scheduled,
                'status' => 1,
            ]);

            if ($reservation instanceof Reservation) {
                return response()->json(['status' => true, 'message' => 'Reservation Updated Successful!']);
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $reservation = Reservation::findOneById($id);

        if (! $reservation instanceof Reservation) {
            return response()->json(['status' => false, 'message' => 'Reservation does not exist']);
        }

        return response()->json([
            'status' => true, 
            'message' => 'Reservation available',
            'data' => $reservation,
        ]);
    }


    public function delete(Request $request, $id)
    {
        $reservation = Reservation::findOneById($id);

        if (! $reservation instanceof Reservation) {
            return response()->json(['status' => false, 'message' => 'Reservation does not exist']);
        }
        // Delete the reservation and remove it from the reservation table
        $reservation->forceDelete();

        return response()->json([
            'status' => true, 
            'message' => 'Reservation deleted Successfully!',
        ]);
    }

    public function save(Request $request)
    {
    	if ($request->has('user_id') &&
    		$request->has('floor_id') &&
    		$request->has('room_type_id') && 
    		$request->has('time_scheduled') && 
    		$request->has('date_scheduled')
    	) {
    		$reservation = Reservation::isReserved(
    			$request->floor_id, $request->room_type_id, $request->date_scheduled, $request->time_scheduled
    		);

    		if ($reservation instanceof Reservation) {
    			return response()->json(['status' => false, 'message' => 'Room has been occupied']);
    		}

    		$reservation = Reservation::Create([
    			'user_id' => $request->user_id, 
		   		'floor_id' => $request->floor_id, 
		        'room_type_id' => $request->room_type_id, 
		        'time_scheduled' => $request->time_scheduled,
		        'date_scheduled' => $request->date_scheduled,
		        'status' => 1,
    		]);

    		if ($reservation instanceof Reservation) {
    			return response()->json(['status' => true, 'message' => 'Reservation Successful!']);
    		}
    	}
    }

    public function all(Request $request, $user_id)
    {
    	$user = User::findOneById($user_id);

    	if ($user instanceof User) {
    		$reservations = $user->reservations;
    		return response()->json([
				'status' => true, 
				'message' => 'Reservations',
				'data' => $reservations,
    		]);
    	}

    	return response()->json(['status' => false, 'message' => 'Error occured while fetching reservations!']);
    }
}
