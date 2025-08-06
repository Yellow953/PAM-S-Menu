<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        $operating_hours = [
            ['day' => 'Monday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Tuesday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Wednesday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Thursday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Friday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Saturday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['day' => 'Sunday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '12:00 PM', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('operating_hours')->insert($operating_hours);
    }
}
