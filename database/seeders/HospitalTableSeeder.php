<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = [
            [
                'name' => 'Rumah Sakit Al-Islam',
                'address' => '123 Main St, Springfield',
                'email' => 'rsais@mail.com',
                'phone_number' => '123-456-7890',
            ],
            [
                'name' => 'Rumah Sakit Al-Ihsan',
                'address' => '456 Elm St, Springfield',
                'email' => 'rsaih@mail.com',
                'phone_number' => '123-456-7890',
            ],
            [
                'name' => 'Rumah Sakit Al-Falah',
                'address' => '789 Oak St, Springfield',
                'email' => 'rsaf@mail.com',
                'phone_number' => '123-456-7890',
            ]

        ];

        Hospital::insert($hospitals);
    }
}
