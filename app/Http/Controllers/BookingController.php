<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request) {
        $booking = new Booking();
        $booking->name = $request->name;
        $booking->room_id = $request->room_id; // Ensure room_id is passed
        $booking->save();
    
        // Update room availability
        $room = Room::find($request->room_id);
        $room->booked_rooms += 1; // Or adjust based on booking quantity
        $room->save();
    
        return redirect()->back()->with('success', 'Booking successful!');
    }

    public function show($id)
{
    $room = RoomType::findOrFail($id);
    return view('rooms.show', compact('room'));
}
}