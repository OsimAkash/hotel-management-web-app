<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = [
            [
                'name' => 'Osim Roy',
                'email' => 'osim123@gmail.com',
                'phone' => '0812345678901',
                'password' => bcrypt('osim123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Raihan Ahammed',
                'email' => 'raihan@gmail.com',
                'phone' => '0812345678901',
                'role' => 'customer',
                'password' => bcrypt('raihan123'),
            ],
            [
                'name' => 'Sultana Nasrin',
                'email' => 'sultana@gmail.com',
                'phone' => '0812345678901',
                'role' => 'customer',
                'password' => bcrypt('sultana123'),
            ],
            [
                'name' => 'Kawsar',
                'email' => 'kawsar@gmail.com',
                'phone' => '0812345678901',
                'role' => 'resepsionis',
                'password' => bcrypt('kawsar123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
