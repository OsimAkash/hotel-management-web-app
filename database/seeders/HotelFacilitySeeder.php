<?php

namespace Database\Seeders;

use App\Models\HotelFacility;
use Illuminate\Database\Seeder;

class HotelFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HotelFacility::truncate();
        $facilityRoom = [
            [
                'facility_name' => 'Swimming pool',
                'detail' => 'Large and comfortable swimming pool',
            ],
            [
                'facility_name' => 'Gym',
                'detail' => 'Gym with a modern, cool feel',
            ],
            [
                'facility_name' => 'Sauna',
                'detail' => 'its good anyway',
            ],
            [
                'facility_name' => 'Caffe In Hotel',
                'detail' => 'its good anyway',
            ],
            [
                'facility_name' => 'Toy Museum',
                'detail' => 'its good anyway',
            ],
            [
                'facility_name' => 'Sport Area',
                'detail' => 'its good anyway', 
            ],


        ];

        foreach ($facilityRoom as $key => $value){
            HotelFacility::create($value);
        }
    }
}
