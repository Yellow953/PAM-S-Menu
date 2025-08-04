<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Salty Crepe', '', 'assets/images/crepe.png'],
            ['Sweet Crepe', '', 'assets/images/crepe2.png'],
            ['Pan Cakes', '', 'assets/images/waffle.png'],
            ['Ice Cream', '', 'assets/images/icecream.png'],
            ['Cocktails Juice', '', 'assets/images/cocktail.png'],
            ['Juice Bottles', '', 'assets/images/juice.png'],
            ['Soft Drinks', '', 'assets/images/softdrink.png'],
            ['Waffle', '', 'assets/images/waffle.png'],
            ['Milkshake', '', 'assets/images/milkshake.png'],
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
