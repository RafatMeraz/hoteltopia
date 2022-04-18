<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    // add a new hotel
    public function addNewHotel(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required',
        ]);

        $result = DB::table('hotel')->insert([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'stars' => $request->get('stars'),
            'created_at' => Date::now()
        ]);

        if ($result) {
            return response([
                'status' => 200,
                'message' => 'Hotel added successfully'
            ], 200);
        } else {
            return response([
                'status' => 500,
                'message' => 'Hotel added failed! Try again'
            ], 500);
        }
    }

    public function updateHotel(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required',
        ]);

        $result = DB::table('hotel')
            ->where('id', $request->get('hotel_id'))
            ->update([
                'name' => $request->get('name'),
                'address' => $request->get('name'),
                'stars' => $request->get('name'),
                'updated_at' => Date::now()
            ]);
        if ($result > 0) {
            return response([
                'status' => 200,
                'message' => 'Hotel data updated'
            ]);
        } else {
            return response([
                'status' => 500,
                'message' => 'Something went wrong.Try again'
            ]);
        }
    }

    public function deleteHotel(Request $request) {
        $request->validate([
            'hotel_id' => 'required'
        ]);

        $result = DB::table('hotel')
            ->where('id', $request->get('hotel_id'))
            ->delete();
        if ($result > 0) {
            return response([
                'status' => 200,
                'message' => 'Hotel data deleted'
            ]);
        } else {
            return response([
                'status' => 500,
                'message' => 'Something went wrong.Try again'
            ]);
        }
    }
}
