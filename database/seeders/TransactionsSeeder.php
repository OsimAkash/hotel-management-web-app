<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;

class TransactionsSeeder extends Seeder
{
    public function run()
    {
        // Seed some sample bookings (e.g., book 5 out of 10 rooms)
        $roomType = RoomType::whereRaw('LOWER(name) = ?', ['deluxe room'])->first();
        if (!$roomType) {
            $this->command->error('RoomType "Deluxe Room" not found. No transactions were seeded.');
            return;
        }

        $rooms = Room::where('type_id', $roomType->id)->take(5)->get();
        if ($rooms->isEmpty()) {
            $this->command->warn('No rooms found for Deluxe Room type. No transactions were seeded.');
            return;
        }

        foreach ($rooms as $room) {
            $transaction = Transaction::create([
                'user_id' => 1,
                'room_id' => $room->id,
                'many_room' => 1,
                'check_in' => now()->addDay(),
                'check_out' => now()->addDays(2),
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create a Payment record for the transaction
            Payment::create([
                'user_id' => 1,
                'transaction_id' => $transaction->id,
                'price' => $roomType->price * 2,
                'proof' => 'placeholder_proof.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update the room status to 'booked'
            $room->update(['status' => 'b']);
        }
    }
}