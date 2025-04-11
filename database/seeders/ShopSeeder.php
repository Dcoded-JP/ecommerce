<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = [
            [
                'name' => 'Fashion Hub',
                'description' => 'Trendy clothing store for all ages',
                'category' => 'Clothing',
                'image' => 'shops/fashion-hub.jpg'
            ],
            [
                'name' => 'Accessories World',
                'description' => 'Premium accessories and jewelry',
                'category' => 'Accessories',
                'image' => 'shops/accessories-world.jpg'
            ],
            [
                'name' => 'Kids Corner',
                'description' => 'Everything for your little ones',
                'category' => 'Kids',
                'image' => 'shops/kids-corner.jpg'
            ]
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
} 