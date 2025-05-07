<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Log;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to safely truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate in child-to-parent order
        Transaction::truncate();
        Payment::truncate();
        Log::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Call seeders in proper dependency order
        $this->call([
            UserSeeder::class,
            RoomTypeSeeder::class,       // ← must come before RoomSeeder
            RoomFacilitySeeder::class,
            RoomSeeder::class,
            HotelFacilitySeeder::class,
            TransactionsSeeder::class,   // ← comes last as it depends on bookings/payments
        ]);
    }
}
