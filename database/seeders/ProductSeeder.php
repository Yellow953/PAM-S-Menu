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
            [1, 'Mixed Cheese & Ham', '', 1, 5.5, 'assets/images/mixed-ham-and-cheese.jpg'],
            [1, 'Mozerella Crepe', '', 1, 4, 'assets/images/mozerella-crepe.jpg'],
            [2, 'Bueno Spread Crepe', '', 1, 6, 'assets/images/bueno-spread-crepe.jpg'],
            [2, 'Dark Chocolate Crepe', '', 1, 4.5, 'assets/images/no_img_sweet.png'],
            [2, 'Fettuccine Nutella White Crepe', '', 1, 5.5, 'assets/images/fettuccine-nutella-white.jpeg'],
            [2, 'Fettuccine White Crepe', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [2, 'Fettuccine White Pistachio Crepe', '', 1, 7, 'uploads/products/Fettuccine-white-pistachio.png'],
            [2, "Hershey's Crepe", '', 1, 6, 'assets/images/hersheys-crepe.jpg'],
            [2, 'Kinder Crepe', '', 1, 7, 'assets/images/kinder-crepe.jpg'],
            [2, 'Nutella Crepe', '', 1, 5, 'assets/images/no_img_sweet.png'],
            [2, 'Lotus Crepe', '', 1, 4.5, 'uploads/products/Lottus-crepe.png'],
            [2, 'Pistachio Crepe', '', 1, 6, 'assets/images/pistachio-crepe.jpg'],
            [2, 'White Chocolate Crepe', '', 1, 3.7, 'White-chocolate-crepe.jpg'],
            [2, 'Mana Crepe', '', 1, 6, 'assets/images/no_img_sweet.png'],
            [3, 'Kinder Pancake Box', '', 1, 6, 'assets/images/kinder-pancake.jpg'],
            [3, 'Lotus Pancake Box', '', 1, 5, 'assets/images/lotus-pancake.jpeg'],
            [3, 'Nutella Pancake Box', '', 1, 5, 'assets/images/nutella-pancake.jpg'],
            [3, 'Pistachio Pancake Box', '', 1, 6, 'assets/images/pistachio-pancake.jpg'],
            [3, 'Waffle Pain', '', 1, 4.5, 'assets/images/waffle-plain.jpg'],
            [4, 'Ice Cream Cone', '', 1, 2.58, 'assets/images/no_img_sweet.png'],
            [4, 'Ice Cream Cup', '', 1, 3, 'assets/images/no_img_sweet.png'],
            [4, 'Ice Cream 1/2 Kg', '', 1, 6.17, 'assets/images/Ice-cream-0,5kg.jpg'],
            [4, 'Ice Cream 1 KG', '', 1, 12.35, 'assets/images/Ice-cream-1kg.jpg'],
            [7, "Pepsi Can", '', 1, 1, 'assets/images/pepsi-can-330ml.jpg'],
            [7, "Pepsi Diet", '', 1, 1, 'assets/images/pepsi-diet-can-330ml.jpg'],
            [7, "Seven Up", '', 1, 1, 'assets/images/7up-can.jpg'],
            [7, "Seven Diet", '', 1, 1, 'assets/images/7up-diet-can.jpg'],
            [7, "Miranda", '', 1, 1, 'assets/images/mirinda-can-330ml.jpg'],
            [7, "Almaza Light", '', 1, 1.55, 'assets/images/no_img_sweet.png'],
            [7, "Almaza Normal", '', 1, 1.55, 'assets/images/no_img_sweet.png'],
            [7, "Almaza Rose", '', 1, 1.55, 'assets/images/no_img_sweet.png'],
            [7, "Water Small 0.5 L", '', 1, 0.44, 'assets/images/tannourine-0,5l.jpg'],
            [7, "Water Large 1 L", '', 1, 0.66, 'assets/images/no_img_sweet.png'],
            [9, "Oreo Milkshake", '', 1, 5, 'assets/images/oreo-milkshake.jpeg'],
            [9, "Mango Milkshake", '', 1, 5, 'assets/images/mango-milkshake.jpeg'],
            [9, "Lotus Milkshake", '', 1, 5, 'assets/images/lotus-milkshake.jpeg'],
            [9, "Ashta Milkshake", '', 1, 5, 'assets/images/no_img_sweet.png'],
            [9, "Strawberry Milkshake", '', 1, 5, 'assets/images/strawberry-milkshake.jpeg'],
            [10, "Brownie Cup", '', 1, 5, 'assets/images/brownie-cup.jpeg'],
            [10, "Brownie Iced Cup ", '', 1, 6, 'assets/images/brownie-iced-cup.jpeg'],
            [10, "Pistachio Ghazle Box ", '', 1, 6, 'assets/images/pistachio-ghazle-box.jpeg'],
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
                    ['Add Banana', 1, null],
                    ['Add Kiwi', 1, null],
                    ["Add Strawberry", 1, null],
                    ['Add Grapes', 1, null],
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
                'price' => 5,
                'image' => 'assets/images/3a-Zaw2ak-Juice.jpeg',
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
                'name' => "Apple Juice",
                'description' => "",
                'cost' => 1,
                'price' => 2,
                'image' => 'uploads/products/Apple-juice.png',
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
                'name' => "Avocado and Cocktail",
                'description' => "",
                'cost' => 1,
                'price' => 4,
                'image' => 'assets/images/avocado-and-cocktail.jpg',
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
                'price' => 4,
                'image' => 'uploads/products/Avocado.png',
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
                'name' => "Carrot",
                'description' => "",
                'cost' => 1,
                'price' => 2,
                'image' => 'assets/images/carrot-juice.jpg',
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
                'name' => "Cocktail Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/cockail-juice.jpeg',
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
                'price' => 10,
                'image' => 'assets/images/exotic-juice.jpg',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['Small', 0],
                            ['Medium', 3],
                            ['Large', 6],
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
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Guava Juice",
                'description' => "",
                'cost' => 1,
                'price' => 3,
                'image' => 'assets/images/guava-juice.jpg',
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
                'name' => "Lemon and Haba2",
                'description' => "",
                'cost' => 1,
                'price' => 2.5,
                'image' => 'assets/images/lemon-and-haba2.jpg',
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
                'name' => "Lemon and Mint",
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
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Lemon Ade",
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
                            ['Medium', 1],
                            ['Large', 2],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 5,
                'name' => "Mango Juice",
                'description' => "",
                'cost' => 1,
                'price' => 4,
                'image' => 'uploads/products/Mango-juice.png',
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
                'price' => 4.5,
                'image' => 'assets/images/mixed-juice.jpg',
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
                'name' => "Orange Juice",
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
                'name' => "Passion Fruit",
                'description' => "",
                'cost' => 1,
                'price' => 4,
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
                'price' => 5,
                'image' => 'assets/images/Pomegranat- juice.jpg',
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
                'price' => 6,
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
                'price' => 3,
                'image' => 'uploads/products/Strawberry-juice.png',
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

            // -------------------------
            // 6: Juice Bottles (0.5L / 1L)
            // -------------------------
            [
                'category_id' => 6,
                'name' => "Lemon",
                'description' => "",
                'cost' => 1,
                'price' => 4,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 4],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Apple",
                'description' => "",
                'cost' => 1,
                'price' => 4,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 4],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Avocado",
                'description' => "",
                'cost' => 1,
                'price' => 6,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 6],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Carrots",
                'description' => "",
                'cost' => 1,
                'price' => 4,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 4],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Cocktail",
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
                            ['1 Litre', 5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Guava",
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
                            ['1 Litre', 5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Lemon and Haba2",
                'description' => "",
                'cost' => 1,
                'price' => 4.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 4.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Lemon and Mint",
                'description' => "",
                'cost' => 1,
                'price' => 4,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 4],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Mango",
                'description' => "",
                'cost' => 1,
                'price' => 6,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 6],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Mix",
                'description' => "",
                'cost' => 1,
                'price' => 6.5,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 6.5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Orange",
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
                            ['1 Litre', 5],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Passion Fruit and Orange",
                'description' => "",
                'cost' => 1,
                'price' => 6,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 6],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Remmen",
                'description' => "",
                'cost' => 1,
                'price' => 6,
                'image' => 'assets/images/no_img_sweet.png',
                'variants' => [
                    [
                        'title' => 'Size',
                        'type' => 'single',
                        'options' => [
                            ['0.5 L', 0],
                            ['1 Litre', 6],
                        ]
                    ]
                ]
            ],
            [
                'category_id' => 6,
                'name' => "Strawberry",
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
                            ['1 Litre', 5],
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
                'price' => 4,
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
                'price' => 4,
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
                'price' => 4,
                'image' => 'assets/images/lotus-waffle.jpg',
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
                'price' => 5.5,
                'image' => 'assets/images/White-and-kinder-waffle.jpg',
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
                'price' => 4,
                'image' => 'assets/images/White-pistachio-waffle.jpg',
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
                'price' => 4,
                'image' => 'assets/images/White-strawberry-waffle.jpg',
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
