<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Ice Cream', '', 'assets/images/icecream.png'],
            ['Crepe', '', 'assets/images/crepe.png'],
            ['Juice', '', 'assets/images/juice.png'],
            ['Cocktails', '', 'assets/images/cocktail.png'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category[0],
                'description' => $category[1],
                'image' => $category[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
