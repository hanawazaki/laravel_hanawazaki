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
                'address' => 'Jalan ABC no. 123',
                'email' => 'rsais@mail.com',
                'phone_number' => '123-456-7890',
            ],
            [
                'name' => 'Rumah Sakit Al-Ihsan',
                'address' => 'Jalan XYZ no. 789',
                'email' => 'rsaih@mail.com',
                'phone_number' => '123-456-7890',
            ],
            [
                'name' => 'Rumah Sakit Al-Falah',
                'address' => 'Jalan JKL no. 999',
                'email' => 'rsaf@mail.com',
                'phone_number' => '123-456-7890',
            ]

        ];

        Hospital::insert($hospitals);
    }
}
