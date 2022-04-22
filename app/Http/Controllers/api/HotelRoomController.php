<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function response;

class HotelRoomController extends Controller
{
    // get all hotel rooms of a hotel
    public function getHotelRooms($hotelId)
    {
        try {
            $rooms = DB::table('hotel_room')
                ->where('hotel_id', '=', $hotelId)
                ->get();
            return response([
                'status' => 200,
                'rooms' => $rooms
            ]);
        } catch (\Exception $exception) {
            return response([
                'status' => 500,
                'message' => 'Something went wrong. Try again'
            ], 500);
        }
    }
}
