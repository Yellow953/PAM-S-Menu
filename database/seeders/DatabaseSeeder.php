<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AppSeeder::class,
            CurrencySeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
