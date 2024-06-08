<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        Location::create([
            'name' => 'Sample Location 1',
            'description' => 'This is a description for Sample Location 1',
            'latitude' => 31.7683,
            'longitude' => 35.2137,
        ]);

        Location::create([
            'name' => 'Sample Location 2',
            'description' => 'This is a description for Sample Location 2',
            'latitude' => 32.0853,
            'longitude' => 34.7818,
        ]);
    }
}
