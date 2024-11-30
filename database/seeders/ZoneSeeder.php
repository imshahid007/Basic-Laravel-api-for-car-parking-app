<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeding data
        Zone::create(['name' => 'Green Zone', 'price_per_hour' => 5]);
        Zone::create(['name' => 'Yellow Zone', 'price_per_hour' => 10]);
        Zone::create(['name' => 'Red Zone', 'price_per_hour' => 20]);
    }
}
