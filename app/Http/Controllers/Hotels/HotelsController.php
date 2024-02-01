<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Models\Apartment\Apartment;
use App\Models\Booking\Booking;
use App\Models\Hotel\Hotel;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelsController extends Controller
{
    public function rooms($id){

        $getRooms = Apartment::select()->orderBy('id', 'desc')->take(6)->where('hotel_id', $id)->get();

        return view('hotels.rooms', compact('getRooms'));

    }

    public function roomDetails($id){

        $getRoom = Apartment::find($id);

        return view('hotels.roomdetails', compact('getRoom'));
    }

    public function roomBooking(Request $request, $id){

        $room = Apartment::find($id);
        $hotel = Hotel::find($id);

        if(date("Y/m/d") < $request->check_in AND date("Y/m/d") < $request->check_out){

            if($request->check_in < $request->check_out){

                $date1 = new DateTime($request->check_in);
                $date2 = new DateTime($request->check_out);
                $interval =  $date1->diff($date2);
                $days = $interval->format('%a');

                $bookRooms = Booking::create([

                    "name" => $request->name,
                    "email" => $request->email,
                    "phone_number" => $request->phone_number,
                    "check_in" => $request->check_in,
                    "check_out" => $request->check_out,
                    "days" => $days,
                    "price" => 0,
                    "user_id" => Auth::user()->id,
                    "room_name" => $room->name,
                    "hotel_name" => $hotel->name,
                    "name" => $request->name,

                ]);
            }
            else{
                echo "Check out date should be greater than check in date";
            }
            
        }
        else{
            echo "Choose dates in the future, invalid check in or checkout dates";
        }

    }

}
