<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [1, 'Mixed Cheese & Ham', '', 1, 4.4, 'assets/images/no_img_sweet.png'],
            [1, 'Mozerella Crepe', '', 1, 3.8, 'assets/images/no_img_sweet.png'],
            [2, 'Bueno Spread Crepe', '', 1, 5.6, 'assets/images/no_img_sweet.png'],
            [2, 'Dark Chocolate Crepe', '', 1, 4.15, 'assets/images/no_img_sweet.png'],
            [2, 'Fettuccine Nutella White Crepe', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [2, 'Fettuccine White Crepe', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [2, 'Fettuccine White Pistachio Crepe', '', 1, 5.5, 'assets/images/no_img_sweet.png'],
            [2, "Hershey's Crepe", '', 1, 4.4, 'assets/images/no_img_sweet.png'],
            [2, 'Kinder Crepe', '', 1, 5.5, 'assets/images/no_img_sweet.png'],
            [2, 'Nutella Crepe', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [2, 'Lotus Crepe', '', 1, 4.4, 'assets/images/no_img_sweet.png'],
            [2, 'Pistachio Crepe', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [2, 'White Chocolate Crepe', '', 1, 3.7, 'assets/images/no_img_sweet.png'],
            [2, 'Mana Crepe', '', 1, 6, 'assets/images/no_img_sweet.png'],
            [3, 'Kinder Pancake Box', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [3, 'Lotus Pancake Box', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [3, 'Nutella Pancake Box', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [3, 'Pistachio Pancake Box', '', 1, 6.1, 'assets/images/no_img_sweet.png'],
            [3, 'Waffle Pain', '', 1, 4, 'assets/images/no_img_sweet.png'],
            [4, 'Ice Cream Cone', '', 1, 2.58, 'assets/images/no_img_sweet.png'],
            [4, 'Ice Cream Cup', '', 1, 3, 'assets/images/no_img_sweet.png'],
            [4, 'Ice Cream 1/2 Kg', '', 1, 6.17, 'assets/images/no_img_sweet.png'],
            [4, 'Ice Cream 1 KG', '', 1, 12.35, 'assets/images/no_img_sweet.png'],
            [7, "Pepsi Can", '', 1, 0.9, 'assets/images/no_img_sweet.png'],
            [7, "Pepsi Diet", '', 1, 0.9, 'assets/images/no_img_sweet.png'],
            [7, "Seven Up", '', 1, 0.9, 'assets/images/no_img_sweet.png'],
            [7, "Seven Diet", '', 1, 0.9, 'assets/images/no_img_sweet.png'],
            [7, "Miranda", '', 1, 0.9, 'assets/images/no_img_sweet.png'],
            [7, "Almaza Light", '', 1, 1.55, 'assets/images/no_img_sweet.png'],
            [7, "Almaza Normal", '', 1, 1.55, 'assets/images/no_img_sweet.png'],
            [7, "Almaza Rose", '', 1, 1.55, 'assets/images/no_img_sweet.png'],
            [7, "Water Small 0.5 L", '', 1, 0.44, 'assets/images/no_img_sweet.png'],
            [7, "Water Large 1 L", '', 1, 0.66, 'assets/images/no_img_sweet.png'],
            [9, "Oreo Milkshake", '', 1, 5, 'assets/images/no_img_sweet.png'],
            [9, "Mango Milkshake", '', 1, 5, 'assets/images/no_img_sweet.png'],
            [9, "Lotus Milkshake", '', 1, 5, 'assets/images/no_img_sweet.png'],
            [9, "Ashta Milkshake", '', 1, 5, 'assets/images/no_img_sweet.png'],
            [9, "Strawberry Milkshake", '', 1, 5, 'assets/images/no_img_sweet.png'],

        ];

        foreach ($products as $product) {
            $pr = Product::create([
                'category_id' => $product[0],
                'name' => $product[1],
                'description' => $product[2],
                'cost' => $product[3],
                'price' => $product[4],
                'image' => $product[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($product[0] ==  1 ||  $product[0] == 2 || $product[0] == 3) {
                $variant = Variant::create([
                    'product_id' => $pr->id,
                    'title' => 'Chocolate Toppings',
                    'type' => 'multiple'
                ]);

                $options = [
                    ['Add Bueno', 1, null],
                    ['Add Flake', 1, null],
                    ["Add Hershey's", 1, null],
                    ['Add Kinder Fingers', 1, null],
                    ['Add Kinder Delice', 1, null],
                    ['Add Kitkat', 1, null],
                    ['Add Lotus', 1, null],
                    ["Add m&m's", 1, null],
                    ['Add Maltesers', 1, null],
                    ['Add Oreo', 1, null],
                    ['Add Snickers', 1, null],
                    ['Add Twix', 1, null],
                    ['Add Brownie', 1, null],
                ];

                foreach ($options as $option) {
                    VariantOption::create([
                        'variant_id' => $variant->id,
                        'value' => $option[0],
                        'price' => $option[1],
                        'quantity' => $option[2],
                    ]);
                }

                $variant = Variant::create([
                    'product_id' => $pr->id,
                    'title' => 'Fruit Toppings',
                    'type' => 'multiple'
                ]);

                $options = [
                    ['Add Banana', 0.5, null],
                    ['Add Kiwi', 0.5, null],
                    ["Add Strawberry", 0.5, null],
                    ['Add Grapes', 0.5, null],
                ];

                foreach ($options as $option) {
                    VariantOption::create([
                        'variant_id' => $variant->id,
                        'value' => $option[0],
                        'price' => $option[1],
                        'quantity' => $option[2],
                    ]);
                }
            }

            if ($product[0] == 4) {
                $variant = Variant::create([
                    'product_id' => $pr->id,
                    'title' => 'Flavors',
                    'type' => 'multiple'
                ]);

                $options = [
                    ['Vanilla', 0, null],
                    ['Chocolate', 0, null],
                    ['Strawberry', 0, null],
                    ['Mango', 0, null],
                    ['Lemon', 0, null],
                    ['Passion Fruit', 0, null],
                    ['Lotus', 0, null],
                    ['Ashta', 0, null],
                    ['Oreo', 0, null],
                    ['Cheese Cake', 0, null],
                    ['Caramel', 0, null],
                    ['Kitkat', 0, null],
                    ['Snickers', 0, null],
                    ['Bubble', 0, null],
                ];

                foreach ($options as $option) {
                    VariantOption::create([
                        'variant_id' => $variant->id,
                        'value' => $option[0],
                        'price' => $option[1],
                        'quantity' => $option[2],
                    ]);
                }
            }
        }

        $other_products = [
            // -------------------------
            // 5: Cocktails Juice (Custom S/M/L)
            // -------------------------
            [
                'category_id' => 5,
                'name' => "3a Zaw2ak Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3.3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.86],
                            ['Large', 1.7],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Apple Juice",
                'description' => "",
                'cost' => 1,
                'price' => 1.66,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.84],
                            ['Large', 1.67],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Avocado and Cocktail",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Avocado",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Karrot",
                'description' => "",
                'cost' => 1,
                'price' => 2,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.77],
                            ['Large', 1.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Cocktail Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Exotic Juice",
                'description' => "",
                'cost' => 1,
                'price' => 9,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 2],
                            ['Large', 5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Extra Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.5],
                            ['Large', 1.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Guava Juice",
                'description' => "",
                'cost' => 1,
                'price' => 2.77,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.5],
                            ['Large', 1.1],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Lemon and Haba2",
                'description' => "",
                'cost' => 1,
                'price' => 2.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.5],
                            ['Large', 1],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Lemon and Mint",
                'description' => "",
                'cost' => 1,
                'price' => 1.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.5],
                            ['Large', 1],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Lemon Ade",
                'description' => "",
                'cost' => 1,
                'price' => 1.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.5],
                            ['Large', 1],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Mango Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Mixed Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3.33,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1.11],
                            ['Large', 2.22],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Orange Juice",
                'description' => "",
                'cost' => 1,
                'price' => 2.22,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.55],
                            ['Large', 1.11],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Passion Fruit",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Remmen Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Special Juice",
                'description' => "",
                'cost' => 1,
                'price' => 5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Strawberry Juice",
                'description' => "",
                'cost' => 1,
                'price' => 2.77,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 0.55],
                            ['Large', 1.11],
                        ]
                    ]
                ]
            ],

            // -------------------------
            // 6: Juice Bottles (0.5L / 1L)
            // -------------------------
            [
                'category_id' => 6,
                'name' => "Lemon",
                'description' => "",
                'cost' => 1,
                'price' => 2.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Apple",
                'description' => "",
                'cost' => 1,
                'price' => 3.33,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.33],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Avocado",
                'description' => "",
                'cost' => 1,
                'price' => 5.55,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 6.66],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "karrots",
                'description' => "",
                'cost' => 1,
                'price' => 3.33,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.33],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Cocktail",
                'description' => "",
                'cost' => 1,
                'price' => 3.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Guava",
                'description' => "",
                'cost' => 1,
                'price' => 8.88,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.88],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Lemon and Haba2",
                'description' => "",
                'cost' => 1,
                'price' => 3.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Lemon and Mint",
                'description' => "",
                'cost' => 1,
                'price' => 2.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Mango",
                'description' => "",
                'cost' => 1,
                'price' => 5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 10],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Mix",
                'description' => "",
                'cost' => 1,
                'price' => 5.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 5.55],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Orange",
                'description' => "",
                'cost' => 1,
                'price' => 3.33,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.33],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Passion Fruit and Orange",
                'description' => "",
                'cost' => 1,
                'price' => 5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 10],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Remmen",
                'description' => "",
                'cost' => 1,
                'price' => 5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 10],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Strawberry",
                'description' => "",
                'cost' => 1,
                'price' => 3.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 3.5],
                        ]
                    ]
                ]
            ],

            // -------------------------
            // 8: Waffle
            // -------------------------
            [
                'category_id' => 8,
                'name' => "White Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 3.65,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 8,
                'name' => "Nutella Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 3.65,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 8,
                'name' => "Lotus Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 3.65,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 8,
                'name' => "White and Kinder Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 4.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.25],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 8,
                'name' => "White Pistachio Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 3.65,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 8,
                'name' => "White Strawberry Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 3.65,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 8,
                'name' => "White Lotus Waffle",
                'description' => "",
                'cost' => 1,
                'price' => 3.65,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['medium', 0],
                            ['large', 2.5],
                        ]
                    ]
                ]
            ],
        ];

        foreach ($other_products as $op) {
            $variants = $op['variants'];
            unset($op['variants']);

            $product = Product::create($op);

            foreach ($variants as $variantData) {
                $variant = Variant::create([
                    'product_id' => $product->id,
                    'title' => $variantData['title'],
                    'type' => $variantData['type'],
                ]);

                foreach ($variantData['options'] as $option) {
                    VariantOption::create([
                        'variant_id' => $variant->id,
                        'value' => $option[0],
                        'price' => $option[1],
                        'quantity' => null,
                    ]);
                }
            }
        }
    }
}
