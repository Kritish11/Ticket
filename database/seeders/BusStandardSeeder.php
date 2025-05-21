<?php

namespace Database\Seeders;

use App\Models\BusStandard;
use Illuminate\Database\Seeder;

class BusStandardSeeder extends Seeder
{
    public function run()
    {
        $standards = [
            ['name' => 'Luxury Sleeper', 'description' => 'Premium sleeper bus with extra comfort'],
            ['name' => 'Semi Sleeper', 'description' => 'Mid-range sleeper bus'],
            ['name' => 'Seater', 'description' => 'Standard seating bus']
        ];

        foreach ($standards as $standard) {
            BusStandard::create($standard);
        }
    }
}
