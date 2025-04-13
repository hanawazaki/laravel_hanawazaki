<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'name' => 'Asep Suhendar',
                'address' => 'Kota Bandung',
                'phone_number' => '123-456-7890',
                'hospital_id' => 1,
            ],
            [
                'name' => 'Nanang Ismail',
                'address' => 'Kab Bandung Barat',
                'phone_number' => '123-456-7890',
                'hospital_id' => 1,
            ],
            [
                'name' => 'Mamang Osa',
                'address' => 'Cimahi',
                'phone_number' => '123-456-7890',
                'hospital_id' => 2,
            ],
            [
                'name' => 'Ujang Suryana',
                'address' => 'Bandung Timur',
                'phone_number' => '123-456-7890',
                'hospital_id' => 3,
            ],
            [
                'name' => 'Dadang Sukmana',
                'address' => 'Bandung Tengah',
                'phone_number' => '123-456-7890',
                'hospital_id' => 3,
            ],
        ];

        Patient::insert($patients);
    }
}
