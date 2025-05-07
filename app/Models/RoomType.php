<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'type_rooms'; // Explicitly define the table name
    protected $fillable = ['name', 'price', 'available_rooms', 'facilities', 'information', 'foto'];
    public function getTotalRooms()
    {
        $checkIn = request()->get('check_in_date') ? Carbon::parse(request()->get('check_in_date')) : now();
        $checkOut = request()->get('check_out_date') ? Carbon::parse(request()->get('check_out_date')) : now()->addDay();
    
        return $this->hasMany(Room::class, 'type_id', 'id')
            ->where('status', '=', 'v')
            ->whereDoesntHave('transactions', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($subQ) use ($checkIn, $checkOut) {
                    $subQ->whereBetween('check_in', [$checkIn, $checkOut])
                         ->orWhereBetween('check_out', [$checkIn, $checkOut])
                         ->orWhere(function ($q) use ($checkIn, $checkOut) {
                             $q->where('check_in', '<=', $checkIn)
                               ->where('check_out', '>=', $checkOut);
                         });
                })->whereIn('status', ['pending', 'confirmed']);
            })->count();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id'); 
    }
}