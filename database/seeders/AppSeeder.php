<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        $operating_hours = [
            ['day' => 'Monday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Tuesday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Wednesday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Thursday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Friday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Saturday', 'open' => false, 'opening_hour' => null, 'closing_hour' => null, 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Sunday', 'open' => false, 'opening_hour' => null, 'closing_hour' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('operating_hours')->insert($operating_hours);
    }
}
