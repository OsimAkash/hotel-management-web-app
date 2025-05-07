<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the rooms table
        Room::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Room seed data
        $room = [
            ['type_id' => '1', 'number' => '101', 'status' => 'v'],
            ['type_id' => '1', 'number' => '102', 'status' => 'v'],
            ['type_id' => '1', 'number' => '103', 'status' => 'v'],
            ['type_id' => '1', 'number' => '104', 'status' => 'v'],
            ['type_id' => '1', 'number' => '105', 'status' => 'v'],
            ['type_id' => '1', 'number' => '106', 'status' => 'v'],
            ['type_id' => '1', 'number' => '107', 'status' => 'v'],
            ['type_id' => '1', 'number' => '108', 'status' => 'v'],
            ['type_id' => '1', 'number' => '109', 'status' => 'v'],
            ['type_id' => '1', 'number' => '110', 'status' => 'v'],
            ['type_id' => '2', 'number' => '201', 'status' => 'v'],
            ['type_id' => '2', 'number' => '202', 'status' => 'v'],
            ['type_id' => '2', 'number' => '203', 'status' => 'v'],
            ['type_id' => '2', 'number' => '204', 'status' => 'v'],
            ['type_id' => '2', 'number' => '205', 'status' => 'v'],
            ['type_id' => '2', 'number' => '206', 'status' => 'v'],
            ['type_id' => '2', 'number' => '207', 'status' => 'v'],
            ['type_id' => '2', 'number' => '208', 'status' => 'v'],
            ['type_id' => '2', 'number' => '209', 'status' => 'v'],
            ['type_id' => '2', 'number' => '210', 'status' => 'v'],
            ['type_id' => '3', 'number' => '301', 'status' => 'v'],
            ['type_id' => '3', 'number' => '302', 'status' => 'v'],
            ['type_id' => '3', 'number' => '303', 'status' => 'v'],
            ['type_id' => '3', 'number' => '304', 'status' => 'v'],
            ['type_id' => '3', 'number' => '305', 'status' => 'v'],
            ['type_id' => '3', 'number' => '306', 'status' => 'v'],
            ['type_id' => '3', 'number' => '307', 'status' => 'v'],
            ['type_id' => '3', 'number' => '308', 'status' => 'v'],
            ['type_id' => '3', 'number' => '309', 'status' => 'v'],
            ['type_id' => '3', 'number' => '310', 'status' => 'v'],
        ];

        // Insert rooms
        foreach ($room as $value) {
            Room::create($value);
        }
    }
}