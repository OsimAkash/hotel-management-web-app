<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'number',
        'status',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'room_id', 'id');
    }
}
